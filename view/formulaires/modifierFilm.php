<?php ob_start(); // lien avec le fichier template.php 
?>

    <section class="formulaire">
        <?php foreach($requeteDetailFilm->fetchAll() as $detFilm) { ?>
            <form action="index.php?action=ajouterModification&id=<?=$detFilm["id_film"]?>" method="post" enctype="multipart/form-data">

                <img src="<?=$detFilm["affiche"]?>" alt="affiche du film" width=200px height=200px>
                <p><label>Nom du film:</label></p>
                <input type="text" class="form-control" name="titre" value="<?= $detFilm["titre"]?>">

                
                <p><label>Année de sortie :</label></p>
                <input type="number" class="form-control" name ="annee_sortie_fr" value="<?= $detFilm["annee_sortie_fr"]?>">
                
                <p><label>Durée (en minutes) :</label></p>
                <input type="number" class="form-control" name ="duree" value="<?= $detFilm["duree"]?>">
                
                <p><label>Réalisé par :</label></p>
                <select class="form-control" name="realisateur" id="realisateur-select">
                    <option value="realisateur"><?=$detFilm["realisateur"]?></option>
                        <?php foreach($choixReal->fetchAll() as $real){ ?>
                            <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                        <?php 
                        } ?>
                </select>
                
                <p><label>Genre :</label></p>
                <select class="form-control" name="genre" id="genre-select">
                    <?php foreach($requeteGenreFilm->fetchAll() as $genre){ ?> 
                    <option value="<?=$genre["id_genre"]?>"><?=$genre["nom"]?></option>
                    <?php 
                    } ?>
                </select>
                <p><label>Note sur 5 :</label></p>
                <input type="number" class="form-control" name="note" value="<?= $detFilm["note"]?>">    
                <p><label>Résumé :</label></p>
                <textarea class="form-control" name="synopsis" row="4" ><?= $detFilm["synopsis"] ?></textarea>             
                <?php
                }
                ?>
                <p><button type="submit" name="submit" class="btn btn-secondary">Modifier le film</button></p>

        </form>
    </section>

<?php 

$description="Proposez une modification sur un film contenant une erreur." ;
$titre= "Modifier le film";
$titre_secondaire = "Modifier le film";
$contenu = ob_get_clean();

require_once "view/template.php";