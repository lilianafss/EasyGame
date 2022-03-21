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
            $recherche = filter_input(INPUT_GET,'recherche');
            $pegi = filter_input(INPUT_GET,'age');
            $plateforme = filter_input(INPUT_GET,'plateforme');
            $genre = filter_input(INPUT_GET,'genre');
        
            $listeJeux=FonctionsBD::getGames();
            $listeFiltre=FonctionsBD::getGameByFilters($pegi,$genre,$plateforme);

            $stringJeux = "";

            if($listeFiltre==false && $recherche==""){

                foreach($listeJeux as $elementListe){
                    $stringJeux .= '<div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')">
                    <img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $elementListe['image'] ).'"/>
                    <div class="card-block">
                        <h4 class="card-title">'.$elementListe['nom'].'</h4>
                        <section class="card-text">
                            <p>'.$elementListe['description'].'</p>
                        </section>
                        <p class="card_prix">'.$elementListe['prix'].'</p>
                        <a href="panier" class="btn card-btn">Ajouter au panier</a>
                    </div>
                </div>';
                }
            }elseif($listeFiltre==false && $recherche!=""){
                if(isset($recherche)){
                    $stringJeux= '<p> Vous avez recherché : ' . $recherche . '</p>';
                    $requete=FonctionsBD::searchGame($recherche);
                    if($requete!=""){
                        foreach($requete as $elementListe){
                            $stringJeux .= '<div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')">
                            <img class="card-img" src="data:image/jpeg;base64,'.base64_encode($elementListe['image'] ).'"/>
                            <div class="card-block">
                                <h4 class="card-title">'.$elementListe['nom'].'</h4>
                                <section class="card-text">
                                    <p>'.$elementListe['description'].'</p>
                                </section>
                                <p class="card_prix">'.$elementListe['prix'].'</p>
                                <a href="panier" class="btn card-btn">Ajouter au panier</a>
                            </div>
                        </div>';
                        }
                    }
                }
            }elseif($listeFiltre==true && $recherche ==""){

                foreach($listeFiltre  as $elementListe){
                    $stringJeux .= '<div class="card m-4" onclick="Redirection('.$elementListe['idJeux'].')" >
                    <img class="card-img" src="data:image/jpeg;base64,'.base64_encode( $elementListe['image'] ).'"/>
                    <div class="card-block">
                        <h4 class="card-title">'.$elementListe['nom'].'</h4>
                        <section class="card-text">
                            <p>'.$elementListe['description'].'</p>
                        </section>
                        <p class="card_prix">'.$elementListe['prix'].'</p>
                        <a href="panier" class="btn card-btn">Ajouter au panier</a>
                    </div>
                </div>';
                }
            }           
            require "../src/view/accueil.php";
        }

        public static function affichageFiltre($nomliste,$liste,$champBd)
        {
            echo '<option disabled selected>'.$nomliste.'</option>';
            foreach($liste as $elementListe)
            {
                echo "<option value=".$elementListe[$champBd].">".$elementListe[$champBd]."</option>";
            } 
        }
    }

?>