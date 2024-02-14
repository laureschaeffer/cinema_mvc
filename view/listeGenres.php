<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsGenre->rowCount() ?> genres </p>
<div class="listing-genre">
    <?php
        //listes des genres de films
        foreach($requeteLsGenre->fetchAll() as $genre) { ?>
            <p><?= $genre["nom"] ?></p>
        <?php } ?>

</div>
<?php

$titre= "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();

require_once "view/template.php";