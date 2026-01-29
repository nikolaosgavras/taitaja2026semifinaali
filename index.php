<?php include 'config/conn.php';
    
// Test database connection
try {
    $link = createMysqliConnection();
    /*
    echo "✓ Database connected successfully!<br>";
    echo "Database: " . mysqli_get_host_info($link) . "<br><br>";
    */
} catch (Exception $e) {
    die("✗ Connection failed: " . $e->getMessage());
}

session_start();



mysqli_close($link);

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
                <a href="#" class="nav-brand">Kaavakanta</a>
                <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
                    <span class="hamburger"></span>
                    <span class="hamburger"></span>
                    <span class="hamburger"></span>
                </button>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#suggestions" class="text-center">Kaavaehdotukset</a></li>
                    <li><a href="#register" class="btn btn-secondary">Rekisteröidy</a></li>
                    <li><a href="#login" class="btn btn-secondary">Kirjaudu</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <main>
        <section class="hero-section">
            <div class="container">
                <div class="grid-2">
                    <img src="images/frontpage_hero.png" alt="Kaavakanta kuva">
                    <div class="hero-text text-center">
                        <h1>Tervetuloa Kaavakantaan</h1>
                        <br>
                        <p>
                            Kaavakanta on kunnan verkkopalvelu, jonka kautta kuntalaiset voivat tutustua ajankohtaisiin maankäytön kaavaehdotuksiin ja seurata kaavaprosessin etenemistä.

                            <br> <br>

                            Palvelussa voit tarkastella eri alueita koskevia kaavaehdotuksia, lukea niiden taustatietoja sekä nähdä, missä vaiheessa kaavaprosessi on parhaillaan. Kaavoitus vaikuttaa kunnan ympäristöön, asumiseen ja arjen toimivuuteen. Kaavakannan tavoitteena on tehdä suunnittelusta mahdollisimman avointa ja helposti lähestyttävää.
                            
                            <br> <br>

                            Osa kaavaehdotuksista on avoinna kommentointia varten. Kommenttien jättäminen edellyttää kirjautumista palveluun.
                        </p>
                </div>
                
            </div>
        </section>
    </main>
</body>
<script src="js/scripts.js"></script>
</html>