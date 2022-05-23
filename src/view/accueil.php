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
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar justify-content-center">
            <span class="nav-container" id="logo-container">
                <a href="<?= url("accueil") ?>"><img id="logo" alt="logo" src="assets/image/logo.png"></a>
            </span>
            <span class="nav-container">
                <ul class="nav" id="container-ul">
                    <?php
                        $quantiteBadge = 0;
                        if (isset($_SESSION['quantite']))
                        {
                            $quantiteBadge = $_SESSION['quantite'];
                        }
                        if (!($_SESSION['connected']))
                        {
                            echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="'.url('connexion').'"><i class="fa-solid fa-2x fa-arrow-right-to-bracket icon"></i></a>
                                    <p class="icon-texte">Connexion</p>
                                </li>
                                <li class="nav-item nav-li">
                                    <a class="nav-link" href="'.url('nouveau').'"><i class="fa-solid fa-2x fa-user-plus icon"></i></a>
                                    <p class="icon-texte">S\'inscrire</p>
                                </li>
                            ';
                        }
                        else
                        {
                            echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="'.url('profil').'"><i class="fa-solid fa-2x fa-user icon"></i></a>
                                    <p class="icon-texte">Profil</p>
                                </li>
                                
                                
                                <li class="nav-item nav-li">
                                             
                                <a class="nav-link" href="'.url('panier').'">
                                    <i class="fa-solid fa-2x fa-basket-shopping icon"></i>
                                    <span class="badge rounded-pill badge-notification bg-danger">' . $quantiteBadge . '</span>
                                </a>
                                <p id="panier" class="texte-icon">Panier</p>
                                   
                                </li>
                                   
                            
                                    <li class="nav-item">
                                        <a class="nav-link" href="'.url('deconnexion').'"><i class="fa-solid fa-2x fa-arrow-right-from-bracket icon"></i></a>
                                        <p class="icon-texte">Déconnexion</p>
                                    </li>
                                ';

                            if ($_SESSION['admin'])
                            {
                                echo '
                                    <li class="nav-item">
                                        <a class="nav-link" href="'.url('admin').'"><i class="fa-solid fa-2x fa-screwdriver-wrench icon"></i></a>
                                        <p class="icon-texte">Admin</p>
                                    </li>
                                ';
                            }
                        }
                    ?>
                </ul>
            </span>
        </nav>
        <nav class="navbar justify-content-center mb-3">
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

                    <li class="nav-item filtre-li">
                        <input id="search" class="border-0 rounded shadow" type="Search" placeholder="Recherche" name="recherche">
                        <button id="filtre-submit" class="btn" type="submit">Rechercher</button>
                    </li>
                </ul>
            </form>
        </nav>
    </header>
    <main class="flex-shrink-0">

        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="https://m.media-amazon.com/images/M/MV5BMjg2Nzg2Y2EtYjdkOC00YTY1LTkzYjUtNTcxNmUxZDcyMzhlXkEyXkFqcGdeQXVyNzg3NzI2MTI@._V1_.jpg" class="d-block w-100" alt="seven days to die">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="https://cdn1.epicgames.com/b4565296c22549e4830c13bc7506642d/offer/TETRA_PREORDER_STANDARD%20EDITION_EPIC_Store_Landscape_2560x1440-2560x1440-827a9d1823ad230a0ea5a2efc7936370.jpg" class="d-block w-100" alt="far cry 6">
                </div>
                <div class="carousel-item">
                    <img src="https://api.cdkeybay.com/static/6b98443cff87b77741a9fef8.jpg" class="d-block w-100" alt="call of dutty ">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

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