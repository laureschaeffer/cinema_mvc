<?php ob_start(); // lien avec le fichier template.php ?>

    <section class="detail">
        <?php foreach($requeteReal->fetchAll() as $real) {
            //condition pour savoir comment accorder la phrase
            if($real["sexe"] =="femme"){
                $accord="née le ";
            } else {
                $accord="né le ";
            }
            ?>
            <div class="card-header">
                <figure><img src="<?=$real["photo"]?>" alt="photo du réalisateur" width=200px></figure>
                <div class="card-info">
                    <p><?= $real["nomReal"].', '.$accord.$real["date_naissance"]?></p> 
                    <div class="filmographie">
                        <h4>Filmographie</h4>
                        <?php foreach($realFilmographie->fetchAll() as $filmo){
                            // liste de la filmographie avec un lien qui redirige vers le détail du film
                            ?> <ul>
                                <li><a href="index.php?action=detailFilm&id=<?=$filmo["id_film"]?>"><?=$filmo["titre"].' ('.$filmo["annee_sortie_fr"].')'?></a></li>
                            </ul>
                       <?php } ; 
                       ?>
                    </div>

                </div>
            </div>
            <p><?=$real["biographie"] ?></p> 
            <?php } ;
            ?>
    </section>

<?php 

$description="Page dédiée au réalisateur, contenant ses infos principales";
$titre= "Détail réalisateur";
$titre_secondaire = $real["nomReal"];
$contenu = ob_get_clean();

require_once "view/template.php";