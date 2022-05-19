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
<?php require_once "header.php" ?>
<main class="flex-shrink-0">
    <p id="message"><?=$message?></p>
    <form method="POST">
        <fieldset>
            <legend>J'ai oublié mon mot de passe</legend>
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
<script src="assets/js/message.js"></script>
<?=$script?>
</body>
</html>