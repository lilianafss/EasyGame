<?php
namespace EasyGame\Controller;
use EasyGame\Model\PanierModel;
use EasyGame\Model\WishlistModel;
require_once('../src/php/tools.php');

class ProfilController{

    public function profil(){
        // Crée la session si elle n'existe pas
        SessionStart();
        $idUser = $_SESSION['idUser'];
        $idJeux = filter_input(INPUT_POST, 'idJeux', FILTER_VALIDATE_INT);
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if($_POST['supprimer']){
                WishlistModel::deleteGameToWishlist($idJeux);
            }
            if ($_POST['AjoutPanier']) {

               $_SESSION["quantite"]++;

                if (!$_SESSION['connected']) {
                    header("Location: http://easygame.ch/connexion");
                    $_SESSION['idJeux'] = $idJeux;
                } else {
                    $panier = PanierModel::addGameToPanier($idUser, $idJeux);
                    WishlistModel::deleteGameToWishlist($idJeux);
                    header("Location: http://easygame.ch/panier");
                }
            }
        }
        require '../src/view/profil.php';
    }
}