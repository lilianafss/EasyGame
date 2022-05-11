<?php

namespace EasyGame\Controller;

use EasyGame\Model\UserModel;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../src/php/smtpMailer.php');
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
            header("location: /");
            exit();
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
        $msg = '<h1>Complètez votre création de compte en vérifiant votre email ci-dessous </h1>
                <button type="submit">
                    <a href="http://easygame.ch/verification?confirmation='.$key.'" style="text-decoration: none">Cliquer ici pour vérifier votre email</a>
                </button>';

        $sucess_message = "";

        // Si le boutton "Valider" est pressé
        if ($submit == "Valider")
        {
            if ($userName != "" && $lastName != "" && $firstName != "" && $email != "" && $password != "" && $password2 != "")
            {
                // Si le mot de passe est identique à celui de confirmation
                if ($password == $password2)
                {
                    // Hash le mot de passe
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);;

                    // Récupère la fonction verifUserInfo
                    $exists = UserModel::verifUserInfo ($userName, $email);

                    // Retourne un message d'erreur si le pseudo ou l'email existe déjà dans la base de donné
                    if ($exists['pseudo_exists'] === 1)
                    {
                        echo "<script>ErrorMessage('Ce nom d\'utilisateur est déjà utilisé.', 'userName', 'false');</script>";
                    }
                    else if ($exists['email_exists'] === 1)
                    {
                        echo "<script>ErrorMessage('Cette adresse mail est déjà utilisée.', 'email', 'false');</script>";
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

                        $sucess_message = "<div id='sucess_message'> <p>Votre compte a été crée. Veuillez vérifier votre mail pour activer votre compte.</p></div>";
                    }
                }
            }
        }
        require '../src/view/register.php';
    }
}