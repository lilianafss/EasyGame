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

require_once('../src/php/config.php');
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

        // Declaration du message d'erreur
        $messageErreur = "";

        //declaration des variables
        $nomJeu = "";
        $description = "";
        $prixJeu = "";
        $pegi = "";
        
        $bool = false;

        $tableauPlatform = [];
        $tableauGenre = [];

        if (!$_SESSION['admin']) {

            // Redirige l'utilisateur vers la page d'accueil
            RedirectUser("");
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
                
                $bool = true;

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

                if($nomJeu != "" && $description != "" && $prixJeu != "" && $pegi != ""){
                    if($prixJeu > 0){
                        if($tableauGenre != []){
                        GameModel::deleteGenres($idJeu);
                        GameModel::ajouterGenres($idJeu, $tableauGenre);
                        }

                        if($tableauPlatform != []){
                            GameModel::deletePlateformes($idJeu);
                            GameModel::ajouterPlateformes($idJeu, $tableauPlatform);
                        }

                        GameModel::updateGame($idJeu, $nomJeu, $description, $prixJeu, $pegi);

                        // Redirige l'utilisateur
                        RedirectUser("modifier?idJeux='.$idJeu.'&valid=ok'");
                    }
                    else{
                        // Redirige l'utilisateur
                        RedirectUser("modifier?idJeux='.$idJeu.'&valid=prix'");
                    }
                }else{
                    // Redirige l'utilisateur
                    RedirectUser("modifier?idJeux='.$idJeu.'&valid=non'");
                }
            }
        }
        require '../src/view/modifierJeu.php';
    }
}