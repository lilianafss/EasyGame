<?php

namespace EasyGame\Controller;

use EasyGame\model\FonctionsBD;

class PanierController
{
    public function panier()
    {
        session_start();
        $idJeux = filter_input(INPUT_GET, 'idJeux');
        $Poubelle=filter_input(INPUT_POST,'trash');
        $content = "";
        $info = "";
        $userUtilisateur = $_SESSION['idUser'];
        $infoJeux = FonctionsBD::getGameById($idJeux);
        $tableauxPanier = FonctionsBD::getPanier($userUtilisateur);
        $content .= '';
        if(filter_has_var(INPUT_GET,'trash')){
            echo "coucou";
        }
        foreach ($tableauxPanier as $panier) {
            $content .= ' 
           <tr>
									<td><div class="col-sm-4 hidden-xs"><img class="card-img"  src="data:image/jpeg;base64,' . base64_encode($panier['image']) . '"</div><td>
									<div class="col-sm-10">
										<h4 class="nomargin">'. $panier['nom'] . '</h4>
										
									</div>
								</div>
							</td>
							<td data-th="Price">'.$panier['prix'].'</td>
			
							<td class="actions" data-th="">
							
								<button name="trash" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
							</td>
			</tr>	';
        }
        $info .= '
        <div class="container p-0">
        <div class="card px-3">
            <p class="h8 py-3">Information du paiement</p>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Nom du proprietaire</p> <input class="form-control mb-3" type="text" placeholder="Name" ">
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">Numero de carte</p> <input class="form-control mb-3" type="text" placeholder="1234 5678 435 678">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">date de fin</p> <input class="form-control mb-3" type="text" placeholder="MM/YYYY">
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex flex-column">
                        <p class="text mb-1">CVV/CVC</p> <input class="form-control mb-3 pt-2 " type="password" placeholder="***">
                    </div>
                </div>
                <div class="col-12">
                    <div class="btn btn-primary mb-3"> <span class="ps-3">Payer</span> <span class="fas fa-arrow-right"></span> </div>
                </div>
            </div>
        </div>
    </div> 
        ';



        require_once "../src/view/panier.php";
    }
}
