<?php
@ini_set('display_errors', 'on');
session_start();
//require_once "../model/FonctionsBD.php"; 
// use function EasyGame\model\getGames;
use EasyGame\model\FonctionsBD;
use EasyGame\model\BaseDonnee;
$listeAge=FonctionsBD::getPegi();
$listePlateforme=FonctionsBD::getPlatform();
$listeGenre=FonctionsBD::getGenre();
var_dump($_SESSION);
var_dump(FonctionsBD::getComments(1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mynavbar">
                <form class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <select name="age" id="age" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 100px;">
                                <option value="" disabled selected>Âge</option>
                            <?php  foreach($listeAge as $age) {?>
                                <option value="<?php $age["pegi"]?>" onclick="afficherFiltre()"><?php echo $age["pegi"]?></option>
                                <?php } ?>
                            </select>
                            
                        </li>
                        <li class="nav-item">
                            <select name="plateforme" id="plateforme" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 175px;">
                                <option value="" disabled selected>Toutes les plateformes</option>
                                <?php  foreach($listePlateforme as $plateforme) {?>
                                <option value="<?php $plateforme["plateforme"]?>" onclick="afficherFiltre()"><?php echo $plateforme["plateforme"]?></option>
                                <?php } ?>
                                
                            </select>
                        </li>
                        <li class="nav-item">
                            <select name="genre" id="genre" class="form-control border-0 px-2 py-1 mx-2 rounded shadow" style="width: 150px;">
                                <option value="" disabled selected>Tous les genres</option>
                                <?php  foreach($listeGenre as $genre) {?>
                                
                                <option value="<?php $genre["genre"]?>" onclick="afficherFiltre()"><?php echo $genre["genre"]?></option>
                                <?php } ?>
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
            $listeJeux=FonctionsBD::getGames();
            $listeFiltre=FonctionsBD::getGameByFilters("","","");
            var_dump($listeFiltre);
                if($listeFiltre!=""){
                    foreach($listeFiltre as $filtre){
            ?>

                    <div class="card flex-row flex-wrap m-4">
                        <?php echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $filtre['image'] ).'"/>'; ?>
                        <div class="card-block p-2">
                            <h4 class="card-title"><?php echo $filtre['nom']?></h4>
                            <p class="card-text"><?php echo $filtre['description']?></p>
                            <p class="card-text card_prix"><?php echo $filtre['prix']?></p>
                            <a href="#" class="btn btn-primary mx-auto d-block">Ajouter au panier</a>
                        </div>
                    </div>
            <?php       
                    }
                }else{
                    foreach($listeJeux as $jeux){
            ?>
                   <div class="card flex-row flex-wrap m-4">
                        <?php echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $jeux['image'] ).'"/>'; ?>
                        <div class="card-block p-2">
                            <h4 class="card-title"><?php echo $jeux['nom']?></h4>
                            <p class="card-text"><?php echo $jeux['description']?></p>
                            <p class="card-text card_prix"><?php echo $jeux['prix']?></p>
                            <a href="#" class="btn btn-primary mx-auto d-block">Ajouter au panier</a>
                        </div>
                    </div>
            <?php
                    }
                }
            ?>
        </div>   

</body>
<footer>

<?php include "footer.html" ?>
</footer>
</html>