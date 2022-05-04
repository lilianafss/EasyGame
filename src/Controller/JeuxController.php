<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\CommentaireModel;
use EasyGame\Model\GameModel;
use EasyGame\Model\NoteModel;
use EasyGame\Model\PanierModel;


//@ini_set('display_errors', 'on');
class JeuxController
{
    public static function jeux()
    {
        session_start();
        $idJeux = filter_input(INPUT_GET, 'idJeux');

        
        if ($idJeux != "") {
          
            $note="";
            $commentaire="";
            $quantite=0;
            $envoiePanier = filter_input(INPUT_POST, 'panier');
            $idUser = $_SESSION['idUser'];

            $infoJeux = GameModel::getGameById($idJeux);
            $tableauxCommentaire = CommentaireModel::getComments($idJeux);
            $tableauxNotes = NoteModel::getNotes($idJeux);
            $tableauxPanier = PanierModel::getPanier($idUser);

            $submit = filter_input(INPUT_POST, 'envoyer', FILTER_SANITIZE_SPECIAL_CHARS);

            //Récupération des notes et commentaires
            $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
            $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);

            //Si le button envoyer est egal a "AjouterCommentaire"
            if ($submit == "AjouterCommentaire")
            {
                //Si les inputs commentaire et note n'est pas egal a vide
                if ($commentaire != "" && $note != "" &&  $idUser != "")
                {
                    //ajouter les notes et commentaires a la base de donnees
                    CommentaireModel::addCommentToGame($commentaire, $idJeux, $idUser);
                    NoteModel::addNoteToGame($note, $idJeux, $idUser);
                }
                elseif ($commentaire != "" && $idUser != "")
                {
                    CommentaireModel::addCommentToGame($commentaire, $idJeux, $idUser);
                }
                header("Refresh: 0;url=jeux?idJeux=$idJeux");
            }
            foreach ($tableauxPanier as $panier) {
              
               $quantite++;
               $_SESSION["quantite"]=$quantite;
             
            }
           

            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                if ($_POST['panier'])
                {
                    $panier = PanierModel::addGameToPanier($idUser, $idJeux);
                    $envoiePanier = "Dans le panier";
                    
                }
            }
        }
        else
        {
            header("Location: http://easygame.ch/");
        }
        require '../src/view/jeux.php';
    }
}
