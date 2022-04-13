<?php

namespace EasyGame\Controller;

use EasyGame\model\BaseDonnee;
use EasyGame\model\GameModel;
use EasyGame\model\GenreModel;
use EasyGame\model\HistoriqueModel;
use EasyGame\model\NoteModel;
use EasyGame\model\PanierModel;
use EasyGame\model\PegiModel;
use EasyGame\model\PlatformModel;
use EasyGame\model\UserModel;
use EasyGame\model\WishlistModel;

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
