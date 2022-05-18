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
use EasyGame\Controller\VerificationController;
use EasyGame\Controller\EffacerController;
use EasyGame\Controller\MotDePasseOublierController;
use EasyGame\Controller\DeconnexionController;
use EasyGame\Controller\ModifierController;
use EasyGame\Controller\ProfilController;
use EasyGame\Controller\WishlistController;
use EasyGame\Controller\errorController;
use EasyGame\Controller\successController;

SimpleRouter::form('/', [AccueilController::class, 'accueil']); // page d'accueil du site
SimpleRouter::form('/connexion', [ConnexionController::class, 'connexion']); // page de connexion au site
SimpleRouter::form('/nouveau', [RegisterController::class, 'nouveauCompte']); // page de création de compte
SimpleRouter::form('/jeux', [JeuxController::class, 'jeux']); // page d'un jeu (idJeu)
SimpleRouter::form('/panier', [PanierController::class, 'panier']); // page du panier
SimpleRouter::form('/admin', [AdminController::class, 'admin']); // page administrateur
SimpleRouter::form('/ajouterJeux', [AjouterJeuxController::class, 'ajouterJeux']); // page d'ajout de jeux
SimpleRouter::form('/verification', [VerificationController::class, 'VerifierCompte']); // page de vérification de compte
SimpleRouter::form('/effacer', [EffacerController::class, 'effacer']); // page effacer
SimpleRouter::form('/motDePasseOublier', [MotDePasseOublierController::class, 'motDePasseOublier']); // page de récupération de l'email pour mdp oublié
SimpleRouter::form('/deconnexion', [DeconnexionController::class, 'deconnexion']); // page de déconnnexion
SimpleRouter::form('/modifier', [ModifierController::class, 'modifierJeu']); //pade de modification de jeu
SimpleRouter::form('/profil', [ProfilController::class, 'profil']); // page d'accueil du site
SimpleRouter::form('/wishlist', [WishlistController::class, 'wishlist']); // page d'accueil du site
SimpleRouter::form('/error', [errorController::class, 'error']); // page d'error pour paypal
SimpleRouter::form('/success', [successController::class, 'success']); // page de succes pour paypal
