<?php
require_once '../model/pdo.php';

$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
$realpassword = filter_input(INPUT_POST,'realpassword',FILTER_SANITIZE_STRING);
$hash = "";
$seePassword = "";

if($password != "" && $realpassword != ""){
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $seePassword = password_verify($realpassword, $hash);
}

if($hash != ""){
    var_dump($hash);
    var_dump($realpassword);
    if($seePassword){
        echo "<h1>Le mot de passe est valide!</h1>";
    }else{
        echo "<h1>Le mot de passe est invalide.</h1>";
    }
}

var_dump(getGames());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="test.php">
        <input type="text" name="password">
        <br>
        <label>---------------------------------</label>
        <br>
        <input type="text" name="realpassword">
        <br>
        <input type="submit" value="send">
    </form>
</body>
</html>