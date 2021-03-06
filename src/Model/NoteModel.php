<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class NoteModel
{
    /*------------------------- Select -------------------------*/
    #region Select
    /**
     * Récupère les notes de la base de données
     * @param int $idJeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getNotes( $idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `note`, `idUser` FROM `notes` 
                WHERE `notes`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Récupère la note d'un jeu, d'un utilisateur
     * @param int $idJeux
     * @param int $idUser
     * @return array|false|void
     * @author Flavio Soares Rodrigues
     */
    public static function getNoteByUserForOneGame($idJeux, $idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `note` FROM `notes` 
                WHERE `notes`.`idJeux` = ? AND `notes`.`idUser` = ?;
            ");
            $query->execute([$idJeux, $idUser]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Récupère les notes de la base de données
     * @param int $idJeux
     * @return array|false|void
     * @author Liliana Santos
     */
    public static function averageByGame( $idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT ROUND(AVG(note),1) as average FROM `notes` 
                WHERE `notes`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    #endregion

    /*------------------------- Insert -------------------------*/
    #region Insert
    /**
     * Ajoute une note à un jeu choisi
     *
     * @param int $note
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addNoteToGame( $note,  $idJeux,  $idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO notes(note, idUser, idJeux) 
                VALUES (?,?,?)
            ");
            $query->execute([$note, $idUser, $idJeux]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    #endregion

    /*------------------------- Delete -------------------------*/
    #region Delete

    #endregion

    /*------------------------- Update -------------------------*/
    #region Update

    #endregion
}