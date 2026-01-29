<?php
session_start();

include '../config/conn.php';
    
$link = createMysqliConnection();  

$message = '';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the email already exists
    if ($stmt = $link->prepare('SELECT user_id, password_hash FROM accounts WHERE email = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc)
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database
        $stmt->store_result();
        // Check if the account exists
        if ($stmt->num_rows > 0) {
            // Email already exists
            $message = 'Sähköpostiosoite on jo käytössä! Valitse toinen!';
        } else {
            // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            // Email does not exist, insert new account
            if ($stmt = $link->prepare('INSERT INTO accounts (name, email, address, phone_number, password_hash) VALUES (?, ?, ?, ?, ?)')) {
                // Bind POST data to the prepared statement
                $stmt->bind_param('sssss', $_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone'], $password);
                $stmt->execute();
                // Output success message
                $message = 'Tilin luonti onnistui!';
            } else {
                // Something is wrong with the SQL statement
                $message = 'Lauseen valmistelu epäonnistui!';
            }
        }
        // Close the statement
        $stmt->close();
    } else {
        // Something is wrong with the SQL statement
        $message = 'Lauseen valmistelu epäonnistui!';
    }
}

mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tilin luonti</title>
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
                    <li><a href="#" class="btn btn-secondary">Rekisteröidy</a></li>
                    <li><a href="login.php" class="btn btn-secondary">Kirjaudu</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
    <div class="container">
        <h1 class="text-center mb-3">Luo tili</h1>
        
        <?php if (!empty($message)): ?>
            <div class="mb-2 text-center">
                <p><?php echo htmlspecialchars($message); ?></p>
            </div>
        <?php endif; ?>
        
        <form method="post">
            <div class="grid-2">
                <div class="register-form card">
                    <div class="mb-2">
                        <label for="name" class="form-label">Nimi</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Koko nimi" required>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Sähköpostiosoite</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="käyttäjä@esimerkki.com" required>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Salasana</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Syötä salasana" required>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label">Osoite</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Osoite" required>
                    </div>
                    <div class="mb-2">
                        <label for="phone" class="form-label">Puhelin</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Puhelinnumero" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            <input type="checkbox" name="terms" required>
                            Hyväksyn, että antamani tiedot tallennetaan järjestelmään ja että tiedot ovat kunnan kaavoitusasioista vastaavien henkilöiden nähtävissä palvelun käyttötarkoituksen mukaisesti.
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Luo tili</button>
                </div>
                <div class="card align-center justify-center text-center">
                    <h1>Oletko jo rekisteröitynyt?</h1>
                    <a href="login.php" class="btn" role="button">Tästä kirjautuminen</a>
                </div>
            </div>
        </form>
    </div>
    </main>
    <footer class="mt-2">
        <div class="card">
            <div class="container text-center">
                <p>&copy; 2026 Nikolaos Gavras. <br> Savon ammattiopisto</p>
            </div>
        </div>
    </footer>
</body>
</html>