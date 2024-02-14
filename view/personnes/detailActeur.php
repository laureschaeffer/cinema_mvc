<?php ob_start(); // lien avec le fichier template.php ?>


<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Date de naissance</th>
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