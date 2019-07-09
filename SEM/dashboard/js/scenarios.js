function refreshFrame() {
    var iframe = document.getElementById("demoBatchFile");
    $("#demoBatchFile").empty();
    iframe.src = "http://localhost//SEM/shared/build_recurring_market_values.php";
}

function getAdGroupListValues() {
    var adGroupList = [];
    $(".item").each(function (index) {

        if (typeof $(this).data("id") !== "undefined" && $(this).attr("check-value") !== "0") {
            adGroupList.push($(this).data("id"));
        }
    });
    var id = $("#scenario_id").val();
    var ad_group_list = adGroupList.join(",");
    var passedVariables = {
        id: id,
        ad_group_list: ad_group_list
    };
    var dataToSend = {
        method: "updateScenarioAdGroups",
        params: passedVariables
    };
    $.postJSON(dataPath, dataToSend, function (data, status, xhr) {
        if (status === "success" && typeof data.result !== "undefined") {
            $("#modalConfirmSuccess").modal("toggle");
        } else if (status === "failed" && typeof data.error === "undefined") {
        } else if (status === "success" && typeof data.error !== "undefined") {
            //alert(data.error);
        } else {
        }
    });

}

function convertAmountToGoogleValue(amountValue) {
    //amountValue = (parseFloat(amountValue) / 100) + 1;
    return amountValue;
}
function convertAmountFromGoogleValue(amountValue) {
    //amountValue = (amountValue - 1) * 100;
    return amountValue;
}
function updateScenarioActionValues() {
    var id = $("#scenario_id").val();
    var action_direction = parseInt($("input[name='groupOfMaterialRadios_action']:checked").val());
    var action_amount = $("#txt_action_amount").val();
    var passedVariables = {
        id: id,
        action_amount: action_amount,
        action_direction: action_direction
    };
    var dataToSend = {
        method: "updateScenarioActionValues",
        params: passedVariables
    };
    console.log(dataToSend);

    $.postJSON(dataPath, dataToSend, function (data, status, xhr) {
        if (status === "success" && typeof data.result !== "undefined") {
            $("#modalConfirmSuccess").modal("toggle");
        } else if (status === "failed" && typeof data.error === "undefined") {
        } else if (status === "success" && typeof data.error !== "undefined") {
            //alert(data.error);
        } else {
        }
    });

}

function populateDirection(dir) {
    var el = "updateActionIncrease";
    if (dir === 0) {
        el = "updateActionDecrease";
    }
    $("#" + el).prop("checked", true);
}



function getAdGroups(scenarioId) {

    var accountId = $("#sel_accounts").val();
    var passedVariables = {
        accountId: accountId,
        scenarioId: scenarioId
    };
    var dataToSend = {
        method: "getAdGroups",
        params: passedVariables
    };
    $.postJSON(dataPath, dataToSend, function (data, status, xhr) {
        if (status === "success" && typeof data.result !== "undefined") {
            //*
            $("#section_ad_groups").empty();
            var treeObject = data.result;
            var tw = new TreeView(
                    treeObject,
                    {
                        showAlwaysCheckBox: true,
                        fold: false,
                        openAllFold: true
                    });
            document.getElementById("section_ad_groups").appendChild(tw.root);
            //*/
        } else if (status === "failed" && typeof data.error === "undefined") {
            $("#section_ad_groups").empty();
        } else if (status === "success" && typeof data.error !== "undefined") {
            $("#section_ad_groups").empty();
            alert(data.error);
        } else {
        }
    });

}




function addEvent() {
    var market_id = $("#addEventMarket").val();
    var amount = $("#addEventAmount").val();
    var scenario_id = $("#scenario_id").val();
    var direction = parseInt($("input[name='groupOfMaterialRadios_add']:checked").val());
    var fg_enabled = 1;
    var passedVariables = {
        scenario_id: scenario_id,
        market_id: market_id,
        amount: amount,
        direction: direction,
        fg_enabled: fg_enabled
    };
    var dataToSend = {
        method: "postEvent",
        params: passedVariables
    };
    $.postJSON(dataPath, dataToSend, function (data, status, xhr) {
        if (status === "success" && typeof data.result !== "undefined") {
            $("#modalAddEvent").modal("toggle");
            getScenarios();
        } else if (status === "failed" && typeof data.error === "undefined") {
        } else if (status === "success" && typeof data.error !== "undefined") {
            alert(data.error);
        } else {
        }
    });
}