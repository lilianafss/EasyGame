<?php

use EasyGame\Model\WishlistModel;
use EasyGame\Model\HistoriqueModel;

$tableauxWishlist = WishlistModel::getWishlist($_SESSION['idUser']);
$tableauxHistorique = HistoriqueModel::getHistory($_SESSION['idUser'])


?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/profil.css">
    <!-- <style>
        input[type="submit"] {
            font-family: FontAwesome;
        }
    </style> -->
</head>

<body class="d-flex flex-column h-100">

    <header>
        <?php require_once "header.php" ?>
    </header>

    <?php if ($sucessMessage != "") { ?>
        <div class="alert alert-success" role="alert">
            <?= $sucessMessage ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    } ?>

    <?php if ($errorMessage != "") { ?>
        <div class="alert alert-danger" role="alert">
            <?= $errorMessage ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    } ?>
    <main class="flex-shrink-0">
        <div class="main-container">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'info')" id="defaultOpen"><i class="fa-solid fa-user"></i> Informations personnelles</button>
                <button class="tablinks" onclick="openCity(event, 'historiqueAchat')"> <i class="fa-solid fa-basket-shopping"></i> Historique d'achat</button>
                <button class="tablinks" onclick="openCity(event, 'wishlist')"><i class="fa-solid fa-heart"></i> Whislist</button>
            </div>



            <div id="info" class="tabcontent">
                <form action="" method="post">
                    <button id="editer" onclick="return editProfil()"><i class="fa-solid fa-pencil"></i></button>
                    <h3>Informations personnelles</h3>

                    <div id="containerNom">
                        <h5>Nom</h5>
                        <p id="nom"><?= $infoUser['nom'] ?></p>
                        <input type="text" name="editNom" id="editNom" placeholder="<?= $infoUser['nom'] ?> " style="display:none">

                    </div>

                    <div id="containerPrenom">
                        <h5>Prenom </h5>
                        <p id="prenom"><?= $infoUser['prenom'] ?></p>
                        <input type="text" name="editPrenom" id="editPrenom" placeholder="<?= $infoUser['prenom'] ?>" style="display:none">
                    </div>

                    <div id="containerPseudo">
                        <h5>Pseudo </h5>
                        <p id="pseudo"><?= $infoUser['pseudo'] ?></p>
                        <input type="text" name="editPseudo" id="editPseudo" placeholder="<?= $infoUser['pseudo'] ?>" style="display:none">
                    </div>

                    <div id="email" style="display:block">
                        <h5>Email : </h5>
                        <p><?= $infoUser['email'] ?></p>
                    </div>

                    <div id="nouveauPassword" style="display:none">
                        <h3>Changer votre mot de passe</h3>

                        <label for="motPasseActuel">Votre mot de passe actuel :</label><br>
                        <input type="password" name="motPasseActuel" minlength="8"><br>

                        <label for="nouveauMotPasse">Nouveau mot de passe :</label><br>
                        <input type="password" name="nouveauMotPasse" minlength="8"><br>

                        <label for="nouveauMotPasse2">Confirmation du nouveau mot de passe : </label><br>
                        <input type="password" name="nouveauMotPasse2" minlength="8"><br>
                    </div>

                    <input type="submit" value="Valider" name="valider" id="valider" style="display:none">
                </form>
            </div>



           
            <div id="historiqueAchat" class="tabcontent">
                <div id="container-historique" class="container">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:50%">Product</th>
                                <th style="width:10%">Price</th>
                            </tr>
                        </thead>
                        <?php foreach ($tableauxHistorique as $historique) { ?>
                            <tbody>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs"><?php echo '<img id="imageHistorique" src="data:image/jpeg;base64,' . base64_encode($historique['image']) . '"/>' ?></div>
                                            <div class="col-sm-10">
                                                <h4 class="nomargin"><?php echo $historique['nom'] ?></h4>

                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price"><?php echo $historique['prix'] ?> </td>



                                </tr>

                            </tbody>

                        <?php } ?>
                    </table>
                </div>
            </div>

            <div id="wishlist" class="tabcontent">
                <h3>Whislist</h3>


                <div class="cart-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="table-wishlist">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="45%">Nom du produit</th>
                                                <th width="15%">prix</th>

                                                <th width="15%"></th>
                                                <th width="10%"></th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($tableauxWishlist as $wishlist) { ?>
                                            <tbody>
                                                <form action="" method="POST">
                                                    <tr>
                                                        <td width="45%">
                                                            <div class="display-flex align-center">
                                                                <div class="img-product">
                                                                    <?php
                                                                    echo '<img id="imgWishlist"  src="data:image/jpeg;base64,' . base64_encode($wishlist['image']) . '"/>'; ?>
                                                                </div>
                                                                <div class="name-product">
                                                                    <?= $wishlist['nom'] ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width="15%" class="price"><?= number_format($wishlist['prix'], 2)  ?>CHF</td>

                                                        <td width="15%"><input type="submit" id="info-button" name="AjoutPanier" value="&#xf07a;"></td>
                                                        <td width="10%" class="text-center"><input type="submit" id="info-button" name="supprimer" value="&#xf014;"></td>
                                                    </tr>
                                                    <input type="hidden" name="idJeux" value="<?= $wishlist['idJeux'] ?>">
                                                </form>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </main>

    <?php require_once "footer.php";
    ?>
    <script src="/assets/js/profil.js"></script>
</body>

</html>