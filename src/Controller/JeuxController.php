<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\CommentaireModel;
use EasyGame\Model\GameModel;
use EasyGame\Model\NoteModel;
use EasyGame\Model\PanierModel;
use EasyGame\Model\UserModel;


//@ini_set('display_errors', 'on');
class JeuxController
{
    public static function jeux()
    {
        session_start();

        $idJeux = filter_input(INPUT_GET, 'idJeux');
        


        if ($idJeux != "") {

           
            $userUtilisateur = $_SESSION['idUser'];
            $envoiePanier = filter_input(INPUT_POST, 'panier');

            $infoJeux = GameModel::getGameById($idJeux);
            $tableauxCommentaire = CommentaireModel::getComments($idJeux);
            $tableauxNotes = NoteModel::getNotes($idJeux);

            $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);

        
            //Si le button envoyer est egal a "Ajouter commentaire"
            if ($submit = "Ajouter commentaire") {

                //Récupération des notes et commentaires
                $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
                $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);
                //Si les inputs commentaire et note n'est pas egal a vide
                if ($commentaire != "" && $note != "" &&  $userUtilisateur != "") {
                    //ajouter les notes et commentaires a la base de donnees
                    CommentaireModel::addCommentToGame($commentaire, $idJeux, $userUtilisateur);
                    NoteModel::addNoteToGame($note, $idJeux, $userUtilisateur);
                } elseif ($commentaire != "" && $userUtilisateur != "") {
                    CommentaireModel::addCommentToGame($commentaire, $idJeux, $userUtilisateur);
                }
            }
            
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                if ($_POST['panier'])
                {
                    $panier = PanierModel::addGameToPanier($userUtilisateur, $idJeux);
                    $envoiePanier = "Dans le panier";
                }
            }
            

            //Affichage des l'informations du jeux
            
            //     foreach ($tableauxNotes as $note) {
            //         if ($userUtilisateur == $note['idUser']) {
            //             $formulaire = '<div class="evaluation">
            //                 <label for="commentaire" >Commentaire: </label>
            //                 <textarea name="commentaire" id="commentaire" cols="50" rows="5" required></textarea>
            //                <input type="submit" value="Ajouter commentaire" name="submit">
            //             </div>'; 
            //         }
            //     }
            //     $content .= $formulaire;
            // }
        } else {
            header("Location: http://easygame.ch/");
            
        }
        require '../src/view/jeux.php';
    }
}
