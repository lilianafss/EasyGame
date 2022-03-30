<?php
use EasyGame\model\FonctionsBD;
use EasyGame\Controller\AccueilController;
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
                <a href="/"><img id="logo" alt="logo" src="assets/image/logo.png"></a>
            </span>
            <span class="nav-container" id="icon-container">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="connexion"><i class="fa-solid fa-2x fa-user icon"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-heart icon"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-basket-shopping icon"></i></a>
                    </li>
                    <?php
                    if($_SESSION['admin']){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='http://easygame.ch/admin'>Admin</a>
                        </li>";
                    }
                    ?>
                </ul>
            </span>
        </nav>
        <nav class="navbar justify-content-center">
            <form method="GET">
                <ul class="nav">
                    <li class="nav-item filtre-container">
                        <select name="age" id="age" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Age",FonctionsBD::getPegi(),"pegi");?>
                        </select>
                    </li>

                    <li class="nav-item filtre-container">
                        <select name="plateforme" id="plateforme" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Plateforme",FonctionsBD::getPlatform(),"plateforme");?>
                        </select>
                    </li>

                    <li class="nav-item filtre-container">
                        <select name="genre" id="genre" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Genre",FonctionsBD::getGenre(),"genre");?>
                        </select>
                    </li>

                    <li class="nav-item filtre-li">
                        <input id="search" class="border-0 rounded shadow" type="Search" placeholder="Recherche" name="recherche">
                        <button id="filtre-submit" class="btn btn-primary" type="submit">Rechercher</button>
                    </li>
                </ul>
            </form>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <div id="main-container">
            <?= $stringJeux ?>
        </div>
    </main>
    <?php require_once "footer.php"; ?>
    <script>
       function Redirection(id){

        let stringUrl = "http://easygame.ch/jeux?idJeux=" + id;

        window.location.replace(stringUrl);
       }
    </script>
</body>
</html>