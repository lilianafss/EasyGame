<?php
    use PHPMailer\PHPMailer\src\PHPMailer;
    use PHPMailer\PHPMailer\src\SMTP;
    use PHPMailer\PHPMailer\src\Exception;
    use Pecee\SimpleRouter\SimpleRouter;
    use EasyGame\Controller\connexionController;
    use EasyGame\Controller\nouveauCompteController;

    SimpleRouter::form('/connexion',[connexionController::class,'connexion']);
    SimpleRouter::form('/nouveau',[nouveauCompteController::class,'nouveauCompte']);