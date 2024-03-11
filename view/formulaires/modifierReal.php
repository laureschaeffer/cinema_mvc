<?php ob_start(); //temporisation de sortie

?>

<section class="formulaire">
    <form action="index.php?action=ajouterModifReal&id=<?=$realisateurs["id_personne"]?>" method="post" enctype="multipart/form-data">
        <img src="<?=$realisateurs["photo"]?>" alt="photo de l'acteur">
        <p><label for="file">Modifier la photo</label></p>
        <p><input type="file" name="file"></p>
        <p><label>Nom:</label></p>
        <input type="text" name="prenom" value="<?=$realisateurs["nom"]?>">
        <p><label>Prénom:</label></p>
        <input type="text" name="nom" value="<?=$realisateurs["prenom"]?>">
        <p><label>Sexe:</label></p>
        <input type="text" name="sexe" value="<?=$realisateurs["sexe"]?>">
        <p><label>Date de naissance :</label></p>
        <input type="date" name="anniversaire" value="<?=$realisateurs["date_naissance"]?>">
        <p><label>Biographie</label></p>
        <textarea name="biographie" rows="4" cols="40"><?=$realisateurs["biographie"]?></textarea>

        <p><button type="submit" name="submit" class="ajout">Modifier l'acteur</button></p>

    </form>
</section>

<?php
$description="Nous vous proposons un formulaire pour modifier votre realisateur ou realisatrice préféré dans notre base de données.";
$titre="Formulaire modifier le realisateur";
$titre_secondaire = "Modifier le realisateur";
$contenu= ob_get_clean();

require_once "view/template.php";