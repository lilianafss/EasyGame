<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class CommentaireModel
{
    /*------------------------- Select -------------------------*/
    #region Select
    /**
     * Récupérer les commentaires du jeu
     * @param int $idJeux
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getComments( $idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `commentaire`, `idUser`, `date` FROM `commentaires`
                WHERE `commentaires`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    #endregion

    /*------------------------- Insert -------------------------*/
    #region Insert
    /**
     * Ajoute un commentaire à un jeu choisi
     * @param string $commentaire
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addCommentToGame($commentaire, $idJeux, $idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO `commentaires`(`commentaire`, `date`, `idUser`, `idJeux`) 
                VALUES (?,CURDATE(),?,?)
            ");
            $query->execute([$commentaire, $idUser, $idJeux]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    #endregion

    /*------------------------- Delete -------------------------*/
    #region Delete

    /**
     * Supprime un commentaire
     * @param $idComment
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteComment($idComment)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `commentaires` WHERE `idComentaire` = ?
            ");
            $query->execute([$idComment]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    #endregion

    /*------------------------- Update -------------------------*/
    #region Update

    #endregion
}