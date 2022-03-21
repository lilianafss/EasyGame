<?php
namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class JeuxController{
    public static function jeux(){
        $idJeux=filter_input(INPUT_GET,'idJeux');
        if($idJeux!=""){
            $infoJeux = FonctionsBD::getGameById($idJeux);
            $tableauxCommentaire= FonctionsBD::getComments($idJeux);
            $tableauxNotes= FonctionsBD::getNotes($idJeux);

            // foreach($tableauxCommentaire as $commentaire){
            //     $string
            // }
        }else{
            header("Location: easygame.ch");
        }
        require '../src/view/jeux.php';
    }
}

?>