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
use EasyGame\Controller\AdminController;
use EasyGame\Controller\AjouterJeuxController;
use EasyGame\Controller\EffacerController;

SimpleRouter::form('/', [AccueilController::class, 'accueil']);
SimpleRouter::form('/connexion', [ConnexionController::class, 'connexion']);
SimpleRouter::form('/nouveau', [RegisterController::class, 'nouveauCompte']);
SimpleRouter::form('/jeux', [JeuxController::class, 'jeux']);
SimpleRouter::form('/panier', [PanierController::class, 'panier']);
SimpleRouter::form('/admin', [AdminController::class, 'admin']);
SimpleRouter::form('/ajouterJeux', [AjouterJeuxController::class, 'ajouterJeux']);
SimpleRouter::form('/effacer', [EffacerController::class, 'effacer']);