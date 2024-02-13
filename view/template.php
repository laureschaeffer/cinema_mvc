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
        <ul>
            <!-- <li><a href="index.php?action=">
            <img src="../public/img/clapperboard-29986_1280.webp" alt="logo-cinephile" width=50px height=50px>
        </a></li>   ici mettre la landingPage -->
            <li><a href="index.php?action=listFilms">Films</a></li>
            <li><a href="index.php?action=listReals">Réalisateurs</a></li>
            <li><a href="#">Acteurs</a></li>
            <li><a href="#">Genre</a></li>
            <li><a href="#">Formulaires</a></li>
        </ul>
         
        

    </nav>
    <div id="wrapper">
        <main>
            <div id="contenu">
                <h1 class="uk-heading-divider">PDO Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>

        </main>
    </div>
    
</body>
</html>
