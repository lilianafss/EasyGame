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
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'info')" id="defaultOpen">informations personnelles</button>
        <button class="tablinks" onclick="openCity(event, 'motPasse')">mot de passe</button>
        <button class="tablinks" onclick="openCity(event, 'historiqueAchat')">Historique d'achat</button>
        <button class="tablinks" onclick="openCity(event, 'whislist')">Whislist</button>
    </div>

    <div id="info" class="tabcontent">
        <h3>Informations personnelles</h3>
        <h5>Pseudo : </h5>
        <p>sdad</p>

        <h5>Email : </h5>
        <p>sdad@dasd</p>

    </div>

    <div id="motPasse" class="tabcontent">
        <h3>Changer votre mot de passe</h3>
        <form action="">
            <label for="">Votre mot de passe actuel :</label>
            <input type="text" value="">

            <label for="">Nouveau mot de passe :</label>
            <input type="text" value="">

            <label for="">Confirmation du nouveau mot de passe : </label>
            <input type="text" value="">
        </form>
    </div>

    <div id="historiqueAchat" class="tabcontent">
        <h3>Historique d'achat</h3>
        <div class="card m-4">
            <img class="card-img" src="https://images-na.ssl-images-amazon.com/images/I/A1b0TAVpyEL.jpg" />
            <div class="card-block">
                <h4 class="card-title">God of war</h4>
            </div>
        </div>
    </div>

    <div id="whislist" class="tabcontent">
        <h3>Whislist</h3>
        <div class="cart-wrap">
		<div class="container">
	        <div class="row">
			    <div class="col-md-12">
			        <div class="main-heading mb-10">My wishlist</div>
			        <div class="table-wishlist">
				        <table cellpadding="0" cellspacing="0" border="0" width="100%">
				        	<thead>
					        	<tr>
					        		<th width="45%">Product Name</th>
					        		<th width="15%">prix</th>
		
					        		<th width="15%"></th>
					        		<th width="10%"></th>
					        	</tr>
					        </thead>
                            <?php foreach ($tableauxWishlist as $wishlist) { ?>
					        <tbody>
                            <form action="" method="POST">
					        	<tr>
					        		<td width="45%">
					        			<div class="display-flex align-center">
		                                    <div class="img-product">
                                            <?php 
                                            echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($wishlist['image']) . '"/>'; ?>
		                                    </div>
		                                    <div class="name-product">
                                            <?= $wishlist['nom'] ?>
		                                    </div>
	                                    </div>
	                                </td>
					        		<td width="15%" class="price"><?= number_format($wishlist['prix'], 2)  ?>CHF</td>
                                    			        		
					        		<td width="15%"><input type="submit" name="AjoutPanier" value="Ajouter aux panier"></td>
					        		<td width="10%" class="text-center"><a href="#" class="trash-icon"><i class="far fa-trash-alt"></i></a></td>
					        	</tr>  
                                <input type="hidden" name="idJeux" value="<?= $wishlist['idJeux'] ?>">
					        	</form>	
				        	</tbody>
                            <?php } ?>
				        </table>
				    </div>
			    </div>
			</div>
		</div>
	</div>
        </div>
    </div>

    <script src="assets/js/profil.js"> </script>

    <?php require_once "footer.php"; ?>
</body>

</html>