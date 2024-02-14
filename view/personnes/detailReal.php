<?php ob_start(); // lien avec le fichier template.php ?>

    <section class="detail">
        <?php foreach($requeteReal->fetchAll() as $real) { ?>
            <div class="detail-header">
                <p><?= $real["nomReal"] ?></p> 
                <p><?= $real["date_naissance"]?></p>  
            </div>
            <div class="detail-main">
                <div class="biographie">
                    <!-- biographie  -->
                </div>
                <img src="<?=$real["photo"]?>" alt="photo du réalisateur" width=200px height=200px>
            </div>
    </section>

<?php }

$titre= "Détail réalisateur";
$titre_secondaire = $real["nomReal"];
$contenu = ob_get_clean();

require_once "view/template.php";