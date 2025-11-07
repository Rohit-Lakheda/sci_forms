<?php

session_start();

ini_set('max_execution_time', 300);



$event_name = 'Annual Convention Of Chemists';

$en = '';

if (isset($_POST['en']) && !empty($_POST['en'])) {

	$en = '1';

	$event_name = 'Annual Convention Of Chemists';
}



$assoc_name = @$_GET['assoc_name'];

$assoc_name = trim($assoc_name);



if ((!isset($_SESSION["vercode_reg"])) || ($_SESSION["vercode_reg"] == '')) {

	session_destroy();

	echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";

	if (!empty($assoc_name)) {

		echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
	} else {

		echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
	}

	exit;
}

require("includes/form_constants_both.php");

require "dbcon_open.php";



$reg_id = $_SESSION['vercode_reg'];



/*****

	Organisation Details

 *****/



$org = mysqli_real_escape_string($link, @$_POST['org']);

$nature = @$_POST['nature'];

$addr1 = mysqli_real_escape_string($link, @$_POST['addr1']);

$addr2 = mysqli_real_escape_string($link, @$_POST['addr2']);

$city = mysqli_real_escape_string($link, $_POST['city']);

$state = mysqli_real_escape_string($link, $_POST['state']);

$country = $_POST['country'];

$pin = $_POST['pin'];

$gst = $_POST['gst'];

if ($gst == 'Registered') {

	$gst_number = $_POST['gst_number'];
} else if ($gst == 'Unregistered') {

	$gst_number = 'Not Applicable';
}



$fone = '';

if (!empty($_POST['fone'])) {

	$fone = '+' . $_POST['foneCountryCode'] . "-" . $_POST['fone'];
}

$fax = '';

if (!empty($_POST['fax'])) {

	$fax = '+' . @$_POST['faxCountryCode'] . "-" . @$_POST['fax'];
}



if (($org == "") || ($addr1 == "") || ($city == "")  || ($state == "")  || ($country == "")  || ($pin == "") || (@$_POST['fone'] == "")) {

	echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";

	echo "<script language='javascript'>window.location = 'registration3.php?assoc_name=$assoc_name';</script>";

	exit;
}

//echo "UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET org='$org',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax' WHERE reg_id = '$reg_id' ";

mysqli_query($link, "UPDATE " . $EVENT_DB_FORM_REG_DEMO . " SET org='$org',nature='$nature',addr1='$addr1',addr2='$addr2',city='$city',state='$state',country='$country',pin='$pin',fone='$fone',fax='$fax', gst_number='$gst_number' WHERE reg_id = '$reg_id' ") or die(mysqli_error($link));

echo "<script language='javascript'>window.location = 'registration5.php?en=$en&assoc_name=$assoc_name';</script>";

exit;
