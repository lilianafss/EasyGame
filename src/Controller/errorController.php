<?php
namespace EasyGame\Controller;
require_once('../src/php/tools.php');

class errorController{
    function error(){

        SessionStart();
        require '../src/view/error.php';

    }
}

?>