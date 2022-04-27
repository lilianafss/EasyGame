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