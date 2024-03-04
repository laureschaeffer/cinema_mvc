<?php ob_start(); // lien avec le fichier template.php ?>

<div id="listings">
    <?php
        // liste de tous les acteurs présents dans la base de données ; l'url permet d'appeler l'action dans l'index
        foreach($acteurs as $acteur) { ?>
        <div class="card">
            <figure><a href="index.php?action=detailActeur&id=<?=$acteur["id_acteur"]?>" aria-label="detail de l'acteur"><img src="<?=$acteur["photo"]?>" alt="photo de l'acteur <?=$acteur["nomActeur"]?>"></a></figure>
            <p><a href="index.php?action=detailActeur&id=<?=$acteur["id_acteur"]?>" aria-label="detail de l'acteur"><?= $acteur["nomActeur"]?></a></p>
            <p><?= $acteur["date_naissance"] ?></p>
        </div>
        <?php } 
        ?>

</div>
<div class="form-btn">
    <button><a href="index.php?action=formActeur" aria-label="formulaire ajouter un acteur">Ajouter un acteur</a></button>
</div>
<?php
    

$description="Voilà la liste de tous les acteurs et actrices présents dans notre site. Présentez-nous votre préféré.";
$titre= "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();

require_once "view/template.php";