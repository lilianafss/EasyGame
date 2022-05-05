<?php
namespace EasyGame\Controller;
require_once('../src/php/tools.php');

class ProfilController{

    public function profil(){
        // Crée la session si elle n'existe pas
        SessionStart();
        
        require '../src/view/profil.php';
    }
}