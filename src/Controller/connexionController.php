<?php
namespace EasyGame\Controller;

use EasyGame\model\FonctionsBd;


class connexionController
{
    public function connexion()
    {
        require '../src/view/connexion.php';

        // if (isset($_POST['btnSubmit']))
        //  {
        //     //récupération des champs du formulaire
        //     $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        //     $mdp = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        //     //connexion
        //     $utilisateur = recupererEmail($email);
        //     if ($utilisateur != null && count($utilisateur) >= 1) {

        //         //vérifie si le mot de passe est identique à celui donner dans l'inscription
        //         if ($utilisateur['mdp'] == hash("sha256", $mdp)) {
        //             header("location:accueil.php");
        //         }
        //     }
        //  }
    //     if(filter_has_var('btnSubmit')){
    //         header("location:/accueil.php");
    //         echo "efkef";
    //     }

    //     session_start();
    //      $mdp=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
    //     $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);

    //      $mdpBase=VerifierEmail($_SESSION['email']);
    //      if(VerifierMotDePasse($mdp,$mdpBase[0])){
    //       header("location:/accueil.php");
    //         echo"ok mdp";
            
    //      }
    //     else{
    //          echo "Erreur login";
    //    }
  
    }
}

