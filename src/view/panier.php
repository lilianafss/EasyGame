

<?php  

use EasyGame\model\FonctionsBD;
$tableauxPanier = FonctionsBD::getPanier($_SESSION['idUser']);


?><!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <!--<link rel="stylesheet" href="assets/css/panier.css">-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <?php require_once "style.php" ?>
</head>
<?php require_once "header.php"; ?>

<body class="h-100">
    <h1>panier</h1>
    <form method="POST">

        <main>
            <div id="jeux-container">

                <table id="cart" class="table table-hover table-condensed">

                    <tbody>
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                    <?php      foreach ($tableauxPanier as $panier) {?>
                        <tr>
                            <td>
                                <div class="col-sm-5 hidden-xs"><?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($panier['image']) . '"/>'; ?></div>
                            <td>
                                <div class="col-sm-10">
                                    <h4 class="nomargin"><?= $panier['nom'] ?></h4>

                                </div>
            </div>
            </td>
            <td data-th="Price"><?= $panier['prix'] ?></td>

            <td class="actions" data-th="">
                <form method="POST">

                    <input type="submit" name="trash" value="Supprimer"><span><i class="fa fa-trash-o"></i></span>
                </form>
            </td>
            </tr> 
            </div>
            </tr>
            </tbody>
            <?php } ?>

            </table>
            </div>
            <div id="paiement-container">
                <div class="container p-0">
                    <div class="card px-3">

                        <p class="h8 py-3">Information du paiement</p>
                        <div class="row gx-3">
                            <div class="col-12">
                                <div class="d-flex flex-column">
                                    <p class="text mb-1">Nom du proprietaire</p> <input class="form-control mb-3" type="text" placeholder="Name" ">
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
                                    <div class="btn btn-primary mb-3"> <span class="ps-3">Payer</span> <span class="fas fa-arrow-right"></span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
    </form>
    <?php require_once "footer.php"; ?>

</body>

</html>