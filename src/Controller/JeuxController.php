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
            $envoiePanier=filter_input(INPUT_POST,'panier');

            $infoJeux = FonctionsBD::getGameById($idJeux);
            $tableauxCommentaire= FonctionsBD::getComments($idJeux);
            $tableauxNotes= FonctionsBD::getNotes($idJeux);

            $submit = filter_input(INPUT_POST,'envoyer', FILTER_SANITIZE_SPECIAL_CHARS);

            //Si le button envoyer est egal a "Ajouter commentaire"
            if($submit = "Ajouter commentaire"){
                //Récupération des notes et commentaires
                $note = filter_input(INPUT_POST,'note',FILTER_SANITIZE_NUMBER_INT);
                $commentaire = filter_input(INPUT_POST,'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);

                //Si les input commentaire et note n'est pas egal a vide
                if($commentaire!="" && $note!=""){
                    //ajouter les notes et commentaires a la base de donnees
                    FonctionsBD::addCommentToGame($commentaire,$idJeux,$userUtilisateur);
                    FonctionsBD::addNoteToGame($note,$idJeux,$userUtilisateur);
                }
                elseif($commentaire!=""){
                    FonctionsBD::addCommentToGame($commentaire,$idJeux,$userUtilisateur);
                }
            }

            //Parcourir les tableaux des notes 
            foreach($tableauxNotes as $note){
               //garder les notes dans une variables
                $stringUserCommentaire.='<p>Note:'.$note['note'].'</p>';
            }

            //Parcourir les tableaux des commentaires
            foreach($tableauxCommentaire as $commentaire){
                //garder le idUser dans la variable user
                $user=FonctionsBD::getInfoUser($commentaire['idUser']);
                $stringUserCommentaire .='<p> User:'.$user['pseudo'].'</p>
                <p>Commentaire:'.$commentaire['commentaire'].'</p>';
                
            }

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if($_POST['panier']){
                    
                      $panier=FonctionsBD::addGameToPanier($userUtilisateur,$idJeux);
                      $envoiePanier="Dans le panier";
                      
                   }
            }
           


            $content.='<h1>'.$infoJeux['nom'].'</h1>
            <img class="card-img" src="data:image/jpeg;base64,'.base64_encode($infoJeux['image']).'"/>
            <h3>A propos du jeu</h3>
            <p>'.$infoJeux['description'].'</p>
            <form method="POST">
            <input type="submit" name="panier" id="panier" value="Ajouter au panier">
            </form>
            ';


           

            if($userUtilisateur!=""){
                $formulaire ='<div class="evaluation">
                <label for="note">Note :</label>
                <input type="number" min="1" max="5" name="note" id="note"><br>
                <br>
                <label for="commentaire" >Commentaire: </label>
                <textarea name="commentaire" id="commentaire" cols="50" rows="5" required></textarea><br>
                <br>
                <input type="submit" value="Ajouter commentaire" name="envoyer">
                </div>';


                foreach($tableauxNotes as $note){
                    if($userUtilisateur == $note['idUser']){
                        $formulaire = '<div class="evaluation">
                        <label for="commentaire" >Commentaire: </label>
                        <textarea name="commentaire" id="commentaire" cols="50" rows="5" required></textarea>
                
                        <input type="submit" value="Ajouter commentaire" name="envoyer">
                        </div>';
                    }
                }
                
                $content .= $formulaire;
                
            }

        }else{
            header("Location: http://easygame.ch/");
        }
        require '../src/view/jeux.php';
    }
}
