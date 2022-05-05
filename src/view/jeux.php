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
    <title><?= $infoJeux['nom'] ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/logo.png">
    <link rel="stylesheet" href="assets/font-awesome/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/body.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <?php require_once "style.php" ?>

</head>

<body class="d-flex flex-column h-100">
    <?php require_once "header.php"; ?>

    <main class="flex-shrink-0">

        <div id="descriptionJeuxContainer">
            <!-- Description du jeux -->
            <h1><?= $infoJeux['nom'] ?></h1>
            <?php echo '<img class="card-img" src="data:image/jpeg;base64,' . base64_encode($infoJeux['image']) . '"/>'; ?>
            <h3>A propos du jeu</h3>
            <p><?= $infoJeux['description'] ?></p>
            
        
            <!-- Si l'utilisateur n'est pas connecte le formulaire d'avis ne vas pas s'afficher -->
            <?php
            if($idUser != null){
            ?>
            <form action="#" method="POST">
                <section>
                    <div class="container my-5 py-5 text-dark">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10 col-lg-8 col-xl-6">
                        <div class="card">
                            <div class="card-body p-4">
                            <div class="d-flex flex-start w-100">
                                <div class="w-100">
                                <h5>Add a comment</h5>
                                <?php
                                $noteUSer = NoteModel::getNoteByUserForOneGame($idJeux, $_SESSION['idUser']);
                                if(!$noteUSer['note']){
                                ?>
                                <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                    <input type="radio" id="star5" name="note" value="5" /><label for="star5" title="5 star"></label>
                                    <input type="radio" id="star4" name="note" value="4" /><label for="star4" title="4 star"></label>
                                    <input type="radio" id="star3" name="note" value="3" /><label for="star3" title="3 star"></label>
                                    <input type="radio" id="star2" name="note" value="2" /><label for="star2" title="2 star"></label>
                                    <input type="radio" id="star1" name="note" value="1" /><label for="star1" title="1 star"></label>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="form-outline">
                                    <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
                                    <label class="form-label" for="textAreaExample">What is your view?</label>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <input type="submit" value="Ajouter commentaire" name="envoyer">
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </section>
            </form>
            <?php 
            }
            if($tableauxCommentaire){   
            ?>
            <h3>Notes et Comentaires</h3>
            <p><?=$numeroCommentaires['nbCommentaires']?> commentaire(s)</p>
            <div class="row text-center">    
                <?php   
                    foreach ($tableauxCommentaire as $commentaire) {        
                    $user = UserModel::getInfoUser($commentaire['idUser']);
                    $userNote = NoteModel::getNoteByUserForOneGame($idJeux, $user['idUser']);
                ?>
                    <div class="col-md-5 mb-5 mb-md-0" id="commentaireContainer">
                        <h5 class="mb-3"><?=$user['pseudo']?></h5>
                        <p><?=$userNote['note']?><i class="fa-light fa-star"></i></p>
                        <h6 class="text-primary mb-3"><?=$commentaire['date']?></h6>
                        <p class="px-xl-3"><?=$commentaire['commentaire']?></p>
                        
                    </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div id="asideContainer">
            <p class="prix"><?= $infoJeux['prix']." CHF" ?></p>
            <?php

                $moyenne=NoteModel::averageByGame($idJeux);
                if($moyenne!=""){
                    echo "Moyenne : ". $moyenne['average']."/5";
                } 

            ?>
            <form method="POST">
                <input class="btn boutton" type="submit" name="panier" id="panier" value="Ajouter au panier"><br>
            </form>
            <!-- <button class="btn boutton" >Wishlist</button> <br> -->
            
        </div>
    </main>
    <?php require_once "footer.php"; ?>
</body>

</html>