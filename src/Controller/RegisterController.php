<?php

namespace EasyGame\Controller;

use EasyGame\Model\UserModel;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../src/php/smtpMailer.php');
require_once('../src/php/config.php');
require_once('../src/php/tools.php');

class RegisterController
{
    /**
     * Crée un nouveau Compte
     * @throws Exception
     * @author Flavio Soares Rodrigues
     */
    public function nouveauCompte()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        // renvois à la page d'accueil si déjà connectée
        if ($_SESSION['connected'])
        {
            // Redirige l'utilisateur vers la page d'accueil
            RedirectUser("");
        }

        // Filtre les inputs
        $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
        $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);

        $users = UserModel::getUsers(); // Récupère tout les utilisateurs

        // Clés
        $key = rand(10000000, 99999999);
        $_SESSION['key'] = $key;

        $to = $email;
        $from = 'site.easygame@gmail.com';
        $name = 'EasyGame';
        $subj = 'Email de confirmation';
        $msg = '    
            <h2>Bonjour '. $email. ',</h2>
            <h3>Complètez votre création de compte en vérifiant votre email ci-dessous.</h3>
            <button style="border: 2px solid transparent; border-radius: 10px; padding: 10px 30px; font-size: 18px;" type="submit">
                <a href="'.URL_PRINCIPAL.'/verification?confirmation='.$key.'" style="text-decoration: none">Cliquer ici pour vérifier votre email</a>
            </button>
        ';


        $message = "";
        $script = "";

        // Si le boutton "Valider" est pressé
        if ($submit == "Valider")
        {
            if ($password2 == "")
            {
                $message .= "<div>Veuillez confirmer votre mot de passe.</div>";
                $script = "Message(" . json_encode('fail').",". json_encode('password2') . ");";
            }
            if ($password == "")
            {
                $message .= "<div>Veuillez indiquer votre mot de passe.</div>";
                $script = "Message(" . json_encode('fail').",". json_encode('password') . ");";
            }
            if ($email == "")
            {
                $message .= "<div>Veuillez indiquer votre email.</div>";
                $script = "Message(" . json_encode('fail').",". json_encode('email') . ");";
            }
            if ($firstName == "")
            {
                $message .= "<div>Veuillez indiquer votre prénom.</div>";
                $script = "Message(" . json_encode('fail').",". json_encode('firstName') . ");";
            }
            if ($lastName == "")
            {
                $message .= "<div>Veuillez indiquer votre nom.</div>";
                $script = "Message(" . json_encode('fail').",". json_encode('lastName') . ");";
            }
            if ($userName == "")
            {
                $message .= "<div>Veuillez indiquer votre nom d'utilisateur.</div>";
                $script = "Message(" . json_encode('fail').",". json_encode('userName') . ");";
            }

            // Condition pour Exécuter
            if ($userName != "" && $lastName != "" && $firstName != "" && $email != "" && $password != "" && $password2 != "")
            {
                // Si le mot de passe est identique à celui de confirmation
                if ($password == $password2)
                {
                    // Hash le mot de passe
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);;

                    // Récupère la fonction verifUserInfo
                    $exists = UserModel::verifUserExists ($userName, $email);

                    // Retourne un message d'erreur si le pseudo ou l'email existe déjà dans la base de donné
                    if ($exists['pseudo_exists'] === 1)
                    {
                        $message = "Ce nom d'utilisateur est déjà utilisé.";
                        $script = "Message(" . json_encode('fail') . ");";
                    }
                    else if ($exists['email_exists'] === 1)
                    {
                        $message = "Cette adresse mail est déjà utilisée.";
                        $script = "Message(" . json_encode('fail') . ");";
                    }
                    else
                    {
                        UserModel::newUser($userName, $lastName, $firstName, $email, $passwordHash);

                        // Récupère l'id de l'utilisateur et on le met dans la session
                        $_SESSION['idUser'] = UserModel::getIdUser($email)['idUser'];

                        // Envoie un mail de confirmation pour activer le compte
                        smtpmailer($to, $from, $name, $subj, $msg);

                        // Efface les valeurs contenues dans le formulaire
                        $userName = "";
                        $lastName = "";
                        $firstName = "";
                        $email = "";
                        $password = "";
                        $password2 = "";

                        $message = "Votre compte a été crée. Veuillez vérifier votre mail pour activer votre compte.";
                        $script = "Message(" . json_encode('success') . ");";
                    }
                }
                else
                {
                    $message = "Les mots de passe ne sont pas identiques.";
                    $script = "Message(" . json_encode('fail') . ");";
                }
            }
        }
        require '../src/view/register.php';
    }
}