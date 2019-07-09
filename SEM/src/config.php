<?php

date_default_timezone_set("America/New_York");
if (version_compare(phpversion(), "5.4.0", "<")) {
    if (session_id() == "") {
        session_start();
    }
} else {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

$public_html = "";
//$public_html = "/public_html";
$MAIN_PROPS = parse_ini_file("sem_api_php.ini", true);

defined("ROOT_PATH")
        or define("ROOT_PATH", realpath(dirname(__FILE__)) . $public_html);

defined("API_PATH")
        or define("API_PATH", ROOT_PATH . "\\");
defined("LOG_PATH")
        or define("LOG_PATH", ROOT_PATH . "\\logs");

$db_config = array(
    "host" => $MAIN_PROPS["MYSQL"]["host"],
    "username" => $MAIN_PROPS["MYSQL"]["username"],
    "password" => $MAIN_PROPS["MYSQL"]["password"],
    "db" => $MAIN_PROPS["MYSQL"]["db"],
    "port" => $MAIN_PROPS["MYSQL"]["port"],
    "charset" => $MAIN_PROPS["MYSQL"]["charset"]
);

defined("CUSTOMER_ID")
        or define("CUSTOMER_ID", $MAIN_PROPS["ACCOUNT"]["id"]);



