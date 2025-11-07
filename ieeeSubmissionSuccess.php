<?php
require "form_includes/form_constants_both.php";
session_start();

if (!isset($_SESSION["ArtId"]) || !isset($_SESSION["AuthName"])) {
    $url = $EVENT_FORM_LINK . "ieeeReg.php";
    //    echo $url;
    //    exit;
    echo '<script type="text/javascript">
                    alert("Kindly submit the article first.");
                    window.location.href = "' .
        $url .
        '";
                  </script>';
    exit();
}

$ArtId = htmlspecialchars($_SESSION["ArtId"]);
$AuthName = htmlspecialchars($_SESSION["AuthName"]);

// Optional: clear session data if you don’t need it further
// unset($_SESSION['ArtId'], $_SESSION['AuthName']);
?>
<style>
    .flag-icon {
        width: 20px;
        height: 15px;
        margin-right: 10px;
        vertical-align: middle;
    }

    .custom-option {
        display: flex;
        align-items: center;
    }
</style>
<?php
//require("includes/form_constants_both.php");

$ret = @$_GET["ret"];

// Fetch del_id and citizen from session if coming back to edit the info
if ($ret == "retds4fu324rn_ed24d3it") {
    $del = $_SESSION["del"] ?? "";
    $cit = $_SESSION["cit"] ?? "";
    if (!isset($_SESSION["vercode_reg"]) || $_SESSION["vercode_reg"] == "") {
        session_destroy();
        echo "<script language='javascript'>alert('Please try again.');</script>";
        echo "<script language='javascript'>window.location.href='https://sci25.supercomputingindia.org';</script>";
        exit();
    }
    require "dbcon_open.php";
} else {
    include "captcha_reg.php";
}

// Validate URL parameters

$assoc_name = @$_GET["assoc_name"];
?>
<?php
$pageStyleCss =
    '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
require "form_includes/reg_form_header.php";
// Retrieve session data
$org = isset($_SESSION["org"]) ? $_SESSION["org"] : "";
$attendeesCount = isset($_SESSION["attendees"]) ? $_SESSION["attendees"] : 1; // Default to 1 attendee if not set
$attendeesData = isset($_SESSION["attendee"]) ? $_SESSION["attendee"] : [];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


<style>
    * {
        font-family: 'Roboto', sans-serif;
        font-size: 1.65rem;
    }

    .selected-flag {
        margin-top: -5px;
    }

    .first-row td {
        background: #acb9ca;
    }

    .second-row td {
        background: #f4b084;
    }

    .third-row td {
        background: #dbdbdb;
    }

    .fourth-row td {
        background: #b4c6e7;
    }

    .fifth-row td {
        background: #00b050;
    }

    .button {
        background-color: #f00;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        border: none;
        color: #FFFFFF;
        padding: 5px 7px;
        /*display: inline-block;
  font-family: Arial;
  font-size: 20px;
  text-align: center;
  text-decoration: none;*/
    }

    @-webkit-keyframes glowing {
        0% {
            background-color: #f00;
            -webkit-box-shadow: 0 0 3px #f00;
        }

        50% {
            background-color: #fff;
            -webkit-box-shadow: 0 0 10px #fff;
        }

        100% {
            background-color: #f00;
            -webkit-box-shadow: 0 0 3px #f00;
        }
    }

    @-moz-keyframes glowing {
        0% {
            background-color: #f00;
            -moz-box-shadow: 0 0 3px #f00;
        }

        50% {
            background-color: #fff;
            -moz-box-shadow: 0 0 10px #fff;
        }

        100% {
            background-color: #f00;
            -moz-box-shadow: 0 0 3px #f00;
        }
    }

    @-o-keyframes glowing {
        0% {
            background-color: #f00;
            box-shadow: 0 0 3px #f00;
        }

        50% {
            background-color: #fff;
            box-shadow: 0 0 10px #fff;
        }

        100% {
            background-color: #f00;
            box-shadow: 0 0 3px #f00;
        }
    }

    @keyframes glowing {
        0% {
            background-color: #f00;
            box-shadow: 0 0 3px #f00;
        }

        50% {
            background-color: #fff;
            box-shadow: 0 0 10px #fff;
        }

        100% {
            background-color: #f00;
            box-shadow: 0 0 3px #f00;
        }
    }

    .button {
        -webkit-animation: glowing 3000ms infinite;
        -moz-animation: glowing 3000ms infinite;
        -o-animation: glowing 3000ms infinite;
        animation: glowing 3000ms infinite;
    }

    @keyframes glowing {
        0% {
            background-color: #f00;
            box-shadow: 0 0 3px #f00;
        }

        50% {
            background-color: #000;
            box-shadow: 0 0 10px #fff;
        }

        100% {
            background-color: #f00;
            box-shadow: 0 0 3px #f00;
        }
    }

    .button {
        animation: glowing 3000ms infinite;
    }

    .align-td {
        text-align: center;
    }
</style>
<style>
    .step {
        display: none;
    }

    .step.active {
        display: block;
    }

    .partner-question-container {
        display: flex;
        align-items: center;
    }

    .partner-question-container label {
        margin-right: 10px;
    }

    /* .radio-group {
        display: flex;
        align-items: center;
    }

    .radio-group label {
        margin-left: 5px;
        margin-right: 15px;
    } */

    .form-control {
        width: 95% !important;
    }
</style>
<style>
    /* Flag container adjustments */
    .iti__flag-container {
        width: 60px;
        position: relative;
        z-index: 3;
    }

    /* Improved dropdown adjustments for mobile */
    @media (max-width: 768px) {
        .iti__country-list {
            position: fixed;
            /* Fixed positioning to ensure it's visible on mobile */
            top: 70px;
            /* Adjust based on the height of the input field */
            left: 10px;
            /* Align dropdown to be close to the input */
            right: 10px;
            max-height: 300px;
            overflow-y: scroll;
            z-index: 1000;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25);
            background-color: #fff;
            border-radius: 8px;
            padding: 5px;
        }

        /* Default styling for desktop view */
        #phone1,
        #phone2,
        #phone3,
        #phone4,
        #phone5,
        #phone6,
        #phone7 {
            width: 100%;
            /* Set to full width */
            padding-left: 80px;
            /* Adjust padding based on the dropdown width */
            font-size: 14px;
            /* Adjust font size for readability on desktop */
        }


        /* Optional: More accessible country list items for mobile */
        .iti__country {
            padding: 10px;
            font-size: 14px;
        }
    }

    .iti__selected-flag {
        z-index: 3;
        position: relative;
        display: inline-flex !important;
        align-items: center;
        height: 100%;
        padding: 0 6px 0 8px;
    }

    .iti {
        position: relative;
        display: block !important;
    }

    .checkbox-row {
        display: flex;
        flex-wrap: wrap;
    }

    .checkbox-item {
        margin-right: 20px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .checkbox-item input[type="checkbox"] {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }

    .checkbox-label {
        font-size: 14px;
    }
</style>

<!-- intl-tel-input CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

<!-- jQuery (required for the plugin) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- intl-tel-input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered" id="registration_form_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase"> Copyright Submission form </span>
                </div>
            </div>
            <div class="portlet-body form">
                            <?php // Show form only if before deadline

                        if (date("Y-m-d H:i") <= "2025-12-13 24:00") { ?>
                            <div id="formContainer">

                            <h2>Copyright Transferred Successfully!</h2>
                            <p>Your copyright has been submitted successfully with the following details:</p>
                            <table style="margin: 0 auto; border-collapse: collapse;">
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ccc;"><strong>Paper ID</strong></td>
                                    <td style="padding: 8px; border: 1px solid #ccc;"><?php echo $ArtId; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #ccc;"><strong>Author Name</strong></td>
                                    <td style="padding: 8px; border: 1px solid #ccc;"><?php echo $AuthName; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    </div>
                        </div>
                        </div>
                        </div>
                    <?php require "form_includes/reg_form_footer.php"; ?>
                <?php } else {echo "<h3>The submission deadline has passed. You can no longer submit articles.</h3>";} ?>
          


<body>

</html>
