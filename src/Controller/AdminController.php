<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

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

    $stringTableJeux = ""; //la variable vaut rien parce que on a pas cliquer le bouton
    $nomBoutonJeux = "Montrer jeux"; //au debut le bouton va montrer ça

    $stringTableUsers = ""; //la variable vaut rien parce que on a pas cliquer le bouton
    $nomBoutonUsers = "Montrer users"; //au debut le bouton va montrer ça

    if (!$_SESSION['admin']) {
      header("location: http://easygame.ch");
      exit();
    } else {

      //variable pour savoir si on a touché le bouton
      $montrerJeux = filter_input(INPUT_POST, 'showGames', FILTER_SANITIZE_SPECIAL_CHARS);

      /*Condition pour afficher et cacher les jeux*/
      if ($montrerJeux == "yesJeux" && $_SESSION['btnJeux']) {
        $stringTableJeux = AdminController::showGames(); //recuperer le tableau avec les jeux
        $_SESSION['btnJeux'] = false; //on mets dans la session false pour savoir qu'on a cliqué
        $nomBoutonJeux = "Cacher jeux";
      } else {
        $stringTableJeux = ""; // on mets la variable a rien pour rien montrer
        $_SESSION['btnJeux'] = true; //on mets dans la session true pour savoir qu'on a cliqué une deuxieme fois
        $nomBoutonJeux = "Montrer jeux";
      }

      //variable pour savoir si on a touché le bouton
      $montrerUsers = filter_input(INPUT_POST, 'showUsers', FILTER_SANITIZE_SPECIAL_CHARS);

      /*Condition pour afficher et cacher les utilisateurs*/
      if ($montrerUsers == "yesUsers" && $_SESSION['btnUser']) {
        $stringTableUsers = AdminController::showUsers(); //recuperer le tableau avec les users
        $_SESSION['btnUser'] = false; //on mets dans la session false pour savoir qu'on a cliqué
        $nomBoutonUsers = "Cacher users";
      } else {
        $stringTableUsers = ""; // on mets la variable a rien pour rien montrer
        $_SESSION['btnUser'] = true; //on mets dans la session true pour savoir qu'on a cliqué une deuxieme fois
        $nomBoutonUsers = "Montrer users";
      }
    }
    require '../src/view/admin.php';
  }

  /**
   * Afficher les jeux
   *
   * @return string
   * @author De Castilho E Sousa Rodrigo
   */
  public static function showGames()
  {
    $jeux = FonctionsBD::getGames();
    $stringTableJ = "";

    $stringTableJ .= "
      <tr>
      <th>IdJeux</th>
      <th>Nom</th>
      <th>Description</th>
      <th>Prix</th>
      <th>Pegi</th>
      <th>Image</th>
      <tr>
      ";

    foreach ($jeux as $unJeux) {
      $stringTableJ .= " 
        <tr>
        <td>" . $unJeux['idJeux'] . "</td>
        <td>" . $unJeux['nom'] . "</td>
        <td>" . $unJeux['description'] . "</td>
        <td>" . $unJeux['prix'] . "</td>
        <td>" . $unJeux['pegi'] . "</td>
        <td><img class=\"card-img\" src=\"data:image/jpeg;base64," . base64_encode($unJeux['image']) . "\"/></td>
        <td><a href='http://easygame.ch/effacer?idJeux=".$unJeux['idJeux']."'>Effacer<a/><td>
        <td><a href='http://easygame.ch/effacer?idJeux=".$unJeux['idJeux']."'>Modifier<a/><td>
        </tr>";
    }
    return $stringTableJ;
  }
  
  /**
   * Afficher les utilisateurs
   *
   * @return string
   * @author De Castilho E Sousa Rodrigo
   */
  public static function showUsers()
  {
    $users = FonctionsBD::getUsers();
    $stringTableU = "";

    $stringTableU .= "
      <tr>
      <th>IdUser</th>
      <th>Pseudo</th>
      <th>Nom</th>
      <th>Prenom</th>
      <th>Email</th>
      <th>Admin</th>
      <th>USER_STATUS</th>
      <tr>
      ";

    foreach ($users as $unUser) {
      $stringTableU .= " 
        <tr>
        <td>" . $unUser['idUser'] . "</td>
        <td>" . $unUser['pseudo'] . "</td>
        <td>" . $unUser['nom'] . "</td>
        <td>" . $unUser['prenom'] . "</td>
        <td>" . $unUser['email'] . "</td>
        <td>" . $unUser['admin'] . "</td>
        <td>" . $unUser['user_status'] . "</td>
        <td><a href='http://easygame.ch/effacer?idUser=".$unUser['idUser']."'>Effacer<a/><td>
        <td><a href='http://easygame.ch/effacer?idUser=".$unUser['idUser']."'>Disabled<a/></td>
        </tr>";
    }
    return $stringTableU;
  }
}
