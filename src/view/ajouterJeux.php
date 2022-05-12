<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un jeu</title>
    <?php require_once "style.php" ?>
</head>

<body class="d-flex flex-column h-100">
    <?php require_once "header.php"; ?>
    <main>
        <h1>Ajouter jeux</h1>
        <?php
        if ($message == "ok") {
            //affichage du message d'erreur
            $messageErreur = "<p style='color: darkgreen;  border: 2px solid darkgreen; background:rgba(30, 190, 50, 0.5);' id='messageErreur'>Le jeu a bien été créé</p>";
        } elseif ($message == "not") {
            //affichage du message d'erreur
            $messageErreur = "<p id='messageErreur' style='color: darkred; border: 2px solid darkred;  background:rgba(200, 30, 50, 0.5);'>Tous les champs doivent être remplis</p>";
        } else {
            $messageErreur = "";
        } 
        echo $messageErreur;
        ?>
       
        <form method="POST"  enctype="multipart/form-data">
            <div class="d-flex flex-column">
                <p>
                    <label>Nom du jeu :</label>
                    <input type="text" id="nomJeu" name="nomJeu" >
                </p>
                <p>
                    <label>Description :</label>
                    <textarea type="text" id="descrifJeu" name="descrifJeu"></textarea>

                </p>
                <p>
                    <label>Prix du jeu :</label>
                    <input type="number" id="prix" step="0.01" name="prixJeu">
                </p>

                <p>
                    <label>Pegi du jeu :</label>
                    <?php
                    $tableau = '<select id="pegi" name="pegiJeu"><option></option>';
                    foreach($pegis as $pegi){
                        $tableau .= "<option value=".$pegi['idPegi'].">".$pegi['pegi']."</option>";
                    }
                    $tableau .= ' </select>';
                    echo $tableau;
                    ?>
                </p>
                <p>
                    <label>Combien de genres:</label>
                    <select onchange='cliquerGenres(<?php echo json_encode($genre) ?>)' id='nbGenre'>
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
                    <label>Combien de plateformes:</label>
                    <select onclick='cliquerPlateformes(<?php echo json_encode($plateforme) ?>)' id="nbPlatform">
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
                    <label for="formFile" class="form-label">Choisissez une image</label>
                    <input class="form-control" type="file" name="imageJeu" id="formFile">
                </p>

                <p>
                    <input class="btn" onclick='return stickyForm("<?=$message?>")' type="submit" name="submit" value="Ajouter jeu">
                </p>

            </div>
        </form>

    </main>
    <?php require_once "footer.php"; ?>

    <script src="assets/js/ajouterJeux.js">
        
    </script>

</body>

</html>