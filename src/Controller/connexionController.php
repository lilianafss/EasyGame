<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBd;


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
    }
}