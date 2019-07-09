<?php

function getAdGroupBidModifiers() {
    
}

function has_required_parameters($required_parameters, $data) {
    $hasError = false;
    $errors = array();
    for ($n = 0; $n < count($required_parameters); $n++) {
        if (!isset($data["params"][$required_parameters[$n]])) {
            $hasError = true;
            array_push($errors, $required_parameters[$n]);
        }
    }
    if ($hasError) {
        return "Missing Parameters: " . implode(", ", $errors);
    } else {
        return true;
    }
}

function buildDatabaseObject() {
    global $db_config;
    global $db;
    if ($db) {
        
    } else {
        return $db = new MysqliDb(
                $db_config
        );
    }
}

function resultsValid($_results) {

    $return = array(
        "status" => "success",
        "result" => $_results
    );

    $formattedResult = json_encode($return);

    return preg_replace("/[\\n\\r]+/", " ", $formattedResult);
}

function resultsInValid($_results) {

    $return = array(
        "status" => "error",
        "error" => $_results
    );

    $formattedResult = json_encode($return);

    return preg_replace("/[\\n\\r]+/", " ", $formattedResult);
}
