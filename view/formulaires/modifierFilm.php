<?php ob_start(); // lien avec le fichier template.php 
?>

    <section class="formulaireFilm">
        <form action="index.php?action=ajouterModification" methode="post" enctype="multipart/form-data">
        <?php foreach($requeteDetailFilm->fetchAll() as $detFilm) { ?>

                <img src="<?=$detFilm["affiche"]?>" alt="affiche du film" width=200px height=200px>
                <p>
                    <label>
                        Nom du film:
                        <input type="text" name="nom" value="<?= $detFilm["titre"]?>">

                    </label>
                </p>
                <p>
                    <label>
                        Année de sortie :
                        <input type="number" name ="anneeSortie" value="<?= $detFilm["annee_sortie_fr"]?>">
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
                        <textarea name="resume" height= "200px"><?= $detFilm["synopsis"] ?></textarea>
                    </label>
                </p>
                <?php
        }
        ?>
            <div class="casting">
                <p>Castings</p>
                <p>
                    <label>
                        <select name="acteur" id="acteur-select">
                            <option value="acteur">----acteur----</option>
                            <?php foreach($choixActeur->fetchAll() as $acteur){ ?>
                            <option value="<?=$acteur["nomActeur"]?>"><?=$acteur["nomActeur"]?></option>
                        <?php 
                            } ?>

                        </select>
                    </label>
                    <label>
                        dans le rôle de
                        <select name="role" id="role-select">
                            <option value="role">----role----</option>
                            <?php foreach($choixRole->fetchAll() as $role){ ?>
                                <option value="<?=$role["id_role"]?>"><?=$role["nom_personnage"]?></option>
                                <?php
                            } ?>
                        </select>
                    </label>
                </p>

            </div>
            <p>
                <input type="submit" name="submit" value="Modifier le film">
            </p>
        </form>
    </section>

<?php 

$titre= "Modifier film";
$titre_secondaire = "Modifier film";
$contenu = ob_get_clean();

require_once "view/template.php";