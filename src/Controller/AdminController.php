<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class AdminController
{
  public static function admin()
  {
    session_start();

    if(!isset($_SESSION['idUser'])) {
      $_SESSION = [
        'idUser' => '',
        'connected' => false,
        'admin' => false
      ];
    }
    
    
    $stringTable = "";
    $boolMontrerJeux = false;

    if(!$_SESSION['admin']){
      header("location: http://easygame.ch");
      exit();
    }else{
      
      $montrerJeux = filter_input(INPUT_POST,'showGames',FILTER_SANITIZE_SPECIAL_CHARS);
      
      if($montrerJeux == "yes" && $boolMontrerJeux){
        $stringTable = showGames();
        $boolMontrerJeux = false;
      }
      else{
        $stringTable = "";
        $boolMontrerJeux = true;
      }
    }

    function showGames(){
      $jeux = FonctionsBD::getGames();
      $stringTablejeux = "";

      $stringTablejeux .="
        <tr>
        <th>IdJeux</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Pegi</th>
        <th>Image</th>
        <tr>
        ";
  
        foreach($jeux as $unJeux){
          $stringTablejeux .= " 
          <tr>
          <td>".$unJeux['idJeux']."</td>
          <td>".$unJeux['nom']."</td>
          <td>".$unJeux['description']."</td>
          <td>".$unJeux['prix']."</td>
          <td>".$unJeux['pegi']."</td>
          <td><img class=\"card-img\" src=\"data:image/jpeg;base64,".base64_encode( $unJeux['image'] )."\"/></td>
          <td><a>Effacer<a/><td>
          <td><a>Modifier<a/><td>
          </tr>";
        }
        return $stringTablejeux;
    }
    require '../src/view/admin.php';
  }
}
    