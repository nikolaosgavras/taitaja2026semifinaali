<?php
session_start();

include 'config/conn.php';

// Create database connection
try {
    $link = createMysqliConnection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

/* AI USE: CLAUDE */
// Auttoi tekemään koodin kaavojen hakemiseen tietokannasta

// Check if viewing a single plan
$viewingPlan = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($viewingPlan > 0) {
    // Fetch single plan details
    $planDetails = null;
    $stmt = $link->prepare(
'SELECT p.id, p.name, p.short_description, p.long_description, p.location, p.status_id, p.thumbnail_url, p.picture_url, p.created, p.updated, s.name as status_name 
        FROM plans p 
        LEFT JOIN status s ON p.status_id = s.id 
        WHERE p.id = ?'
        );
    $stmt->bind_param('i', $viewingPlan);
    $stmt->execute();
    $result = $stmt->get_result();
    $planDetails = $result->fetch_assoc();
    $stmt->close();
    
    if (!$planDetails) {
        // Plan not found, redirect to list
        header('Location: plans.php');
        exit;
    }
    
    // Fetch status history for this plan
    $statusHistory = [];
    $historyStmt = $link->prepare(
        'SELECT sh.id, sh.status_id, sh.modified_at, sh.change_description, s.name as status_name 
         FROM status_history sh 
         LEFT JOIN status s ON sh.status_id = s.id 
         WHERE sh.kaavaehdotus_id = ? 
         ORDER BY sh.modified_at DESC'
    );
    $historyStmt->bind_param('i', $viewingPlan);
    $historyStmt->execute();
    $historyResult = $historyStmt->get_result();
    while ($historyRow = $historyResult->fetch_assoc()) {
        $statusHistory[] = $historyRow;
    }
    $historyStmt->close();
} else {
    // List view logic
    // Get filter value
    $filterStatus = isset($_GET['status']) ? intval($_GET['status']) : 0;

    // Fetch all statuses for dropdown
    $statuses = [];
    if ($statusResult = $link->query('SELECT id, name FROM status ORDER BY name')) {
        while ($statusRow = $statusResult->fetch_assoc()) {
            $statuses[] = $statusRow;
        }
        $statusResult->close();
    }

    // Pagination setup
    $plansPerPage = 5;
    $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($currentPage - 1) * $plansPerPage;

    // Build query with optional status filter
    $countQuery = 'SELECT COUNT(*) as total FROM plans';
    $planQuery = 'SELECT p.id, p.name, p.short_description, p.long_description, p.location, p.status_id, p.thumbnail_url, p.picture_url, p.created, p.updated, s.name as status_name 
                  FROM plans p 
                  LEFT JOIN status s ON p.status_id = s.id';

    if ($filterStatus > 0) {
        $countQuery .= ' WHERE status_id = ?';
        $planQuery .= ' WHERE p.status_id = ?';
    }

    $planQuery .= ' ORDER BY p.name LIMIT ? OFFSET ?';

    // Get total count with filter
    $totalPlans = 0;
    if ($filterStatus > 0) {
        $stmt = $link->prepare($countQuery);
        $stmt->bind_param('i', $filterStatus);
        $stmt->execute();
        $result = $stmt->get_result();
        $countRow = $result->fetch_assoc();
        $totalPlans = $countRow['total'];
        $stmt->close();
    } else {
        if ($countResult = $link->query($countQuery)) {
            $countRow = $countResult->fetch_assoc();
            $totalPlans = $countRow['total'];
            $countResult->close();
        }
    }

    $totalPages = ceil($totalPlans / $plansPerPage);

    // Fetch plans for current page with filter
    $plans = [];
    if ($stmt = $link->prepare($planQuery)) {
        if ($filterStatus > 0) {
            $stmt->bind_param('iii', $filterStatus, $plansPerPage, $offset);
        } else {
            $stmt->bind_param('ii', $plansPerPage, $offset);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $plans[] = $row;
        }
        $stmt->close();
    }
}

mysqli_close($link);
/* AI USE END */
?>



<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etusivu</title>
    <link rel="stylesheet" href="css/style.css">
</head> 
<body>
    <nav class="mb-3">
        <div class="container">
            <div class="nav-wrapper">
                <a href="index.php" class="nav-brand">Kaavakanta</a>
                <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
                    <span class="hamburger"></span>
                    <span class="hamburger"></span>
                    <span class="hamburger"></span>
                </button>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="plans.php" class="text-center">Kaavaehdotukset</a></li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <li><span class="text-center">Terve, <?php echo htmlspecialchars($_SESSION['name']); ?>!</span></li>
                        <li><a href="auth/logout.php" class="btn btn-secondary">Kirjaudu ulos</a></li>
                    <?php else: ?>
                        <li><a href="auth/register.php" class="btn btn-secondary">Rekisteröidy</a></li>
                        <li><a href="auth/login.php" class="btn btn-secondary">Kirjaudu</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>


    <main>
        <div class="container">
            <?php if ($viewingPlan > 0): ?>
                <!-- Detail View -->
                <h1 class="text-center mb-3">Kaavaehdotuksen tiedot</h1>
                <div class="grid-3 mb-3">
                    <div class="picture">
                        <?php if (!empty($planDetails['picture_url'])): ?>
                            <div class="plan-image mb-3">
                                <img src="<?php echo htmlspecialchars($planDetails['picture_url']); ?>" alt="<?php echo htmlspecialchars($planDetails['name']); ?>" style="max-width: 100%; height: auto; border-radius: 8px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <div class="info-grid">
                            <?php if (!empty($planDetails['name'])): ?>
                            <div>
                                <strong>Kaavan nimi:</strong>
                                <span><?php echo htmlspecialchars($planDetails['name']); ?></span>
                            </div>
                            <?php endif; ?>
                            <br>
                            <?php if (!empty($planDetails['location'])): ?>
                                <div>
                                    <strong>Sijainti:</strong> 
                                    <span><?php echo htmlspecialchars($planDetails['location']); ?></span>
                                </div>
                            <?php endif; ?>
                            <br>
                            <?php if (!empty($planDetails['long_description'])): ?>
                            <div>
                                <strong>Kaavaehdotuksen kuvaus:</strong>
                                <span><?php echo htmlspecialchars($planDetails['long_description']); ?></span>
                            </div>
                            <?php endif; ?>
                            <br>
                            <?php if (!empty($planDetails['status_name'])): ?>
                            <div>
                                <strong>Kaavaprosessin nykyinen vaihe:</strong> 
                                <span><?php echo htmlspecialchars($planDetails['status_name']); ?></span>
                            </div>
                            <?php endif; ?>
                            <br>
                            <?php if (!empty($statusHistory)): ?>
                                <div>
                                    <strong>Kaavaprosessin tilahistoria</strong>
                                    <table class="mb-2">
                                        <tbody>
                                            <?php foreach ($statusHistory as $history): ?>
                                                <tr>
                                                    <td data-label="Tila"><?php echo htmlspecialchars($history['status_name'] ?? 'Ei tietoa'); ?></td>
                                                    <td data-label="Päivämäärä"><?php echo date('d.m.Y H:i', strtotime($history['modified_at'])); ?></td>
                                                    <td data-label="Kuvaus"><?php echo !empty($history['change_description']) ? htmlspecialchars($history['change_description']) : '-'; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="comments">
                        <div class="comments-section">
                            <h2>Kommentit</h2>
                            <p>Työn alla</p>
                        </div>
                    </div>
                </div>
                <div class="grid-auto">
                    <div class="mb-2 text-center">
                        <a href="plans.php" style="display: inline-flex; align-items: center; gap: 10px;">
                            <img src="icons/6.svg" style="transform: rotate(180deg);" alt="Takaisin kaavaehdotuksiin">
                            <span>Takaisin kaavaehdotuksiin</span>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <!-- List View -->
                <h1 class="text-center mb-3">Kaavaehdotukset</h1>
                
                <!-- Filter Form -->
                <form method="get" action="plans.php" class="filter-form mb-2">
                    <label for="status">Suodata tilan mukaan:</label>
                    <select name="status" id="status" onchange="this.form.submit()">
                        <option value="0" <?php echo $filterStatus == 0 ? 'selected' : ''; ?>>Kaikki tilat</option>
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?php echo $status['id']; ?>" <?php echo $filterStatus == $status['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($status['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
                
                <?php if (empty($plans)): ?>
                    <p class="text-center">Ei kaavaehdotuksia saatavilla.</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Kuva</th>
                                <th>Nimi</th>
                                <th>Kuvaus</th>
                                <th>Tila</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($plans as $plan): ?>
                                <tr>
                                    <td data-label="Kuva" class="table-img-cell">
                                        <?php if (!empty($plan['picture_url'])): ?>
                                            <img src="<?php echo htmlspecialchars($plan['picture_url']); ?>" alt="<?php echo htmlspecialchars($plan['name']); ?>" class="table-img">
                                        <?php else: ?>
                                            <img src="images/placeholder.png" alt="Ei kuvaa" class="table-img">
                                        <?php endif; ?>
                                    </td>
                                    <td data-label="Nimi"><?php echo htmlspecialchars($plan['name']); ?></td>
                                    <td data-label="Kuvaus"><?php echo htmlspecialchars($plan['short_description']); ?></td>
                                    <td data-label="Tila"><?php echo htmlspecialchars($plan['status_name'] ?? 'Ei tietoa'); ?></td>
                                    <td data-label="">
                                        <a href="plans.php?id=<?php echo $plan['id']; ?>" style="display: inline-flex; align-items: center; gap: 10px;">
                                            <img src="icons/6.svg" alt="Tarkastele kaavaehdotusta">
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <!-- Pagination Controls -->
                    <?php if ($totalPages > 1): ?>
                        <div class="pagination">
                            <?php 
                            $filterParam = $filterStatus > 0 ? '&status=' . $filterStatus : '';
                            ?>
                            <?php if ($currentPage > 1): ?>
                                <a href="?page=<?php echo $currentPage - 1; ?><?php echo $filterParam; ?>" class="btn btn-secondary">« Edellinen</a>
                            <?php endif; ?>
                            
                            <span class="pagination-info">
                                Sivu <?php echo $currentPage; ?> / <?php echo $totalPages; ?>
                            </span>
                            
                            <?php if ($currentPage < $totalPages): ?>
                                <a href="?page=<?php echo $currentPage + 1; ?><?php echo $filterParam; ?>" class="btn btn-secondary">Seuraava »</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer class="mt-2">
        <div class="card">
            <div class="container text-center">
                <p>&copy; 2026 Nikolaos Gavras <br> Savon ammattiopisto</p>
            </div>
        </div>
    </footer>
</body>
<script src="js/scripts.js"></script>
</html>