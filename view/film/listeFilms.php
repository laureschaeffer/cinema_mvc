<?php ob_start(); // lien avec le fichier template.php ?>

<!-- liste de tous les films présents dans la base de données ; l'url permet d'appeler l'action dans l'index -->


<div id="listings">
     <?php
    foreach($requeteLsFilms->fetchAll() as $film) { ?>
    <div class="card">
        <figure><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>"><img src="<?=$film["affiche"]?>" alt="affiche du film<?=$film["titre"]?>"></a></figure>
        <p><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>"><?= $film["titre"] ?></a></p>
        <p class="date-movie"><?= $film["annee_sortie_fr"]?></p>
        <p>De <span class="real-movie"><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>"><?= $film["realisateur"] ?></a></span></p>
    </div>
    <?php }  
    ?>


</div>
<div class="form-btn">
    <button><a href="index.php?action=formulaireFilm">Ajouter un film</a></button>
</div>

<?php
$description="Voilà la liste de tous les films présents dans notre site. Présentez-nous votre film préféré.";
$titre= "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();

require_once "view/template.php";
