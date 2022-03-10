<?php
use Pecee\SimpleRouter\SimpleRouter;
use PHPMailer\PHPMailer\src\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;

use EasyGame\Controller\connexionController;
use EasyGame\Controller\registerController;
use EasyGame\Controller\accueilController;

SimpleRouter::form('/', [AccueilController::class, 'accueil']);
SimpleRouter::form('/connexion', [ConnexionController::class, 'connexion']);
SimpleRouter::form('/nouveau', [RegisterController::class, 'nouveauCompte']);