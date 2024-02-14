<?php ob_start(); // lien avec le fichier template.php ?>

        <section class="detail">
        <?php foreach($requeteActeur->fetchAll() as $acteur) { 
            //condition pour savoir comment accorder la phrase
            if($acteur["sexe"] =="femme"){
                $accord="Née le ";
            } else {
                $accord="Né le ";
            }
            ?>
            <div class="detail-header">
                <p><?= $acteur["nomActeur"] ?></p> 
                <p><?=$accord.$acteur["date_naissance"]?></p> 
                
            </div>
            <div class="detail-main">
                <div class="biographie">
                    <p>
                        <?=$acteur["biographie"]?>
                    </p>
                </div>
                <img src="<?=$acteur["photo"]?>" alt="photo de l'acteur" height=200px width=200px >
                 
            </div>
    </section>

<?php  }

$titre= "Détail Acteur";
$titre_secondaire = $acteur["nomActeur"];
$contenu = ob_get_clean();

require_once "view/template.php";