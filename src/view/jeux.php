<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body> 
    <h1><?=$infoJeux['nom']?></h1>
    <?php echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $infoJeux['image'] ).'"/>'; ?>
    <h3>A propos du jeu</h3>
    <p>
    <?=$infoJeux['description']?>
    </p>

    <h3>Notes et Comentaires</h3>
    <p>Pseudo</p>
    <p>Note</p>
    <p>Commentaire</p>

    <?php require_once "footer.php"; ?>
</body>
</html>