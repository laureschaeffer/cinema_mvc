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
        foreach($requeteReal->fetchAll() as $real) { ?>
        <tr>
            <td><?= $real["nomReal"] ?></td>
            <td><?= $real["date_naissance"]?> </td>
        </tr>
        <?php } ?>
    </tbody>

</table>

<?php

$titre= "Détail réalisateur";
$titre_secondaire = "Detail du réalisateur";
$contenu = ob_get_clean();

require_once "view/template.php";