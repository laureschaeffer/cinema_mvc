<?php ob_start(); // lien avec le fichier template.php 

        // liste de tous les films présents dans la base de données ; l'url permet d'appeler l'action dans l'index
        foreach($requeteLsFilms->fetchAll() as $film) { ?>
            <div class="card-listing">
                <p><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>"><?= $film["titre"] ?></a></p>        
                <p><?= $film["annee_sortie_fr"]?></p> 
                <img src="<?=$film["affiche"]?>" alt="affiche du film<?=$film["titre"]?>">
            </div>
        <?php }  

$titre= "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();

require_once "view/template.php";
