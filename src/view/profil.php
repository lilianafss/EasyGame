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
        <div class="card m-4">
            <img class="card-img" src="https://cdn.akamai.steamstatic.com/steam/apps/1509960/capsule_616x353.jpg?t=1627200665" />
            <div class="card-block">
                <h4 class="card-title">Pico Park</h4>
            </div>
        </div>
    </div>

    <script src="assets/js/profil.js"> </script>

    <?php require_once "footer.php"; ?>
</body>

</html>