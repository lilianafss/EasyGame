<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php require_once "style.php" ?>
</head>

<body class="d-flex flex-column h-100">
    <?php require_once "header.php"; ?>
    <main>
        <h1>Page d'Admin</h1>
        <div>

            <form method="POST">
                <div>
                    <a href="/">Ajouter jeux</a>
                </div>
                <div>
                    <h3>Les jeux</h3>
                    <button name="showGames" value="yesJeux"><?= $nomBoutonJeux ?></button>
                </div>
            </form>

            <table>
                <?= $stringTableJeux ?>
            </table>
            <form method="POST">
                <div>
                    <h3>Les utilisateurs</h3>
                    <button name="showUsers" value="yesUsers"><?= $nomBoutonUsers ?></button>
                </div>

            </form>

            <table>
                <?= $stringTableUsers ?>
            </table>
        </div>
    </main>
    <?php require_once "footer.php"; ?>
</body>

</html>