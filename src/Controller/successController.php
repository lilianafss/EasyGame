<?php
namespace EasyGame\Controller;
use EasyGame\Model\PanierModel;
require_once('../src/php/tools.php');

class successController{
    function success(){

        SessionStart();
        PanierModel::deletePanier($_SESSION['idUser']);
        $_SESSION['total'] = 0;
        $_SESSION['totalPanier'] = 0;
        require '../src/view/success.php';

    }
}

?>