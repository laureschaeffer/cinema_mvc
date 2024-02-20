<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/style.css">
    <title>
        <?= $titre ?>
    </title>
    
</head>
<body>
<div id="wrapper">
    <nav class="topNav" id="MyTopnav">
        <a href="index.php?action=homePage">
            <img src="public/img/clapperboard-29986_1280.webp" alt="logo-cinephile">
        </a>
        <a href="index.php?action=listFilms">Films</a></li>
        <a href="index.php?action=listReals">Réalisateurs</a></li>
        <a href="index.php?action=listActeurs">Acteurs</a></li>
        <a href="index.php?action=listGenres">Genres</a></li>
        <a href="index.php?action=formulaireFilm">Ajouter un film</a></li>
        <div class="network">
            <a href="#">
                <i class="fa-brands fa-facebook-f"></i>                        
            </a>
            <a href="#">
                <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-instagram"></i>
            </a>   
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
        </a>
        <!-- menu "burger" pour les media queries -->

    </nav>
        <main>
            <div id="contenu">
                <h1>PDO Cinema</h1>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>



        <footer class="py-3 my-4">
        <p class="text-center text-body-secondary">Retrouvez-nous</p>
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary"><i class="fa-brands fa-twitter"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary"><i class="fa-brands fa-instagram"></i></a></li>                  
        </ul>
        <p class="text-center text-body-secondary">© 2024 Laure Schaeffer</p>
        </footer>
        </main>
    </div>

<!-- navbar responsive -->
<script>
    function myFunction(){
        var x = document.getElementById("MyTopnav");
        if (x.className === "topNav"){
            x.className = "navbarResponsive";
        } else{
            x.className = "topNav" ;
        }
    }
</script>
</body>
</html>
<?php



