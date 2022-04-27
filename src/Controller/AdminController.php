<?php

namespace EasyGame\Controller;

use EasyGame\model\BaseDonnee;
use EasyGame\model\GameModel;
use EasyGame\model\UserModel;

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
        'btnJeux' => false,
        'btnUser' => false
      ];
    }

    $stringTableJ = ""; //la variable vaut rien parce que on a pas cliquer le bouton
    $nomBoutonJeux = "Montrer jeux"; //au debut le bouton va montrer ça

    $stringTableU = ""; //la variable vaut rien parce que on a pas cliquer le bouton
    $nomBoutonUsers = "Montrer users"; //au debut le bouton va montrer ça



    if (!$_SESSION['admin']) {
      header("location: http://easygame.ch");
      exit();
    } else {
      //recuperer les jeux de la base de donnée
      $jeux = GameModel::getGames();
      //recuperer les utilisateurs de la base de donneé
      $users = UserModel::getUsers();

      //variable pour savoir si on a touché le bouton
      $montrerJeux = filter_input(INPUT_POST, 'showGames', FILTER_SANITIZE_SPECIAL_CHARS);

      /*Condition pour modifier le nom des boutons*/
      if ($_SESSION['btnJeux']) {
        $nomBoutonJeux = "Cacher jeux";
      } else {
        $nomBoutonJeux = "Montrer jeux";
      }

      //variable pour savoir si on a touché le bouton
      $montrerUsers = filter_input(INPUT_POST, 'showUsers', FILTER_SANITIZE_SPECIAL_CHARS);

      /*Condition pour modifier le nom des boutons*/
      if ($_SESSION['btnUser']) {
        $nomBoutonUsers = "Cacher users";
      } else {
        $nomBoutonUsers = "Montrer users";
      }
    }
    require '../src/view/admin.php';
  }
}
