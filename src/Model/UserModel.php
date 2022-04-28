<?php

namespace EasyGame\Model;

use EasyGame\Model\BaseDonnee;
use Exception;
use PDO;
use PDOException;

class UserModel
{
    /*------------------------- Select -------------------------*/
    #region Select
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
    public static function getInfoUser($idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                SELECT `idUser`, `pseudo`, `nom`, `prenom`, `email`, `password`, `admin`, `user_status`
                FROM `user`
                WHERE `user`.`idUser` = ?
            ");
            $query->execute([$idUser]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e)
        {
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
    public static function getIdUser( $email)
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

    /*------------------------- Insert -------------------------*/
    #region Insert
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
    public static function newUser( $pseudo,  $nom,  $prenom,  $email,  $password)
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

        $query = BaseDonnee::getConnexion()->prepare("
            INSERT INTO `panier`(`idPanier`, `idUser`)
            VALUES (LAST_INSERT_ID(), LAST_INSERT_ID());
        ");
        $query->execute();
    }
    #endregion

    /*------------------------- Delete -------------------------*/
    #region Delete
    /**
     * Efface un utilisateur avec son id
     *
     * @param int $idUser
     * @return void
     *
     * @author Rodrigo De Castilho E Sousa
     */
    public static function deleteUser($idUser)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `ajouter_panier`
                WHERE `ajouter_panier`.`idPanier` = ?;
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `panier`
                WHERE `panier`.`idUser` = ?;
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `voir_historique`
                WHERE `idHistorique` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `ajouter_wishlist`
                WHERE `idWishlist` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `commentaires`
                WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `notes`
                WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `historique`
                WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `wishlist`
                WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

            $query = BaseDonnee::getConnexion()->prepare("
                DELETE FROM `user`
                WHERE `idUser` = ?
            ");
            $query->execute([$idUser]);

        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
    #endregion

    /*------------------------- Update -------------------------*/
    #region Update
    /**
     * @param int $idUser Identifiant de l'utilisateur
     * @param string $userName Pseudo
     * @param string $nom Nom de l'utilisateur
     * @param string $prenom Prénom de l'utilisateur
     * @param string $userStatus Status du compte
     * @return void
     *
     * @author Flavio Soares Rodrigues
     */
    public static function updateUser($idUser, $userName, $nom, $prenom, $userStatus)
    {
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                UPDATE `user`
                SET `pseudo`= ?,`nom`= ?,`prenom`= ?, `user_status`= ?
                WHERE `idUser` = ?
            ");
            $query->execute([$userName, $nom, $prenom, $userStatus, $idUser]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public static function updateUserStatus($idUser,$userStatus){
        try
        {
            $query = BaseDonnee::getConnexion()->prepare("
                UPDATE `user`
                SET `user_status`= ?
                WHERE `idUser` = ?
            ");
            $query->execute([$userStatus,$idUser]);
        }
        catch (Exception $e)
        {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    // (à faire) function updateUserPassword
    #endregion
}