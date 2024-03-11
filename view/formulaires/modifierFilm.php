<?php ob_start(); // lien avec le fichier template.php
 
?>

    <section class="formulaire">
            <form action="index.php?action=ajouterModification&id=<?=$requeteDetailFilm["id_film"]?>" method="post" enctype="multipart/form-data">
                <img src="<?=$requeteDetailFilm["affiche"]?>" alt="affiche du film">
                <p><label for="file">Modifier l'affiche</label></p>
                <p><input type="file" name="file"></p>
                <p><label>Nom du film:</label></p>
                <input type="text" name="titre" value="<?= $requeteDetailFilm["titre"]?>">

                
                <p><label>Année de sortie :</label></p>
                <input type="number" name="annee_sortie_fr" value="<?= $requeteDetailFilm["annee_sortie_fr"]?>">
                
                <p><label>Durée (en minutes) :</label></p>
                <input type="number" name ="duree" value="<?= $requeteDetailFilm["duree"]?>">
                
                <p><label>Réalisé par :</label></p>
                <!-- select des realisateurs (un seul choix)  -->
                <select name="realisateur" id="realisateur-select">
                    <option value="realisateur"><?=$requeteDetailFilm["realisateur"]?></option>
                        <?php foreach($choixReal as $real){ ?>
                            <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                        <?php 
                        } ?>
                </select>
                
                <p><label>Genre :</label></p>
                <!-- checkbox des genres  -->
                <?php foreach($genres as $genre){ ?> 
                <p><input type="checkbox" id="<?=$genre["nom"]?>" name="genres[]" value="<?=$genre["id_genre"]?>"/>
                <label for="<?=$genre["nom"]?>"><?=$genre["nom"]?></label> </p>  
                <?php
                    } ?>

                <p><label>Note sur 5 :</label></p>
                <input type="number" name="note" value="<?= $requeteDetailFilm["note"]?>">    
                <p><label>Résumé :</label></p>
                <textarea name="synopsis" row="4" cols="40"><?= $requeteDetailFilm["synopsis"] ?></textarea>             
                <?php
                
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