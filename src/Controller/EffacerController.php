<?php

    namespace EasyGame\Controller;

    use EasyGame\Model\BaseDonnee;
    use EasyGame\Model\GameModel;
    use EasyGame\Model\GenreModel;
    use EasyGame\Model\HistoriqueModel;
    use EasyGame\Model\NoteModel;
    use EasyGame\Model\PanierModel;
    use EasyGame\Model\PegiModel;
    use EasyGame\Model\PlatformModel;
    use EasyGame\Model\UserModel;
    use EasyGame\Model\WishlistModel;

    require_once('../src/php/config.php');
    require_once('../src/php/tools.php');

    class EffacerController
    {
        /**
        * Fonction principale de la page effacer
        *
        * @return void
        * @author De Castilho E Sousa Rodrigo
        */
        public static function effacer(){

            // Crée la session si elle n'existe pas
            SessionStart();
            
            //si on n'est pas connecté en tant administrateur on va être rederiger vers la page d'accueil
            if (!$_SESSION['admin']) {
                header("location:".URL_PRINCIPAL);
                exit();
            } else {
                //recuperer les données
                $effacerjeux = filter_input(INPUT_GET,'idJeux');
                $effacerUser = filter_input(INPUT_GET,'idUser');
                $disabledUser = filter_input(INPUT_GET,'disabled');
                $actifUser = filter_input(INPUT_GET,'actif');
                
                if($effacerjeux != ""){
                    GameModel::deleteGame($effacerjeux); //effacer le jeu avec l'id
                    header("location:".URL_PRINCIPAL.url("admin"));
                    exit();
                }
                elseif($effacerUser != ""){

                    UserModel::deleteUser($effacerUser); //effacer le user avec l'id
                    header("location:".URL_PRINCIPAL.url("admin"));
                    exit();
                }
                elseif($disabledUser != ""){

                    UserModel::updateUserStatus($disabledUser,"Disabled");
                    header("location:".URL_PRINCIPAL.url("admin"));
                    exit();
                }
                //changer le status de l'utilisateur
                elseif($actifUser != ""){
                    UserModel::updateUserStatus($actifUser,"Actif");
                    header("location:".URL_PRINCIPAL.url("admin"));
                    exit();
                }else{
                    header("location:".URL_PRINCIPAL.url("admin"));
                    exit();
                }
            }
            require '../src/view/effacer.php';
        }
        
    }