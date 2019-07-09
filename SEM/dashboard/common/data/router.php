<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once $_SERVER["DOCUMENT_ROOT"] . "/SAP/src/autoloader.php";
include_once(__DIR__ . "\\helper.php");


$response = array();
$data = $_POST;


if (array_key_exists("method", $data)) {
    if (!is_null($data["method"])) {
        $_method = strtoupper($data["method"]);
        switch ($_method) {
            case strtoupper("createSection"):
                $response = createSection($data);
                if (!is_null($response)) {
                    $response = resultsValid("success");
                } else {
                    $response = resultsInValid("Error in query");
                }
                break;

            default:
                $response = resultsInValid("Method " . $_method . " not found");
        }
    } else {
        $response = resultsInValid("No method passed");
    }
} else {
    $response = resultsInValid("No method passed - key empty");
}

//**************************************************
header("Content-Type: application/json");
echo $response;
//**************************************************

