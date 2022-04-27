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
    public function modifierJeu()
    {
        session_start();

        if (!$_SESSION['admin']) {
            header("location: http://easygame.ch");
            exit();
        } else {

            $idJeux = filter_input(INPUT_GET,'idJeux');

            $jeu = GameModel::getGameById($idJeux);
            
            $montrerGenPlat = ModifierController::showGameTypePlat($idJeux);
        }
        require '../src/view/modifierJeu.php';
    }

    public function showGameTypePlat($idJeux){
        $genres = GenreModel::getGameGenre($idJeux);
        $platforms = PlatformModel::getGamePlatform($idJeux);

        $montrerGenPlat = "
        <tr>
        <th>Genres</th>
        </tr>";

        foreach($genres as $genre){

            $montrerGenPlat .= "<tr>
            <td>".$genre['genre']."</td>
            </tr>";

            $montrerGenPlat .= "";
        }

        $montrerGenPlat .= "
        <tr>
        <th>Plateformes</th>
        </tr>";

        foreach($platforms as $platform){

            $montrerGenPlat .= "<tr>
            <td>".$platform['plateforme']."</td>
            </tr>";
        }
        
        return $montrerGenPlat;
    }
}