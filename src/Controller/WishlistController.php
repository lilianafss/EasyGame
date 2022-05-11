<?php
namespace EasyGame\Controller;
use EasyGame\Model\PanierModel;
use EasyGame\Model\WishlistModel;
require_once('../src/php/tools.php');

class WishlistController{
    public function wishlist(){
        // Crée la session si elle n'existe pas
        SessionStart();

        require '../src/view/wishlist.php';
    }
}