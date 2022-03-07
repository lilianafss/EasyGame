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
  public static function Connexion()
  {
    session_start();

    if (!isset($_SESSION['userId'])) {
        $_SESSION = [
            'userId' => '',
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
                $hash = password_hash($password, PASSWORD_BCRYPT);
                if (password_verify($hash, FonctionsBD::getInfoUser($_SESSION['idUser'])('password'))) {
                    $_SESSION['connected'] = true;
                    header("location: http://easygame/");
                    var_dump($_SESSION);
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
