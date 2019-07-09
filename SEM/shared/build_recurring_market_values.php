<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once $_SERVER["DOCUMENT_ROOT"] . "/SEM/src/autoloader.php";

//require_once $_SERVER["DOCUMENT_ROOT"] . "/Google/google-ads-php/vendor/autoload.php";

use API\Market as Market;

$Market = new Market;
echo $Market->RecurringBuild();
