<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Changer mot de passe</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/modifierMdp.css">
</head>
<body class="d-flex flex-column h-100">
    <header>
        <?php require_once "header.php" ?>
    </header>
    <main class="flex-shrink-0">
        <h2>Modifier mon mot de passe</h2>
        <div class="w-100">
            <div class="messageDiv" id="msg"><?=$message?></div>
            <div class="w-100">
                <form method="POST">
                    <div class="formDiv">
                        <label for="password">Nouveau mot de passe</label>
                        <input id="password" name="password" type="password" minlength="8" placeholder="8 caractères min." value="<?=$password?>">
                    </div>

                    <div class="formDiv">
                        <label for="password2">Confirmer nouveau mot de passe</label>
                        <input id="password2" name="password2" type="password" minlength="8" placeholder="Doit être indentique au champ précédent" value="<?=$password2?>">
                    </div>

                    <div id="submitDiv">
                        <label class="mt-2" for="showPassWord" id="containerShowPassWord">
                            <input type="checkbox" name="showPassWord" id="showPassWord" onclick="ShowPassword()">
                            <span>Afficher le mot de passe</span>
                        </label>
                        <input class="btn" id="submit" type="submit" name="submit" value="Changer">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php require_once "footer.php"?>

    <script src="/assets/js/message.js"></script>
    <script src="/assets/js/showPassword.js"></script>
    <script><?=$script?></script>
</body>
</html>