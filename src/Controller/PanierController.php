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

class PanierController
{
    public function panier()
    {
        session_start();
        $idJeux = filter_input(INPUT_POST, 'idJeux');
        //$idJeux=$_SESSION['idJeux'];
        $content = "";
        $info = "";
        $userUtilisateur = $_SESSION['idUser'];
        $infoJeux = GameModel::getGameById($idJeux);
        $tableauxPanier = PanierModel::getPanier($userUtilisateur);
        $content .= '';
        $total = 0;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['trash']) {
                echo "s";
                PanierModel::deleteGameToPanier($idJeux);
            }
        }
        // $prix_total   = 0;
        // $total_panier = count($_SESSION['panier']['idProduit']);
        // for ($i = 0; $i < $total_panier; $i++) {
        //     $prix    = 0;
        //     $retour  = "c'est la requete";
        //     while ($donnees = mysql_fetch_array($retour)) //on affiche la liste des produits
        //     {
        //         $prix_unitaire = $donnees['prix_unitaire'];
        //         $prix += $_SESSION['panier']['qteProduit'][$i] * $prix_unitaire;

        //         echo $prix_unitaire;
        //         echo $prix;
        //     }
        //     $prix_total += $prix;
        // }
        // echo "Total : $prix_total";
        foreach ($tableauxPanier as $panier) {
            $total = $panier['prix'];
            var_dump($total);
            $content .= ' 
           <tr>
					<td><div class="col-sm-5 hidden-xs"><img class="card-img"  src="data:image/jpeg;base64,' . base64_encode($panier['image']) . '"</div><td>
									<div class="col-sm-10">
										<h4 class="nomargin">' . $panier['nom'] . '</h4>
										
									</div>
								</div>
							</td>
							<td data-th="Price">' . $panier['prix'] . '</td>
			
							<td class="actions" data-th="">
							<form method="POST">
                            
								<input type ="submit" name="trash" value="Supprimer" ><span><i class="fa fa-trash-o"></i></span>
                                </form>							
							</td>
			</tr>	';
        }
        require_once "../src/view/panier.php";
    }
}
