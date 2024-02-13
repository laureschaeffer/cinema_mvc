<?php ob_start(); ?>


<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Nom de l'acteur</th>
            <th>Nom du personnage</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($requeteCasting->fetchAll() as $casting) { ?>
        <tr>
            <td><?= $casting["nomActeur"] ?></td>
            <td><?= $casting["nom_personnage"]?> </td>
        </tr>
        <?php } ?>
    </tbody>

</table>

<?php

$titre= "Casting";
$titre_secondaire = "Casting du film";
$contenu = ob_get_clean();

require_once "view/template.php";