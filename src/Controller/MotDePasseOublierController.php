<?php

namespace EasyGame\Controller;

use EasyGame\Model\UserModel;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('../src/php/smtpMailer.php');
require_once('../src/php/tools.php');

class MotDePasseOublierController
{
    /**
     * Envois un mail de vérification pour changer le mot de passe
     * @return void
     * @throws Exception
     * @author Flavio Soares Rodrigues
     */

    public function motDePasseOublier()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        //renvois à la page d'accueil si déjà connectée
        if ($_SESSION['connected'])
        {
            header("location: /");
            exit();
        }

        // Filtre les inputs
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);

        $key = rand(10000000, 99999999);
        $_SESSION['key'] = $key;

        $message = "";
        $script = "";

        if ($submit == "Envoyer")
        {
            if ($email != "")
            {
                // revois 1 si l'email existe dans la base de donnée ou 0 s'il n'existe pas
                $emailExist = UserModel::emailExist ($email);

                $to = $email;
                $from = 'site.easygame@gmail.com';
                $name = 'EasyGame';
                $subj = 'Email de confirmation';
                $msg = '
                    <h2>Bonjour '. $email. ',</h2>
                    <h3>Veuillez cliquer sur le lien ci-dessous pour changer votre mot de passe.</h3>
                    <button style="border: 2px solid transparent; border-radius: 10px; padding: 10px 30px; font-size: 18px;" type="submit">
                        <a href="'.URL_PRINCIPAL.'/modifierMdp?confirm='.$key.'" style="text-decoration: none">Cliquer ici pour changer votre mot de passe</a>
                    </button>
                ';

                // Envois le mail seulement si l'email existe dans la base de donnée, sinon un message d'erreur est affiché
                if ($emailExist['email_exists'] === 1)
                {
                    // Envoie un mail de confirmation pour activer le compte
                    smtpmailer($to, $from, $name, $subj, $msg);
                    $_SESSION['email'] = $email;

                    // message de success
                    $message = "Un lien de vérification de votre compte a été envoyé à ". $email;
                    $script = "<script>Message(" . json_encode('sucess') . ");</script>";

                    $email = "";
                }
                else
                {
                    $message = "Désolé, nous n'avons pas pu trouver d'adresse e-mail correspondant à votre recherche.";
                    $script = "<script>Message(" . json_encode('fail') . ");</script>";
                }
            }
            else
            {
                $message = "Aucune adresse e-mail à été saisie, veuillez remplir le champ avant de soumettre votre requête.";
                $script = "<script>Message(" . json_encode('fail') . ");</script>";
            }
        }
        require '../src/view/motDePasseOublier.php';
    }
}
