<?php ob_start(); // lien avec le fichier template.php 
?>

    <section class="detail">
        <?php 
            //condition pour savoir comment accorder la phrase
            if($realisateurs["sexe"] =="femme"){
                $accord="née le ";
            } else {
                $accord="né le ";
            }
            ?>
            <div class="card-header">
                <figure><img src="<?=$realisateurs["photo"]?>" alt="photo du réalisateur"></figure>
                <div class="card-info">
                    <p><?= $realisateurs["nomReal"].', '.$accord.$realisateurs["date_naissance"]?></p> 
                    <div class="filmographie">
                        <h4>Filmographie</h4>
                        <?php foreach($films as $filmo){
                            // liste de la filmographie avec un lien qui redirige vers le détail du film
                            ?> <ul>
                                <li><a href="index.php?action=detailFilm&id=<?=$filmo["id_film"]?>" aria-label="detail du film"><?=$filmo["titre"].' ('.$filmo["annee_sortie_fr"].')'?></a></li>
                            </ul>
                       <?php } ; 
                       ?>
                    </div>

                </div>
                <div class="modifications">
                    <a href="index.php?action=modifierReal&id=<?=$realisateurs["id_personne"]?>" aria-label="apporter une modification"><i class="fa-solid fa-pen"></i>Modifier</a>
                    <a href="index.php?action=supprimerReal&id=<?=$realisateurs["id_realisateur"]?>" class="supprimer"><i class="fa-solid fa-trash"></i>Supprimer</a>
                </div>
            </div>
            <div class="biographie">
                <p><?=$realisateurs["biographie"] ?></p> 
            </div>
            
    </section>

<?php 

$description="Page dédiée au réalisateur, contenant ses infos principales";
$titre= "Détail réalisateur";
$titre_secondaire = $realisateurs["nomReal"];
$contenu = ob_get_clean();

require_once "view/template.php";