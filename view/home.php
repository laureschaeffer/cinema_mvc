<?php ob_start() ; //temporisation de sortie ?>

<section id="home-container">
    <div id="intro">
        <p>Cinéphile est un site web francophone culturel. Le site propose de découvrir, de noter et d'écrire des critiques d'œuvres culturelles appartenant aux domaines du cinéma.</p>
        <div class="subscribe">
            <p>Inscrivez-vous à la newsletter</p>
            <form class="subscribe-btn">
                <input type="text" placeholder="Votre e-mail">
                <button type="submit">Valider</button>
            </form>
    </div>
    </div>
    <div id="coup-de-coeur">
        <h4>Notre coup de coeur</h4>
        <div class="card-movie">
            <div class="card-header">
                <figure>
                    <img src="public/img/affiches/winterbreak.webp" alt="affiche film winter break">
                </figure>
                <div class="card-info">
                    <p><span class="titre-movie"><a href="index.php?action=detailFilm&id=10">Winter Break,</a></span>4,1/5</p>
                    <p class="date-movie">13 décembre 2023</p>
                    <p>De <span class="real-movie"><a href="index.php?action=detailReal&id=8">Alexander Payne</a></span></p>
                </div>
            </div>
            <p class="resume">Un instructeur maussade d'une école préparatoire de la Nouvelle-Angleterre reste sur le campus pendant les vacances de Noël pour garder une poignée d'étudiants qui n'ont nulle part où aller.</p>
        </div>
    </div>
</section>
<div id="parallax">
    <h3>Sorties récentes</h3>
</div>
<section id="sortie-recente">
    <div id="movie1">
        <div class="card-movie">
            <div class="card-header">
                <figure><img src="public/img/affiches/laBete.jpg" alt="affiche film la bete"></figure>
                <div class="card-info">
                    <p><span class="titre-movie">La bete, </span>3/5</p>
                    <p class="date-movie">7 février 2024</p>
                    <p>De <span class="real-movie">Bertrand Bonello</span></p>
                </div>
            </div>
            <p class="resume">Dans un futur proche où règne l’intelligence artificielle, les émotions humaines sont devenues une menace. Pour s'en débarrasser, Gabrielle doit purifier son ADN en replongeant dans ses vies antérieures. Elle y retrouve Louis, son grand amour. Mais une peur l'envahit, le pressentiment qu'une catastrophe se prépare.</p>
        </div>
    </div>
    <div id="movie2">
        <div class="card-movie">
            <div class="card-header">
                <figure><img src="public/img/affiches/greenBorder.jpg" alt="affiche film green border"></figure>
                <div class="card-info">
                    <p><span class="titre-movie">Green Border, </span>3.3/5</p>
                    <p class="date-movie">7 février 2024</p>
                    <p>De <span class="real-movie">Agnieszka Holland</span></p>
                </div>
            </div>
            <p class="resume">Ayant fui la guerre, une famille syrienne entreprend un éprouvant périple pour rejoindre la Suède. A la frontière entre le Belarus et la Pologne, synonyme d'entrée dans l'Europe, ils se retrouvent embourbés avec des dizaines d'autres familles, dans une zone marécageuse, à la merci de militaires aux méthodes violentes. </p>
        </div>
    </div>
    <div id="movie3">
        <div class="card-movie">
            <div class="card-header">
                <figure><img src="public/img/affiches/daali.jpg" alt="affiche film Daaaaaali"></figure>
                <div class="card-info">
                    <p><span class="titre-movie">DAAAAAALI !, </span>3.4/5</p>
                    <p class="date-movie">7 février 2024</p>
                    <p>De <span class="real-movie">Quentin Dupieux</span></p>
                </div>  
            </div>
            <p class="resume">Une journaliste française rencontre Salvador Dali à plusieurs reprises pour un projet de documentaire.</p>
        </div>
    </div>

</section>
<section id="citations">
    <div class="card-citation">
        <p class="citation">Le cinéma, c'est un oeil ouvert sur le monde.</p>
        <p class="citation-auteur">- Joseph Bédier</p>
    </div>
    <div class="card-citation">
        <p class="citation">Le cinéma est le lieu du réel et de la vie.</p>
        <p class="citation-auteur">- Patrice Chéreau</p>
    </div>
    <div class="card-citation">
        <p class="citation">Le cinéma, ce n'est pas une reproduction de la réalité, c'est un oubli de la réalité. Mais on si enregistre cet oubli, on peut alors se souvenir et peut-être parvenir au réel.</p>
        <p class="citation-auteur">- Jean-Luc Godard</p>
    </div>
</section>
<h3>TOP Acteurs du moment</h3>
<section id="acteurs-moment">
    <!-- 4 acteurs précisés dans la requete du controleur  -->
    <?php foreach($requeteHomeActeur->fetchAll() as $acteur){ ?>
        <div class="card-acteur">
            <figure><img src="<?=$acteur["photo"]?>" alt="photo de l'acteur"></figure>
            <p><a href="index.php?action=detailActeur&id=<?=$acteur["id_personne"]?>"><?= $acteur["acteur"]?></a></p>
            <p><?=$acteur["biographie"]?> </p>
        </div>
            <?php
               }
               ?>
</section>



<?php
$description="Découvrez un monde de magie cinématographique, plongez dans une collection d'actualités et analyses de films plus anciens. Que vous soyez un cinéphile passionné ou un novice curieux, notre plateforme vous offre une expérience pour explorer et apprécier le cinéma.";
$titre= "Page d'accueil";
$titre_secondaire = "Cinéphile";
$contenu = ob_get_clean();

require_once "view/template.php";