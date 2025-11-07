<?php

ini_set('max_execution_time', 3600);
$city = '';


include("includes/form_constants_both.php");
require "dbcon_open.php";









//$qr = mysqli_query($link,"SELECT * FROM it_2024_exhibitor_stall_no_mailing WHERE (  (email1='chandrachood.as@mmactiv.com') )") or die(mysqli_error($link));
//$qr = mysqli_query($link,"SELECT * FROM it_2024_exhibitor_stall_no_mailing  ") or die(mysqli_error($link));




$icnt = 1;
$qry = $qr;

echo "pass 1";

while ($res = mysqli_fetch_array($qry)) {

	include "emailer_exhibitor_stall_no_mailing.php";

	//echo $mail_body;
	//exit;



	$subject = "Exhibition Floorplan and Stall details for Bengaluru Tech Summit 2024";

	$from_name = $EVENT_NAME . " " . $EVENT_YEAR;

	$receipents = array($res['email1'], 'shyam.br@mmactiv.com', 'chandrachood.as@mmactiv.com', 'test.interlinks@gmail.com');
	$recipients = $receipents;


	elastic_mail($subject, $mail_body, $recipients, $from_name);
	// exit;
	echo $icnt . ".) " . $res['email1'] . "<br/>";
	$icnt++;
}

echo "<br/>Done<br/>";

exit;
