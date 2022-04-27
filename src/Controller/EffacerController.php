<?php

    namespace EasyGame\Controller;

    use EasyGame\model\BaseDonnee;
    use EasyGame\model\GameModel;
    use EasyGame\model\GenreModel;
    use EasyGame\model\HistoriqueModel;
    use EasyGame\model\NoteModel;
    use EasyGame\model\PanierModel;
    use EasyGame\model\PegiModel;
    use EasyGame\model\PlatformModel;
    use EasyGame\model\UserModel;
    use EasyGame\model\WishlistModel;

    class EffacerController
    {
        /**
        * Fonction principale de la page effacer
        *
        * @return void
        * @author De Castilho E Sousa Rodrigo
        */
        public static function effacer(){
            session_start();
            
            //si on n'est pas connecté en tant administrateur on va être rederiger vers la page d'accueil
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
                    GameModel::deleteGame($effacerjeux); //effacer le jeu avec l'id
                    header("location: http://easygame.ch/admin");
                    exit();
                }
                elseif($effacerUser != ""){

                    UserModel::deleteUser($effacerUser); //effacer le user avec l'id
                    header("location: http://easygame.ch/admin");
                    exit();
                }
                elseif($disabledUser != ""){

                    UserModel::updateUserStatus($disabledUser,"Disabled");
                    header("location: http://easygame.ch/admin");
                    exit();
                }
                //changer le status de l'utilisateur
                elseif($actifUser != ""){
                    UserModel::updateUserStatus($actifUser,"Actif");
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