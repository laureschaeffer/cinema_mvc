<?php
// fichier formulaire d'ajout de realisateur

ob_start();
?>

<section class="formulaire">
    <!-- action: rediriger vers la fonction dans le controleur -->
    <form action="index.php?action=ajoutReal" method="post" enctype="multipart/form-data"> 
        <p><label>Nom :</label></p>
        <input type="text" class="form-control" name="nom" placeholder="Nom" required>
        <p><label>Prenom :</label></p>
        <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
        <p><label>Sexe :</label></p>
        <input type="text" class="form-control" name="sexe" placeholder="sexe" required>
        <p><label>Date de naissance :</label></p>
        <input type="date" class="form-control" name="anniversaire" required>
        <p><label>Biographie</label></p>
        <textarea class="form-control" name="biographie" rows="4"></textarea>
        <p><label for="file">Ajouter une photo, format autorisé: jpg, jpeg, gif</label></p>
        <input type="file" name="file" class="form-control-file">
        
        <p><button type="submit" name="submit" class="btn btn-secondary">Soumettre le réalisateur</button></p>



    </form>
</section>

<?php
$description="Nous vous proposons un formulaire pour ajouter votre réalisateur ou réalisatrice préféré dans notre base de données." ;
$titre="Formulaire ajouter un realisateur";
$titre_secondaire = "Ajouter un realisateur";
$contenu= ob_get_clean();

require_once "view/template.php";