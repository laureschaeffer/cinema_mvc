<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsGenre->rowCount() ?> genres </p>
<div class="card-listing">
    <p class="uk-label uk-label-warning"><a href="index.php?action=formGenre">Ajouter un genre</a></p>
</div>

<div class="listing-genre">
    <?php
        //listes des genres de films
        foreach($requeteLsGenre->fetchAll() as $genre) { ?>
            <p><a href="index.php?action=detailGenre&id=<?=$genre["id_genre"]?>"><?= $genre["nom"] ?></a></p>
        <?php } ?>

</div>
<?php
$description="Voilà la liste de tous les gens présents sur notre site.";
$titre= "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();

require_once "view/template.php";