<?php
require_once 'config.php';

// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET) && !array_key_exists('idpack', $_GET) ) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $id_client = $_GET['id_client'];
    $name = $_GET['name'];
    $paypal = 'paypal';

    $response = $transaction->send();

    if ($response->isSuccessful()) {
        // The customer has successfully paid.
        $arr_body = $response->getData();

        $payment_id = $arr_body['id'];
        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
        $payer_email = $arr_body['payer']['payer_info']['email'];
        $amount = $arr_body['transactions'][0]['amount']['total'];
        $currency = PAYPAL_CURRENCY;
        $payment_status = $arr_body['state'];


        // Insert transaction data into the database
        $isPaymentExist = $db->query("SELECT * FROM paidpack WHERE payment_id = '".$payment_id."'");

        if(isset($_COOKIE['startrdv'])){
            $dat1 = strtotime(date('Y-m-d H:i:s',strtotime($_COOKIE['startrdv'].':00')));
            $dat2 = strtotime(date('Y-m-d H:i:s'));
            $dat = strtotime(date('Y-m-d H:i:s'));
            $i = 0;$insert = $db->query("INSERT INTO reservations(idconference,startrdv,endrdv,idc,paid) VALUES('" . $_COOKIE['idconference'] . "', '" . $dat . "', '" . $dat . "', '" . $id_client . "', '" . $i . "')");
        }
        if($isPaymentExist->num_rows == 0) {
            $insert = $db->query("INSERT INTO paidpack(id_user,payMethod,pname,payment_id, payer_id, payer_email, amount, currency, payment_status) VALUES('". $id_client ."','". $paypal ."','". $name ."','". $payment_id ."', '". $payer_id ."', '". $payer_email ."', '". $amount ."', '". $currency ."', '". $payment_status ."')");
        }

        echo "Payment is successful. Your transaction id is: ". $payment_id;
    } else {
        echo $response->getMessage();
    }
}
// Once the transaction has been approved, we need to complete it.
else if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET) && array_key_exists('idpack', $_GET) ) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $id_client = $_GET['id_client'];
    $name = $_GET['name'];
    $paypal = 'paypal';
    $idpack =  $_GET['idpack'];

    $response = $transaction->send();

    if ($response->isSuccessful()) {
        // The customer has successfully paid.
        $arr_body = $response->getData();

        $payment_id = $arr_body['id'];
        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
        $payer_email = $arr_body['payer']['payer_info']['email'];
        $amount = $arr_body['transactions'][0]['amount']['total'];
        $currency = PAYPAL_CURRENCY;
        $payment_status = $arr_body['state'];


        // Insert transaction data into the database
        $isPaymentExist = $db->query("SELECT * FROM paidpack WHERE payment_id = '".$payment_id."'");

        if($isPaymentExist->num_rows == 0) {
            //$insert = $db->query("INSERT INTO paidpack(id_user,payMethod,pname,payment_id, payer_id, payer_email, amount, currency, payment_status) VALUES('". $id_client ."','". $paypal ."','". $name ."','". $payment_id ."', '". $payer_id ."', '". $payer_email ."', '". $amount ."', '". $currency ."', '". $payment_status ."')");
            $insert = $db->query("UPDATE paidpack set id_user='". $id_client ."',paid_at=now(),payMethod='". $paypal ."',pname='". $name ."',payment_id='". $payment_id ."', payer_id='". $payer_id ."', payer_email='". $payer_email ."', amount='". $amount ."', currency='". $currency ."', payment_status='". $payment_status ."' where id=$idpack ");

        }

//        header('location: https://visio.fcpo.agency/user/abonnements');
        header('location: http://localhost/nodeprojects2/user/abonnements');
    } else {
        echo $response->getMessage();
    }
}

else {
    echo 'Transaction is declined';
}