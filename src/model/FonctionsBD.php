<?php

namespace EasyGame\model;

use EasyGame\model\database;
use PDO;
use PDOException;

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
    function getGames()
    {
        try {
            $query = getConnexion()->prepare("
            SELECT `idJeux`, `nom`, `description`, `prix` FROM `jeux` 
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
    function getGenrePlatform($filter)
    {
        try {
            $query = getConnexion()->prepare("
        SELECT `?` FROM `easygame`.`?`
        ");
            $query->execute([$filter, $filter]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }

        function getPegi()
        {
            try {
                $query = getConnexion()->prepare("
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
            SELECT `pseudo`, `nom`, `prenom`, `email` 
            FROM `user` WHERE `idUser` = ?
            ");
                $query->execute([$idUser]);
                return $query->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }

        function getSearch($searchName)
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
        function getGameByFilters($pegi, $genre, $plateforme)
        {

            if ($pegi != "" && $genre != "" && $plateforme != "") {
                try {
                    $query = getConnexion()->prepare("
                    SELECT `nom`, `description`, `prix` 
                    FROM `jeux`, `genres`, `plateforme`, `pegis`, `ou_jouer`, `filtre_jeux` 
                    WHERE `genres`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                    AND `ou_jouer`.`idJeux` = `jeux`.`idJeux`
                    AND `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `genres`.`genre` = ?
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
                    FROM `jeux`, `genres`, `plateforme`, `ou_jouer`, `filtre_jeux` 
                    WHERE `genres`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
                    AND `ou_jouer`.`idJeux` = `jeux`.`idJeux`
                    AND `genres`.`genre` = ?
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
                    FROM `jeux`, `genres`, `pegis`, `filtre_jeux` 
                    WHERE `genres`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `jeux`.`idPegi` = `pegis`.`idPegi`
                    AND `genres`.`genre` = ?
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
                    FROM `jeux`, `genres`, `filtre_jeux` 
                    WHERE `genres`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = `jeux`.`idJeux` 
                    AND `genres`.`genre` = ?
                ");
                    $query->execute([$genre]);
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo 'Exception reçue : ',  $e->getMessage(), "\n";
                }
            }
        }

        function VerifierMotDePasse($mdpUtilisateur, $mdpBase)
        {

            $pdo = getConnexion();
            if (hash('sha256', $mdpUtilisateur) == $mdpBase) {

                return true;
            } else {
                return false;
            }
        }
        function VerifierEmail($email)
        {
            $pdo = getConnexion();



            // on met la requete dans la variable $sql, et on va charcher le mot de passe si le nom insérée est correcte.
            $sql = "SELECT * FROM user WHERE email = '$email';";
            //execution de la requête et envoie de la réponse de la requête.
            $requeteSQL = $pdo->query($sql);
            // récuperation du résultat de la requête.
            $reponseSQL = $requeteSQL->fetch();
            return $reponseSQL;
        }
    }
}
