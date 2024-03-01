<?php
// fichier formulaire d'ajout

ob_start();
?>

<section class="formulaire">
    <form action="index.php?action=ajouterFilm" method="post" enctype="multipart/form-data">
        <p><label>Nom du film :</label></p>
        <input type="text" class="form-control" name="nom" placeholder="Titre" required>
        <p><label>Année de sortie :</label></p>
        <input type="number" class="form-control" name="anneeSortie" placeholder="Année de sortie">
        <p><label>Durée (en minute) :</label></p>
        <input type="number" class="form-control" name="duree" placeholder="Durée">
        <p><label>Note sur 5 :</label></p>
        <input type="number" class="form-control" name="note" placeholder="Note">

        <p><label>Choissiez un réalisateur :</label></p>
        <select class="form-control" name="realisateur" id="realisateur-select">
            <?php foreach($choixReal->fetchAll() as $real){ ?>
                    <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                <?php 
                } ?>
        </select>
        <p><label>Choisissez un genre :</label></p> 
        <?php foreach($choixGenre->fetchAll() as $genre){ ?>
            <p><input type="checkbox" id="<?=$genre["nom"]?>" name="genres[]" value="<?=$genre["id_genre"]?>"/>
            <label for="<?=$genre["nom"]?>"><?=$genre["nom"]?></label> </p>  
                <?php
            }
            ?> 
      
        <p><label>Resumé</label></p>
        <textarea class="form-control" name="resume" rows="4" placeholder="Synopsis"></textarea>

        <p><label for="file">Ajouter une affiche, format autorisé: jpg, jpeg, gif</label></p>
        <input type="file" name="file" class="form-control-file">
        <p><button type="submit" name="submit" class="ajout" >Soumettre le film</button></p>


    </form>
</section> 





<?php
$description="Nous vous proposons un formulaire pour ajouter votre film préféré dans notre base de données.";
$titre="Formulaire ajouter un film";
$titre_secondaire = "Ajouter un film";
$contenu= ob_get_clean();

require_once "view/template.php";