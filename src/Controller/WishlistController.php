<?php
namespace EasyGame\Controller;
require_once('../src/php/tools.php');

class WishlistController{
    public function wishlist(){
        // Crée la session si elle n'existe pas
        SessionStart();
        
        require '../src/view/wishlist.php';
    }
}