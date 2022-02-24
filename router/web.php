<?php

use PHPMailer\PHPMailer\src\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;
use Pecee\SimpleRouter\SimpleRouter;
use EasyGame\Controleur\connexionControleur;

SimpleRouter::form('/connexion',[connexionControleur::class,'connexion']);