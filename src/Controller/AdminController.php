<?php
namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\GameModel;
use EasyGame\Model\UserModel;

require_once('../src/php/tools.php');
const URL_PRINCIPAL = 'http://easygame.ch'; //PROBLEME

class AdminController
{
    /**
    * Fonction principale de la page admin
    *
    * @return void
    * @author De Castilho E Sousa Rodrigo
    */
    public static function admin()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        if (!$_SESSION['admin'])
        {
            header("location:".URL_PRINCIPAL);
            exit();
        }
        else
        {
            $stringTableJ = ""; //la variable ne vaut rien parce qu'on n'a pas cliqué le bouton
            $stringTableU = ""; //la variable ne vaut rien parce qu'on n'a pas cliqué le bouton

            $submit = filter_input(INPUT_POST,'submit',FILTER_SANITIZE_SPECIAL_CHARS);

            if($submit == "ok"){
                
                header("Location:".URL_PRINCIPAL.url("ajouterJeux"));
            }

            //recuperer les jeux de la base de donnée
            $jeux = GameModel::getGames();

            //recuperer les utilisateurs de la base de donneé
            $users = UserModel::getUsers();
        }
        require '../src/view/admin.php';
    }
}
