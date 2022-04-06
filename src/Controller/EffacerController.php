<?php

    namespace EasyGame\Controller;
    use EasyGame\model\FonctionsBD;

    class EffacerController
    {
        public static function effacer(){
            session_start();

            if (!$_SESSION['admin']) {
                header("location: http://easygame.ch");
                exit();
            } else {

                $effacerjeux = filter_input(INPUT_GET,'idJeux');
                $effacerUser = filter_input(INPUT_GET,'idUser');

                if($effacerjeux != ""){
                    FonctionsBD::deleteGame($effacerjeux);
                    header("location: http://easygame.ch/admin");
                    exit();
                }
                elseif($effacerUser != ""){
                    FonctionsBD::deleteUser($effacerUser);
                    header("location: http://easygame.ch/admin");
                    exit();
                }
                else{
                    header("location: http://easygame.ch/admin");
                    exit();
                }

            }
            require '../src/view/effacer.php';
        }
        
    }