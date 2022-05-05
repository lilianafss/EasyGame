<?php

namespace EasyGame\Controller;

require_once('../src/php/tools.php');

class DeconnexionController
{
    /** deconnexion
     * @return void
     */
    public static function deconnexion()
    {
        session_start();
        $_SESSION = [];

        if (ini_get("session.use_cookies")){
            setcookie(session_name(), '', 0);
        }
        session_destroy();

        header("Location: /");
        exit();
    }
}