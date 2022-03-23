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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar justify-content-center">
            <span class="main-nav" id="span-logo">
                <a href="/"><img id="logo" alt="logo" src="assets/image/logo.png"></a>
            </span>
            <span class="main-nav" id="span-icon">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="connexion"><i class="fa-solid fa-2x fa-user nav-font"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-heart nav-font"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-basket-shopping nav-font"></i></a>
                    </li>
                </ul>
            </span>
        </nav>
        <nav class="navbar justify-content-center">
            <form method="GET">
                <ul class="nav">
                    <li class="nav-item">
                        <select name="age" id="age" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Age",FonctionsBD::getPegi(),"pegi");?>
                        </select>
                    </li>

                    <li class="nav-item">
                        <select name="plateforme" id="plateforme" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Plateforme",FonctionsBD::getPlatform(),"plateforme");?>
                        </select>
                    </li>

                    <li class="nav-item">
                        <select name="genre" id="genre" class="filtres border-0 px-2 py-1 m-2 rounded shadow">
                            <?php AccueilController::affichageFiltre("Genre",FonctionsBD::getGenre(),"genre");?>
                        </select>
                    </li>

                    <li class="nav-item">
                        <input class="border-0 px-2 py-1 m-2 rounded shadow" type="Search" placeholder="Recherche" name="recherche">
                        <button class="btn btn-primary" type="submit">Rechercher</button>
                    </li>
                </ul>
            </form>
        </nav>
    </header>
    <main class="flex-shrink-0">
        <div id="divMain">
            <?=$stringJeux?>
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