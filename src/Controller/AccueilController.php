<?php

    namespace EasyGame\Controller;

    use EasyGame\Model\BaseDonnee;
    use EasyGame\Model\GameModel;
    use EasyGame\Model\PegiModel;
    use EasyGame\Model\PlatformModel;
use EasyGame\Model\GenreModel;

    class AccueilController
    {
        /** ---------Description de la Fonction----------------------
         * @return void
         * @author Liliana Santos Silva
         */
        public static function accueil()
        {
            session_start();
            if (!isset($_SESSION['idUser'])) {
                $_SESSION = [
                    'idUser' => '',
                    'connected' => false,
                    'admin' => false,
                    'btnJeux' => false,
                    'btnUser' => false,
                    'nbGenre' =>'',
                    'nbPlatform'=>''
                ];
            }
            
            $recherche = filter_input(INPUT_GET,'recherche');
            $pegi = filter_input(INPUT_GET,'age');
            $plateforme = filter_input(INPUT_GET,'plateforme');
            $genre = filter_input(INPUT_GET,'genre');
        
            $listeJeux=GameModel::getGames();
            $listeFiltre=GameModel::getGameByFilters($pegi,$genre,$plateforme);

            $stringJeux = "";

            if($listeFiltre==false && $recherche=="")
            {
                foreach($listeJeux as $elementListe)
                {
                    $stringJeux .= '<div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')">
                    <img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $elementListe['image'] ).'"/>
                    <div class="card-block">
                        <h4 class="card-title">'.$elementListe['nom'].'</h4>
                        <p class="card-prix">'.$elementListe['prix'].' CHF</p>
                    </div>
                </div>';
                }
            }
            elseif($listeFiltre==false && $recherche!="")
            {
               
                $requete=GameModel::searchGame($recherche);
                if($requete!=null)
                {
                    $stringJeux .= '<p> Vous avez recherché : ' . $recherche . '</p>';
                    foreach($requete as $elementListe)
                    {
                        $stringJeux .= '<div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')">
                        <img class="card-img" src="data:image/jpeg;base64,'.base64_encode($elementListe['image'] ).'"/>
                        <div class="card-block">
                            <h4 class="card-title">'.$elementListe['nom'].'</h4>
                            <p class="card-prix">'.$elementListe['prix'].' CHF</p>
                        </div>
                    </div>';
                    }
                }else{
                    $stringJeux .= '<p>Aucun resultat</p>';
                }              
            }
            elseif($listeFiltre == true && $recherche =="")
            { 
                foreach($listeFiltre  as $elementListe)
                {
                    echo"okokok";
                    $stringJeux .= '
                    <div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')" >
                        <img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $elementListe['image'] ).'"/>
                        <div class="card-block">
                            <h4 class="card-title">'.$elementListe['nom'].'</h4>
                            <p class="card-prix">'.$elementListe['prix'].' CHF</p>
                        </div>
                    </div>'; 
                }    
                               
            } elseif($listeFiltre == null){
                $stringJeux .= '<p>Aucun resultat</p>';
            }            
            require "../src/view/accueil.php";
        }
        

        /**
        * @param $nomliste
        * @param $liste
        * @param $champBd
        * @return void
        */
        public static function affichageFiltre($nomliste,$liste,$champBd)
        {
            echo '<option disabled selected>'.$nomliste.'</option>';
            foreach($liste as $elementListe)
            {
                echo "<option value=".$elementListe[$champBd].">".$elementListe[$champBd]."</option>";
            } 
        }

        /**
         * @return void
         */
        public static function affichageConnexionDeconnexion()
        {
            if (!($_SESSION['connected']))
            {
                echo'
                    <li class="nav-item">
                        <a class="nav-link" href="/connexion"><i class="fa-solid fa-2x fa-arrow-right-to-bracket icon"></i></a>
                        <p class="icon-texte">Connexion</p>
                    </li>
                    <li class="nav-item nav-li">
                        <a class="nav-link" href="/nouveau"><i class="fa-solid fa-2x fa-user-plus icon"></i></a>
                        <p class="icon-texte">S\'inscrire</p>
                    </li>
                ';
            }
            else
            {
                echo'
                    <li class="nav-item">
                        <a class="nav-link" href="/profil"><i class="fa-solid fa-2x fa-user icon"></i></a>
                        <p class="icon-texte">Profil</p>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/panier"><i class="fa-solid fa-2x fa-basket-shopping icon"></i></a>
                        <p class="icon-texte">Panier</p>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/wishlist"><i class="fa-solid fa-2x fa-heart icon"></i></a>
                        <p class="icon-texte">Wishlist</p>
                    </li>
            
                    <li class="nav-item">
                        <a class="nav-link" href="/deconnexion"><i class="fa-solid fa-2x fa-arrow-right-from-bracket icon"></i></a>
                        <p class="icon-texte">Déconnexion</p>
                    </li>
                ';

                if($_SESSION['admin'])
                {
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="/admin"><i class="fa-solid fa-2x fa-screwdriver-wrench icon"></i></a>
                            <p class="icon-texte">Admin</p>
                        </li>
                    ';
                }
            }
        }
    }