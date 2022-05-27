<?php
namespace EasyGame\Controller;

use EasyGame\Model\UserModel;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../vendor/phpmailer/phpmailer/src/SMTP.php';
require_once '../vendor/phpmailer/phpmailer/src/Exception.php';
require_once('../src/php/config.php');
require_once('../src/php/tools.php');

class ModifierMotDePasseController
{
    public function ModifierMdp()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        // récupère la clé contenue dans l'url
        $confirmationKey = filter_input(INPUT_GET,'confirm');

        // Filtrer les inputs
        $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
        $password2 = filter_input(INPUT_POST,'password2',FILTER_SANITIZE_SPECIAL_CHARS);
        $submit = filter_input(INPUT_POST,'submit',FILTER_SANITIZE_SPECIAL_CHARS);

        $message = "";
        $script = "";

        // Empêche l'accès à la page si la clé donnée par l'url est différente de celle stocké dans la session
        if($confirmationKey != $_SESSION['key'] || $_SESSION['connected'])
        {
            // Redirige l'utilisateur vers la page d'accueil
            RedirectUser("");
        }
        else
        {
            if ($submit == "Changer")
            {
                if ($password != "")
                {
                    if ($password2 != "")
                    {
                        if ($password == $password2)
                        {
                            // Hash le mot de passe
                            $passwordHash = password_hash($password, PASSWORD_BCRYPT);;

                            // Récupérer l'email de la personne contenu dans la session
                            $email = $_SESSION['email'];

                            // Modifie le mot de passe
                            UserModel::updatePasswordByEmail($passwordHash, $email);

                            // Message de sucess
                            $message = "Le mot de passe à été modifié";
                            $script = "Message(" . json_encode('success') . ");";

                            // efface les valeurs des variables
                            $_SESSION['email']= "";
                            $password = "";
                            $password2 = "";
                        }
                        else
                        {
                            $message = "La confirmation du nouveau mot de passe n'est pas identique au nouveau mot de passe.";
                            $script = "Message(" . json_encode('fail') . ");";
                        }
                    }
                    else
                    {
                        $message = "Veuillez confirmer votre nouveau mot de passe.";
                        $script = "Message(" . json_encode('fail') . ");";
                    }
                }
                else
                {
                    $message = "Aucun nouveau mot de passe n'a été saisie.";
                    $script = "Message(" . json_encode('fail') . ");";
                }
            }
            require '../src/view/modifierMdp.php';
        }
    }
}
