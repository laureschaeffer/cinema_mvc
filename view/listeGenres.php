<?php ob_start(); // lien avec le fichier template.php ?>

<div class="listing-genre">
    <ul>
    <?php
        //listes des genres de films
        foreach($genres as $genre) { ?>
                <li><a href="index.php?action=detailGenre&id=<?=$genre["id_genre"]?>" aria-label="liste films du genre"><?= $genre["nom"] ?></a></li>
                <?php } ?>
                
    </ul>
            </div>
<div class="form-btn">
    <button><a href="index.php?action=formGenre">Ajouter un genre</a></button>
</div>
<?php
$description="Voilà la liste de tous les gens présents sur notre site.";
$titre= "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();

require_once "view/template.php";