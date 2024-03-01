<?php
// fichier formulaire d'ajout d'un genre

ob_start();
?>

<section class="formulaire">
    <!-- action: rediriger vers la fonction dans le controleur -->
    <form action="index.php?action=ajoutGenre" method="post" enctype="multipart/form-data"> 
        <p><label>Nom :</label></p>
        <input type="text" class="form-control" name="nom" placeholder="Nom" required>
        <p><button type="submit" name="submit" class="btn btn-secondary">Soumettre le genre</button></p>
    </form>
</section>

<?php
$description="Ajoutez un genre manquant à notre site.";
$titre="Formulaire ajouter un genre";
$titre_secondaire = "Ajouter un genre";
$contenu= ob_get_clean();

require_once "view/template.php";