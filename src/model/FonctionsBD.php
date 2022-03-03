<?php

namespace EasyGame\model;

use EasyGame\model\BaseDonnee;
use PDO;
use PDOException;
//require "database.php";
//require "database.php";

@ini_set('display_errors', 'on');

/*
Auteur      : De Castilho E Sousa Rodrigo, 
Description : Requêtes SQL (PDO)
Date        : 02/2022
Version     : 1.0.0.0
*/

class FonctionsBD
{
    //Recuperer la table jeux sur la base de données
    public static function getGames()
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT `idJeux`, `nom`, `description`, `prix`,`image` FROM `jeux` 
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
         
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
            
        }
    }
    //Recuperer l'historique sur la base de données
    function getHistory($idUser)
    {
        try {
            $query = getConnexion()->prepare("
            SELECT`jeux`.`idJeux`,`jeux`.`nom`, `jeux`.`description`, `jeux`.`prix` 
            FROM `jeux`, `voir_historique`, `user`, `historique` 
            WHERE `jeux`.`idJeux` = `voir_historique`.`idJeux`
            AND `user`.`idUser` = ?
            AND `historique`.idUser = ?
            AND `voir_historique`.`idHistorique` = `historique`.`idHistorique` 
            ");
            $query->execute([$idUser, $idUser]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    //Recuperer la wishlist sur la base de données
    function getWishlist($idUser)
    {
        try {
            $query = getConnexion()->prepare("
            SELECT`jeux`.`idJeux`,`jeux`.`nom`, `jeux`.`description`, `jeux`.`prix` 
            FROM `jeux`, `ajouter_wishlist`, `user`, `wishlist` 
            WHERE `jeux`.`idJeux` = `ajouter_wishlist`.`idJeux`
            AND `user`.`idUser` = ?
            AND `wishlist`.idUser = ?
            AND `ajouter_wishlist`.`idWishlist` = `wishlist`.`idWishlist` 
            ");
            $query->execute([$idUser, $idUser]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    //Recuperer les genres de jeux video de la base de données
     public static function getPlatform()
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
        SELECT `plateforme` FROM `easygame`.`plateforme`
        ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

       
    }
    public static function getGenre()
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
        SELECT `genre` FROM `easygame`.`genre`
        ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

       
    }
    public static function getPegi()
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
        SELECT `pegi` FROM `easygame`.`pegis`
        ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    //Recuperer les informations de l'utilisateur
    function getInfoUser($idUser)
    {
        try {
            $query = getConnexion()->prepare("
            SELECT `pseudo`, `nom`, `prenom`, `email`, `password` 
            FROM `user` WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    function searchGame($searchName)
    {
        try {
            $query = getConnexion()->prepare("
            SELECT idJeux, nom, description, prix 
            FROM jeux WHERE nom 
            LIKE '%$searchName%'
            ");
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    //Fonction pour chercher un jeux par pegi, genre ou plateforme
   public static function getGameByFilters($pegi, $genre, $plateforme)
    {

        if ($pegi != "" && $genre != "" && $plateforme != "") {
            try {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT `nom`, `description`, `prix` 
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
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($genre != "" && $plateforme != "") {
            try {
                $query = getConnexion()->prepare("
                    SELECT `nom`, `description`, `prix` 
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
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($genre != "" && $pegi != "") {
            try {
                $query = getConnexion()->prepare("
                    SELECT `nom`, `description`, `prix` 
                    FROM `jeux`, `genre`, `pegis`, `filtre_jeux` 
                    WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `genre`.`genre` = ?
                    AND `pegis`.`pegi` = ?
                ");
                $query->execute([$genre, $pegi]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($plateforme != "" && $pegi != "") {
            try {
                $query = getConnexion()->prepare("
                    SELECT `nom`, `description`, `prix` 
                    FROM `jeux`, `plateforme`, `pegis`, `ou_jouer`
                    WHERE `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                    AND `ou_jouer`.`idJeux` = `jeux`.`idJeux`
                    AND `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `plateforme`.`plateforme` = ?
                    AND `pegis`.`pegi` = ?
                ");
                $query->execute([$plateforme, $pegi]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($pegi != "") {
            try {
                $query = getConnexion()->prepare("
                    SELECT `nom`, `description`, `prix` 
                    FROM `jeux`, `pegis`
                    WHERE `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `pegis`.`pegi` = ?
                ");
                $query->execute([$pegi]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($plateforme != "") {
            try {
                $query = getConnexion()->prepare("
                    SELECT `nom`, `description`, `prix` 
                    FROM `jeux`, `plateforme`, `ou_jouer`
                    WHERE `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                    AND `ou_jouer`.`idJeux` = `jeux`.`idJeux`
                    AND `plateforme`.`plateforme` = ?
                ");
                $query->execute([$plateforme]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($genre != "") {
            try {
                $query = getConnexion()->prepare("
                    SELECT `nom`, `description`, `prix` 
                    FROM `jeux`, `genre`, `filtre_jeux` 
                    WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `genre`.`genre` = ?
                ");
                $query->execute([$genre]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
    }
    //Fonction pour ajouter des nouveaux utilisateur a la base de donnée
    function newUser($pseudo, $nom, $prenom, $email, $password, $admin){
        try {
            $query = getConnexion()->prepare("
            INSERT INTO `user`(`pseudo`, `nom`, `prenom`, `email`, `password`, `admin`) 
            VALUES ( ?, ?, ?, ?, ?, ?)
            ");
            $query->execute([$pseudo, $nom, $prenom, $email, $password, $admin]);
            
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    //Fonction pour ajouter des nouveaux jeux a la base de donnée
    function newGame($nomJeux, $description, $preix, $idPegi){
        try {
            $query = getConnexion()->prepare("
            INSERT INTO `jeux`( `nom`, `description`, `prix`, `idPegi`) 
            VALUES (?, ?, ?, ?)
            ");
            $query->execute([$nomJeux, $description, $preix, $idPegi]);
            
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

}
