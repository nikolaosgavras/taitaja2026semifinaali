
<?php


include 'config/conn.php';

// Create database connection
try {
    $link = createMysqliConnection();
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
/* AI USE: CLAUDE */
// Auttoi tekemään koodin kaavojen hakemiseen tietokannasta
$plans = [];
$query = 'SELECT id, name, short_description, long_description, location, status_id, thumbnail_url, picture_url, created, updated FROM plans ORDER BY name';

if ($stmt = $link->prepare($query)) {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $plans[] = $row;
    }
    $stmt->close();
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
                    <li><a href="register.php" class="btn btn-secondary">Rekisteröidy</a></li>
                    <li><a href="login.php" class="btn btn-secondary">Kirjaudu</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <main>
        <div class="container">
            <h1 class="text-center mb-3">Kaavaehdotukset</h1>
            
            <?php if (empty($plans)): ?>
                <p class="text-center">Ei kaavaehdotuksia saatavilla.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Kuva</th>
                            <th>Nimi</th>
                            <th>Sijainti ja kuvaus</th>
                            <th>Tila</th>
                            <th>Toiminnot</th>
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
                                <td data-label="Sijainti ja kuvaus"><?php echo htmlspecialchars($plan['location']) . ' - ' . htmlspecialchars($plan['short_description']); ?></td>
                                <td data-label="Tila"><?php echo htmlspecialchars($plan['status_id']); ?></td>
                                <td data-label="Toiminnot">
                                    <a href="plans.php?id=<?php echo $plan['id']; ?>" class="btn">Näytä</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="card">
            <div class="container text-center">
                <p>&copy; 2026 Nikolaos Gavras. <br> Savon ammattiopisto</p>
            </div>
        </div>
    </footer>
</body>
<script src="js/scripts.js"></script>
</html>