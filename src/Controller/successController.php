<?php

namespace EasyGame\Controller;

use EasyGame\Model\PanierModel;
use EasyGame\Model\HistoriqueModel;

require_once('../src/php/config.php');
require_once('../src/php/tools.php');

class successController
{
    function success()
    {

        // Crée la session si elle n'existe pas
        SessionStart();

        if (!$_SESSION['connected']) {
            // Redirige l'utilisateur vers la page d'accueil
            RedirectUser("");
        } else {
            $tableauxPanier = PanierModel::getPanier($_SESSION['idUser']);
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($_POST['retourPageAccueil']) {
                    foreach ($tableauxPanier as $panier) {
//                        var_dump($_SESSION['idUser']);
//                        var_dump($panier['idJeux']);
                        HistoriqueModel::addGameToHistorique($_SESSION['idUser'], $panier['idJeux']);
                    }
                
                    PanierModel::deletePanier($_SESSION['idUser']);
                    $_SESSION['total'] = 0;
                    $_SESSION['totalPanier'] = 0;
                    $_SESSION['quantite'] = 0;

                    // Redirige l'utilisateur vers la page d'accueil
                    RedirectUser("");
                }

               
            }
        }
        require '../src/view/success.php';
    }
}
