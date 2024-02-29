<?php ob_start(); 
$detFilm = $requeteDetailFilm->fetch();

// lien avec le fichier template.php  ?>

    <section class="detail">
        <div class="card-movie">
            <div class="card-header">
                <figure><img src="<?=$detFilm["affiche"]?>" alt="affiche du film"></figure>
                <div class="card-info">
                        <?php foreach($requeteGenreFilm->fetchAll() as $genre){ ?>
                        <p><?=$genre["nomGenre"]?></p>
                        <?php
                        } ?>
                        <p><?= $detFilm["note"]?>/5</p> 
                        <p class="date-movie"><?= $detFilm["annee_sortie_fr"]?></p>
                        <p>De <span class="real-movie"><a href="index.php?action=detailReal&id=<?=$detFilm["id_realisateur"]?>"><?=$detFilm["realisateur"]?></a></span></p>
                    </div>
                </div>
                <p class="resume"><?= $detFilm["synopsis"] ?></p>
                <div class="casting">
                    <?php
                        foreach($requeteCasting->fetchAll() as $casting) { 
                            ?> <p><a href="index.php?action=detailActeur&id=<?=$casting["id_acteur"]?>"><?=$casting["nomActeur"]?></a> dans le rôle de <a href="index.php?action=listeRole&id=<?=$casting["id_role"]?>"><?= $casting["nom_personnage"]?></a></p> 
                            <?php 
                        } ?>
                </div>
        </div>
        <div class="form-btn">
            <button><a href="index.php?action=modifierFilm&id=<?=$detFilm["id_film"]?>">Apporter une modification</a></button>
        </div>
            <!-- action: redirige vers une page de modification  -->

</section>


        <?php 
$description="Page dédiée au détail du film".$detFilm["titre"].", contenant ses infos principales";
$titre= "Détail du film";
$titre_secondaire = $detFilm["titre"];
$contenu = ob_get_clean();

require_once "view/template.php";