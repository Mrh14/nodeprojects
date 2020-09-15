<?php
require_once 'config.php';

if (isset($_POST['amount'])) {

    try {

        $response = $gateway->purchase(array(
            'amount' => $_POST['amount'],
            'currency' => PAYPAL_CURRENCY ,
            'returnUrl' => PAYPAL_RETURN_URL. '?id_client='.$_POST['id_client'] .'&name='. $_POST['pack'],
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