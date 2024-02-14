<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsGenre->rowCount() ?> genres </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Nom</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //listes des genres de films
        foreach($requeteLsGenre->fetchAll() as $genre) { ?>
        <tr>
            <td><?= $genre["nom"] ?></td>
        </tr>
        <?php } ?>
    </tbody>

</table>

<?php

$titre= "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();

require_once "view/template.php";