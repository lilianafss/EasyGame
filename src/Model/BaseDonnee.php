<?php
/*
Auteur      : De Castilho E Sousa Rodrigo
Description : Connexion à la base de données
Date        : 02/2022
Version     : 1.0.0.0
*/

namespace EasyGame\Model;
use Exception;
use PDO;
use PDOException;

require_once "../src/php/config.php";

class BaseDonnee
{
//Connexion à la base de données
    public static function getConnexion()
    {
        static $myDb = null;

        if($myDb === null)
        {
            try
            {
                $myDb = new PDO(
                    "mysql:host=". DB_HOST. ";dbname=". DB_NAME. ";charset=utf8",
                    DB_USER, DB_PASSWORD
                );
                $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch(PDOException $e)
            {
                die("Erreur :" . $e->getMessage());
            }
        }
        return $myDb;
    }
}