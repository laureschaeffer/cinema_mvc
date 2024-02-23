<?php
// fichier formulaire d'ajout

ob_start();
?>

<section class="formulaireFilm">
    <form action="index.php?action=ajouterFilm" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nom du film :</label>
                <input type="text" class="form-control" name="nom" placeholder="Titre" required>
        </div>
        <div class="form-group">
            <label>Année de sortie :</label>
                <input type="number" class="form-control" name="anneeSortie" placeholder="Année de sortie">
        </div>
        <div class="form-group">
            <label>Durée (en minute) :</label>
                <input type="number" class="form-control" name="duree" placeholder="Durée">
        </div>

        <div class="form-group">
            <label>Note sur 5 :</label>
                <input type="number" class="form-control" name="note" placeholder="Note">
        </div>

        <div class="form-group">
            <label>Choissiez un réalisateur :</label>
            <select class="form-control" name="realisateur" id="realisateur-select">
                <?php foreach($choixReal->fetchAll() as $real){ ?>
                    <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                <?php 
                } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Choisissez un genre :</label> <br>
        <?php foreach($choixGenre->fetchAll() as $genre){ ?>
            <input type="checkbox" id="<?=$genre["nom"]?>" name="genres[]" value="<?=$genre["id_genre"]?>"/>
            <label for="<?=$genre["nom"]?>"><?=$genre["nom"]?></label> <br>   
                <?php
            }
            ?>

        
        <div class="form-group">
            <label>Resumé</label>
            <textarea class="form-control" name="resume" rows="4" placeholder="Synopsis"></textarea>
        </div>

        <div class="form-group">
            <label for="file">Ajouter une affiche, format autorisé: jpg, jpeg, gif</label>
            <input type="file" name="file" class="form-control-file">
        </div>
        <button type="submit" name="submit" class="btn btn-secondary">Soumettre le film</button>


    </form>
</section> 





<?php
$description="Nous vous proposons un formulaire pour ajouter votre film préféré dans notre base de données.";
$titre="Formulaire ajouter un film";
$titre_secondaire = "Ajouter un film";
$contenu= ob_get_clean();

require_once "view/template.php";