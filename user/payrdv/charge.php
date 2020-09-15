<?php
require_once 'config.php';
include('../../includes/config.php');

if (isset($_POST['idconference'])) {


    try {



        $date1 = $_POST['dateStart'];
        $date2 = $_POST['dateEnd'];
        $typerdv = $_POST['typerdv'];
        $idpack = $_POST['idpacks'];

        //pour trouver le prix base sur le pack
        $req4=$bdd->prepare("select * from packs where idpack=? ");
        $req4->execute(array($idpack));
        while($ar = $req4->fetch()){
            if($typerdv == 'visio'){ $amount= $ar['prvisio'];}else if($typerdv == 'public'){$amount= $ar['prpublic'];}else if($typerdv == 'domicile'){$amount= $ar['prdomicile'];}
        }


        $response = $gateway->purchase(array(
            'amount' => $amount,
            'currency' => PAYPAL_CURRENCY ,
            'returnUrl' => PAYPAL_RETURN_URL. '?prix='.$amount .'&date1='. $date1.'&date2='. $date2. '&typerdv='.$typerdv.'&idconference='.$_POST['idconference'],
            'cancelUrl' => PAYPAL_CANCEL_URL,
        ))->send();


        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}