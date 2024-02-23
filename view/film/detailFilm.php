<?php ob_start(); 
$detFilm = $requeteDetailFilm->fetch();

// lien avec le fichier template.php  ?>

    <section class="detail">
            <div class="detail-header">
                <p><?= $detFilm["annee_sortie_fr"]?></p> 
                <p>Genre :
                <?php foreach($requeteGenreFilm->fetchAll() as $genre){ ?>
                    <?=$genre["nomGenre"]?>
                    <?php
                } ?>
                 </p>
                <p>Réalisé par <a href="index.php?action=detailReal&id=<?=$detFilm["id_realisateur"]?>"><?=$detFilm["realisateur"]?></a></p>
                <p><?= $detFilm["note"]?>/5</p> 
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
                        ?> <p><a href="index.php?action=detailActeur&id=<?=$casting["id_acteur"]?>"><?=$casting["nomActeur"]?></a> dans le rôle de <a href="index.php?action=listeRole&id=<?=$casting["id_role"]?>"><?= $casting["nom_personnage"]?></a></p> 
                        <?php 
                    } ?>
            </div>
            <p><a href="index.php?action=modifierFilm&id=<?=$detFilm["id_film"]?>">Apporter une modification</a></p>
            <!-- action: redirige vers une page de modification  -->

    </section>

        <?php 
$description="Page dédiée au détail du film".$detFilm["titre"].", contenant ses infos principales";
$titre= "Détail du film";
$titre_secondaire = $detFilm["titre"];
$contenu = ob_get_clean();

require_once "view/template.php";