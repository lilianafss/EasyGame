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

            $content = "";
            $formulaire = "";
            $stringUser = "";
            $stringNote = "";
            $stringCommentaire = "";
            $stringDate = "";
            $finTitre="</h4>";
            $userUtilisateur = $_SESSION['idUser'];
            $envoiePanier = filter_input(INPUT_POST, 'panier');

            $infoJeux = GameModel::getGameById($idJeux);
            $tableauxCommentaire = CommentaireModel::getComments($idJeux);
            $tableauxNotes = NoteModel::getNotes($idJeux);

            $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);

        
            //Si le button envoyer est egal a "Ajouter commentaire"
            if ($submit = "Ajouter") {

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

            //Parcourir les tableaux des notes 
            foreach ($tableauxNotes as $note) {
                //garder les notes dans une variable
                $stringNote .= $note['note'];
            }

            //Parcourir les tableaux des commentaires
            foreach ($tableauxCommentaire as $commentaire) {
                //garder le idUser dans la variable user
                $user = UserModel::getInfoUser($commentaire['idUser']);
                $stringUser .= $user['pseudo'];
                $stringCommentaire .= $commentaire['commentaire'];
                $stringDate .= $commentaire['date'];
            }

            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                if ($_POST['panier'])
                {
                    $panier = PanierModel::addGameToPanier($userUtilisateur, $idJeux);
                    $envoiePanier = "Dans le panier";
                }
            }
            // }

            //Affichage des l'informations du jeux
            // $content =
            //     '<div class="description">
            //         <h1>' . $infoJeux['nom'] . '</h1>
            //         <img src="data:image/jpeg;base64,' . base64_encode($infoJeux['image']) . '"/>
            //         <h3>A propos du jeu</h3>
            //         <p>' . $infoJeux['description'] . '</p>
            //     </div>
  
            //     <input type="submit" name="panier" id="panier" value="Ajouter au panier"><br>
             
            //      <br>';
            //     if($stringCommentaire!=""){
            //         $content.='
            //         <h3>Notes et Comentaires</h3>
            //         <div class="review-list">
            //             <ul>
            //                 <li>
            //                     <div class="right">
            //                         <h4>' . $stringUser . '
            //                             <span class="gig-rating text-body-2">
            //                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
            //                                     <path
            //                                         fill="currentColor"
            //                                         d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
            //                                     ></path>
            //                                 </svg>
            //                                 ' . $stringNote . '
            //                             </span>
            //                         </h4>
            //                         <span class="publish py-3 d-inline-block w-100">' . $stringDate . '</span>
            //                         <div class="review-description">
            //                             <p>
            //                             ' . $stringCommentaire . '
            //                             </p><br>
            //                         </div>
                                    
            //                     </div>
            //                 </li>
            //             </ul>
            //         </div>
            //         ';
                // }

            // if ($userUtilisateur != "") {
            //     $formulaire = '<div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
            //         <h5 class="mb-4">Laisse votre avis</h5>
            //         <label>Note</p>
            //         <input type="number" min="1" max="5" name="note" id="note"><br>
            //         <div class="form-group">
            //             <label>Votre commentaire</label>
            //             <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
            //         </div>
            //         <div class="form-group">
            //             <input type="submit" value="Ajouter commentaire" name="envoyer">
            //         </div>

            //     </div>';  


            //     foreach ($tableauxNotes as $note) {
            //         if ($userUtilisateur == $note['idUser']) {
            //             $formulaire = '<div class="evaluation">
            //                 <label for="commentaire" >Commentaire: </label>
            //                 <textarea name="commentaire" id="commentaire" cols="50" rows="5" required></textarea>
            //                <input type="submit" value="Ajouter" name="submit">
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
