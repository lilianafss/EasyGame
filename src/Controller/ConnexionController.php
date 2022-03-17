<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class ConnexionController
{
  /**
   * description de la fonction ....................................................
   *
   * @return void
   * @author nom de la personne qui à fait la fonction ........
   */
  public static function connexion()
  {
    session_start();

    // require_once 'ConnexionGoogle.php';

    // $gClient = "";
    // $google_oauthV2 = "";
    // userGoogle($gClient, $google_oauthV2);

    // if (isset($_GET['code'])) {

    //   $gClient->authenticate($_GET['code']);
    //   $_SESSION['token'] = $gClient->getAccessToken();
    //   header('Location: ' . filter_var(GOOGLE_REDIRECT_URL, FILTER_SANITIZE_URL));
    // }

    // if(isset($_SESSION['token'])){ 
    //   $gClient->setAccessToken($_SESSION['token']); 
    // } 
    // if($gClient->getAccessToken()){ 
    //   // Get user profile data from google 
    //   $gpUserProfile = $google_oauthV2->userinfo->get(); 

    //   $_SESSION['email'] = $gpUserProfile['email'];

    //   $_SESSION['prenom'] = $gpUserProfile['given_name'];

    //   $_SESSION['nom'] = $gpUserProfile['family_name'];

    // }
    // else{
    //   $authUrl = $gClient->createAuthUrl(); 
     
    //   // Render google login button 
    //   $btnGoogle = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="/assets/image/googleLogo.png" alt=""/></a>';
    // }
/******************************************************************************************/
    if (!isset($_SESSION['idUser'])) {
      $_SESSION = [
        'idUser' => '',
        'connected' => false
      ];
    }

    $submit = filter_input(INPUT_POST, 'btnSubmit', FILTER_SANITIZE_SPECIAL_CHARS);
    $erreur = "";

    if ($submit == "Se connecter") {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

      if ($email != "" && $password != "") {
        if (FonctionsBD::getIdUser($email)) {

          $_SESSION['idUser'] = FonctionsBD::getIdUser($email)['idUser'];

          var_dump(password_verify($password, FonctionsBD::getInfoUser($_SESSION['idUser'])['password']));

          if (password_verify($password, FonctionsBD::getInfoUser($_SESSION['idUser'])['password'])) {

            $_SESSION['connected'] = true;
            header("location: http://easygame");

            //exit();
          } else {
            $_SESSION['idUser'] = "";
            $erreur = "Email ou mot de passe incorrect.";
          }
        } else {
          $erreur = "Email ou mot de passe incorrect.";
        }
      } else {
        $erreur = "Saisissez votre email et mot de passe.";
      }
    }

    require '../src/view/connexion.php';
  }
}
