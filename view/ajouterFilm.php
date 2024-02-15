<?php
// fichier formulaire

ob_start();
?>

<section id="ajouterFilm">
    <form action="index.php?action=ajouterFilm" method="post" enctype="multipart/form-data">
        <p>
            <label>
                Nom du film :
                <input type="text" name="nom">
            </label>
        </p>
        <p>
            <label>
                Année de sortie :
                <input type="text" name="anneeSortie">
            </label>
        </p>

        <p>
            <label>
                <textarea name="resume" rows="4" cols="50">Résumé</textarea>
            </label>
        </p>
        <p>
            <label for="file">
                <input type="file" name="file"/>
            </label>
        </p>
        <p>
            <input type="submit" name="submit" value="Soumettre le film">
        </p>




    </form>
</section>

<?php

$titre="Formulaire ajouter un film";
$titre_secondaire = "Ajouter un film";
$contenu= ob_get_clean();

require_once "view/template.php";