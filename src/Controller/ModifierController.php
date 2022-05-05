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
        session_start();

        if (!$_SESSION['admin']) {
            header("location: http://easygame.ch");
            exit();
        } else {

            //recuperer l'id du jeu
            $idJeu = filter_input(INPUT_GET,'idJeux');
            
            $genreChange = GenreModel::getGenre();
            $plateformeChange = PlatformModel::getPlatform();

            //recuperer les informations du jeu
            $jeu = GameModel::getGameById($idJeu);
            //recuperer les genres du jeu
            $genres = GenreModel::getGameGenre($idJeu);
            //recuperer les plateformes du jeu
            $platforms = PlatformModel::getGamePlatform($idJeu);
        }
        require '../src/view/modifierJeu.php';
    }
}