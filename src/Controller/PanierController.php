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

class PanierController
{
    public function panier()
    {
        session_start();
        //initialisation variable
        $total = 0;
        $userUtilisateur = $_SESSION['idUser'];
        $tableauxPanier = PanierModel::getPanier($userUtilisateur);
        $jeux = GameModel::getGames($userUtilisateur);

        //parcourir le panier
        foreach ($tableauxPanier as $panier) {
            //calcule du total, recuperation idJeux et nom du jeux
            $total += $panier['prix'];
            $_SESSION['total'] = $total;
            $idJeux = $panier['idJeux'];
            $_SESSION["test"] = $idJeux;
            $items = $panier['nom'];
            $_SESSION['item'] = $items;
           
        }
        //si le bouton est cliquer on supprime un jeux
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['trash']) {

                PanierModel::deleteGameToPanier($_SESSION["test"]);
            }
        }

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

        //config du prix,de la quantité et de la monnaie
        $item1 = new Item();
        $item1->setName($_SESSION['item'])
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($total);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        //ajout du montant
        $amount = new Amount();
        $amount->setTotal($total);
        $amount->setCurrency('USD');

        //ajout de la transaction
        $transaction = new Transaction();
        $transaction->setDescription("Payment for service")
            ->setItemList($itemList)
            ->setAmount($amount);

        //redirection avec des urls selon si le paiement a reussi ou echoué
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://easygame.ch/success.php")
            ->setCancelUrl("http://easygame.ch/error.php");

        //paiement
        $payement = new Payment();
        $payement->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
                ->setRedirectUrls($redirectUrls);
        try
        {
            $payement->create($apiContext);

            header('location'.$payement->getApprovalLink());
        }
        catch(PayPalConnectionException $ex){
            echo $ex->getData();
        }


        require_once "../src/view/panier.php";
    }
}
