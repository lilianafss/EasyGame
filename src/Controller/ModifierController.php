<?php

namespace EasyGame\Controller;

use EasyGame\model\BaseDonnee;
use EasyGame\model\GameModel;
use EasyGame\model\GenreModel;
use EasyGame\model\HistoriqueModel;
use EasyGame\model\NoteModel;
use EasyGame\model\PanierModel;
use EasyGame\model\PegiModel;
use EasyGame\model\PlatformModel;
use EasyGame\model\UserModel;
use EasyGame\model\WishlistModel;
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

            $montrerJeu = ModifierController::showGame($idJeux);

            $montrerGenPlat = ModifierController::showGameTypePlat($idJeux);
        }



        require '../src/view/modifierJeu.php';
    }

    public function showGame($idJeux){
        $jeu = GameModel::getGameById($idJeux);

        $montrerJeu = '
        <form method="POST">
            <label>
                Nom du jeu:
            </label>
            <input type="text" style="width:30%;" name="nomJeu" value="'.$jeu['nom'].'">

            <br>

            <label>
                Description du jeu:
            </label>
            <textarea name="desriptionJeu" rows="5" cols="80">'.$jeu['description'].'</textarea>

            <br>

            <label>
                Prix du jeu:
            </label>
            <input type="number" step="0.01" name="prixJeu" value="'.$jeu['prix'].'">

            
            <br>
            <label>Changer l\'image du jeu :</label>
            <input class="btn" type="file" name="imageJeu">
            <br>
            <label>Changer les genres:</label>
                <select name="nbGenre">
                <option value=""></option>
                    <option value="10">10</option>
                    <option value="9">9</option>
                    <option value="8">8</option>
                    <option value="7">7</option>
                    <option value="6">6</option>
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2" >2</option>
                    <option value="1" >1</option>
                </select>
                <label>Combien de plateformes:</label>
                <select name="nbPlatform">
                    <option value=""></option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2" >2</option>
                    <option value="1" >1</option>
                </select>
                <input type="submit" value="Submit Platform et Genre" name="btnGenrePlateform">
            <br>
            <label>Pegi actuel du jeu: '.$jeu['pegi'].'</label>
            <br>
            <label>Changer le pegi du jeu :</label>
            <select name="pegiJeu">
                <option value=""></option>
                <option value="5">18</option>
                <option value="4">16</option>
                <option value="3">12</option>
                <option value="2">7</option>
                <option value="1">3</option>
            </select>
        </form>
        ';
        
        return $montrerJeu;
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