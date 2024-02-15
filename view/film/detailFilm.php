<?php ob_start(); // lien avec le fichier template.php ?>

    <section class="detail">
        <?php foreach($requeteDetailFilm->fetchAll() as $detFilm) { ?>
            <div class="detail-header">
                <p><?= $detFilm["annee_sortie_fr"]?></p> 
                <p>Réalisé par <a href="index.php?action=detailReal&id=<?=$detFilm["id_realisateur"]?>"><?=$detFilm["realisateur"]?></a></p>
                <p><?= $detFilm["note"]?>/5</p> 
            </div>
            <div class="detail-main">
                <div class="synopsis">
                    <?= $detFilm["synopsis"] ?>
                </div>
                <img src="<?=$detFilm["affiche"]?>" alt="affiche du film" width=200px height=200px>
            </div>
            <?php
        }
        ?>
            <div class="casting">
                <?php
                    foreach($requeteCasting->fetchAll() as $casting) { 
                        ?> <p><a href="index.php?action=detailActeur&id=<?=$casting["id_acteur"]?>"><?=$casting["nomActeur"]?></a> dans le rôle de <a href="index.php?action=listeRole&id=<?=$casting["id_role"]?>"><?= $casting["nom_personnage"]?></a></p> 
                        <?php 
                    } ?>
            </div>

    </section>

        <?php 

$titre= "Détail du film";
$titre_secondaire = $detFilm["titre"];
$contenu = ob_get_clean();

require_once "view/template.php";