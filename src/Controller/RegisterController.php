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

        $errorMessage = "";

        $failStyle = '<style>#error {background: rgba(200, 30, 50, 0.5); color:darkred; height: 80px; border: 2px solid darkred;}</style>';

        // Si le boutton "Valider" est pressé
        if ($submit == "Valider")
        {
            if ($userName != "")
            {
                if ($lastName != "")
                {
                    if ($firstName != "")
                    {
                        if ($email != "")
                        {
                            if ($password != "")
                            {
                                if ($password2 != "")
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
                                            $errorMessage = "Ce nom d'utilisateur est déjà utilisé.";
                                            echo $failStyle;
                                        }
                                        else if ($exists['email_exists'] === 1)
                                        {
                                            $errorMessage = "Cette adresse mail est déjà utilisée.";
                                            echo $failStyle;
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

                                            $errorMessage = "Votre compte a été crée. Veuillez vérifier votre mail pour activer votre compte.";
                                            echo '<style>#error {background: rgba(30, 190, 50, 0.5); color:darkgreen; height: 80px; border: 2px solid darkgreen;}</style>';
                                        }
                                    }
                                    else
                                    {
                                        $errorMessage = "Les mots de passe ne sont pas identiques.";
                                        echo $failStyle;
                                    }
                                }
                                else
                                {
                                    $errorMessage = "Veuillez confirmer votre mot de passe.";
                                    echo $failStyle;
                                }
                            }
                            else
                            {
                                $errorMessage = "Veuillez indiquer votre mot de passe.";
                                echo $failStyle;
                            }
                        }
                        else
                        {
                            $errorMessage = "Veuillez indiquer votre email.";
                            echo $failStyle;
                        }
                    }
                    else
                    {
                        $errorMessage = "Veuillez indiquer votre prénom.";
                        echo $failStyle;
                    }
                }
                else
                {
                    $errorMessage = "Veuillez indiquer votre nom.";
                    echo $failStyle;
                }
            }
            else
            {
                $errorMessage = "Veuillez indiquer votre nom d'utilisateur.";
                echo $failStyle;
            }
        }
        require '../src/view/register.php';
    }
}