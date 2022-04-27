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
        <table>
            <?= $montrerGenPlat ?>
        </table>
        <form method="POST">
            <label>
                Nom du jeu:
            </label>
            <input type="text" style="width:30%;" name="nomJeu" value="<?=$jeu['nom']?>">

            <br>

            <label>
                Description du jeu:
            </label>
            <textarea name="desriptionJeu" rows="5" cols="80"> <?=$jeu['description']?></textarea>

            <br>

            <label>
                Prix du jeu:
            </label>
            <input type="number" step="0.01" name="prixJeu" value="<?=$jeu['prix']?>">
            
            <br>
            <label>Changer l'image du jeu :</label>
            <input class="btn" type="file" name="imageJeu">
        </form>

        <form method="POST">
            
        <h2>Changer les genres, les plateformes du jeux et le pegi</h2>

        <label>Changer les genres:</label>
                <select name="nbGenre">
                <option value=""></option>
                    <option value="10">10</option>
                    <option value="9">9</option>
                    <option value="8">8</option>
                    <option value="7">7</option>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2" >2</option>
                    <option value="1" >1</option>
                </select>
                <label>Combien de plateformes:</label>
                <select name="nbPlatform">
                    <option value=""></option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2" >2</option>
                    <option value="1" >1</option>
                </select>
                <input type="submit" value="Submit Platform et Genre" name="btnGenrePlateform">
            <br>
            <label>Pegi actuel du jeu: <?=$jeu['pegi']?></label>
            <br>
            <label>Changer le pegi du jeu :</label>
            <select name="pegiJeu">
                <option value=""></option>
                <option value="5">18</option>
                <option value="4">16</option>
                <option value="3">12</option>
                <option value="2">7</option>
                <option value="1">3</option>
            </select>

            <button type="submit" name="btnGenresPlatPegi">Changer</button>

        </form>
    </main>

    <?php require_once "footer.php"; ?>
</body>

</html>