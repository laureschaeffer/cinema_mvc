<?php ob_start(); ?>


<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requeteActeur->fetchAll() as $acteur) { ?>
        <tr>
            <td><?= $acteur["nomActeur"] ?></td>
            <td><?= $acteur["date_naissance"]?> </td>
        </tr>
        <?php } ?>
    </tbody>

</table>

<?php

$titre= "Détail Acteur";
$titre_secondaire = "Detail de l'acteur";
$contenu = ob_get_clean();

require_once "view/template.php";