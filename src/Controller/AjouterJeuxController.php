<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;
use Exception;

class AjouterJeuxController
{
    /**
     * Fonction de la page de ajouter jeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function ajouterJeux()
    {
        //start la fonction
        session_start();

        //si on est pas connecté en tant de admin on va a la page d'accueil
        if (!$_SESSION['admin']) {
            header("location: http://easygame.ch");
            exit();
        } else {
            $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
            $messageErreur = "";
            //on essaye de ajouter le jeu si on touche le bouton Envoyer
            if ($submit == "Envoyer") {

                //recuperer les donnees de l'image
                $nomJeux = filter_input(INPUT_POST, 'nomJeu', FILTER_SANITIZE_SPECIAL_CHARS);
                $description = filter_input(INPUT_POST, 'descrifJeu', FILTER_SANITIZE_SPECIAL_CHARS);
                $prix = floatval(filter_input(INPUT_POST, 'prixJeu', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
                $idPegi = filter_input(INPUT_POST, 'pegiJeu', FILTER_SANITIZE_NUMBER_INT);
                $idJeux = count(FonctionsBD::getGames()) + 1;
                $image = $_FILES['imageJeu']['tmp_name'];

                //si tout est rempli on l'ajoute a la base de donnée
                if ($nomJeux != "" && $description != "" && $prix != "" && $idPegi != "" && $image != "") {
                    $img = file_get_contents($image);
                    //FonctionsBD::newGame($idJeux, $nomJeux, $description, $prix, $idPegi, $img);
                } else {
                    //affichage de la message d'erreur
                    $messageErreur = "<p id='messageErreur'>Tous les champs doivent être remplis</p>";
                }
            }
        }
        require '../src/view/ajouterJeux.php';
    }

    public static function afficherGenres(){
        
    }
}