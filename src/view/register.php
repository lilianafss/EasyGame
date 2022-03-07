<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/register.css">
<!--    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">-->
</head>
<body>
    <header>
        <h1>Créer un compte</h1>
    </header>
    <main>
        <div class="container"> 
            <form method="POST">
                <div>
                    <label for="userName" class="col-12">Nom d'utilisateur</label>
                    <input id="userName" class="col-12" type="text" name="userName" maxlength="20" value="<?=$userName?>">
                </div>

                <div>
                    <label for="lastName" class="col-12">Nom</label>
                    <input id="lastName" class="col-12" type="text" name="lastName" value="<?=$lastName?>">
                </div>

                <div>
                    <label for="firstName" class="col-12">Prénom</label>
                    <input id="firstName" class="col-12" type="text" name="firstName" value="<?=$firstName?>">
                </div>

                <div>
                    <label for="email" class="col-12">E-mail</label>
                    <input id="email" class="col-12" type="email" name="email" value="<?=$email?>">
                </div>

                <div>
                    <label for="password" class="col-12"> Mot de passe </label>
                    <input id="password" class="col-12" type="password" name="password" minlength="4" value="">
                </div>

                <div>
                    <label for="password2" class="col-12"> Confirmer mot de passe </label>
                    <input id="password2" class="col-12" type="password" name="password2" minlength="4" value="">
                </div>

                <div id="containerShowPassWord">
                    <label for="showPassWord">
                        <input type="checkbox" name="showPassWord" id="showPassWord" onclick="HidePassword()">
                        Afficher le mot de passe
                    </label>
                </div>

                <div id="containerBtn">
                    <input class=" col-6" type="submit" name="submit" value="Valider">
                    <input class=" col-6" type="submit" name="submit" value="Annuler">
                </div>
            </form>
        </div>
    </main>
    <script  src="assets/js/hidePassword.js"></script>
</body>
</html>