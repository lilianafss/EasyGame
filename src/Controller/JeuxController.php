<?php
namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class JeuxController{
    public static function jeux(){
        session_start();
        $content="";
        $stringUser="";
        $stringNote="";
        $stringCommentaire="";
        $idJeux=filter_input(INPUT_GET,'idJeux');
        $envoyer=filter_input(INPUT_GET,'envoyer');
        $note=filter_input(INPUT_GET,'note');
        $commentaire=filter_input(INPUT_GET,'commentaire');
        $user1=filter_input(INPUT_GET,'idUser');

        if($idJeux!=""){
            $infoJeux = FonctionsBD::getGameById($idJeux);
            $tableauxCommentaire= FonctionsBD::getComments($idJeux);
            $tableauxNotes= FonctionsBD::getNotes($idJeux);

            foreach($tableauxCommentaire as $commentaire){
                $user=FonctionsBD::getInfoUser($commentaire['idUser']);
                $stringUser.='<p> User:'.$user['pseudo'].'</p>';
                $stringCommentaire.='<p>Commentaire:'.$commentaire['commentaire'].'</p>';
                
            }
            foreach($tableauxNotes as $note){
                $user=FonctionsBD::getInfoUser($note['idUser']);
                $stringNote.='<p>Note:'.$note['note'].'</p>';
            }
           
            $content.='<h1>'.$infoJeux['nom'].'</h1>
            <img class="card-img" src="data:image/jpeg;base64,'.base64_encode($infoJeux['image']).'"/>
            <h3>A propos du jeu</h3>
            <p>'.$infoJeux['description'].'</p>
            <h3>Notes et Comentaires</h3>
            <p>'.$stringUser.'</p>
            <p>'.$stringNote.'</p>
            <p>'.$stringCommentaire.'</p>';

            if($note!="" && $commentaire!=""){
                FonctionsBD::addCommentToGame($commentaire,$idJeux,$user);
                FonctionsBD::addNoteToGame($note,$idJeux,$user);
            }
        }else{
            header("Location: easygame.ch");
        }
        require '../src/view/jeux.php';
    }
}

?>