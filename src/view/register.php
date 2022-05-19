<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/register.css">
</head>
<body class="d-flex flex-column h-100">

    <?php require_once "header.php" ?>

    <main class="flex-shrink-0">

        <h1>Inscription</h1>
        <div class="messageDiv" id="msg">
            <?=$message?>
        </div>

        <div id="divMain">

            <form method="POST">

                <div class="divForm">
                    <label for="userName" class="label-input">Nom d'utilisateur</label>
                    <input id="userName" class="label-input" type="text" name="userName" maxlength="16" placeholder="16 caractères max." value="<?=$userName?>">
                </div>

                <div class="divForm">
                    <label for="lastName" class="label-input">Nom</label>
                    <input id="lastName" class="label-input" type="text" name="lastName" placeholder="Aebischer" value="<?=$lastName?>">
                </div>

                <div class="divForm">
                    <label for="firstName" class="label-input">Prénom</label>
                    <input id="firstName" class="label-input" type="text" name="firstName" placeholder="Lea" value="<?=$firstName?>">
                </div>

                <div class="divForm">
                    <label for="email" class="label-input">E-mail</label>
                    <input id="email" class="label-input" type="email" name="email" placeholder="example@gmail.com" value="<?=$email?>">
                </div>

                <div class="divForm">
                    <label for="password" class="label-input"> Mot de passe </label>
                    <input id="password" class="label-input" type="password" name="password" minlength="8" placeholder="8 caractères min." value="<?=$password?>">
                </div>

                <div class="divForm">
                    <label for="password2" class="label-input"> Confirmer mot de passe </label>
                    <input id="password2" class="label-input" type="password" name="password2" minlength="8" placeholder="Doit être identique au mot de passe" value="<?=$password2?>">
                </div>

                <div class="divForm" id="container-form-bot">
                    <label for="showPassWord" id="containerShowPassWord">
                        <input type="checkbox" name="showPassWord" id="showPassWord" onclick="ShowPassword()">
                        <span class="ml-2">Afficher le mot de passe</span>
                    </label>
                    <input class="btnSubmit btn" type="submit" name="submit" value="Valider">
                </div>
            </form>
        </div>
    </main>
    <?php require_once "footer.php"?>
    <script src="assets/js/message.js"></script>
    <script src="assets/js/showPassword.js"></script>
    <script><?=$script?></script>
</body>
</html>