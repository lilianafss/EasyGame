<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <link rel="stylesheet" href="assets/font-awesome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css"> 
    <link rel="stylesheet" href="assets/css/jeux.css">
    
</head>
<body  class="h-100"> 

    <?=$content?>
    <form method="POST">
        <!-- <fieldset class="rating"> 
            <input name="rating" type="radio" id="rating5" value="5" on="change:rating.submit">
            <label for="rating5" title="5 stars">☆</label>

            <input name="rating" type="radio" id="rating4" value="4" on="change:rating.submit">
            <label for="rating4" title="4 stars">☆</label>

            <input name="rating" type="radio" id="rating3" value="3" on="change:rating.submit">
            <label for="rating3" title="3 stars">☆</label>

            <input name="rating" type="radio" id="rating2" value="2" on="change:rating.submit" checked="checked">
            <label for="rating2" title="2 stars">☆</label>

            <input name="rating" type="radio" id="rating1" value="1" on="change:rating.submit">
            <label for="rating1" title="1 stars">☆</label>
        </fieldset> -->
        <label for="note">Note :</label>
        <input type="number" min="1" max="5" name="note" id="note>

        <label for="commentaire" >Commentaire: </label>
        <textarea name="commentaire" id="commentaire" cols="50" rows="5" required></textarea>
        
        <input type="submit" value="Ajouter commentaire" name="envoyer">
        
    </form>


    <?php require_once "footer.php"; ?>
</body>
</html>