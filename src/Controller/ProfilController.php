<?php

namespace EasyGame\Controller;

use EasyGame\Model\PanierModel;
use EasyGame\Model\WishlistModel;
use EasyGame\Model\UserModel;
use EasyGame\Model\HistoriqueModel;

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
        $sucessMessage = "";

        $nom = filter_input(INPUT_POST, 'editNom', FILTER_SANITIZE_SPECIAL_CHARS);
        $prenom = filter_input(INPUT_POST, 'editPrenom', FILTER_SANITIZE_SPECIAL_CHARS);
        $pseudo = filter_input(INPUT_POST, 'editPseudo', FILTER_SANITIZE_SPECIAL_CHARS);
        $tableauxWishlist = WishlistModel::getWishlist($idUser);
        $tableauxHistorique = HistoriqueModel::getHistory($idUser);
        $motPasseActuelBD = UserModel::getInfoUser($idUser);
        $motPasseActuel = filter_input(INPUT_POST, 'motPasseActuel', FILTER_SANITIZE_SPECIAL_CHARS);
        $nouveauMotPasse = filter_input(INPUT_POST, 'nouveauMotPasse', FILTER_SANITIZE_SPECIAL_CHARS);
        $nouveauMotPasse2 = filter_input(INPUT_POST, 'nouveauMotPasse2', FILTER_SANITIZE_SPECIAL_CHARS);

        $submit = filter_input(INPUT_POST, 'valider', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$_SESSION['connected']) {
            header("location: http://easygame.ch");
            exit();
        } else {
            if ($submit == "Valider") {
                if ($nom != "") {
                    if ($nom != $infoUser['nom']) {
                        UserModel::updateInfoUser($idUser, 'nom', $nom);
                        $sucessMessage .= "<p>Le nom a bien été modifié</p>";
                    } elseif ($nom == $infoUser['nom']) {
                        $errorMessage .= "<p>Le nom est identique</p>";
                    }
                }

                if ($prenom != "") {
                    if ($prenom != $infoUser['prenom']) {
                        UserModel::updateInfoUser($idUser, 'prenom', $prenom);
                        $sucessMessage .= "<p>Le prenom a bien été modifié</p>";
                    } elseif ($prenom == $infoUser['prenom']) {
                        $errorMessage .= "<p>Le prenom est identique</p>";
                    }
                }

                if ($pseudo != "") {
                    if ($pseudo != $infoUser['pseudo']) {
                        UserModel::updateInfoUser($idUser, 'pseudo', $pseudo);
                        $sucessMessage .= "<p>Le pseudo a bien été modifié</p>";
                    } elseif ($pseudo == $infoUser['pseudo']) {
                        $errorMessage .= "<p>Le pseudo est identique</p>";
                    }
                }

                if ($motPasseActuel != "" && $nouveauMotPasse != "" && $nouveauMotPasse2 != "") {
                    if (password_verify($motPasseActuel, $motPasseActuelBD['password'])) {
                        if ($nouveauMotPasse == $nouveauMotPasse2) {
                            $passwordHash = password_hash($nouveauMotPasse, PASSWORD_BCRYPT);
                            UserModel::updateInfoUser($idUser, 'password', $passwordHash);
                            $sucessMessage .= "<p>Le mot de passe a bien été modifié</p>";
                        } elseif ($nouveauMotPasse != $nouveauMotPasse2) {
                            $errorMessage .= "<p>Les mot de passe ne sont pas identique</p>";
                        }
                    } else {
                        $errorMessage .= "<p>Le mot de passe erroné</p>";
                    }
                }
                $infoUser = UserModel::getInfoUser($idUser);
            }

            /* -------------- Page Wishlist --------------*/


            $idJeux = filter_input(INPUT_POST, 'idJeux', FILTER_VALIDATE_INT);

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($_POST['supprimer']) {
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
        }

        require '../src/view/profil.php';
    }
}
