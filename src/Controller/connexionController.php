<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;


class connexionController
{
  /**
   * description de la fonction ....................................................
   *
   * @return void
   * @author nom de la personne qui à fait la fonction ........
   */
  public function connexion()
  {
    session_start();

    if (!isset($_SESSION['userName'])) {
      $_SESSION = [
        'userName' => '',
        'email' => '',
        'nom' => '',
        'prenom' => '',
      ];
    }

    $submit = filter_input(INPUT_POST, 'btnSubmit', FILTER_SANITIZE_SPECIAL_CHARS);
    $erreur = "";

    if ($submit = "Se connecter") {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);

      if($email != "" && $password != ""){
         $emailBd = FonctionsBD::verifyUserByEmail($email);
        if($emailBd == $email){
          
        }
        else{
          $erreur = "Email ou mot de passe incorrect.";
        }

      }
      else{
        $erreur = "Saisissez votre eamil et mot de passe.";
      }

    }
  }

































  /*
      session_start();
        $submit = filter_input(INPUT_POST,'btnSubmit',FILTER_SANITIZE_STRING);
        $erreur = "";
          if($submit == "login"){
            $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
            if($email != "" && $password != ""){
              $erreur = "";
              if(getInfoUser($email, $password) == true){
                $erreur = "";
                $_SESSION['email'] = getInfoUser($email, $password)['email'];
                $_SESSION["group"] = getInfoUser($email, $password)['type'];
                $_SESSION['logged'] = true;
        
                header("Location: / ");
                exit(); 
              }
              else{
                $erreur = "nom ou mot de passe invalides";
              }
            }
            else{
              $erreur = "pas de champs vides";
            }
            
          }
          require '../src/view/connexion.php'; 
          */
}
