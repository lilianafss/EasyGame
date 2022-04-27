<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class PegiModel
{
    /*------------------------- Select -------------------------*/
    #region Select
    /**
     * Récupère tout les PEGI
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getPegi()
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `pegi` FROM `easygame`.`pegis`
            ");
            $query->execute();
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

    #endregion

    /*------------------------- Delete -------------------------*/
    #region Delete

    #endregion

    /*------------------------- Update -------------------------*/
    #region Update

    #endregion
}