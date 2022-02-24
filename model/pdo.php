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
function VerifierMotDePasse($mdpUtilisateur, $mdpBase){
    
    $pdo = getConnexion();
    if(hash('sha1',$mdpUtilisateur) == $mdpBase){

    return true;
    } 
    else 
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