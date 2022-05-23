<?php
    require '../vendor/autoload.php';
    require '../router/web.php';
    require '../src/helpers.php';
    use Pecee\SimpleRouter\SimpleRouter;

    SimpleRouter::setDefaultNamespace('\EasyGame\Controleur');
    SimpleRouter::start();