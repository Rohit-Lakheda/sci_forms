<?php

session_start();
// ini_set('display_errors', 1);

include 'csrf_token.php';
// session_destroy();
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
require ("form_includes/form_constants_both.php");

$ret = @$_GET['ret'];

// Fetch del_id and citizen from session if coming back to edit the info
if ($ret == "retds4fu324rn_ed24d3it") {
    $del = $_SESSION['del'] ?? '';
    $cit = $_SESSION['cit'] ?? '';
    if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {
        session_destroy();
        echo "<script language='javascript'>alert('Please try again.');</script>";
        echo "<script language='javascript'>window.location.href='https://sci25.supercomputingindia.org';</script>";
        exit;
    }
    require "dbcon_open.php";
} else {
    include('captcha_reg.php');
}

// Retrieve values from session if present
if (empty($del) || empty($cit)) {
    $del = $_GET['del'] ?? '';
    $cit = $_GET['cit'] ?? '';
}

// Validate URL parameters
if (!empty($del) && !empty($cit)) {
    $allowed_del_ids = ['nextgen', 'academia', 'industry', 'government','author'];
    $allowed_citizens = ['ind', 'int'];

    // Sanitize input and validate
    $del = filter_input(INPUT_GET, 'del', FILTER_SANITIZE_STRING);
    $cit = filter_input(INPUT_GET, 'cit', FILTER_SANITIZE_STRING);

    if (in_array($del, $allowed_del_ids) && in_array($cit, $allowed_citizens)) {
        // Set session variables
        $_SESSION['del'] = htmlspecialchars($del, ENT_QUOTES, 'UTF-8');
        $_SESSION['cit'] = htmlspecialchars($cit, ENT_QUOTES, 'UTF-8');
    } else {
        $del = '';
        $cit = '';
    }
}

// Handle missing or invalid parameters
if (empty($del) || empty($cit)) {
    mysqli_close($link);
    echo "<script language='javascript'>alert('Please select ticket type.');</script>";
    echo "<script language='javascript'>window.location.href='https://sci25.supercomputingindia.org';</script>";
    exit();
}

// Validation to ensure that certain delegate types are not allowed
if (
    ($cit == 'int' && ($del == 'nextgen'))  
) {
    mysqli_close($link);
    echo "<script language='javascript'>alert('Please select ticket type.');</script>";
    echo "<script language='javascript'>window.location.href='https://sci25.supercomputingindia.org';</script>";
    exit();
}

// Map parameters to display values
$current_date = date('Y-m-d');
$early_bird_end_date = '2025-10-20';

if ($del == 'nextgen') {
    $del_id = "Next Gen HPC Experience";

    // if ($current_date <= $early_bird_end_date) {
    //     $del_inr = "150000 INR (Early Bird)";
    //     // $del_us = "55 USD (Early Bird)";
    // } else {
    //     $del_inr = "150000 INR ";
    //     // $del_us = "110 USD ";
    // }
} elseif ($del == 'academia') {
    $del_id = "Academia";
    // if ($current_date <= $early_bird_end_date) {
    //     $del_inr = "5000 INR (Early Bird)";
    //     $del_us = "75 USD (Early Bird)";
    // } else {
    //     $del_inr = "10000 INR ";
    //     $del_us = "110 USD ";
    // }
} elseif ($del == 'industry') {
    $del_id = "Industry";
    // if ($current_date <= $early_bird_end_date) {
    //     $del_inr = "7500 INR (Early Bird)";
    //     $del_us = "200 USD (Early Bird)";
    // } else {
    //     $del_inr = "15000 INR ";
    //     $del_us = "220 USD ";
    // }
} elseif ($del == 'government') {
    $del_id = "Government";
    // if ($current_date <= $early_bird_end_date) {
    //     $del_inr = "6000 INR (Early Bird)";
    //     $del_us = "150 USD (Early Bird)";
    // } else {
    //     $del_inr = "12000 INR ";
    //     $del_us = "170 USD ";
    // }
}elseif ($del == 'author') {
    $del_id = "Author";
    // if ($current_date <= $early_bird_end_date) {
    //     $del_inr = "0 INR (Early Bird)";
    //     $del_us = "0 USD (Early Bird)";
    // } else {
    //     $del_inr = "0 INR ";
    //     $del_us = "0 USD ";
    // }
}
else {
    mysqli_close($link);
    echo "<script language='javascript'>alert('Please select ticket type.');</script>";
    echo "<script language='javascript'>window.location.href='https://sci25.supercomputingindia.org';</script>";
    exit();
}

if ($cit == 'ind') {
    $citizen = "Indian";
} elseif ($cit == 'int') {
    $citizen = "Foreign";
} else {
    $citizen = "Indian"; // Default fallback
}



$assoc_name = @$_GET['assoc_name'];

?>
<?php $pageStyleCss = '<link href="forms_assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
require 'form_includes/reg_form_header.php';
// Retrieve session data
$org = isset($_SESSION['org']) ? $_SESSION['org'] : '';
$attendeesCount = isset($_SESSION['attendees']) ? $_SESSION['attendees'] : 1; // Default to 1 attendee if not set
$attendeesData = isset($_SESSION['attendee']) ? $_SESSION['attendee'] : [];

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

        /* Style for disabled attendees dropdown */
        #attendees:disabled {
            background-color: #f5f5f5;
            color: #666;
            cursor: not-allowed;
        }
        .checkbox-list>label.checkbox-inline:first-child, .checkbox>label, .form-horizontal .checkbox>label, .portlet.light .form .form-actions.left, .radio-list>label.radio-inline:first-child {
    padding-left: 20px;
}

.
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
                        <span class="caption-subject font-red bold uppercase"> Attendee(s) Registration Form </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <?php
                    // Show form only if before deadline
                    if (date('Y-m-d H:i') <= '2025-12-13 24:00') {
                    ?>
                        <div id="formContainer">

                            <form action="registration2.php<?php echo !empty($ret) ? '?ret=' . $ret : ''; ?>"
                                class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1"
                                method="post" enctype="multipart/form-data"
                                onsubmit="return validate_registration_form_2();">
                                <input type="hidden" name="del" value="<?php echo $del; ?>">
                                <input type="hidden" name="cit" value="<?php echo $cit; ?>">
                                <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                                <input type="hidden" id="curr" name="curr" value="<?php echo htmlspecialchars($cit); ?>">
                                <input type="hidden" id="promoCodeHidden" name="promoCodeHidden" value="">
                                <input type="hidden" id="vercode" name="vercode"
                                    value="<?php echo $_SESSION["vercode_reg"]; ?>">

                                <div class="form-wizard">
                                    <div class="form-body">
                                        <ul class="nav nav-pills nav-justified steps">
                                            <li class="active">
                                                <a href="#tab1" data-toggle="tab" class="step">
                                                    <span class="number"> 1 </span>
                                                    <span class="desc">
                                                        <i class="fa fa-check"></i> Attendee(s) Information </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" class="step dips-default-cursor">
                                                    <span class="number"> 2 </span>
                                                    <span class="desc">
                                                        <i class="fa fa-check"></i> Preview </span>
                                                </a>
                                            </li>
                                            <?php if (strpos($del, 'inv') !== false) { ?>
                                                <li>
                                                    <a data-toggle="tab" class="step dips-default-cursor">
                                                        <span class="number"> 3 </span>
                                                        <span class="desc">
                                                            <i class="fa fa-check"></i> Confirmation Pending </span>
                                                    </a>
                                                </li>
                                            <?php } else { ?>
                                                <li>
                                                    <a data-toggle="tab" class="step dips-default-cursor">
                                                        <span class="number"> 3 </span>
                                                        <span class="desc">
                                                            <i class="fa fa-check"></i> Receipt </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div id="bar" class="progress progress-striped" role="progressbar">
                                            <div class="progress-bar progress-bar-success"> </div>
                                        </div>
                                        <div style="width:95%; height:auto; margin:0px auto; display:block;"></div>
                                    </div>
                                    <h3 class="block" style="text-align:center;">Provide required information for
                                        registration
                                    </h3>
                                    <div class="form-group" style="display: none;">
                                        <div class="col-md-9">
                                            <table
                                                class="table table-hover1 table-bordered teriff-table col-md-offset-1 col-md-7 main-tariff-table">
                                                <thead>
                                                    <tr bgcolor="#2fa0dd" style="color: #fff;">
                                                        <th colspan="6" style="text-align: center;">Delegate Tariff</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="indian-tariff">Participant</th>
                                                        <th class="international-tariff">Participant</th>
                                                        <th class="indian-tariff">Regular</th>
                                                        <th class="international-tariff">Regular</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!isset($_GET['cit']) || $_GET['cit'] != 'int') { ?>
                                                        <tr>
                                                            <td style="background-color: #e1e1e1;"><strong>Industry
                                                                    Delegates</strong></td>
                                                            <td class="indian-tariff" style="background-color: #e1e1e1;">INR
                                                                7,000</td>
                                                            <td class="international-tariff" style="background-color: #e1e1e1;">
                                                                USD $40</td>
                                                        </tr>
                                                    <?php } ?>
                                                    <?php if (isset($_GET['cit']) && $_GET['cit'] != 'int') { ?>
                                                        <tr>
                                                            <td style="background-color: #e1e1e1;"><strong>Academic
                                                                    Delegates</strong></td>
                                                            <td class="indian-tariff" style="background-color: #e1e1e1;">INR
                                                                6,000</td>
                                                            <td class="international-tariff" style="background-color: #e1e1e1;">
                                                                USD $70</td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td style="background-color: #e1e1e1;"><strong>Students
                                                                (PhD)</strong></td>
                                                        <td class="indian-tariff" style="background-color: #e1e1e1;">INR
                                                            4,500</td>
                                                        <td class="international-tariff" style="background-color: #e1e1e1;">
                                                            USD $50</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #e1e1e1;"><strong>Students
                                                                (PG/B.Tech/UG)</strong></td>
                                                        <td class="indian-tariff" style="background-color: #e1e1e1;">INR
                                                            3,500</td>
                                                        <td class="international-tariff" style="background-color: #e1e1e1;">
                                                            USD $40</td>
                                                    </tr>
                                                    <?php if (!isset($_GET['cit']) || $_GET['cit'] != 'int') { ?>
                                                        <tr>
                                                            <td style="background-color: #e1e1e1;"><strong>Startup</strong></td>
                                                            <td class="indian-tariff" style="background-color: #e1e1e1;">INR
                                                                5,500</td>
                                                            <td class="international-tariff" style="background-color: #e1e1e1;">
                                                                USD $65</td>
                                                        </tr>
                                                    <?php } ?>
                                                    <?php if (isset($_GET['cit']) && $_GET['cit'] != 'ind') { ?>
                                                        <tr>
                                                            <td style="background-color: rgb(225, 225, 225);">
                                                                <strong>International (SAARC/ ASEAN/ African Union)</strong>
                                                            </td>
                                                            <td class="indian-tariff" style="background-color: #e1e1e1;">INR
                                                                12,700</td>
                                                            <td class="international-tariff"
                                                                style="background-color: rgb(225, 225, 225);">USD $150</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: rgb(225, 225, 225);">
                                                                <strong>International (Others)</strong>
                                                            </td>
                                                            <td class="indian-tariff" style="background-color: #e1e1e1;">INR
                                                                17,000</td>
                                                            <td class="international-tariff"
                                                                style="background-color: rgb(225, 225, 225);">USD $200</td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <strong>Note: </strong><br>
                                                            - 18% GST Applicable.<br>
                                                            - Detailed guidelines on abstract submission are available on
                                                            our website.<br>
                                                            - Accommodation charges are to be paid separately. The organizer
                                                            will share the details and assist as needed.<br>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            const indianTariffs = document.querySelectorAll(".indian-tariff");
                                            const internationalTariffs = document.querySelectorAll(".international-tariff");
                                            const cit = "<?php echo isset($_GET['cit']) ? $_GET['cit'] : ''; ?>";

                                            if (cit === "ind") {
                                                indianTariffs.forEach(el => el.style.display = "table-cell");
                                                internationalTariffs.forEach(el => el.style.display = "none");
                                            } else {
                                                indianTariffs.forEach(el => el.style.display = "none");
                                                internationalTariffs.forEach(el => el.style.display = "table-cell");
                                            }
                                        });
                                    </script>
                                    <!-- <div class="form-group">
                                        <label class="col-md-3 control-label">Price<span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6" style="padding-top:7px;">
                                            <span><strong id="del_id_text"
                                                    data-original="<?php echo $cit; ?>"><?php echo $cit; ?></strong></span>
                                            <input type="hidden" class="form-control" name="cata" id="cata"
                                                value="<?php echo $del_id; ?>" required="required" />
                                        </div>
                                    </div> -->
                                     <div class="form-group">
                                        <label class="col-md-3 control-label">Category Type<span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6" style="padding-top:7px;">
                                            <span><strong id="del_id_text"
                                                    data-original="<?php echo $del_id; ?>"><?php echo $del_id; ?></strong></span>
                                            <input type="hidden" class="form-control" name="cata" id="cata"
                                                value="<?php echo $del_id; ?>" required="required" />
                                        </div>
                                    </div>
                                    <?php 
                                    if($del=='industry'){
                                        $label1= 'Select Domain';
                                                    $sectorList = array(
                                                        'High Performance Computing' => 'High Performance Computing',
                                                        'Artificial Intelligence' => 'Artificial Intelligence',
                                                        'Quantum Computing' => 'Quantum Computing',
                                                        'Chip Design' => 'Chip Design',
                                                        'Startups' => 'Startups',
                                                        'MSMEs' => 'MSMEs',
                                                        'Others' => 'Others'
                                                    );
                                                }
                                                else if($del=='academia'){
                                                    $label1= 'Select Delegate Type';
                                                    $sectorList = array(
                                                        'Student' => 'Student',
                                                        'Professor/Faculty' => 'Professor/Faculty',
                                                        'Others' => 'Others'
                                                    ); 
                                                }
                                                else if($del=='government'){
                                                    $label1= 'Select Domain';
                                                    $sectorList = array(
                                                        'High Performance Computing' => 'High Performance Computing',
                                                        'Artificial Intelligence' => 'Artificial Intelligence',
                                                        'Quantum Computing' => 'Quantum Computing',
                                                        'Chip Design' => 'Chip Design',
                                                        'Startups' => 'Startups',
                                                        'MSMEs' => 'MSMEs',
                                                        'Others' => 'Others'
                                                    ); 
                                                }
                                                else if($del=='nextgen'){
                                                    $label1= 'Select Domain';
                                                    $sectorList = array(
                                                        'Research & Academia' => 'Research & Academia',
                                                        'Others' => 'Others'
                                                    ); 
                                                }
                                                else{
                                                    $label1= 'Select Domain';
                                                    $sectorList = array(
                                                        'High Performance Computing' => 'High Performance Computing',
                                                        'Artificial Intelligence' => 'Artificial Intelligence',
                                                        'Quantum Computing' => 'Quantum Computing',
                                                        'Government / Public Sector' => 'Government / Public Sector',
                                                        'Chip Design' => 'Chip Design',
                                                        'Research & Academia' => 'Research & Academia',
                                                        'Startups' => 'Startups',
                                                        'MSMEs' => 'MSMEs',
                                                        'Others' => 'Others'
                                                    ); 
                                                } 
                                    
                                    if($del!='nextgen'){ ?>   
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Domain <span
                                                class="required">*</span><br></label>
                                        <div class="col-md-6">
                                            <select id="sector" name="sector" class="form-control"
                                                onchange="toggleOtherSectorInput()" required>
                                                <option value="">-- Select Domain --</option>
                                                <?php
                                                

                                                foreach ($sectorList as $key => $value) {
                                                    $selected = isset($_SESSION['sector']) && $_SESSION['sector'] == $key ? 'selected' : '';
                                                    echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
                                                }
                                                ?>
                                            </select>

                                            <!-- Input box for "Other" option -->
                                            <div id="other-sector" style="display:none; margin-top: 10px;">
                                                <label class="control-label">Please specify :</label>
                                                <input type="text" id="other-sector-input" name="other-sector-input"
                                                    class="form-control"
                                                    value="<?php echo isset($_SESSION['other-sector-input']) ? htmlspecialchars($_SESSION['other-sector-input']) : ''; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <script>
                                        function toggleOtherSectorInput() {
                                            const sectorDropdown = document.getElementById('sector');
                                            const otherSectorDiv = document.getElementById('other-sector');
                                            const otherSectorInput = document.getElementById('other-sector-input');

                                            if (sectorDropdown.value === 'Others') {
                                                otherSectorDiv.style.display = 'block';
                                                otherSectorInput.required = true;
                                            } else {
                                                otherSectorDiv.style.display = 'none';
                                                otherSectorInput.required = false;
                                                otherSectorInput.value = ''; // Clear the input when hidden
                                            }
                                        }
                                    </script>


                                   

                                      <?php if ($del != 'nextgen' && $del != 'author') { ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Select Pass Type <span class="dips-required">*</span></label>
                                            <div class="col-md-6">
                                                <select class="form-control" name="pass_type" id="pass_type" required>
                                                    <option value="">-- Select Pass Type --</option>
                                                    <option value="workshop">2-Day Delegate Pass</option>
                                                    <option value="exhibition">Exhibition Pass</option>
                                                    <option value="technical">Technical Program + Workshop + Tutorial + Exhibition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    <!-- if Select Pass Type == Exhibition Pass then select Day  -->
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const passTypeDropdown = document.getElementById('pass_type');
                                            const exhibitionDayGroup = document.getElementById('exhibition_day_group');
                                            const ieeeSection = document.getElementById('del_type');
                                            const ieeeNumberGroup = document.getElementById('ieee_number_group');
                                            
                                            if (exhibitionDayGroup) {
                                                exhibitionDayGroup.style.display = 'none'; // Hide on load
                                            }
                                            
                                            // Function to toggle IEEE section visibility
                                            function toggleIEEESection() {
                                                if (ieeeSection) {
                                                    // If pass_type dropdown exists and is set to 'workshop', hide IEEE section
                                                    if (passTypeDropdown && passTypeDropdown.value === 'workshop') {
                                                        // Hide IEEE section for 2-Day Delegate Pass
                                                        ieeeSection.style.display = 'none';
                                                        if (ieeeNumberGroup) {
                                                            ieeeNumberGroup.style.display = 'none';
                                                        }
                                                        // Reset IEEE values
                                                        const yesRadio = document.getElementById('yes1');
                                                        const noRadio = document.getElementById('no1');
                                                        if (noRadio) noRadio.checked = true;
                                                        if (yesRadio) yesRadio.checked = false;
                                                        const ieeeNumberInput = document.getElementById('ieee_member_number');
                                                        if (ieeeNumberInput) {
                                                            ieeeNumberInput.value = '';
                                                            ieeeNumberInput.required = false;
                                                        }
                                                    } else {
                                                        // Show IEEE section for other pass types or when pass_type doesn't exist
                                                        ieeeSection.style.display = 'block';
                                                        // Uncheck both radio buttons so no default is selected
                                                        const yesRadio = document.getElementById('yes1');
                                                        const noRadio = document.getElementById('no1');
                                                        if (yesRadio) yesRadio.checked = false;
                                                        if (noRadio) noRadio.checked = false;
                                                    }
                                                }
                                            }
                                            
                                            // Initialize IEEE section visibility on page load
                                            toggleIEEESection();
                                            
                                            // Only add event listener if pass_type dropdown exists
                                            if (passTypeDropdown) {
                                                passTypeDropdown.addEventListener('change', function() {
                                                    if (exhibitionDayGroup) {
                                                        if (this.value === 'exhibition' || this.value === 'workshop') {
                                                            exhibitionDayGroup.style.display = 'block';
                                                            const exhibitionDay = document.getElementById('exhibition_day');
                                                            if (exhibitionDay) {
                                                                exhibitionDay.required = true;
                                                            }
                                                        } else {
                                                            exhibitionDayGroup.style.display = 'none';
                                                            const exhibitionDay = document.getElementById('exhibition_day');
                                                            if (exhibitionDay) {
                                                                exhibitionDay.value = ''; // Reset selection
                                                                exhibitionDay.required = false;
                                                            }
                                                        }
                                                    }
                                                    
                                                    // Toggle IEEE section based on pass type
                                                    toggleIEEESection();
                                                });
                                            }
                                        });
                                    </script>

                                    <!-- Paper Id -->
                                     <?php if ($del == 'author') { ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Paper Id<span class="dips-required">*</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="paper_id" id="paper_id"
                                                value="<?php echo isset($_SESSION['paper_id']) ? htmlspecialchars($_SESSION['paper_id']) : ''; ?>"
                                                maxlength="50" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-md-3 control-label">Select No of Page <span class="dips-required">*</span></label>
                                            <div class="col-md-6">
                                                <select class="form-control" name="pagesNumber" id="pagesNumber" required>
                                                    <option value="">-- Select No of Page --</option>
                                                    <option value="6">6 Page</option>
                                                    <option value="7">7 Pages</option>
                                                    <option value="8">8 Pages</option>
                                                    <option value="9">9 Pages</option>
                                                    <option value="10">10 Pages</option>
                                                    <option value="11">11 Pages</option>
                                                </select>
                                            </div>
                                        </div>

                                     <!-- If no of pages are selected more than 8 then display extra 200 for india is applicable and then
                                      add 200 for foreign -->
                                    <!-- Extra Page Charges Display for Author -->
                                    <div id="extra-page-charges" style="display:none; margin-top:10px;">
                                        <div class="alert alert-warning" style="font-size: 1.2rem;">
                                            <span id="extra-page-charges-text"></span>
                                        </div>
                                    </div>
                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var pagesDropdown = document.getElementById('pagesNumber');
                                        var chargesDiv = document.getElementById('extra-page-charges');
                                        var chargesText = document.getElementById('extra-page-charges-text');
                                        var citizen = '<?php echo $cit; ?>';

                                        function updateExtraPageCharges() {
                                            var selectedPages = parseInt(pagesDropdown.value, 10);
                                            if (selectedPages > 8) {
                                                chargesDiv.style.display = "block";
                                                if (citizen === 'ind') {
                                                    chargesText.textContent = "Additional page charges: $200 per page. ";
                                                } else if (citizen === 'int') {
                                                    chargesText.textContent = "Additional page charges: $200 per page.";
                                                } else {
                                                    chargesText.textContent = "";
                                                }
                                            } else {
                                                chargesDiv.style.display = "none";
                                                chargesText.textContent = "";
                                            }
                                        }

                                        pagesDropdown.addEventListener('change', updateExtraPageCharges);
                                        updateExtraPageCharges();
                                    });
                                    </script>

                                    <?php } ?>

                                    <div class="form-group" id="exhibition_day_group">
                                        <label class="col-md-3 control-label">Select Day <span class="dips-required">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="exhibition_day" id="exhibition_day">
                                                <option value="">-- Select Day --</option>
                                                <option value="Day1">Day 1 (9-12-2025)</option>
                                                <option value="Day2">Day 2 (10-12-2025)</option>
                                            </select>
                                            <!-- Hidden inputs for storing all three days when Exhibition Pass is selected -->
                                            <input type="hidden" name="exhibition_day_all" id="exhibition_day_all" value="">
                                        </div>
                                    </div>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const passTypeDropdown = document.getElementById('pass_type');
                                        const exhibitionDayDropdown = document.getElementById('exhibition_day');
                                        const exhibitionDayAllInput = document.getElementById('exhibition_day_all');
                                        
                                        function updateExhibitionDayOptions() {
                                            const passType = passTypeDropdown ? passTypeDropdown.value : '';
                                            
                                            if (!exhibitionDayDropdown) return;
                                            
                                            // Clear existing options
                                            exhibitionDayDropdown.innerHTML = '<option value="">-- Select Day --</option>';
                                            
                                            if (passType === 'exhibition') {
                                                // For exhibition pass, show all three days as selected
                                                // Display all three days but save all of them to database
                                                exhibitionDayDropdown.innerHTML += '<option value="Day2,Day3,Day4" selected>Day 2 (10-12-2025), Day 3 (11-12-2025), Day 4 (12-12-2025)</option>';
                                                
                                                // Store all three days in hidden input as comma-separated values
                                                if (exhibitionDayAllInput) {
                                                    exhibitionDayAllInput.value = 'Day2,Day3,Day4';
                                                }
                                                
                                                // Set the dropdown to the combined value which will be saved to database
                                                exhibitionDayDropdown.value = 'Day2,Day3,Day4';
                                                
                                                // Make the dropdown disabled/readonly since all days are automatically selected
                                                exhibitionDayDropdown.disabled = false; // Keep it enabled so it submits the value
                                                exhibitionDayDropdown.style.backgroundColor = '#f5f5f5';
                                            } else if (passType === 'workshop') {
                                                // For 2-Day Delegate Pass (workshop), show 2-day combinations
                                                exhibitionDayDropdown.innerHTML += '<option value="Day1,Day2">9-10 Dec (Day 1 - Day 2)</option>';
                                                exhibitionDayDropdown.innerHTML += '<option value="Day2,Day3">10-11 Dec (Day 2 - Day 3)</option>';
                                                exhibitionDayDropdown.innerHTML += '<option value="Day3,Day4">11-12 Dec (Day 3 - Day 4)</option>';
                                                
                                                // Clear the hidden input for workshop passes
                                                if (exhibitionDayAllInput) {
                                                    exhibitionDayAllInput.value = '';
                                                }
                                                
                                                // Reset styling
                                                exhibitionDayDropdown.style.backgroundColor = '';
                                                
                                                // Remove required attribute from pass_time_slot dropdown since we use checkboxes
                                                const passTimeSlotSelect = document.getElementById('pass_time_slot');
                                                if (passTimeSlotSelect) {
                                                    passTimeSlotSelect.removeAttribute('required');
                                                    passTimeSlotSelect.style.display = 'none';
                                                }
                                                
                                                // Also remove required from time_slot select (for nextgen)
                                                const timeSlotSelect = document.getElementById('time_slot');
                                                if (timeSlotSelect) {
                                                    timeSlotSelect.removeAttribute('required');
                                                }
                                            } else {
                                                // For other pass types, show Day1 and Day2
                                                exhibitionDayDropdown.innerHTML += '<option value="Day1">Day 1 (9-12-2025)</option>';
                                                exhibitionDayDropdown.innerHTML += '<option value="Day2">Day 2 (10-12-2025)</option>';
                                                
                                                // Clear the hidden input for non-exhibition passes
                                                if (exhibitionDayAllInput) {
                                                    exhibitionDayAllInput.value = '';
                                                }
                                                
                                                // Reset styling for non-exhibition passes
                                                exhibitionDayDropdown.style.backgroundColor = '';
                                            }
                                            
                                            // Toggle IEEE section visibility based on pass type
                                            const ieeeSection = document.getElementById('del_type');
                                            const ieeeNumberGroup = document.getElementById('ieee_number_group');
                                            if (ieeeSection) {
                                                if (passType === 'workshop') {
                                                    // Hide IEEE section for 2-Day Delegate Pass
                                                    ieeeSection.style.display = 'none';
                                                    if (ieeeNumberGroup) {
                                                        ieeeNumberGroup.style.display = 'none';
                                                    }
                                                    // Reset IEEE values
                                                    const yesRadio = document.getElementById('yes1');
                                                    const noRadio = document.getElementById('no1');
                                                    if (noRadio) noRadio.checked = true;
                                                    if (yesRadio) yesRadio.checked = false;
                                                    const ieeeNumberInput = document.getElementById('ieee_member_number');
                                                    if (ieeeNumberInput) {
                                                        ieeeNumberInput.value = '';
                                                        ieeeNumberInput.required = false;
                                                    }
                                                } else {
                                                    // Show IEEE section for other pass types
                                                    ieeeSection.style.display = 'block';
                                                    // Uncheck both radio buttons so no default is selected
                                                    const yesRadio = document.getElementById('yes1');
                                                    const noRadio = document.getElementById('no1');
                                                    if (yesRadio) yesRadio.checked = false;
                                                    if (noRadio) noRadio.checked = false;
                                                }
                                            }
                                        }
                                        
                                        if (passTypeDropdown) {
                                            passTypeDropdown.addEventListener('change', updateExhibitionDayOptions);
                                            // Initialize on page load
                                            updateExhibitionDayOptions();
                                            
                                            // Also ensure required is removed on initial load if workshop is selected
                                            const initialPassType = passTypeDropdown.value;
                                            if (initialPassType === 'workshop') {
                                                const passTimeSlotSelect = document.getElementById('pass_time_slot');
                                                if (passTimeSlotSelect) {
                                                    passTimeSlotSelect.removeAttribute('required');
                                                    passTimeSlotSelect.style.display = 'none';
                                                }
                                                const timeSlotSelect = document.getElementById('time_slot');
                                                if (timeSlotSelect) {
                                                    timeSlotSelect.removeAttribute('required');
                                                }
                                            }
                                        }
                                        
                                        // Handle form submission - ensure all three days are saved for Exhibition Pass
                                        const form = document.querySelector('form');
                                        if (form) {
                                            form.addEventListener('submit', function(e) {
                                                const passType = passTypeDropdown ? passTypeDropdown.value : '';
                                                if (passType === 'exhibition') {
                                                    // Ensure all three days are saved as comma-separated value
                                                    const allDays = 'Day2,Day3,Day4';
                                                    // Set the main exhibition_day field to contain all days
                                                    // This will be submitted to the database
                                                    exhibitionDayDropdown.value = allDays;
                                                    
                                                    // Also set the hidden field for backup
                                                    if (exhibitionDayAllInput) {
                                                        exhibitionDayAllInput.value = allDays;
                                                    }
                                                }
                                            });
                                        }
                                    });
                                    </script>

                                    <div class="form-group" id="pass_time_slot_group" style="display:none;">
                                        <label class="col-md-3 control-label">Select Time Slots <span class="dips-required">*</span><br>
                                            <small style="font-size: 12px; font-weight: normal;">Select one option per time slot row (only Tutorials and Workshops are selectable)</small>
                                        </label>
                                        <div class="col-md-9">
                                            <div id="time_slot_tables_container" style="overflow-x: auto;">
                                                <!-- Time slot tables will be dynamically generated here -->
                                            </div>
                                            
                                            <!-- Hidden input to store JSON data -->
                                            <input type="hidden" name="time_slot" id="time_slot_hidden" value="">
                                            
                                            <!-- Error message for validation -->
                                            <div id="time_slot_error" style="color: red; display: none; font-size: 12px; margin-top: 5px;">
                                                Please select at least one time slot from each selected day.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Food and Kit Options - Only for 2-Day Delegate Pass -->
                                    <div class="form-group" id="food_kit_group" style="display:none;">
                                        <label class="col-md-3 control-label">Additional Options</label>
                                        <div class="col-md-6">
                                            <div class="checkbox" style="margin-bottom: 10px;">
                                                <label>
                                                    <input type="checkbox" id="food_checkbox" value="Yes" 
                                                           onchange="updateFoodKitValues()">
                                                    Food
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="kit_checkbox" value="Yes" 
                                                           onchange="updateFoodKitValues()">
                                                    Kit
                                                </label>
                                            </div>
                                            
                                            <!-- Hidden inputs to store values for database -->
                                            <input type="hidden" name="food" id="food_hidden" value="No">
                                            <input type="hidden" name="kit" id="kit_hidden" value="No">
                                            <!-- Hidden inputs to store amounts for payment calculation -->
                                            <input type="hidden" name="food_amount" id="food_amount_hidden" value="0">
                                            <input type="hidden" name="kit_amount" id="kit_amount_hidden" value="0">
                                            
                                            <!-- Display summary of additional amounts -->
                                            <div id="additional_options_summary" style="margin-top: 15px; padding: 10px; background-color: #f5f5f5; border-radius: 4px; display: none;">
                                                <strong>Additional Options Summary:</strong><br>
                                                <span id="food_summary" style="display: none;">Food: ₹2,000<br></span>
                                                <span id="kit_summary" style="display: none;">Kit: ₹1,000<br></span>
                                                <strong>Total Additional: ₹<span id="total_additional_amount">0</span></strong>
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        .time-slot-table {
                                            width: 100%;
                                            border-collapse: collapse;
                                            margin-bottom: 30px;
                                            font-size: 13px;
                                        }
                                        .time-slot-table th {
                                            background-color: #2fa0dd;
                                            color: white;
                                            padding: 10px;
                                            text-align: center;
                                            border: 1px solid #ddd;
                                            font-weight: bold;
                                        }
                                        .time-slot-table td {
                                            padding: 8px;
                                            border: 1px solid #ddd;
                                            text-align: center;
                                        }
                                        .time-slot-table tr:nth-child(even) {
                                            background-color: #f9f9f9;
                                        }
                                        .time-slot-table .time-cell {
                                            font-weight: bold;
                                            background-color: #f0f0f0;
                                            width: 150px;
                                        }
                                        .time-slot-table .selectable-cell {
                                            cursor: pointer;
                                        }
                                        .time-slot-table .selectable-cell:hover {
                                            background-color: #e8f4f8;
                                        }
                                        .time-slot-table .static-cell {
                                            background-color: #fff;
                                            font-style: italic;
                                            color: #666;
                                        }
                                        .time-slot-table input[type="radio"] {
                                            margin: 0;
                                            cursor: pointer;
                                        }
                                        .day-header {
                                            font-size: 18px;
                                            font-weight: bold;
                                            margin: 20px 0 10px 0;
                                            color: #2fa0dd;
                                        }
                                    </style>
                                    
                                    <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const exhibitionDayDropdown = document.getElementById('exhibition_day');
                                        const timeSlotHidden = document.getElementById('time_slot_hidden');
                                        const passTypeDropdown = document.getElementById('pass_type');
                                        const foodKitGroup = document.getElementById('food_kit_group');
                                        const passTimeSlotGroup = document.getElementById('pass_time_slot_group');
                                        const tablesContainer = document.getElementById('time_slot_tables_container');

                                        // Schedule data structure
                                        const scheduleData = {
                                            'Day1': {
                                                title: 'Day 1 - Tuesday, 9th December 2025',
                                                headers: ['Time', 'HALL 1', 'HALL 2', 'HALL 3', 'HALL 4', 'HALL 5'],
                                                rows: [
                                                    {
                                                        time: '10:00 AM - 11:30 AM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day1-10:00-11:30-HALL1', label: 'Tutorial 1'},
                                                            {type: 'selectable', value: 'Day1-10:00-11:30-HALL2', label: 'Tutorial 2'},
                                                            {type: 'selectable', value: 'Day1-10:00-11:30-HALL3', label: 'Tutorial 3'},
                                                            {type: 'selectable', value: 'Day1-10:00-11:30-HALL4', label: 'Workshop 1'},
                                                            {type: 'selectable', value: 'Day1-10:00-11:30-HALL5', label: 'Workshop 2'}
                                                        ]
                                                    },
                                                    {
                                                        time: '11:30 AM - 01:00 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day1-11:30-01:00-HALL1', label: 'Tutorial 4'},
                                                            {type: 'selectable', value: 'Day1-11:30-01:00-HALL2', label: 'Tutorial 5'},
                                                            {type: 'selectable', value: 'Day1-11:30-01:00-HALL3', label: 'Tutorial 6'},
                                                            {type: 'selectable', value: 'Day1-11:30-01:00-HALL4', label: 'Workshop 3'},
                                                            {type: 'selectable', value: 'Day1-11:30-01:00-HALL5', label: 'Workshop 4'}
                                                        ]
                                                    },
                                                    {
                                                        time: '01:00 PM - 02:00 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Lunch & Networking Break', colspan: 5}
                                                        ]
                                                    },
                                                    {
                                                        time: '02:00 PM - 03:30 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day1-02:00-03:30-HALL1', label: 'Tutorial 7'},
                                                            {type: 'selectable', value: 'Day1-02:00-03:30-HALL2', label: 'Tutorial 8'},
                                                            {type: 'selectable', value: 'Day1-02:00-03:30-HALL3', label: 'Workshop 5'},
                                                            {type: 'selectable', value: 'Day1-02:00-03:30-HALL4', label: 'Workshop 6'},
                                                            {type: 'selectable', value: 'Day1-02:00-03:30-HALL5', label: 'Workshop 7'}
                                                        ]
                                                    },
                                                    {
                                                        time: '04:00 PM - 05:30 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day1-04:00-05:30-HALL1', label: 'Tutorial 9'},
                                                            {type: 'selectable', value: 'Day1-04:00-05:30-HALL2', label: 'Tutorial 10'},
                                                            {type: 'selectable', value: 'Day1-04:00-05:30-HALL3', label: 'Workshop 8'},
                                                            {type: 'selectable', value: 'Day1-04:00-05:30-HALL4', label: 'Workshop 9'},
                                                            {type: 'selectable', value: 'Day1-04:00-05:30-HALL5', label: 'Workshop 10'}
                                                        ]
                                                    },
                                                    {
                                                        time: '06:00 PM - 07:30 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Exhibitions Opening', colspan: 5}
                                                        ]
                                                    }
                                                ]
                                            },
                                            'Day2': {
                                                title: 'Day 2 | Wednesday, 10th December 2025',
                                                headers: ['Time', 'Auditorium HALL'],
                                                rows: [
                                                    {
                                                        time: '09:00 AM - 10:30 AM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Welcome and Registration', colspan: 1}
                                                        ]
                                                    },
                                                    {
                                                        time: '10:30 AM - 11:30 AM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Inauguration of the Event', colspan: 1}
                                                        ]
                                                    },
                                                    {
                                                        time: '11:35 AM - 12:15 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Inauguration of Exhibition', colspan: 1}
                                                        ]
                                                    },
                                                    {
                                                        time: '12:30 PM - 01:00 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Opening Keynote Talk', colspan: 1}
                                                        ]
                                                    },
                                                    {
                                                        time: '01:00 PM - 02:00 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Lunch & Networking Break', colspan: 1}
                                                        ]
                                                    }
                                                ],
                                                headers2: ['Time', 'HALL 1', 'HALL 2', 'HALL 3', 'HALL 4', 'HALL 5'],
                                                rows2: [
                                                    {
                                                        time: '02:00 PM - 02:50 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day2-02:00-02:50-HALL1', label: 'Tutorial 11'},
                                                            {type: 'selectable', value: 'Day2-02:00-02:50-HALL2', label: 'Tutorial 12'},
                                                            {type: 'selectable', value: 'Day2-02:00-02:50-HALL3', label: 'Workshop 11'},
                                                            {type: 'selectable', value: 'Day2-02:00-02:50-HALL4', label: 'Workshop 12'},
                                                            {type: 'selectable', value: 'Day2-02:00-02:50-HALL5', label: 'Workshop 13'}
                                                        ]
                                                    },
                                                    {
                                                        time: '03:00 PM - 03:50 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day2-03:00-03:50-HALL1', label: 'Tutorial 13'},
                                                            {type: 'selectable', value: 'Day2-03:00-03:50-HALL2', label: 'Tutorial 14'},
                                                            {type: 'selectable', value: 'Day2-03:00-03:50-HALL3', label: 'Workshop 14'},
                                                            {type: 'selectable', value: 'Day2-03:00-03:50-HALL4', label: 'Workshop 15'},
                                                            {type: 'selectable', value: 'Day2-03:00-03:50-HALL5', label: 'Workshop 16'}
                                                        ]
                                                    },
                                                    {
                                                        time: '04:00 PM - 04:50 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day2-04:00-04:50-HALL1', label: 'Tutorial 15'},
                                                            {type: 'selectable', value: 'Day2-04:00-04:50-HALL2', label: 'Tutorial 16'},
                                                            {type: 'selectable', value: 'Day2-04:00-04:50-HALL3', label: 'Workshop 17'},
                                                            {type: 'selectable', value: 'Day2-04:00-04:50-HALL4', label: 'Workshop 18'},
                                                            {type: 'selectable', value: 'Day2-04:00-04:50-HALL5', label: 'Workshop 19'}
                                                        ]
                                                    },
                                                    {
                                                        time: '05:00 PM - 05:50 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day2-05:00-05:50-HALL1', label: 'Tutorial 17'},
                                                            {type: 'selectable', value: 'Day2-05:00-05:50-HALL2', label: 'Tutorial 18'},
                                                            {type: 'selectable', value: 'Day2-05:00-05:50-HALL3', label: 'Workshop 20'},
                                                            {type: 'selectable', value: 'Day2-05:00-05:50-HALL4', label: 'Workshop 21'},
                                                            {type: 'selectable', value: 'Day2-05:00-05:50-HALL5', label: 'Workshop 22'}
                                                        ]
                                                    },
                                                    {
                                                        time: '06:00 PM - 07:30 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Gala Dinner', colspan: 5}
                                                        ]
                                                    }
                                                ]
                                            },
                                            'Day3': {
                                                title: 'Day 3 | Thursday, 11th December 2025',
                                                headers: ['Time', 'HALL 1', 'HALL 2', 'HALL 3', 'HALL 4', 'HALL 5'],
                                                rows: [
                                                    {
                                                        time: '10:00 AM - 11:30 AM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day3-10:00-11:30-HALL1', label: 'Opening Session'},
                                                            {type: 'selectable', value: 'Day3-10:00-11:30-HALL2', label: 'Keynote'},
                                                            {type: 'selectable', value: 'Day3-10:00-11:30-HALL3', label: 'Workshop 23'},
                                                            {type: 'selectable', value: 'Day3-10:00-11:30-HALL4', label: 'Workshop 24'},
                                                            {type: 'selectable', value: 'Day3-10:00-11:30-HALL5', label: 'Workshop 25'}
                                                        ]
                                                    },
                                                    {
                                                        time: '11:30 AM - 01:00 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day3-11:30-01:00-HALL1', label: 'Research Track'},
                                                            {type: 'selectable', value: 'Day3-11:30-01:00-HALL2', label: 'Parallel Track'},
                                                            {type: 'selectable', value: 'Day3-11:30-01:00-HALL3', label: 'BoF Session'},
                                                            {type: 'selectable', value: 'Day3-11:30-01:00-HALL4', label: 'Workshop 26'},
                                                            {type: 'selectable', value: 'Day3-11:30-01:00-HALL5', label: 'Workshop 27'}
                                                        ]
                                                    },
                                                    {
                                                        time: '01:00 PM - 02:00 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Lunch & Networking Break', colspan: 5}
                                                        ]
                                                    },
                                                    {
                                                        time: '02:00 PM - 03:30 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day3-02:00-03:30-HALL1', label: 'Invited Talk'},
                                                            {type: 'selectable', value: 'Day3-02:00-03:30-HALL2', label: 'Research Track'},
                                                            {type: 'selectable', value: 'Day3-02:00-03:30-HALL3', label: 'Parallel Track'},
                                                            {type: 'selectable', value: 'Day3-02:00-03:30-HALL4', label: 'BoF Session'},
                                                            {type: 'selectable', value: 'Day3-02:00-03:30-HALL5', label: 'BoF Session'}
                                                        ]
                                                    },
                                                    {
                                                        time: '04:00 PM - 05:30 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day3-04:00-05:30-HALL1', label: 'Invited Talk'},
                                                            {type: 'selectable', value: 'Day3-04:00-05:30-HALL2', label: 'Research Track'},
                                                            {type: 'selectable', value: 'Day3-04:00-05:30-HALL3', label: 'Parallel Track'},
                                                            {type: 'selectable', value: 'Day3-04:00-05:30-HALL4', label: 'BoF Session'},
                                                            {type: 'selectable', value: 'Day3-04:00-05:30-HALL5', label: 'BoF Session'}
                                                        ]
                                                    },
                                                    {
                                                        time: '06:00 PM - 07:30 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Networking Dinner', colspan: 5}
                                                        ]
                                                    },
                                                    {
                                                        time: '',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Visit to HPC Param Facility', colspan: 5}
                                                        ]
                                                    },
                                                    {
                                                        time: '',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Local Sightseeing and Departure', colspan: 5}
                                                        ]
                                                    }
                                                ]
                                            },
                                            'Day4': {
                                                title: 'Day 4: Friday, 12 December, 2025',
                                                headers: ['Time', 'HALL 1', 'HALL 2', 'HALL 3', 'HALL 4'],
                                                rows: [
                                                    {
                                                        time: '10:00 AM - 11:30 AM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day4-10:00-11:30-HALL1', label: 'Plenary Talk'},
                                                            {type: 'selectable', value: 'Day4-10:00-11:30-HALL2', label: 'Research Track'},
                                                            {type: 'selectable', value: 'Day4-10:00-11:30-HALL3', label: 'Invited Talk'},
                                                            {type: 'selectable', value: 'Day4-10:00-11:30-HALL4', label: 'Invited Talk'}
                                                        ]
                                                    },
                                                    {
                                                        time: '11:30 AM - 01:00 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day4-11:30-01:00-HALL1', label: 'Plenary Talk'},
                                                            {type: 'selectable', value: 'Day4-11:30-01:00-HALL2', label: 'Parallel Track'},
                                                            {type: 'selectable', value: 'Day4-11:30-01:00-HALL3', label: 'Research Track'},
                                                            {type: 'selectable', value: 'Day4-11:30-01:00-HALL4', label: 'Research Track'}
                                                        ]
                                                    },
                                                    {
                                                        time: '01:00 PM - 02:00 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Lunch & Networking Break', colspan: 4}
                                                        ]
                                                    },
                                                    {
                                                        time: '02:00 PM - 03:30 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day4-02:00-03:30-HALL1', label: 'Plenary Talk'},
                                                            {type: 'selectable', value: 'Day4-02:00-03:30-HALL2', label: 'BoF Session'},
                                                            {type: 'selectable', value: 'Day4-02:00-03:30-HALL3', label: 'Parallel Track'},
                                                            {type: 'selectable', value: 'Day4-02:00-03:30-HALL4', label: 'Parallel Track'}
                                                        ]
                                                    },
                                                    {
                                                        time: '04:00 PM - 05:30 PM',
                                                        cells: [
                                                            {type: 'selectable', value: 'Day4-04:00-05:30-HALL1', label: 'Plenary Talk'},
                                                            {type: 'selectable', value: 'Day4-04:00-05:30-HALL2', label: 'Research Track'},
                                                            {type: 'selectable', value: 'Day4-04:00-05:30-HALL3', label: 'BoF Session'},
                                                            {type: 'selectable', value: 'Day4-04:00-05:30-HALL4', label: 'BoF Session'}
                                                        ]
                                                    },
                                                    {
                                                        time: '06:00 PM - 07:30 PM',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Networking Dinner', colspan: 4}
                                                        ]
                                                    },
                                                    {
                                                        time: '',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Posters on Display', colspan: 4}
                                                        ]
                                                    },
                                                    {
                                                        time: '',
                                                        cells: [
                                                            {type: 'static', value: '', label: 'Exhibitions', colspan: 4}
                                                        ]
                                                    }
                                                ]
                                            }
                                        };

                                        // Function to create table for a day
                                        function createDayTable(dayKey) {
                                            const dayData = scheduleData[dayKey];
                                            if (!dayData) return '';

                                            let html = `<div class="day-header">${dayData.title}</div>`;
                                            html += '<table class="time-slot-table">';
                                            html += '<thead><tr>';
                                            dayData.headers.forEach(header => {
                                                html += `<th>${header}</th>`;
                                            });
                                            html += '</tr></thead><tbody>';

                                            dayData.rows.forEach((row, rowIndex) => {
                                                const rowId = `${dayKey}_row_${rowIndex}`;
                                                html += '<tr>';
                                                html += `<td class="time-cell">${row.time}</td>`;
                                                
                                                row.cells.forEach(cell => {
                                                    if (cell.colspan) {
                                                        html += `<td class="static-cell" colspan="${cell.colspan}">${cell.label}</td>`;
                                                    } else if (cell.type === 'selectable') {
                                                        const radioId = `radio_${cell.value.replace(/[^a-zA-Z0-9]/g, '_')}`;
                                                        html += `<td class="selectable-cell">
                                                            <input type="radio" name="time_slot_${rowId}" id="${radioId}" value="${cell.value}" data-label="${cell.label}" data-day="${dayKey}" data-time="${row.time}">
                                                            <label for="${radioId}">${cell.label}</label>
                                                        </td>`;
                                                    } else {
                                                        html += `<td class="static-cell">${cell.label}</td>`;
                                                    }
                                                });
                                                html += '</tr>';
                                            });

                                            html += '</tbody></table>';

                                            // Add second table for Day 2 if exists
                                            if (dayData.rows2 && dayData.headers2) {
                                                html += '<table class="time-slot-table" style="margin-top: 20px;">';
                                                html += '<thead><tr>';
                                                dayData.headers2.forEach(header => {
                                                    html += `<th>${header}</th>`;
                                                });
                                                html += '</tr></thead><tbody>';

                                                dayData.rows2.forEach((row, rowIndex) => {
                                                    const rowId = `${dayKey}_row2_${rowIndex}`;
                                                    html += '<tr>';
                                                    html += `<td class="time-cell">${row.time}</td>`;
                                                    
                                                    row.cells.forEach(cell => {
                                                        if (cell.colspan) {
                                                            html += `<td class="static-cell" colspan="${cell.colspan}">${cell.label}</td>`;
                                                        } else if (cell.type === 'selectable') {
                                                            const radioId = `radio_${cell.value.replace(/[^a-zA-Z0-9]/g, '_')}`;
                                                            html += `<td class="selectable-cell">
                                                                <input type="radio" name="time_slot_${rowId}" id="${radioId}" value="${cell.value}" data-label="${cell.label}" data-day="${dayKey}" data-time="${row.time}">
                                                                <label for="${radioId}">${cell.label}</label>
                                                            </td>`;
                                                        } else {
                                                            html += `<td class="static-cell">${cell.label}</td>`;
                                                        }
                                                    });
                                                    html += '</tr>';
                                                });

                                                html += '</tbody></table>';
                                            }

                                            return html;
                                        }

                                        // Function to update JSON in hidden input
                                        function updateTimeSlotJSON() {
                                            const selectedSlots = {};
                                            const checkedRadios = document.querySelectorAll('input[type="radio"][name^="time_slot_"]:checked');
                                            
                                            checkedRadios.forEach(radio => {
                                                const day = radio.getAttribute('data-day');
                                                if (!selectedSlots[day]) {
                                                    selectedSlots[day] = [];
                                                }
                                                selectedSlots[day].push({
                                                    value: radio.value,
                                                    label: radio.getAttribute('data-label'),
                                                    time: radio.getAttribute('data-time')
                                                });
                                            });

                                            if (timeSlotHidden) {
                                                timeSlotHidden.value = JSON.stringify(selectedSlots);
                                            }

                                            // Hide error if selections exist
                                            const errorDiv = document.getElementById('time_slot_error');
                                            if (errorDiv && Object.keys(selectedSlots).length > 0) {
                                                errorDiv.style.display = 'none';
                                            }
                                        }

                                        // Function to show/hide food and kit options
                                        function toggleFoodKitOptions() {
                                            const passType = passTypeDropdown ? passTypeDropdown.value : '';
                                            if (passType === 'workshop' && foodKitGroup) {
                                                foodKitGroup.style.display = 'block';
                                            } else if (foodKitGroup) {
                                                foodKitGroup.style.display = 'none';
                                                // Reset food/kit values when hidden
                                                document.getElementById('food_checkbox').checked = false;
                                                document.getElementById('kit_checkbox').checked = false;
                                                updateFoodKitValues();
                                            }
                                        }

                                        // Handle pass type change
                                        if (passTypeDropdown) {
                                            passTypeDropdown.addEventListener('change', function() {
                                                const passType = this.value;
                                                
                                                // Toggle food/kit options
                                                toggleFoodKitOptions();
                                                
                                                // Toggle IEEE section visibility
                                                const ieeeSection = document.getElementById('del_type');
                                                const ieeeNumberGroup = document.getElementById('ieee_number_group');
                                                if (ieeeSection) {
                                                    if (passType === 'workshop') {
                                                        // Hide IEEE section for 2-Day Delegate Pass
                                                        ieeeSection.style.display = 'none';
                                                        if (ieeeNumberGroup) {
                                                            ieeeNumberGroup.style.display = 'none';
                                                        }
                                                        // Reset IEEE values
                                                        const yesRadio = document.getElementById('yes1');
                                                        const noRadio = document.getElementById('no1');
                                                        if (noRadio) noRadio.checked = true;
                                                        if (yesRadio) yesRadio.checked = false;
                                                        const ieeeNumberInput = document.getElementById('ieee_member_number');
                                                        if (ieeeNumberInput) {
                                                            ieeeNumberInput.value = '';
                                                            ieeeNumberInput.required = false;
                                                        }
                                                    } else {
                                                        // Show IEEE section for other pass types
                                                        ieeeSection.style.display = 'block';
                                                        // Uncheck both radio buttons so no default is selected
                                                        const yesRadioShow = document.getElementById('yes1');
                                                        const noRadioShow = document.getElementById('no1');
                                                        if (yesRadioShow) yesRadioShow.checked = false;
                                                        if (noRadioShow) noRadioShow.checked = false;
                                                    }
                                                }
                                                
                                                // Toggle time slot selection - only show for workshop (2-Day Delegate Pass)
                                                if (passType === 'workshop') {
                                                    // Time slots will be shown when day is selected
                                                    // Just ensure it's hidden initially
                                                    passTimeSlotGroup.style.display = 'none';
                                                    tablesContainer.innerHTML = '';
                                                    if (timeSlotHidden) timeSlotHidden.value = '';
                                                } else {
                                                    // Hide time slot selection for other pass types
                                                    passTimeSlotGroup.style.display = 'none';
                                                    tablesContainer.innerHTML = '';
                                                    if (timeSlotHidden) timeSlotHidden.value = '';
                                                }
                                            });
                                        }

                                        // Handle exhibition day change for workshop pass
                                        if (exhibitionDayDropdown) {
                                            exhibitionDayDropdown.addEventListener('change', function() {
                                                const selectedDay = this.value;
                                                const passType = passTypeDropdown ? passTypeDropdown.value : '';
                                                
                                                // Only show time slots for workshop (2-Day Delegate Pass)
                                                if (passType === 'workshop' && selectedDay && selectedDay.includes(',')) {
                                                    const days = selectedDay.split(',');
                                                    tablesContainer.innerHTML = '';
                                                    
                                                    days.forEach(day => {
                                                        const dayKey = day.trim();
                                                        if (scheduleData[dayKey]) {
                                                            tablesContainer.innerHTML += createDayTable(dayKey);
                                                        }
                                                    });

                                                    // Add event listeners to all radio buttons
                                                    // Radio buttons are already grouped by name attribute (per row), so no need for manual grouping
                                                    const radios = tablesContainer.querySelectorAll('input[type="radio"]');
                                                    radios.forEach(radio => {
                                                        radio.addEventListener('change', function() {
                                                            updateTimeSlotJSON();
                                                        });
                                                    });

                                                    passTimeSlotGroup.style.display = 'block';
                                                } else {
                                                    // Hide time slot selection for non-workshop pass types or when no day is selected
                                                    passTimeSlotGroup.style.display = 'none';
                                                    tablesContainer.innerHTML = '';
                                                    if (timeSlotHidden) timeSlotHidden.value = '';
                                                }
                                            });
                                        }

                                        // Form validation
                                        const form = document.querySelector('form');
                                        if (form) {
                                            form.addEventListener('submit', function(e) {
                                                const passType = passTypeDropdown ? passTypeDropdown.value : '';
                                                
                                                if (passType === 'workshop') {
                                                    updateTimeSlotJSON();
                                                    const jsonValue = timeSlotHidden ? timeSlotHidden.value : '';
                                                    
                                                    if (!jsonValue || jsonValue === '{}') {
                                                        e.preventDefault();
                                                        const errorDiv = document.getElementById('time_slot_error');
                                                        if (errorDiv) {
                                                            errorDiv.style.display = 'block';
                                                        }
                                                        alert('Please select at least one time slot from each selected day.');
                                                        return false;
                                                    }
                                                    
                                                    try {
                                                        const selected = JSON.parse(jsonValue);
                                                        const selectedDays = Object.keys(selected);
                                                        const exhibitionDay = exhibitionDayDropdown ? exhibitionDayDropdown.value : '';
                                                        const expectedDays = exhibitionDay ? exhibitionDay.split(',') : [];
                                                        
                                                        // Check if at least one slot is selected for each expected day
                                                        for (let day of expectedDays) {
                                                            const dayKey = day.trim();
                                                            if (!selected[dayKey] || selected[dayKey].length === 0) {
                                                                e.preventDefault();
                                                                alert(`Please select at least one time slot for ${dayKey}.`);
                                                                return false;
                                                            }
                                                        }
                                                    } catch (err) {
                                                        e.preventDefault();
                                                        alert('Error validating time slots. Please try again.');
                                                        return false;
                                                    }
                                                }
                                            });
                                        }

                                        // Initialize on page load
                                        toggleFoodKitOptions();
                                        
                                        // Ensure time slot group is hidden if pass type is not workshop
                                        const initialPassType = passTypeDropdown ? passTypeDropdown.value : '';
                                        if (initialPassType !== 'workshop') {
                                            passTimeSlotGroup.style.display = 'none';
                                            tablesContainer.innerHTML = '';
                                            if (timeSlotHidden) timeSlotHidden.value = '';
                                        }
                                    });
                                    </script>

                                    <script>
                                    function updateFoodKitValues() {
                                        const foodCheckbox = document.getElementById('food_checkbox');
                                        const kitCheckbox = document.getElementById('kit_checkbox');
                                        const foodHidden = document.getElementById('food_hidden');
                                        const kitHidden = document.getElementById('kit_hidden');
                                        const foodAmountHidden = document.getElementById('food_amount_hidden');
                                        const kitAmountHidden = document.getElementById('kit_amount_hidden');
                                        
                                        const FOOD_AMOUNT = 2000;
                                        const KIT_AMOUNT = 1000;
                                        
                                        let totalAdditional = 0;
                                        
                                        // Update hidden inputs with Yes or No and amounts
                                        if (foodCheckbox && foodHidden && foodAmountHidden) {
                                            if (foodCheckbox.checked) {
                                                foodHidden.value = 'Yes';
                                                foodAmountHidden.value = FOOD_AMOUNT;
                                                totalAdditional += FOOD_AMOUNT;
                                                document.getElementById('food_summary').style.display = '';
                                            } else {
                                                foodHidden.value = 'No';
                                                foodAmountHidden.value = '0';
                                                document.getElementById('food_summary').style.display = 'none';
                                            }
                                        }
                                        
                                        if (kitCheckbox && kitHidden && kitAmountHidden) {
                                            if (kitCheckbox.checked) {
                                                kitHidden.value = 'Yes';
                                                kitAmountHidden.value = KIT_AMOUNT;
                                                totalAdditional += KIT_AMOUNT;
                                                document.getElementById('kit_summary').style.display = '';
                                            } else {
                                                kitHidden.value = 'No';
                                                kitAmountHidden.value = '0';
                                                document.getElementById('kit_summary').style.display = 'none';
                                            }
                                        }
                                        
                                        // Update summary display
                                        const summaryDiv = document.getElementById('additional_options_summary');
                                        const totalAdditionalSpan = document.getElementById('total_additional_amount');
                                        
                                        if (totalAdditional > 0) {
                                            summaryDiv.style.display = 'block';
                                            if (totalAdditionalSpan) {
                                                totalAdditionalSpan.textContent = totalAdditional.toLocaleString('en-IN');
                                            }
                                        } else {
                                            summaryDiv.style.display = 'none';
                                            if (totalAdditionalSpan) {
                                                totalAdditionalSpan.textContent = '0';
                                            }
                                        }
                                    }
                                    
                                    // Initialize on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        updateFoodKitValues();
                                    });
                                    </script>

                                    <?php if ($del != 'nextgen') { ?>
                                        <!-- IEEE Member question section -->
                                        <div class="form-group form-md-radios del_type" id="del_type">
                                        <label class="control-label col-md-3" style="color:#36454F;">
                                            Are You IEEE Member?
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="md-radio-inline">
                                                <div class="md-radio">
                                                    <input type="radio" id="yes1" name="ieee_member"
                                                        class="md-radiobtn" value="Yes" onclick="ieeeDiv();">
                                                    <label for="yes1">
                                                        <span></span><span class="check"></span><span class="box"></span>
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="md-radio del-type-con1">
                                                    <input type="radio" id="no1" name="ieee_member"
                                                        class="md-radiobtn" value="No" onclick="ieeeDiv();">
                                                    <label for="no1">
                                                        <span></span><span class="check"></span><span class="box"></span> No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                        <!-- Hidden IEEE Membership ID input field -->
                                        <div class="form-group" id="ieee_number_group" style="display:none;">
                                        <label class="col-md-3 control-label">Enter IEEE Membership ID <span class="dips-required">
                                                * </span></label>
                                         <div class="col-md-6">
                                            <input type="text" class="form-control" name="ieee_member_number" id="ieee_member_number"
                                                value="<?php echo (isset($_SESSION['ieee_member_number']) ? htmlspecialchars($_SESSION['ieee_member_number']) : ''); ?>"
                                                required="required" minlength="6" maxlength="8" 
                                                title="Enter exactly 8 alphanumeric characters (letters and digits only)"
                                                oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g,'').slice(0,8);" />
                                            <div id="ieee_member_number_error" style="color:red; display:none; font-size:12px;">Please enter exactly 8 alphanumeric characters.</div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 10px;">
                                            <div class="alert alert-warning" style="font-size: 1.2rem;">
                                                Registrants claiming IEEE Member rates must provide a valid IEEE Membership ID. Invalid or expired memberships will result in cancellation without refund.
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                    <script>
                                        function ieeeDiv() {
                                            var yesRadio = document.getElementById('yes1');
                                            var noRadio = document.getElementById('no1');
                                            var ieeeNumberGroup = document.getElementById('ieee_number_group');
                                            var ieeeNumberInput = document.getElementById('ieee_member_number');
                                            var attendeesDropdown = document.getElementById('attendees');

                                            if (yesRadio && yesRadio.checked) {
                                                // Show the IEEE membership number field
                                                ieeeNumberGroup.style.display = 'block';
                                                ieeeNumberInput.required = true;
                                                
                                                // Fix attendees to 1 only
                                                if (attendeesDropdown) {
                                                    attendeesDropdown.value = '1';
                                                    attendeesDropdown.disabled = true;
                                                    // Hide all options except 1
                                                    var options = attendeesDropdown.options;
                                                    for (var i = 0; i < options.length; i++) {
                                                        if (options[i].value !== '1') {
                                                            options[i].style.display = 'none';
                                                        } else {
                                                            options[i].style.display = 'block';
                                                        }
                                                    }
                                                    // Trigger the attendee fields function
                                                    showAttendeeFields();
                                                }
                                            } else if (noRadio && noRadio.checked) {
                                                // Hide the IEEE membership number field and reset its value
                                                ieeeNumberGroup.style.display = 'none';
                                                ieeeNumberInput.required = false;
                                                ieeeNumberInput.value = '';
                                                
                                                // Enable normal attendees selection
                                                if (attendeesDropdown) {
                                                    attendeesDropdown.disabled = false;
                                                    // Show all options
                                                    var options = attendeesDropdown.options;
                                                    for (var i = 0; i < options.length; i++) {
                                                        options[i].style.display = 'block';
                                                    }
                                                }
                                            }
                                        }

                                        // Call the function on page load to set the initial state
                                        document.addEventListener('DOMContentLoaded', function() {
                                            ieeeDiv();
                                        });
                                    </script>

                                    <!-- <div class="form-group">
                                        <label class="col-md-3 control-label">Amount<span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6" style="padding-top:7px;">
                                            <span><strong id="amount_text">
                                                    <?php
                                                    // if ($cit == 'ind') {
                                                    //     echo htmlspecialchars($del_inr, ENT_QUOTES, 'UTF-8');
                                                    // } elseif ($cit == 'int') {
                                                    //     echo htmlspecialchars($del_us, ENT_QUOTES, 'UTF-8');
                                                    // }
                                                    ?>
                                                </strong></span>
                                            <input type="hidden" class="form-control" name="cata" id="cata"
                                                value="<?php //echo $del_id; 
                                                        ?>" required="required" />
                                        </div>
                                    </div> -->




                                </div>

                                <!-- Abstract Presenter -->
                                <!-- <div class="form-group form-md-radios del_type" id="del_type">
    <label class="control-label col-md-3" style="color:#36454F;">
        Are you an abstract presenter?<span class="required"> * </span>
    </label>
    <div class="col-md-9">
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" id="ayes" name="abstract_presenter"
                    class="md-radiobtn" value="Yes" onclick="abstractDiv();">
                <label for="ayes">
                    <span></span><span class="check"></span><span class="box"></span> Yes
                </label>
            </div>
            <div class="md-radio del-type-con1">
                <input type="radio" id="ano" name="abstract_presenter"
                    class="md-radiobtn" value="No" checked onclick="abstractDiv();">
                <label for="ano">
                    <span></span><span class="check"></span><span class="box"></span> No
                </label>
            </div>
        </div>
        <div class="col-md-9" style="margin-top: 10px;">
            <label for="abstract_note"><strong>Note:</strong><br />
                1.) You must have received an email acknowledgement regarding the selection of your submitted abstract<br />
                2.) Only 1 Abstract per registration is allowed.
            </label>
        </div>
    </div>
</div> -->



                                <!-- Abstract Presenter -->
                                <!-- <div class="form-group form-md-radios del_type" id="del_type_poster">
    <label class="control-label col-md-3" style="color:#36454F;">
    Are you an abstract presenter?<span class="required"> * </span>
    </label>
    <div class="col-md-9">
        <div class="md-radio-inline">
            <div class="md-radio">
                <input type="radio" id="dyes" name="abstract_presenter" class="md-radiobtn"
                    value="Yes" onclick="toggleAccompanying();">
                <label for="dyes">
                    <span></span><span class="check"></span><span class="box"></span> Yes
                </label>
            </div>
            <div class="md-radio del-type-con1">
                <input type="radio" id="dno" name="abstract_presenter" class="md-radiobtn"
                    value="No" checked onclick="toggleAccompanying();">
                <label for="dno">
                    <span></span><span class="check"></span><span class="box"></span> No
                </label>
            </div>
        </div>
        <div class="col-md-9" style="margin-top: 10px;">
            <label for="abstract_note"><strong>Note:</strong><br />
                1.) You must have received an email acknowledgement regarding the selection of your submitted abstract.<br />
                2.) Only 1 Abstract per registration is allowed.
            </label>
        </div>
    </div>
</div> -->
                                <!-- Abstract Email Input -->
                                <!-- <div class="form-group" id="abstract_div" style="display: none;">
    <label class="control-label col-md-3">
        <span class="normal-cata">Please enter the email address used for abstract submission. </span>
        <span class="required"> *</span>
    </label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="abstractno" id="abstractno" />
    </div>
</div> -->
                                <!-- Accompanying Person Section -->
                                <!-- <div class="form-group" id="accompanying_person_section" style="display:none;">
            <label class="control-label col-md-3" style="color:#36454F;">
                Do you have an accompanying person?<span class="required"> * </span>
            </label>
            <div class="col-md-9">
            <div class="md-radio-inline">
                <div class="md-radio">
                    <input type="radio" id="accompany_yes" name="accompanying_person"
                        class="md-radiobtn" value="Yes">
                    <label for="accompany_yes">
                        <span></span><span class="check"></span><span class="box"></span> Yes
                    </label>
                </div>
                <div class="md-radio">
                    <input type="radio" id="accompany_no" name="accompanying_person"
                        class="md-radiobtn" value="No">
                    <label for="accompany_no">
                        <span></span><span class="check"></span><span class="box"></span> No
                    </label>
                </div>
            </div>
            </div>
    </div>
     -->
                                <!-- JS Functions -->
                                <!-- <script>
    function toggleAccompanying() {
        var isPosterPresenter = document.getElementById('dyes').checked;
        var section = document.getElementById('accompanying_person_section');
        section.style.display = isPosterPresenter ? 'block' : 'none';
        var section2 = document.getElementById('abstract_div');
        section2.style.display = isPosterPresenter ? 'block' : 'none';
        
    }
</script> -->





                                <!-- add a radio button that are you an ivca member? -->
                                <?php // if ($del == 'businvestor' || $del == 'silverinv' || $del == 'goldinv' || $del == 'goldinvint' || $del == 'bronzeinv') { 
                                ?>
                                <!-- <div class="form-group">
                                            <label class="col-md-3 control-label">Are you an IVCA member?<span
                                                    class="dips-required"> *</span></label>
                                            <div class="col-md-6">
                                                <div class="radio-group" style="display: flex; gap: 15px; align-items: center;">
                                                    <label>
                                                        <input type="radio" name="ivca" value="Yes" required="required" <?php //echo (isset($_SESSION['ivca']) && $_SESSION['ivca'] == 'Yes') ? 'checked' : ''; 
                                                                                                                        ?> />
                                                        Yes
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="ivca" value="No" required="required" <?php //echo (isset($_SESSION['ivca']) && $_SESSION['ivca'] == 'No') ? 'checked' : ''; 
                                                                                                                        ?> />
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div> -->
                                <!-- <div class="form-group">
                                            <label class="col-md-3 control-label">Are you an investor?<span
                                                    class="dips-required"> *</span></label>
                                            <div class="col-md-6">
                                                <div class="radio-group" style="display: flex; gap: 15px; align-items: center;">
                                                    <label>
                                                        <input type="radio" name="are_you_investor" value="Yes"
                                                            required="required" <?php /* echo (isset($_SESSION['are_you_investor']) && $_SESSION['are_you_investor'] == 'Yes') ? 'checked' : ''; ?> />
                               Yes
                           </label>
                           <label>
                               <input type="radio" name="are_you_investor" value="No"
                                   required="required" <?php echo (isset($_SESSION['are_you_investor']) && $_SESSION['are_you_investor'] == 'No') ? 'checked' : ''; ?> />
                               No
                           </label>
                       </div>
                   </div>
               </div> -->

               <?php if ($del == 'businvestor' || $del == 'silverinv' || $del == 'goldinv' || $del == 'bronzeinv') { ?>

                   <?php
                   $investor_associations = [
                       "100Unicorns",
                       "100X.VC",
                       "500 Startups",
                       "AIIRF EDII",
                       "Ah! Ventures",
                       "Ahmedabad Angel Network",
                       "Angel List",
                       "Atrium",
                       "Chandigarh Angels",
                       "Chennai Angels",
                       "Flipkart Leap",
                       "GHV Accelerator",
                       "Gruhas Proptech",
                       "GSF Accelerator",
                       "GVFL",
                       "Hyderabad Angels",
                       "IIITDM",
                       "IIM - Udaipur",
                       "IIM Kashipur",
                       "IIM Lucknow",
                       "IIMA Ventures",
                       "IIM-B NSRCEL",
                       "IIT- Delhi BBIF",
                       "IIT-Madras Incubation Cell",
                       "Incubator",
                       "India Accelerator",
                       "India Edison Accelerator",
                       "Indian Angel Network",
                       "ISBA",
                       "IVCA",
                       "JITO Incubation Centre",
                       "JSSATE-STEP",
                       "Kanpur Angels",
                       "KIIT-TBI",
                       "Lead Angels",
                       "Letsventure",
                       "MICA - Comcubator",
                       "MITCON BC",
                       "Mumbai Angels",
                       "Rajasthan Angel Investor Network",
                       "T Hub",
                       "TANSEED",
                       "TechStars",
                       "TIE Blore/All India",
                       "Villgro",
                       "Others",
                       "None"
                   ];
                   ?>

                   <!-- Are you a member of any of the following investor associations/ Organisations? -->
                   <div class="form-group">
                       <label class="col-md-3 control-label">
                           Are you a member of any of the following investor associations/ Organisations?
                           <span class="dips-required"> *</span>
                       </label>
                       <div class="col-md-6">
                           <select class="form-control" name="investor_association"
                               id="investor_association" required onchange="toggleOtherInput()">
                               <option value="">Select an option</option>
                               <?php foreach ($investor_associations as $association): ?>
                                   <option value="<?php echo htmlspecialchars($association); ?>">
                                       <?php echo htmlspecialchars($association); ?>
                                   </option>
                               <?php endforeach; ?>
                           </select>

                           <!-- Additional input field for 'Other' -->
                           <input type="text" class="form-control mt-2" id="other_investor_association"
                               placeholder="Please specify" style="display: none; margin-top: 10px;">
                       </div>
                   </div>

               <?php } */ ?>

                                        <script>
                                            function toggleOtherInput() {
                                                var selectBox = document.getElementById("investor_association");
                                                var otherInput = document.getElementById("other_investor_association");

                                                if (selectBox.value === "Others") {
                                                    otherInput.style.display = "block";
                                                    otherInput.setAttribute("required", "required");
                                                } else {
                                                    otherInput.style.display = "none";
                                                    otherInput.removeAttribute("required");
                                                }
                                            }

                                            document.querySelector("form").addEventListener("submit", function () {
                                                var selectBox = document.getElementById("investor_association");
                                                var otherInput = document.getElementById("other_investor_association");

                                                if (selectBox.value === "Others" && otherInput.value.trim() !== "") {
                                                    // Append "Other - " only on form submission
                                                    var hiddenInput = document.createElement("input");
                                                    hiddenInput.type = "hidden";
                                                    hiddenInput.name = "investor_association";
                                                    hiddenInput.value = "Other - " + otherInput.value.trim();
                                                    this.appendChild(hiddenInput);

                                                    // Remove name from select to avoid duplicate submission
                                                    selectBox.removeAttribute("name");
                                                }
                                            });
                                        </script> -->



                                <?php // } 
                                ?>

                                <div class="form-group">
                                    <?php  if ($del == 'nextgen' || $del == 'academia') {?>
                                         <label class="col-md-3 control-label">Insitute Name <span class="dips-required"> * </span></label>
                                    <?php } else { ?>
                                       
                                    <label class="col-md-3 control-label">Organisation Name <span class="dips-required">
                                            * </span></label>
                                    <?php } ?>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="org" id="org"
                                            value="<?php echo (isset($_SESSION['org']) ? $_SESSION['org'] : " "); ?>"
                                            maxlength="100"
                                            required="required" />
                                    </div>
                                </div>
                                <!-- add address1 (textbox), city, state, zipcode -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Address <span class="dips-required"> *
                                        </span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="address" id="address"
                                            value="<?php echo (isset($_SESSION['address']) ? $_SESSION['address'] : " "); ?>"
                                            maxlength="200"
                                            required="required" />
                                    </div>
                                </div>






                                <div class="form-group">
                                    <label for="country" class="col-md-3 control-label">Country <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        <select id="country" name="country" class="form-control" onchange="fetchHqStates()"
                                            required <?php if ($cit == 'ind') echo 'data-default="India" disabled'; ?>>
                                            <option value="">Select Country</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="state" class="col-md-3 control-label">State <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        <select id="state" name="state" class="form-control" onchange="fetchHqCities()"
                                            required>
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="city" class="col-md-3 control-label">City <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        <select id="city" name="city" class="form-control" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- if cit =int then it wil be Zip/Postal Code  -->
                                  <div class="form-group">
                                    <label class="col-md-3 control-label">
                                        <?php if ($cit == 'int') { ?>
                                            Zip/Postal Code
                                        <?php } else { ?>
                                            Pin Code
                                        <?php } ?>
                                        <span class="dips-required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <?php
                                        // Set initial attributes server-side based on $cit
                                        if (isset($cit) && $cit === 'ind') {
                                            $pattern = '^\d{6}$';
                                            $maxlength = '6';
                                            $title = 'Enter 6 digit PIN code for India';
                                            $inputmode = 'numeric';
                                            $placeholder = '';
                                        } elseif (isset($cit) && $cit === 'int') {
                                            // international alphanumeric with special characters - flexible for all countries
                                            $pattern = '^[A-Za-z0-9\-\s]+$';
                                            $minlength = '2';
                                            $maxlength = '15';
                                            $title = 'Enter postal code (2-15 characters, letters, numbers, spaces, and hyphens allowed)';
                                            $inputmode = 'text';
                                            $placeholder = '';
                                        } else {
                                            $pattern = '^[A-Za-z0-9\-\s]+$';
                                            $maxlength = '15';
                                            $title = 'Enter a valid postal code (2-15 characters, letters, numbers, spaces, and hyphens allowed)';
                                            $inputmode = 'text';
                                            $placeholder = '';
                                        }
                                        ?>
                                        <input type="text" class="form-control" name="zipcode" id="zipcode"
                                            value="<?php echo isset($_SESSION['zipcode']) ? htmlspecialchars($_SESSION['zipcode']) : ''; ?>"
                                            <?php if ($maxlength) echo 'maxlength="' . $maxlength . '"'; ?>
                                            pattern="<?php echo htmlspecialchars($pattern); ?>"
                                            title="<?php echo htmlspecialchars($title); ?>"
                                            inputmode="<?php echo htmlspecialchars($inputmode); ?>"
                                            placeholder="<?php echo htmlspecialchars($placeholder); ?>"
                                            required="required" />
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var zipcode = document.getElementById('zipcode');
                                        var country = document.getElementById('country');
                                        var cit = '<?php echo isset($cit) ? $cit : ''; ?>';
                                        var inputListener = null;

                                        function makeDigitListener(limit) {
                                            return function (e) {
                                                e.target.value = e.target.value.replace(/\D+/g, '').slice(0, limit);
                                            };
                                        }

                                        function makeAlphanumericListener(limit) {
                                            return function (e) {
                                                // Allow alphanumeric, spaces, and hyphens for international postal codes
                                                e.target.value = e.target.value.replace(/[^A-Za-z0-9\-\s]/g, '').slice(0, limit);
                                            };
                                        }

                                        function setIndiaProps() {
                                            zipcode.setAttribute('pattern', '^\\d{6}$');
                                            zipcode.setAttribute('title', 'Enter 6 digit PIN code for India');
                                            zipcode.setAttribute('inputmode', 'numeric');
                                            zipcode.setAttribute('maxlength', '6');
                                            zipcode.setAttribute('placeholder', '');

                                            // attach digit-only listener with limit 6
                                            if (inputListener) zipcode.removeEventListener('input', inputListener);
                                            inputListener = makeDigitListener(6);
                                            zipcode.addEventListener('input', inputListener);
                                        }

                                        function setIntlAlphanumericProps() {
                                            zipcode.setAttribute('pattern', '^[A-Za-z0-9\\-\\s]{2,15}$');
                                            zipcode.setAttribute('title', 'Enter postal code (2-15 characters, letters, numbers, spaces, and hyphens allowed)');
                                            zipcode.setAttribute('inputmode', 'text');
                                            zipcode.setAttribute('maxlength', '15');
                                            zipcode.setAttribute('placeholder', '');

                                            // attach alphanumeric listener with spaces and hyphens
                                            if (inputListener) zipcode.removeEventListener('input', inputListener);
                                            inputListener = makeAlphanumericListener(15);
                                            zipcode.addEventListener('input', inputListener);
                                        }

                                        // Initialize based on current country selection or cit value
                                        function updateZipcodeValidation() {
                                            var selectedCountry = country ? country.value : '';
                                            
                                            if (cit === 'ind' || selectedCountry === 'India') {
                                                setIndiaProps();
                                            } else {
                                                // For international countries, use alphanumeric with special characters
                                                setIntlAlphanumericProps();
                                            }
                                        }

                                        // Set initial state
                                        updateZipcodeValidation();

                                        // Listen for country changes
                                        if (country) {
                                            country.addEventListener('change', updateZipcodeValidation);
                                        }
                                    });
                                </script>

                                <!-- Nationality -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nationality <span class="dips-required">*</span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nationality" id="nationality"
                                            value="<?php echo (isset($_SESSION['nationality']) ? $_SESSION['nationality'] : " "); ?>"
                                            maxlength="50"
                                            required="required" />
                                    </div>
                                </div>

                                <!-- if del = 'nextgen' then day and time slot First half and Second half -->
                                <div class="form-group" id="exhibition_day_group">
                                    <?php if ($del == 'nextgen') { ?>
                                        <label class="col-md-3 control-label">Select Day <span class="dips-required">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="exhibition_day" id="exhibition_day" required>
                                                <option value="">-- Select Day --</option>
                                                
                                                <option value="Day2">Day 2 (10-10-2025)</option>
                                                <option value="Day3">Day 3 (11-10-2025)</option>
                                                <option value="Day4">Day 4 (12-10-2025)</option>
                                               
                                               
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                                <!-- if del = 'nextgen' then day and time slot First half and Second half    -->
                                <div class="form-group" id="time_slot_group">
                                    <?php if ($del == 'nextgen') { ?>
                                        <label class="col-md-3 control-label">Select Time Slot <span class="dips-required">*</span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="time_slot" id="time_slot" required>
                                                <option value="">-- Select Time Slot --</option>
                                                <option value="First half">First Half</option>
                                                <option value="Second half">Second Half</option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>


                                <?php
                                // Check if the number of attendees is stored in the session
                                $attendeesCount = isset($_SESSION['total_dele']) ? $_SESSION['total_dele'] : ''; ?>

                                <?php if ($del != 'nextgen') { ?>
                                <!-- <input type='hidden' name='attendees' value='1'> -->
                                <?php  ?>
                                
                                <div class="form-group">
                                    <input type='hidden' name='attendees' value='1'>
                                    
                                    <!-- <label class="col-md-3 control-label" for="attendees">No. of Attendees <span
                                            class="dips-required"> * </span></label>
                                    <div class="col-md-6">
                                            <select class="form-control" id="attendees" name="attendees">
                                                <option value="1" selected>1</option>
                                            </select>
                                            </div>
                                     -->

                                
                                        
                                    
                                    <!-- </div> -->
                                
                                <?php  } else { ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="attendees">Student Package<span
                                                class="dips-required"> * </span></label>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="attendees" value="1">
                                                    <select class="form-control" id="attendees" name="package"
                                                        onchange="showAttendeeFields(); updateSmartCampusInfo();">
                                                        <option value="" selected>Select Package</option>
                                                        <option value="Smart Campus Pack - Silver">Smart Campus Pack - Silver</option>
                                                        <option value="Smart Campus Pack - Gold">Smart Campus Pack - Gold</option>
                                                    </select>
                                                    <div id="smart-campus-info" style="margin-top:5px; display:none; font-size:14px; color:#007bff;">
                                                    </div>
                                                    <script>
                                                    function updateSmartCampusInfo() {
                                                        var attendeesSelect = document.getElementById('attendees');
                                                        var infoDiv = document.getElementById('smart-campus-info');
                                                        if (attendeesSelect.value === "Smart Campus Pack - Silver") {
                                                            infoDiv.style.display = "block";
                                                            infoDiv.textContent = "100 Students + 5 Faculty";
                                                        } else if (attendeesSelect.value === "Smart Campus Pack - Gold") {
                                                            infoDiv.style.display = "block";
                                                            infoDiv.textContent = "200 Students + 5 Faculty";
                                                        } else {
                                                            infoDiv.style.display = "none";
                                                            infoDiv.textContent = "";
                                                        }
                                                    }
                                                    document.addEventListener('DOMContentLoaded', updateSmartCampusInfo);
                                                    </script>
                                                </div> <?php } ?>
                                                
                                    <!-- on selection and change of value of package of 100 student or 200 student display the dynamic pricing as 100 Students + 5 Faculty	1500 per head	1,50,000
                                        200 Students + 5 Faculty	1500 per head	300,000
                                        -->
                                        <!-- Dynamic pricing display for student packages -->
                                       
                                </div>
                                 <div id="student-package-pricing" style="margin-top:10px; display:none;">
                                    
                                            <div class="alert alert-info" style="font-size: 1.2rem;">
                                                <span id="package-pricing-text"></span>
                                            </div>
                                </div>
                               
                                        <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var attendeesSelect = document.getElementById('attendees');
                                            var pricingDiv = document.getElementById('student-package-pricing');
                                            var pricingText = document.getElementById('package-pricing-text');

                                            function updateStudentPackagePricing() {
                                                var value = attendeesSelect.value;
                                                if (value === "100 Students + 5 Faculty") {
                                                    pricingDiv.style.display = "block";
                                                    pricingText.textContent = "100 Students + 5 Faculty: Total = ₹1,50,000";
                                                } else if (value === "200 Students + 5 Faculty") {
                                                    pricingDiv.style.display = "block";
                                                    pricingText.textContent = "200 Students + 5 Faculty: Total = ₹3,00,000";
                                                } else {
                                                    pricingDiv.style.display = "none";
                                                    pricingText.textContent = "";
                                                }
                                            }

                                            attendeesSelect.addEventListener('change', updateStudentPackagePricing);

                                            // Show pricing if session value is pre-selected
                                            updateStudentPackagePricing();
                                        });
                                        </script>

                                    
                                <?php
                                $attendees = isset($_SESSION['attendees']) ? $_SESSION['attendees'] : array();
                                ?>
                                <!-- Attendee 1 Fields -->
                                <div id="attendee1" class="attendee-fields">
                                    <?php if ($del != 'nextgen') { ?>
                                    <h3 align=center>Attendee Details</h3>
                                    <?php } else { ?>
                                        <h3 align=center>Contact Details</h3>
                                    <?php } ?>
                                    <!-- Same structure as Attendee 1 -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="title1">Title<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select id="title1" name="title1" class="form-control">
                                                <option value="">Select Title</option>
                                                <option value="Mr." <?php echo (isset($attendees[0]['title']) && $attendees[0]['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr. </option>
                                                <option value="Mrs." <?php echo (isset($attendees[0]['title']) && $attendees[0]['title'] == 'Mrs.') ? 'selected' : ''; ?>> Mrs.</option>
                                                <option value="Ms." <?php echo (isset($attendees[0]['title']) && $attendees[0]['title'] == 'Ms.') ? 'selected' : ''; ?>>Ms. </option>
                                                <option value="Dr." <?php echo (isset($attendees[0]['title']) && $attendees[0]['title'] == 'Dr.') ? 'selected' : ''; ?>>Dr. </option>
                                                <option value="Prof." <?php echo (isset($attendees[0]['title']) && $attendees[0]['title'] == 'Prof.') ? 'selected' : ''; ?>>Prof. </option>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="firstname1">First
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="firstname1" name="firstname1" class="form-control"
                                                value="<?php echo isset($attendees[0]['first_name']) ? $attendees[0]['first_name'] : ''; ?>"
                                                maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="lastname2">Last Name<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="lastname1" name="lastname1" class="form-control"
                                                value="<?php echo isset($attendees[0]['last_name']) ? $attendees[0]['last_name'] : ''; ?>"
                                                maxlength="50">
                                        </div>
                                    </div>
                                    <?php $isStudent = (isset($_SESSION['sector']) && $_SESSION['sector'] === 'Student'); ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="designation1">Designation
                                            <span id="designation1_required_span" class="dips-required" style="<?php echo $isStudent ? 'display:none;' : ''; ?>"> *</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" id="designation1" name="designation1" class="form-control"
                                                value="<?php echo isset($attendees[0]['designation']) ? $attendees[0]['designation'] : ''; ?>"
                                                maxlength="100"
                                                <?php echo $isStudent ? '' : 'required="required"'; ?> >
                                        </div>
                                    </div>

                                    <script>
                                        // Make designation non-mandatory and hide the asterisk when Select Domain = Student
                                        function toggleDesignationRequirement() {
                                            var sector = document.getElementById('sector');
                                            var des = document.getElementById('designation1');
                                            var span = document.getElementById('designation1_required_span');
                                            
                                            if (!sector || !des || !span) return;
                                            if (sector.value === 'Student') {
                                                des.required = false;
                                                span.style.display = 'none';
                                            }
                                            
                                            
                                            else {
                                                des.required = true;
                                                span.style.display = '';
                                            }
                                        }
                                        document.addEventListener('DOMContentLoaded', function () {
                                            toggleDesignationRequirement();
                                            var sector = document.getElementById('sector');
                                            if (sector) sector.addEventListener('change', toggleDesignationRequirement);
                                        });
                                    </script>


                                    <!-- Branch and course-->
                                     <?php if ($del == 'academia') { ?>

                                           <div id="course-branch-group">
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label" for="course1">Course
                                                       <span id="course1_required_span" class="dips-required"> *</span>
                                                   </label>
                                                   <div class="col-md-6">
                                                       <input type="text" id="course1" name="course1" class="form-control"
                                                           value="<?php echo isset($attendees[0]['course']) ? $attendees[0]['course'] : ''; ?>"
                                                           maxlength="100">
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label class="col-md-3 control-label" for="branch1">Branch
                                                       <span id="branch1_required_span" class="dips-required"> *</span>
                                                   </label>
                                                   <div class="col-md-6">
                                                       <input type="text" id="branch1" name="branch1" class="form-control"
                                                           value="<?php echo isset($attendees[0]['branch']) ? $attendees[0]['branch'] : ''; ?>"
                                                           maxlength="100">
                                                   </div>
                                               </div>
                                           </div>

                                           <script>
                                               // Hide and remove required for Course/Branch when sector == "Professor/Faculty"
                                               function toggleCourseBranchFields() {
                                                   var sector = document.getElementById('sector');
                                                   var group = document.getElementById('course-branch-group');
                                                   var course = document.getElementById('course1');
                                                   var branch = document.getElementById('branch1');
                                                   var courseReqSpan = document.getElementById('course1_required_span');
                                                   var branchReqSpan = document.getElementById('branch1_required_span');
                                                   var course1 = document.getElementById('course1');
                                                   var branch1 = document.getElementById('branch1');


                                                   if (!sector || !group || !course || !branch) return;
                                                   console.log("Sector value: " + sector.value);

                                                   if (sector.value === 'Professor/Faculty') {
                                                       group.style.display = 'none';
                                                       course.required = false;
                                                       branch.required = false;
                                                       if (courseReqSpan) courseReqSpan.style.display = 'none';
                                                       if (branchReqSpan) branchReqSpan.style.display = 'none';
                                                   }

                                                   else if (sector.value === 'Others') {
                                                       course.required = false;
                                                       branch.required = false;
                                                       courseReqSpan.style.display = 'none';
                                                       branchReqSpan.style.display = 'none';
                                                   }

                                                   else {
                                                       group.style.display = '';
                                                       // Make fields mandatory for other selections
                                                       course.required = true;
                                                       branch.required = true;
                                                       if (courseReqSpan) courseReqSpan.style.display = '';
                                                       if (branchReqSpan) branchReqSpan.style.display = '';
                                                   }
                                               }

                                               document.addEventListener('DOMContentLoaded', function () {
                                                   toggleCourseBranchFields();
                                                   var sectorEl = document.getElementById('sector');
                                                   if (sectorEl) sectorEl.addEventListener('change', toggleCourseBranchFields);
                                               });
                                           </script>

                                    
                                 
                                    <?php } ?>
                                    <?php if ($del != 'nextgen') { ?>
                                    <!-- if Select Domain is Student the ask to upload the ID card -->
                                    <div class="form-group" id="id-card-upload" style="display:none;">
                                        <label class="col-md-3 control-label" for="id_card1">Upload ID Card (PDF, Max 2MB)<span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6">
                                            <input type="file" id="id_card1" name="id_card1" class="form-control" 
                                                   accept=".pdf,application/pdf" 
                                                   onchange="validateIdCardFile(this)">
                                            <small class="form-text text-muted">Please upload PDF file only. Maximum file size: 2MB</small>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <script>
                                        // Function to validate ID card file (PDF, max 2MB)
                                        function validateIdCardFile(input) {
                                            const file = input.files[0];
                                            const maxSize = 2 * 1024 * 1024; // 2MB in bytes

                                            if (file) {
                                                // Check file type
                                                if (file.type !== 'application/pdf') {
                                                    alert('Please upload a PDF file only.');
                                                    input.value = '';
                                                    return false;
                                                }

                                                // Check file size
                                                if (file.size > maxSize) {
                                                    alert('File size exceeds 2MB. Please upload a smaller file.');
                                                    input.value = '';
                                                    return false;
                                                }
                                            }
                                            return true;
                                        }

                                        // Function to toggle ID card upload based on sector selection
                                        function toggleIdCardUpload() {
                                            const sectorDropdown = document.getElementById('sector');
                                            const idCardUpload = document.getElementById('id-card-upload');
                                            const idCardInput = document.getElementById('id_card1');

                                            if (sectorDropdown && sectorDropdown.value === 'Student') {
                                                idCardUpload.style.display = 'block';
                                                idCardInput.required = true;
                                            } else {
                                                idCardUpload.style.display = 'none';
                                                idCardInput.required = false;
                                                idCardInput.value = ''; // Clear the file input
                                            }
                                        }

                                        // Add event listener when page loads
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const sectorDropdown = document.getElementById('sector');
                                            const idCardInput = document.getElementById('id_card1');
                                            
                                            // Ensure field is not required by default
                                            if (idCardInput) {
                                                idCardInput.required = false;
                                            }
                                            
                                            if (sectorDropdown) {
                                                sectorDropdown.addEventListener('change', toggleIdCardUpload);
                                                // Check on page load in case value is pre-selected
                                                toggleIdCardUpload();
                                            }
                                            
                                            // Additional safeguard: remove required before form submission if field is hidden
                                            const form = document.querySelector('form');
                                            if (form) {
                                                form.addEventListener('submit', function(e) {
                                                    const idCardUploadDiv = document.getElementById('id-card-upload');
                                                    if (idCardInput && idCardUploadDiv) {
                                                        // If the field is hidden, remove required attribute
                                                        if (idCardUploadDiv.style.display === 'none' || 
                                                            window.getComputedStyle(idCardUploadDiv).display === 'none') {
                                                            idCardInput.required = false;
                                                            idCardInput.removeAttribute('required');
                                                        }
                                                    }
                                                });
                                            }
                                        });
                                    </script>
                                    

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email1">Email <small>(Official email only)</small><span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6">
                                            <input type="email" id="email1" name="email1" class="form-control"
                                                value="<?php echo isset($attendees[0]['email']) ? $attendees[0]['email'] : ''; ?>"
                                                placeholder="Enter email id" oninput="populateEmail(); validateEmail1();" />
                                            <span id="email1-error" style="color: red; display: none; font-size: 12px;"></span>
                                        </div>
                                    </div>

                                    <script>
                                        // Email validation based on delegation type for Educational and Government sectors
                                        const delType = '<?php echo $del; ?>';
                                        
                                        function validateEmail1() {
                                            const email = document.getElementById('email1').value;
                                            const errorSpan = document.getElementById('email1-error');
                                            
                                            if (!email) {
                                                errorSpan.style.display = 'none';
                                                return true;
                                            }

                                            const emailLower = email.toLowerCase();
                                            
                                            // For NextGen (students) and Academia - must have educational email domain
                                            <?php /*
                                            if (delType === 'academia') {
                                                const educationalPatterns = [
                                                    /\.edu$/i,          // .edu
                                                    /\.ac\.in$/i,       // .ac.in
                                                    /\.ac\.uk$/i,       // .ac.uk
                                                    /\.edu\.in$/i,      // .edu.in
                                                    /\.edu\.[a-z]{2}$/i, // .edu.xx (country codes)
                                                    /\.ac\.[a-z]{2}$/i   // .ac.xx (country codes)
                                                ];
                                                
                                                const isEduEmail = educationalPatterns.some(pattern => pattern.test(emailLower));
                                                
                                                if (!isEduEmail) {
                                                    errorSpan.textContent = 'Please use educational email';
                                                    errorSpan.style.display = 'block';
                                                    return false;
                                                }
                                            }
                                                */ ?>
                                            
                                            // For Government sector - must have government email domain
                                            // if (delType === 'government') {
                                            //     const governmentPatterns = [
                                            //         '@gov.in',
                                            //         '@nic.in',
                                            //         '@gov.uk',
                                            //         '@gob.mx',
                                            //         '@gov.au',
                                            //         '@gov.sg',
                                            //         '@gov.ph',
                                            //         '@gov.',
                                            //         '@govt.',
                                            //         '@gob.'
                                            //     ];
                                                
                                            //     const isGovEmail = governmentPatterns.some(pattern => emailLower.includes(pattern));
                                                
                                            //     if (!isGovEmail) {
                                            //         errorSpan.textContent = 'Government employees must use official government email';
                                            //         errorSpan.style.display = 'block';
                                            //         return false;
                                            //     }
                                            // }
                                            
                                            // For Industry and other sectors - no validation required
                                            errorSpan.style.display = 'none';
                                            return true;
                                        }

                                        // Validate on form submit
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const form = document.querySelector('form');
                                            if (form) {
                                                form.addEventListener('submit', function(e) {
                                                    if (!validateEmail1()) {
                                                        e.preventDefault();
                                                        alert('Please enter a valid email address.');
                                                        document.getElementById('email1').focus();
                                                    }
                                                });
                                            }
                                        });
                                    </script>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="phone1">Phone<span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6">
                                            <!-- Input for phone number with country code selection -->
                                            <input type="text" id="phone1" name="phone1" class="form-control"
                                                value="<?php echo isset($attendees[0]['phone']) ? $attendees[0]['phone'] : ''; ?>"
                                                placeholder="Enter phone number"
                                                title="" >
                                        </div>
                                    </div>

                                 
                                    <!-- ask for government id type(dropdown) and government id number -->
                                    <!-- <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_type1">Government
                                                ID Type<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <select id="government_id_type1" name="government_id_type1"
                                                    class="form-control">
                                                    <option value="">Select Government ID Type</option>
                                                    <option value="Aadhar Card" <?php /*  echo (isset($attendees[0]['government_id_type']) && $attendees[0]['government_id_type'] == 'Aadhar Card') ? 'selected' : ''; */ ?>>Aadhar Card</option>
                                                    <option value="Passport" <?php /* echo (isset($attendees[0]['government_id_type']) && $attendees[0]['government_id_type'] == 'Passport') ? 'selected' : '';*/ ?>>Passport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_number1">Government
                                                ID Number<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="government_id_number1" name="government_id_number1"
                                                    class="form-control"
                                                    value="<?php /* echo isset($attendees[0]['government_id_number']) ? $attendees[0]['government_id_number'] : '';  */ ?>"
                                                    oninput="validateGovernmentID()">
                                                <span id="govt-id-error" style="color: red; display: none;"></span>
                                            </div>
                                        </div>-->
                                </div>

                                <!-- Attendee 2 -->
                                <div id="attendee2" class="attendee-fields" style="display:none;">
                                    <h3 align=center>Attendee 2 Details</h3>
                                    <!-- Same structure as Attendee 1 -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="title2">Title<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select id="title2" name="title2" class="form-control">
                                                <option value="">Select Title</option>
                                                <option value="Mr." <?php echo (isset($attendees[1]['title']) && $attendees[1]['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr. </option>
                                                <option value="Mrs." <?php echo (isset($attendees[1]['title']) && $attendees[1]['title'] == 'Mrs.') ? 'selected' : ''; ?>> Mrs.
                                                </option>
                                                <option value="Ms." <?php echo (isset($attendees[1]['title']) && $attendees[1]['title'] == 'Ms.') ? 'selected' : ''; ?>>Ms. </option>
                                                <option value="Dr." <?php echo (isset($attendees[1]['title']) && $attendees[1]['title'] == 'Dr.') ? 'selected' : ''; ?>>Dr. </option>
                                                <option value="Mx." <?php echo (isset($attendees[1]['title']) && $attendees[1]['title'] == 'Mx.') ? 'selected' : ''; ?>>Mx.
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="firstname3">First
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="firstname2" name="firstname2" class="form-control"
                                                value="<?php echo isset($attendees[1]['first_name']) ? $attendees[1]['first_name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="lastname2">Last Name<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="lastname2" name="lastname2" class="form-control"
                                                value="<?php echo isset($attendees[1]['last_name']) ? $attendees[1]['last_name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email2">Email<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="email" id="email2" name="email2" class="form-control"
                                                value="<?php echo isset($attendees[1]['email']) ? $attendees[1]['email'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="phone2">Phone<span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6">
                                            <!-- Input for phone number with country code selection -->
                                            <input type="text" id="phone2" name="phone2" class="form-control"
                                                value="<?php echo isset($attendees[1]['phone']) ? $attendees[1]['phone'] : ''; ?>"
                                                placeholder="Enter phone number">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="designation2">Designation<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="designation2" name="designation2" class="form-control"
                                                value="<?php echo isset($attendees[1]['designation']) ? $attendees[1]['designation'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- ask for government id type(dropdown) and government id number -->
                                    <!-- <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_type2">Government
                                                ID Type<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <select id="government_id_type2" name="government_id_type2"
                                                    class="form-control">
                                                    <option value="">Select Government ID Type</option>
                                                    <option value="Aadhar Card" <?php /* echo (isset($attendees[1]['government_id_type']) && $attendees[1]['government_id_type'] == 'Aadhar Card') ? 'selected' : ''; */ ?>>Aadhar Card</option>
                                                    <option value="Passport" <?php /* echo (isset($attendees[1]['government_id_type']) && $attendees[1]['government_id_type'] == 'Passport') ? 'selected' : ''; */ ?>>Passport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_number2">Government
                                                ID Number<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="government_id_number2" name="government_id_number2"
                                                    class="form-control"
                                                    value="<?php /* echo isset($attendees[1]['government_id_number']) ? $attendees[1]['government_id_number'] : ''; */ ?>"
                                                    oninput="validateGovernmentID()">
                                            </div>
                                        </div>-->
                                </div>

                                <!-- Attendee 3 -->
                                <div id="attendee3" class="attendee-fields" style="display:none;">
                                    <h3 align=center>Attendee 3 Details</h3>
                                    <!-- Same structure as Attendee 1 -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="title3">Title<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select id="title3" name="title3" class="form-control">
                                                <option value="">Select Title</option>
                                                <option value="Mr." <?php echo (isset($attendees[2]['title']) && $attendees[2]['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr.
                                                </option>
                                                <option value="Mrs." <?php echo (isset($attendees[2]['title']) && $attendees[2]['title'] == 'Mrs.') ? 'selected' : ''; ?>>
                                                    Mrs.
                                                </option>
                                                <option value="Ms." <?php echo (isset($attendees[2]['title']) && $attendees[2]['title'] == 'Ms.') ? 'selected' : ''; ?>>Ms.
                                                </option>
                                                <option value="Dr." <?php echo (isset($attendees[2]['title']) && $attendees[2]['title'] == 'Dr.') ? 'selected' : ''; ?>>Dr.
                                                </option>
                                                <option value="Mx." <?php echo (isset($attendees[2]['title']) && $attendees[2]['title'] == 'Mx.') ? 'selected' : ''; ?>>
                                                    Mx.
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="firstname3">First
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="firstname3" name="firstname3" class="form-control"
                                                value="<?php echo isset($attendees[2]['first_name']) ? $attendees[2]['first_name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="lastname3">Last
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="lastname3" name="lastname3" class="form-control"
                                                value="<?php echo isset($attendees[2]['last_name']) ? $attendees[2]['last_name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email3">Email<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="email" id="email3" name="email3" class="form-control"
                                                value="<?php echo isset($attendees[2]['email']) ? $attendees[2]['email'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="phone3">Phone<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="phone3" name="phone3" placeholder="+91-9876543210"
                                                class="form-control"
                                                value="<?php echo isset($attendees[2]['phone']) ? $attendees[2]['phone'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="designation3">Designation<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="designation3" name="designation3" class="form-control"
                                                value="<?php echo isset($attendees[2]['designation']) ? $attendees[2]['designation'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- ask for government id type(dropdown) and government id number -->
                                    <!-- <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_type3">Government
                                                ID Type<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <select id="government_id_type3" name="government_id_type3"
                                                    class="form-control">
                                                    <option value="">Select Government ID Type</option>
                                                    <option value="Aadhar Card" <?php /* echo (isset($attendees[2]['government_id_type']) && $attendees[2]['government_id_type'] == 'Aadhar Card') ? 'selected' : ''; */ ?>>Aadhar Card</option>
                                                    <option value="Passport" <?php /* echo (isset($attendees[2]['government_id_type']) && $attendees[2]['government_id_type'] == 'Passport') ? 'selected' : '';*/ ?>>Passport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_number3">Government
                                                ID Number<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="government_id_number3" name="government_id_number3"
                                                    class="form-control"
                                                    value="<?php /* echo isset($attendees[2]['government_id_number']) ? $attendees[2]['government_id_number'] : ''; */ ?>"
                                                    oninput="validateGovernmentID()">
                                            </div>
                                        </div>-->
                                </div>

                                <!-- Repeat the same for up to 7 attendees -->
                                <div id="attendee4" class="attendee-fields" style="display:none;">
                                    <h3 align=center>Attendee 4 Details</h3>
                                    <!-- Same structure as Attendee 1 -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="title4">Title<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select id="title4" name="title4" class="form-control">
                                                <option value="">Select Title</option>
                                                <option value="Mr." <?php echo (isset($attendees[3]['title']) && $attendees[3]['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr.
                                                </option>
                                                <option value="Mrs." <?php echo (isset($attendees[3]['title']) && $attendees[3]['title'] == 'Mrs.') ? 'selected' : ''; ?>>
                                                    Mrs. </option>
                                                <option value="Ms." <?php echo (isset($attendees[3]['title']) && $attendees[3]['title'] == 'Ms.') ? 'selected' : ''; ?>>Ms.
                                                </option>
                                                <option value="Dr." <?php echo (isset($attendees[3]['title']) && $attendees[3]['title'] == 'Dr.') ? 'selected' : ''; ?>>Dr.
                                                </option>
                                                <option value="Mx." <?php echo (isset($attendees[3]['title']) && $attendees[3]['title'] == 'Mx.') ? 'selected' : ''; ?>>
                                                    Mx.
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="firstname4">First
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="firstname4" name="firstname4" class="form-control"
                                                value="<?php echo isset($attendees[3]['first_name']) ? $attendees[3]['first_name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="lastname4">Last
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="lastname4" name="lastname4" class="form-control"
                                                value="<?php echo isset($attendees[3]['last_name']) ? $attendees[3]['last_name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email4">Email<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="email" id="email4" name="email4" class="form-control"
                                                value="<?php echo isset($attendees[3]['email']) ? $attendees[3]['email'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="phone4">Phone<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="phone4" name="phone4" placeholder="+91-9876543210"
                                                class="form-control"
                                                value="<?php echo isset($attendees[3]['phone']) ? $attendees[3]['phone'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="designation4">Designation<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="designation4" name="designation4" class="form-control"
                                                value="<?php echo isset($attendees[3]['designation']) ? $attendees[3]['designation'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- ask for government id type(dropdown) and government id number -->
                                    <!-- <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_type4">Government
                                                ID Type<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <select id="government_id_type4" name="government_id_type4"
                                                    class="form-control">
                                                    <option value="">Select Government ID Type</option>
                                                    <option value="Aadhar Card" <?php /* echo (isset($attendees[3]['government_id_type']) && $attendees[3]['government_id_type'] == 'Aadhar Card') ? 'selected' : ''; */ ?>>Aadhar Card</option>
                                                    <option value="Passport" <?php /* echo (isset($attendees[3]['government_id_type']) && $attendees[3]['government_id_type'] == 'Passport') ? 'selected' : ''; */ ?>>Passport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_number4">Government
                                                ID Number<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="government_id_number4" name="government_id_number4"
                                                    class="form-control"
                                                    value="<?php echo isset($attendees[3]['government_id_number']) ? $attendees[3]['government_id_number'] : ''; ?>"
                                                    oninput="validateGovernmentID()">
                                            </div>
                                        </div> -->
                                </div>
                                <div id="attendee5" class="attendee-fields" style="display:none;">
                                    <h3 align=center>Attendee 5 Details</h3>
                                    <!-- Same structure as Attendee 1 -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="title5">Title<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select id="title5" name="title5" class="form-control">
                                                <option value="">Select Title</option>
                                                <option value="Mr." <?php echo (isset($attendees[4]['title']) && $attendees[4]['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr.
                                                </option>
                                                <option value="Mrs." <?php echo (isset($attendees[4]['title']) && $attendees[4]['title'] == 'Mrs.') ? 'selected' : ''; ?>>
                                                    Mrs.
                                                </option>
                                                <option value="Ms." <?php echo (isset($attendees[4]['title']) && $attendees[4]['title'] == 'Ms.') ? 'selected' : ''; ?>>Ms.
                                                </option>
                                                <option value="Dr." <?php echo (isset($attendees[4]['title']) && $attendees[4]['title'] == 'Dr.') ? 'selected' : ''; ?>>Dr.
                                                </option>
                                                <option value="Mx." <?php echo (isset($attendees[4]['title']) && $attendees[4]['title'] == 'Mx.') ? 'selected' : ''; ?>>
                                                    Mx.
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="firstname5">First
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="firstname5" name="firstname5" class="form-control"
                                                value="<?php echo isset($attendees[4]['first_name']) ? $attendees[4]['first_name'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="lastname5">Last
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="lastname5" name="lastname5" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email5">Email<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="email" id="email5" name="email5" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="phone5">Phone<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="phone5" name="phone5" placeholder="+91-9876543210"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="designation5">Designation<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="designation5" name="designation5" class="form-control">

                                        </div>
                                    </div>
                                    <!-- ask for government id type(dropdown) and government id number -->
                                    <!-- <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_type5">Government
                                                ID Type<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <select id="government_id_type5" name="government_id_type5"
                                                    class="form-control">
                                                    <option value="">Select Government ID Type</option>
                                                    <option value="Aadhar Card" <?php /* echo (isset($attendees[4]['government_id_type']) && $attendees[4]['government_id_type'] == 'Aadhar Card') ? 'selected' : ''; */ ?>>Aadhar Card</option>
                                                    <option value="Passport" <?php /* echo (isset($attendees[4]['government_id_type']) && $attendees[4]['government_id_type'] == 'Passport') ? 'selected' : ''; */ ?>>Passport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_number5">Government
                                                ID Number<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="government_id_number5" name="government_id_number5"
                                                    class="form-control"
                                                    value="<?php /* echo isset($attendees[4]['government_id_number']) ? $attendees[4]['government_id_number'] : ''; */ ?>"
                                                    oninput="validateGovernmentID()">
                                            </div>
                                        </div> -->
                                </div>
                                <div id="attendee6" class="attendee-fields" style="display:none;">
                                    <h3 align=center>Attendee 6 Details</h3>
                                    <!-- Same structure as Attendee 1 -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="title6">Title<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select id="title6" name="title6" class="form-control">
                                                <option value="">Select Title</option>
                                                <option value="Mr." <?php echo (isset($attendees[5]['title']) && $attendees[5]['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr.
                                                </option>
                                                <option value="Mrs." <?php echo (isset($attendees[5]['title']) && $attendees[5]['title'] == 'Mrs.') ? 'selected' : ''; ?>>
                                                    Mrs.
                                                </option>
                                                <option value="Ms." <?php echo (isset($attendees[5]['title']) && $attendees[5]['title'] == 'Ms.') ? 'selected' : ''; ?>>Ms.
                                                </option>
                                                <option value="Dr." <?php echo (isset($attendees[5]['title']) && $attendees[5]['title'] == 'Dr.') ? 'selected' : ''; ?>>Dr.
                                                </option>
                                                <option value="Mx." <?php echo (isset($attendees[5]['title']) && $attendees[5]['title'] == 'Mx.') ? 'selected' : ''; ?>>
                                                    Mx.
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="firstname6">First
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="firstname6" name="firstname6" class="form-control"
                                                value="<?php echo isset($attendees[5]['first_name']) ? $attendees[5]['first_name'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=" col-md-3 control-label" for="lastname6">Last
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="lastname6" name="lastname6" class="form-control"
                                                value="<?php echo isset($attendees[5]['last_name']) ? $attendees[5]['last_name'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=" col-md-3 control-label" for="email6">Email<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="email" id="email6" name="email6" class="form-control"
                                                value="<?php echo isset($attendees[5]['email']) ? $attendees[5]['email'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=" col-md-3 control-label" for="phone6">Phone<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="phone6" name="phone6" placeholder="+91-9876543210"
                                                class="form-control"
                                                value="<?php echo isset($attendees[5]['phone']) ? $attendees[5]['phone'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class=" col-md-3 control-label" for="designation6">Designation<span
                                                class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="designation6" name="designation6" class="form-control"
                                                value="<?php echo isset($attendees[5]['designation']) ? $attendees[5]['designation'] : ''; ?>">
                                        </div>
                                    </div>
                                    <!-- ask for government id type(dropdown) and government id number -->
                                    <!-- <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_type6">Government
                                                ID Type<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <select id="government_id_type6" name="government_id_type6"
                                                    class="form-control">
                                                    <option value="">Select Government ID Type</option>
                                                    <option value="Aadhar Card" <?php /* echo (isset($attendees[5]['government_id_type']) && $attendees[5]['government_id_type'] == 'Aadhar Card') ? 'selected' : ''; */ ?>>Aadhar Card</option>
                                                    <option value="Passport" <?php /* echo (isset($attendees[5]['government_id_type']) && $attendees[5]['government_id_type'] == 'Passport') ? 'selected' : ''; */ ?>>Passport</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="government_id_number6">Government
                                                ID Number<span class="dips-required"> *
                                                </span></label>
                                            <div class="col-md-6">
                                                <input type="text" id="government_id_number6" name="government_id_number6"
                                                    class="form-control"
                                                    value="<?php echo isset($attendees[5]['government_id_number']) ? $attendees[5]['government_id_number'] : ''; ?>"
                                                    oninput="validateGovernmentID()">
                                            </div>
                                        </div> -->
                                </div>
                                <div id="attendee7" class="attendee-fields" style="display:none;">
                                    <h3 align=center>Attendee 7 Details</h3>
                                    <!-- Same structure as Attendee 1 -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="title7">Title<span class="dips-required">
                                                *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select id="title7" name="title7" class="form-control">
                                                <option value="">Select Title</option>
                                                <option value="Mr." <?php echo (isset($attendees[6]['title']) && $attendees[6]['title'] == 'Mr.') ? 'selected' : ''; ?>>Mr.
                                                </option>
                                                <option value="Mrs." <?php echo (isset($attendees[6]['title']) && $attendees[6]['title'] == 'Mrs.') ? 'selected' : ''; ?>>
                                                    Mrs.
                                                </option>
                                                <option value="Ms." <?php echo (isset($attendees[6]['title']) && $attendees[6]['title'] == 'Ms.') ? 'selected' : ''; ?>>Ms.
                                                </option>
                                                <option value="Dr." <?php echo (isset($attendees[6]['title']) && $attendees[6]['title'] == 'Dr.') ? 'selected' : ''; ?>>Dr.
                                                </option>
                                                <option value="Mx." <?php echo (isset($attendees[6]['title']) && $attendees[6]['title'] == 'Mx.') ? 'selected' : ''; ?>>
                                                    Mx.
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="firstname7">First
                                            Name<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="firstname7" name="firstname7" class="form-control"
                                                value="<?php echo isset($attendees[6]['first_name']) ? $attendees[6]['first_name'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="lastname7">Last
                                            Name<span class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="lastname7" name="lastname7" class="form-control"
                                                value="<?php echo isset($attendees[6]['last_name']) ? $attendees[6]['last_name'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="email7">Email<span
                                                class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="email" id="email7" name="email7" class="form-control"
                                                value="<?php echo isset($attendees[6]['email']) ? $attendees[6]['email'] : ''; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="phone7">Phone<span
                                                class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="phone7" name="phone7" placeholder="+91-9876543210"
                                                class="form-control"
                                                value="<?php echo isset($attendees[6]['phone']) ? $attendees[6]['phone'] : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="designation7">Designation<span
                                                class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" id="designation7" name="designation7" class="form-control"
                                                value="<?php echo isset($attendees[6]['designation']) ? $attendees[6]['designation'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>




                                <!-- Ask user if GST is required -->
                                <?php if ($citizen != 'Foreign'): ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Do you require GST?<span class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="gstDropdown" name="gst">
                                                <option value="No" <?= isset($_SESSION['gst']) && $_SESSION['gst'] === 'No' ? 'selected' : '' ?>>No
                                                </option>
                                                <option value="Yes" <?= isset($_SESSION['gst']) && $_SESSION['gst'] === 'Yes' ? 'selected' : '' ?>>Yes
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                <?php endif; ?>


                                <!-- GST fields -->
                                <div id="gstFields"
                                    style="<?= isset($_SESSION['gst']) && $_SESSION['gst'] === 'Yes' ? '' : 'display: none;' ?>">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">GST Number<span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="gstNumber" name="gstNumber"
                                                placeholder="Enter GST Number" value="<?= $_SESSION['gstNumber'] ?? '' ?>">
                                            <div id="gstNumber-error" style="color: red; display: none;"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">PAN Number<span class="dips-required">
                                                *</span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="panNumber" name="panNumber"
                                                placeholder="Enter PAN Number" value="<?= $_SESSION['panNumber'] ?? '' ?>">
                                            <div id="panNumber-error" style="color: red; display: none;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Invoice Address<span class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="invoiceAddress"
                                                name="invoiceAddress" placeholder="Enter Invoice Address"
                                                value="<?= $_SESSION['invoiceAddress'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">State<span class="dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="gst_inv_state" id="gst_inv_state">
                                                <option value="">Select State</option>
                                                <?php
                                                $indianStates = array(
                                                    "Andhra Pradesh",
                                                    "Arunachal Pradesh",
                                                    "Assam",
                                                    "Bihar",
                                                    "Chhattisgarh",
                                                    "Goa",
                                                    "Gujarat",
                                                    "Haryana",
                                                    "Himachal Pradesh",
                                                    "Jammu and Kashmir",
                                                    "Jharkhand",
                                                    "Karnataka",
                                                    "Kerala",
                                                    "Madhya Pradesh",
                                                    "Maharashtra",
                                                    "Manipur",
                                                    "Meghalaya",
                                                    "Mizoram",
                                                    "Nagaland",
                                                    "Odisha",
                                                    "Punjab",
                                                    "Rajasthan",
                                                    "Sikkim",
                                                    "Tamil Nadu",
                                                    "Telangana",
                                                    "Tripura",
                                                    "Uttar Pradesh",
                                                    "Uttarakhand",
                                                    "West Bengal",
                                                    "Andaman and Nicobar Islands",
                                                    "Chandigarh",
                                                    "Dadra and Nagar Haveli",
                                                    "Daman and Diu",
                                                    "Lakshadweep",
                                                    "Delhi",
                                                    "Puducherry"
                                                );

                                                $selectedState = isset($_SESSION['gst_inv_state']) ? $_SESSION['gst_inv_state'] : '';

                                                foreach ($indianStates as $state) {
                                                    $selected = ($state == $selectedState) ? 'selected' : '';
                                                    echo "<option value=\"$state\" $selected>$state</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact Person Name<span
                                                class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="contactPersonName"
                                                name="contactPersonName" placeholder="Enter Contact Person Name"
                                                value="<?= $_SESSION['contactPersonName'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email<span class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" id="contactPersonEmail"
                                                name="contactPersonEmail" placeholder="Enter Email"
                                                value="<?= $_SESSION['contactPersonEmail'] ?? '' ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Phone<span class=" dips-required"> *
                                            </span></label>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" id="contactPersonPhone"
                                                name="contactPersonPhone" maxlength="10" min="0" max="9999999999"
                                                placeholder="Enter Phone Number"
                                                value="<?= isset($_SESSION['contactPersonPhone']) ? preg_replace('/\D/', '', $_SESSION['contactPersonPhone']) : '' ?>"
                                                oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,10);">
                                        </div>
                                    </div>
                                </div>


                                <!-- Promo Code Section -->
                                <div class="form-group"
                                    style="margin-top:20px; border-top: 2px solid #ccc; padding-top: 20px;">
                                    <!-- <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <div class="checkbox">
                                                    <label> -->
                                    <!-- Increase text size for better visibility -->
                                    <!-- <input type="hidden" name="gem_connect" value="No">
                                                        <input type="checkbox" name="gem_connect" id="gem_connect"
                                                            value="Yes" <?php /*  echo (isset($_SESSION['gem_connect']) && $_SESSION['gem_connect'] == 'Yes') ? 'checked' : 'checked'; */ ?>
                                                            style="width: 20px; height: 20px;">
                                                        &nbsp;&nbsp; I would like to register on GeM Portal. (GeM will
                                                        connect
                                                        with you.)
                                                    </label>
                                                </div>
                                            </div>
                                        </div> -->
                                    <label class="col-md-3 control-label" style="color:black;">Enter
                                        if you have a promo code</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="promoCode" name="promoCode"
                                                placeholder="Enter Promo Code">
                                            <span class="input-group-btn">
                                                <button type="button" id="verifyPromoCode" style="margin-left: 10px;"
                                                    class="btn btn-danger">Apply
                                                    Promo Code</button>
                                            </span>
                                        </div>
                                        <div id="promoCodeMessage" class="mt-2"></div>
                                    </div>
                                    <!-- write a message that click on apply promocode button to apply promo code -->
                                    <div class="col-md-6 col-md-offset-3">
                                        <span class="help-block" style="color: #666; font-size: 12px;">Note: If you
                                            have
                                            a
                                            promo code, please click on "Apply Promo Code" button to apply
                                            it.</span>
                                    </div>

                                </div>



                                <!-- CAPTCHA Section -->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enter the captcha <span class="dips-required">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group" style="display: inline-flex;align-items: center;width: 100%;">
                                            <input name="vercode" id="captcha" type="text" class="form-control"
                                                maxlength="10" required autocomplete="off" />
                                            <input name="test" type="hidden" id="test"
                                                value="<?php echo $_SESSION["vercode_reg"]; ?>" />
                                            <span class="input-group-addon" id="captcha-display"
                                                style="background-image: url('images/verify_img_bg.JPG');text-align: center;font-size: 32px;padding: 0 15px 1px;width: 200px; user-select: none; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; cursor: default;"
                                                oncopy="return false;" onmousedown="return false;" onselectstart="return false;" oncontextmenu="return false;" tabindex="-1" aria-readonly="true">
                                                <?php echo $_SESSION["vercode_reg"]; ?>
                                            </span>
                                            <script>
                                                // Prevent copying, selecting, and context menu on captcha-display
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var el = document.getElementById('captcha-display');
                                                    if (el) {
                                                        el.addEventListener('copy', function(e) { e.preventDefault(); });
                                                        el.addEventListener('cut', function(e) { e.preventDefault(); });
                                                        el.addEventListener('paste', function(e) { e.preventDefault(); });
                                                        el.addEventListener('contextmenu', function(e) { e.preventDefault(); });
                                                        el.addEventListener('mousedown', function(e) { e.preventDefault(); });
                                                        el.addEventListener('selectstart', function(e) { e.preventDefault(); });
                                                        el.setAttribute('unselectable', 'on');
                                                        el.style.pointerEvents = 'none';
                                                    }
                                                });
                                            </script>
                                            <button type="button" class="btn btn-default" onclick="refreshCaptcha()" style="border-left: none;font-size: 19px;padding: 4px 18px 4px 8px;">🔄</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-6">
                                            <div class="cf-turnstile" data-sitekey="0x4AAAAAABS3bHh2QhL_LvBM"></div>
                                        </div>
                                    </div> -->
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-7">
                                            <p style="float:right;">
                                                <button type="submit" class="btn btn-primary sbold uppercase">
                                                    Preview
                                                    <i class="fa fa-angle-right"></i>
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    <?php } else { ?>
                        <div class="alert alert-danger">Super Computing India Registration has closed. </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("org_reg_type").addEventListener("change", function() {
            document.getElementById("bs_org_reg_type").value = this.value;
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function validateGovernmentID(input, showError = false) {
                const idType = document.getElementById(input.id.replace("number", "type")); // Get corresponding ID type field
                const errorMsg = document.getElementById(input.id + "-error"); // Unique error message container
                const idNumber = input.value.trim();

                if (!errorMsg) return true; // Skip if error container is missing

                // Skip validation if the field is empty (optional fields)
                if (!idNumber) {
                    errorMsg.style.display = "none";
                    return true;
                }

                if (idType) {
                    const idTypeValue = idType.value;
                    if (idTypeValue === "Aadhar Card") {
                        if (!/^\d{12}$/.test(idNumber)) {
                            if (showError) {
                                errorMsg.innerText = "Aadhar Card number must be exactly 12 digits.";
                                errorMsg.style.display = "block";
                                input.focus();
                            }
                            return false;
                        }
                    } else if (idTypeValue === "Passport") {
                        if (!/^[\s\S]+$/.test(idNumber)) {
                            if (showError) {
                                errorMsg.innerText = "Enter a valid passport number (5-9 alphanumeric characters).";
                                errorMsg.style.display = "block";
                                input.focus();
                            }
                            return false;
                        }
                    } else {
                        if (showError) {
                            errorMsg.innerText = "Please select a Government ID Type.";
                            errorMsg.style.display = "block";
                            idType.focus();
                        }
                        return false;
                    }
                }

                errorMsg.style.display = "none";
                return true;
            }

            // Attach validation event listeners to all Government ID fields (1-5)
            for (let i = 1; i <= 6; i++) {
                let input = document.getElementById("government_id_number" + i);
                if (input) {
                    // Create a unique error message container if it doesn't exist
                    if (!document.getElementById(input.id + "-error")) {
                        let errorDiv = document.createElement("div");
                        errorDiv.id = input.id + "-error";
                        errorDiv.style.color = "red";
                        errorDiv.style.display = "none";
                        input.parentNode.appendChild(errorDiv);
                    }

                    // Validate when the user leaves the field (on blur)
                    input.addEventListener("blur", function() {
                        validateGovernmentID(input, false);
                    });
                }
            }

            // Validate only filled fields on form submission
            document.querySelector("form").addEventListener("submit", function(event) {
                let isValid = true;
                for (let i = 1; i <= 6; i++) {
                    let input = document.getElementById("government_id_number" + i);
                    if (input && input.value.trim() !== "" && !validateGovernmentID(input, true)) {
                        isValid = false;
                    }
                }
                if (!isValid) {
                    event.preventDefault(); // Prevent form submission only if a filled field is invalid
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gstNumberInput = document.getElementById('gstNumber');
            const panNumberInput = document.getElementById('panNumber');
            const gstError = document.getElementById('gstNumber-error');
            const panError = document.getElementById('panNumber-error');

            function validateGST() {
                const gstNumber = gstNumberInput.value.trim();
                const gstPattern = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[A-Z0-9]{1}[Z]{1}[A-Z0-9]{1}$/;

                if (!gstNumber) {
                    gstError.style.display = "none"; // Hide error if empty
                    return true;
                }

                if (!gstPattern.test(gstNumber)) {
                    gstError.innerText = "Invalid GST Number. Format: 22AAAAA0000A1Z5";
                    gstError.style.display = "block";
                    return false;
                }

                gstError.style.display = "none";
                return true;
            }

            function validatePAN() {
                const panNumber = panNumberInput.value.trim();
                const panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

                if (!panNumber) {
                    panError.style.display = "none"; // Hide error if empty
                    return true;
                }

                if (!panPattern.test(panNumber)) {
                    panError.innerText = "Invalid PAN Number. Format: AAAAA0000A";
                    panError.style.display = "block";
                    return false;
                }

                panError.style.display = "none";
                return true;
            }

            // Validate on input
            gstNumberInput.addEventListener('input', validateGST);
            panNumberInput.addEventListener('input', validatePAN);

            // Validate on form submission
            document.querySelector("form").addEventListener("submit", function(event) {
                if (!validateGST() || !validatePAN()) {
                    event.preventDefault(); // Stop form submission if validation fails
                }
            });
        });
    </script>
    <script>
        // Function to toggle visibility of GST fields
        document.getElementById("gstDropdown").addEventListener("change", function() {
            const gstFields = document.getElementById("gstFields");
            const isRequired = this.value === "Yes";

            // Toggle visibility of GST fields
            gstFields.style.display = isRequired ? "block" : "none";

            // Get all input fields inside GST fields
            const inputs = gstFields.querySelectorAll("input");
            inputs.forEach(input => {
                input.required = isRequired; // Set required attribute
                if (!isRequired) {
                    input.value = ""; // Clear the input fields if not required
                }
            });
        });
    </script>


    <script>
        // Function to show/hide attendee fields and toggle "required" attribute
        function showAttendeeFields() {
            const attendeesSelect = document.getElementById("attendees");
            const selectedValue = attendeesSelect.value;
            
            // Return if nothing is selected
            if (!selectedValue) return;
            
            // Check if it's a student package (text value contains "Students") or number of attendees
            const isStudentPackage = selectedValue.includes("Smart Campus Pack - Silver") ||
                                     selectedValue.includes("Smart Campus Pack - Gold") ||
                                     selectedValue.includes("Next Gen HPC Experience");
            const numberOfAttendees = isStudentPackage ? 1 : parseInt(selectedValue, 10);

            // Hide all attendee fields initially and remove the "required" attribute
            for (let i = 1; i <= 7; i++) {
                const attendeeField = document.getElementById(`attendee${i}`);
                if (attendeeField) {
                    attendeeField.style.display = 'none';

                    // Get all input fields and title fields inside the attendee container and remove "required"
                    const inputs = attendeeField.querySelectorAll('input, select'); // Ensure `title` fields (if select) are included
                    inputs.forEach(input => {
                        input.required = false;
                    });
                }
            }

            // Show fields based on the selected number of attendees and set "required" attribute for visible fields
            // For student packages, only show attendee1 (Contact Details)
            for (let i = 1; i <= numberOfAttendees; i++) {
                const attendeeField = document.getElementById(`attendee${i}`);
                if (attendeeField) {
                    attendeeField.style.display = 'block';

                    // Get all input fields and title fields inside the attendee container and set "required"
                    const inputs = attendeeField.querySelectorAll('input, select'); // Add `select` if title is a dropdown
                    inputs.forEach(input => {
                        // Skip the id_card1 field - it has its own conditional logic
                        if (input.id === 'id_card1') {
                            return; // Skip this field
                        }
                        
                        // Only set required if the field's parent is visible
                        const parentDiv = input.closest('.form-group');
                        if (parentDiv && (parentDiv.style.display === 'none' || window.getComputedStyle(parentDiv).display === 'none')) {
                            input.required = false;
                        } else {
                            input.required = true;
                        }
                    });
                }
            }
        }

        // Run the function on page load if there is a session value
        window.onload = function() {
            <?php if ($del == 'nextgen') { ?>
                // For student packages, set the package value from session
                <?php if (isset($_SESSION['package']) && $_SESSION['package'] != '') { ?>
                    document.getElementById("attendees").value = "<?php echo $_SESSION['package']; ?>";
                    showAttendeeFields();
                <?php } ?>
            <?php } else { ?>
                // For regular attendees, set the count
                const attendeesCount = <?php echo $attendeesCount ? $attendeesCount : 1; ?>;
                document.getElementById("attendees").value = attendeesCount;
                showAttendeeFields(); // Trigger the function to show attendee fields based on the session value
            <?php } ?>
        };
    </script>

    <?php require 'form_includes/reg_form_footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        //onsubmit of the form, if country is empty alert to select one of the country and don't submit the form
        $('#registration_form_1').submit(function() {
            if ($('#country').val() == '') {
                alert('Please select one of the country');
                return false;
            }
        });
        //select value of total_dele alert to select one of the option
        $('#total_dele').change(function() {
            if ($(this).val() == 'Select') {
                alert('Please select one of the options');
            }
        });
        // Verify promo code
        $(document).ready(function() {
            $('#verifyPromoCode').on('click', function() {
                var promoCode = $('#promoCode').val();
                var attendeesCount = $('#attendees').val();
                $.ajax({
                    url: 'promocode_script.php',
                    type: 'POST',
                    data: {
                        promoCode: promoCode,
                        attendeesCount: attendeesCount
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.valid) {
                            // Check if TEST51 promocode and show custom message
                            if (response.promoCode === 'TEST51') {
                                $('#promoCodeMessage').html(response.message);
                            } else if (response.ticket_category && response.venue) {
                                // Updated message format
                                $('#promoCodeMessage').html(
                                    'You are eligible for ' +
                                    response.discount +
                                    '% Discount at ' +
                                    response.venue +
                                    ' for ' +
                                    response.ticket_category +
                                    '.'
                                );
                            } else if (response.discount == 500) {
                                $('#promoCodeMessage').html(
                                    'You are eligible for Rs. ' + response.discount + ' Discount.'
                                );
                            } else {
                                $('#promoCodeMessage').html(
                                    'You are eligible for ' + response.discount + '% Discount.'
                                );
                            }

                            // Store the promo code in a hidden field
                            $('#promoCodeHidden').val(response.promoCode);
                        } else {
                            $('#promoCodeMessage').html(response.message);
                            $('#promoCodeHidden').val(''); // Clear the promo code
                        }
                    },
                    error: function() {
                        $('#promoCodeMessage').html('Error communicating with server.');
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        var assoc_name = '<?php echo $assoc_name; ?>';
    </script>
    <script src="forms-js/registration-test.js?sagar"></script>
    <script src="forms_assets/telephoneWithFlags/js/intlTelInput.js"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('org');

            emailInput.addEventListener('input', function() {
                // Remove any script tags or potentially harmful content
                const sanitizedValue = emailInput.value.replace(/<script.?>.?<\/script>/gi, '');
                if (emailInput.value !== sanitizedValue) {
                    emailInput.value = sanitizedValue;
                }
            });
        });
    </script>

    <script>
        jQuery(document).ready(function() {
            Registration.init('registration_form_1', 0);
            $("#telCountryIsoCode").intlTelInput();

            showInvoiceData();
        });

        // function showPayment() {
        //     $('#bite').show();
        //     $('#bib').hide();
        // }

        function showPromo() {
            var valie = $('#event_know').val();
            if (valie == 'Others') {
                $('#other-div').show();
            } else {
                $('#other-div').hide();
            }
        }

        function showInvoiceData() {
            $('#gst-div').hide();
            $('#gstorg').hide();
            if ($('#is_gst_invoice_needed').val() == 'Yes') {
                $('#gst-div').show();
                $('#gstorg').show();
            }
        }
        //if vercode_reg and vercode doesn't match with the entered value, then alert the user
        $('#registration_form_1').submit(function() {
            if ($('#captcha').val() != $('#test').val()) {
                alert('Invalid Captcha');
                return false;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize intl-tel-input on all phone inputs from phone1 to phone7
            var phoneInputs = [];
            for (var i = 1; i <= 7; i++) {
                var input = document.querySelector("#phone" + i);
                if (input) {
                    // Set input type to 'text' to avoid browser auto-formatting issues
                    input.setAttribute('type', 'text');

                    var iti = window.intlTelInput(input, {
                        initialCountry: "in", // Set initial country (India by default)
                        separateDialCode: true, // Show the country code separately
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Utility for validation
                    });
                    
                    // Set initial maxlength for India (10 digits)
                    input.setAttribute('maxlength', '10');
                    
                    // Function to update maxlength based on country
                    function updatePhoneMaxLength(input, iti) {
                        var dialCode = iti.getSelectedCountryData().dialCode;
                        var countryCode = iti.getSelectedCountryData().iso2;
                        var isIndia = (dialCode == '91' || dialCode == 91 || countryCode === 'in');
                        input.setAttribute('maxlength', isIndia ? '10' : '15');
                    }
                    
                    // Update maxlength and validate when country changes
                    // Use closure to ensure correct iti reference
                    (function(inputElement, itiInstance, inputId) {
                        inputElement.addEventListener('countrychange', function() {
                            updatePhoneMaxLength(inputElement, itiInstance);
                            // Validate immediately when country changes if there's a value
                            if (inputElement.value.trim() !== '') {
                                validatePhoneNumber(inputElement, itiInstance, inputId, false);
                            } else {
                                // Clear any existing errors when country changes and field is empty
                                hidePhoneError(inputId);
                            }
                        });
                    })(input, iti, input.id);
                    
                    // Set initial maxlength
                    updatePhoneMaxLength(input, iti);
                    
                    // Add dynamic oninput handler to restrict to digits only and respect maxlength
                    // Store iti reference in closure for use in event handlers
                    (function(inputElement, itiInstance, inputId) {
                        inputElement.addEventListener('input', function() {
                            var maxLength = parseInt(this.getAttribute('maxlength')) || 15;
                            var currentValue = this.value.replace(/\D/g, '').slice(0, maxLength);
                            this.value = currentValue;
                            
                            // Real-time validation feedback when user enters enough digits
                            if (currentValue.length > 0) {
                                var dialCode = itiInstance.getSelectedCountryData().dialCode;
                                var isIndia = (dialCode == '91' || dialCode == 91);
                                
                                // For India, validate when 10 digits are entered
                                // For others, validate when at least 5 digits are entered
                                if ((isIndia && currentValue.length === 10) || (!isIndia && currentValue.length >= 5)) {
                                    validatePhoneNumber(this, itiInstance, inputId, false);
                                }
                            }
                        });
                    })(input, iti, input.id);
                    
                    phoneInputs.push({
                        input: input,
                        iti: iti
                    }); // Store reference to the input and iti instance
                }
            }

            // Function to validate the phone number based on country
            function validatePhoneNumber(input, iti, inputId, showErrorOnEmpty) {
                var dialCode = iti.getSelectedCountryData().dialCode; // Get the country code (e.g., 91)
                var countryCode = iti.getSelectedCountryData().iso2; // Get ISO2 country code (e.g., 'in')
                
                // Remove existing country code if already present
                var currentValue = input.value.trim();
                currentValue = currentValue.replace(/^\+\d{1,4}-/, ''); // Remove country code if already appended

                // Remove all non-numeric characters from the phone number
                var localNumber = currentValue.replace(/\D+/g, ''); // Removes any non-digit characters including white spaces

                // Check if field is empty
                if (!localNumber || localNumber.length === 0) {
                    if (showErrorOnEmpty && input.required) {
                        showPhoneError(inputId, 'Phone number is required.');
                        return false;
                    }
                    hidePhoneError(inputId);
                    return true; // Empty is valid if not required
                }

                // Check if it's India (dialCode 91 or countryCode 'in' or +91 in the value)
                var isIndia = (dialCode == '91' || dialCode == 91 || countryCode === 'in' || 
                              input.value.includes('+91') || input.value.includes('91-'));

                // Validate based on country
                if (isIndia) {
                    // India: exactly 10 digits
                    if (localNumber.length !== 10) {
                        showPhoneError(inputId, 'Indian phone number must be exactly 10 digits.');
                        return false;
                    }
                } else {
                    // Other countries: at least 5 digits and max 15 digits
                    if (localNumber.length < 5) {
                        showPhoneError(inputId, 'Phone number must be at least 5 digits.');
                        return false;
                    }
                    if (localNumber.length > 15) {
                        showPhoneError(inputId, 'Phone number must not exceed 15 digits.');
                        return false;
                    }
                }

                hidePhoneError(inputId);
                return true;
            }

            // Function to show phone error
            function showPhoneError(inputId, message) {
                var input = document.getElementById(inputId);
                if (!input) return;
                
                // Remove existing error message if any
                var existingError = input.parentNode.querySelector('.' + inputId + '_phone_error');
                if (existingError) {
                    existingError.remove();
                }
                
                var errorDiv = document.createElement('div');
                errorDiv.className = inputId + '_phone_error field-error';
                errorDiv.style.cssText = 'color: red; font-size: 12px; margin-top: 5px;';
                errorDiv.textContent = message;
                input.parentNode.appendChild(errorDiv);
                input.style.borderColor = '#f00';
            }

            // Function to hide phone error
            function hidePhoneError(inputId) {
                var input = document.getElementById(inputId);
                if (!input) return;
                
                var existingError = input.parentNode.querySelector('.' + inputId + '_phone_error');
                if (existingError) {
                    existingError.remove();
                }
                input.style.borderColor = '';
            }

            // Add validation on blur for each phone input
            phoneInputs.forEach(function(phone) {
                var input = phone.input;
                var iti = phone.iti;
                var inputId = input.id;

                // Validate on blur - always validate, show error if required field is empty
                input.addEventListener('blur', function() {
                    validatePhoneNumber(input, iti, inputId, true);
                });

                // Validate when country changes
                input.addEventListener('countrychange', function() {
                    if (input.value.trim() !== '') {
                        validatePhoneNumber(input, iti, inputId, false);
                    } else {
                        hidePhoneError(inputId);
                    }
                });

                // Also validate on input change for real-time feedback (optional)
                input.addEventListener('input', function() {
                    // Clear error if user is typing
                    if (input.value.trim() === '') {
                        hidePhoneError(inputId);
                    }
                });
            });

            // On form submission, concatenate the country code and phone number for each phone input with separator "-"
            $('form').submit(function(e) {
                var isValid = true;

                // Iterate through each phone input
                phoneInputs.forEach(function(phone) {
                    var input = phone.input;
                    var iti = phone.iti;
                    var inputId = input.id;

                    if (input.value.trim() !== '') {
                        var dialCode = iti.getSelectedCountryData().dialCode; // Get the country code (e.g., 91)

                        // Remove existing country code if already present
                        var currentValue = input.value.trim();
                        currentValue = currentValue.replace(/^\+\d{1,4}-/, ''); // Remove country code if already appended

                        // Remove all non-numeric characters from the phone number
                        var localNumber = currentValue.replace(/\D+/g, ''); // Removes any non-digit characters including white spaces

                        // Validate phone number
                        if (!validatePhoneNumber(input, iti, inputId, true)) {
                            isValid = false;
                            return false; // Exit the loop if the number is invalid
                        }

                        var fullPhoneNumber = '+' + dialCode + '-' + localNumber; // Concatenate country code with local number using '-'
                        // Replace the input value with the formatted phone number
                        input.value = fullPhoneNumber;
                    }
                });

                // If any phone number is invalid, prevent form submission
                if (!isValid) {
                    e.preventDefault();
                    alert('Please correct the phone number errors before submitting.');
                    // Scroll to first error
                    var firstError = document.querySelector('.field-error');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInputs = document.querySelectorAll('#phone1, #phone2, #phone3, #phone4, #phone5, #phone6, #phone7');
            const countryList = document.querySelector('.iti__country-list');

            phoneInputs.forEach(function(input) {
                input.addEventListener('click', function() {
                    const rect = input.getBoundingClientRect();
                    countryList.style.position = 'fixed';
                    countryList.style.top = `${rect.bottom + window.scrollY}px`;
                    countryList.style.left = `${rect.left}px`;
                    countryList.style.zIndex = '1000'; // Ensure dropdown appears on top
                });
            });
        });
    </script>

    <script>
        function validateSectors() {
            const checkboxes = document.getElementsByName('sector[]');
            const maxSelection = 3;
            let checkedCount = 0;
            let otherSelected = false;

            // Count checked checkboxes and check if 'Other' is selected
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedCount++;
                    if (checkbox.value === "Others") {
                        otherSelected = true;
                    }
                }
            });

            // Disable unchecked checkboxes if max selection is reached
            checkboxes.forEach(checkbox => {
                if (checkedCount >= maxSelection) {
                    checkbox.disabled = !checkbox.checked;
                } else {
                    checkbox.disabled = false;
                }
            });

            // Show/hide error message
            const sectorError = document.getElementById('sector-error');
            if (checkedCount < 1) {
                sectorError.innerText = 'Please select a sector.';
                sectorError.style.display = 'block';
                return false;
            } else {
                sectorError.style.display = 'none';
            }

            // Show the "Other" input field if "Other" is checked
            const otherSectorInputDiv = document.getElementById('other-sector');
            if (otherSelected) {
                otherSectorInputDiv.style.display = 'block';
                // make it required
                otherOrgValue.required = true;
            } else {
                otherSectorInputDiv.style.display = 'none';
            }

            return true;
        }

        // Validate on form submission
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!validateSectors()) {
                event.preventDefault(); // Stop form submission if validation fails
            }
        });

        // Initial validation on page load
        validateSectors();

        function showStageDropdown() {
            var orgType = document.getElementById("org_reg_type").value;
            var stageDropdown = document.getElementById("stage_dropdown");
            var stageSelect = document.getElementById("st_stage");
            var otherInput = document.getElementById("other_org_type");
            var otherOrgValue = document.getElementById("other_org_value");

            // Ensure elements exist before using them
            if (stageDropdown && stageSelect) {
                if (orgType === "Startup") {
                    stageDropdown.style.display = "block";
                    stageSelect.disabled = false; // Enable the stage dropdown
                } else {
                    stageDropdown.style.display = "none";
                    stageSelect.value = ""; // Reset value
                    stageSelect.disabled = true; // Disable the stage dropdown
                }
            }

            // Show or hide the "Other" input box
            if (otherInput && otherOrgValue) {
                if (orgType === "Others") {
                    otherInput.style.display = "block";
                    otherOrgValue.required = true; // Make input required
                } else {
                    otherInput.style.display = "none";
                    otherOrgValue.required = false; // Remove required attribute
                    otherOrgValue.value = ""; // Clear the input value when hidden
                }
            }
        }

        // Ensure the script runs only after the DOM is fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            var orgTypeDropdown = document.getElementById("org_reg_type");
            if (orgTypeDropdown) {
                orgTypeDropdown.addEventListener("change", showStageDropdown);
                showStageDropdown(); // Call initially to check pre-selected values
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let orgTypeDropdown = document.getElementById('org_reg_type');
            let delIdField = document.getElementById('cata');
            let delIdText = document.getElementById('del_id_text');

            if (!orgTypeDropdown || !delIdField || !delIdText) {
                console.error("Required elements not found. Check your HTML structure.");
                return;
            }

            // Store original value
            let originalDelId = delIdText.getAttribute("data-original");

            orgTypeDropdown.addEventListener('change', function() {
                let orgType = this.value;
                let updatedDelId = originalDelId; // Start with the original value

                if (orgType === "Institutional Investor" || orgType === "Investors") {
                    if (originalDelId === "Gold Delegate Pass") {
                        updatedDelId = "Investor Gold Pass";
                    } else if (originalDelId === "Silver Delegate Pass") {
                        updatedDelId = "Investor Silver Pass";
                    } else if (originalDelId === "Bronze Delegate Pass") {
                        updatedDelId = "Investor Bronze Pass";
                    }
                }

                // Update hidden input and visible text
                delIdField.value = updatedDelId;
                delIdText.innerText = updatedDelId;
            });
        });
    </script>

    <script>
        $('#reg_registration_form_1').on('submit', function(e) {
            var promoCodeEntered = $('#promoCode').val();
            var promoCodeApplied = $('#promoCodeHidden').val();

            if (promoCodeEntered && !promoCodeApplied) {
                e.preventDefault(); // Prevent form submission
                alert('Please click "Apply Promo Code" before proceeding.');
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toggleAdditionalField(); // Ensure the function runs on load
        });

        function toggleAdditionalField() {
            var userType = document.querySelector('input[name="bharat_user_type"]:checked').value;
            var yearOfBirthField = document.getElementById('year_of_birth_field');
            var yearOfBirthInput = document.getElementById('year_of_birth');
            var yearOfInceptionField = document.getElementById('year_of_inception_field');
            var yearOfInceptionInput = document.getElementById('year_of_inception');

            if (userType === "Individual") {
                // Show Year of Birth for Individual
                yearOfBirthField.style.display = "block";
                yearOfBirthInput.required = true;

                // Hide Year of Inception for Organization
                yearOfInceptionField.style.display = "none";
                yearOfInceptionInput.required = false;
            } else {
                // Show Year of Inception for Organization
                yearOfInceptionField.style.display = "block";
                yearOfInceptionInput.required = true;

                // Hide Year of Birth for Individual
                yearOfBirthField.style.display = "none";
                yearOfBirthInput.required = false;
            }
        }

        //     function abstractDiv() {
        // 	if (document.getElementById("ayes").checked == true) {

        // 		document.getElementById("abstract_div").style.display = "block";
        // 		document.getElementById("abstract_div").value = '';


        // 	} else {

        // 		document.getElementById("abstract_div").value = '';
        // 		document.getElementById("abstract_div").style.display = "none";

        // 	}
        // }
    </script>



    </script>




    <script>
        var apiKey = "WTYxaXZYcmVlbU1Mdzd2MVZxc00yd1BHUEZGUGFLR1NYRTYxQmthOA==";

        // Fetch HQ Countries
        fetch('https://api.countrystatecity.in/v1/countries', {
                method: 'GET',
                headers: {
                    'X-CSCAPI-KEY': apiKey
                }
            })
            .then(response => response.json())
            .then(countries => {
                const hqCountrySelect = document.getElementById('country');
                const defaultCountry = hqCountrySelect.getAttribute('data-default');
                countries.sort((a, b) => a.name.localeCompare(b.name));
                countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.name;
                    option.setAttribute('data-iso', country.iso2);
                    option.textContent = country.name;
                    hqCountrySelect.appendChild(option);
                });
                
                // Set default country if specified (e.g., India for Indian citizens)
                if (defaultCountry) {
                    hqCountrySelect.value = defaultCountry;
                    fetchHqStates(); // Automatically fetch states for the default country
                    
                    // Add hidden input for disabled field to ensure value is submitted
                    if (hqCountrySelect.disabled) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'country';
                        hiddenInput.value = defaultCountry;
                        hqCountrySelect.parentNode.appendChild(hiddenInput);
                    }
                }
            })
            .catch(error => console.error('Error fetching countries:', error));

        // Fetch HQ States
        function fetchHqStates() {
            const hqCountrySelect = document.getElementById('country');
            const hqStateSelect = document.getElementById('state');
            const hqCitySelect = document.getElementById('city');
            const countryISO = hqCountrySelect.options[hqCountrySelect.selectedIndex].getAttribute('data-iso');
            const countryName = hqCountrySelect.options[hqCountrySelect.selectedIndex].value;

            hqStateSelect.innerHTML = '<option value="">-- Select State --</option>';
            hqCitySelect.innerHTML = '<option value="">-- Select City --</option>';

            if (!countryISO) return;

            fetch(`https://api.countrystatecity.in/v1/countries/${countryISO}/states`, {
                    method: 'GET',
                    headers: {
                        'X-CSCAPI-KEY': apiKey
                    }
                })
                .then(response => response.json())
                .then(states => {
                    if (states.length === 0) {
                        const option = document.createElement('option');
                        option.value = countryName;
                        option.textContent = countryName;
                        hqStateSelect.appendChild(option);
                        const cityOption = document.createElement('option');
                        cityOption.value = countryName;
                        cityOption.textContent = countryName;
                        hqCitySelect.appendChild(cityOption);
                    } else {
                        states.sort((a, b) => a.name.localeCompare(b.name));
                        states.forEach(state => {
                            const option = document.createElement('option');
                            option.value = state.name;
                            option.setAttribute('data-iso', state.iso2);
                            option.textContent = state.name;
                            hqStateSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error fetching HQ states:', error));
        }

        // Fetch HQ Cities
        function fetchHqCities() {
            const hqCountrySelect = document.getElementById('country');
            const hqStateSelect = document.getElementById('state');
            const hqCitySelect = document.getElementById('city');
            const countryISO = hqCountrySelect.options[hqCountrySelect.selectedIndex].getAttribute('data-iso');
            const stateISO = hqStateSelect.options[hqStateSelect.selectedIndex]?.getAttribute('data-iso');
            const stateName = hqStateSelect.options[hqStateSelect.selectedIndex]?.value;

            hqCitySelect.innerHTML = '<option value="">-- Select City --</option>';

            if (!stateISO) {
                if (stateName) {
                    const option = document.createElement('option');
                    option.value = stateName;
                    option.textContent = stateName;
                    hqCitySelect.appendChild(option);
                }
                return;
            }

            fetch(`https://api.countrystatecity.in/v1/countries/${countryISO}/states/${stateISO}/cities`, {
                    method: 'GET',
                    headers: {
                        'X-CSCAPI-KEY': apiKey
                    }
                })
                .then(response => response.json())
                .then(cities => {
                    if (cities.length === 0) {
                        const option = document.createElement('option');
                        option.value = stateName;
                        option.textContent = stateName;
                        hqCitySelect.appendChild(option);
                    } else {
                        cities.sort((a, b) => a.name.localeCompare(b.name));
                        cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.name;
                            option.textContent = city.name;
                            hqCitySelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error fetching cities:', error));
        }
    </script>

    <script>
        function toggleAccompanying() {
            const isPresenter = document.getElementById('dyes').checked;
            const abstractDiv = document.getElementById('abstract_div');
            const accompanySection = document.getElementById('accompanying_person_section');

            abstractDiv.style.display = isPresenter ? 'block' : 'none';
            accompanySection.style.display = isPresenter ? 'block' : 'none';

            updateAttendeeDropdown(isPresenter);
        }

        function updateAttendeeDropdown(isPresenter) {
            const attendeesSelect = document.getElementById('attendees');
            attendeesSelect.innerHTML = ''; // Clear old options

            if (isPresenter) {
                const isAccompanyYes = document.getElementById('accompany_yes').checked;

                if (isAccompanyYes) {
                    attendeesSelect.innerHTML += '<option value="2">2</option>';
                    attendeesSelect.value = '2';
                } else {
                    attendeesSelect.innerHTML += '<option value="1">1</option>';
                    attendeesSelect.value = '1';
                }
            } else {
                for (let i = 1; i <= 6; i++) {
                    attendeesSelect.innerHTML += `<option value="${i}">${i}</option>`;
                }
                attendeesSelect.value = '1';
            }

            // ✅ THIS IS CRITICAL
            showAttendeeFields();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Run on page load
            toggleAccompanying();

            // Watch for Accompanying Person change
            const accompanyRadios = document.querySelectorAll('input[name="accompanying_person"]');
            accompanyRadios.forEach(radio => {
                radio.addEventListener('change', () => {
                    const isPresenter = document.getElementById('dyes').checked;
                    if (isPresenter) {
                        updateAttendeeDropdown(true);
                    }
                });
            });

            // Watch for Abstract Presenter change too
            document.getElementById('dyes').addEventListener('click', toggleAccompanying);
            document.getElementById('dno').addEventListener('click', toggleAccompanying);
        });
    </script>

<!-- RefreshCaptcha function updated to use enquiry_captcha.php -->
<script>
function refreshCaptcha() {
    // console.log('Refresh captcha button clicked');
    
    // Back to using the original captcha file
    const url = 'captcha_reg.php?action=refresh&rand=' + Date.now();
    // console.log('Making request to:', url);
    
    fetch(url)
        .then(response => {
            // console.log('Response status:', response.status);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.text(); // Get as text first to see what we're receiving
        })
        .then(text => {
            // console.log('Raw response:', text);
            
            try {
                const data = JSON.parse(text);
                // console.log('Parsed JSON:', data);
                
                if (data.success) {
                    // Update the captcha display
                    document.getElementById("captcha-display").textContent = data.captcha;
                    // Update the hidden field value
                    document.getElementById("test").value = data.captcha;
                    // Clear the input field
                    document.getElementById("captcha").value = '';
                    // console.log('Captcha updated successfully');
                } else {
                    // console.error('Server error:', data.error);
                    alert('Unable to refresh captcha: ' + (data.error || 'Unknown error'));
                }
            } catch (jsonError) {
                // console.error('JSON parsing error:', jsonError);
                // console.log('Response was not valid JSON:', text);
                alert('Server returned invalid response: ' + text.substring(0, 200) + '...');
            }
        })
        .catch(error => {
            // console.error('Error refreshing captcha:', error);
            alert('Unable to refresh captcha. Error: ' + error.message);
        });
}
</script>
<!-- End RefreshCaptcha -->

<!-- Comprehensive Form Validation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validation patterns
    const patterns = {
        // Name: Letters, spaces, hyphens, apostrophes (for international names like O'Brien, Mary-Jane, etc.)
        name: /^[A-Za-z\s\-'\.]+$/,
        // Organization: Letters, numbers, spaces, common punctuation
        organization: /^[A-Za-z0-9\s\-'\.\(\)&,]+$/,
        // Address: Alphanumeric, spaces, common address characters
        address: /^[A-Za-z0-9\s\-'\.\(\)#\/,]+$/,
        // Designation: Letters, numbers, spaces, common punctuation
        designation: /^[A-Za-z0-9\s\-'\.\(\)&,]+$/,
        // Nationality: Letters, spaces, hyphens
        nationality: /^[A-Za-z\s\-]+$/,
        // Course/Branch: Letters, numbers, spaces, common punctuation
        course: /^[A-Za-z0-9\s\-'\.\(\)&,]+$/,
        // Paper ID: Alphanumeric, hyphens, underscores
        paperId: /^[A-Za-z0-9\-_]+$/
    };

    // Error message elements storage
    const errorMessages = {};

    // Function to create or get error message element
    function getErrorMessageElement(inputId) {
        if (!errorMessages[inputId]) {
            const input = document.getElementById(inputId);
            if (input) {
                const errorDiv = document.createElement('div');
                errorDiv.id = inputId + '_error';
                errorDiv.className = 'field-error';
                errorDiv.style.cssText = 'color: red; font-size: 12px; margin-top: 5px; display: none;';
                input.parentNode.appendChild(errorDiv);
                errorMessages[inputId] = errorDiv;
            }
        }
        return errorMessages[inputId];
    }

    // Function to show error
    function showError(inputId, message) {
        const errorDiv = getErrorMessageElement(inputId);
        if (errorDiv) {
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
            const input = document.getElementById(inputId);
            if (input) {
                input.style.borderColor = '#f00';
            }
        }
    }

    // Function to hide error
    function hideError(inputId) {
        const errorDiv = getErrorMessageElement(inputId);
        if (errorDiv) {
            errorDiv.style.display = 'none';
            const input = document.getElementById(inputId);
            if (input) {
                input.style.borderColor = '';
            }
        }
    }

    // Validation functions
    function validateName(inputId, fieldName) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, fieldName + ' is required.');
                return false;
            }
            return true;
        }

        if (value.length < 2) {
            showError(inputId, fieldName + ' must be at least 2 characters long.');
            return false;
        }

        if (value.length > 50) {
            showError(inputId, fieldName + ' must not exceed 50 characters.');
            return false;
        }

        if (!patterns.name.test(value)) {
            showError(inputId, fieldName + ' can only contain letters, spaces, hyphens, apostrophes, and periods.');
            return false;
        }

        // Check for consecutive special characters
        if (/[\-']{2,}/.test(value) || /\.{2,}/.test(value)) {
            showError(inputId, fieldName + ' cannot have consecutive special characters.');
            return false;
        }

        hideError(inputId);
        return true;
    }

    function validateOrganization(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, 'Organization name is required.');
                return false;
            }
            return true;
        }

        if (value.length < 2) {
            showError(inputId, 'Organization name must be at least 2 characters long.');
            return false;
        }

        if (value.length > 100) {
            showError(inputId, 'Organization name must not exceed 100 characters.');
            return false;
        }

        if (!patterns.organization.test(value)) {
            showError(inputId, 'Organization name contains invalid characters.');
            return false;
        }

        hideError(inputId);
        return true;
    }

    function validateAddress(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, 'Address is required.');
                return false;
            }
            return true;
        }

        if (value.length < 5) {
            showError(inputId, 'Address must be at least 5 characters long.');
            return false;
        }

        if (value.length > 200) {
            showError(inputId, 'Address must not exceed 200 characters.');
            return false;
        }

        if (!patterns.address.test(value)) {
            showError(inputId, 'Address contains invalid characters.');
            return false;
        }

        hideError(inputId);
        return true;
    }

    function validateDesignation(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, 'Designation is required.');
                return false;
            }
            return true;
        }

        if (value.length < 2) {
            showError(inputId, 'Designation must be at least 2 characters long.');
            return false;
        }

        if (value.length > 100) {
            showError(inputId, 'Designation must not exceed 100 characters.');
            return false;
        }

        if (!patterns.designation.test(value)) {
            showError(inputId, 'Designation contains invalid characters.');
            return false;
        }

        hideError(inputId);
        return true;
    }

    function validateNationality(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, 'Nationality is required.');
                return false;
            }
            return true;
        }

        if (value.length < 2) {
            showError(inputId, 'Nationality must be at least 2 characters long.');
            return false;
        }

        if (value.length > 50) {
            showError(inputId, 'Nationality must not exceed 50 characters.');
            return false;
        }

        if (!patterns.nationality.test(value)) {
            showError(inputId, 'Nationality can only contain letters, spaces, and hyphens.');
            return false;
        }

        hideError(inputId);
        return true;
    }

    function validateCourse(inputId, fieldName) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, fieldName + ' is required.');
                return false;
            }
            return true;
        }

        if (value.length < 2) {
            showError(inputId, fieldName + ' must be at least 2 characters long.');
            return false;
        }

        if (value.length > 100) {
            showError(inputId, fieldName + ' must not exceed 100 characters.');
            return false;
        }

        if (!patterns.course.test(value)) {
            showError(inputId, fieldName + ' contains invalid characters.');
            return false;
        }

        hideError(inputId);
        return true;
    }

    function validatePaperId(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, 'Paper ID is required.');
                return false;
            }
            return true;
        }

        if (value.length < 3) {
            showError(inputId, 'Paper ID must be at least 3 characters long.');
            return false;
        }

        if (value.length > 50) {
            showError(inputId, 'Paper ID must not exceed 50 characters.');
            return false;
        }

        if (!patterns.paperId.test(value)) {
            showError(inputId, 'Paper ID can only contain letters, numbers, hyphens, and underscores.');
            return false;
        }

        hideError(inputId);
        return true;
    }

    function validateEmail(inputId, fieldName) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, fieldName + ' is required.');
                return false;
            }
            return true;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
            showError(inputId, 'Please enter a valid email address.');
            return false;
        }

        if (value.length > 100) {
            showError(inputId, 'Email must not exceed 100 characters.');
            return false;
        }

        hideError(inputId);
        return true;
    }

    function validateZipcode(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return true;
        
        const value = input.value.trim();
        if (!value) {
            if (input.required) {
                showError(inputId, 'Postal/ZIP code is required.');
                return false;
            }
            return true;
        }

        // Check if it's India (6 digits only)
        const country = document.getElementById('country');
        const cit = '<?php echo isset($cit) ? htmlspecialchars($cit, ENT_QUOTES, 'UTF-8') : ''; ?>';
        const isIndia = (cit === 'ind' || (country && country.value === 'India'));
        
        if (isIndia) {
            // India: 6 digits only
            if (!/^\d{6}$/.test(value)) {
                showError(inputId, 'Indian PIN code must be exactly 6 digits.');
                return false;
            }
        } else {
            // International: 2-15 characters, alphanumeric, spaces, and hyphens
            if (value.length < 2) {
                showError(inputId, 'Postal code must be at least 2 characters long.');
                return false;
            }
            
            if (value.length > 15) {
                showError(inputId, 'Postal code must not exceed 15 characters.');
                return false;
            }
            
            // Allow letters, numbers, spaces, and hyphens
            if (!/^[A-Za-z0-9\-\s]+$/.test(value)) {
                showError(inputId, 'Postal code can only contain letters, numbers, spaces, and hyphens.');
                return false;
            }
        }

        hideError(inputId);
        return true;
    }

    // Add validation to all name fields (firstname1-7, lastname1-7)
    for (let i = 1; i <= 7; i++) {
        const firstNameId = 'firstname' + i;
        const lastNameId = 'lastname' + i;
        
        const firstNameInput = document.getElementById(firstNameId);
        const lastNameInput = document.getElementById(lastNameId);
        
        if (firstNameInput) {
            firstNameInput.addEventListener('blur', function() {
                validateName(firstNameId, 'First name');
            });
            firstNameInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    // Real-time validation - only show error if there's content
                    validateName(firstNameId, 'First name');
                } else {
                    hideError(firstNameId);
                }
            });
        }
        
        if (lastNameInput) {
            lastNameInput.addEventListener('blur', function() {
                validateName(lastNameId, 'Last name');
            });
            lastNameInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    validateName(lastNameId, 'Last name');
                } else {
                    hideError(lastNameId);
                }
            });
        }
    }

    // Validate organization name
    const orgInput = document.getElementById('org');
    if (orgInput) {
        orgInput.addEventListener('blur', function() {
            validateOrganization('org');
        });
        orgInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateOrganization('org');
            } else {
                hideError('org');
            }
        });
    }

    // Validate address
    const addressInput = document.getElementById('address');
    if (addressInput) {
        addressInput.addEventListener('blur', function() {
            validateAddress('address');
        });
        addressInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateAddress('address');
            } else {
                hideError('address');
            }
        });
    }

    // Validate nationality
    const nationalityInput = document.getElementById('nationality');
    if (nationalityInput) {
        nationalityInput.addEventListener('blur', function() {
            validateNationality('nationality');
        });
        nationalityInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateNationality('nationality');
            } else {
                hideError('nationality');
            }
        });
    }

    // Validate designation fields (designation1-7)
    for (let i = 1; i <= 7; i++) {
        const designationId = 'designation' + i;
        const designationInput = document.getElementById(designationId);
        
        if (designationInput) {
            designationInput.addEventListener('blur', function() {
                validateDesignation(designationId);
            });
            designationInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    validateDesignation(designationId);
                } else {
                    hideError(designationId);
                }
            });
        }
    }

    // Validate course and branch
    const courseInput = document.getElementById('course1');
    const branchInput = document.getElementById('branch1');
    
    if (courseInput) {
        courseInput.addEventListener('blur', function() {
            validateCourse('course1', 'Course');
        });
        courseInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateCourse('course1', 'Course');
            } else {
                hideError('course1');
            }
        });
    }
    
    if (branchInput) {
        branchInput.addEventListener('blur', function() {
            validateCourse('branch1', 'Branch');
        });
        branchInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateCourse('branch1', 'Branch');
            } else {
                hideError('branch1');
            }
        });
    }

    // Validate paper ID
    const paperIdInput = document.getElementById('paper_id');
    if (paperIdInput) {
        paperIdInput.addEventListener('blur', function() {
            validatePaperId('paper_id');
        });
        paperIdInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validatePaperId('paper_id');
            } else {
                hideError('paper_id');
            }
        });
    }

    // Validate email fields (email1-7, contactPersonEmail)
    for (let i = 1; i <= 7; i++) {
        const emailId = 'email' + i;
        const emailInput = document.getElementById(emailId);
        
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                validateEmail(emailId, 'Email');
            });
            emailInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    validateEmail(emailId, 'Email');
                } else {
                    hideError(emailId);
                }
            });
        }
    }

    // Validate contact person email
    const contactPersonEmailInput = document.getElementById('contactPersonEmail');
    if (contactPersonEmailInput) {
        contactPersonEmailInput.addEventListener('blur', function() {
            validateEmail('contactPersonEmail', 'Contact person email');
        });
        contactPersonEmailInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateEmail('contactPersonEmail', 'Contact person email');
            } else {
                hideError('contactPersonEmail');
            }
        });
    }

    // Validate contact person name
    const contactPersonNameInput = document.getElementById('contactPersonName');
    if (contactPersonNameInput) {
        contactPersonNameInput.addEventListener('blur', function() {
            validateName('contactPersonName', 'Contact person name');
        });
        contactPersonNameInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateName('contactPersonName', 'Contact person name');
            } else {
                hideError('contactPersonName');
            }
        });
    }

    // Validate invoice address
    const invoiceAddressInput = document.getElementById('invoiceAddress');
    if (invoiceAddressInput) {
        invoiceAddressInput.addEventListener('blur', function() {
            validateAddress('invoiceAddress');
        });
        invoiceAddressInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateAddress('invoiceAddress');
            } else {
                hideError('invoiceAddress');
            }
        });
    }

    // Validate zipcode/postal code
    const zipcodeInput = document.getElementById('zipcode');
    if (zipcodeInput) {
        zipcodeInput.addEventListener('blur', function() {
            validateZipcode('zipcode');
        });
        zipcodeInput.addEventListener('input', function() {
            if (this.value.trim()) {
                validateZipcode('zipcode');
            } else {
                hideError('zipcode');
            }
        });
        
        // Also validate when country changes
        const countrySelect = document.getElementById('country');
        if (countrySelect) {
            countrySelect.addEventListener('change', function() {
                if (zipcodeInput.value.trim()) {
                    validateZipcode('zipcode');
                }
            });
        }
    }

    // Form submission validation
    const form = document.getElementById('reg_registration_form_1');
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate all visible name fields
            for (let i = 1; i <= 7; i++) {
                const firstNameId = 'firstname' + i;
                const lastNameId = 'lastname' + i;
                const firstNameInput = document.getElementById(firstNameId);
                const lastNameInput = document.getElementById(lastNameId);
                
                if (firstNameInput && firstNameInput.offsetParent !== null) {
                    if (!validateName(firstNameId, 'First name')) {
                        isValid = false;
                    }
                }
                if (lastNameInput && lastNameInput.offsetParent !== null) {
                    if (!validateName(lastNameId, 'Last name')) {
                        isValid = false;
                    }
                }
            }

            // Validate organization
            if (orgInput && orgInput.offsetParent !== null) {
                if (!validateOrganization('org')) {
                    isValid = false;
                }
            }

            // Validate address
            if (addressInput && addressInput.offsetParent !== null) {
                if (!validateAddress('address')) {
                    isValid = false;
                }
            }

            // Validate nationality
            if (nationalityInput && nationalityInput.offsetParent !== null) {
                if (!validateNationality('nationality')) {
                    isValid = false;
                }
            }

            // Validate visible designation fields
            for (let i = 1; i <= 7; i++) {
                const designationId = 'designation' + i;
                const designationInput = document.getElementById(designationId);
                if (designationInput && designationInput.offsetParent !== null && designationInput.required) {
                    if (!validateDesignation(designationId)) {
                        isValid = false;
                    }
                }
            }

            // Validate course and branch if visible
            if (courseInput && courseInput.offsetParent !== null && courseInput.required) {
                if (!validateCourse('course1', 'Course')) {
                    isValid = false;
                }
            }
            if (branchInput && branchInput.offsetParent !== null && branchInput.required) {
                if (!validateCourse('branch1', 'Branch')) {
                    isValid = false;
                }
            }

            // Validate paper ID if visible
            if (paperIdInput && paperIdInput.offsetParent !== null) {
                if (!validatePaperId('paper_id')) {
                    isValid = false;
                }
            }

            // Validate visible email fields
            for (let i = 1; i <= 7; i++) {
                const emailId = 'email' + i;
                const emailInput = document.getElementById(emailId);
                if (emailInput && emailInput.offsetParent !== null) {
                    if (!validateEmail(emailId, 'Email')) {
                        isValid = false;
                    }
                }
            }

            // Validate contact person fields if visible
            if (contactPersonNameInput && contactPersonNameInput.offsetParent !== null) {
                if (!validateName('contactPersonName', 'Contact person name')) {
                    isValid = false;
                }
            }
            if (contactPersonEmailInput && contactPersonEmailInput.offsetParent !== null) {
                if (!validateEmail('contactPersonEmail', 'Contact person email')) {
                    isValid = false;
                }
            }
            if (invoiceAddressInput && invoiceAddressInput.offsetParent !== null) {
                if (!validateAddress('invoiceAddress')) {
                    isValid = false;
                }
            }

            // Validate zipcode if visible
            if (zipcodeInput && zipcodeInput.offsetParent !== null) {
                if (!validateZipcode('zipcode')) {
                    isValid = false;
                }
            }

            if (!isValid) {
                e.preventDefault();
                alert('Please correct the errors in the form before submitting.');
                // Scroll to first error
                const firstError = document.querySelector('.field-error[style*="block"]');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
                return false;
            }
        });
    }
});
</script>

    <!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>