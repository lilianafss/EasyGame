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

        if ($email != "" || $password != "") {
            if (FonctionsBD::getIdUser($email)) {
                
              $_SESSION['idUser'] = FonctionsBD::getIdUser($email)['idUser'];

                var_dump(password_verify($password, FonctionsBD::getInfoUser($_SESSION['idUser'])['password']));
                
                if (password_verify($password, FonctionsBD::getInfoUser($_SESSION['idUser'])['password'])) {
                    
                  $_SESSION['connected'] = true;
                    header("location: http://easygame.ch");
                    
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
