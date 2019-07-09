<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__ . "/config.php");
require_once(__DIR__ . "/functions.php");
/*
  function autoloader($class) {
  $path = API_PATH . $class . ".php";

  if (file_exists($path)) {
  include_once($path);
  } else {
  echo "<br>Bad directory: $path<br>";
  }
  }
 */
$path = __DIR__ . "/API/Market" . ".php";
if (file_exists($path)) {
    include_once($path);
} else {
    echo "<br>Bad directory: $path<br>";
}
$path = __DIR__ . "/Lib/MysqliDb.php";
if (file_exists($path)) {
    require_once($path);
} else {
    die($path . "<br>Not Found");
}
//

/*
  include($_SERVER["DOCUMENT_ROOT"] . '/SAP/vendor/autoload.php');
  require_once(API_PATH . "/Vendor/MysqliDb.php");
  $db = new MysqliDb(
  $db_config
  );
  require_once(API_PATH . "/functions.php"); */
//spl_autoload_register("autoloader");

$db = new MysqliDb(
        $db_config
);

