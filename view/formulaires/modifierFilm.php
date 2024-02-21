<?php ob_start(); // lien avec le fichier template.php 
?>

    <section class="formulaireFilm">
        <?php foreach($requeteDetailFilm->fetchAll() as $detFilm) { ?>
            <form action="index.php?action=ajouterModification&id=<?=$detFilm["id_film"]?>" method="post" enctype="multipart/form-data">

                <img src="<?=$detFilm["affiche"]?>" alt="affiche du film" width=200px height=200px>
                <div class="form-group">
                    <label>Nom du film:</label>
                    <input type="text" class="form-control" name="titre" value="<?= $detFilm["titre"]?>">
                </div>

                <div class="form-group">
                    <label>Année de sortie :</label>
                    <input type="number" class="form-control" name ="annee_sortie_fr" value="<?= $detFilm["annee_sortie_fr"]?>">
                </div>
                <div class="form-group">
                    <label>Durée (en minutes) :</label>
                    <input type="number" class="form-control" name ="duree" value="<?= $detFilm["duree"]?>">
                </div>
                <div class="form-group">
                    <label>Réalisé par :</label>
                    <select class="form-control" name="realisateur" id="realisateur-select">
                        <option value="realisateur"><?=$detFilm["realisateur"]?></option>
                            <?php foreach($choixReal->fetchAll() as $real){ ?>
                                <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                            <?php 
                            } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Genre :</label>
                    <select class="form-control" name="genre" id="genre-select">
                            <?php foreach($requeteGenreFilm->fetchAll() as $genre){ ?> 
                                <option value="<?=$genre["id_genre"]?>"><?=$genre["nom"]?></option>
                            <?php 
                            } ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Note sur 5 :</label>
                    <input type="number" class="form-control" name="note" value="<?= $detFilm["note"]?>">
                </div>
                <div class="form-group">
                    <label>Résumé :</label>
                        <textarea class="form-control" name="synopsis" row="4" ><?= $detFilm["synopsis"] ?></textarea>
                </div>             
                <?php
        }
        ?>
        <button type="submit" class="btn btn-secondary">Modifier le film</button>

        </form>
    </section>

<?php 

$titre= "Modifier le film";
$titre_secondaire = "Modifier le film";
$contenu = ob_get_clean();

require_once "view/template.php";