<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;
use Exception;

class AjouterJeuxController
{
    /**
     * Fonction de la page de ajouter jeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function ajouterJeux()
    {
        //start la fonction
        session_start();
        if (!isset($_SESSION['idUser'])) {
            $_SESSION = [
              'idUser' => '',
              'connected' => false,
              'admin' => false,
              'btnJeux' => false,
              'btnUser' => false,
              'nbGenre' =>'',
              'nbPlatform'=>''
            ];
        }

        $tableau = "";
        $messageErreur = "";
        $tableauGenre = [];
        $tableauPlatform = [];

        //si on est pas connecté en tant de admin on va a la page d'accueil
        if (!$_SESSION['admin']) {
            header("location: http://easygame.ch");
            exit();
        } else {

            $btnGenrePlateform = filter_input(INPUT_POST,'btnGenrePlateform',FILTER_SANITIZE_SPECIAL_CHARS);
            if($btnGenrePlateform == "Submit Platform et Genre"){
               $_SESSION['nbGenre'] = filter_input(INPUT_POST,'nbGenre',FILTER_SANITIZE_NUMBER_INT);
               $_SESSION['nbPlatform'] = filter_input(INPUT_POST,'nbPlatform',FILTER_SANITIZE_NUMBER_INT);
                $tableau = AjouterJeuxController::afficherGenresPlateform($_SESSION['nbGenre'],$_SESSION['nbPlatform']); 
            }
            
            $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
            //on essaye de ajouter le jeu si on touche le bouton Envoyer
            if ($submit == "Envoyer" ) {

                //recuperer les donnees et l'image
                $nomJeux = filter_input(INPUT_POST, 'nomJeu', FILTER_SANITIZE_SPECIAL_CHARS);
                $description = filter_input(INPUT_POST, 'descrifJeu', FILTER_SANITIZE_SPECIAL_CHARS);
                $prix = floatval(filter_input(INPUT_POST, 'prixJeu', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
                $idPegi = filter_input(INPUT_POST, 'pegiJeu', FILTER_SANITIZE_NUMBER_INT);
                $image = $_FILES['imageJeu']['tmp_name'];

                if($_SESSION['nbGenre'] != ""){
                  
                    for($i = 1 ; $i <= $_SESSION['nbGenre']; $i++){
                        
                        $tableauGenre[$i] = filter_input(INPUT_POST, 'nbGenre'.$i, FILTER_SANITIZE_NUMBER_INT);
                        
                    }
                    /*Check if the array contain multiple same values in php*/
                    $array_new = array_count_values($tableauGenre);
                    $array2 = array();

                    foreach($array_new as $key=>$val){
                        if($val >1){ //or do $val >2 based on your desire
                          $array2[] = $key;
                        }
                    }
                }

                if($_SESSION['nbPlatform'] != ""){
                  
                    for($i = 1 ; $i <= $_SESSION['nbPlatform']; $i++){
                        
                        $tableauPlatform[$i] = filter_input(INPUT_POST, 'nbPlatform'.$i, FILTER_SANITIZE_NUMBER_INT);
                        
                    }
                }
                var_dump($array2);

                //si tout est rempli on l'ajoute a la base de donnée
                if ($nomJeux != "" && $description != "" && $prix != "" && $idPegi != "" && $image != "") {
                    $img = file_get_contents($image);
                    //FonctionsBD::newGame($nomJeux, $description, $prix, $idPegi, $img);
                } else {
                    //affichage de la message d'erreur
                    $messageErreur = "<p id='messageErreur'>Tous les champs doivent être remplis</p>";
                }
            }
        }
        require '../src/view/ajouterJeux.php';
    }

    public static function afficherGenresPlateform($nbGenre, $nbPlatform){

        $tableau = "";

        for($i = 1;$i <= $nbGenre; $i++){ 
            $tableau .='<select name="nbGenre'.$i.'">';

            foreach(FonctionsBD::getGenre() as $genre){
             
                $tableau .='<option value="'.$genre['idGenre'].'">'.$genre['genre'].'</option>';
            }
            $tableau .='</select><br>';
        }   
        
        for($i = 1;$i <= $nbPlatform; $i++){
            $tableau .='<select name="nbPlatform'.$i.'">';

            foreach(FonctionsBD::getPlatform() as $platform){
             
                $tableau .='<option value="'.$platform['idPlateforme'].'">'.$platform['plateforme'].'</option>';
            }
            $tableau .='</select><br>';
        }  
         
        return $tableau ;
    }
}