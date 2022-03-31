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
        // Permet d'utiliser les fonctions contenues dans la classe FonctionsBD
        $fonctionsBD = new FonctionsBD();


        $fonctionsBD->getInfoUser($idUser);

        $idUser     = "";
        $userName   = "";
        $lastName   = "";
        $firstName  = "";
    }
}
