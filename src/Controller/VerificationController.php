<?php

namespace EasyGame\Controller;

use EasyGame\Model\UserModel;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';


class VerificationController
{
    public function VerifierCompte()
    {
        session_start();
        if (!isset($_SESSION['idUser']))
        {
            $_SESSION = [
                'idUser' => '',
                'connected' => false,
                'admin' => false,
                'btnJeux' => false,
                'btnUser' => false
            ];
        }

        // Récupère l'id de l'utilisateur dans la session
        $idUser = $_SESSION['idUser'];

        // Récupère les informations de l'utilisateur avec l'idUser
        $infoUser = UserModel::getInfoUser($idUser);

        // Renvois l'utilisateur à la page d'accueil si'il n'est pas connecté ou si son status n'est pas "En Attente"
        if($infoUser['user_status'] != "En Attente")
        {
            header("Location: /");
            exit();
        }
        else
        {
            $key = filter_input(INPUT_GET,'confirmation');

            if($key == $_SESSION['key'])
            {
                $userName   = $infoUser['pseudo'];
                $nom   = $infoUser['nom'];
                $prenom  = $infoUser['prenom'];
                $userStatus = "Actif";

                $_SESSION['connected'] = true;
                UserModel::updateUser($idUser, $userName, $nom, $prenom, $userStatus);

                header("Location: /");
                exit();
            }
        }
    }
}
