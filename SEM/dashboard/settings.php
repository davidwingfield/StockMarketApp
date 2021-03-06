<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/SEM/src/autoloader.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Google/google-ads-php/vendor/autoload.php";

$users = $db->get("user");
//$db->where("fg_enabled", 1);
$markets = $db->get("market");

$_accounts = (include($_SERVER["DOCUMENT_ROOT"] . "/SEM/shared/get_account_list.php"));

//$_campaigns = (include($_SERVER["DOCUMENT_ROOT"] . "/SEM/shared/get_campaign_list.php"));
//$_ad_groupss = (include($_SERVER["DOCUMENT_ROOT"] . "/SEM/shared/get_ad_group_list.php"));
//die();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Full-service marketing advertising agency with expertise in direct response, content, analytics, eCRM, media, DRTV, SEO, SEM -- Atlanta, Chicago, New York.">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Stock Activation Platform | Settings</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/mdb.min.css" rel="stylesheet">
        <link href="css/addons/datatables.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <style type="text/css">

            @media (min-width: 800px) and (max-width: 850px) {
                .navbar:not(.top-nav-collapse) {
                    background: #1C2331!important;
                }
            }
        </style>
    </head>

    <body class="creative-lp">
        <header>
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
                            <li class="nav-item">
                                <a class="nav-link" href="/SEM/dashboard/scenarios.php">Home

                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/SEM/dashboard/settings.php">Settings</a>
                                <span class="sr-only">(current)</span>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <main>
                <div class=" intro-4">
                    <div class="container py-5">
                        <section id="scenarios" class="section feature-box my-5">
                            <h2 class="title font-weight-bold my-5">
                                <strong></strong>
                            </h2>
                            <!-- Section description -->
                            <p class="grey-text w-responsive mx-auto mb-5">
                            </p>
                            <div class="row w-100">
                                <div class="col-6 text-center text-md-left margins">
                                    <!-- Material form subscription -->
                                    <div class="card">

                                        <h5 class="card-header info-color white-text text-center py-4">
                                            <strong>Market</strong>
                                        </h5>
                                        <!--Card content-->
                                        <div class="card-body px-lg-5">
                                            <!-- Form -->
                                            <form class="text-center" style="color: #757575;">
                                                <!-- Name -->
                                                <div class="md-form mt-3">
                                                    <input type="text" id="symbol" class="form-control">
                                                    <label for="symbol">Symbol</label>
                                                </div>

                                                <!-- Name -->
                                                <div class="md-form">
                                                    <input type="text" id="name" class="form-control">
                                                    <label for="name">Name</label>
                                                </div>

                                                <!-- Enabled -->
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="fg_enable">
                                                    <label class="form-check-label" for="fg_enable">Enabled</label>
                                                </div>
                                                <!-- Submit button -->
                                                <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Save</button>
                                            </form>
                                            <!-- Form -->
                                        </div>
                                    </div>
                                    <!-- Market -->
                                </div>
                                <div class="col-6">
                                    <div class="card card-body">
                                        <div class="row d-flex justify-content-left align-items-center">
                                            <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="th-sm">Id</th>
                                                        <th class="th-sm">Symbol</th>
                                                        <th class="th-sm">Name</th>
                                                        <th class="th-sm">Enabled</th>
                                                        <th class="th-sm" data-orderable="false">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    for ($n = 0; $n < count($markets); $n++) {
                                                        $id = $markets[$n]["id"];
                                                        $symbol = $markets[$n]["symbol"];
                                                        $name = $markets[$n]["name"];
                                                        $fg_enabled = $markets[$n]["fg_enabled"];
                                                        if (intval($fg_enabled) === 1) {
                                                            $enabled = "<center class='text-success' data-order='$fg_enabled'><i class='fas fa-check'></i></center>";
                                                        } else {
                                                            $enabled = "<center class='text-danger' data-order='$fg_enabled'><i class='fas fa-ban'></i></center>";
                                                        }
                                                        echo "
                                                        <tr>
                                                            <td>$id</td>
                                                        <td>$symbol</td>
                                                        <td>$name</td>
                                                            <td>$enabled</td>
                                                             <td></td>   
                                                        </tr>
                                                        ";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </main>
            <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
            <script type="text/javascript" src="js/popper.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/mdb.min.js"></script>
            <script type="text/javascript" src="js/addons/datatables.min.js"></script>

            <script>
                $(document).ready(function () {
                    new WOW().init();
                    $('#dtMaterialDesignExample').DataTable();
                    $('#dtMaterialDesignExample_wrapper').find('label').each(function () {
                        $(this).parent().append($(this).children());
                    });
                    $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
                        $('input').attr("placeholder", "Search");
                        $('input').removeClass('form-control-sm');
                    });
                    $('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
                    $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
                    $('#dtMaterialDesignExample_wrapper select').removeClass(
                            'custom-select custom-select-sm form-control form-control-sm');
                    $('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
                    $('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
                    $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
                });

            </script>
    </body>

</html>
