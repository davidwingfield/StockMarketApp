<?php

/**
 * Helper
 * 
 * @author    David Wingfield <davidwingfield18@outlook.com>
 */

/**
 * updateScenarioActionValues
 * 
 * Method to update scenario Action Value
 * 
 * @global type $db
 * @param type $params
 * @return boolean
 */
function updateScenarioActionValues($params = null) {
    global $db;
    $data = Array(
        "action_direction" => intval($params["action_direction"]),
        "action_amount" => floatval($params["action_amount"]),
    );
    $db->where("id", intval($params["id"]));
    if ($db->update("scenario", $data)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Method to update scenario ad groups
 * 
 * @global type $db
 * @param type $params
 * @return boolean
 */
function updateScenarioAdGroups($params = null) {
    global $db;
    $db->where("id", intval($params["id"]));
    $scenario = $db->getOne("scenario");

    $data = Array(
        "campaign_list" => $scenario["campaign_list"],
        "ad_group_list" => $params["ad_group_list"],
        "fg_enabled" => intval($scenario["fg_enabled"]),
        "action_direction" => intval($scenario["action_direction"]),
        "action_amount" => floatval($scenario["action_amount"]),
    );
    $db->where("id", intval($params["id"]));
    if ($db->update("scenario", $data)) {
        return true;
    } else {
        return false;
    }
}

function getAddGroups($params) {
    global $db;
    $db->where("id", $params["scenarioId"]);
    $scenario = $db->getOne("scenario");
    $accountId = $params["accountId"];
    $_ad_groups = (include($_SERVER["DOCUMENT_ROOT"] . "/SEM/shared/get_ad_group_list.php"));
    return $_ad_groups;
}

function getScenarios($_params) {
    global $db;

    $accoutId = $_params["accountId"];
    $sql_query = "
  SELECT  a.account_id,
  a.scenario_id,
  s.campaign_list,
  s.action_direction,
  s.action_amount,
  s.ad_group_list
  FROM    account_scenario a
  JOIN    scenario s
  ON  a.scenario_id = s.id
  WHERE   a.account_id = '$accoutId'
  AND a.fg_enabled = 1
  LIMIT 1;
  ";

    $results = $db->rawQuery($sql_query);
    if (count($results) > 0) {
        $results = $results[0];
        if (isset($results["scenario_id"])) {
            $id = intval($results["scenario_id"]);
            $sql_query = "
  SELECT  e.id AS 'event_id',
  e.market_id AS 'event_market_id',
  e.direction AS 'direction',
  e.amount AS 'amount'
  FROM    scenario_event se
  JOIN    event e
  ON  se.event_id = e.id
  WHERE 	se.scenario_id = $id
  AND se.fg_enabled = 1
  AND e.fg_enabled = 1;";


            $events = $db->rawQuery($sql_query);
            $results["events"] = $events;
        }
    } else {
        $results = array();
    }
    return $results;
}

function buildMarketDropDown($params) {
    global $db;
    $db->where("fg_enabled", 1);
    $markets = $db->get("market");
    return $markets;
}

function updateEvent($params = null) {
    global $db;
    $data = Array(
        "market_id" => intval($params["market_id"]),
        "amount" => floatval($params["amount"]),
        "direction" => intval($params["direction"]),
        "fg_enabled" => intval($params["fg_enabled"])
    );
    $db->where("id", intval($params["id"]));
    if ($db->update("event", $data)) {
        return true;
    } else {
        return false;
    }
}

function deleteEvent($params = null) {
    global $db;
    $data = Array(
        "fg_enabled" => 0
    );
    $db->where("id", intval($params["id"]));
    if ($db->update("event", $data)) {
        return true;
    } else {
        return false;
    }
}

function postEvent($params = null) {
    global $db;
    $data = Array(
        "market_id" => intval($params["market_id"]),
        "amount" => floatval($params["amount"]),
        "direction" => intval($params["direction"]),
        "fg_enabled" => intval($params["fg_enabled"])
    );

    $id = $db->insert("event", $data);
    if ($id) {
        $data = Array(
            "scenario_id" => intval($params["scenario_id"]),
            "event_id" => intval($id),
            "fg_enabled" => 1
        );
        $id2 = $db->insert("scenario_event", $data);

        if ($id2) {
            return true;
        } else {
            return $db->getLastError();
        }
    } else {
        return $db->getLastError();
    }
}
