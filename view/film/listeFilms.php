<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsFilms->rowCount() ?> films </p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // liste de tous les films présents dans la base de données ; l'url permet d'appeler l'action dans l'index
        foreach($requeteLsFilms->fetchAll() as $film) { ?>
        <tr>
            <td><a href="index.php?action=detailFilm&id=<?=$film["id_film"] ?>"><?= $film["titre"] ?></a></td>         
            <td><?= $film["annee_sortie_fr"]?> </td>
        </tr>
        <?php }  ?>
    </tbody>

</table>

<?php

$titre= "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();

require_once "view/template.php";
