<?php

namespace EasyGame\Controller;

use EasyGame\Model\PanierModel;
use EasyGame\Model\WishlistModel;
use EasyGame\Model\UserModel;

require_once('../src/php/tools.php');

class ProfilController
{

    public function profil()
    {
        // Crée la session si elle n'existe pas
        SessionStart();
        $idUser = $_SESSION['idUser'];

        $infoUser = UserModel::getInfoUser($idUser);

        $errorMessage = "";

        $nom = filter_input(INPUT_POST, 'editNom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'editPrenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $pseudo = filter_input(INPUT_POST, 'editPseudo', FILTER_SANITIZE_SPECIAL_CHARS);

        $motPasseActuelBD = UserModel::getInfoUser($idUser);
        $motPasseActuel = filter_input(INPUT_POST, 'motPasseActuel', FILTER_SANITIZE_SPECIAL_CHARS);
        $nouveauMotPasse = filter_input(INPUT_POST, 'nouveauMotPasse', FILTER_SANITIZE_SPECIAL_CHARS);
        $nouveauMotPasse2 = filter_input(INPUT_POST, 'nouveauMotPasse2', FILTER_SANITIZE_SPECIAL_CHARS);

        $submit = filter_input(INPUT_POST, 'valider', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($submit == "Valider") {
           if ($nom != "" || $pseudo != "" || $prenom != "" || $motPasseActuel != "" || $nouveauMotPasse != "" || $nouveauMotPasse2 != "") {
                if ($nom != $infoUser['editNom']) {
                    UserModel::updateInfoUser($idUser, 'nom', $nom);
                    $errorMessage.="Le nom a bien été modifié";
                     

                }elseif ($prenom != $infoUser['editPrenom']) {
                    UserModel::updateInfoUser($idUser, 'prenom', $prenom);
                    $errorMessage .= "Le prenom a bien été modifié";

                }
                elseif ($pseudo != $infoUser['editPseudo']) {
                    UserModel::updateInfoUser($idUser, 'pseudo', $pseudo);
                    $errorMessage .= "Le pseudo a bien été modifié";


                }elseif (password_verify($motPasseActuel, $motPasseActuelBD['password'])) {
                    if ($nouveauMotPasse == $nouveauMotPasse2) {
                        $passwordHash = password_hash($nouveauMotPasse, PASSWORD_BCRYPT);
                        UserModel::updateInfoUser($idUser, 'password', $passwordHash);
                        $errorMessage .= "Le mot de passe a bien été modifié";
                    }
                }else{
                    $errorMessage="pas bien";
                }

                $infoUser = UserModel::getInfoUser($idUser);
            }
            
        }
        
        /* -------------- Page Wishlist --------------*/


        $idJeux = filter_input(INPUT_POST, 'idJeux', FILTER_VALIDATE_INT);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['supprimer']) {
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
