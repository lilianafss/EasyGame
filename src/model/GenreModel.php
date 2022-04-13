<?php

namespace EasyGame\model;

use EasyGame\model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class GenreModel
{
    /*------------------------- Select -------------------------*/
    #region Select
     /**
      * Récupère tout les genres
      * @return array|false|void
      * @author Rodrigo De Castilho E Sousa
      */
    public static function getGenre()
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `genre`, `idGenre` FROM `easygame`.`genre`
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
     * Récupère le(s) genre(s) d'un jeu
     * @param int $idJeux
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGameGenre( $idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                    SELECT `genre` 
                    FROM `genre`, `filtre_jeux` 
                    WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = ?
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