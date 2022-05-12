<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once "style.php" ?>
</head>

<body class="d-flex flex-column h-100">
    <?php require_once "header.php"; ?>
    <main>
        <h1>Modifier</h1>         
        <div>
        <?php
        if ($message == "ok") {
            //affichage du message d'erreur
            $messageErreur = "<p style='color: darkgreen;  border: 2px solid darkgreen; background:rgba(30, 190, 50, 0.5);' id='messageErreur'>Le jeu a bien été modifié</p>";
        } elseif ($message == "non") {
            //affichage du message d'erreur
            $messageErreur = "<p id='messageErreur' style='color: darkred; border: 2px solid darkred;  background:rgba(200, 30, 50, 0.5);'>Tous les champs doivent être remplis</p>";
        } else {
            $messageErreur = "";
        } 
        echo $messageErreur;
        ?>
        </div>
        

        <div>
            <form method="POST">
                <p>
                    <label>
                        Nom du jeu:
                    </label>
                    <input type="text" style="width:30%;"  name="nomJeu" value="<?=$jeu['nom']?>">

                </p>
                <p>
                    <label>
                        Description du jeu:
                    </label>
                    <textarea name="desriptionJeu" rows="6" cols="50"><?=$jeu['description']?></textarea>
                </p>

                <p>
                    <label>
                        Prix du jeu:
                    </label>
                    <input type="number" style="width:30%;" step="0.01" name="prixJeu" value="<?=$jeu['prix']?>">
                </p>
                <p>
                
                    <label>Pegi du jeu :</label>
                    <?php
                    $tableau = '<select id="pegi" name="pegiJeu">';
                    foreach($pegis as $pegi){
                        if($jeu['pegi'] == $pegi['pegi']){
                            $tableau .= "<option  value=".$pegi['idPegi']." selected>".$pegi['pegi']."</option>";
                        }else{
                            $tableau .= "<option value=".$pegi['idPegi'].">".$pegi['pegi']."</option>";
                        }
                        
                    }
                    $tableau .= ' </select>';
                    echo $tableau;
                    ?>
                
                </p>
                <div class="d-flex flex-row justify-content-center">

        <?php
            $montrerGen = "
            <table>
            <tr>
            <th>Genres</th>
            </tr>";

            for($i = 0; $i < count($genres); $i++) {
                    $montrerGen .= "<tr>
                    <td>" . $genres[$i]['genre'] . "</td>
                    "; 
                    $montrerGen .= "</tr>";
                 
              }   
                
                       
              $montrerGen .= "</table>";

              $montrerPlat = "
              <table>
              <tr>
              <th>Plateformes</th>
              </tr>";
            
            
              for($i = 0; $i < count($plateformes); $i++){
                    $montrerPlat .= "<tr>
                    <td>" . $plateformes[$i]['plateforme'] . "</td>
                    ";
                    $montrerPlat .= "</tr>";
                }
            $montrerPlat .= "</table>";

            echo $montrerGen;
            echo $montrerPlat
        ?>

        </div>
                <p>
                    <label>Changer les genres:</label>
                    <select onchange='cliquerGenres(<?php echo json_encode($genreChange) ?>)' id='nbGenre'>
                        <option></option>
                        <option value="10">10</option>
                        <option value="9">9</option>
                        <option value="8">8</option>
                        <option value="7">7</option>
                        <option value="6">6</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </p>
                <p>
                    <label>Changer les plateformes:</label>
                    <select onchange='cliquerPlateformes(<?php echo json_encode($plateformeChange) ?>)' id="nbPlatform">
                        <option></option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </p>

                <p id="selectedGenres">

                </p>
                <p id="selectedPlateformes">

                </p>

                <p>
                    <button class="btn" type="submit" name="submit" value="changer">Changer</button>
                </p>

            </form>
        </div>
    </main>
    <?php require_once "footer.php"; ?>

    <script src="assets/js/modifierJeu.js"></script>
</body>

</html>