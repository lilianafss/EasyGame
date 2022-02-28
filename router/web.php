<?php

use PHPMailer\PHPMailer\src\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;
use Pecee\SimpleRouter\SimpleRouter;
use EasyGame\Controleur\connexionControleur;
use EasyGame\Controleur\nouveauCompteControleur;

SimpleRouter::form('/connexion',[connexionControleur::class,'connexion']);
SimpleRouter::form('/nouveau',[nouveauCompteControleur::class,'nouveauCompte']);