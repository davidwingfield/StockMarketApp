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
require_once $_SERVER["DOCUMENT_ROOT"] . "/SEM/src/autoloader.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Google/google-ads-php/vendor/autoload.php";

$users = $db->get("user");
$db->where("fg_enabled", 1);
$markets = $db->get("market");
$path = $_SERVER["DOCUMENT_ROOT"] . "/SEM/shared/get_account_list.php";
if (file_exists($path)) {
    $_accounts = (include($_SERVER["DOCUMENT_ROOT"] . "/SEM/shared/get_account_list.php"));
} else {
    echo "Bad: <br>" . $path;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Full-service marketing advertising agency with expertise in direct response, content, analytics, eCRM, media, DRTV, SEO, SEM -- Atlanta, Chicago, New York.">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Stock Activation Platform</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/mdb.min.css" rel="stylesheet">
        <link href="libs/treeview-checkbox/css/jquery.treeview.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <style type="text/css">
            @media (min-width: 800px) and (max-width: 850px) {
                .navbar:not(.top-nav-collapse) {
                    background: #1C2331!important;
                }
            }
            .intro-4 {
                background: no-repeat #ec6851;
                background-color:#ec6851;
                color:#303e48;
            }
        </style>
    </head>

    <body class="creative-lp">
        <header class="">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top scrolling-navbar white">
                <a class="navbar-brand" href="#">
                    <img src="img/logos/logo_1.png" height ="40" alt="..." class=""/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="basicExampleNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/SEM/dashboard/scenarios.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/SEM/dashboard/settings.php">Settings</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            <div class="intro-4">
                <div class="container py-5">
                    <section id="scenarios" class="section feature-box my-5">
                        <h2 class="title font-weight-bold my-5">
                            <strong></strong>
                        </h2>
                        <!-- Section description -->
                        <p class="grey-text w-responsive mx-auto mb-5">
                        </p>
                        <div class="row w-100">
                            <div class="col-12 text-center text-md-left margins">
                                <div class="card card-body">
                                    <div class="row d-flex justify-content-left align-items-center">
                                        <div class="col-2">
                                            <select id="sel_accounts" class="mdb-select md-form">
                                                <option value="" disabled selected>Select Account</option>
                                                <?php
                                                for ($n = 0; $n < count($_accounts["results"]); $n++) {
                                                    $account_id = $_accounts["results"][$n]["id"];
                                                    $account_name = $_accounts["results"][$n]["name"];
                                                    echo "<option value='$account_id'>$account_name</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="col-6">

                                        </div>
                                    </div>

                                    <div class="row w-100">
                                        <section class="container">
                                            <h4 class="bold">Scenario <span class="scenario_id"></span><a class="btn-floating btn-sm btn-secondary waves-effect waves-light ml-4" style="display:none" id="btn_add_scenario" data-toggle="modal" data-target="#modalAddScenario"><i class="fas fa-plus"></i></a></h4>
                                            <input type="hidden" id="scenario_id" value="" />
                                            <p class="lead" data-wow-delay="">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                            </p>
                                            <div class="row d-flex justify-content-left">
                                                <div class="col-sm-12">
                                                    <div class="card card-body z-depth-0 border mb-2">
                                                        <h5>Campaigns/Ad Groups</h5>
                                                        <p class="lead" data-wow-delay="">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                                        </p>
                                                        <hr>
                                                        <section id="section_ad_groups" style="max-height: 200px;overflow-x: hidden;overflow-y: auto;">

                                                        </section>
                                                        <div class="row">
                                                            <div class="col-6 text-right">

                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <a class="btn-floating btn-sm btn-secondary waves-effect waves-light" id="btn_update_ad_groups"><i class="far fa-save"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-left">
                                                <div class="col-sm-12">
                                                    <div class="card card-body z-depth-0 border h-100">
                                                        <h5>Events</h5>
                                                        <p class="lead" data-wow-delay="">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                                        </p>
                                                        <hr>
                                                        <section id="section_events" class="h-100" style="overflow-x: hidden;overflow-y: auto;">
                                                        </section>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                &nbsp;
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <a class="btn-floating btn-sm btn-secondary waves-effect waves-light" id="btn_add_event" data-toggle="modal" data-target="#modalAddEvent"><i class="fas fa-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row d-flex justify-content-left">
                                                <div class="col-sm-12">

                                                    <div class="card card-body z-depth-0 border  h-100 mt-2">
                                                        <h5>Action</h5>
                                                        <p class="lead" data-wow-delay="">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                                        </p>
                                                        <hr>
                                                        <div class="row d-flex justify-content-left align-items-center">
                                                            <div class="col-6">
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" id="updateActionIncrease" name="groupOfMaterialRadios_action" value="1">
                                                                    <label class="form-check-label" for="updateActionIncrease">Increases</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input type="radio" class="form-check-input" id="updateActionDecrease" name="groupOfMaterialRadios_action" value="0">
                                                                    <label class="form-check-label" for="updateActionDecrease">Decreases</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="md-form input-group mb-4">
                                                                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="" id="txt_action_amount">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text md-addon" id="material-addon2"><i class="fas fa-percent"></i></span>
                                                                    </div>
                                                                </div>
                                                                <small id="passwordHelpBlock" class="form-text text-muted">
                                                                    Your adjustment increments must be in whole numbers. If your original bid adjustment in Google is 4% then it will add or subtract your value from it.
                                                                </small>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-6 text-right">

                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <a class="btn-floating btn-sm btn-secondary waves-effect waves-light" id="btn_update_action"><i class="far fa-save"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="container">
                <section id="features" class="section feature-box text-center my-5">
                    <h2 class="title font-weight-bold my-5 wow fadeIn" data-wow-delay="0.2s">
                        <strong>Demos</strong>
                    </h2>

                    <!-- Section sescription -->
                    <p class="grey-text w-responsive mx-auto mb-5 wow fadeIn" data-wow-delay="0.2s">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis
                        ad voluptas, animi obcaecati adipisci sapiente mollitia.</p>
                    <!--Grid row-->
                    <div class="row features d-md-flex wow fadeIn" data-wow-delay="0.2s">
                        <div class="col-12">
                            <iframe src="" id="demoBatchFile" style="height:400px;width:600px;" >

                            </iframe>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary" id="refreshFrame">Refresh</button>
                        </div>
                    </div>
                    <!--Grid row-->
                    <div class="row features d-md-flex wow fadeIn" data-wow-delay="0.2s">

                        <!--Grid column-->
                        <div class="col-lg-4">
                            <div class="card chart-card h-100">
                                <div class="card-body pb-0">
                                    <h4 class="card-title font-weight-bold"><span id="dow_name"></span></h4>
                                    <!-- Text -->
                                    <p class="card-text mb-4">NYSE: <span id="dow_symbol" class="ml-1 mr-1"></span>•<span id="dow_date_refreshed" class="ml-1 mr-1"></span></p>
                                    <div class="d-flex justify-content-between">
                                        <p class="display-4 align-self-end"><span id="dow_price" class=""></span></p>
                                        <p id="dow_change_line" class="align-self-end pb-2"><span id="dow_change" class=""></span> (<span id="dow_change_percent" class=""></span>)<i id="dow_change_direction" class=""></i></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-lg-4">
                            <div class="card chart-card h-100">
                                <div class="card-body pb-0">
                                    <h4 class="card-title font-weight-bold"><span id="sp_name"></span></h4>
                                    <!-- Text -->
                                    <p class="card-text mb-4">NYSE: <span id="sp_symbol" class="ml-1 mr-1"></span>•<span id="sp_date_refreshed" class="ml-1 mr-1"></span></p>
                                    <div class="d-flex justify-content-between">
                                        <p class="display-4 align-self-end"><span id="sp_price" class=""></span></p>
                                        <p id="sp_change_line" class="align-self-end pb-2"><span id="sp_change" class=""></span> (<span id="sp_change_percent" class=""></span>)<i id="sp_change_direction" class=""></i></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card chart-card h-100">
                                <div class="card-body pb-0">
                                    <h4 class="card-title font-weight-bold"><span id="ndaq_name"></span></h4>
                                    <!-- Text -->
                                    <p class="card-text mb-4">NYSE: <span id="ndaq_symbol" class="ml-1 mr-1"></span>•<span id="ndaq_date_refreshed" class="ml-1 mr-1"></span></p>
                                    <div class="d-flex justify-content-between">
                                        <p class="display-4 align-self-end"><span id="ndaq_price" class=""></span></p>
                                        <p id="ndaq_change_line" class="align-self-end pb-2"><span id="ndaq_change" class=""></span> (<span id="ndaq_change_percent" class=""></span>)<i id="ndaq_change_direction" class=""></i></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>



        <!--Modal: modalConfirmUpdate-->
        <div class="modal fade" id="modalConfirmUpdate" tabindex="-1" role="dialog" aria-labelledby="modalConfirmUpdateLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm modal-notify modal-success" role="document">
                <!--Content-->
                <div class="modal-content text-center">
                    <!--Header-->
                    <div class="modal-header d-flex justify-content-center">
                        <p class="heading">Are you sure?</p>
                    </div>

                    <!--Body-->
                    <div class="modal-body">
                        <i class="fas fa-save fa-4x animated rotateIn"></i>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer flex-center">
                        <a href="javascript:void(0);" id="btnConfirmEventUpdate" data-event="" class="btn  btn-outline-success">Yes</a>
                        <a type="button" class="btn  btn-success waves-effect" data-dismiss="modal">No</a>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!--Modal: modalConfirmUpdate-->
        <!--Modal: modalConfirmDelete-->
        <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                <!--Content-->
                <div class="modal-content text-center">
                    <!--Header-->
                    <div class="modal-header d-flex justify-content-center">
                        <p class="heading">Are you sure?</p>
                    </div>

                    <!--Body-->
                    <div class="modal-body">
                        <i class="fas fa-times fa-4x animated rotateIn"></i>
                    </div>

                    <!--Footer-->
                    <div class="modal-footer flex-center">
                        <a href="javascript:void(0);" id="btnConfirmEventDelete" data-event="" class="btn  btn-outline-danger">Yes</a>
                        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!--Modal: modalConfirmDelete-->
        <div class="modal fade" id="modalAddEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notify modal-info" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">

                        <p class="heading lead h6">Add Event</p>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="white-text">×</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="row d-flex justify-content-left align-items-center">
                            <div class="col-5">
                                <div class="md-form input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text md-addon">When</span>
                                    </div>
                                    <select class="browser-default custom-select" id="addEventMarket">
                                        <option value="" disabled selected>Market</option>
                                        <?php
                                        for ($n = 0; $n < count($markets); $n++) {
                                            $market_id = $markets[$n]["id"];
                                            $market_name = $markets[$n]["name"];
                                            echo "<option value='$market_id'>$market_name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="addEventIncrease" name="groupOfMaterialRadios_add" value="1">
                                    <label class="form-check-label" for="addEventIncrease">Increases</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="addEventDecrease" name="groupOfMaterialRadios_add" value="0">
                                    <label class="form-check-label" for="addEventDecrease">Decreases</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="md-form input-group mb-4">
                                    <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="" id="addEventAmount">
                                    <div class="input-group-append">
                                        <span class="input-group-text md-addon" id="material-addon2"><i class="fas fa-percent"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-info" id="buttonAddEvent">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- !-->
        <div class="modal fade" id="modalConfirmSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-notify modal-success" role="document">
                <!--Content-->
                <div class="modal-content text-center">
                    <!--Header-->
                    <div class="modal-header d-flex justify-content-center">
                        <p class="heading">Success</p>
                    </div>

                    <!--Body-->
                    <div class="modal-body">
                        <i class="fas fa-check fa-4x animated rotateIn"></i>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer flex-center">
                        <a type="button" class="btn  btn-success waves-effect" data-dismiss="modal">Ok</a>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/popper.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="libs/treeview-checkbox/js/jquery.treeview.js"></script>
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <script type="text/javascript" src="js/jquery-validation-1.19.1/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/jquery-validation-1.19.1/dist/additional-methods.min.js"></script>
        <script type="text/javascript" src="js/globals.js"></script>
        <script type="text/javascript" src="js/scenarios.js"></script>
        <script>
            var dataPath = "http://sem.drumagency.com/SEM/src/router.php";

            var waiting = "<div class='spinner-border' role='status'>";
            waiting += "  <span class='sr-only'>Loading...</span>";
            waiting += "</div>";


            function getScenarios() {
                $("#section_events").empty();
                $("#section_ad_groups").empty();
                $("#section_ad_groups").html(waiting);
                var accountId = $("#sel_accounts").val();
                var passedVariables = {
                    accountId: accountId
                };
                var dataToSend = {
                    method: "getScenarios",
                    params: passedVariables
                };
                $.postJSON(dataPath, dataToSend, function (data, status, xhr) {
                    if (status === "success" && typeof data.result !== "undefined") {
                        getAdGroups(data.result.scenario_id);
                        $(".scenario_id").html("- " + data.result.scenario_id);
                        $("#scenario_id").val(data.result.scenario_id);
                        $("#txt_action_amount").val(convertAmountFromGoogleValue(data.result.action_amount));
                        populateDirection(data.result.action_direction);
                        var event_count = data.result.events.length;
                        var event_counter = 0;
                        $.each(data.result.events, function () {
                            var _or = " OR ";
                            if (event_counter >= event_count - 1) {
                                _or = "";
                            }
                            var line = "";
                            line += "<div class='row d-flex justify-content-left align-items-center'>";
                            line += "	<div class='col-4'>";
                            line += "		<div class='md-form input-group'>";
                            line += "			<div class='input-group-prepend'>";
                            line += "				<span class='input-group-text md-addon'>When</span>";
                            line += "			</div>";
                            line += "			<select id='sel_" + this.event_id + "_market' class='browser-default custom-select'>";
                            line += "				<?php
                                        for ($n = 0; $n < count($markets); $n++) {
                                            $market_id = $markets[$n]["id"];
                                            $market_name = $markets[$n]["name"];
                                            echo "<option value='$market_id'>$market_name</option>";
                                        }
                                        ?>";
                            line += "			</select>";
                            line += "		</div>";
                            line += "	</div>";
                            line += "	<div class='col-3'>";
                            line += "		<div class='form-check'>";
                            line += "			<input type='radio' class='form-check-input' id='rad_" + this.event_id + "_direction_up' name='groupOfMaterialRadios_" + this.event_id + "' value='1'>";
                            line += "			<label class='form-check-label' for='rad_" + this.event_id + "_direction_up'>Increases</label>";
                            line += "		</div>";
                            line += "		<div class='form-check'>";
                            line += "			<input type='radio' class='form-check-input' id='rad_" + this.event_id + "_direction_down' name='groupOfMaterialRadios_" + this.event_id + "' value='0'>";
                            line += "			<label class='form-check-label' for='rad_" + this.event_id + "_direction_down'>Decreases</label>";
                            line += "		</div>";
                            line += "	</div>";
                            line += "	<div class='col-3'>";
                            line += "		<div class='md-form input-group mb-4'>";
                            line += "			<input type='text' id='inp_" + this.event_id + "_amount' value='" + this.amount + "' class='form-control' placeholder='' aria-label='' aria-describedby=''>";
                            line += "			<div class='input-group-append'>";
                            line += "				<span class='input-group-text md-addon' id='material-addon2'><i class='fas fa-percent'></i></span>";
                            line += "			</div>";
                            line += "		</div>";
                            line += "	</div>";
                            line += "	<div class='col-2'>";
                            line += "		<a class='ml-1 mr-1 text-success updateEvent' data-event='" + this.event_id + "'>";
                            line += "			<i class='far fa-save'></i>";
                            line += "		</a>";
                            line += "		<a class='ml-1 mr-1 text-danger deleteEvent' data-event='" + this.event_id + "'>";
                            line += "			<i class='fas fa-ban'></i>";
                            line += "		</a>";
                            line += "	</div>";
                            line += "</div>";
                            line += "<div class='strike'>";
                            line += "<span>" + _or + "</span>";
                            line += "</div>";
                            $("#section_events").append(line);
                            var _direction = "_direction_up";
                            if (this.direction === 0) {
                                _direction = "_direction_down";
                            }
                            $("#rad_" + this.event_id + _direction).prop("checked", true);
                            $("#sel_" + this.event_id + "_market option[value='" + this.event_market_id + "']").attr("selected", "selected");
                            event_counter = event_counter + 1;
                        });
                        $(".updateEvent").click(function () {
                            var _event = $(this).data("event");
                            $("#modalConfirmUpdate").modal("toggle");
                            $("#btnConfirmEventUpdate").data("event", _event);
                        });
                        $(".deleteEvent").click(function () {
                            var _event = $(this).data("event");
                            $("#modalConfirmDelete").modal("toggle");
                            $("#btnConfirmEventDelete").data("event", _event);
                        });

                    } else if (status === "failed" && typeof data.error === "undefined") {
                    } else if (status === "success" && typeof data.error !== "undefined") {
                    } else {
                    }
                });
            }


            $(document).ready(function () {

                setValidator();
                $("#btn_update_action").click(function () {
                    updateScenarioActionValues();
                });
                $("#btn_update_ad_groups").click(function () {
                    getAdGroupListValues();
                });
                $("#buttonAddEvent").click(function () {
                    addEvent();
                });

                $("#sel_accounts").change(function () {
                    getScenarios();
                });

                $("#btnConfirmEventUpdate").click(function () {
                    var eventId = $(this).data("event");
                    var eventMarketId = $("#sel_" + eventId + "_market").val();
                    var eventAmount = $("#inp_" + eventId + "_amount").val();
                    var eventDirection = $("input[name='groupOfMaterialRadios_" + eventId + "']:checked").val();
                    var passedVariables = {
                        id: eventId,
                        market_id: eventMarketId,
                        amount: eventAmount,
                        direction: eventDirection,
                        fg_enabled: 1
                    };
                    var dataToSend = {
                        method: "updateEvent",
                        params: passedVariables
                    };
                    $.postJSON(dataPath, dataToSend, function (data, status, xhr) {
                        $("#modalConfirmUpdate").modal("toggle");
                        if (status === "success" && typeof data.result !== "undefined") {
                            getScenarios();
                        } else if (status === "failed" && typeof data.error === "undefined") {
                        } else if (status === "success" && typeof data.error !== "undefined") {
                            alert(data.error);
                        } else {
                            console.log(data);
                        }
                    });
                });

                $("#btnConfirmEventDelete").click(function () {
                    var eventId = $(this).data("event");
                    var passedVariables = {
                        id: eventId,
                        fg_enabled: 1
                    };
                    var dataToSend = {
                        method: "deleteEvent",
                        params: passedVariables
                    };
                    $.postJSON(dataPath, dataToSend, function (data, status, xhr) {
                        $("#modalConfirmDelete").modal("toggle");
                        if (status === "success" && typeof data.result !== "undefined") {
                            getScenarios();
                        } else if (status === "failed" && typeof data.error === "undefined") {
                        } else if (status === "success" && typeof data.error !== "undefined") {
                            alert(data.error);
                        } else {
                            console.log(data);
                        }
                    });
                });

                $("#refreshFrame").click(function () {
                    refreshFrame();
                });
            });
        </script>
    </body>

</html>
