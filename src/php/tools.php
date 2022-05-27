<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * Crée une session si elle n'existe pas
 * @return void
 *
 * @author Flavio Soares Rodrigues
 */
function SessionStart()
{
    session_start();
    if (!isset($_SESSION['idUser']))
    {
        $_SESSION = [
            'idUser' => '',
            'email' => '',
            'connected' => false,
            'admin' => false,
            'idJeux' => '',
            'quantite' => 0
        ];
    }
}

/**
 * Redirige l'utilisateur vers une page en fonction de l'url donnée en paramètre
 * @param $url
 * @return void
 * @author Flavio Soares Rodrigues
 */
function RedirectUser($url)
{
    header("Location:".URL_PRINCIPAL.$url);
    exit();
}