<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
