<?php

use EasyGame\Model\WishlistModel;

$tableauxWishlist = WishlistModel::getWishlist($_SESSION['idUser']);

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once "style.php" ?>
</head>
<body class="d-flex flex-column h-100">
    <?php require_once "header.php"; ?>

   
	

    <?php require_once "footer.php"; ?>
</body>
</html>