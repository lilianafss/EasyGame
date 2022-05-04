<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class PanierModel
{
    /*------------------------- Select -------------------------*/
    #region Select

    /**
     * Récupère les informations du panier
     * @param $idUser
     * @return array|false|void
     *
     * @author Ania Marostica
     */
    public static function getPanier($idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `jeux`.`idJeux`,`jeux`.`nom`, `jeux`.`description`, `jeux`.`prix`,`jeux`.`image`
                FROM `jeux`, `ajouter_panier`, `user`, `panier` 
                WHERE `jeux`.`idJeux` = `ajouter_panier`.`idJeux`
                AND `user`.`idUser` = ?
                AND `panier`.idUser = ?
                AND `ajouter_panier`.`idPanier` = `panier`.`idPanier` 
            ");
            $query->execute([$idUser, $idUser]);
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
     * Ajoute un jeu dans le panier de l'utilisateur
     *
     * @param $idUser
     * @param $idJeux
     *
     * Rodrigo De Castilho E Sousa
     */
    public static function addGameToPanier($idUser, $idJeux)
    {
        try
        {
            $query= BaseDonnee::getConnexion()->prepare("
                INSERT INTO `ajouter_panier`(`idPanier`, `idJeux`)
                VALUES (?,?)
            ");
            $query->execute([$idUser, $idJeux]);
        }
        catch(Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    #endregion

    /*------------------------- Delete -------------------------*/
    #region Delete
    /**
     * Efface un jeu du panier
     * @param int $idJeux
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteGameToPanier($idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `ajouter_panier`WHERE `idJeux`= ?
            ");
            $query->execute([$idJeux]);
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