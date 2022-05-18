<?php
namespace EasyGame\Controller;
use EasyGame\Model\PanierModel;
use EasyGame\Model\WishlistModel;
use EasyGame\Model\UserModel;
use EasyGame\Model\HistoriqueModel;

require_once('../src/php/tools.php');

class ProfilController{

    public function profil(){
        // Crée la session si elle n'existe pas
        SessionStart();
        $idUser = $_SESSION['idUser'];

        $infoUser = UserModel::getInfoUser($idUser);

        $tableauxWishlist = WishlistModel::getWishlist($_SESSION['idUser']);
        $tableauxHistorique = HistoriqueModel::getHistory($_SESSION['idUser']);

        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
        $submit = filter_input(INPUT_POST, 'valider', FILTER_SANITIZE_SPECIAL_CHARS);


        // if($submit == "Valider"){
        //     if( $pseudo != $infoUser['pseudo']){
        //         UserModel::updatePseudo($idUser,$pseudo);
        //     }
        // }

        /* -------------- Page Wishlist --------------*/

        
        $idJeux = filter_input(INPUT_POST, 'idJeux', FILTER_VALIDATE_INT);
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if($_POST['supprimer']){
                header("Refresh: 0");
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