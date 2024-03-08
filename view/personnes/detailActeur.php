<?php ob_start(); // lien avec le fichier template.php 
var_dump($acteurs); die;
   ?>

        <section class="detail">
        <?php  
            //condition pour savoir comment accorder la phrase
            if($acteurs["sexe"] =="femme"){
                $accord="née le ";
            } else {
                $accord="né le ";
            }
            ?>
            <div class="card-header">
                <figure><img src="<?=$acteurs["photo"]?>" alt="photo de l'acteur"></figure>
                <div class="card-info">
                    <p><?= $acteurs["nomActeur"].', '.$accord.$acteurs["date_naissance"]?></p> 
                    <div class="filmographie">
                        <h4>Filmographie</h4>
                        <ul>
                        <?php foreach($films as $filmo){
                            // liste de la filmographie avec un lien qui redirige vers le détail du film
                            ?>
                            <li><a href="index.php?action=detailFilm&id=<?=$filmo["id_film"]?>" aria-label="detail du film"> <?=$filmo["titre"] ?> </a> dans le rôle de <a href="index.php?action=listeRole&id=<?=$filmo["id_role"]?>" aria-label="detail du film"> <?=$filmo["nom_personnage"]?></a></li>
                            
                            <?php  }
                ?>
                    </div>
                    </ul>
                </div>
            </div>
            <p><?=$acteurs["biographie"]?></p>
            <div class="form-btn">
                <button><a href="index.php?action=modifierActeur&id=<?=$acteurs["id_personne"]?>" aria-label="apporter une modification">Apporter une modification</a></button>
            </div>
            <a href="index.php?action=supprimerActeur&id=<?=$acteurs["id_personne"]?>" class="supprimer"><i class="fa-solid fa-trash"></i>Supprimer</a>
            
        </section>
<?php

$description="Page dédiée à l'acteur ".$acteurs["nomActeur"].", contenant ses infos principales";
$titre= "Détail Acteur";
$titre_secondaire = $acteurs["nomActeur"];
$contenu = ob_get_clean();

require_once "view/template.php";