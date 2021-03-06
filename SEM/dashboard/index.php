<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/SEM/src/autoloader.php";

require_once $_SERVER["DOCUMENT_ROOT"] . "/Google/google-ads-php/vendor/autoload.php";

$users = $db->get("user");
//echo "<pre>" . var_export($users, 1) . "</pre>";
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
        <link href="css/style.css" rel="stylesheet">
        <style type="text/css">
            html,
            body,
            header,
            .view {
                height: 100%;
            }

            @media (max-width: 740px) {
                html,
                body,
                header,
                .view {
                    height: 1000px;
                }
            }

            @media (min-width: 800px) and (max-width: 850px) {
                html,
                body,
                header,
                .view {
                    height: 650px;
                }
            }
            @media (min-width: 800px) and (max-width: 850px) {
                .navbar:not(.top-nav-collapse) {
                    background: #1C2331!important;
                }
            }
        </style>
    </head>

    <body class="creative-lp">

        <header>
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
                            <a class="nav-link" href="/SAP/dashboard/">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/SAP/dashboard/settings.php">Settings</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <section class="view intro-4 mt-5">
                <div class="container h-100 d-flex justify-content-center align-items-center">


                    <div class="row">
                        <div class="col-12 text-center text-md-left margins">

                            <div class="card card-body">
                                <form id="frm_login">
                                    <select id="sel_users" class="mdb-select md-form">
                                        <?php
                                        for ($n = 0; $n < count($users); $n++) {
                                            $user_id = $users[$n]["id"];
                                            $user_name = $users[$n]["name"];
                                            echo "<option value='$user_id'>$user_name</option>";
                                        }
                                        ?>
                                    </select>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

        </header>
        <main>
            <div class="container">
                <section id="features" class="section feature-box text-center my-5">
                    <h2 class="title font-weight-bold my-5 wow fadeIn" data-wow-delay="0.2s" style="">
                        <strong>Demos</strong>
                    </h2>

                    <!-- Section sescription -->
                    <p class="grey-text w-responsive mx-auto mb-5 wow fadeIn" data-wow-delay="0.2s" style="">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum quas, eos officia maiores ipsam ipsum dolores reiciendis
                        ad voluptas, animi obcaecati adipisci sapiente mollitia.</p>

                    <!--Grid row-->
                    <div class="row features d-md-flex wow fadeIn" data-wow-delay="0.2s" style="">

                        <!--Grid column-->
                        <div class="col-lg-4">
                            <div class="card chart-card h-100">
                                <div class="card-body pb-0">
                                    <h4 class="card-title font-weight-bold"><span id="dow_name"></span></h4>
                                    <!-- Text -->
                                    <p class="card-text mb-4">NYSE: <span id="dow_symbol" class="ml-1 mr-1"></span>&bull;<span id="dow_date_refreshed" class="ml-1 mr-1"></span></p>
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
                                    <p class="card-text mb-4">NYSE: <span id="sp_symbol" class="ml-1 mr-1"></span>&bull;<span id="sp_date_refreshed" class="ml-1 mr-1"></span></p>
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
                                    <p class="card-text mb-4">NYSE: <span id="ndaq_symbol" class="ml-1 mr-1"></span>&bull;<span id="ndaq_date_refreshed" class="ml-1 mr-1"></span></p>
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
        <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/popper.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <script type="text/javascript" src="js/jquery-validation-1.19.1/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/jquery-validation-1.19.1/dist/additional-methods.min.js"></script>
        <script type="text/javascript" src="js/globals.js"></script>
        <script>
            var dataPath = "http://localhost/SEM/src/router.php";


            $(document).ready(function () {
                setValidator();

                var sectionRules = {
                    rules: {
                        gcn: {
                            required: true,
                            minlength: 2

                        }
                    },
                    messages: {
                        gcn: {
                            rerequired: "Please enter a username",
                            minlength: "Your username must consist of at least 2 characters"

                        }
                    }
                }
                var sectionEditForm = $("#frmGoogleSettings").validate(sectionRules);

                $("#btn_submit_4").click(function () {
                    sectionEditForm.form();
                    setCheckboxes();
                    if (sectionEditForm.valid()) {
                        /*
                         var _id = $("#section_id").val().replace(/[_\W]+/g, "_");
                         
                         var passedVariables = {
                         
                         id: _id,
                         
                         _employees_id: "1",
                         
                         _pages_id: "<?php echo $_id; ?>",
                         
                         fg_enabled: $("#section_enabled").val(),
                         
                         name: $("#section_name").val(),
                         
                         }
                         
                         var dataToSend = {
                         
                         method: "createSection",
                         
                         params: passedVariables
                         
                         }
                         
                         $.postJSON(dataPath, dataToSend, function (data, status, xhr) {
                         var passed = false;
                         if (status === "success" && typeof data.result !== "undefined") {
                         
                         passed = true;
                         
                         } else if (status === "failed" && typeof data.error === "undefined") {
                         
                         passed = false;
                         
                         } else if (status === "success" && typeof data.error !== "undefined") {
                         passed = false;
                         } else {
                         
                         passed = false;
                         
                         }
                         
                         if (passed) {
                         location.reload();
                         resetCheckboxs();
                         
                         } else {
                         //showDismissibles("error", "Form contains errors");
                         resetCheckboxs();
                         }
                         });
                         */
                        alert("");
                        return false;
                    } else {
                        resetCheckboxs();
                        return false;
                    }

                });
                $("#updateSettings").click(function () {
                    var frmUpdateSettings = $("#frmUpdateSettings");
                    var inputInterval = $("#inputInterval").val();
                    var dowChange = $("#dowChange").val();
                    var spChange = $("#spChange").val();
                    var nasdaqChange = $("#nasdaqChange").val();
                    var data = {
                        "function": "updateBase",
                        "markets": {
                            1: dowChange,
                            2: nasdaqChange,
                            3: spChange
                        },
                        "interval": inputInterval
                    };
                    $.ajax({
                        type: "POST",
                        url: "http://localhost/SAP/updateMarkets.php",
                        data: data,
                        success: function (data, textStatus, jQxhr) {
                            console.log(data)
                        },
                        error: function (jqXhr, textStatus, errorThrown) {
                            console.log(errorThrown);
                        },
                        dataType: "json"
                    });




                });




            });





        </script>
    </body>

</html>
