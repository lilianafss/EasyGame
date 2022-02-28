<?php
require_once "../model/FonctionsBD.php"; 
// use function EasyGame\model\getGames;
use EasyGame\model\FonctionsBD;
use EasyGame\model\database;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mynavbar">
                <form class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <select name="" id="" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 100px;">
                                <option value="" disabled selected>Âge</option>
                                
                            </select>
                        </li>
                        <li class="nav-item">
                            <select name="" id="" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 175px;">
                                <option value="" disabled selected>Toutes les plateformes</option>
                                
                            </select>
                        </li>
                        <li class="nav-item">
                            <select name="" id="" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 150px;">
                                <option value="" disabled selected>Tous les genres</option>
                            </select>
                        </li>
                        <li class="nav-item">
                            <input class="form-control me-2" type="Search" placeholder="Recherche">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Rechercher</button>
                        </li>
                    </ul>

                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid container_jeux">
        <?php
        var_dump (getConnexion());
        for($i = 0; $i > count(getGames()); $i++){
        ?>
        <div class="card flex-row flex-wrap m-4">
            <img src="https://cdn2.steamgriddb.com/file/sgdb-cdn/icon/6a52db09e45a58b3e50bcc6213785282.ico" alt="" class="mx-auto d-block">
            <div class="card-block p-2">
                <h4 class="card-title"><?php getGames()[0]['nom']?></h4>
                <p class="card-text"><?php getGames()[0]['description']?></p>
                <p class="card-text card_prix"><?php getGames()[0]['prix']?></p>
                <a href="#" class="btn btn-primary mx-auto d-block">Ajouter au panier</a>
            </div>
        </div>
        <?php 
        }
        ?>
    </div>
</body>
</html>