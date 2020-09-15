<?php
require_once 'config.php';
include('../../includes/config.php');

function getPackAmount($val){
    global $bdd;
    $req4=$bdd->prepare("select * from packs where idpack=? ");
    $req4->execute(array($val));
    while($ar = $req4->fetch()){return $ar['amount'];}
    return 1;
}


if (isset($_POST['chargeNew'])) {

    try {

        $req1 = $bdd->prepare('select * from paidpack where id = ?');
        $req1->execute(array($_POST['chargeNew']));
        while($ar = $req1->fetch()){
            $pack = $ar['pname'];
            $amount = getPackAmount($ar['pname']);
//            if($pack=='p1'){$amount='99';}if($pack=='p2'){$amount='189';}if($pack=='p3'){$amount='319';}
//            if($pack=='p4'){$amount='59';}if($pack=='p5'){$amount='70';}if($pack=='p6'){$amount='160';}

        }

        $response = $gateway->purchase(array(
            'amount' => $amount,
            'currency' => PAYPAL_CURRENCY ,
            'returnUrl' => PAYPAL_RETURN_URL. '?id_client='.$_POST['id_client'] .'&name='. $pack. '&idpack='.$_POST['chargeNew'],
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