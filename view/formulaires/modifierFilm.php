<?php ob_start(); // lien avec le fichier template.php 
?>

    <section class="formulaireFilm">
        <?php foreach($requeteDetailFilm->fetchAll() as $detFilm) { ?>
            <form action="index.php?action=ajouterModification&id=<?=$detFilm["id_film"]?>" method="post" enctype="multipart/form-data">

                <img src="<?=$detFilm["affiche"]?>" alt="affiche du film" width=200px height=200px>
                <p>
                    <label>
                        Nom du film:
                        <input type="text" name="titre" value="<?= $detFilm["titre"]?>">

                    </label>
                </p>
                <p>
                    <label>
                        Année de sortie :
                        <input type="number" name ="annee_sortie_fr" value="<?= $detFilm["annee_sortie_fr"]?>">
                    </label>
                </p>
                <p>
                    <label>
                        Durée (en minutes) :
                        <input type="number" name ="duree" value="<?= $detFilm["duree"]?>">
                    </label>
                </p>
                <p>
                    <label>
                        Réalisé par :
                        <select name="realisateur" id="realisateur-select">
                            <option value="realisateur"><?=$detFilm["realisateur"]?></option>
                            <?php foreach($choixReal->fetchAll() as $real){ ?>
                                <option value="<?=$real["id_realisateur"]?>"><?=$real["nomReal"]?></option>
                            <?php 
                            } ?>
                        </select>
                    </label>
                </p>
                <p>
                    <label>
                        Note sur 5 :
                        <input type="number" name="note" value="<?= $detFilm["note"]?>">
                    </label>
                </p>
                <p>
                    <label>
                        Résumé :
                        <textarea name="synopsis" height= "200px"><?= $detFilm["synopsis"] ?></textarea>
                    </label>
                </p>
                <?php
        }
        ?>

            <p>
                <input type="submit" name="submit" value="Modifier le film">
            </p>
        </form>
    </section>

<?php 

$titre= "Modifier le film";
$titre_secondaire = "Modifier le film";
$contenu = ob_get_clean();

require_once "view/template.php";