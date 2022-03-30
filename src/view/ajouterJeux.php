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
            <div>
                <label>Nom du jeu :</label>
                <input type="text" name="nomJeu">

                <br>

                <label>Description du jeu :</label>
                <textarea type="text" name="descrifJeu"></textarea>

                <br>

                <label>Prix du jeu :</label>
                <input type="number"  step="0.01" name="prixJeu">

                <br>

                <label>Pegi du jeu :</label>
                <select name="pegiJeu">
                    <option value="5">18</option>
                    <option value="4">16</option>
                    <option value="3">12</option>
                    <option value="2" >7</option>
                    <option value="1" >3</option>
                </select>

                <br>

                <label>L'image du jeu :</label>
                <input class="btn" type="file" name="imageJeu">
            </div>
            <div>
                <input class="btn" type="submit" name="submit" value="Envoyer">
            </div>
        </form>
        <?=$messageErreur?>
    </main>
    <?php require_once "footer.php"; ?>
</body>

</html>