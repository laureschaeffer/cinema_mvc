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
                    <?php 
                    // si id_real dans requete film est egal à un id_real de la liste, ajoute l'option selected, pour que le bon real soit mis par defaut
                    foreach($choixReal as $r){ 
                        $selected = ($r['id_realisateur'] == $requeteDetailFilm['id_realisateur']) ? 'selected' : '' ; ?>
                        <option value="<?=$r["id_realisateur"]?>" <?=$selected?>><?=$r["nomReal"]?></option>
                        <?php 
                        }  
                        ?>
                </select>
                <p><label>Genre :</label></p>
                <!-- checkbox des genres  -->
                <?php 
                
                //boucle de tous les genres dispo dans la bdd
                foreach($genres as $g){
                    //si dans le tableau idGenres (where id_film=... ) il y a un id, rajoute checked
                    $checked = (in_array($g['id_genre'], $idGenres)) ? 'checked' : ''; ?>
                
                        <p><input type="checkbox" id="<?=$g["nom"]?>" name="genres[]" value="<?=$g["id_genre"]?>" <?= $checked ?> />
                        <label for="<?=$g["nom"]?>"><?=$g["nom"]?></label> </p>  
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