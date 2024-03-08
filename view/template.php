<?php
// use Service\Message; 
// $msg = new Message();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=<?=$description?> >
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Della+Respira&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <title>
        <?= $titre ?>
    </title>
    
</head>
<body>
<div id="wrapper">
    <nav class="topNav" id="MyTopnav">
        <a class="accueil-btn" href="index.php?action=homePage">
            <img src="public/img/clapperboard-29986_1280.webp" alt="logo-cinephile"> Accueil
        </a>
        <a href="index.php?action=listFilms" aria-label="lien vers la liste des films">Films</a></li>
        <a href="index.php?action=listReals" aria-label="lien vers la liste des realisateurs">Réalisateurs</a></li>
        <a href="index.php?action=listActeurs" aria-label="lien vers la liste des acteurs">Acteurs</a></li>
        <a href="index.php?action=listGenres" aria-label="lien vers la liste des genres">Genres</a></li>
        <!-- <a href="index.php?action=formulaireFilm">Ajouter un film</a></li> -->
        <div class="network">
            <a href="#" aria-label="notre facebook">
                <i class="fa-brands fa-facebook-f"></i>                        
            </a>
            <a href="#" aria-label="lien vers notre twitter">
                <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="#" aria-label="lien vers notre instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>   
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()" aria-label="icone menu burger">
                <i class="fa fa-bars"></i>
        </a>
        <!-- menu "burger" pour les media queries -->

    </nav>
        <main>
            <div id="contenu">
                <h1>PDO Cinema</h1>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu  ?>
            </div>



        <footer>
        <p>Retrouvez-nous</p>
        <ul>
            <li><a href="#" aria-label="lien vers notre facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="#" aria-label="lien vers notre twitter"><i class="fa-brands fa-twitter"></i></a></li>
            <li><a href="#" aria-label="lien vers notre instagram"><i class="fa-brands fa-instagram"></i></a></li>                  
        </ul>
        <p>© 2024 Laure Schaeffer</p>
        </footer>
        </main>
    </div>

<!-- navbar responsive -->
<script src="public/js/main.js"></script>
</body>
</html>
<?php



