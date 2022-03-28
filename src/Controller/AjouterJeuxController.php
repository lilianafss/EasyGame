<?php
namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;
use Exception;

class AjouterJeuxController{

    public static function ajouterJeux(){

        $submit = filter_input(INPUT_POST,'submit',FILTER_SANITIZE_SPECIAL_CHARS);

        if($submit == "Envoyer"){
            $nom = filter_input(INPUT_POST,'nomJeu',FILTER_SANITIZE_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST,'descrifJeu',FILTER_SANITIZE_SPECIAL_CHARS);
            $prix = filter_input(INPUT_POST,'prixJeu',FILTER_SANITIZE_NUMBER_FLOAT);
            $pegi = filter_input(INPUT_POST,'pegiJeu',FILTER_SANITIZE_NUMBER_INT);
            $imageURL = filter_input(INPUT_POST,'imageJeu',FILTER_SANITIZE_SPECIAL_CHARS);

            //var_dump(AjouterJeuxController::validateImage($imageURL));
            
            FonctionsBD::deleteUser(17);

            if($nom != "" && $description != "" && $prix != "" && $pegi != "" ){
                // $fp = fopen($imageTmp, 'r');
                // $data = fread($fp, filesize($imageTmp));
                // $data = addslashes($data);
                //fclose($fp);
                
                
            }
            // var_dump($nom);
            // var_dump($description);
            // var_dump($prix);
            // var_dump($pegi);
            // var_dump($imageSize);


        }

        require '../src/view/ajouterJeux.php';
    }

    static public function validateImage($image){
        try{
            $size = getimagesize($image);
            return (strtolower(substr($size['mime'], 0, 5)) == 'image' ? true : false); 
        }
        catch(Exception $e){
            return (strtolower(substr($size['mime'], 0, 5)) == 'image' ? true : false); 
        }
       
        
    }
}