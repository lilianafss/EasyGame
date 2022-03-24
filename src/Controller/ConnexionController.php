<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class ConnexionController
{
  /**
   * Se connecter
   *
   * @return void
   * @author De Castilho E Sousa Rodrigo
   */
  public static function connexion()
  {
    session_start();

    //FonctionsBD::deleteGame(6);
    //FonctionBD::deleteComment(3);

    // //require_once 'ConnexionGoogle.php';

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
    //si idUser existe pas dans la session on va creer ses trois variables  
    if (!isset($_SESSION['idUser'])) {
      $_SESSION = [
        'idUser' => '',
        'connected' => false,
        'admin' => false
      ];
    }

    //varible pour recuperer le button
    $submit = filter_input(INPUT_POST, 'btnSubmit', FILTER_SANITIZE_SPECIAL_CHARS);
    $erreur = "";

    //si la variable submit = Se connecter on va prendre l'email et le mot de passe
    if ($submit == "Se connecter") {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

      //si les deux sont egale a rien on va mettre une message d'erreur
      if ($email != "" && $password != "") {
        if (FonctionsBD::getIdUser($email)) {

          $_SESSION['idUser'] = FonctionsBD::getIdUser($email)['idUser'];

          //si le mot de passe est correct par rapport au email on va etre connecté
          if (password_verify($password, FonctionsBD::getInfoUser($_SESSION['idUser'])['password'])) {

            $_SESSION['admin'] = boolval(FonctionsBD::getInfoUser($_SESSION['idUser'])['admin']);
            $_SESSION['connected'] = true;
            header("location: http://easygame.ch");
            exit();
          } else {
            $_SESSION = [
              'idUser' => "",
              'connected' => false,
              'admin' => false
            ];

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
