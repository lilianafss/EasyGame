<?php

use EasyGame\Model\PanierModel;

$tableauxPanier = PanierModel::getPanier($_SESSION['idUser']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Document</title>
   <?php require_once "style.php" ?>
</head>

<body>
   <form method="POST">
      <?php foreach ($tableauxPanier as $panier) { ?>
         <input type="hidden" name="idJeux" value="<?= $panier['idJeux'] ?>">


      <?php } ?>

      <div id="div-container" class="container">
         <div class="row">
            <div class="col-md-6 mx-auto mt-5">
               <div class="payment">
                  <div class="payment_header">
                     <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                  </div>
                  <div class="content">
                     <h1>Paiement reussi !</h1>
                     <p>Votre achat a bien été effectuer</p>
                     <input type="submit" name="retourPageAccueil" value="Retourner vers la page d'accueil">
                    
                  </div>

               </div>
            </div>
         </div>
      </div>
      </div>
   </form>
</body>

</html>