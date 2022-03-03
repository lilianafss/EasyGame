<?php
use Pecee\SimpleRouter\SimpleRouter;
use PHPMailer\PHPMailer\src\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;

use EasyGame\Controller\connexionController;
use EasyGame\Controller\registerController;
use EasyGame\Controller\accueilController;


SimpleRouter::form('/', [accueilController::class, 'accueil']);
SimpleRouter::form('/connexion', [connexionController::class, 'connexion']);
SimpleRouter::form('/nouveau', [registerController::class, 'nouveauCompte']);