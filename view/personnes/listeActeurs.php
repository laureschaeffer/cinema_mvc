<?php ob_start(); // lien avec le fichier template.php ?>

<p class="uk-label uk-label-warning"> Il y a <?= $requeteLsActeur->rowCount() ?> acteurs </p>

    <?php
        // liste de tous les acteurs présents dans la base de données ; l'url permet d'appeler l'action dans l'index
        foreach($requeteLsActeur->fetchAll() as $acteur) { ?>
        <div class="card-listing">
            <a href="index.php?action=detailActeur&id=<?=$acteur["id_acteur"]?>"><?= $acteur["nomActeur"]?></a>
            <p><?= $acteur["date_naissance"] ?></p>
            <img src="<?=$acteur["photo"]?>" alt="photo de l'acteur" width=70px height=100px>
        </div>

        <?php } 


$titre= "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();

require_once "view/template.php";