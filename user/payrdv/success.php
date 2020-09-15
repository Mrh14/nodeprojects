<?php
require_once 'config.php';

// Once the transaction has been approved, we need to complete it.
if (array_key_exists('idconference', $_GET) && array_key_exists('PayerID', $_GET) ) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $id_client = $_COOKIE['iduser'];
    $prix = $_GET['prix'];
    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];
    $typerdv = $_GET['typerdv'];$idconference = $_GET['idconference'];
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
        $isPaymentExist = $db->query("SELECT * FROM paidrdv WHERE payment_id = '".$payment_id."'");

        if($isPaymentExist->num_rows == 0) {
            $date = str_replace('/', '-', $date1);$date1 = date('Y-m-d H:i:s', strtotime($date));
            $date = str_replace('/', '-', $date2);$date2 = date('Y-m-d H:i:s', strtotime($date));
            $insert = $db->query("INSERT INTO reservations(idconference,startrdv,endrdv,typerdv,idc,paid) VALUES('". $idconference ."','". $date1 ."','". $date2 ."','". $typerdv ."','". $id_client ."',1)");
            $id = mysqli_insert_id($db);
            $insert = $db->query("INSERT INTO paidrdv(idres,iduser,payMethod,payment_id, payer_id, payer_email, amount, currency, payment_status) VALUES('". $id ."','". $id_client ."','". $paypal ."','". $payment_id ."', '". $payer_id ."', '". $payer_email ."', '". $amount ."', '". $currency ."', '". $payment_status ."')");

        }

//        header('location: https://visio.fcpo.agency/user/reservations');
        header('location: http://localhost/nodeprojects2/user/reservations');
    } else {
        echo $response->getMessage();
    }
}


else {
    echo 'Transaction is declined';
}