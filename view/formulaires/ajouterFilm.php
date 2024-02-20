<?php
// fichier formulaire d'ajout

ob_start();
?>

<section class="formulaireFilm">
    <!-- action: rediriger vers la fonction dans le controleur -->
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
                <input type="number" name="anneeSortie" value="2024">
            </label>
        </p>
        <p>
            <label>
                Durée (en minute) :
                <input type="number" name="duree" value="120">
            </label>
        </p>
        <p>
            <label>
                Note sur 5 :
                <input type="number" name="note" value="0">
            </label>
        </p>
        <p>
            <label>
                Choissiez un réalisateur :
                <select name="realisateur" id="realisateur-select">
                    <option value="realisateur">----réalisateur----</option>
                    <?php foreach($choixReal->fetchAll() as $real){ ?>
                        <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                    <?php 
                    } ?>
                </select>
            </label>
        </p>
        <p>
            <label>Choisissez un genre :
                <select name="genre" id="genre-select">
                    <option value="genre">----genre----</option>
                    <?php foreach($choixGenre->fetchAll() as $genre){ ?>
                        <option value="<?=$genre["nom"]?>"><?=$genre["nom"]?></option> <?php
                    }
            ?>
                </select>
            </label>
        </p>
        <p>
            <label>
                <textarea name="resume" rows="4" cols="50" >Résumé</textarea>
            </label>
        </p>
        <!-- <p>
            <label>
                Nom du rôle:
                <input type="text" name="role">
            </label>
        </p> -->
        <p>
            <label for="file"> Ajouter une affiche, format autorisé: jpg, jpeg, gif
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