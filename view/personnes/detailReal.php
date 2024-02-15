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
            <div class="detail-header">
                <p><?= $real["nomReal"].', '.$accord.$real["date_naissance"]?></p>  
            </div>
            <div class="detail-main">
                <img src="<?=$real["photo"]?>" alt="photo du réalisateur" width=200px>
                <div class="biographie">
                    <p>
                        <?=$real["biographie"] ?>
                    </p>
                </div>
                <div class="filmographie">
                    <h3>Films réalisés :</h3>
                    <?php foreach($realFilmographie->fetchAll() as $filmo){
                        // liste de la filmographie avec un lien qui redirige vers le détail du film
                        ?> <ul>
                            <li><a href="index.php?action=detailFilm&id=<?=$filmo["id_film"]?>"><?=$filmo["titre"].' ('.$filmo["annee_sortie_fr"].')'?></a></li>
                        </ul>
                   <?php } ; 
                   ?>
                </div>
            </div>
            <?php } ;
            ?>
    </section>

<?php 

$titre= "Détail réalisateur";
$titre_secondaire = $real["nomReal"];
$contenu = ob_get_clean();

require_once "view/template.php";