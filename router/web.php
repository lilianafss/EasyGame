<?php
use Pecee\SimpleRouter\SimpleRouter;
use PHPMailer\PHPMailer\src\PHPMailer;
use PHPMailer\PHPMailer\src\SMTP;
use PHPMailer\PHPMailer\src\Exception;

use EasyGame\Controller\ConnexionController;
use EasyGame\Controller\RegisterController;
use EasyGame\Controller\AccueilController;
use EasyGame\Controller\JeuxController;
use EasyGame\Controller\PanierController;

SimpleRouter::form('/', [AccueilController::class, 'accueil']);
SimpleRouter::form('/connexion', [ConnexionController::class, 'connexion']);
SimpleRouter::form('/nouveau', [RegisterController::class, 'nouveauCompte']);
SimpleRouter::form('/jeux', [JeuxController::class, 'jeux']);
SimpleRouter::form('/panier', [PanierController::class, 'panier']);