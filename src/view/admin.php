<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <?php require_once "header.php" ?>
    </header>
    <main>
        <h1>Page d'Admin</h1>
        <div>
            <button class="btn" id="ajouterJoue" onclick="allerPageAjouterJeux()">Ajouter jeux</button>
        </div>
            <?php
            //affichage des jeux
                      
            foreach ($jeux as $unJeux) {
                $stringTableJ .= " 
                    <div>
                    <p> <b>IdJeux :</b>  " . $unJeux['idJeux'] . "</p>
                    <p><b>Nom :</b> " . $unJeux['nom'] . "</p>
                    <p> <b>Description :</b> " . $unJeux['description'] . "</p>
                    <p> <b>Prix :</b> " . $unJeux['prix'] . "</p>
                    <p> <b>Pegi :</b> " . $unJeux['pegi'] . "</p>
                    <p> <b>Image :</b> <img class=\"card-img\" src=\"data:image/jpeg;base64," . base64_encode($unJeux['image']) . "\"/></p>
                    <p><h3><small><a href='http://easygame.ch/effacer?idJeux=" . $unJeux['idJeux'] . "'>Effacer</a> |
                    <a class:'liens' href='http://easygame.ch/modifier?idJeux=" . $unJeux['idJeux'] . "'>Modifier</a></small></h3></p>
                    </div>";
            }

            echo $stringTableJ;
            ?>
            <?php
            //affichage des utilisateurs

            foreach ($users as $unUser) {
                $stringTableU .= " 
                    <div>
                    <p><b>IdUser : </b>" . $unUser['idUser'] . "</p>
                    <p><b>Pseudo : </b>" . $unUser['pseudo'] . "</p>
                    <p><b>Nom : </b>" . $unUser['nom'] . "</p>
                    <p><b>Prenom : </b>" . $unUser['prenom'] . "</p>
                    <p><b>Email : </b>" . $unUser['email'] . "</p>
                    <p><b>Admin : </b>" . $unUser['admin'] . "</p>
                    <p><b>USER_STATUS : </b>" . $unUser['user_status'] . "</p>
                    <p><h3><small><a href='http://easygame.ch/effacer?idUser=" . $unUser['idUser'] . "'>Effacer</a> |
                    <a href='http://easygame.ch/effacer?disabled=" . $unUser['idUser'] . "'>Disabled</a> |
                    <a href='http://easygame.ch/effacer?actif=" . $unUser['idUser'] . "'>Actif</a></h3></small></p>
                    </div>";
            }

            echo $stringTableU;

            ?>
    </main>
    <?php require_once "footer.php"; ?>
    <script src="/assets/js/admin.js"></script>
</body>

</html>