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
     * Modification du joue choisi
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

            //recuperer l'id du joue
            $idJeux = filter_input(INPUT_GET,'idJeux');

            //recuperer les informations du joue
            $jeu = GameModel::getGameById($idJeux);
            //recuperer les genres du joue
            $genres = GenreModel::getGameGenre($idJeux);
            //recuperer les plateformes du joue
            $platforms = PlatformModel::getGamePlatform($idJeux);
        }
        require '../src/view/modifierJeu.php';
    }
}