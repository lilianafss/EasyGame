<?php
namespace EasyGame\Controller;
require_once('../src/php/tools.php');

class errorController{
    function error(){

        // Crée la session si elle n'existe pas
        SessionStart();
        
        if (!$_SESSION['connected'])
        {
            header("location: http://easygame.ch");
            exit();
        }
        require '../src/view/error.php';

    }
}

?>