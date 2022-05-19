<?php
    #region Lien CSS Utilisé dans toutes les pages
        echo '
            <link rel="icon" type="image/png" sizes="16x16" href="assets/image/logo.png">
            <link rel="stylesheet" href="assets/font-awesome/css/all.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="/assets/css/body.css">
            <link rel="stylesheet" href="/assets/css/footer.css">
            <link rel="stylesheet" href="/assets/css/message.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        ';
    #endregion


    #region Lien CSS Individuel

        // Si page d'accueil -> style page accueil, sinon afficher header des autres pages
        if($_SERVER['PHP_SELF'] == "/index.php")
        {
            echo'<link rel="stylesheet" href="assets/css/accueil.css">';
        }
        else
        {
            echo'<link rel="stylesheet" href="assets/css/header.css">';
        }
       
    #endregion