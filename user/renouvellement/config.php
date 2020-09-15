<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;

//test mode
define('CLIENT_ID', 'AfPZrZn-fybpGx4oyjvQA81Q1KD07C1ETz13teT592CFTe9oLB6d3J7iC1w676c0JEOkrY9KJAoBFCgA');
define('CLIENT_SECRET', 'EAO_N7gNbVVeiX7oAjxiwqQfHAv2PxjgYbzRk4LnsYxO5H1gB27b-DucoH3M4TX6cRQxnMq6spPrn_6d');

//live mode
//define('CLIENT_ID', 'AT-e8hgxoFTWCTVrju50QaHE1XNPUuqRprp8w58Uz_22tLJHehQN7uv78D2NiaW9Z69hEmfI8sCcfiBT');
//define('CLIENT_SECRET', 'EHryLNmkau1-2U6S1xLb22jN2y9_8gih5AeGIsWz0Wp7jj-GqbEGOndEjaF70FplmiQ2plLhFbMKD99u');

//define('PAYPAL_RETURN_URL', 'https://visio.fcpo.agency/user/renouvellement/success.php');
//define('PAYPAL_CANCEL_URL', 'https://visio.fcpo.agency/user/renouvellement/cancel.php');
define('PAYPAL_RETURN_URL', 'http://localhost/nodeprojects2/user/renouvellement/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/nodeprojects2/user/renouvellement2/cancel.php');
define('PAYPAL_CURRENCY', 'USD'); // set your currency here

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'visio');
//$db = new mysqli('localhost', 'fcpopvyn_visio', 'FCPO@2020', 'fcpopvyn_visio');

if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live