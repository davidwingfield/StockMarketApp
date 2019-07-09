
var additionalRules = {};

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}



$(document).on("focusin", function (e) {

    if ($(e.target).closest(".mce-window").length) {

        if (debug) {

            console.log("stop Propigation");

        }

        e.stopImmediatePropagation();

    }

});

$(document).on("click", 'div[id$="Dismissables"] button', function () {

    setTimeout(function () {

        $(window).trigger("resize");

    }, 1000);

});

(function ($) {

    $.extend($.fn, {

        makeCssInline: function () {

            this.each(function (idx, el) {

                var style = el.style;

                var properties = [];

                for (var property in style) {

                    if ($(this).css(property)) {

                        properties.push(property + ':' + $(this).css(property));

                    }

                }

                this.style.cssText = properties.join(';');

                $(this).children().makeCssInline();

            });

        }

    });

}(jQuery));

jQuery.fn.extend({

    disable: function (state) {

        return this.each(function () {

            this.disabled = state;

        });

    }

});

jQuery.extend({

    postJSON: function (url, data, callback) {

        var request = $.ajax({

            url: url,

            type: "POST",

            data: data,

            dataType: "json"

        });

        request.done(function (msg) {

            if ($.isFunction(callback)) {

                callback(msg, "success");

            }

        });

        request.fail(function (jqXHR, textStatus, msg) {

            if (typeof textStatus !== "undefined") {

                console.log("Request failed");

                console.log(_display_ajax_error(jqXHR, textStatus, url));

            } else {

                console.log("Request failed");

                console.log(_display_ajax_error(jqXHR, textStatus, url));

            }

            if ($.isFunction(callback)) {

                callback(msg, "failed");

            }

        });

        return;

    }

});



var ucwords = function (str, force) {

    str = force ? str.toLowerCase() : str;

    return str.replace(/(\b)([a-zA-Z])/g,
            function (firstLetter) {

                return firstLetter.toUpperCase();

            });

};

var ucfirst = function (str, force) {

    str = force ? str.toLowerCase() : str;

    return str.replace(/(\b)([a-zA-Z])/,
            function (firstLetter) {

                return firstLetter.toUpperCase();

            });

};

var _display_ajax_error = function (jqXHR, exception, uri) {

    var msg = "";

    if (jqXHR.status === 0) {

        msg = "Not connected, verify Network.";

    } else if (jqXHR.status === 404) {

        msg = "Requested page( " + uri + " ) not found. [404]";

    } else if (jqXHR.status === 500) {

        msg = "Internal Server Error [500].";

    } else if (exception === "parsererror") {

        msg = "Requested JSON parse failed.";

    } else if (exception === "timeout") {

        msg = "Time out error.";

    } else if (exception === "abort") {

        msg = "Ajax request aborted.";

    } else {

        msg = "Uncaught Error." + jqXHR.responseText;

    }

    return msg;

};

var waitForFinalEvent = (function () {

    var timers = {};

    return function (callback, ms, uniqueId) {

        if (!uniqueId) {

            uniqueId = "Don't call this twice without a uniqueId";

        }

        if (timers[uniqueId]) {

            clearTimeout(timers[uniqueId]);

        }

        timers[uniqueId] = setTimeout(callback, ms);

    };

})();



function showDismissibles(_type, _message) {

    toastr.options = {

        closeButton: true,

        debug: false,

        newestOnTop: true,

        progressBar: false,

        positionClass: "toast-top-center",

        preventDuplicates: true,

        onclick: null,

        showDuration: "2500",

        hideDuration: "1000",

        timeOut: "2500",

        extendedTimeOut: "2500",

        showEasing: "swing",

        hideEasing: "linear",

        showMethod: "fadeIn",

        hideMethod: "fadeOut"

    };

    switch (_type) {

        case "info":

            toastr.info(_message);

            break;

        case "warning":

            toastr.warning(_message);

            break;

        case "success":

            toastr.success(_message);

            break;

        default:

            toastr.error(_message);

    }

}
function responsive_filemanager_callback(field_id) {
    if (field_id) {
        var url = jQuery("#" + field_id).val();
        $("#" + field_id + "_img").attr('src', url);
        $("#" + field_id + "_img").trigger("change");
    }
}


function open_popup(url) {
    var w = 880;
    var h = 570;
    var l = Math.floor((screen.width - w) / 2);
    var t = Math.floor((screen.height - h) / 2);
    var win = window.open(url, "File Manager", "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
}


function maskPhoneNumber(_phone_number) {
    return "(" + _phone_number.substring(0, 3) + ") " + _phone_number.substring(3, 6) + "-" + _phone_number.substring(6, 10);
}


function initNum() {
    $(".numOnly").keydown(function (e) {
        var lenString = $(this).val().length;
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true ||
                        e.metaKey === true)) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }
        if (lenString >= 10 ||
                (e.shiftKey ||
                        (e.keyCode < 48 || e.keyCode > 57)) &&
                (e.keyCode < 96 || e.keyCode > 105)
                ) {
            e.preventDefault();
        }
    });

    $(".numOnly").blur(function () {
        var numb = $(this).val();
        if (numb.length === 10) {
            $(this).val(maskPhoneNumber(numb));
        }
    });

    $(".numOnly").focus(function () {
        var numb = $(this).val();
        $(this).select();
        numb = numb.replace(/\D/g, "");
        $(this).val(numb);
    });
}


function initPostal() {
    if ($(".postal").length) {
        $(".postal").keydown(function (e) {
            var lenString = $(this).val().length;
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    (e.keyCode === 65 && (e.ctrlKey === true ||
                            e.metaKey === true)) ||
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            if (lenString >= 5 ||
                    (e.shiftKey ||
                            (e.keyCode < 48 || e.keyCode > 57)) &&
                    (e.keyCode < 96 || e.keyCode > 105)
                    ) {
                e.preventDefault();
            }
        });
    }
}



function setValidator() {
    jQuery.validator.setDefaults({
        ignore: "",
        unhighlight: function (element) {
            $(element).closest(".md-form").removeClass("invalid");
            $(element).removeClass("invalid");
        },
        highlight: function (element) {
            $(element).closest(".md-form").addClass("invalid");
            $(element).parent().find("input").addClass("invalid");
            $(element).addClass("invalid");
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            var placement = $(element).data("error");
            var nearCol = $(element).closest(".md-form");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(nearCol);
            }
        },
        success: "valid",
        submitHandler: function (form) {
            form.submit();
        }
    });
}


function setCheckboxes() {
    $(":checkbox").each(function () {
        var checkbox_this = $(this);
        if (checkbox_this.is(":checked") === true) {
            checkbox_this.attr("value", "1");
        } else {
            checkbox_this.prop("checked", true);
            checkbox_this.attr("value", "0");
        }
    });
}

function resetCheckboxs() {
    $(":checkbox").each(function () {
        var checkbox_this = $(this);
        if (checkbox_this.attr("value") === "1") {
            checkbox_this.prop("checked", true);
        } else {
            checkbox_this.prop("checked", false);
        }

    });
}
function initDatepicker() {
    var _today = new Date();
    var _month = _today.getMonth();
    var _year = _today.getFullYear() - 21;
    var _day = _today.getDay();
    var bornD = new Date(_year, _month, _day);
    $(".datepicker").pickadate({
        format: "mm/dd/yyyy",
        formatSubmit: "mm/dd/yyyy",
        selectMonths: true,
        selectYears: 110,
        selectMonth: "picker__select--month",
        selectYear: "picker__select--year",
        max: bornD
    });
}
function updateTextBox(_data) {

}
function buildDataSet(_data) {
    var dataSet = [];
    var tempArray = [];
    if (_data) {
        tempArray = _data.split(",");
        for (n = 0; n < tempArray.length; n++) {
            var _chip = {
                tag: tempArray[n].trim()
            };
            dataSet.push(_chip);
        }
    }
    return dataSet;
}

$(document).ready(function () {
    new WOW().init();

    if ($(".datepicker").length) {
        $(".datepicker").pickadate();
    }

    if ($(".mdb-select").length) {
        $(".mdb-select").material_select();
    }

    if ($(".numOnly").length) {
        initNum();
    }

    if ($(".postal").length) {
        initPostal();
    }


    $("body").scrollspy({
        target: ".dotted-scrollspy"
    });

    $(function () {
        $("#mdb-lightbox-ui").load("/assets/mdb-addons/mdb-lightbox-ui.html");
    });
    if ($(".navbar-collapse a").length) {
        $(".navbar-collapse a").click(function () {
            $(".navbar-collapse").collapse('hide');
        });
    }
    if ($(".sticky").length) {
        var navHeight = $("#sectionNav").outerHeight();
        $("nav").css("height", navHeight + "px");
        $("main").css("margin-top", navHeight + "px");
        $(".sticky").css("top", navHeight + "px");
        $(function () {
            $(".sticky").sticky({
                topSpacing: navHeight
                , zIndex: 2
                , stopper: ".footer"
            });
        });
    }

    if ($(".iframe-btn").length) {
        $(".iframe-btn").fancybox({
            width: 900,
            height: 600,
            type: "iframe",
            autoScale: false
        });
    }
    if ($(".chips").length) {
        var _data = buildDataSet($("#keywords").val());
        $(".chips").on("chip.add", function (e, chip) {
            var _data = $(this).material_chip("data");
            var _id = $(this).data("name");
            $("#" + _id).val(updateTextBox(_data));

            $("#keywords").val(generateStringFromJSON(_data));
        });
        $(".chips").on("chip.delete", function (e, chip) {
            var _data = $(this).material_chip("data");
            var _id = $(this).data("name");
            $("#" + _id).val(updateTextBox(_data));
            $("#keywords").val(generateStringFromJSON(_data));
        });

        $(".chips").on("chip.select", function (e, chip) {

        });

        $(".chips-placeholder").material_chip({
            placeholder: "Enter a tag",
            secondaryPlaceholder: "+Tag",
            data: _data
        });
    }

});
