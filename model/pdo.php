<?php
/*
Auteur      : De Castilho E Sousa Rodrigo
Description : Requêtes SQL (PDO)
Date        : 02/2022
Version     : 1.0.0.0
*/

require_once "database.php";

//Recuperer la table jeux sur la base de données
function getGames(){
    try{
        $query = getConnexion()->prepare("
        SELECT `idJeux`, `nom`, `description`, `prix` FROM `jeux` 
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}