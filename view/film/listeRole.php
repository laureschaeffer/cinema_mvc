<?php ob_start(); // lien avec le fichier template.php ?>

<section class="detail">
    <h3>Rôles dans leur film </h3>
    <?php foreach($requeteRole->fetchAll() as $role){ ?>
        <p>Le rôle de <?=$role["nom_personnage"]?> a été interprété par <a href="index.php?action=detailActeur&id=<?=$role["id_acteur"]?>" aria-label="detail acteur"><?=$role["nomActeur"]?></a> dans le film <a href="index.php?action=detailFilm&id=<?=$role["id_film"]?>"><?=$role["titre"].' ('.$role["annee_sortie_fr"].')'?></a></p>
        <?php
    } ?>
    
</section>

<?php
$description="Détail du role".$role["nom_personnage"]."joué par leurs acteurs dans différents films.";
$titre= "Roles";
$titre_secondaire = $role["nom_personnage"];
$contenu = ob_get_clean();

require_once "view/template.php";
