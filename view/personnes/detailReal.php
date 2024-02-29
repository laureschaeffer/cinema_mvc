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
            <div class="detail-card">
                <figure><img src="<?=$real["photo"]?>" alt="photo du réalisateur" width=200px></figure>
                <p><?= $real["nomReal"].', '.$accord.$real["date_naissance"]?></p> 
                <p><?=$real["biographie"] ?></p> 
                <h3>Filmographie</h3>
                <div class="filmographie">
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

$description="Page dédiée au réalisateur, contenant ses infos principales";
$titre= "Détail réalisateur";
$titre_secondaire = $real["nomReal"];
$contenu = ob_get_clean();

require_once "view/template.php";