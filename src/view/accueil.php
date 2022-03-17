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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/logo/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mynavbar">
                <form class="d-flex" method="GET">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <select name="age" id="age" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 100px;">
                                <option value="" disabled selected>Âge</option>
                                <?php AccueilController::affichageFiltre(FonctionsBD::getPegi(),"pegi");?>
                            </select>
                            
                        </li>
                        <li class="nav-item">
                            <select name="plateforme" id="plateforme" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 175px;">
                                <option value="" disabled selected>Toutes les plateformes</option>
                                <?php AccueilController::affichageFiltre(FonctionsBD::getPlatform(),"plateforme");?>
                            </select>
                        </li>
                        <li class="nav-item">
                            <select name="genre" id="genre" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 150px;">
                                <option value="" disabled selected>Tous les genres</option>
                                <?php AccueilController::affichageFiltre(FonctionsBD::getGenre(),"genre");?>
                            </select>
                        </li>
                        <li class="nav-item">
                            <input class="form-control me-2" type="Search" placeholder="Recherche" name="recherche">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Rechercher</button>
                        </li>
                    </ul>

                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid container_jeux">
       <?php var_dump($stringJeux);?>
    </div>
</body>
</html>