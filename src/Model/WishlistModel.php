<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class WishlistModel
{
    /*------------------------- Select -------------------------*/
    #region Select
    /**
     * Récupère la wishlist dans la base de données
     * @param int $idUser
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getWishlist( $idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `jeux`.`idJeux`,`jeux`.`nom`, `jeux`.`description`, `jeux`.`prix` ,`jeux`.`image`
                FROM `jeux`, `ajouter_wishlist`, `user`, `wishlist` 
                WHERE `jeux`.`idJeux` = `ajouter_wishlist`.`idJeux`
                AND `user`.`idUser` = ?
                AND `wishlist`.idUser = ?
                AND `ajouter_wishlist`.`idWishlist` = `wishlist`.`idWishlist` 
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
     * Ajoute un jeux a sa wishlist
     *
     * @param int $idUser
     * @param int $idJeux
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addGameToWishlist($idUser, $idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO `ajouter_wishlist`(`idWishlist`, `idJeux`) 
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
     * Ajoute un jeux a sa wishlist
     *
     * @param int $idJeux
     * @return void
     *
     *  @author Ania Marostica
     */
    public static function deleteGameToWishlist($idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `ajouter_wishlist` WHERE `idJeux`= ?
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