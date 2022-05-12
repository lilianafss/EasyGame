<?php

namespace EasyGame\Controller;

use EasyGame\Model\PanierModel;
use EasyGame\Model\HistoriqueModel;


require_once('../src/php/tools.php');

class successController
{
    function success()
    {

        SessionStart();
        $idJeux = filter_input(INPUT_POST, 'idJeux');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['test']) {
        var_dump($idJeux);
        HistoriqueModel::addGameToHistorique($_SESSION['idUser'], $idJeux);
            }
        }
        // PanierModel::deletePanier($_SESSION['idUser']);
        // $_SESSION['total'] = 0;
        // $_SESSION['totalPanier'] = 0;

       
        require '../src/view/success.php';
    }
}
