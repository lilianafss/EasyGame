<?php
$content = "";
$formulaire = "";
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/jeux.css">
    <title>Document</title>
    <?php require_once "style.php" ?>
    
</head>
<body  class="h-100"> 
    <?php require_once "header.php"; ?>
 
    <main>
        <form method="POST"> 
            <div class="description">
                <h1><?=$infoJeux['nom']?></h1>
                <?php echo '<img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $infoJeux['image'] ).'"/>'; ?>
                <h3>A propos du jeu</h3>
                <p><?=$infoJeux['description']?></p>
            </div>

            <input type="submit" name="panier" id="panier" value="Ajouter au panier"><br>
        
            <h3>Notes et Comentaires</h3>
            <div class="review-list">
                <ul>
                    <li>
                        <div class="right">
                            <h4><?=$stringUser?>
                                <span class="gig-rating text-body-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" width="15" height="15">
                                        <path
                                            fill="currentColor"
                                            d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"
                                        ></path>
                                    </svg>
                                    <?=$stringNote ?>
                                </span>
                            </h4>
                            <span class="publish py-3 d-inline-block w-100"><?=$stringDate?></span>
                            <div class="review-description">
                                <p>
                                <?=$stringCommentaire?>
                                </p><br>
                            </div>
                            
                        </div>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                <h5 class="mb-4">Laisse votre avis</h5>
                <label>Note</p>
                <input type="number" min="1" max="5" name="note" id="note"><br>
                <div class="form-group">
                    <label>Votre commentaire</label>
                    <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Ajouter commentaire" name="envoyer">
                </div>

            </div>
        </form>
    </main>
    

        <?=$content?>
        <!-- <fieldset class="rating"> 
            <input name="rating" type="radio" id="rating5" value="5" on="change:rating.submit">
            <label for="rating5" title="5 stars">☆</label>

            <input name="rating" type="radio" id="rating4" value="4" on="change:rating.submit">
            <label for="rating4" title="4 stars">☆</label>

            <input name="rating" type="radio" id="rating3" value="3" on="change:rating.submit" checked="checked">
            <label for="rating3" title="3 stars">☆</label>

            <input name="rating" type="radio" id="rating2" value="2" on="change:rating.submit">
            <label for="rating2" title="2 stars">☆</label>

            <input name="rating" type="radio" id="rating1" value="1" on="change:rating.submit">
            <label for="rating1" title="1 stars">☆</label>
        </fieldset> 
        -->
 


    <?php require_once "footer.php"; ?>
</body>
</html>