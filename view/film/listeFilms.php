<?php ob_start(); // lien avec le fichier template.php ?>

<!-- liste de tous les films présents dans la base de données ; l'url permet d'appeler l'action dans l'index -->


<div id="listings">
     <?php
    foreach($films as $film) { ?>
    <div class="card">
        <figure><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>"><img src="<?=$film["affiche"]?>" alt="affiche du film<?=$film["titre"]?>"></a></figure>
        <p><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>" aria-label="detail du film"><?= $film["titre"] ?></a></p>
        <p class="date-movie"><?= $film["annee_sortie_fr"]?></p>
        <p>De <span class="real-movie"><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>" aria-label="detail du realisateur"><?= $film["realisateur"] ?></a></span></p>
    </div>
    <?php }  
    ?>


</div>
<div class="form-btn">
    <a href="index.php?action=formulaireFilm" aria-label="formulaire ajout d'un film"><button>Ajouter un film</button></a>
</div>

<?php
$description="Voilà la liste de tous les films présents dans notre site. Présentez-nous votre film préféré.";
$titre= "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();

require_once "view/template.php";
