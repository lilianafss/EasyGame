<?php

namespace EasyGame\Controller;

//require_once 'vendor/autoload.php';

//use pour les requete a la base de donnée
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

//use pour api paypal
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Exception\PayPalConnectionException;

require_once('../src/php/tools.php');

class PanierController
{
    public function panier()
    {
        // Crée la session si elle n'existe pas
        SessionStart();

        //initialisation variable
        $total = 0;
        $userUtilisateur = $_SESSION['idUser'];
        $tableauxPanier = PanierModel::getPanier($userUtilisateur);
        $jeux = GameModel::getGames($userUtilisateur);


        //parcourir le panier
        foreach ($tableauxPanier as $panier) {
            //calcule du total, recuperation idJeux et nom du jeu
            $total += $panier['prix'];
            $_SESSION['total'] = $total;
            $items = $panier['nom'];
            $_SESSION['item'] = $items;
        }

        //si le bouton est cliqué on supprime un jeu
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['trash']) {
                $idJeux = filter_input(INPUT_POST, 'idJeux', FILTER_VALIDATE_INT);
                foreach ($tableauxPanier as $panier) {
                    if($panier["idJeux"] == $idJeux){
                        $_SESSION["total"] = $_SESSION["total"] - $panier["prix"];
                        $_SESSION['totalPanier']=$_SESSION['total'];
                    }
                }
                PanierModel::deleteGameToPanier($idJeux);
                header("Refresh: 0");
                $_SESSION['quantite']--;
            }
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
           
      
            if ($_POST['payer']) {
                
                $apiContext = new ApiContext(
                    new OAuthTokenCredential(
                        'AbKsXTdNOD_GjL8Zwq6B-d38-X5QMIxDrB4MkDiTdR0rVxB3igW4IGXHx5hTBlZTyy74Ekodpev-gW2X', //client ID
                        'EAIXKpk8-2RIcrj5GMtm5-IIMAHCsrxK0yg131m6X0Wj1v5A2zPGizM8GiabluWub7f13DWJ-ZlWwmXO' //client Secret
                    )
                );
                
                //config de l'api
                $apiContext->setConfig(
                    array(
                        'log.LogEnabled' => true,
                        'log.FileName' => 'PayPal.log',
                        'log.LogLevel' => 'DEBUG',
                        'mode' => 'sandbox',
                    )
                );
                //moyent de paiement 
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');


                var_dump($payer);
                //config du prix,de la quantité et de la monnaie
                $item1 = new Item();
                $item1->setName($_SESSION['item'])
                    ->setCurrency('CHF')
                    ->setQuantity(1)
                    ->setPrice($_SESSION['total']);

                $itemList = new ItemList();
                $itemList->setItems(array($item1));

                //ajout du montant
                $amount = new Amount();
                $amount->setTotal($_SESSION['total']);
                $amount->setCurrency('CHF');

                //ajout de la transaction
                $transaction = new Transaction();
                $transaction->setDescription("Payment for service")
                    ->setItemList($itemList)
                    ->setAmount($amount);

                //redirection avec des urls selon si le paiement a reussi ou echoué
                $redirectUrls = new RedirectUrls();
                echo $redirectUrls;
                $redirectUrls->setReturnUrl("http://easygame.ch/")
                    ->setCancelUrl("http://easygame.ch/error.php");

                //paiement
                $payement = new Payment();
                $payement->setIntent('sale')
                    ->setPayer($payer)
                    ->setTransactions(array($transaction))
                    ->setRedirectUrls($redirectUrls);
                try {
                    $payement->create($apiContext);
                    
                    header('Location:' . $payement->getApprovalLink());
                   
                   
                } catch (PayPalConnectionException $ex) {
                    echo $ex->getData();
                }
                
               

            }
        }

        require_once "../src/view/panier.php";
    }
}
