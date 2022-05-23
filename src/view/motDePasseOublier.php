<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublier</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/motDePasseOublier.css">
</head>
<body class="d-flex flex-column h-100">
<header>
    <?php require_once "header.php" ?>
</header>
<main class="flex-shrink-0">
    <form method="POST">
        <fieldset>
            <legend>J'ai oublié mon mot de passe</legend>
            <div class="messageDiv" id="msg"><?=$message?></div>
            <div class="inputContainer">
                <label for="email">Saississez votre adresse e-mail</label>
                <input id="email" name="email" type="email" placeholder="example@gmail.com" value="<?=$email?>">
            </div>
            <div id="submitContainer">
                <input class="btn" id="submit" name="submit" type="submit" value="Envoyer">
            </div>
        </fieldset>
    </form>
</main>
<?php require_once "footer.php"?>
<script src="/assets/js/message.js"></script>
<script><?=$script?></script>
</body>
</html>