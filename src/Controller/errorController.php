<?php
namespace EasyGame\Controller;
require_once('../src/php/tools.php');

class errorController{
    function error(){

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