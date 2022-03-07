<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
        <div class=" row">
            <div class="col d-flex justify-content-center align-items-center">
                        <form method="POST">
                            <div class="form-group mb-3">
                                <div><input type="email" id="email" name="email" placeholder="Email"></div>
                            </div>
                            <div class="form-group mb-3">
                                <div><input type="password" name="password" placeholder="Mot de passe"></div>
                            </div>
                            <div><input  type="submit" name="btnSubmit" value="Se connecter"></div>
                        </form>
                    </div>
                    
                    <br>
                    <div>
                        <p>
                            <?=$erreur?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>