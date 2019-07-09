<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



require_once $_SERVER["DOCUMENT_ROOT"] . "/SEM/src/autoloader.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Google/google-ads-php/vendor/autoload.php";

use API\Market as Market;

$markets = $db->get("market");
$Market = new Market;

if (isset($_GET["test"]) && intval($_GET["test"]) === 1) {
    $Market->executeTriggers();
} else if (isset($_GET["test"]) && intval($_GET["test"]) === 2) {
    $value = 1.05;
    echo $Market->modifyGoogleValue($value);
} else {
    $Market->RecurringBuild();
    $Market->executeTriggers();
    $results = $Market->error;
    echo $results;
}



