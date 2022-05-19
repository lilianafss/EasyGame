<?php

use EasyGame\Model\PanierModel;

$tableauxPanier = PanierModel::getPanier($_SESSION['idUser']);


?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>

    <?php require_once "style.php" ?>
</head>
<?php require_once "header.php";
$_SESSION['nbPanel'] = 1 ?>

<body class="d-flex flex-column h-100">
    <?php if ($_SESSION['quantite'] == 0) { ?>
        <div id="sansJeux" class="alert alert-primary d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
                Veuillez ajouter des jeux aux panier
            </div>


        <?php } else { ?>
            <h1>panier</h1>

            <main class="flex-shrink-0">
                <div id="jeux-container">
                    <table id="cart" class="table table-hover table-condensed">
                        <tbody>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <?php foreach ($tableauxPanier as $panier) { ?>
                                            <form method="POST">
                            <tr>
                                <td>
                                    <div class="col-sm-5 hidden-xs"><?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($panier['image']) . '"/>'; ?></div>
                                <td>
                                    <div class="col-sm-10">
                                        <h4 class="nomargin"><?= $panier['nom'] ?></h4>

                                    </div>
                                    <div>
                                        <input type="hidden" name="idJeux" value="<?= $panier['idJeux'] ?>">

                                    </div>
                </div>
                </td>


                <td data-th="Price"><?= number_format($panier['prix'], 2)  ?>CHF</td>



                <td class="actions" data-th="">


                    <input class="rounded" type="submit" name="trash" value="Supprimer"><span>
                        <!--<i class="fa fa-trash-o">--></i>

                </td>
                </tr>
        </div>
        </tr>
        </tbody>
        </form>
    <?php } ?>

    </table>
    </div>

    <div id="test">

        <form method="POST" action="/panier">

            <div id="payement" class="container py-1">
                <div class="col-lg-6 mx-auto">
                    <div class="card ">
                        <div class="card-header">
                            <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                                <form action="" method="get">
                                    <!-- Credit card form tabs -->
                                    <ul id="moyen" role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-2">
                                        <!-- <li id="credit" class="nav-item"> <a id="creditText" data-toggle="pill" href="?methodPayement=CreditCard" class="nav-link  "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li> -->
                                        <li class="nav-item"> <a data-toggle="pill" href="?methodPayement=Paypal" class="nav-link "> <i class="fab fa-paypal mr-2" "></i> Paypal </a> </li>
                                        </ul>
                                    </form>
                                </div> <!-- End -->
                                <!-- Credit card form content -->
                                
                                <div class=" tab-content">
                                                    <?php
                                                    if ($_SESSION['nbPanel'] == 1) {
                                                   { ?>
                                                                <div id="paypal">
                                                                    <?php if ($_SESSION['quantite'] != 0) { ?>
                                                                        <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['total'];  ?> CHF" class="btn btn-primary mb-3"></div>
                                                                    <?php } elseif ($_SESSION['quantite'] == 0) { ?>
                                                                        <div><input type="submit" name="payer" value="Payer  0 CHF" class="btn btn-primary mb-3"></div>
                                                                    <?php  } ?>


                                                                    <p class="text-muted"> Note:Après avoir cliqué sur le bouton, vous serez dirigé vers une passerelle sécurisée pour le paiement. Après avoir terminé le processus de paiement, vous serez redirigé vers la page d'accueil du site</p>
                                                                </div>

                                                            <?php } ?>
                                                        <?php  } ?>
                                                        <?php  }?>
                                                        <!--                                                    

                                                        <div id="credit-card" class="tab-pane fade show active pt-3">
                                                            <form role="form" onsubmit="event.preventDefault()">
                                                                <div class="form-group"> <label for="username">
                                                                        <h6>Propriétaire de la carte</h6>
                                                                    </label> <input type="text" name="username" placeholder="Nom du propriétaire de la carte" required class="form-control "> </div>
                                                                <div class="form-group"> <label for="cardNumber">
                                                                        <h6>Numéro de la carte</h6>
                                                                    </label>
                                                                    <div class="input-group"> <input type="text" name="cardNumber" placeholder="Numéro de la carte" class="form-control " required>
                                                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="form-group"> <label><span class="hidden-xs">
                                                                                    <h6>Date d'expiration</h6>
                                                                                </span></label>
                                                                            <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                                            </label> <input type="text" required class="form-control"> </div>
                                                                    </div>
                                                                </div> 

                                                                <?php if ($_SESSION['quantite'] != 0) { ?>
                                                                    <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['total'];  ?> CHF" class="btn btn-primary mb-3"></div>
                                                                <?php } elseif ($_SESSION['quantite'] == 0) { ?>
                                                                    <div><input type="submit" name="payer" value="Payer  0 CHF" class="btn btn-primary mb-3"></div>
                                                                <?php  } ?>
                                                        

                                                            </form>
                                                        </div>-->



                            </div>
                        </div>
                    </div>
                </div>
            </div>
    



        <script>
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </div>
    </form>
    </div>

    </main>


    <?php require_once 'footer.php'; ?>

</body>

</html>