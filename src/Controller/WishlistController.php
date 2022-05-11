<?php
namespace EasyGame\Controller;
use EasyGame\Model\PanierModel;
use EasyGame\Model\WishlistModel;
require_once('../src/php/tools.php');

class WishlistController{
    public function wishlist(){
        // Crée la session si elle n'existe pas
        SessionStart();
        $idUser = $_SESSION['idUser'];
        $idJeux = filter_input(INPUT_POST, 'idJeux', FILTER_VALIDATE_INT);
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['AjoutPanier']) {

               $_SESSION["quantite"]++;

                if (!$_SESSION['connected']) {
                    header("Location: http://easygame.ch/connexion");
                    $_SESSION['idJeux'] = $idJeux;
                } else {
                    $panier = PanierModel::addGameToPanier($idUser, $idJeux);
                    header("Location: http://easygame.ch/panier");
                }
            }
        }
        require '../src/view/wishlist.php';
    }
}