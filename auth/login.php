<?php
session_start();

include '../config/conn.php';
    
$link = createMysqliConnection();  

$message = '';

/* AI USE: CLAUDE
Login toiminallisuuteen */

// Redirect if already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the account exists
    if ($stmt = $link->prepare('SELECT user_id, name, email, password_hash FROM accounts WHERE email = ?')) {
        $stmt->bind_param('s', $_POST['loginemail']);
        $stmt->execute();
        $stmt->store_result();
        
        // Check if account exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $name, $email, $password_hash);
            $stmt->fetch();
            
            // Verify password
            if (password_verify($_POST['loginpassword'], $password_hash)) {
                // Password is correct, create session
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                
                // Redirect to home page
                header('Location: ../index.php');
                exit;
            } else {
                $message = 'Incorrect email or password!';
            }
        } else {
            $message = 'Incorrect email or password!';
        }
        $stmt->close();
    } else {
        $message = 'Could not prepare statement!';
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
    <title>Kirjaudu sisään</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="mb-3">
        <div class="container">
            <div class="nav-wrapper">
                <a href="../index.php" class="nav-brand">Kaavakanta</a>
                <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
                    <span class="hamburger"></span>
                    <span class="hamburger"></span>
                    <span class="hamburger"></span>
                </button>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="../plans.php" class="text-center">Kaavaehdotukset</a></li>
                    <li><a href="register.php" class="btn btn-secondary">Rekisteröidy</a></li>
                    <li><a href="login.php" class="btn btn-secondary">Kirjaudu</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            <div class="grid-auto">
                <div class="card">
                    <h1 class="text-center mb-3">Kirjaudu sisään</h1>
                    <?php if (!empty($message)): ?>
                        <div class="mb-2 text-center">
                            <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <form action="login.php" method="post">
                        <div class="mb-2">
                            <label for="loginemail">Sähköposti</label>
                            <input type="email" id="loginemail" name="loginemail" placeholder="käyttäjä@esimerkki.com" required>
                        </div>
                        <div class="mb-2">
                            <label for="loginpassword">Salasana</label>
                            <input type="password" id="loginpassword" name="loginpassword" placeholder="Syötä salasana" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirjaudu sisään</button>
                    </form>
                </div>
                <div class="flex-column justify-center align-center text-center">
                    <h1>Etkö ole vielä rekisteröitynyt?</h1>
                    <a href="register.php" class="btn" role="button">Luo tunnus tästä</a>
                </div>
            </div>
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
<script src="../js/scripts.js"></script>
</html>
