<?php ob_start(); // lien avec le fichier template.php ?>


        <section class="detail">
        <?php foreach($requeteActeur->fetchAll() as $acteur) { ?>
            <div class="detail-header">
                <p><?= $acteur["nomActeur"] ?></p> 
                <p><?= $acteur["date_naissance"]?></p> 
                
            </div>
            <div class="detail-main">
                <div class="biographie">
                    <!-- biographie  -->
                </div>
                <img src="<?=$acteur["photo"]?>" alt="photo de l'acteur">
                 
            </div>
    </section>

<?php  }

$titre= "Détail Acteur";
$titre_secondaire = $acteur["nomActeur"];
$contenu = ob_get_clean();

require_once "view/template.php";