<?php
namespace EasyGame\Controller;
use EasyGame\model\FonctionsBD;
@ini_set('display_errors', 'on');

require "../model/FonctionsBD.php";

$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
$realpassword = filter_input(INPUT_POST,'realpassword',FILTER_SANITIZE_SPECIAL_CHARS);
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

//var_dump(getGames());
//var_dump(getHistory(1));
//var_dump(getWishlist(1));
//var_dump(getFilters());
//var_dump(getInfoUser(1));
//var_dump(getSearch('Grand'));


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

<hr>

<form action="" method="get">
    <input type="search" name="jeuxRecherche" id="jeuxRecherche">
    <input type="submit" value="valider" name="valider">
</form>
</body>
</html>