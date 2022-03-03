<?php
use EasyGame\Controller\connexionController;
use EasyGame\Controller\registerController;

use Pecee\SimpleRouter\SimpleRouter;
use PHPMailer\PHPMailer\src\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;


SimpleRouter::form('/', [connexionController::class, 'connexion']);
SimpleRouter::form('/connexion', [connexionController::class, 'connexion']);
SimpleRouter::form('/nouveau', [registerController::class, 'nouveauCompte']);