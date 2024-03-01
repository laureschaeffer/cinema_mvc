<?php
// fichier formulaire d'ajout d'acteur

ob_start();
?>


<!-- acteur  -->
<section class="formulaire">
    <!-- action: rediriger vers la fonction dans le controleur -->
    <form action="index.php?action=ajoutAct" method="post" enctype="multipart/form-data"> 
        <p><label>Nom :</label></p>
        <input type="text" name="nom" placeholder="Nom" required>
        <p><label>Prenom :</label></p>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <p><label>Sexe :</label></p>
        <input type="text" name="sexe" placeholder="sexe" required>
        <p><label>Date de naissance :</label></p>
        <input type="date" name="anniversaire" required>
        <p><label>Biographie</label></p>
        <textarea name="biographie" rows="4"></textarea>

        <p><label for="file">Ajouter une photo, format autorisé: jpg, jpeg, gif</label></p>
        <input type="file" name="file" class="form-control-file">
        
        <p><button type="submit" name="submit" class="ajout">Soumettre l'acteur</button></p>



    </form>
</section>

<?php
$description="Nous vous proposons un formulaire pour ajouter votre acteur ou actrice préféré dans notre base de données.";
$titre="Formulaire ajouter un acteur";
$titre_secondaire = "Ajouter un acteur";
$contenu= ob_get_clean();

require_once "view/template.php";