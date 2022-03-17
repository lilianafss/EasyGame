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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar justify-content-center">
            <a href="/">
                <img id="logo" alt="logo" src="assets/image/logo.png">
            </a>
            <form method="post">
                <ul class="nav">
                    <li class="nav-item">
                        <select name="age" id="age" class="border-0 px-2 py-1 m-2 rounded shadow" style="width: 150px;">
                            <option value="" disabled selected>Age</option>
                            <?php AccueilController::affichageFiltre(FonctionsBD::getPegi(),"pegi");?>
                        </select>
                    </li>

                    <li class="nav-item">
                        <select name="plateforme" id="plateforme" class="border-0 px-2 py-1 m-2 rounded shadow" style="width: 150px;">
                            <option value="" disabled selected>Plateformes</option>
                            <?php AccueilController::affichageFiltre(FonctionsBD::getPlatform(),"plateforme");?>
                        </select>
                    </li>

                    <li class="nav-item">
                        <select name="genre" id="genre" class="border-0 px-2 py-1 m-2 rounded shadow" style="width: 150px;">
                            <option value="" disabled selected>Genres</option>
                            <?php AccueilController::affichageFiltre(FonctionsBD::getGenre(),"genre");?>
                        </select>
                    </li>

                    <li class="nav-item">
                        <input class="border-0 px-2 py-1 m-2 rounded shadow" type="Search" placeholder="Recherche">
                        <button class="btn btn-primary" type="submit">Rechercher</button>
                    </li>
                </ul>
            </form>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Connexion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Panier</a>
                </li>
            </ul>

        </nav>
    </header>

    <main class="flex-shrink-0">
        <div id="divMain">
            <?=$stringJeux?>
        </div>
    </main>
    <?php require_once"footer.html"; ?>
</body>
</html>