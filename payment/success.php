<?php
require_once 'config.php';

// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
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

        if($isPaymentExist->num_rows == 0) {
            $insert = $db->query("INSERT INTO paidpack(id_user,payMethod,pname,payment_id, payer_id, payer_email, amount, currency, payment_status) VALUES('". $id_client ."','". $paypal ."','". $name ."','". $payment_id ."', '". $payer_id ."', '". $payer_email ."', '". $amount ."', '". $currency ."', '". $payment_status ."')");
        }

        header('location: https://visio.fcpo.agency/user/abonnements');
//        header('location: http://localhost/nodeprojects2/user/abonnements');
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declinedd';
}