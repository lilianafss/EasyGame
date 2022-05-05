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

      
            <form method="POST" action="/panier">
               
                <div class="container py-5">
      
      <div class="row">
          <div class="col-lg-6 mx-auto">
              <div class="card ">
                  <div class="card-header">
                      <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                          <form action="" method="get">
                          <!-- Credit card form tabs -->
                          <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                              <li class="nav-item"> <a data-toggle="pill" href="?methodPayement=CreditCard"  class="nav-link  active"> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                              <li class="nav-item"> <a data-toggle="pill" href="?methodPayement=Paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                          </ul>
                          </form>
                      </div> <!-- End -->
                      <!-- Credit card form content -->
                      <div class="tab-content">
                          <?php
                          if ($_GET["methodPayement"] == "CreditCard" ) 
                          { ?>
                              <div id="credit-card" class="tab-pane fade show active pt-3">
                              <form role="form" onsubmit="event.preventDefault()">
                                  <div class="form-group"> <label for="username">
                                          <h6>Card Owner</h6>
                                      </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                  <div class="form-group"> <label for="cardNumber">
                                          <h6>Card number</h6>
                                      </label>
                                      <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                          <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-8">
                                          <div class="form-group"> <label><span class="hidden-xs">
                                                      <h6>Expiration Date</h6>
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
                                 
                                <?php if($_SESSION['quantite']!=0){?>
                                    <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['total'];  ?> CHF" class="btn btn-primary mb-3"></div>
                                    <?php } elseif($_SESSION['quantite']==0){?>
                                        <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['totalPanier']?> CHF" class="btn btn-primary mb-3"></div>
                                        <?php  } ?>
                                  
                              </form>
                          </div>
                      
                        <?php  }
                          elseif ($_GET["methodPayement"] == "Paypal") { ?>
                              <div id="paypal" >
              
                      <?php if($_SESSION['quantite']!=0){?>
                                    <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['total'];  ?> CHF" class="btn btn-primary mb-3"></div>
                                    <?php } elseif($_SESSION['quantite']==0){?>
                                        <div><input type="submit" name="payer" value="Payer  <?php echo $_SESSION['totalPanier']?> CHF" class="btn btn-primary mb-3"></div>
                                        <?php  } ?>
                                  
                      <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                  </div>
                             
                         <?php } ?>
                  </div>
              </div>
          </div>
      </div>
      <script>$(function() {
          $('[data-toggle="tooltip"]').tooltip()
        })</script>
                </div>
            </form>
        </div>
    </main>

    <?php require_once 'footer.php'; ?>

</body>

</html>
