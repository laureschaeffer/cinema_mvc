<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>
        <?= $titre ?>
    </title>
    
</head>
<body>
    <nav>

            <!-- <li><a href="index.php?action=">
            <img src="../public/img/clapperboard-29986_1280.webp" alt="logo-cinephile" width=50px height=50px>
        </a></li>   ici mettre la landingPage -->
            <li><a href="index.php?action=listFilms">Films</a></li>
            <li><a href="index.php?action=listReals">Réalisateurs</a></li>
            <li><a href="index.php?action=listActeurs">Acteurs</a></li>
            <li><a href="index.php?action=listGenres">Genres</a></li>
            <li><a href="#">Formulaires</a></li>
    </nav>
    <div id="wrapper">
        <main>
            <div id="contenu">
                <h1>PDO Cinema</h1>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>

        </main>
    </div>
    <footer>
        <p class="text-center text-body-secondary">© 2024 Laure Schaeffer</p>
    </footer>
    
</body>
</html>
<?php



