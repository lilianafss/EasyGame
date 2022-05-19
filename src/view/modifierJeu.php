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
                //message d'erreur
                if(isset($_GET['valid'])){
                    if($_GET['valid'] == "ok"){
                        $messageErreur = "<p class='messageReussi'>Les informations du jeu ont bien été modifiées</p>";
                    }
                    elseif($_GET['valid'] == "prix"){
                        $messageErreur = "<p class='messageFaux'>Le prix doit être plus grand que zéro</p>";
                    }
                    elseif($_GET['valid'] == "non"){
                        $messageErreur = "<p class='messageFaux'>Tous les champs doivent être remplis sauf les genres et les plateformes</p>";
                    }
                }
            //affichage de la message d'erreur
            echo $messageErreur;
            ?>
        </div>
        <div>
            <form method="POST">
                <p>
                    <label>
                        Nom du jeu:
                    </label>
                    <input type="text" style="width:100%;" name="nomJeu" value="<?= $jeu['nom'] ?>">

                </p>
                <p>
                    <label>
                        Description du jeu:
                    </label>
                    <textarea name="desriptionJeu" style="width:100%;" rows="6"><?= $jeu['description'] ?></textarea>
                </p>

                <p>
                    <label>
                        Prix du jeu:
                    </label>
                    <input type="number" style="width:100%;" step="0.01" name="prixJeu" value="<?= $jeu['prix'] ?>">
                </p>
                <p>

                    <label>Pegi du jeu :</label>
                    <?php
                    $tableau = '<select id="pegi" name="pegiJeu">';
                    foreach ($pegis as $pegi) {
                        if ($jeu['pegi'] == $pegi['pegi']) {
                            $tableau .= "<option  value=" . $pegi['idPegi'] . " selected>" . $pegi['pegi'] . "</option>";
                        } else {
                            $tableau .= "<option value=" . $pegi['idPegi'] . ">" . $pegi['pegi'] . "</option>";
                        }
                    }
                    $tableau .= ' </select>';
                    echo $tableau;
                    ?>

                </p>

                <div class="d-flex flex-row justify-content-center">
                    <fieldset>
                        <legend>Changer les Genres du jeu</legend>
                        <?php
                        $montrerGen = "
                        <table>
                        <tr>
                        <th>Genres</th>
                        </tr>";

                        for ($i = 0; $i < count($genres); $i++) {
                            $montrerGen .= "<tr>
                            <td>" . $genres[$i]['genre'] . "</td>
                            ";
                            $montrerGen .= "</tr>";
                        }
                        $montrerGen .= "</table>";
                        echo $montrerGen;
                        ?>

                        <p>
                            <label>Combien de genres:</label>
                            <select onclick='cliquerGenres(<?php echo json_encode($genreChange) ?>)' id='nbGenre'>
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

                        <p id="selectedGenres"></p>

                    </fieldset>
                    <fieldset>
                        <legend>Changer les Plateformes du jeu</legend>
                        <?php

                        $montrerPlat = "
                          <table>
                          <tr>
                          <th>Plateformes</th>
                          </tr>";


                        for ($i = 0; $i < count($plateformes); $i++) {
                            $montrerPlat .= "<tr>
                              <td>" . $plateformes[$i]['plateforme'] . "</td>
                              ";
                            $montrerPlat .= "</tr>";
                        }
                        $montrerPlat .= "</table>";
                        echo $montrerPlat
                        ?>
                        <p>
                            <label>Combien de plateformes:</label>
                            <select onclick='cliquerPlateformes(<?php echo json_encode($plateformeChange) ?>)' id="nbPlatform">
                                <option></option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </p>

                        <p id="selectedPlateformes"></p>

                    </fieldset>
                </div>
                <div>
                    <p>
                        <button class="btn" type="submit" name="submit" id="changer" value="changer">Changer</button>
                    </p>
                </div>
            </form>
        </div>
    </main>
    <?php require_once "footer.php"; ?>

    <script src="assets/js/modifierJeu.js"></script>
</body>

</html>