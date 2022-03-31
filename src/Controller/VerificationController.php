<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;
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

        // Permet d'utiliser les fonctions contenues dans la classe FonctionsBD
        $fonctionsBD = new FonctionsBD();

        // Récupère l'id de l'utilisateur dans la session
        $idUser = implode($_SESSION['idUser']);

        // Récupère les informations de l'utilisateur avec l'idUser
        $infoUser = $fonctionsBD->getInfoUser($idUser);

        $userName   = $infoUser['pseudo'];
        $nom   = $infoUser['nom'];
        $prenom  = $infoUser['prenom'];
        $userStatus = "Actif";

        $fonctionsBD->updateUser($idUser, $userName, $nom, $prenom, $userStatus);
    }
}
