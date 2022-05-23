<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class GameModel
{
    /*------------------------- Select -------------------------*/
    #region Select
    /**
     * Récupère la table jeux dans la base de données
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGames()
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `idJeux`, `nom`, `description`, `prix`, `pegis`.`pegi`, `image` 
                FROM `jeux`, `pegis`
                WHERE `jeux`.`idPegi` = `pegis`.`idPegi`
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
     * Récupère un jeu avec son id
     * @param int $idJeux
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGameById($idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `idJeux`, `nom`, `description`, `prix`, `pegis`.`pegi`, `image` 
                FROM `jeux`, `pegis`
                WHERE `jeux`.`idPegi` = `pegis`.`idPegi`
                AND `idJeux` = ?
            ");
            $query->execute([$idJeux]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Cherche un jeu avec son nom
     *
     * @param string $gameName
     * @return array|false|void
     *
     * @author Liliana Filipa Santos Silva
     */
    public static function searchGame($gameName)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT idJeux, nom, description, prix, image 
                FROM jeux WHERE nom 
                LIKE '%$gameName%'
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
     * Cherche un jeu en fonction du pegi, genre ou plateforme
     *
     * @param string $pegi
     * @param string $genre
     * @param string $plateforme
     * @return array|false|void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGameByFilters($pegi, $genre, $plateforme)
    {
        if ($pegi != "" && $genre != "" && $plateforme != "")
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`, `nom`, `description`, `prix`, `image`  
                    FROM `jeux`, `genre`, `plateforme`, `pegis`, `ou_jouer`, `filtre_jeux` 
                    WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                    AND `ou_jouer`.`idJeux` = `jeux`.`idJeux`
                    AND `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `genre`.`genre` = ?
                    AND `plateforme`.`plateforme` = ?
                    AND `pegis`.`pegi` = ?
                ");
                $query->execute([$genre, $plateforme, $pegi]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        else if ($genre != "" && $plateforme != "")
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`,`nom`, `description`, `prix`, `image`
                    FROM `jeux`, `genre`, `plateforme`, `ou_jouer`, `filtre_jeux` 
                    WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                    AND `ou_jouer`.`idJeux` = `jeux`.`idJeux`
                    AND `genre`.`genre` = ?
                    AND `plateforme`.`plateforme` = ?
                ");
                $query->execute([$genre, $plateforme]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        else if ($genre != "" && $pegi != "")
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`,`nom`, `description`, `prix`, `image` 
                    FROM `jeux`, `genre`, `pegis`, `filtre_jeux` 
                    WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `genre`.`genre` = ?
                    AND `pegis`.`pegi` = ?
                ");
                $query->execute([$genre, $pegi]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        else if ($plateforme != "" && $pegi != "")
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`,`nom`, `description`, `prix`, `image` 
                    FROM `jeux`, `plateforme`, `pegis`, `ou_jouer`
                    WHERE `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                    AND `ou_jouer`.`idJeux` = `jeux`.`idJeux`
                    AND `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `plateforme`.`plateforme` = ?
                    AND `pegis`.`pegi` = ?
                ");
                $query->execute([$plateforme, $pegi]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        else if ($pegi != "")
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`,`nom`, `description`, `prix`, `image`
                    FROM `jeux`, `pegis`
                    WHERE `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `pegis`.`pegi` = ?
                ");
                $query->execute([$pegi]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        else if ($plateforme != "")
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`, `nom`, `description`, `prix`, `pegi` ,`image` 
                    FROM `jeux`, `plateforme`, `ou_jouer`, `pegis`
                    WHERE `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                    AND `pegis`.`idPegi` = `jeux`.`idPegi`
                    AND  `jeux`.`idJeux`= `ou_jouer`.`idJeux`
                    AND `plateforme`.`plateforme` = ?
                ");
                $query->execute([$plateforme]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        else if ($genre != "")
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`,`nom`, `description`, `prix`, `image` 
                    FROM `jeux`, `genre`, `filtre_jeux` 
                    WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `genre`.`genre` = ?
                ");
                $query->execute([$genre]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
    }
    #endregion

    /*------------------------- Insert -------------------------*/
    #region Insert
    /**
     * Ajoute des nouveaux jeux dans la base de données
     *
     * @param string $nomJeux
     * @param string $description
     * @param float $prix
     * @param int $idPegi
     * @param string $image
     * @param array $genres
     * @param array $plateformes
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function newGame($nomJeux, $description, $prix, $idPegi, $image, $genres, $plateformes)
    {
        $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `jeux`(`nom`, `description`, `prix`, `idPegi`, `image`) 
            VALUES (?, ?, ?, ?, ?);
        ");
        $query->execute([$nomJeux, $description, $prix, $idPegi, $image]);

        foreach($genres as $key)
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO `filtre_jeux`(`idJeux`, `idGenre`) 
                VALUES (LAST_INSERT_ID(), ?);
            ");
            $query->execute([$key]);
        }

        foreach($plateformes as $key)
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO `ou_jouer`(`idJeux`, `idPlateforme`) 
                VALUES (LAST_INSERT_ID(), ?);
            ");
            $query->execute([$key]);
        }
    }


     /**
     * Ajoute les plateformes a un jeu
     *
     * @param array $plateformes
     * @param int $idJeux
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function ajouterPlateformes($plateformes, $idJeux)
    {
        foreach($plateformes as $key)
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO `ou_jouer`(`idJeux`, `idPlateforme`) 
                VALUES (?, ?);
            ");
            $query->execute([$idJeux,$key]);
        }
    }

     /**
     * Ajoute les genres a un jeu
     *
     * @param array $genres
     * @param int $idJeux
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function ajouterGenres($genres, $idJeux)
    {
        foreach($genres as $key)
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO `filtre_jeux`(`idJeux`, `idGenre`) 
                VALUES (?, ?);
            ");
            $query->execute([$idJeux, $key]);
        }
    }

    #endregion

    /*------------------------- Delete -------------------------*/
    #region Delete
    /**
     * Efface un jeu
     * @param int $idJeux
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteGame($idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `ajouter_panier`
                WHERE `ajouter_panier`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `voir_historique`
                WHERE `voir_historique`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `ajouter_wishlist`
                WHERE `ajouter_wishlist`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `commentaires`
                WHERE `idJeux` = ?
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `notes`
                WHERE `idJeux` = ?
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `ou_jouer`
                WHERE `ou_jouer`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `filtre_jeux`
                WHERE `filtre_jeux`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `jeux`
                WHERE `jeux`.`idJeux` = ?; 
            ");
            $query->execute([$idJeux]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Efface les plateformes d'un jeu
     * @param int $idJeux
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deletePlateformes($idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `ou_jouer` WHERE `idJeux` = ?;
            ");
            $query->execute([$idJeux]);
        }catch (Exception $e)
        {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }   

    /**
     * Efface les plateformes d'un jeu
     * @param int $idJeux
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteGenres($idJeux)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `filtre_jeux` WHERE `idJeux` = ?;
            ");
            $query->execute([$idJeux]);
        }catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }   

    #endregion

    /*------------------------- Update -------------------------*/
    #region Update
    /**
     * Modifie un jeu choisi
     *
     * @param int $idJeux
     * @param string $nom
     * @param string $description
     * @param float $prix
     * @param int $idPegi
     * @param string $image
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function updateGame( $idJeux,  $nom,  $description,  $prix,  $idPegi,)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                UPDATE `jeux` 
                SET `nom`= ?,`description`= ?,`prix`= ?,`idPegi`= ? 
                WHERE `idJeux` = ?
            ");
            $query->execute([$nom, $description, $prix, $idPegi, $idJeux]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }


    #endregion
}