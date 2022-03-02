<?php
    require '../vendor/autoload.php';
    require '../router/web.php';

    use Pecee\SimpleRouter\SimpleRouter;

    SimpleRouter::setDefaultNamespace('\EasyGame\Controleur');
    SimpleRouter::start();