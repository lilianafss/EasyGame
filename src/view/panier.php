<?php

use EasyGame\Model\PanierModel;

$tableauxPanier = PanierModel::getPanier($_SESSION['idUser']);

@ini_set('display_errors', 'on');
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <?php require_once "style.php" ?>
    <link rel="stylesheet" href="/assets/css/panier.css">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <?php require_once "header.php" ?>
        <?php $_SESSION['nbPanel'] = 1 ?>
    </header>

    <main class="flex-shrink-0">
        <?php if ($_SESSION['quantite'] == 0) { ?>
            <div id="sansJeux" class="alert alert-primary d-flex align-items-center w-100" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                <div>
                    Veuillez ajouter des jeux aux panier
                </div>
            </div>
        <?php } else { ?>
            <h1 class="text-center">Panier</h1>
            <div id="jeux-container">
              
                    <table id="cart" class="table table-hover table-condensed">
                        <?php foreach ($tableauxPanier as $panier) { ?>
                            <form method="POST">
                            <tr data-th="Product">
                                <td class="row">
                                    <div class="hidden-xs"><?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($panier['image']) . '"/>'; ?></div>
                                </td>

                                <td>
                                    <h4 class="nomargin"><?= $panier['nom'] ?></h4>
                                    
                                    <input type="hidden" name="idJeux" value="<?= $panier['idJeux'] ?>">
                                </div>

                                <div data-th="Price" class="panier-item">
                                    <?= number_format($panier['prix'], 2)  ?> CHF
                                </div>

                                <td class="actions" data-th="">
                                    <input class="rounded" type="submit" name="trash" value="Supprimer">
                                </td>
                            </tr>
                            </form>
                        <?php } ?>
                    </table>
            </div>
            <div id="payement-container">
                <form method="POST" action="/panier">
                    <div id="payement" class="container py-1">
                        <div class=" mx-auto">
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
                                    </div>

                                    <!-- Credit card form content -->
                                    <div class=" tab-content">
                                        <?php if ($_SESSION['nbPanel'] == 1) { ?>
                                            <div id="paypal">
                                                <?php if ($_SESSION['quantite'] != 0) { ?>
                                                    <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['total'];  ?> CHF" class="btn btn-primary mt-3 mb-3"></div>
                                                <?php } elseif ($_SESSION['quantite'] == 0) { ?>
                                                    <div><input type="submit" name="payer" value="Payer  0 CHF" class="btn btn-primary mb-3"></div>
                                                <?php  } ?>
                                                <p class="text-muted"> Note:Après avoir cliqué sur le bouton, vous serez dirigé vers une passerelle sécurisée pour le paiement. Après avoir terminé le processus de paiement, vous serez redirigé vers la page d'accueil du site</p>
                                            </div>
                                        <?php } ?>
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
                </form>
            </div>
        <?php } ?>
    </main>
    <?php require_once 'footer.php'; ?>
</body>

</html>