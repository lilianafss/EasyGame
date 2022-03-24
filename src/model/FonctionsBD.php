<?php
namespace EasyGame\model;

use EasyGame\model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

@ini_set('display_errors', 'on');

/*
Auteur      : De Castilho E Sousa Rodrigo, Liliana Santos
Description : Requêtes SQL (PDO)
Date        : 02/2022
Version     : 1.0.0.0
*/

class FonctionsBD
{
    /**********************Fonctions pour récupérer les données*************************/
    /**
     * Récupère la table jeux dans la base de données
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGames()
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT `idJeux`, `nom`, `description`, `prix`, `pegis`.`pegi`, `image` 
            FROM `jeux`, `pegis`
            WHERE `jeux`.`idPegi` = `pegis`.`idPegi`
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public static function getUsers(){
        try {
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT `idUser`, `pseudo`, `nom`, `prenom`, `email`, `admin` 
            FROM `user`
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Récupère un jeux par son id
     * @param int $idJeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGameById($idJeux){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT `idJeux`, `nom`, `description`, `prix`, `pegis`.`pegi`, `image` 
            FROM `jeux`, `pegis`
            WHERE `jeux`.`idPegi` = `pegis`.`idPegi`
            AND `idJeux` = ?
            ");
            $query->execute([$idJeux]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Récupère l'historique dans la base de données
     * @param int $idUser
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getHistory($idUser)
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
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

    /**
     * Récupère le(s) genre(s) d'un jeux
     * @param int $idJeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGameGenre($idJeux){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT DISTINCT `genre` 
            FROM `genre`, `filtre_jeux` 
            WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
            AND `filtre_jeux`.`idJeux` = ?
            ");
            $query->execute([$idJeux]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Récupère la(les) plateforme(s) d'un jeux
     * @param int $idJeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGamePlatform($idJeux){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT DISTINCT `plateforme` 
            FROM `plateforme`, `ou_jouer` 
            WHERE `plateforme`.`idPlateforme` = `ou_jouer`.`idPlateforme` 
            AND `ou_jouer`.`idJeux` = ?
            ");
            $query->execute([$idJeux]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Récupère la wishlist dans la base de données
     * @param int $idUser
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getWishlist($idUser)
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
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

    /**
     * Récupère tous les plateformes
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
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

    /**
     * Récupère tout les genres
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
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

    /**
     * Récupère tout les PEGI
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
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

    /**
     * Récupère les informations de l'utilisateur
     *
     * @param  int $idUser
     * @return mixed|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getInfoUser($idUser)
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT `pseudo`, `nom`, `prenom`, `email`, `password`, `admin` 
            FROM `user` WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    
    /**
     * Récupère les informations de l'utilisateur
     *
     * @param  int $idUser
     * @return mixed|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getIdUser($email){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT `idUser`
            FROM `user` WHERE `email` = ?
            ");
            $query->execute([$email]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Cherche un jeu avec son nom
     *
     * @param string $searchName
     * @return mixed|void
     * @author Liliana Filipa Santos Silva
     */
    public static function searchGame($searchName)
    {
        try {
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT idJeux, nom, description, prix, image 
            FROM jeux WHERE nom 
            LIKE '%$searchName%'
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Fonction pour chercher un jeux par pegi, genre ou plateforme
     *
     * @param string $pegi
     * @param string $genre
     * @param string $plateforme
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getGameByFilters($pegi, $genre, $plateforme)
    {

        if ($pegi != "" && $genre != "" && $plateforme != "") {
            try {
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
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($genre != "" && $plateforme != "") {
            try {
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
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($genre != "" && $pegi != "") {
            try {
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
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($plateforme != "" && $pegi != "") {
            try {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`.`idJeux`,`nom`, `description`, `prix`, `image` 
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
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`,`nom`, `description`, `prix`, `image`
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
            } catch (PDOException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        } else if ($genre != "") {
            try {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `jeux`.`idJeux`,`nom`, `description`, `prix`, `image` 
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

    /**
     * Avoir les commentaires de la base de données
     * @param int $idJeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getComments($idJeux){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT `commentaire`, `idUser` FROM `commentaires`
            WHERE `commentaires`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n"; 
        }
    }

    /**
     * Avoir les notes de la base de données
     * @param int $idJeux
     * @return array|false|void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function getNotes($idJeux){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            SELECT `note`, `idUser` FROM `notes` 
            WHERE `notes`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n"; 
        }
    }

/**********************Fonctions pour insérer des données*************************/
    
    /**
     * Ajoute des nouveaux utilisateurs dans la base de données
     *
     * @param string $pseudo
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $password
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function newUser($pseudo, $nom, $prenom, $email, $password)
    {
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `user`(`pseudo`, `nom`, `prenom`, `email`, `password`, `admin`) 
            VALUES ( ?, ?, ?, ?, ?, false);
            
            INSERT INTO `wishlist`(`idWishlist`,`idUser`) VALUES (LAST_INSERT_ID(),LAST_INSERT_ID());
            
            INSERT INTO `historique`(`idHistorique`,`idUser`) VALUES (LAST_INSERT_ID(),LAST_INSERT_ID())
            ");
            $query->execute([$pseudo, $nom, $prenom, $email, $password]);
        } catch(Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Ajoute des nouveaux jeux dans la base de données
     *
     * @param string $nomJeux
     * @param string $description
     * @param float $prix
     * @param int $idPegi
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function newGame($nomJeux, $description, $prix, $idPegi){
        try {
            $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `jeux`( `nom`, `description`, `prix`, `idPegi`) 
            VALUES (?, ?, ?, ?)
            ");
            $query->execute([$nomJeux, $description, $prix, $idPegi]);
        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Ajoute un commentaire a un jeux choisi
     *
     * @param string $commentaire
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addCommentToGame($commentaire, $idJeux, $idUser){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `commentaires`(`commentaire`, `idUser`, `idJeux`) 
            VALUES (?,?,?)
            ");
            $query->execute([$commentaire, $idUser, $idJeux]);

        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Ajoute une note a un jeux choisi
     *
     * @param int $note
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addNoteToGame($note, $idJeux, $idUser){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `notes`(`note`, `idUser`, `idJeux`) 
            VALUES (?,?,?)
            ");
            $query->execute([$note, $idJeux, $idJeux]);
        } catch (Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Ajoute un jeux a sa wishlist
     *
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addGameToWishlist($idUser, $idJeux){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `ajouter_wishlist`(`idWishlist`, `idJeux`) 
            VALUES (?,?)
            ");
            $query->execute([$idUser, $idJeux]);
        } catch(Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Ajoute un jeux a son historique d'achat
     *
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addGameToHistorique($idUser, $idJeux){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `voir_historique`(`idHistorique`, `idJeux`) 
            VALUES (?,?)
            ");
            $query->execute([$idUser, $idJeux]);
        } catch(Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

/**********************Fonctions pour effacer des données*************************/
     
    /**
     * Efface un commentaire
     *
     * @param int $idComment
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteComment($idComment){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `commentaires` WHERE `idComentaire` = ?
            ");
            $query->execute([$idComment]);
        }catch (Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Efface un jeu
     *
     * @param int $idJeux
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteGame($idJeux){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `voir_historique` WHERE `voir_historique`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);
            
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `ajouter_wishlist` WHERE `ajouter_wishlist`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);
            
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `ou_jouer` WHERE `ou_jouer`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `filtre_jeux` WHERE `filtre_jeux`.`idJeux` = ?;
            ");
            $query->execute([$idJeux]);

            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `jeux` WHERE `jeux`.`idJeux` = ?; 
            ");
            $query->execute([$idJeux]);
        }catch (Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Modifie un jeux choisi
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
    public static function updateGame($idJeux, $nom, $description, $prix, $idPegi, $image){
        try{

            $query = BaseDonnee::getConnexion()->prepare("
            UPDATE `jeux` 
            SET `nom`= ?,`description`= ?,`prix`= ?,`idPegi`= ?,`image`= ? 
            WHERE `idJeux` = ?
            ");

            $query->execute([$nom, $description, $prix, $idPegi, $image, $idJeux]);

        }catch (Exception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}