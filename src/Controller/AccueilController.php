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

    /**
     * @return void
     */
    public static function affichageConnexionDeconnexion()
    {
        $quantiteBadge = 0;
        if (isset($_SESSION['quantite'])) {
            $quantiteBadge = $_SESSION['quantite'];
        } else {
            $quantiteBadge = 0;
        }
        if (!($_SESSION['connected'])) {
            echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/connexion"><i class="fa-solid fa-2x fa-arrow-right-to-bracket icon"></i></a>
                        <p class="icon-texte">Connexion</p>
                    </li>
                    <li class="nav-item nav-li">
                        <a class="nav-link" href="/nouveau"><i class="fa-solid fa-2x fa-user-plus icon"></i></a>
                        <p class="icon-texte">S\'inscrire</p>
                    </li>
                ';
        } else {
            echo '
                    <li class="nav-item">
                        <a class="nav-link" href="/profil"><i class="fa-solid fa-2x fa-user icon"></i></a>
                        <p class="icon-texte">Profil</p>
                    </li>
                    
                    
                    <li class="nav-item nav-li">
                                 
                    <a class="nav-link" href="/panier">
                        <i class="fa-solid fa-2x fa-basket-shopping icon"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">' . $quantiteBadge . '</span>
                    </a>
                    <p id="panier" class="texte-icon">Panier</p>
                   
                </li>
                   
            
                    <li class="nav-item">
                        <a class="nav-link" href="/deconnexion"><i class="fa-solid fa-2x fa-arrow-right-from-bracket icon"></i></a>
                        <p class="icon-texte">Déconnexion</p>
                    </li>
                ';

            if ($_SESSION['admin']) {
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
