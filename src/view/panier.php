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
<?php require_once "header.php"; ?>

<body class="d-flex flex-column h-100">
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
   

        <td data-th="Price"><?= number_format($panier['prix'],2)  ?>CHF</td>



        <td class="actions" data-th="">


            <input type="submit" name="trash" value="Supprimer"><span>
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
                <div id="paiement-container">
                    <div class="container p-0">
                        <div class="card px-3">

                            <p class="h8 py-3">Information du paiement</p>
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Nom du proprietaire</p> <input class="form-control mb-3" type="text" placeholder="Name">
                                    </div>
                                </div>
                                <div class=" col-12">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">Numero de carte</p> <input class="form-control mb-3" type="text" placeholder="1234 5678 435 678">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">date de fin</p> <input class="form-control mb-3" type="text" placeholder="MM/YYYY">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column">
                                        <p class="text mb-1">CVV/CVC</p> <input class="form-control mb-3 pt-2 " type="password" placeholder="***">
                                    </div>
                                </div>
                                <div class="col-12">
                                <?php if($_SESSION['quantite']!=0){?>
                                    <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['total'];  ?> CHF" class="btn btn-primary mb-3"></div>
                                    <?php } elseif($_SESSION['quantite']==0){?>
                                        <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['totalPanier']?> CHF" class="btn btn-primary mb-3"></div>
                                        <?php  } ?>
                                    <!-- <div class="btn btn-primary mb-3"> <span class="ps-3">Payer ></span> <span class="fas fa-arrow-right"></span> </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php require_once 'footer.php'; ?>

</body>

</html>