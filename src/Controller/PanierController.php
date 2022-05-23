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
        $tableauxPanier = PanierModel::getPanier($userUtilisateur);
        $quantite = 0;

        $btnSupprimer = filter_input(INPUT_POST, 'trash', FILTER_SANITIZE_SPECIAL_CHARS);
//        $btnPayer = filter_input(INPUT_POST, 'payer', FILTER_SANITIZE_SPECIAL_CHARS);

        $idJeux = filter_input(INPUT_POST, 'idJeux', FILTER_VALIDATE_INT);
        if (!$_SESSION['connected']) {
            header("location: http://easygame.ch");
            exit();
        } else {
            //parcourir le panier
            foreach ($tableauxPanier as $panier) {
                //calcule du total, recuperation idJeux et nom du jeu
                $total += $panier['prix'];
                $_SESSION['total'] = $total;
                $items = $panier['nom'];
                $_SESSION['item'] = $items;
                $quantite += 1;
            }
            $_SESSION['quantite'] = $quantite;
            //si le bouton est cliqué on supprime un jeu
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($btnSupprimer == "Supprimer") {

                    //quand le jeu est supprimé on réduit le total
                    foreach ($tableauxPanier as $panier) {
                        if ($panier["idJeux"] == $idJeux) {
                            $_SESSION["total"] = $_SESSION["total"] - $panier["prix"];
                            $_SESSION['totalPanier'] = $_SESSION['total'];
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
                            'AXHuFZprDDdz67bEgvtu4ds0_nhdUlhmKS5KQVGuPD8XwcQINPZrPk3FnzcsQGB3ZR8A9Nk0Ns4c4cdw', //client ID
                            'EJQyWN_nESO64cePV3jf4VpDff_a_Y6WnthoAfQsq6mRZ-Oa-1HBACRsx6FqxykdNiG_SOocvbX29IPC' //client Secret

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

                    //creation de la liste de tout les jeux dans le panier
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
                $redirectUrls->setReturnUrl(URL_PRINCIPAL.url("success"))
                    ->setCancelUrl(URL_PRINCIPAL.url("error"));

                    //paiement
                    $payement = new Payment();
                    $payement->setIntent('sale')
                        ->setPayer($payer)
                        ->setTransactions(array($transaction))
                        ->setRedirectUrls($redirectUrls);
                    try {
                        $payement->create($apiContext);

                        //si le paiement est crée on redirige sur la page de paiement paypal
                        header('Location:' . $payement->getApprovalLink() . "&locale.x=fr_FR&langTgl=fr");
                    } catch (PayPalConnectionException $ex) {
                        echo $ex->getData();
                    }
                }
            }
        }

        require_once "../src/view/panier.php";
    }
}
