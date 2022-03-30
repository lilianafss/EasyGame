<?php
namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

//@ini_set('display_errors', 'on');
class JeuxController{
    public static function jeux(){
        session_start();
        
        $idJeux=filter_input(INPUT_GET,'idJeux');

        if($idJeux!=""){

            $content="";
            $formulaire = "";
            $stringUserCommentaire = "";
            $userUtilisateur=$_SESSION['idUser'];

            $infoJeux = FonctionsBD::getGameById($idJeux);
            $tableauxCommentaire= FonctionsBD::getComments($idJeux);
            $tableauxNotes= FonctionsBD::getNotes($idJeux);

            $submit = filter_input(INPUT_POST,'envoyer', FILTER_SANITIZE_SPECIAL_CHARS);

            if($submit = "Ajouter commentaire"){
                $note = filter_input(INPUT_POST,'note',FILTER_SANITIZE_NUMBER_INT);
                $commentaire = filter_input(INPUT_POST,'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);

                if($commentaire!="" && $note!=""){
                    FonctionsBD::addCommentToGame($commentaire,$idJeux,$userUtilisateur);
                    FonctionsBD::addNoteToGame($note,$idJeux,$userUtilisateur);
                }
                elseif($commentaire!=""){
                    FonctionsBD::addCommentToGame($commentaire,$idJeux,$userUtilisateur);
                }
            }

            foreach($tableauxNotes as $note){
               
                $stringUserCommentaire.='<p>Note:'.$note['note'].'</p>';
            }

            foreach($tableauxCommentaire as $commentaire){
                $user=FonctionsBD::getInfoUser($commentaire['idUser']);
                $stringUserCommentaire .='<p> User:'.$user['pseudo'].'</p>
                <p>Commentaire:'.$commentaire['commentaire'].'</p>';
                
            }

          
            // if(filter_has_var(INPUT_GET,'panier')){
            //     echo "coucou";
            //     $panier=FonctionsBD::addGameToPanier($userUtilisateur,$idJeux);
               
            // }


            $content.='<h1>'.$infoJeux['nom'].'</h1>
            <img class="card-img" src="data:image/jpeg;base64,'.base64_encode($infoJeux['image']).'"/>
            <h3>A propos du jeu</h3>
            <p>'.$infoJeux['description'].'</p>
            <input type="submit" name="panier" id="panier" value="Ajouter au panier">';

           

            if($userUtilisateur!=""){
                $formulaire ='<label for="note">Note :</label>
                <input type="number" min="1" max="5" name="note" id="note">
        
                <label for="commentaire" >Commentaire: </label>
                <textarea name="commentaire" id="commentaire" cols="50" rows="5" required></textarea>
                
                <input type="submit" value="Ajouter commentaire" name="envoyer">';

                foreach($tableauxNotes as $note){
                    if($userUtilisateur == $note['idUser']){
                        $formulaire = '<label for="commentaire" >Commentaire: </label>
                        <textarea name="commentaire" id="commentaire" cols="50" rows="5" required></textarea>
                
                        <input type="submit" value="Ajouter commentaire" name="envoyer">';
                    }
                }
                
                $content .= $formulaire;
                
            }
           
           

            $stringNotesCommentaire ='<h3>Notes et Comentaires</h3>
            <p>'.$stringUserCommentaire.'</p>';

        }else{
            header("Location: http://easygame.ch/");
        }
        require '../src/view/jeux.php';
    }
}
