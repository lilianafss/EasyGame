<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php require_once "style.php" ?>
</head>

<body class="d-flex flex-column h-100">
    <?php require_once "header.php"; ?>
    <main>
        <h1>Page d'Admin</h1>
        <div>
            <button class="btn" id="ajouterJoue" onclick="allerPageAjouterJeux()">Ajouter jeux</button>
        </div>
        <table>
            <?php

            $stringTableJ .= "
                      <tr>
                      <th>IdJeux</th>
                      <th>Nom</th>
                      <th>Description</th>
                      <th>Prix</th>
                      <th>Pegi</th>
                      <th>Image</th>
                      </tr>
                      ";

            foreach ($jeux as $unJeux) {
                $stringTableJ .= " 
                        <tr>
                        <td>" . $unJeux['idJeux'] . "</td>
                        <td>" . $unJeux['nom'] . "</td>
                        <td>" . $unJeux['description'] . "</td>
                        <td>" . $unJeux['prix'] . "</td>
                        <td>" . $unJeux['pegi'] . "</td>
                        <td><img class=\"card-img\" src=\"data:image/jpeg;base64," . base64_encode($unJeux['image']) . "\"/></td>
                        <td><a href='http://easygame.ch/effacer?idJeux=" . $unJeux['idJeux'] . "'>Effacer</a></td>
                        <td><a href='http://easygame.ch/modifier?idJeux=" . $unJeux['idJeux'] . "'>Modifier</a></td>
                        </tr>";
            }

            echo $stringTableJ;
            ?>
        </table>
        <table>
            <?php

            $stringTableU .= "
                    <tr>
                    <th>IdUser</th>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>USER_STATUS</th>
                    </tr>
                    ";

            foreach ($users as $unUser) {
                $stringTableU .= " 
                      <tr>
                      <td>" . $unUser['idUser'] . "</td>
                      <td>" . $unUser['pseudo'] . "</td>
                      <td>" . $unUser['nom'] . "</td>
                      <td>" . $unUser['prenom'] . "</td>
                      <td>" . $unUser['email'] . "</td>
                      <td>" . $unUser['admin'] . "</td>
                      <td>" . $unUser['user_status'] . "</td>
                      <td><a href='http://easygame.ch/effacer?idUser=" . $unUser['idUser'] . "'>Effacer</a></td>
                      <td><a href='http://easygame.ch/effacer?disabled=" . $unUser['idUser'] . "'>Disabled</a></td>
                      <td><a href='http://easygame.ch/effacer?actif=" . $unUser['idUser'] . "'>Actif</a></td>
                      </tr>";
            }


            echo $stringTableU;

            ?>
        </table>

    </main>
    <?php require_once "footer.php"; ?>
    <script src="assets/js/admin.js"></script>
</body>

</html>