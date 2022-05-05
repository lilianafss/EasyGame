<?php

/**
 * Fonction qui démarre une session et qui crée une session si elle n'existe pas
 * @return void
 */
function SessionStart()
{
    session_start();
    if (!isset($_SESSION['idUser']))
    {
        $_SESSION = [
            'idUser' => '',
            'connected' => false,
            'admin' => false,
            'idJeux' => ''
        ];
    }
}

//function Redirect ($url)
//{
//    location ...
//    exit();
//}