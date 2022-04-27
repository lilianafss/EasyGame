<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class PanierController
{
    public function panier()
    {
        session_start();
      
        $total=0;
        $userUtilisateur = $_SESSION['idUser'];
        $tableauxPanier = FonctionsBD::getPanier($userUtilisateur); 
        $jeux=FonctionsBD::getGames($userUtilisateur);   
       
        foreach ($tableauxPanier as $panier)
        {
          
          $total+=$panier['prix'];
          $_SESSION['total']=$total;
          $idJeux=$panier['idJeux'];
          $_SESSION["test"]=$idJeux;
         
          
        }
       
        if ($_SERVER['REQUEST_METHOD'] == "POST") 
        {
            if ($_POST['trash']) 
            {
        
                FonctionsBD::deleteGameToPanier($_SESSION["test"]);
        }  }
            //echo "$total2";
        
        
        require_once "../src/view/panier.php";
    }
    
}
