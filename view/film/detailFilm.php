<?php ob_start(); // lien avec le fichier template.php ?>

    <section class="detail">
        <?php foreach($requeteDetailFilm->fetchAll() as $detFilm) { ?>
            <div class="detail-header">
                <p><?= $detFilm["annee_sortie_fr"]?></p> 
                <p><?= $detFilm["note"]?> /5</p> 
            </div>
            <div class="detail-main">
                <div class="synopsis">
                    <?= $detFilm["synopsis"] ?>
                </div>
                <img src="<?=$detFilm["affiche"]?>" alt="affiche du film" width=200px height=200px>
            </div>
            <div class="casting">
                <?php
                    foreach($requeteCasting->fetchAll() as $casting) { 
                        ?> <p> <?=$casting["nomActeur"]?> dans le rôle de <?= $casting["nom_personnage"] ?> </p>
                    <?=  } ?>   
            </div>

    </section>

        <?php } 

$titre= "Détail du film film";
$titre_secondaire = $detFilm["titre"];
$contenu = ob_get_clean();

require_once "view/template.php";