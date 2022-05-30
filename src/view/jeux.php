<?php

use EasyGame\Model\UserModel;
use EasyGame\Model\NoteModel;
use EasyGame\Model\PanierModel;
use EasyGame\Model\PlatformModel;

$tableauxPanier = PanierModel::getPanier($idUser);
$BOOL = false;
foreach ($tableauxPanier as $panier) {
    if ($panier["idJeux"] == $idJeux) {
        $BOOL = TRUE;
        $dedans = "Dans le panier";
    }
}
if ($BOOL == false) {
    $dedans = "Ajouter dans le panier";
}

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <title><?= $infoJeux['nom'] ?></title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/jeux.css">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <?php require_once "header.php" ?>
    </header>

    <main class="flex-shrink-0">

        <div id="descriptionJeuxContainer">
            <!-- Description du jeux -->
            <h1><?= $infoJeux['nom'] ?></h1>
            <?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($infoJeux['image']) . '"/>'; ?>
            <h3 class="text-center">A propos du jeu</h3>
            <p><?= $infoJeux['description'] ?></p>

            <div id="asideContainer">
                <p class="prix"><?= $infoJeux['prix'] . " CHF" ?></p>
                <?php

                $moyenne = NoteModel::averageByGame($idJeux);
                if ($moyenne != "") {
                    echo "Moyenne des joueurs: " . $moyenne['average'] . "/5";
                }
                ?>

                <form method="POST">
                    <input class="btn boutton" type="submit" name="panier" value="<?php echo $dedans ?>">
                    <input class="btn boutton" type="submit" name="wishlist" id="wishlist" value="Ajouter a la wishlist">

                    <br>
                </form>
            </div>
        </div>

        <div id="nouveauCommentaireContainer">
            <!-- Si l'utilisateur n'est pas connecte le formulaire d'avis ne vas pas s'afficher -->
            <?php
                if ($idUser != null) {
            ?>
            <form action="#" class="w-100" method="POST">
                <section class="w-100">
                    <div class="w-100 text-dark">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="d-flex flex-start w-100">
                                    <div class="w-100">
                                        <h5>Laissez votre avis</h5>
                                        <?php
                                        $noteUser = NoteModel::getNoteByUserForOneGame($idJeux, $_SESSION['idUser']);
                                        if($noteUser['note'] == "")
                                        {?>
                                            <div class="starrating risingstar d-flex flex-row-reverse">
                                                <input type="radio" id="star5" name="note" value="5" /><label for="star5" title="5 star"></label>
                                                <input type="radio" id="star4" name="note" value="4" /><label for="star4" title="4 star"></label>
                                                <input type="radio" id="star3" name="note" value="3" /><label for="star3" title="3 star"></label>
                                                <input type="radio" id="star2" name="note" value="2" /><label for="star2" title="2 star"></label>
                                                <input type="radio" id="star1" name="note" value="1" /><label for="star1" title="1 star"></label>
                                            </div>
                                        <?php }?>

                                        <textarea class="form-control" name="commentaire" id="commentaire" required rows="6"></textarea>

                                        <div class="d-flex justify-content-center mt-3">
                                            <input class="btn boutton" type="submit" value="Ajouter commentaire" name="envoyer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <?php } ?>
        </div>

        <div id="commentaireContainer">
            <?php if ($tableauxCommentaire) {
                ?>
                <h3 class="text-center">Avis des joueurs</h3>
                <p class="text-center" id="nbcommentaires"><?= $numeroCommentaires['nbCommentaires'] ?> commentaire(s)</p>

                <?php
                foreach ($tableauxCommentaire as $commentaire) {
                    $user = UserModel::getInfoUser($commentaire['idUser']);
                    $userNote = NoteModel::getNoteByUserForOneGame($idJeux, $user['idUser']);
                    ?>
                    <div class="card">
                        <div class="d-flex">
                            <?php echo '<img id="imgProfil" class="card-img" src="data:image/jpeg;base64,' . base64_encode($commentaire['avatar']) . '"/>'; ?>
                            <h3 id="commentaire-pseudo"><?= $user['pseudo'] ?></h3>
                            <p id="commentaire-date" class="text-muted"><?= $commentaire['date'] ?></p>
                        </div>
                        <div class="text-left">
                            <div id="note">
                                <span class="fa fa-star star-active"></span>
                                <p class="text-left"><span class="text-muted"><?= $userNote['note'] ?></span></p>
                            </div>
                            <p class="content"><?= $commentaire['commentaire'] ?></p>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </main>
    <?php require_once "footer.php"; ?>
</body>

</html>