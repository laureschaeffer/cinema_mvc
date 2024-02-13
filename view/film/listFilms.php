<?php ob_start(); ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsFilms->rowCount() ?> films </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requeteLsFilms->fetchAll() as $film) { ?>
        <tr>
            <td><?= $film["titre"] ?></td>
            <td><?= $film["annee_sortie_fr"]?> </td>
        </tr>
        <?php } ?>
    </tbody>

</table>

<?php

$titre= "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();

require_once "view/template.php";