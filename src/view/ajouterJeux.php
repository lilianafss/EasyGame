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

        <form method="POST" enctype="multipart/form-data">
            <div class="d-flex flex-column">
                <p>
                    <label>Nom du jeu :</label>
                    <input type="text" name="nomJeu">
                </p>
                <p>
                    <label>Description :</label>
                    <textarea type="text" name="descrifJeu"></textarea>

                </p>
                <p>
                    <label>Prix du jeu :</label>
                    <input type="number" step="0.01" name="prixJeu">
                </p>

                <p>
                    <label>Pegi du jeu :</label>
                    <select name="pegiJeu">
                        <option value="5">18</option>
                        <option value="4">16</option>
                        <option value="3">12</option>
                        <option value="2">7</option>
                        <option value="1">3</option>
                    </select>
                </p>
                <p>
                    <label>Combien de genres:</label>
                    <select onchange='cliquerGenres(<?php echo json_encode($genre)?>)' id='nbGenre'>
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
                    <select  onclick='cliquerPlateformes(<?php echo json_encode($plateforme) ?>)' id="nbPlatform">
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
                    <input class="btn" type="submit" name="submit" value="Ajouter jeu">
                </p>
                <?= $messageErreur ?>
            </div>
        </form>

    </main>
    <?php require_once "footer.php"; ?>

    <script src="assets/js/ajouterJeux.js"></script>

</body>

</html>