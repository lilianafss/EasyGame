<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/assets/css/register.css">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/logo/logo.png">
</head>
<body class="d-flex flex-column h-100">
    <header>
            <nav class="navbar justify-content-center">
                <a href="/">
                    <img id="logo" alt="logo" src="assets/logo/logo.png">
                </a>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </nav>
    </header>
    <main class="flex-shrink-0">
        <h1>Insciption</h1>
        <div id="divMain">
            <form method="POST">

                <div class="divForm">
                    <label for="userName" class="label-input">Nom d'utilisateur</label>
                    <input id="userName" class="label-input" type="text" name="userName" maxlength="20" value="<?=$userName?>">
                </div>

                <div class="divForm">
                    <label for="lastName" class="label-input">Nom</label>
                    <input id="lastName" class="label-input" type="text" name="lastName" value="<?=$lastName?>">
                </div>

                <div class="divForm">
                    <label for="firstName" class="label-input">Prénom</label>
                    <input id="firstName" class="label-input" type="text" name="firstName" value="<?=$firstName?>">
                </div>

                <div class="divForm">
                    <label for="email" class="label-input">E-mail</label>
                    <input id="email" class="label-input" type="email" name="email" value="<?=$email?>">
                </div>

                <div class="divForm">
                    <label for="password" class="label-input"> Mot de passe </label>
                    <input id="password" class="label-input" type="password" name="password" minlength="4" value="">
                </div>

                <div class="divForm">
                    <label for="password2" class="label-input"> Confirmer mot de passe </label>
                    <input id="password2" class="label-input" type="password" name="password2" minlength="4" value="">
                </div>
                <label for="showPassWord" id="containerShowPassWord">
                    <input type="checkbox" name="showPassWord" class="col-2" id="showPassWord" onclick="HidePassword()">
                    <span class="col-10">Afficher le mot de passe</span>
                </label>

                <div class="divForm" id="containerBtn">
                    <input class="btnSubmit btn" type="submit" name="submit" value="Valider">
                    <input class="btnSubmit btn" type="submit" name="submit" value="Annuler">
                </div>

                <span id="errorMessage"><?=$message?></span>

            </form>
        </div>
    </main>
    <footer class="mt-auto pt-3 text-white">
        <div id="divFooter">
            <section class="sectionFooter">
                <i class="fa fa-2x fa-paypal"></i>
                <i class="fa fa-2x fa-cc-visa"></i>
                <i class="fa fa-2x fa-cc-mastercard"></i>
            </section>

            <p>© 2022 Copyright</p>

            <section class="sectionFooter">
                <a class="btn btn-outline-light btn-floating m-1" href="https://fr-fr.facebook.com" role="button">
                    <i class="fa fa-facebook"></i>
                </a>

                <a class="btn btn-outline-light btn-floating m-1" href="https://twitter.com " role="button">
                    <i class="fa fa-twitter"></i>
                </a>

                <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com " role="button">
                    <i class="fa fa-instagram"></i>
                </a>

                <p>site.easygame@gmail.com</p>
            </section>
        </div>
    </footer>
    <script  src="assets/js/hidePassword.js"></script>
</body>
</html>