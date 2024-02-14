<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsActeur->rowCount() ?> acteurs </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Date de Naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // liste de tous les acteurs présents dans la base de données ; l'url permet d'appeler l'action dans l'index
        foreach($requeteLsActeur->fetchAll() as $acteur) { ?>
        <tr>
            <td><a href="index.php?action=detailActeur&id=<?=$acteur["id_acteur"]?>"><?= $acteur["nomActeur"]?></a></td>
            <td><?= $acteur["date_naissance"] ?></td>
        </tr>
        <?php } ?>
    </tbody>

</table>

<?php

$titre= "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();

require_once "view/template.php";