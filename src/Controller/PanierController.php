<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class PanierController
{
    public function panier()
    {
        session_start();
        $idJeux = filter_input(INPUT_POST, 'idJeux');
        //$idJeux=$_SESSION['idJeux'];
        $content = "";
        $info = "";
        $userUtilisateur = $_SESSION['idUser'];
        $infoJeux = FonctionsBD::getGameById($idJeux);
        $tableauxPanier = FonctionsBD::getPanier($userUtilisateur);

        $total2=0;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['trash']) {
                echo "s";
                FonctionsBD::deleteGameToPanier($idJeux);
            }
        }
      
        foreach ($tableauxPanier as $panier) {
        
          $total=$panier['prix'];
          $total2+=$total;
          var_dump($total2);
            //echo "$total2";
         
        }
        require_once "../src/view/panier.php";
    }
}
