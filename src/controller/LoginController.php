<?php
namespace EasyGame\Controleur;

use EasyGame\model\pdo;

class connexionControleur
{
    function connexion()
    {

        session_start();
        $mdp=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
        $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);

        $mdpBase=VerifierEmail($_SESSION['email']);
        if(VerifierMotDePasse($mdp,$mdpBase[0])){
            header("location:accueil.php");
        }
        else{
            echo "Erreur login";
        }
    }
}
require '../view/login.php';
?>