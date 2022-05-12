<?php
namespace EasyGame\Controller;
use EasyGame\Model\PanierModel;
use EasyGame\Model\WishlistModel;
use EasyGame\Model\UserModel;

require_once('../src/php/tools.php');

class ProfilController{

    public function profil(){
        SessionStart();
        $idUser = $_SESSION['idUser'];

        $infoUser = UserModel::getInfoUser($idUser);

        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
        $submit = filter_input(INPUT_POST, 'valider', FILTER_SANITIZE_SPECIAL_CHARS);


        if($submit == "Valider"){
            if( $pseudo != $infoUser['pseudo']){
                UserModel::updatePseudo($idUser,$pseudo);
            }
        }

        /* -------------- Page Wishlist --------------*/

        // Crée la session si elle n'existe pas
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
        require '../src/view/profil.php';
    }
}