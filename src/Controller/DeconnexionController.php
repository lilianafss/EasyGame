<?php

namespace EasyGame\Controller;

use EasyGame\model\BaseDonnee;
use EasyGame\model\GameModel;
use EasyGame\model\GenreModel;
use EasyGame\model\HistoriqueModel;
use EasyGame\model\NoteModel;
use EasyGame\model\PanierModel;
use EasyGame\model\PegiModel;
use EasyGame\model\PlatformModel;
use EasyGame\model\UserModel;
use EasyGame\model\WishlistModel;

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