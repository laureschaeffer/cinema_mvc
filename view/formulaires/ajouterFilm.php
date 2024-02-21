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
                <select class="form-control" name="genre[]" id="genre-select" multiple>
                    <?php foreach($choixGenre->fetchAll() as $genre){ ?>
                        <option value="<?=$genre["id_genre"]?>"><?=$genre["nom"]?></option> <?php
                    }
            ?>
                </select>
            </label>
        </div>
        <div class="form-group">
            <label>Resumé</label>
            <textarea class="form-control" name="resume" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="file">Ajouter une affiche, format autorisé: jpg, jpeg, gif</label>
            <input type="file" class="form-control-file">
        </div>
        <button type="submitFilm" class="btn btn-secondary">Soumettre le film</button>


    </form>
</section>

<section class="formulaireReal">
    <!-- action: rediriger vers la fonction dans le controleur -->
    <form action="index.php?action=" method="post" enctype="multipart/form-data"> 
        <!-- ajouter l'action  -->
        <div class="form-group">
            <label>Nom :</label>
            <input type="text" class="form-control" name="nom" placeholder="Nom">
        </div>
        <div class="form-group">
            <label>Prenom :</label>
            <input type="text" class="form-control" name="prenom" placeholder="Prénom">
        </div>
        <div class="form-group">
            <label>Sexe :</label>
            <input type="text" class="form-control" name="sexe" placeholder="sexe">
        </div>

        <div class="form-group">
            <label>Date de naissance </label>
            <input type="date" class="form-control" name="anniversaire">
        </div>

        <div class="form-group">
            <label for="file">Ajouter une photo, format autorisé: jpg, jpeg, gif</label>
            <input type="file" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Biographie</label>
            <textarea class="form-control" name="biographie" rows="4"></textarea>
        </div>
        
        <button type="submitReal" class="btn btn-secondary">Soumettre le réalisateur</button>



    </form>
</section>

<?php

$titre="Formulaire ajouter un film";
$titre_secondaire = "Ajouter un film";
$contenu= ob_get_clean();

require_once "view/template.php";