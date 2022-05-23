<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un jeu</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/ajouterJeux.css">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <?php require_once "header.php" ?>
    </header>
    <main>
        <h1>Ajouter jeux</h1>

        <?php
        //message d'erreur
        if ($bool) {
            $bool = false;
            if ($nomJeux != "" && $description != "" && $prix != "" && $idPegi != "" && $image != "" && $tableauGenre != [] && $tableauPlatform != []) {
                if ($prix > 0) {

                    $messageErreur = "<p class='messageReussi'>Le jeu a bien été créer</p>";
                } else {
                    $messageErreur = "<p class='messageFaux'>Le prix doit être plus grand que zéro</p>";
                }
            } else {
                $messageErreur = "<p class='messageFaux'>Tous les champs doivent être remplis</p>";
            }
        }
        //affichage de la message d'erreur
        echo $messageErreur;
        ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="d-flex flex-column">
                <p>
                    <label>Nom du jeu :</label>
                    <input type="text" id="nomJeu" style="width:100%;" value="<?= $nomJeux ?>" name="nomJeu">
                </p>
                <p>
                    <label>Description :</label>
                    <textarea type="text" id="descrifJeu" rows="6" style="width:100%;" name="descrifJeu"><?= $description ?></textarea>

                </p>
                <p>
                    <label>Prix du jeu :</label>
                    <input type="number" id="prix" value="<?= $prix ?>" style="width:100%;" step="0.01" name="prixJeu">
                </p>

                <p>
                    <label>Pegi du jeu :</label>
                    <?php
                    //affichage des pegis
                    $tableau = '<select id="pegi" name="pegiJeu"><option></option>';
                    foreach ($pegis as $pegi) {
                        if ($idPegi == $pegi['idPegi']) {
                            $tableau .= "<option  value=" . $pegi['idPegi'] . " selected>" . $pegi['pegi'] . "</option>";
                        } else {
                            $tableau .= "<option value=" . $pegi['idPegi'] . ">" . $pegi['pegi'] . "</option>";
                        }
                    }
                    $tableau .= ' </select>';
                    echo $tableau;
                    ?>
                </p>

                <p>
                    <label>Combien de genres:</label>
                    <?php
                    //affichage des genres
                    $tableau = "<select id='nbGenre' onclick='cliquerGenres(" . json_encode($genre) . ")' name='nbGenre'><option></option>";
                    for ($i = 1; $i <= 10; $i++) {
                        if ($i == $nbGenre) {
                            $tableau .= "<option  value=" . $i . " selected>" . $i . "</option>";
                            $scriptGenres = "<script> cliquerGenres(" . json_encode($genre) . ");</script>";
                        } else {
                            $tableau .= "<option value=" . $i . ">" . $i . "</option>";
                        }
                    }
                    $tableau .= ' </select>';
                    echo $tableau;
                    ?>
                </p>

                <p id="selectedGenres"></p>

                <p>
                    <label>Combien de plateformes:</label>
                    <?php
                    //affichage des plateformes
                    $tableau = "<select id='nbPlatform' onclick='cliquerPlateformes(" . json_encode($plateforme) . ")' name='nbPlateforme'><option></option>";
                    for ($i = 1; $i <= 4; $i++) {
                        if ($i == $nbPlateforme) {
                            $tableau .= "<option  value=" . $i . " selected>" . $i . "</option>";
                            $scriptPlateformes = "<script> cliquerPlateformes(" . json_encode($plateforme) . ");</script>";
                        } else {
                            $tableau .= "<option value=" . $i . ">" . $i . "</option>";
                        }
                    }
                    $tableau .= ' </select>';
                    echo $tableau;
                    ?>
                </p>

                <p id="selectedPlateformes"></p>

                <p>
                    <label for="formFile" class="form-label">Choisissez une image</label>
                    <input class="form-control" type="file" name="imageJeu" id="formFile">
                </p>

                <p>
                    <input class="btn" type="submit" name="submit" value="Ajouter jeu">
                </p>
            </div>
        </form>

    </main>
    <?php require_once "footer.php"; ?>

    <script src="/assets/js/ajouterJeux.js"></script>
    <?= $scriptGenres ?>
    <?= $scriptPlateformes ?>
</body>

</html>