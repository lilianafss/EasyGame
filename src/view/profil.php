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
    <style>
        input[type="submit"] {
            font-family: FontAwesome;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

    <header>
        <?php require_once "header.php" ?>
    </header>

    <?php if ($sucessMessage != "") { ?>
        <!-- <div class="alert alert-success" role="alert">
           
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> -->
        <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi-info-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            <div>
                <?= $sucessMessage ?>
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php
    } ?>

    <?php if ($errorMessage != "") { ?>
        <!-- <div class="alert alert-danger" role="alert">
            
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> -->
        <div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi-exclamation-octagon-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <?= $errorMessage ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <?php echo '<img class="rounded-circle mt-5" width="160px" src="data:image/jpeg;base64,' . base64_encode($infoUser['avatar']) . '"/>' ?>
                                <span class="font-weight-bold"><?php echo $infoUser['prenom'] . " " . $infoUser['nom'] ?></span>
                                <span class="text-black-50"><?= $infoUser['email'] ?></span>
                                <span> </span>
                            </div>
                        </div>
                        <div class="col-md-5 border-right">
                            <form action="" method="post">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h2 class="text-right">Informations personnelles</h2>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label class="labels">Nom</label>
                                            <p class="text-muted" id="nomActuel"><?= $infoUser['nom'] ?></p>
                                            <input type="text" class="form-control" name="editNom" id="editNom" placeholder="<?= $infoUser['nom'] ?> " style="display:none">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="labels">Prenom</label>
                                            <p class="text-muted" id="prenomActuel"><?= $infoUser['prenom'] ?></p>
                                            <input type="text" class="form-control" name="editPrenom" id="editPrenom" placeholder="<?= $infoUser['prenom'] ?>" style="display:none">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Nom d'utilisateur</label>
                                            <p class="text-muted" id="pseudoActuel"><?= $infoUser['pseudo'] ?></p>
                                            <input type="text" class="form-control" name="editPseudo" id="editPseudo" placeholder="<?= $infoUser['pseudo'] ?>" style="display:none">
                                        </div>
                                    </div><br>
                                    <div class="row mt-3">
                                        <div class="col-md-6" id="motPasseActuel">
                                            <label class="labels">Mot de passe</label>
                                            <p class="text-muted">Si vous voulez changer le mot de passe, cliquez sur le bouton modifier</p>
                                        </div>
                                    </div>
                                    <div id="editPasseActuel" style="display: none;">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="text-right">Mot de passe</h5>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Votre mot de passe actuel</label>
                                                <input type="password" class="form-control" name="motPasseActuel" minlength="8">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Nouveau mot de passe</label>
                                                <input type="password" class="form-control" name="nouveauMotPasse" minlength="8">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Confirmation du nouveau mot de passe</label>
                                                <input type="password" class="form-control" name="nouveauMotPasse2" minlength="8"><br>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mt-5 text-center">
                                        <input type="submit" onclick="editProfil()" class="btn btn-primary profile-button" value="Sauvegarder" name="valider" id="valider" style="display:none">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 py-5">
                                <button onclick="editProfil()" id="editer" class="btn btn-primary profile-button" type="button">modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="historiqueAchat" class="tabcontent">

            <h1>Historique d'achat</h1>
                <table>
                    <tbody>
                        <?php foreach ($tableauxHistorique as $historique) { ?>
                            <tr id="row">
                                <td id="first-child">

                                    <?php echo '<img id="imageHistorique" src="data:image/jpeg;base64,' . base64_encode($historique['image']) . '"/>' ?>

                                </td>
                                <td id="second-child">

                                    <h4>
                                        <?php echo $historique['nom'] ?>
                                    </h4>

                                </td>
                                <td id="third-child">
                                    <p>
                                      <?php echo $historique['prix'] ?> CHF 
                                    </p>
                                    
                                </td>
                                <td id="fourth-child">
                                    <div class="round" onclick=" Redirection(<?= $historique['idJeux'] ?>) ">
                                        <div id="cta">
                                            <span class="arrow primera next "></span>
                                            <span class="arrow segunda next "></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                           
                        <?php } ?>
                    </tbody>
                </table>
            </div>




            <div id="wishlist" class="tabcontent">
            <h1>Wishlist</h1>
                <section id="wishlistSection" class="grid-view wishlist-items">
                    <?php foreach ($tableauxWishlist as $wishlist) { ?>
                        <form action="" method="POST">
                            <div class="card ecommerce-card" onclick=" Redirection(<?= $wishlist['idJeux'] ?>) ">
                                <div class="item-img text-center">
                                    <?php echo '<img id="imgWishlist"  src="data:image/jpeg;base64,' . base64_encode($wishlist['image']) . '"/>'; ?>
                                </div>
                                <div class="card-body">
                                    <div class="item-name">
                                        <p> <?= $wishlist['nom'] ?> </p>
                                    </div>
                                    <div class="item-cost">
                                        <h6 class="item-price"><?= number_format($wishlist['prix'], 2)  ?> CHF </h6>
                                    </div>
                                </div>
                                <div class="item-options">
                                    <input type="submit" name="supprimer" class="btn btn-danger waves-effect waves-float waves-light" value="&#xf014;">
                                    <!-- <input type="submit" name="AjoutPanier" class="btn btn-primary waves-effect waves-float waves-light" value="&#xf07a;"> -->
                                </div>
                                <input type="hidden" name="idJeux" value="<?= $wishlist['idJeux'] ?>">
                            </div>
                        </form>
                    <?php } ?>
                </section>
            </div>
        </div>
    </main>
    <?php require_once "footer.php";
    ?>
    <script src="/assets/js/profil.js"></script>
</body>

</html>