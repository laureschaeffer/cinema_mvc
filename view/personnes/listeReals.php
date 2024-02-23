<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsReal->rowCount() ?> réalisateurs </p>
<div class="card-listing">
    <p class="uk-label uk-label-warning"><a href="index.php?action=formReal">Ajouter un réalisateur</a></p>
</div>


        <?php
        // liste de tous les realisateurs présents dans la base de données ; l'url permet d'appeler l'action dans l'index
        foreach($requeteLsReal->fetchAll() as $real) { ?>
        <div class="card-listing">
            <p><a href="index.php?action=detailReal&id=<?= $real["id_realisateur"]?>"><?= $real["nomReal"] ?></a></p>
            <p><?= $real["date_naissance"]?> </p>
            <img src="<?=$real["photo"]?>" alt="photo du réalisateur <?=$real["nomReal"]?>">
        </div>

        <?php } 

$description="Voilà la liste de tous les réalisateurs et réalisatrices présents dans notre site. Présentez-nous votre préféré.";
$titre= "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();

require_once "view/template.php";