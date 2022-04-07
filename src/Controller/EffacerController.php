<?php

    namespace EasyGame\Controller;
    use EasyGame\model\FonctionsBD;

    class EffacerController
    {
        /**
        * fonction principale de la page effacer
        *
        * @return void
        * @author De Castilho E Sousa Rodrigo
        */
        public static function effacer(){
            session_start();
            
            //si on est pas connecté en tant administrateur on va être rederiger vers la page d'accueil
            if (!$_SESSION['admin']) {
                header("location: http://easygame.ch");
                exit();
            } else {
                //recuperer les données
                $effacerjeux = filter_input(INPUT_GET,'idJeux');
                $effacerUser = filter_input(INPUT_GET,'idUser');
                $disabledUser = filter_input(INPUT_GET,'disabled');
                $actifUser = filter_input(INPUT_GET,'actif');
                
                if($effacerjeux != ""){
                    FonctionsBD::deleteGame($effacerjeux); //effacer le jeu avec l'id
                    header("location: http://easygame.ch/admin");
                    exit();
                }
                elseif($effacerUser != ""){

                    FonctionsBD::deleteUser($effacerUser); //effacer le user avec l'id
                    header("location: http://easygame.ch/admin");
                    exit();
                }
                elseif($disabledUser != ""){
                    
                    FonctionsBD::updateUserStatos($disabledUser,"Disabled");
                    header("location: http://easygame.ch/admin");
                    exit();
                }
                //changer le status de l'utilisateur
                elseif($actifUser != ""){
                    FonctionsBD::updateUserStatos($actifUser,"Actif");
                    header("location: http://easygame.ch/admin");
                    exit();
                }else{
                    header("location: http://easygame.ch/admin");
                    exit();
                }
            }
            require '../src/view/effacer.php';
        }
        
    }