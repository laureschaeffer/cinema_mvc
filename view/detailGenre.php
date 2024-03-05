<?php
ob_start(); //temporisation de sortie 

//si le genre est utilisé pour définir un film, en faire la liste, sinon renvoyer que la table est vide
if($genres){ ?>
    <section class="listing-genre">
    <h3>Films du genre</h3>
    <ul>
    <?php foreach($genres as $genre){
        ?>
            <li><a href="index.php?action=detailFilm&id=<?=$genre["id_film"]?>" aria-label="liste films du genre"><?=$genre["titre"].' ('.$genre["annee_sortie_fr"].')'?></a></li>
            <?php }
    ?>
    </ul>
</section>
<?php
} else{ ?>
    <section class="listing-genre">
    <h3>Films du genre</h3>
    <ul>
        <li>Aucun film de la categorie</li>
    </ul>
    
</section>
<?php
}
   



$description="Liste des films du genre";
$titre="Détail genre";
$titre_secondaire = "genre";
$contenu = ob_get_clean();

require_once "view/template.php";