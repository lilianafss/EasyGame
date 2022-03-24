<?php
//var_dump($jeux);
?>
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
    <h1>Admin</h1>

    <main>
        <div>
            <h3>Les jeux</h3>
            <button name="showGames" value="yes">Montrer les jeux</button>
            <table>
                <?= $stringTable ?>
            </table>
        </div>

        <div>
            <h3>Les utilisateurs</h3>

        </div>

    </main>
    <?php require_once "footer.php"; ?>
</body>
</html>