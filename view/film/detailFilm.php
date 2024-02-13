<?php ob_start(); ?>


<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie</th>
            <th>Note sur 5</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requeteDetailFilm->fetchAll() as $detFilm) { ?>
        <tr>
            <td><?= $detFilm["titre"] ?></td>
            <td><?= $detFilm["annee_sortie_fr"]?> </td>
            <td><?= $detFilm["note"]?> </td>
        </tr>
        <?php } ?>
    </tbody>

</table>

<?php

$titre= "Détail film";
$titre_secondaire = "Detail du film";
$contenu = ob_get_clean();

require_once "view/template.php";