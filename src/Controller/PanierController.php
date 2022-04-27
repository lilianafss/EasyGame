<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\GameModel;
use EasyGame\Model\GenreModel;
use EasyGame\Model\HistoriqueModel;
use EasyGame\Model\NoteModel;
use EasyGame\Model\PanierModel;
use EasyGame\Model\PegiModel;
use EasyGame\Model\PlatformModel;
use EasyGame\Model\UserModel;
use EasyGame\Model\WishlistModel;

class PanierController
{
    public function panier()
    {
        session_start();
      
        $total=0;
        $userUtilisateur = $_SESSION['idUser'];
        $tableauxPanier = PanierModel::getPanier($userUtilisateur); 
        $jeux=GameModel::getGames($userUtilisateur);   
       
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
        
                PanierModel::deleteGameToPanier($_SESSION["test"]);
        }  }
            //echo "$total2";
        
        
        require_once "../src/view/panier.php";
    }
    
}
