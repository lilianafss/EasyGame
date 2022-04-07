<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;
use JetBrains\PhpStorm\NoReturn;

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