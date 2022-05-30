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

        <div class="btnContainer">
            <button class="btn boutton btnUser mx-auto my-3"> <a class="btnUser" href="#utilisateur">Utilisateurs</a></button>
            <form method="POST" class="w-100">
                <button class="btn boutton" id="ajouterJeu" name="submit" value="ok" type="submit">Ajouter jeux</button>
            </form>
        </div>

        <h2 id="jeux">Jeux</h2>
        <?php
        //affichage des jeux

        foreach ($jeux as $unJeux) {
            $stringTableJ .= "<div>
                <p class='infoJeux'> <b>IdJeux </b>" . $unJeux['idJeux'] . "</p>
                <p class='infoJeux'> <b>Nom </b>"  . $unJeux['nom'] . "</p>
                <p> <b>Image</b><img class='img-fluid' src='data:image/jpeg;base64," . base64_encode($unJeux['image']) . "'/></p>
                <p> <b>Description</b> " . $unJeux['description'] . "</p>
                <p class='infoJeux'> <b>Prix </b>" . $unJeux['prix'] . "</p>
                <p class='infoJeux'> <b>Pegi </b>" . $unJeux['pegi'] . "</p>
                <p><h3><small><a href='" . URL_PRINCIPAL . url('effacer') . "?idJeux=" . $unJeux['idJeux'] . "'>Effacer</a> |
                <a class:'liens' href='" . URL_PRINCIPAL . url('modifierJeu') . "?idJeux=" . $unJeux['idJeux'] . "'>Modifier</a></small></h3></p>
            </div>";
        }

        echo $stringTableJ;
        ?>

        <div class="btnContainer">
            <button class="btn boutton btnJeux mx-auto"> <a class="btnJeux" href="#jeux">Jeux</a></button>
        </div>

        <h2 id="utilisateur">Utilisateurs</h2>
        <?php
        //affichage des utilisateurs

        foreach ($users as $unUser) {
            $stringTableU .= " 
                    <div>
                    <p><b>IdUser </b>" . $unUser['idUser'] . "</p>
                    <p><b>Pseudo </b>" . $unUser['pseudo'] . "</p>
                    <p><b>Nom </b>" . $unUser['nom'] . "</p>
                    <p><b>Prenom </b>" . $unUser['prenom'] . "</p>
                    <p><b>Email </b>" . $unUser['email'] . "</p>
                    <p><b>Admin </b>" . $unUser['admin'] . "</p>
                    <p><b>USER_STATUS </b>" . $unUser['user_status'] . "</p>
                    <p><h3><small><a href='" . URL_PRINCIPAL . url('effacer') . "?idUser=" . $unUser['idUser'] . "'>Effacer</a> |
                    <a href='" . URL_PRINCIPAL . url('effacer') . "?disabled=" . $unUser['idUser'] . "'>Disabled</a> |
                    <a href='" . URL_PRINCIPAL . url('effacer') . "?actif=" . $unUser['idUser'] . "'>Actif</a></h3></small></p>
                    </div>";
        }

        echo $stringTableU;

        ?>
    </main>
    <?php require_once "footer.php"; ?>
    <script src="/assets/js/admin.js"></script>
</body>

</html>