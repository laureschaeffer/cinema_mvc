<?php
ob_start(); //temporisation de sortie ?>

<section class="listing-genre">
    <h3>Films du genre</h3>
    <?php foreach($requeteDetailGenre ->fetchAll() as $genre){
        ?>
        <ul>
            <li><a href="index.php?action=detailFilm&id=<?=$genre["id_film"]?>" aria-label="liste films du genre"><?=$genre["titre"].' ('.$genre["annee_sortie_fr"].')'?></a></li>
        </ul>
    <?php }
    ?>
</section>

<?php

$description="Liste des films du genre";
$titre="Détail genre";
$titre_secondaire = $genre["nom"];
$contenu = ob_get_clean();

require_once "view/template.php";