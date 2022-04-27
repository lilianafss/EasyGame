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
        $idJeux = filter_input(INPUT_POST, 'idJeux');
        //$idJeux=$_SESSION['idJeux'];
        $content = "";
        $info = "";
        $userUtilisateur = $_SESSION['idUser'];
        $infoJeux = GameModel::getGameById($idJeux);
        $tableauxPanier = PanierModel::getPanier($userUtilisateur);

        $total2=0;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['trash']) {
                echo "s";
                PanierModel::deleteGameToPanier($idJeux);
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
