<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/SEM/src/autoloader.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/Google/google-ads-php/vendor/autoload.php";
$path = __DIR__ . "/helper.php";
include_once($path);

$response = array();
$data = $_REQUEST;


if (array_key_exists("method", $data)) {
    if (!is_null($data["method"])) {
        $_method = strtoupper($data["method"]);
        switch ($_method) {
            case strtoupper("updateScenarioActionValues"):
                $required_parameters = array(
                    "id",
                    "action_direction",
                    "action_amount"
                );
                $hasParams = has_required_parameters($required_parameters, $data);
                if ($hasParams !== true) {
                    $response = resultsInValid($hasParams);
                } else {
                    $results = updateScenarioActionValues($data["params"]);
                    //if ($results["status"] === "success") {
                    $response = resultsValid($results);
                    //} else {
                    //   $response = resultsInValid($results["results"]);
                    //}
                }
                break;
            case strtoupper("updateScenarioAdGroups"):
                $required_parameters = array(
                    "id",
                    "ad_group_list"
                );
                $hasParams = has_required_parameters($required_parameters, $data);
                if ($hasParams !== true) {
                    $response = resultsInValid($hasParams);
                } else {
                    $results = updateScenarioAdGroups($data["params"]);
                    //if ($results["status"] === "success") {
                    $response = resultsValid($results);
                    //} else {
                    //   $response = resultsInValid($results["results"]);
                    //}
                }
                break;
            case strtoupper("getAdGroups"):
                $required_parameters = array(
                    "accountId",
                    "scenarioId"
                );
                $hasParams = has_required_parameters($required_parameters, $data);
                if ($hasParams !== true) {
                    $response = resultsInValid($hasParams);
                } else {
                    $results = getAddGroups($data["params"]);
                    //if ($results["status"] === "success") {
                    $response = resultsValid($results);
                    //} else {
                    //   $response = resultsInValid($results["results"]);
                    //}
                }
                break;
            case strtoupper("deleteEvent"):
                $required_parameters = array(
                    "id",
                    "fg_enabled"
                );
                $hasParams = has_required_parameters($required_parameters, $data);
                if ($hasParams !== true) {
                    $response = resultsInValid($hasParams);
                } else {
                    $results = deleteEvent($data["params"]);
                    if ($results) {
                        $response = resultsValid("Record Deleted");
                    } else {
                        $response = resultsInValid("Record Not Deleted");
                    }
                }
                break;
            case strtoupper("postEvent"):
                $required_parameters = array(
                    "market_id",
                    "direction",
                    "amount",
                    "fg_enabled",
                    "scenario_id"
                );
                $hasParams = has_required_parameters($required_parameters, $data);
                if ($hasParams !== true) {
                    $response = resultsInValid($hasParams);
                } else {
                    $results = postEvent($data["params"]);
                    if ($results === true) {
                        $response = resultsValid("Record Created");
                    } else {
                        $response = resultsInValid($results);
                    }
                }
                break;
            case strtoupper("updateEvent"):
                $required_parameters = array(
                    "id",
                    "market_id",
                    "direction",
                    "amount",
                    "fg_enabled"
                );
                $hasParams = has_required_parameters($required_parameters, $data);
                if ($hasParams !== true) {
                    $response = resultsInValid($hasParams);
                } else {
                    $results = updateEvent($data["params"]);
                    if ($results) {
                        $response = resultsValid("Record Updated");
                    } else {
                        $response = resultsInValid("Record Not Updated");
                    }
                }
                break;
            case strtoupper("getScenarios"):

                $required_parameters = array(
                    "accountId"
                );
                if ($hasParams = has_required_parameters($required_parameters, $data) !== true) {
                    $response = resultsInValid($hasParams);
                } else {
                    //echo "<pre>" . var_export($_REQUEST, 1) . "</pre>";

                    $results = getScenarios($_REQUEST["params"]);
                    if ($results) {
                        $response = resultsValid($results);
                    }
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
//echo "<pre>" . var_export($results, 1) . "</pre>";
//**************************************************



