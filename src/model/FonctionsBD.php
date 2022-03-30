<?php
namespace EasyGame\model;

use EasyGame\model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

/*
Auteur      : De Castilho E Sousa Rodrigo, Liliana Santos
Description : Requêtes SQL (PDO)
Date        : 02/2022
Version     : 1.0.0.0
*/

class FonctionsBD
{
    /*------------------------- Fonctions pour récupérer des données -------------------------*/
    #region récupérer des données

        /*--------------- user ---------------*/
        #region user
        /**
         * Récupère tout les utilisateurs
         * @return array|false|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getUsers()
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                        SELECT `idUser`, `pseudo`, `nom`, `prenom`, `email`, `admin`, `user_status` 
                        FROM `user`
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
         * Récupère les informations de l'utilisateur avec son id
         *
         * @param  int $idUser
         * @return mixed|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getInfoUser(int $idUser)
        {
            try
            {
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
         * Récupère l'id de l'utilisateur avec son email
         *
         * @param string $email
         * @return mixed|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getIdUser(string $email)
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                        SELECT `idUser`
                        FROM `user` WHERE `email` = ?
                    ");

                $query->execute([$email]);
                return $query->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        #endregion

        /*--------------- jeux ---------------*/
        #region jeux
            /**
             * Récupère la table jeux dans la base de données
             * @return array|false|void
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
             * @author Rodrigo De Castilho E Sousa
             */
            public static function getGameById(int $idJeux)
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

        /*--------------- genre ---------------*/
        #region genre
        /**
         * Récupère tout les genres
         * @return array|false|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getGenre()
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("SELECT `genre` FROM `easygame`.`genre`");

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
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getGameGenre(int $idJeux)
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT DISTINCT `genre` 
                    FROM `genre`, `filtre_jeux` 
                    WHERE `genre`.`idGenre` = `filtre_jeux`.`idGenre` 
                    AND `filtre_jeux`.`idJeux` = ?
                ");

                $query->execute([$idJeux]);
                return $query->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        #endregion

        /*--------------- plateforme ---------------*/
        #region plateforme
        /**
         * Récupère toutes les plateformes
         * @return array|false|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getPlatform()
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("SELECT `plateforme` FROM `easygame`.`plateforme`");

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
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getGamePlatform(int $idJeux)
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
                return $query->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        #endregion

        /*--------------- pegi ---------------*/
        #region pegi
        /**
         * Récupère tout les PEGI
         * @return array|false|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getPegi()
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("SELECT `pegi` FROM `easygame`.`pegis`");

                $query->execute();
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        #endregion

        /*--------------- commentaires ---------------*/
        #region commentaires
        /**
         * Récupérer les commentaires du jeu
         * @param int $idJeux
         * @return array|false|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getComments(int $idJeux)
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT `commentaire`, `idUser` FROM `commentaires`
                    WHERE `commentaires`.`idJeux` = ?;
                ");

                $query->execute([$idJeux]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e)
            {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }
        }
        #endregion

        /*--------------- note ---------------*/
        #region note
        /**
         * Avoir les notes de la base de données
         * @param int $idJeux
         * @return array|false|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getNotes(int $idJeux)
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                    SELECT `note`, `idUser` FROM `notes` 
                    WHERE `notes`.`idJeux` = ?;
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

        /*--------------- history ---------------*/
        #region history
        /**
         * Récupère l'historique dans la base de données
         * @param int $idUser
         * @return array|false|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getHistory(int $idUser)
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                        SELECT `jeux`.`idJeux`,`jeux`.`nom`, `jeux`.`description`, `jeux`.`prix` 
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

        /*--------------- wishlist ---------------*/
        #region wishlist
        /**
         * Récupère la wishlist dans la base de données
         * @param int $idUser
         * @return array|false|void
         * @author Rodrigo De Castilho E Sousa
         */
        public static function getWishlist(int $idUser)
        {
            try
            {
                $query = BaseDonnee::getConnexion()->prepare("
                        SELECT `jeux`.`idJeux`,`jeux`.`nom`, `jeux`.`description`, `jeux`.`prix` 
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

    #endregion

    /*------------------------- Fonctions pour insérer des données -------------------------*/
    #region Insérer des données
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
    public static function newUser(string $pseudo, string $nom, string $prenom, string $email, string $password)
    {
        $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `user`(`pseudo`, `nom`, `prenom`, `email`, `password`, `admin`, `user_status`) 
            VALUES ( ?, ?, ?, ?, ?, false, 'En Attente');
        ");
        $query->execute([$pseudo, $nom, $prenom, $email, $password]);

        $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `wishlist`(`idWishlist`, `idUser`)
            VALUES (LAST_INSERT_ID(), LAST_INSERT_ID());
        ");
        $query->execute();

        $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `historique`(`idHistorique`, `idUser`)
            VALUES (LAST_INSERT_ID(), LAST_INSERT_ID());
        ");
        $query->execute();
    }

    /**
     * Ajoute des nouveaux jeux dans la base de données
     *
     * @param string $nomJeux
     * @param string $description
     * @param float $prix
     * @param int $idPegi
     * @param string $image
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function newGame($idJeux, $nomJeux, $description, $prix, $idPegi, $image){
        try {
            $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `jeux`( `idJeux`, `nom`, `description`, `prix`, `idPegi`, `image`) 
            VALUES (?, ?, ?, ?, ?, ?)
            ");
            $query->execute([$idJeux, $nomJeux, $description, $prix, $idPegi, $image]);
        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Ajoute un commentaire à un jeu choisi
     *
     * @param string $commentaire
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addCommentToGame(string $commentaire, int $idJeux, int $idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                INSERT INTO `commentaires`(`commentaire`, `idUser`, `idJeux`) 
                VALUES (?,?,?)
            ");
            $query->execute([$commentaire, $idUser, $idJeux]);

        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Ajoute une note à un jeu choisi
     *
     * @param int $note
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addNoteToGame(int $note, int $idJeux, int $idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `notes`(`note`, `idUser`, `idJeux`) 
            VALUES (?,?,?)
            ");
            $query->execute([$note, $idUser, $idJeux]);
        }
        catch (Exception $e)
        {
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
    public static function addGameToWishlist(int $idUser, int $idJeux)
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

    /**
     * Ajoute un jeu à son historique d'achat
     *
     * @param int $idJeux
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function addGameToHistorique(int $idUser, int $idJeux)
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

    /**
     * Ajoute un jeu dans le panier de l'utilisateur
     *
     * @param int $idUser
     * @param int $idJeux
     * @return void
     *
     * Rodrigo De Castilho E Sousa
     */
    public static function addGameToPanier(int $idUser, int $idJeux)
    {
        try
        {
            $query= BaseDonnee::getConnexion()->prepare("
             INSERT INTO `ajouter_panier`(`idPanier`, `idJeux`)
              VALUES (?,?)
             ");
            $query->execute([$idUser, $idJeux]);
        } catch(Exeception $e){
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }


    }
#endregion

/********************** Fonctions pour effacer des données *************************/
#region Insérer des données

    /**
     * Efface un commentaire
     *
     * @param int $idComment
     * @return void
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteComment(int $idComment)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `commentaires` WHERE `idComentaire` = ?
            ");
            $query->execute([$idComment]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Efface un commentaire
     *
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteUser($idUser){
        try{
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `voir_historique` WHERE `idHistorique` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `ajouter_wishlist` WHERE `idWishlist` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `commentaires` WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `notes` WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `historique` WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `wishlist` WHERE `idUser` = ?
            ");
            $query->execute([$idUser]); 
            
            $query = BaseDonnee::getConnexion()->prepare("
            DELETE FROM `user` WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

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
    public static function deleteGame(int $idJeux)
    {
        try
        {
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
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
#endregion


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
    public static function updateGame(int $idJeux, string $nom, string $description, float $prix, int $idPegi, string $image)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                UPDATE `jeux` 
                SET `nom`= ?,`description`= ?,`prix`= ?,`idPegi`= ?,`image`= ? 
                WHERE `idJeux` = ?
            ");

            $query->execute([$nom, $description, $prix, $idPegi, $image, $idJeux]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}