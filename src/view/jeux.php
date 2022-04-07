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
 
    <form method="POST"> 
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
        
    </form>


    <?php require_once "footer.php"; ?>
</body>
</html>