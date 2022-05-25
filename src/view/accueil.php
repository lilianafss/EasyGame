<?php

use EasyGame\Model\PegiModel;
use EasyGame\Model\PlatformModel;
use EasyGame\Model\GenreModel;
use EasyGame\Controller\AccueilController;
use EasyGame\Model\GameModel;

@ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="assets/css/accueil.css">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <?php require_once "header.php" ?>
        <nav class="navbar" id="filterNav">
            <form method="GET">
                <ul class="nav">
                    <li class="nav-item filtre-container">
                        <select name="age" id="age" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Age", PegiModel::getPegi(), "pegi"); ?>
                        </select>
                    </li>

                    <li class="nav-item filtre-container">
                        <select name="plateforme" id="plateforme" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Plateforme", PlatformModel::getPlatform(), "plateforme"); ?>
                        </select>
                    </li>

                    <li class="nav-item filtre-container">
                        <select name="genre" id="genre" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Genre", GenreModel::getGenre(), "genre"); ?>
                        </select>
                    </li>

                    <li class="nav-item filtre-container">
                        <input id="search" class="border-0 rounded shadow" type="Search" placeholder="Recherche" name="recherche">
                        <button id="filtre-submit" class="btn" type="submit">Rechercher</button>
                    </li>
                </ul>
            </form>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <div id="main-container">
        <?php if ($listeFiltre == "" && $recherche == "") {
            foreach ($listeJeux as $elementListe) { ?>
                <div class="card m-4" onclick="Redirection(<?=$elementListe['idJeux']?>)">
                <?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($elementListe['image']).'"/>'?>
                    <div class="card-block">
                        <h4 class="card-title"><?= $elementListe['nom']?></h4>
                        <p class="card-prix"><?= $elementListe['prix']?> CHF</p>
                    </div>
                </div>
       <?php     }
        } elseif ($listeFiltre == "" && $recherche != "") {

            $requete = GameModel::searchGame($recherche);
            if ($requete != null) {?>
                <p> Vous avez recherché :<?=$recherche?></p>
               <?php foreach ($requete as $elementListe){ ?>
                   <div class="card m-4" onclick="Redirection(<?=$elementListe['idJeux']?>)">
                   <?php echo ' <img class="card-img" src="data:image/jpeg;base64,' . base64_encode($elementListe['image']) . '"/>'?>
                        <div class="card-block">
                            <h4 class="card-title"><?=$elementListe['nom']?></h4>
                            <p class="card-prix"><?=$elementListe['prix']?> CHF</p>
                        </div>
                    </div>
            <?php  }
            } else { ?>
               <p>Aucun resultat</p>
            <?php }
        } elseif ($listeFiltre && $recherche == "") {
            foreach ($listeFiltre  as $elementListe) { ?>
                    <div class="card m-4" onclick="Redirection(<?=$elementListe['idJeux']?>)" >
                       <?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($elementListe['image']) . '"/>'?>
                        <div class="card-block">
                            <h4 class="card-title"><?=$elementListe['nom']?></h4>
                            <p class="card-prix"><?=$elementListe['prix']?> CHF</p>
                        </div>
                    </div>
        <?php    }
        } elseif ($listeFiltre == null) { ?>
            <p>Aucun resultat</p>
       <?php } ?>
        </div>
    </main>
    <?php require_once "footer.php"; ?>
    <script>
        function Redirection(id) {

            let stringUrl = "http://easygame.ch/jeux?idJeux=" + id;

            window.location.replace(stringUrl);
        }
    </script>
</body>

</html>