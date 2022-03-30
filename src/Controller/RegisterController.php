<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';

//require "../vendor/autoload.php";
//require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';


class RegisterController
{
    /**
     * Crée un nouveau Compte
     * @return void
     * @throws Exception
     * @author Flavio Soares Rodrigues
     */
    public function nouveauCompte()
    {
        // Permet d'utiliser les fonctions contenues dans la classe FonctionsBD
        $fonctionsBD = new FonctionsBD();

        // Filtre les inputs
        $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
        $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_SPECIAL_CHARS);
        $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = "";

        $to = $email;
        $from = 'site.easygame@gmail.com';
        $name = 'EasyGame';
        $subj = 'Email de confirmation';
        $msg = 'http://easygame.ch/';
        $this->smtpmailer($to, $from, $name, $subj, $msg);
        var_dump($this->smtpmailer($to, $from, $name, $subj, $msg));

        // Si le boutton "Valider" est pressé
        if ($submit == "Valider")
            if ($userName != "" && $lastName != "" && $firstName != "" && $email != "" && $password != "" && $password2 != "")
            {
                // Si le mot de passe est identique à celui de confirmation
                if ($password == $password2)
                {
                    // Hash le mot de passe
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);;

                    // Ajoute un nouvel utilisateur dans la base de données
                    try
                    {
                        $this->smtpmailer($to, $from, $name, $subj, $msg);
                        $fonctionsBD->newUser($userName, $lastName, $firstName, $email, $passwordHash);

//                            header("location: /");
//                            exit();
                    }
                    catch (PDOException $e)
                    {
                        if (strpos($e->getMessage(), 'email'))
                        {
                            $message = "email déjà existant";
                        }
                        else if (strpos($e->getMessage(), 'pseudo'))
                        {
                            $message = "nom d'utilisateur déjà existant";
                        }
                    }
                }
                else
                {
                    $message = "Ces mots de passe ne correspondent pas. Veuillez réessayer.";
                }
            }
        else
            {
                $message = "Veuillez Remplir tout les champs";
            }
        else if ($submit == "Annuler")
        {
            header("location: /connexion");
            exit();
        }
        require '../src/view/register.php';
    }

    /** Email de vérification
     * @param $to
     * @param $from
     * @param $from_name
     * @param $subject
     * @param $body
     * @return void
     */
    public function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer(true);
        try
        {
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'site.easygame@gmail.com';
            $mail->Password = 'Super2022';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->From = "site.easygame@gmail.com";
            $mail->AddAddress($to);

            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->FromName = $from_name;
            $mail->Sender = $from;
            $mail->AddReplyTo($from, $from_name);

            $mail->send();

            echo "Mail has been sent successfully";
        }
        catch (\Exception $e)
        {
            var_dump($e->getMessage());
            echo "Message could not be sent.";
        }
    }
}
