<?php
// fichier formulaire d'ajout de realisateur

ob_start();
?>

<section class="formulaireFilm">
    <!-- action: rediriger vers la fonction dans le controleur -->
    <form action="index.php?action=" method="post" enctype="multipart/form-data"> 
        <!-- ajouter l'action  -->
        <div class="form-group">
            <div class="form-group">
                <label>Nom :</label>
                    <input type="text" class="form-control" name="nom" placeholder="Nom">
            </div>
            <label>Prenom :</label>
                <input type="text" class="form-control" name="prenom" placeholder="Prénom">
        </div>
        <div class="form-group">
            <label>Sexe :</label>
                <input type="text" class="form-control" name="sexe" placeholder="sexe">
        </div>

        <div class="form-group">
            <label>Date de naissance </label>
                <input type="number" class="form-control" name="note" value="0">
        </div>

        <div class="form-group">
            <label for="file">Ajouter une photo, format autorisé: jpg, jpeg, gif</label>
            <input type="file" class="form-control-file">
        </div>
        <div class="form-group">
            <label>Biographie</label>
            <textarea class="form-control" name="biographie" rows="4"></textarea>
        </div>
        
        <button type="submit" class="btn btn-secondary">Soumettre le réalisateur</button>



    </form>
</section>

<?php

$titre="Formulaire ajouter un realisateur";
$titre_secondaire = "Ajouter un realisateur";
$contenu= ob_get_clean();

require_once "view/template.php";