<?php ob_start(); ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsReal->rowCount() ?> réalisateurs </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requeteLsReal->fetchAll() as $real) { ?>
        <tr>
            <td><?= $real["nom_real"] ?></td>
            <td><?= $real["date_naissance"]?> </td>
        </tr>
        <?php } ?>
    </tbody>

</table>

<?php

$titre= "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();

require_once "view/template.php";