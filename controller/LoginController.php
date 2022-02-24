<?php
session_start();
$mdpBase=VerifierEmail($_SESSION['email']);
if(VerifierMotDePasse($mdp,$mdpBase[0])){
    header("location:index.php");
}
else{
    echo "Erreur login";
}


?>