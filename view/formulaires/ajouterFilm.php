<?php
// fichier formulaire d'ajout

ob_start();
?>

<section class="formulaireFilm">
    <!-- action: rediriger vers la fonction dans le controleur -->
    <form action="index.php?action=ajouterFilm" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nom du film :</label>
                <input type="text" class="form-control" name="nom" placeholder="Titre">
        </div>
        <div class="form-group">
            <label>Année de sortie :</label>
                <input type="number" class="form-control" name="anneeSortie" value="2024">
        </div>
        <div class="form-group">
            <label>Durée (en minute) :</label>
                <input type="number" class="form-control" name="duree" value="120">
        </div>

        <div class="form-group">
            <label>Note sur 5 :</label>
                <input type="number" class="form-control" name="note" value="0">
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
            <label>Choisissez un genre :
                <select class="form-control" name="genre" id="genre-select">
                    <?php foreach($choixGenre->fetchAll() as $genre){ ?>
                        <option value="<?=$genre["nom"]?>"><?=$genre["nom"]?></option> <?php
                    }
            ?>
                </select>
            </label>
        </div>

        <div class="form-group">
            <label>Resumé</label>
            <textarea class="form-control" name="resume" rows="4"></textarea>
        </div>

        <!-- <p>
            <label>
                Nom du rôle:
                <input type="text" name="role">
            </label>
        </p> -->
        <div class="form-group">
            <label for="file">Ajouter une affiche, format autorisé: jpg, jpeg, gif</label>
            <input type="file" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-secondary">Soumettre le film</button>


    </form>
</section>

<?php

$titre="Formulaire ajouter un film";
$titre_secondaire = "Ajouter un film";
$contenu= ob_get_clean();

require_once "view/template.php";