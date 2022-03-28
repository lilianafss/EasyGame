<?php
namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class PanierController
{
function panier(){
    //$infoJeux = FonctionsBD::getGameById($idJeux);
require_once "../src/view/panier.php";
}

}

?>