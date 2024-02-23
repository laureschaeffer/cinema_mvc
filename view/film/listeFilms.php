<?php ob_start(); // lien avec le fichier template.php ?>

<!-- liste de tous les films présents dans la base de données ; l'url permet d'appeler l'action dans l'index -->
<div class="card-listing">
    <p class="uk-label uk-label-warning"><a href="index.php?action=formulaireFilm">Ajouter un film</a></p>
</div>
<?php
foreach($requeteLsFilms->fetchAll() as $film) { ?>
        <div class="card-listing">
                    <p><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>"><?= $film["titre"] ?></a></p>        
                    <p><?= $film["annee_sortie_fr"]?></p> 
                    <img src="<?=$film["affiche"]?>" alt="affiche du film<?=$film["titre"]?>">
                </div>
            <?php }  
    

$description="Voilà la liste de tous les films présents dans notre site. Présentez-nous votre film préféré.";
$titre= "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();

require_once "view/template.php";
