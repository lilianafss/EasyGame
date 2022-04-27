<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class PlatformModel
{
    /*------------------------- Select -------------------------*/
    #region Select
    /**
     * Récupère toutes les plateformes
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getPlatform()
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `plateforme`, `idPlateforme` FROM `easygame`.`plateforme`
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Récupère la(les) plateforme(s) d'un jeu(x)
     * @param int $idJeux
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGamePlatform($idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT DISTINCT `plateforme` 
                FROM `plateforme`, `ou_jouer` 
                WHERE `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                AND `ou_jouer`.`idJeux` = ?
            ");
            $query->execute([$idJeux]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    #endregion

    /*------------------------- Insert -------------------------*/
    #region Insert

    #endregion

    /*------------------------- Delete -------------------------*/
    #region Delete

    #endregion

    /*------------------------- Update -------------------------*/
    #region Update

    #endregion
}