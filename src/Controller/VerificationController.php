<?php
namespace EasyGame\Controller;

use EasyGame\Model\UserModel;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once '../vendor/phpmailer/phpmailer/src/Exception.php';
require_once('../src/php/config.php');
require_once('../src/php/tools.php');

class VerificationController
{
    public function VerifierCompte()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        // Récupère l'id de l'utilisateur dans la session
        $idUser = $_SESSION['idUser'];

        // Récupère les informations de l'utilisateur avec l'idUser
        $infoUser = UserModel::getInfoUser($idUser);

        // Renvois l'utilisateur à la page d'accueil si'il n'est pas connecté ou si son status n'est pas "En Attente"
        if($infoUser['user_status'] != "En Attente")
        {
            // Redirige l'utilisateur vers la page d'accueil
            RedirectUser("");
        }
        else
        {
            $key = filter_input(INPUT_GET,'confirmation');

            if($key == $_SESSION['key'])
            {
                $userName   = $infoUser['pseudo'];
                $nom   = $infoUser['nom'];
                $prenom  = $infoUser['prenom'];

                $_SESSION['connected'] = true;
                UserModel::updateUser($idUser, $userName, $nom, $prenom, "Actif");

                // Redirige l'utilisateur vers la page d'accueil
                RedirectUser("");
            }
        }
    }
}
