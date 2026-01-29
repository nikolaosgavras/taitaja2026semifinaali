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

// session_start();



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
                    <li><a href="plans.php" class="text-center">Kaavaehdotukset</a></li>
                    <li><a href="register.php" class="btn btn-secondary">Rekisteröidy</a></li>
                    <li><a href="login.php" class="btn btn-secondary">Kirjaudu</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <main>
        <div class="container">
            <div class="grid-2 mb-2">
                <img src="images/frontpage_hero.png" alt="Kaavakanta kuva">
                <div class="text-center">
                    <h1 class="mb-3">Tervetuloa Kaavakantaan</h1>
                    <p>
                        Kaavakanta on kunnan verkkopalvelu, jonka kautta kuntalaiset voivat tutustua ajankohtaisiin maankäytön kaavaehdotuksiin ja seurata kaavaprosessin etenemistä.

                        <br> <br>

                        Palvelussa voit tarkastella eri alueita koskevia kaavaehdotuksia, lukea niiden taustatietoja sekä nähdä, missä vaiheessa kaavaprosessi on parhaillaan. Kaavoitus vaikuttaa kunnan ympäristöön, asumiseen ja arjen toimivuuteen. Kaavakannan tavoitteena on tehdä suunnittelusta mahdollisimman avointa ja helposti lähestyttävää.
                        
                        <br> <br>

                        Osa kaavaehdotuksista on avoinna kommentointia varten. Kommenttien jättäminen edellyttää kirjautumista palveluun.
                    </p>
                </div>
            </div>

    
            <div class="grid-2">
                <div class="text-center">
                    <h2 class="mb-2">Kaavaprosessi</h2>
                    <p>
                        Kaavaprosessi etenee vaiheittain suunnittelusta päätöksentekoon.

                        <br> <br>

                        Prosessi alkaa aloitusvaiheesta, jossa kaavamuutoksen tarve arvioidaan ja laaditaan osallistumis- ja arviointisuunnitelma. Tämän jälkeen kaavaa selvitysten pohjalta ja laaditaan kaavaluonnos.
                        
                        <br> <br>

                        Valmisteluvaiheessa kaavaluonnos asetetaan nähtäville kuulemista varten, jolloin osalliset voivat esittää mielipiteitä. Saatujen palautteiden perusteella kaavaa muokataan ja laaditaan varsinainen kaavaehdotus, joka asetetaan virallisesti nähtäville. Nähtävilläolon aikana osalliset voivat tehdä muistutuksia ja viranomaiset antaa lausuntoja.

                        <br> <br>
                        Lopuksi kaava etenee hyväksymiskäsittelyyn. Hyväksymisen jälkeen kaava kuulutetaan ja se saa lainvoiman, mikäli siitä ei valiteta.

                    </p>
                </div>
                <div class="flex-column text-center align-center justify-center mb-2">
                    <a href="plans.php" class="btn" role="button">Tutustu kaavaehtotuksiin</a>
                    <a href="register.php" class="btn" role="button">Rekisteröidy ja kommentoi kaavaehdotuksia</a>
                    <a href="login.php" class="btn" role="button">Kirjaudu sisään</a>
                </div>
            </div>
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