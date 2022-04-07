<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/font-awesome/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <!--<link rel="stylesheet" href="assets/css/panier.css">-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <?php require_once "style.php" ?>
</head>
<?php require_once "header.php"; ?>

<body class="h-100">
    <h1>panier</h1>


    <main>
        <div id="jeux-container">

            <table id="cart" class="table table-hover table-condensed">

                <tbody>
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <?= $content ?>
                            </div>
                    </tr>
                </tbody>

            </table>



        </div>
        <div id="paiement-container">
            <?= $info ?>
        </div>
    </main>
    <?php require_once "footer.php"; ?>

</body>

</html>