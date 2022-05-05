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
    <main class="h-100">
        <h1>Modifier</h1> 
        <?php
            $montrerGenPlat = "
            <table>
            <tr>
            <th>Genres</th>
            </tr>";

            foreach ($genres as $genre) {

                $montrerGenPlat .= "<tr>
            <td>" . $genre['genre'] . "</td>
            </tr>";

                $montrerGenPlat .= "";
            }

            $montrerGenPlat .= "
            <tr>
            <th>Plateformes</th>
            </tr>";

            foreach ($platforms as $platform) {

                $montrerGenPlat .= "<tr>
            <td>" . $platform['plateforme'] . "</td>
            </tr>";
            }

            $montrerGenPlat .= "</table>";

            echo $montrerGenPlat;
            ?>
        <div class="d-flex flex-column">
            <form method="POST">
                <p>
                    <label>
                        Nom du jeu:
                    </label>
                    <input type="text" style="width:30%;" name="nomJeu" value="<?= $jeu['nom'] ?>">

                </p>
                <p>
                    <label>
                        Description du jeu:
                    </label>
                    <textarea name="desriptionJeu" rows="5" cols="80"> <?= $jeu['description'] ?></textarea>
                </p>

                <p>
                    <label>
                        Prix du jeu:
                    </label>
                    <input type="number" step="0.01" name="prixJeu" value="<?= $jeu['prix'] ?>">
                </p>
                <p>
                    <label>Pegi actuel du jeu: <?= $jeu['pegi'] ?></label>
                </p>
                <p>
                    <label>Changer le pegi du jeu :</label>
                    <select name="pegiJeu">
                        <option value=""></option>
                        <option value="5">18</option>
                        <option value="4">16</option>
                        <option value="3">12</option>
                        <option value="2">7</option>
                        <option value="1">3</option>
                    </select>
                </p>
                <p>
                    <label>Combien de genres:</label>
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
                    <label>Combien de plateformes:</label>
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
                    <button class="btn" type="submit" name="btnNomDePrix">Changer</button>
                </p>

            </form>
        </div>
    </main>
    <?php require_once "footer.php"; ?>

    <script src="assets/js/ajouterJeux.js"></script>
</body>

</html>