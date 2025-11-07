<?php

session_start();
 ini_set('display_errors', 0);

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
require("form_includes/form_constants_both.php");

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
    require "form_includes/dbcon_open.php";
} else {
    include('captcha_reg.php');
}



// Validate URL parameters










$assoc_name = @$_GET['assoc_name'];

?>
<?php $pageStyleCss = '<link href="assets/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />';
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

                    <form action="ieeeSub.php"
                          class="form-horizontal" name="reg_registration_form_1" id="reg_registration_form_1"
                          method="post" enctype="multipart/form-data"
                         >
                        <!-- Form Fields Here -->

                        <div class="form-group">
                            <label class="control-label col-sm-4">Article Name</label>
                            <div class="col-sm-8">
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Title of the paper.."
                                    name="ArtTitle"
                                    id="ArtTitle"
                                    required
                                    maxlength="200"
                                />
                                <div class="invalid-feedback" style="color: #dc3545; font-size: 0.875em;">
                                    Please enter the article title.
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4">Author Name</label>
                            <div class="col-sm-8">
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Comma separated names of all Authors.."
                                    name="AuthName"
                                    id="AuthName"
                                    required
                                />
                                <div class="invalid-feedback" style="color: #dc3545; font-size: 0.875em;">
                                    Please enter author names separated by commas.
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-4">Article Id</label>
                            <div class="col-sm-8">
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Paper id as communicated in E-mail or EasyChair.."
                                    name="ArtId"
                                    id="ArtId"
                                    required
                                    pattern="[A-Za-z0-9]+"
                                />
                                <div class="invalid-feedback" style="color: #dc3545; font-size: 0.875em;">
                                    Please enter a valid alphanumeric article ID.
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="ArtSource" value="42885">

                        <div class="form-group">
                            <label class="control-label col-sm-4">Author E-mail</label>
                            <div class="col-sm-8">
                                <input
                                    class="form-control"
                                    type="text"
                                    placeholder="Comma separated E-mail ids of all Authors.."
                                    name="AuthEmail"
                                    id="AuthEmail"
                                    required
                                />
                                <div class="invalid-feedback" style="color: #dc3545; font-size: 0.875em;">
                                    Please enter valid email addresses, separated by commas.
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-sm-4">Enter
                                the captcha <span class="dips-required">
                                            *</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input name="vercode" id="captcha" type="text" class="form-control"
                                           maxlength="10" required autocomplete="off" onpaste="return false;" />
                                    <input name="test" type="hidden" id="test"
                                           value="<?php echo $_SESSION["vercode_reg"]; ?>" />
                                    <span class="input-group-addon captcha-display"
                                          style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; cursor: default;"
                                          oncopy="return false;" oncut="return false;" onpaste="return false;" oncontextmenu="return false;" onmousedown="return false;" draggable="false" unselectable="on">
                                                <?php echo $_SESSION["vercode_reg"]; ?>
                                            </span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="rtrnurl" value=http://pkiindia.in/pkia/ic_copyright_return.jsp>
                        <div class="form-group">
                            <div class="col-sm-offset-6 col-sm-6">
                                <p style="float:right;">
                                <button type="submit" class="btn btn-primary sbold uppercase">Submit</button>
                                </p>
                            </div>
                        </div>

                        <!-- Form Fields ENd here -->



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
    (function () {
        'use strict';

        // Fetch form and inputs
        const form = document.getElementById('reg_registration_form_1');
        const submitButton = form.querySelector('button[type="submit"]');
        const inputs = form.querySelectorAll('input:not([type="hidden"])');

        // Function to validate author names (basic check for non-empty after splitting)
        function validateAuthors(authorString) {
            if (!authorString) return false;
            const authors = authorString.split(',').map(author => author.trim());
            return authors.every(author => author.length > 0);
        }

        // Email validation regex
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        // Function to validate comma-separated emails
        function validateEmails(emailString) {
            if (!emailString) return false;
            const emails = emailString.split(',').map(email => email.trim());
            return emails.every(email => emailRegex.test(email));
        }

        // Function to check form validity and toggle submit button
        function updateSubmitButton() {
            let isValid = form.checkValidity();
            const authEmail = document.getElementById('AuthEmail').value;
            const authName = document.getElementById('AuthName').value;
            isValid = isValid && validateEmails(authEmail) && validateAuthors(authName);
            submitButton.disabled = !isValid;
        }

        // Add validation event listeners
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                if (input.checkValidity()) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                }
                updateSubmitButton();
            });

            // Custom validation for email and author fields
            if (input.id === 'AuthEmail') {
                input.addEventListener('input', () => {
                    if (validateEmails(input.value)) {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    } else {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                    }
                    updateSubmitButton();
                });
            }

            if (input.id === 'AuthName') {
                input.addEventListener('input', () => {
                    if (validateAuthors(input.value)) {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    } else {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                    }
                    updateSubmitButton();
                });
            }
        });

        // Form submission validation
        function validate_registration_form_2() {
            let isValid = form.checkValidity();
            const authEmail = document.getElementById('AuthEmail').value;
            const authName = document.getElementById('AuthName').value;
            isValid = isValid && validateEmails(authEmail) && validateAuthors(authName);

            if (!isValid) {
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                    }
                    if (input.id === 'AuthEmail' && !validateEmails(input.value)) {
                        input.classList.add('is-invalid');
                    }
                    if (input.id === 'AuthName' && !validateAuthors(input.value)) {
                        input.classList.add('is-invalid');
                    }
                });
                return false;
            }
            return true;
        }

        // Expose the validation function globally for the onsubmit attribute
        window.validate_registration_form_2 = validate_registration_form_2;

        // Apply Bootstrap validation styles
        form.classList.add('needs-validation');
    })();
</script>
<style>
     Bootstrap-like validation styles
    /*.is-valid {*/
    /*    border-color: #28a745 !important;*/
    /*    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-.4-.4-1.04 0-1.44l.7-.7c.4-.4 1.04-.4 1.44 0L3 3.27l2.77-2.77c.4-.4 1.04-.4 1.44 0l.7.7c.4.4.4 1.04 0 1.44l-3.5 3.5c-.4.4-1.04.4-1.44 0z'/%3E%3C/svg%3E");*/
    /*    background-repeat: no-repeat;*/
    /*    background-position: right calc(0.375em + 0.1875rem) center;*/
    /*    background-size: 0.75em 0.75em;*/
    /*}*/

    .is-invalid {
        border-color: #dc3545 !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23dc3545' d='M4.35 3.65l1.77-1.77c.2-.2.2-.51 0-.71l-.35-.35c-.2-.2-.51-.2-.71 0L3.29 2.94 1.41.76c-.2-.2-.51-.2-.71 0l-.35.35c-.2.2-.2.51 0 .71L2.71 3.65.94 5.41c-.2.2-.2.51 0 .71l.35.35c.2.2.51.2.71 0l1.77-1.77 1.77 1.77c.2.2.51.2.71 0l.35-.35c.2-.2.2-.51 0-.71L4.35 3.65z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: 0.75em 0.75em;
    }

    .invalid-feedback {
        display: none;
    }

    .is-invalid ~ .invalid-feedback {
        display: block;
    }
</style>

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
        const numberOfAttendees = parseInt(document.getElementById("attendees").value, 10);

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
        for (let i = 1; i <= numberOfAttendees; i++) {
            const attendeeField = document.getElementById(`attendee${i}`);
            if (attendeeField) {
                attendeeField.style.display = 'block';

                // Get all input fields and title fields inside the attendee container and set "required"
                const inputs = attendeeField.querySelectorAll('input, select'); // Add `select` if title is a dropdown
                inputs.forEach(input => {
                    input.required = true;
                });
            }
        }
    }

    // Run the function on page load if there is a session value
    window.onload = function() {
        const attendeesCount = <?php echo $attendeesCount ? $attendeesCount : 1; ?>;
        document.getElementById("attendees").value = attendeesCount;
        showAttendeeFields(); // Trigger the function to show attendee fields based on the session value
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
                        if (response.ticket_category && response.venue) {
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
<script src="js/registration-test.js?sagar"></script>
<script src="assets/telephoneWithFlags/js/intlTelInput.js"></script>



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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registration_form_1').on('submit', function(e) {
            e.preventDefault(); // stop form from submitting immediately

            var artId = $('#ArtId').val().trim();
            if (artId === '') {
                alert('Please enter an Article ID.');
                return false;
            }

            // AJAX call to check if ArtId already exists
            $.ajax({
                url: 'check_artid.php',
                type: 'POST',
                data: { ArtId: artId },
                success: function(response) {
                    if (response.trim() === 'exists') {
                        alert('Article ID already exists. Please choose another one.');
                        $('#ArtId').val(''); // Clear the Article ID field
                    } else {
                        // No duplicate — submit form
                        $('#reg_registration_form_1')[0].submit(); //submit the form
                    }
                },
                error: function() {
                    alert('Error checking Article ID. Please try again.');
                }
            });
        });
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
                phoneInputs.push({
                    input: input,
                    iti: iti
                }); // Store reference to the input and iti instance
            }
        }

        // Function to validate the phone number format (+countrycode-phonenumber)
        function isValidPhoneNumber(phoneNumber) {
            var phoneRegex = /^\+\d{1,4}-\d{6,14}$/; // Regex to validate +countrycode-phonenumber format
            return phoneRegex.test(phoneNumber);
        }

        // On form submission, concatenate the country code and phone number for each phone input with separator "-"
        $('form').submit(function(e) {
            var isValid = true;

            // Iterate through each phone input
            phoneInputs.forEach(function(phone) {
                var input = phone.input;
                var iti = phone.iti;

                if (input.value.trim() !== '') {
                    var dialCode = iti.getSelectedCountryData().dialCode; // Get the country code (e.g., 91)

                    // Remove existing country code if already present
                    var currentValue = input.value.trim();
                    currentValue = currentValue.replace(/^\+\d{1,4}-/, ''); // Remove country code if already appended

                    // Remove all non-numeric characters from the phone number
                    var localNumber = currentValue.replace(/\D+/g, ''); // Removes any non-digit characters including white spaces

                    var fullPhoneNumber = '+' + dialCode + '-' + localNumber; // Concatenate country code with local number using '-'

                    // Validate the full phone number format
                    if (!isValidPhoneNumber(fullPhoneNumber)) {
                        alert("Please enter a valid phone number in the format: +countrycode-phonenumber");
                        input.focus(); // Move focus to the invalid field
                        isValid = false;
                        return false; // Exit the loop if the number is invalid
                    }

                    // Replace the input value with the formatted phone number
                    input.value = fullPhoneNumber;
                }
            });

            // If any phone number is invalid, prevent form submission
            if (!isValid) {
                e.preventDefault();
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
            countries.sort((a, b) => a.name.localeCompare(b.name));
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name;
                option.setAttribute('data-iso', country.iso2);
                option.textContent = country.name;
                hqCountrySelect.appendChild(option);
            });
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




<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>