<?php ob_start(); // lien avec le fichier template.php 
    // liste de tous les realisateurs présents dans la base de données ; l'url permet d'appeler l'action dans l'index  ?>

<div id="listings">
    <?php foreach($requeteLsReal->fetchAll() as $real) { ?>
        <div class="card">
            <figure><a href="index.php?action=detailReal&id=<?= $real["id_realisateur"]?>"><img src="<?=$real["photo"]?>" alt="photo du réalisateur <?=$real["nomReal"]?>"></a></figure>
            <p><a href="index.php?action=detailReal&id=<?= $real["id_realisateur"]?>"><?= $real["nomReal"] ?></a></p>
            <p><?= $real["date_naissance"]?> </p>
        </div>
        <?php } ?>
</div>
<div class="form-btn">
    <button><a href="index.php?action=formReal">Ajouter un réalisateur</a></button>
</div>


<?php

$description="Voilà la liste de tous les réalisateurs et réalisatrices présents dans notre site. Présentez-nous votre préféré.";
$titre= "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();

require_once "view/template.php";