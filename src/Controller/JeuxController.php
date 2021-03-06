<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\CommentaireModel;
use EasyGame\Model\GameModel;
use EasyGame\Model\NoteModel;
use EasyGame\Model\PanierModel;
use EasyGame\Model\WishlistModel;

require_once('../src/php/config.php');
require_once('../src/php/tools.php');

//@ini_set('display_errors', 'on');
class JeuxController
{
    public static function jeux()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        $idJeux = filter_input(INPUT_GET, 'idJeux');

        if ($idJeux != "") {

            $note = "";
            $content = "";
            $commentaire = "";
            $messageSucess="";
            $quantite = 0;
            $envoiePanier = filter_input(INPUT_POST, 'panier');
            $idUser = $_SESSION['idUser'];

            $infoJeux = GameModel::getGameById($idJeux);
            $tableauxCommentaire = CommentaireModel::getComments($idJeux);
            $tableauxNotes = NoteModel::getNotes($idJeux);
            $tableauxPanier = PanierModel::getPanier($idUser);
            $numeroCommentaires = CommentaireModel::countComments($idJeux);
            $etoiles = "\f005";

            $submit = filter_input(INPUT_POST, 'envoyer', FILTER_SANITIZE_SPECIAL_CHARS);
            $btnPanier = filter_input(INPUT_POST, 'panier', FILTER_SANITIZE_SPECIAL_CHARS);
            $btnWishlist = filter_input(INPUT_POST, 'wishlist', FILTER_SANITIZE_SPECIAL_CHARS);

            //Récupération des notes et commentaires
            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
            $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);

            //Si le button envoyer est egal a "AjouterCommentaire"
            if ($submit == "Ajouter commentaire") {

                //Si les inputs commentaire et note n'est pas egal a vide
                if ($commentaire != "" && $note != "" &&  $idUser != "") {
                    //ajouter les notes et commentaires a la base de donnees
                    CommentaireModel::addCommentToGame($commentaire, $idJeux, $idUser);
                    NoteModel::addNoteToGame($note, $idJeux, $idUser);
                    $content .= $etoiles;
                } elseif ($commentaire != "" && $idUser != "") {
                    CommentaireModel::addCommentToGame($commentaire, $idJeux, $idUser);
                }
                header("Refresh: 0;url=jeux?idJeux=$idJeux");
            }
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                // Si le bouton est clique, on ajoute le jeu à la wishlist
                if ($btnWishlist == "Ajouter à la wishlist") {
               
                    WishlistModel::addGameToWishlist($idUser, $idJeux);
                    $messageSucess="Ton jeu a été ajouter à ta wishlist";
                }elseif($btnWishlist=="Dans la wishlist"){
                    RedirectUser(url("profil"));
                }
                // Si le bouton est clique, on ajoute le jeu au panier
                if ($btnPanier == "Ajouter dans le panier")
                {
                    $quantite++;
                    $_SESSION["quantite"] = $quantite;

                    if (!$_SESSION['connected'])
                    {
                        $_SESSION['idJeux'] = $idJeux;

                        // Redirige l'utilisateur vers la page de connexion
                        RedirectUser(url("connexion"));
                    }
                    else
                    {
                        $panier = PanierModel::addGameToPanier($idUser, $idJeux);

                        // Redirige l'utilisateur vers le panier
                        RedirectUser(url("panier"));
                    }
                }
                else if ($btnPanier == "Dans le panier")
                {
                    // Redirige l'utilisateur vers le panier
                    RedirectUser(url("panier"));
                }
            }
        } else {
            // Redirige l'utilisateur vers la page d'accueil
            RedirectUser("");
        }
        require '../src/view/jeux.php';
    }
}
