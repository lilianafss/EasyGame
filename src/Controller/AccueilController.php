<?php

    namespace EasyGame\Controller;
    use EasyGame\model\FonctionsBD;

    class AccueilController
    {
        public static function accueil()
        {
            // session_start();
            $recherche = filter_input(INPUT_GET,'recherche');
            $pegi = filter_input(INPUT_GET,'age');
            $plateforme = filter_input(INPUT_GET,'plateforme');
            $genre = filter_input(INPUT_GET,'genre');
        
            $listeJeux=FonctionsBD::getGames();
            $listeFiltre=FonctionsBD::getGameByFilters($pegi,$genre,$plateforme);

            $stringJeux = "";

            if($listeFiltre==false && $recherche==""){
                
                foreach($listeJeux as $jeux){
                    $stringJeux .= '<div class="card flex-row flex-wrap m-4">
                    <img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $jeux['image'] ).'"/>
                    <div class="card-block p-2">
                        <h4 class="card-title">'.$jeux['nom'].'</h4>
                        <p class="card-text">'.$jeux['description'].'</p>
                        <p class="card-text card_prix">'.$jeux['prix'].'</p>
                        <a href="#" class="btn btn-primary mx-auto d-block">Ajouter au panier</a>
                    </div>
                </div>';
                }
                return $stringJeux;
            }elseif($listeFiltre==false && $recherche!=""){
                $inputRecherche=FonctionsBD::searchGame($recherche);
                              
                
            }elseif($listeFiltre!="" && $recherche ==""){
                foreach($listeFiltre  as $filtre){
                    $stringJeux .= '<div class="card flex-row flex-wrap m-4">
                    <img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $filtre['image'] ).'"/>
                    <div class="card-block p-2">
                        <h4 class="card-title">'.$filtre['nom'].'</h4>
                        <p class="card-text">'.$filtre['description'].'</p>
                        <p class="card-text card_prix">'.$filtre['prix'].'</p>
                        <a href="#" class="btn btn-primary mx-auto d-block">Ajouter au panier</a>
                    </div>
                </div>';
                }
                // header("Location: http://easygame.ch");
       
            }
           
         require "../src/view/accueil.php";
        
        }
        public static function affichageFiltre($liste,$champBd){
         
           foreach($liste as $filtre){
                echo "<option value=".$filtre[$champBd].">".$filtre[$champBd]."</option>";
            } 
        }

        public static function affichage(){
         
            
        }
        
    }

?>