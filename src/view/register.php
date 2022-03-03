<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/assets/css/register.css">
</head>
<body>
    <header>
        <h1>Créer un compte</h1>
    </header>
    <main>
        <div class="container">
            <form method="POST">
                <div>
                    <label for="userName" class="col-6">Nom d'utilisateur</label>
                    <input id="userName" class="col-6" type="text" name="userName" maxlength="20" value="">
                </div>

                <div>
                    <label for="lastName" class="col-6">Nom</label>
                    <input id="lastName" class="col-6" type="text" name="lastName" value="">
                </div>

                <div>
                    <label for="firstName" class="col-6">Prénom</label>
                    <input id="firstName" class="col-6" type="text" name="firstName" value="">
                </div>

                <div>
                    <label for="email" class="col-6">E-mail</label>
                    <input id="email" class="col-6" type="email" name="email" value="">
                </div>

                <div>
                    <label for="password" class="col-6"> Mot de passe </label>
                    <input id="password" class="col-6" type="password" name="password" minlength="4" value="">
                    
                    <div class="password-icon">
                        <i data-feather="eye"></i>
                        <i data-feather="eye-off"></i>
                    </div>
                </div>

                <div>
                    <label for="password2" class="col-6"> Confirmer mot de passe </label>
                    <input id="password2" class="col-6" type="password" name="password2" minlength="4" value="">
                </div>

                <div id="containerBtn">
                    <input class="btn col-6" type="submit" name="submit" value="Valider">
                    <input class="btn col-6" type="submit" name="submit" value="Annuler">
                </div>
            </form>
        </div>
    </main>
<!-- ICON SCRIPT -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
  feather.replace();
</script>
<!-- partial -->
<script  src="../../public/assets/js/hidePassword.js"></script>
</body>
</html>