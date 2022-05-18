<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\GameModel;
use EasyGame\Model\GenreModel;
use EasyGame\Model\HistoriqueModel;
use EasyGame\Model\NoteModel;
use EasyGame\Model\PanierModel;
use EasyGame\Model\PegiModel;
use EasyGame\Model\PlatformModel;
use EasyGame\Model\UserModel;
use EasyGame\Model\WishlistModel;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require_once('../src/php/tools.php');

class MotDePasseOublierController
{
    /**
     * @return void
     */
    public function motDePasseOublier()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        require '../src/view/motDePasseOublier.php';
    }

//    /**
//     * Crée un nouveau Compte
//     * @return void
//     * @throws Exception
//     * @author Flavio Soares Rodrigues
//     */
//    public function passwordUpdate()
//    {
//
//        // Permet d'utiliser les fonctions contenues dans la classe FonctionsBD
//        $fonctionsBD = new FonctionsBD();
//
//        // Filtre les inputs
//        $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
//        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
//        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
//        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
//        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
//        $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
//        $message = "";
//
//        $key = rand(10000000, 99999999);
//
//        $_SESSION['key'] = $key;
//
//        $to = $email;
//        $from = 'site.easygame@gmail.com';
//        $name = 'EasyGame';
//        $subj = 'Email de confirmation';
//        $msg = '<h1>Complètez votre création de compte en vérifiant votre email ci-dessous </h1>
//                <button type="submit">
//                    <a href="http://easygame.ch/verification?confirmation='.$key.'" style="text-decoration: none">Cliquer ici pour vérifier votre email</a>
//                </button>';
//
//        // Si le boutton "Valider" est pressé
//        if ($submit == "Valider")
//        {
//            if ($userName != "" && $lastName != "" && $firstName != "" && $email != "" && $password != "" && $password2 != "")
//            {
//                // Si le mot de passe est identique à celui de confirmation
//                if ($password == $password2)
//                {
//                    // Hash le mot de passe
//                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);;
//
//                    // Ajoute un nouvel utilisateur dans la base de données
//                    try
//                    {
//                        // Crée l'utilisateur
//                        $fonctionsBD->newUser($userName, $lastName, $firstName, $email, $passwordHash);
//
//                        // Récupère l'id de l'utilisateur et on le met dans la session
//                        $_SESSION['idUser'] = $fonctionsBD->getIdUser($email)['idUser'];
//
//                        // Envoie un mail de confirmation pour activer le compte
//                        $message = $this->smtpmailer($to, $from, $name, $subj, $msg);
//                    }
//                    catch (PDOException $e)
//                    {
//                        if (strpos($e->getMessage(), 'email'))
//                        {
//                            $message = "email déjà existant";
//                        }
//                        else if (strpos($e->getMessage(), 'pseudo'))
//                        {
//                            $message = "nom d'utilisateur déjà existant";
//                        }
//                    }
//                }
//                else
//                {
//                    $message = "Ces mots de passe ne correspondent pas. Veuillez réessayer.";
//                }
//            }
//            else
//            {
//                $message = "Veuillez Remplir tout les champs";
//            }
//        }
//        else if ($submit == "Annuler")
//        {
//            header("location: /connexion");
//            exit();
//        }
//        require '../src/view/register.php';
//    }
}
