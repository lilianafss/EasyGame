<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\UserModel;
use EasyGame\Model\PanierModel;
class ConnexionController
{
    /**
     * Se connecter
     *
     * @return void
     * @author De Castilho E Sousa Rodrigo
     */
    public static function connexion()
    {
        session_start();
        $userUtilisateur = $_SESSION['idUser'];


        //si idUser n'existe pas dans la session on va creer ses trois variables
        if (!isset($_SESSION['idUser'])) {
            $_SESSION = [
                'idUser' => '',
                'connected' => false,
                'admin' => false,
            ];
        }

        if ($_SESSION['connected']) {
            header("location: /");
            exit();
        }

        //varible pour récupérer le boutton
        $submit = filter_input(INPUT_POST, 'btnSubmit', FILTER_SANITIZE_SPECIAL_CHARS);
        $erreur = "";

        //si la variable submit = "Se connecter" on prend l'email et le mot de passe
        if ($submit == "Se connecter") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            //si les deux sont egale à rien on va mettre un message d'erreur
            if ($email != "" && $password != "") {
                if (UserModel::getIdUser($email)) {
                    $_SESSION['idUser'] = UserModel::getIdUser($email)['idUser'];

                    //si le mot de passe est correct par rapport à l'email on va etre connecté
                    if (password_verify($password, UserModel::getInfoUser($_SESSION['idUser'])['password'])) {
                        $_SESSION['admin'] = boolval(UserModel::getInfoUser($_SESSION['idUser'])['admin']);
                        $_SESSION['connected'] = true;

                        header("location: http://easygame.ch");
                        exit();
                    } else {
                        $_SESSION = [
                            'idUser' => "",
                            'connected' => false,
                            'admin' => false
                        ];
                        $erreur = "Email ou mot de passe incorrect.";
                    }
                } else {
                    $erreur = "Email ou mot de passe incorrect.";
                }
            } else {
                $erreur = "Saisissez votre email et mot de passe.";
            }
        }
        require '../src/view/connexion.php';
    }
}
