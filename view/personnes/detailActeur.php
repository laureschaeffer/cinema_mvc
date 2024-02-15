<?php ob_start(); // lien avec le fichier template.php ?>

        <section class="detail">
        <?php foreach($requeteActeur->fetchAll() as $acteur) { 
            //condition pour savoir comment accorder la phrase
            if($acteur["sexe"] =="femme"){
                $accord="née le ";
            } else {
                $accord="né le ";
            }
            ?>
            <div class="detail-header">
                <p><?= $acteur["nomActeur"].', '.$accord.$acteur["date_naissance"]?></p> 
                
            </div>
            <div class="detail-main">
                <img src="<?=$acteur["photo"]?>" alt="photo de l'acteur" width=200px >
                <div class="biographie">
                    <p>
                        <?=$acteur["biographie"]?>
                    </p>
                </div>
                <div class="fimographie">
                    <h3>Filmographie</h3>
                    <?php foreach($acteurFilmographie->fetchAll() as $filmo){
                        // liste de la filmographie avec un lien qui redirige vers le détail du film
                        ?> <ul>
                            <li>
                                <a href="index.php?action=detailFilm&id=<?=$filmo["id_film"]?>"> <?= $filmo["titre"] ?> </a> dans le rôle de <a href="index.php?action=listeRole&id=<?=$filmo["id_role"]?>"> <?=$filmo["nom_personnage"]?> </a>
                            </li>
                        </ul>
                    <?php 
                    } ?>
                </div>
                 
            </div>
    </section>

<?php  }

$titre= "Détail Acteur";
$titre_secondaire = $acteur["nomActeur"];
$contenu = ob_get_clean();

require_once "view/template.php";