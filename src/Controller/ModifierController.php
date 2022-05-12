<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\GameModel;
use EasyGame\Model\GenreModel;
use EasyGame\Model\HistoriqueModel;
use EasyGame\Model\NoteModel;
use EasyGame\Model\PanierModel;
use EasyGame\Model\PegiModel;
use EasyGame\Model\PlatformModel;
use EasyGame\Model\UserModel;
use EasyGame\Model\WishlistModel;
use PDOException;

require_once('../src/php/tools.php');

class ModifierController
{
    /**
     * Modification du jeu choisi
     *
     * @return void
     * @author De Castilho E Sousa Rodrigo
     */
    public function modifierJeu()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        //declaration de la message d'erreur
        $message = filter_input(INPUT_GET, "message");

        $tableauPlatform = [];
        $tableauGenre = [];

        if (!$_SESSION['admin']) {
            header("location: http://easygame.ch");
            exit();
        } else {
            //recuperer l'id du jeu
            $idJeu = filter_input(INPUT_GET,'idJeux');
            
            $genreChange = GenreModel::getGenre();
            $plateformeChange = PlatformModel::getPlatform();
            $pegis = PegiModel::getPegi();

            //recuperer les informations du jeu
            $jeu = GameModel::getGameById($idJeu);
            //recuperer les genres du jeu
            $genres = GenreModel::getGameGenre($idJeu);
            //recuperer les plateformes du jeu
            $plateformes = PlatformModel::getGamePlatform($idJeu);

            $submit = filter_input(INPUT_POST,'submit', FILTER_SANITIZE_SPECIAL_CHARS);
            
            if($submit == "changer"){
                $nomJeu = filter_input(INPUT_POST,'nomJeu', FILTER_SANITIZE_SPECIAL_CHARS);
                $description = filter_input(INPUT_POST,'desriptionJeu', FILTER_SANITIZE_SPECIAL_CHARS);
                $prixJeu = floatval(filter_input(INPUT_POST, 'prixJeu', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
                $pegi = filter_input(INPUT_POST,'pegiJeu',FILTER_SANITIZE_NUMBER_INT);

                $idJeu = filter_input(INPUT_GET,'idJeux');

                 //prendre les valeurs et les stocks dans une variable
                for ($i = 1; $i <= 10; $i++) {

                    $test = filter_input(INPUT_POST, 'nbGenre' . $i, FILTER_SANITIZE_NUMBER_INT);
                    //condition pour savoir si test a des valeurs
                    if ($test) {
                        //ajout du genre au tableau 
                        $tableauGenre[$i] = intval($test);
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
                        $tableauPlatform[$i] = intval($test);

                    }
                }
                //pas avoir la même valeur deux ou plusieurs fois
                $tableauPlatform = array_unique($tableauPlatform);

                var_dump($tableauGenre);
                var_dump($tableauPlatform);
                if($nomJeu != "" && $description != "" && $prixJeu != "" && $prixJeu > 0 && $pegi != ""){
                    if($tableauGenre != []){
                        GameModel::deleteGenres($idJeu);
                        GameModel::ajouterGenres($idJeu, $tableauGenre);
                    }

                    if($tableauPlatform != []){
                        GameModel::deletePlateformes($idJeu);
                        GameModel::ajouterPlateformes($idJeu, $tableauPlatform);
                    }
                    
                    GameModel::updateGame($idJeu, $nomJeu, $description, $prixJeu, $pegi);
                    $message .= "<p>Le jeu a bien été modifier</p>";
                    header("Location:http://easygame.ch/modifier?idJeux=".$idJeu."&message=ok");
                }
                else{
                    $message = "Les champs doivent être remplis";
                    header("Location:http://easygame.ch/modifier?idJeux=".$idJeu."&message=non");
                }
            }
        }
        require '../src/view/modifierJeu.php';
    }
}