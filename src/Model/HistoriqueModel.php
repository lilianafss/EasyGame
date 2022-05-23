<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class HistoriqueModel
{
    /*------------------------- Select -------------------------*/
    #region Select
    /**
     * Récupère l'historique dans la base de données
     * @param int $idUser
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getHistory($idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `jeux`.`idJeux`,`jeux`.`nom`, `jeux`.`description`, `jeux`.`prix` ,`jeux`.`image`
                FROM `jeux`, `voir_historique`, `user`, `historique` 
                WHERE `jeux`.`idJeux` = `voir_historique`.`idJeux`
                AND `user`.`idUser` = ?
                AND `historique`.idUser = ?
                AND `voir_historique`.`idHistorique` = `historique`.`idHistorique` 
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
     * Ajoute un jeu à son historique d'achat
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addGameToHistorique($idJeux, $idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO `voir_historique`(`idHistorique`, `idJeux`) 
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

    #endregion

    /*------------------------- Update -------------------------*/
    #region Update

    #endregion
}