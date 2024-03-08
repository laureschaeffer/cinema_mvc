<?php ob_start(); 
// lien avec le fichier template.php  ?>

    <section class="detail">
        <div class="card-movie">
            <div class="card-header">
                <figure><img src="<?=$detailFilm["affiche"]?>" alt="affiche du film"></figure>
                <div class="card-info">
                        <?php foreach($requeteGenreFilm as $genre){ ?>
                        <p><a href="index.php?action=detailGenre&id=<?=$genre["id_genre"]?>"><?=$genre["nomGenre"]?></a></p> 
                        <?php
                        } ?>
                        <p><?= $detailFilm["note"]?>/5</p> 
                        <p class="date-movie"><?= $detailFilm["annee_sortie_fr"]?></p>
                        <p>De <span class="real-movie"><a href="index.php?action=detailReal&id=<?=$detailFilm["id_realisateur"]?>"><?=$detailFilm["realisateur"]?></a></span></p>
                    </div>
                    <div class="modifications">
                        <!-- action: redirige vers une page de modification  -->
                        <a href="index.php?action=modifierFilm&id=<?=$detailFilm["id_film"]?>" aria-label="apporter une modification">Modifier</a>
                        <a href="index.php?action=supprimerFilm&id=<?=$detailFilm["id_film"]?>" class="supprimer"><i class="fa-solid fa-trash"></i>Supprimer</a>
                    </div>
                </div>
                <p class="resume"><?= $detailFilm["synopsis"] ?></p>
                <div class="casting">
                    <?php
                        foreach($requeteCasting as $casting) { 
                            ?> <p><a href="index.php?action=detailActeur&id=<?=$casting["id_acteur"]?>" aria-label="detail acteur"><?=$casting["nomActeur"]?></a> dans le rôle de <a href="index.php?action=listeRole&id=<?=$casting["id_role"]?>"><?= $casting["nom_personnage"]?></a></p> 
                            <?php 
                        } ?>
                </div>
        </div>
</section>


        <?php 
$description="Page dédiée au détail du film".$detailFilm["titre"].", contenant ses infos principales";
$titre= "Détail du film";
$titre_secondaire = $detailFilm["titre"];
$contenu = ob_get_clean();

require_once "view/template.php";