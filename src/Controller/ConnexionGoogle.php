<?php
//require_once '../EasyGame/vendor/autoload.php';

//Constantes pour la connexion a la api de Google
define('GOOGLE_CLIENT_ID', '838043112796-f12mgg5d9ubet2ave7qr8astc1olp8rd.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', 'http://easygame.ch');

function userGoogle($gClient, $google_oauth){
    $gClient = new Google_Client();
    $gClient->setApplicationName('easygame');
    $gClient->setClientId(GOOGLE_CLIENT_ID);
    $gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
    $gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

    $google_oauth = new Google_Service_Oauth2($gClient);
}