<?php

namespace EasyGame\Controller;

use EasyGame\Model\BaseDonnee;
use EasyGame\Model\GameModel;
use EasyGame\Model\PegiModel;
use EasyGame\Model\PlatformModel;
use EasyGame\Model\GenreModel;
use EasyGame\Model\PanierModel;

require_once('../src/php/tools.php');



class AccueilController
{
    /** ---------Description de la Fonction----------------------
     * @return void
     * @author Liliana Santos Silva
     */
    public static function accueil()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        if ($_SESSION['connected'] && $_SESSION['idJeux'] != "") {
            PanierModel::addGameToPanier($_SESSION['idUser'], $_SESSION['idJeux']);
            $_SESSION['idJeux'] = "";
            header("Location: http://easygame.ch/panier");
        }

        $recherche = filter_input(INPUT_GET, 'recherche');
        $pegi = filter_input(INPUT_GET, 'age');
        $plateforme = filter_input(INPUT_GET, 'plateforme');
        $genre = filter_input(INPUT_GET, 'genre');

        $listeJeux = GameModel::getGames();
        $listeFiltre = GameModel::getGameByFilters($pegi, $genre, $plateforme);
        $stringJeux = "";
      
        if ($listeFiltre == "" && $recherche == "") {
            foreach ($listeJeux as $elementListe) {
                $stringJeux .= '<div class="card m-4" onclick="Redirection(' . $elementListe['idJeux'] . ')">
                    <img class="card-img" src="data:image/jpeg;base64,' . base64_encode($elementListe['image']) . '"/>
                    <div class="card-block">
                        <h4 class="card-title">' . $elementListe['nom'] . '</h4>
                        <p class="card-prix">' . $elementListe['prix'] . ' CHF</p>
                    </div>
                </div>';
            }
        } elseif ($listeFiltre == "" && $recherche != "") {

            $requete = GameModel::searchGame($recherche);
            if ($requete != null) {
                $stringJeux .= '<p> Vous avez recherché : ' . $recherche . '</p>';
                foreach ($requete as $elementListe) {
                    $stringJeux .= '<div class="card m-4" onclick="Redirection(' . $elementListe['idJeux'] . ')">
                        <img class="card-img" src="data:image/jpeg;base64,' . base64_encode($elementListe['image']) . '"/>
                        <div class="card-block">
                            <h4 class="card-title">' . $elementListe['nom'] . '</h4>
                            <p class="card-prix">' . $elementListe['prix'] . ' CHF</p>
                        </div>
                    </div>';
                }
            } else {
                $stringJeux .= '<p>Aucun resultat</p>';
            }
        } elseif ($listeFiltre && $recherche == "") {
            foreach ($listeFiltre  as $elementListe) {
                $stringJeux .= '
                    <div class="card m-4" onclick="Redirection(' . $elementListe['idJeux'] . ')" >
                        <img class="card-img" src="data:image/jpeg;base64,' . base64_encode($elementListe['image']) . '"/>
                        <div class="card-block">
                            <h4 class="card-title">' . $elementListe['nom'] . '</h4>
                            <p class="card-prix">' . $elementListe['prix'] . ' CHF</p>
                        </div>
                    </div>';
            }
        } elseif ($listeFiltre == null) {
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
    public static function affichageFiltre($nomliste, $liste, $champBd)
    {
        echo '<option disabled selected>' . $nomliste . '</option>';
        foreach ($liste as $elementListe) {
            echo "<option value=" . $elementListe[$champBd] . ">" . $elementListe[$champBd] . "</option>";
        }
    }
}
