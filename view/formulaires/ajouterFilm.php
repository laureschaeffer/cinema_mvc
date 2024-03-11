<?php
// fichier formulaire d'ajout

ob_start();
?>

<section class="formulaire">
    <form action="index.php?action=ajouterFilm" method="post" enctype="multipart/form-data">
        <p><label>Nom du film :</label></p>
        <input type="text" name="titre" placeholder="Titre" required>
        <p><label>Année de sortie :</label></p>
        <input type="number" name="anneeSortie" placeholder="Année de sortie" required>
        <p><label>Durée (en minute) :</label></p>
        <input type="number" name="duree" placeholder="Durée" required>
        <p><label>Note sur 5 :</label></p>
        <input type="number" name="note" placeholder="Note" required>

        <p><label>Choissiez un réalisateur :</label></p>
        <select name="realisateur" id="realisateur-select">
            <!-- select des realisateurs (un seul choix)  -->
            <?php foreach($choixReal as $real){ ?>
                    <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                <?php 
                } ?>
        </select>
        <p><label>Choisissez un genre :</label></p> 
        <!-- checkbox des genres  -->
        <?php foreach($choixGenre as $genre){ ?>
            <p><input type="checkbox" id="<?=$genre["nom"]?>" name="genres[]" value="<?=$genre["id_genre"]?>" required/>
            <label for="<?=$genre["nom"]?>"><?=$genre["nom"]?></label> </p>  
                <?php
            }
            ?> 
      
        <p><label>Resumé</label></p>
        <textarea name="resume" rows="4" placeholder="Synopsis"></textarea>

        <p><label for="file">Ajouter une affiche, format autorisé: jpg, jpeg, gif</label></p>
        <input type="file" name="file" >
        <p><button type="submit" name="submit" class="ajout" >Soumettre le film</button></p>


    </form>
</section> 





<?php
$description="Nous vous proposons un formulaire pour ajouter votre film préféré dans notre base de données.";
$titre="Formulaire ajouter un film";
$titre_secondaire = "Ajouter un film";
$contenu= ob_get_clean();

require_once "view/template.php";