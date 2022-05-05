<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\GameModel;
use EasyGame\Model\UserModel;

class AdminController
{
  /**
   * fonction principale de la page admin
   *
   * @return void
   * @author De Castilho E Sousa Rodrigo
   */
  public static function admin()
  {
    session_start();

    if (!isset($_SESSION['idUser'])) {
      $_SESSION = [
        'idUser' => '',
        'connected' => false,
        'admin' => false,
        'idJeux' => ''
      ];
    }

    if (!$_SESSION['admin']) {
      header("location: http://easygame.ch");
      exit();
    } else {

      $stringTableJ = ""; //la variable vaut rien parce que on a pas cliquer le bouton
    
      $stringTableU = ""; //la variable vaut rien parce que on a pas cliquer le bouton

      //recuperer les jeux de la base de donnée
      $jeux = GameModel::getGames();
      //recuperer les utilisateurs de la base de donneé
      $users = UserModel::getUsers();  
    }
    require '../src/view/admin.php';
  }
}
