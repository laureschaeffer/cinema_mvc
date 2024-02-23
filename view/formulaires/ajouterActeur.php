<?php
// fichier formulaire d'ajout d'acteur

ob_start();
?>


<!-- acteur  -->
<section class="formulaireActeur">
    <!-- action: rediriger vers la fonction dans le controleur -->
    <form action="index.php?action=ajoutAct" method="post" enctype="multipart/form-data"> 
        <div class="form-group">
            <label>Nom :</label>
            <input type="text" class="form-control" name="nom" placeholder="Nom" required>
        </div>
        <div class="form-group">
            <label>Prenom :</label>
            <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
        </div>
        <div class="form-group">
            <label>Sexe :</label>
            <input type="text" class="form-control" name="sexe" placeholder="sexe" required>
        </div>

        <div class="form-group">
            <label>Date de naissance :</label>
            <input type="date" class="form-control" name="anniversaire" required>
        </div>
        <div class="form-group">
            <label>Biographie</label>
            <textarea class="form-control" name="biographie" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="file">Ajouter une photo, format autorisé: jpg, jpeg, gif</label>
            <input type="file" name="file" class="form-control-file">
        </div>
        
        <button type="submit" name="submit" class="btn btn-secondary">Soumettre l'acteur</button>



    </form>
</section>

<?php
$description="Nous vous proposons un formulaire pour ajouter votre acteur ou actrice préféré dans notre base de données.";
$titre="Formulaire ajouter un acteur";
$titre_secondaire = "Ajouter un acteur";
$contenu= ob_get_clean();

require_once "view/template.php";