<?php ob_start(); //temporisation de sortie

?>

<section class="formulaire">
    <form action="index.php?action=ajouterModifAct&id=<?=$acteurs["id_personne"]?>" method="post" enctype="multipart/form-data">
        <img src="<?=$acteurs["photo"]?>" alt="photo de l'acteur">
        <p><label for="file">Modifier la photo</label></p>
        <p><input type="file" name="file"></p>
        <p><label>Nom:</label></p>
        <input type="text" name="prenom" value="<?=$acteurs["nom"]?>">
        <p><label>Prénom:</label></p>
        <input type="text" name="nom" value="<?=$acteurs["prenom"]?>">
        <p><label>Sexe:</label></p>
        <input type="text" name="sexe" value="<?=$acteurs["sexe"]?>">
        <p><label>Date de naissance :</label></p>
        <input type="date" name="anniversaire">
        <p><label>Biographie</label></p>
        <textarea name="biographie" rows="4" cols="60"><?=$acteurs["biographie"]?></textarea>

        <p><button type="submit" name="submit" class="ajout">Modifier l'acteur</button></p>

    </form>
</section>

<?php
$description="Nous vous proposons un formulaire pour modifier votre acteur ou actrice préféré dans notre base de données.";
$titre="Formulaire modifier l'acteur";
$titre_secondaire = "Modifier l'acteur";
$contenu= ob_get_clean();

require_once "view/template.php";