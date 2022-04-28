<?php
    use EasyGame\Model\UserModel;
    use EasyGame\Model\NoteModel;
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/jeux.css">
    <title><?= $infoJeux['nom'] ?></title>
    <?php require_once "style.php" ?>

</head>

<body class="h-100">
    <?php require_once "header.php"; ?>

    <main class="flex-shrink-0">

        <div class="description">
            <h1><?= $infoJeux['nom'] ?></h1>
            <?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($infoJeux['image']) . '"/>'; ?>
            <h3>A propos du jeu</h3>
            <p><?= $infoJeux['description'] ?></p>
        </div>
        <form method="POST">
            <input type="submit" name="panier" id="panier" value="Ajouter au panier"><br>
        </form>

        <h3>Notes et Comentaires</h3>
        

        <?php      
            foreach ($tableauxCommentaire as $commentaire) {
                $user = UserModel::getInfoUser($commentaire['idUser']);
                $userNote = NoteModel::getNoteByUserForOneGame($idJeux, $user['idUser']);
        ?>
                <ul>
                    <li>
                        <div class="right">
                            <h4> <?php echo ($user['pseudo']." ".$userNote['note']);?></h4>
                            <span class="publish py-3 d-inline-block w-100"><?=$commentaire['date']?></span>
                            <div class="review-description">
                                <?=$commentaire['commentaire']?>
                            </div>
                        </div>
                    </li>
                </ul>
        <?php }?>

        <form action="#" method="POST">
            <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                <?php
                if($userNote['note'] == ""){
                ?>
                    <h5 class="mb-4">Laissez votre avis</h5>
                    <label>Note</p>
                    <input type="number" min="1" max="5" name="note" id="note"><br>
                <?php
                }
                ?>
                <div class="form-group">
                    <label>Votre commentaire</label>
                    <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="AjouterCommentaire" name="envoyer">
                </div>
            </div>
        </form>
    </main>
    <?php require_once "footer.php"; ?>
</body>

</html>