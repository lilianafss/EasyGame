<?php

use EasyGame\Model\UserModel;
use EasyGame\Model\NoteModel;
use EasyGame\Model\PanierModel;

$tableauxPanier = PanierModel::getPanier($idUser);

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/jeux.css">
    <title><?= $infoJeux['nom'] ?></title>
    <?php require_once "style.php" ?>

</head>

<body class="d-flex flex-column h-100">
    <?php require_once "header.php"; ?>

    <main class="flex-shrink-0">

        <div id="descriptionJeuxContainer">
            <!-- Description du jeux -->
            <h1><?= $infoJeux['nom'] ?></h1>
            <?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($infoJeux['image']) . '"/>'; ?>
            <h3>A propos du jeu</h3>
            <p><?= $infoJeux['description'] ?></p>


            <!-- Si l'utilisateur n'est pas connecte le formulaire d'avis ne vas pas s'afficher -->
            <?php
            if ($idUser != null) {
            ?>
                <button onclick="Affichage()" id="AffichageForm">Donner un avis</button>
                <form action="#" method="POST">
                    <div id="evaluation">
                        <h5 class="mb-4">Laissez votre avis</h5>
                        <?php
                        $noteUSer = NoteModel::getNoteByUserForOneGame($idJeux, $_SESSION['idUser']);
                        if (!$noteUSer['note']) {
                        ?>
                            <label for="note">Note : </p>
                                <input type="number" min="1" max="5" name="note" id="note"><br>
                            <?php
                        }
                            ?>
                            <div class="">
                                <label for="commentaire">Votre commentaire : </label>
                                <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
                            </div>
                            <div class="">
                                <input type="submit" value="AjouterCommentaire" name="envoyer">
                            </div>
                    </div>

                </form>
            <?php
            }
            if ($tableauxCommentaire) {
            ?>
                <h3>Notes et Comentaires</h3>
                <p><?= $numeroCommentaires['nbCommentaires'] ?> commentaire(s)</p>

                <?php
                foreach ($tableauxCommentaire as $commentaire) {
                    $user = UserModel::getInfoUser($commentaire['idUser']);
                    $userNote = NoteModel::getNoteByUserForOneGame($idJeux, $user['idUser']);
                ?>
                    <ul>
                        <li>
                            <div class="right">
                                <h4> <?php echo ($user['pseudo'] . " " . $userNote['note']); ?></h4>
                                <span class="publish py-3 d-inline-block w-100"><?= $commentaire['date'] ?></span>
                                <div class="review-description">
                                    <?= $commentaire['commentaire'] ?>
                                </div>
                            </div>
                        </li>
                    </ul>
            <?php
                }
            }
            ?>
        </div>
        <div id="asideContainer">
            <p class="prix"><?= $infoJeux['prix'] . " CHF" ?></p>
            <form method="POST">
                <input class="btn boutton" type="submit" name="panier" id="panier" value="
                <?php
                $BOOL=false;
                    foreach ($tableauxPanier as $panier) {
                        if ($panier["idJeux"] == $idJeux) {
                            $BOOL=TRUE;
                                echo"Dans le panier";
                            }
                            
                        } if($BOOL==false){
                            echo"Ajouter dans le panier";
                        }
                        
                        ?>"><br>
            </form>
            <!-- <button class="btn boutton" >Wishlist</button> <br> -->
            <?php

            $moyenne = NoteModel::averageByGame($idJeux);
            if ($moyenne != "") {
                echo "Moyenne : " . $moyenne['average'] . "/5";
            }
            ?>
        </div>
    </main>
    <?php require_once "footer.php"; ?>

    <script>
        document.getElementById("evaluation").style.display = "none";

        function Affichage() {
            ///Pour afficher la division :
            document.getElementById("evaluation").style.display = "block";
            document.getElementById("AffichageForm").style.display = "none";
        }
    </script>
</body>

</html>