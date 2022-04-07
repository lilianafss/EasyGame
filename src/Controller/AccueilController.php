<?php

    namespace EasyGame\Controller;
    use EasyGame\model\FonctionsBD;

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
                  'btnUser' => false
                ];
            }
            
            $recherche = filter_input(INPUT_GET,'recherche');
            $pegi = filter_input(INPUT_GET,'age');
            $plateforme = filter_input(INPUT_GET,'plateforme');
            $genre = filter_input(INPUT_GET,'genre');
        
            $listeJeux=FonctionsBD::getGames();
            $listeFiltre=FonctionsBD::getGameByFilters($pegi,$genre,$plateforme);

            $stringJeux = "";

            if($listeFiltre==false && $recherche=="")
            {
                foreach($listeJeux as $elementListe)
                {
                    $stringJeux .= '<div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')">
                    <img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $elementListe['image'] ).'"/>
                    <div class="card-block">
                        <h4 class="card-title">'.$elementListe['nom'].'</h4>
                        <p class="card-prix">'.$elementListe['prix'].'</p>
                    </div>
                </div>';
                }
            }
            elseif($listeFiltre==false && $recherche!="")
            {
                if(isset($recherche))
                {
                    $stringJeux= '<p> Vous avez recherché : ' . $recherche . '</p>';
                    $requete=FonctionsBD::searchGame($recherche);
                    if($requete!="")
                    {
                        foreach($requete as $elementListe)
                        {
                            $stringJeux .= '<div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')">
                            <img class="card-img" src="data:image/jpeg;base64,'.base64_encode($elementListe['image'] ).'"/>
                            <div class="card-block">
                                <h4 class="card-title">'.$elementListe['nom'].'</h4>
                                <p class="card-prix">'.$elementListe['prix'].'</p>
                            </div>
                        </div>';
                        }
                    }
                }
            }
            elseif($listeFiltre==true && $recherche =="")
            {
                foreach($listeFiltre  as $elementListe)
                {
                    $stringJeux .= '
                    <div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')" >
                        <img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $elementListe['image'] ).'"/>
                        <div class="card-block">
                            <h4 class="card-title">'.$elementListe['nom'].'</h4>
                            <p class="card-prix">'.$elementListe['prix'].'</p>
                        </div>
                    </div>';
                }
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

        public static function affichageConnexionDeconnexion()
        {
            if (!($_SESSION['connected']))
            {
                echo'
                    <li class="nav-item nav-li">
                        <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-house icon"></i></a>
                        <p class="icon-texte">Accueil</p>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/connexion"><i class="fa-solid fa-2x fa-user icon"></i></a>
                        <p class="icon-texte">Connexion</p>
                    </li>
                ';
            }
            else
            {
                echo'
                    <li class="nav-item">
                        <a class="nav-link" href="/deconnexion"><i class="fa-solid fa-2x fa-door-open icon"></i></a>
                        <p class="icon-texte">Déconnexion</p>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fa-solid fa-2x fa-heart icon"></i></a>
                        <p class="icon-texte">Wishlist</p>
                    </li>
            
                    <li class="nav-item">
                        <a class="nav-link" href="/panier"><i class="fa-solid fa-2x fa-basket-shopping icon"></i></a>
                        <p class="icon-texte">Panier</p>
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