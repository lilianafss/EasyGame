<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/connexion.css">
</head>

<body class="d-flex flex-column h-100">

    <header>
        <?php require_once "header.php" ?>
    </header>
    <main>
        <div class="row d-flex justify-content-center" id="box">

            <div class="row text-center" id="title">
                <h3>Connexion</h3>
            </div>

            <div class="col justify-content-center align-items-center">

                <form method="POST" class="formItemsContainer">
                    <div id="connexionContainer">
                        <input type="email" class="connexionInput" id="email" name="email" placeholder="Email" width="100">
                        <input type="password" class="connexionInput" id="password" name="password" placeholder="Mot de passe">
                    </div>

                    <div class="formItemsContainer">
                        <p class="text-danger">
                            <?= $erreur ?>
                        </p>
                    </div>

                    <div class="formItemsContainer">
                        <input class="btn boutton" type="submit" name="btnSubmit" value="Se connecter">
                    </div>

                </form>

                <a href="/motDePasseOublier">Mot de passe oublié?</a>
            </div>

            <div>
                <hr id="line">
            </div>

            <p>ou</p>

            <div class="col justify-content-center align-items-center" id="linkIncrit">
                <a href="/nouveau">Crée un nouveau compte</a>
            </div>
        </div>
    </main>
    <?php require_once 'footer.php' ?>
</body>
</html>