<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\GameModel;
use EasyGame\Model\GenreModel;
use EasyGame\Model\PlatformModel;

require_once('../src/php/tools.php');

class AjouterJeuxController
{
    /**
     * Fonction de la page d'ajouter jeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function ajouterJeux()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        $messageErreur = "";
        $tableauGenre = [];
        $tableauPlatform = [];

        //si on n'est pas connecté en tant d'admin, on va à la page d'accueil
        if (!$_SESSION['admin']) {
            header("location: http://easygame.ch");
            exit();
        } else {

            $genre = GenreModel::getGenre();
            $plateforme = PlatformModel::getPlatform();

            $message = filter_input(INPUT_GET, "valid");
            if ($message == "ok") {
                //affichage du message d'erreur
                $messageErreur = "<p style='color: green;  font-size: 25px;' id='messageErreur'>Le jeu a bien été créé</p>";
            } elseif ($message == "not") {
                //affichage du message d'erreur
                $messageErreur = "<p id='messageErreur' style='color: red;  font-size: 25px;'>Tous les champs doivent être remplis</p>";
            } else {
                $messageErreur = "";
            }

            $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
            //on essaye d'ajouter le jeu si on touche le bouton Ajouter jeu
            if ($submit == "Ajouter jeu") {

                //recuperer les donnees et l'image
                $nomJeux = filter_input(INPUT_POST, 'nomJeu', FILTER_SANITIZE_SPECIAL_CHARS);
                $description = filter_input(INPUT_POST, 'descrifJeu', FILTER_SANITIZE_SPECIAL_CHARS);
                $prix = floatval(filter_input(INPUT_POST, 'prixJeu', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
                $idPegi = filter_input(INPUT_POST, 'pegiJeu', FILTER_SANITIZE_NUMBER_INT);
                $image = $_FILES['imageJeu']['tmp_name'];

                //prendre les valeurs et les stocks dans une variable
                for ($i = 1; $i <= 10; $i++) {

                    $test = filter_input(INPUT_POST, 'nbGenre' . $i, FILTER_SANITIZE_NUMBER_INT);
                    //condition pour savoir si test a des valeurs
                    if ($test) {
                        //ajout du genre au tableau 
                        $tableauGenre[$i] = $test;
                    }
                }
                //pas avoir la même valeur deux ou plusieurs fois
                $tableauGenre = array_unique($tableauGenre);



                //prendre les valeurs et les stocks dans une variable
                for ($i = 1; $i <= 4; $i++) {

                    $test = filter_input(INPUT_POST, 'nbPlatform' . $i, FILTER_SANITIZE_NUMBER_INT);
                    //condition pour savoir si test a des valeurs
                    if ($test) {
                        //ajout de la plateforme au tableau
                        $tableauPlatform[$i] = $test;
                    }
                }
                //pas avoir la même valeur deux ou plusieurs fois
                $tableauPlatform = array_unique($tableauPlatform);


                //si tout est rempli on l'ajoute a la base de donnée
                if ($nomJeux != "" && $description != "" && $prix != "" && $idPegi != "" && $image != "" && $tableauGenre != [] && $tableauPlatform != []) {
                    $img = file_get_contents($image);
                    GameModel::newGame($nomJeux, $description, $prix, $idPegi, $img, $tableauGenre, $tableauPlatform);
                    header("Location:http://easygame.ch/ajouterJeux?valid=ok");
                } else {
                    header("Location:http://easygame.ch/ajouterJeux?valid=not");
                }
            }
        }
        require '../src/view/ajouterJeux.php';
    }
}
