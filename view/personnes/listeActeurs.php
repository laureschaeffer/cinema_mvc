<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsActeur->rowCount() ?> acteurs </p>
<div class="card-listing">
    <p class="uk-label uk-label-warning"><a href="index.php?action=formActeur">Ajouter un acteur</a></p>
</div>

    <?php
        // liste de tous les acteurs présents dans la base de données ; l'url permet d'appeler l'action dans l'index
        foreach($requeteLsActeur->fetchAll() as $acteur) { ?>
        <div class="card-listing">
            <a href="index.php?action=detailActeur&id=<?=$acteur["id_acteur"]?>"><?= $acteur["nomActeur"]?></a>
            <p><?= $acteur["date_naissance"] ?></p>
            <img src="<?=$acteur["photo"]?>" alt="photo de l'acteur <?=$acteur["nomActeur"]?>">
        </div>

        <?php } 
    

$description="Voilà la liste de tous les acteurs et actrices présents dans notre site. Présentez-nous votre préféré.";
$titre= "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();

require_once "view/template.php";