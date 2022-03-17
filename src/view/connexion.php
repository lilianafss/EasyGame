<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/assets/css/connexion.css">
</head>

<body>
    <main>
        <div class="row d-flex justify-content-center" id="box">
            <div class="row text-center" id="title">
                <h3>Connexion</h3>
            </div>
            <div class="col justify-content-center align-items-center">
                <form method="POST">
                    <div class="form-group mb-3">
                        <div><input type="email" id="email" name="email" placeholder="Email" width="100"></div>
                    </div>
                    <div class="form-group mb-3">
                        <div><input type="password" name="password" placeholder="Mot de passe"></div>
                    </div>
                    <div class="form-group mb-3">
                        <p class="text-danger">
                            <?= $erreur ?>
                        </p>
                    </div>
                    <div class="form-group mb-3">
                        <div><input type="submit" name="btnSubmit" value="Se connecter"></div>
                    </div>
                </form>

                <a href="http://easygame">Mot de passe oublié?</a>
            </div>

            <div>
                <hr id="line">
            </div>

            <div>
                <!-- <?=$btnGoogle?> -->
            </div>

            <div>
                <p>ou</p>
            </div>
            <div class="col justify-content-center align-items-center" id="linkIncrit">
                <a href="http://easygame/nouveau">S'incrire</a>
            </div>
    </main>
    <?php require_once 'footer.html'?>
</body>

</html>