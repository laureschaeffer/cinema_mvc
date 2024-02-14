<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsReal->rowCount() ?> réalisateurs </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Année de naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // liste de tous les realisateurs présents dans la base de données ; l'url permet d'appeler l'action dans l'index
        foreach($requeteLsReal->fetchAll() as $real) { ?>
        <tr>
            <td><a href="index.php?action=detailReal&id=<?= $real["id_realisateur"]?>"><?= $real["nomReal"] ?></a></td>
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