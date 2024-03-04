<?php ob_start(); // lien avec le fichier template.php 
?>

    <section class="formulaire">
        <?php foreach($requeteDetailFilm->fetchAll() as $detFilm) { ?>
            <form action="index.php?action=ajouterModification&id=<?=$detFilm["id_film"]?>" method="post" enctype="multipart/form-data">

                <img src="<?=$detFilm["affiche"]?>" alt="affiche du film" width=200px height=200px>
                <p><label>Nom du film:</label></p>
                <input type="text" name="titre" value="<?= $detFilm["titre"]?>">

                
                <p><label>Année de sortie :</label></p>
                <input type="number" name ="annee_sortie_fr" value="<?= $detFilm["annee_sortie_fr"]?>">
                
                <p><label>Durée (en minutes) :</label></p>
                <input type="number" name ="duree" value="<?= $detFilm["duree"]?>">
                
                <p><label>Réalisé par :</label></p>
                <select name="realisateur" id="realisateur-select">
                    <option value="realisateur"><?=$detFilm["realisateur"]?></option>
                        <?php foreach($choixReal->fetchAll() as $real){ ?>
                            <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                        <?php 
                        } ?>
                </select>
                
                <p><label>Genre :</label></p>
                <?php foreach($requeteGenreFilm->fetchAll() as $genre){ ?> 
                <p><input type="checkbox" id="<?=$genre["nom"]?>" name="genres[]" value="<?=$genre["id_genre"]?>"/>
                <label for="<?=$genre["nom"]?>"><?=$genre["nom"]?></label> </p>  
                <?php
                    } ?>

                <p><label>Note sur 5 :</label></p>
                <input type="number" name="note" value="<?= $detFilm["note"]?>">    
                <p><label>Résumé :</label></p>
                <textarea name="synopsis" row="4" ><?= $detFilm["synopsis"] ?></textarea>             
                <?php
                }
                ?>
                <p><button type="submit" name="submit" class="ajout">Modifier le film</button></p>

        </form>
    </section>

<?php 

$description="Proposez une modification sur un film contenant une erreur." ;
$titre= "Modifier le film";
$titre_secondaire = "Modifier le film";
$contenu = ob_get_clean();

require_once "view/template.php";