<?php
/*
Auteur      : De Castilho E Sousa Rodrigo
Description : Connexion à la base de données
Date        : 02/2022
Version     : 1.0.0.0
*/

require_once 'config.php';

//Connexion à la base de données
function getConnexion(){
    static $myDb = null;
    if($myDb === null){
        try{
            $myDb = new PDO(
                "mysql:host=". DB_HOST. ";dbname=". DB_NAME. ";charset=utf8",
                DB_USER, DB_PASSWORD
            );
            $myDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $myDb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch(PDOException $e){
            die("Erreur :" . $e->getMessage());
        }
    }

    return $myDb;

}


function VerifierMotDePasse($mdpUtilisateur, $mdpBase){
    
        $pdo = getConnexion();
        if(hash('sha1',$mdpUtilisateur) == $mdpBase){
    
        return true;
    } else 
    {
        return false;
    }

}
function VerifierEmail($email){
    $pdo=getConnexion();
    
        
      
        // on met la requete dans la variable $sql, et on va charcher le mot de passe si le nom insérée est correcte.
        $sql = "SELECT * FROM user WHERE email = '$email';";
        //execution de la requête et envoie de la réponse de la requête.
        $requeteSQL = $pdo->query($sql);
        // récuperation du résultat de la requête.
        $reponseSQL = $requeteSQL->fetch();
        return $reponseSQL;
      

    
}