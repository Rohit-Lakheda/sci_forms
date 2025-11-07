<?php

session_start();
// ini_set('display_errors', 1);
require "dbcon_open.php";

$mailer_type = @$_REQUEST['mailer_type'];


require "form_includes/form_constants_both.php";

// print_r($_POST);exit;

$event_name = 'Super Computing India';

if ($mailer_type != "mailF34D") {

	if (mysqli_escape_string($link,htmlspecialchars(($_POST["vercode"])) != $_SESSION["vercode_enq"]) || ($_SESSION["vercode_enq"] == '')) {

		session_destroy();

		echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";

		echo "<script language='javascript'>window.location = ('enquiry.php?en=" . $en . "');</script>";

		exit;

	}

}





if ((mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry'])) == "") && (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry2'])) == "") && (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry3'])) == "") && (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry4'])) == "") && (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry5'])) == "") && (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry6'])) == "") && (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry7'])) == "") && (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry8'] == "")))) {

	echo "<script language='javascript'>alert('Please Enter Required Details!');</script>";

	echo "<script language='javascript'>document.location = 'enquiry.php?en=" . $en . "';</script>";

	exit;

}




if (mysqli_escape_string($link,htmlspecialchars(@$_POST['comment'] == ""))) {

	echo "<script language='javascript'>alert('Please Enter Required Details..');</script>";

	echo "<script language='javascript'>document.location = 'enquiry.php?en=" . $en . "';</script>";

	exit;

}

require 'vendor/autoload.php';

// $ENQUIRY_RECIPIENTS_ADMIN_MAIL = array('ambika.kiran@mmactiv.com', 'enquiry@bengalurutechsummit.com');



$enq1 = $enquiry = $enquiry2 = $enquiry3 = $enquiry4 = $enquiry5 = $enquiry6 = $enquiry7 = $enquiry8 = $enquiry9 = $enquiry10 = $enquiry11 = $enquiry12 = "";

if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry'])) != "") {

	$enq1     = $enq1 . @$_POST['enquiry'] . ",";

	$enquiry = $_POST['enquiry'];

	if ($enquiry === "Exhibition" || $enquiry === "Startup / POD") {

        // array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'chandrachood.as@mmactiv.com');

    }

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'bhavya.n@mmactiv.com');

}



if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry2'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry2'] . ",";

	$enquiry2 = $_POST['enquiry2'];

	//array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, '');

}



if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry3'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry3'] . ",";

	$enquiry3 = $_POST['enquiry3'];

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'chandrachood.as@mmactiv.com');

}



if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry4'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry4'] . ",";

	$enquiry4 = $_POST['enquiry4'];

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'gurunath.angadi@mmactiv.com', 'chandrachood.as@mmactiv.com');

}



if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry5'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry5'] . ",";

	$enquiry5 = $_POST['enquiry5'];

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'vani.faustina@mmactiv.com');

}



if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry6'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry6'];

	$enquiry6 = $_POST['enquiry6'];

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'santosh.jagtap@mmactiv.com');

}



if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry7'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry7'] . ",";

	$enquiry7 = $_POST['enquiry7'];

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'prabha.j@mmactiv.com');

}



if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry8'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry8'] . ",";

	$enquiry8 = $_POST['enquiry8'];

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'prabha.j@mmactiv.com');

}

if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry9'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry9'] . ",";

	$enquiry9 = $_POST['enquiry9'];

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'prabha.j@mmactiv.com');

}

if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry10'] != ""))) {

	$enq1     = $enq1 . @$_POST['enquiry10'] . ",";

	$enquiry10 = $_POST['enquiry10'];

	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'prabha.j@mmactiv.com');

}





if (mysqli_escape_string($link,htmlspecialchars(@$_POST['enquiry'] == "Other"))) {
	// Set the enquiry value to "Other" with the specific other_name
	$enq1     = $enq1 . "Other - " . @$_POST['other_name'] . " , ";
	$enquiry = "Other - " . @$_POST['other_name'];
	// array_push($ENQUIRY_RECIPIENTS_ADMIN_MAIL, 'santosh.jagtap@mmactiv.com');
}

// echo "Enquiry string: " . $enq1;
// // echo "<br>";
// // echo "Enquiry option: " . @$_POST['enquiry'];
// // echo "<br>";
// // echo "Other name value: " . @$_POST['other_name'];
// die;

$enq_str = $enq1;



$comments = @$_POST['comment'];



$temp_mda_type = @$_REQUEST['mda_type'];

$fname          = @$_POST['fname'];

$lname          = @$_POST['lname'];

$name = $fname . ' ' . $lname;

$company       = @$_POST['company'];

//$company = str_replace(" ", "", $company);

$addr          = @$_POST['addr1'];

//$addr = str_replace(" ", "", $addr);

$ddate         = date("d-M-Y");

$ttime         = date("H:i:s A");

$email         = strtolower(@$_POST['email']);



//if(($name == "")  ||  ($company == "")  ||  ($addr == ""))

if (($fname == "") || ($lname == "") || ($email == "") || $event_name == '') {

	echo "<script language='javascript'>alert('Please Enter Required Details.');</script>";

	echo "<script language='javascript'>document.location = ('enquiry.php?en=" . $en . "');</script>";

	exit();

}









//------------------------------------------------- Capturing enquiry fields ------------------------------------------

if (@$_POST['find_us'] == "Others") {

	$know_from = "Others" . '-' . @$_POST['other_txtbx_find_us'];

} else {

	$know_from = @$_POST['find_us'];

}



if (($know_from == "") || ($temp_mda_type != "")) {

	$know_from = $know_from . ", - " . $temp_mda_type;

}

$fone = '';

if (!empty($_POST['fone'])) {

	$fone = '+' . $_POST['foneCountryCode'] . "-" . $_POST['fone'];

}



$ENQUIRY_RECIPIENTS_ADMIN_MAIL_STR = implode(",", $ENQUIRY_RECIPIENTS_ADMIN_MAIL);

$title = mysqli_escape_string($link,htmlspecialchars(@$_POST['title']));

$company = mysqli_escape_string($link,htmlspecialchars(@$_POST['company']));

$desig = mysqli_escape_string($link,htmlspecialchars(@$_POST['desig']));

$addr1 = mysqli_escape_string($link,htmlspecialchars(@$_POST['addr1']));

$addr2 = mysqli_escape_string($link,htmlspecialchars(@$_POST['addr2']));

$city = mysqli_escape_string($link,htmlspecialchars(@$_POST['city']));

$state = mysqli_escape_string($link,htmlspecialchars(@$_POST['state']));

$country = mysqli_escape_string($link,htmlspecialchars(@$_POST['country']));

$zip = mysqli_escape_string($link,htmlspecialchars(@$_POST['zip']));

$cellno = mysqli_escape_string($link,htmlspecialchars(@$_POST['cellno']));

$fax = mysqli_escape_string($link,htmlspecialchars(@$_POST['fax']));

$website = mysqli_escape_string($link,htmlspecialchars(@$_POST['website']));

$event_name = mysqli_escape_string($link,htmlspecialchars(@$_POST['event_name']));

// $sector = mysqli_real_escape_string($link, html_entity_decode(trim($_POST['sector']), ENT_QUOTES, 'UTF-8'));

$sector = isset($_POST['sector']) ? mysqli_real_escape_string($link, html_entity_decode(trim($_POST['sector']), ENT_QUOTES, 'UTF-8')) : '';

$comments = mysqli_escape_string($link,htmlspecialchars(@$_POST['comment']));



$sql = "SELECT * FROM $ENQUIRY_TBL_NAME WHERE reg_id='" . $_SESSION['vercode_enq'] . "'";

$res = mysqli_query($link,$sql);

$res = mysqli_fetch_assoc($res);

$q="insert into $ENQUIRY_TBL_NAME (title,fname,lname,name, org, desig, addr, city, state, country, zip, fone, cellno, fax, email, website, enq1, enq2, enq3, enq4, enq5, enq6, enq7, enq8, enq9, comments, task_assigned_to1, task_assigned_to2, task_assigned_from, sp_msg, know_from, ddate, ttime, reg_id, event_name, event_year, sector) values('$title', '$fname', '$lname','$name', '$company', '$desig', '$addr1.$addr2', '$city', '$state', '$country', '$zip', '$fone', '$fone', '$fax', '$email', '$website', '$enquiry', '$enquiry2', '$enquiry3', '$enquiry4', '$enquiry5', '$enquiry6', '$enquiry7', '$enquiry8', '$enquiry9', '$comments', '$ENQUIRY_RECIPIENTS_ADMIN_MAIL_STR', '', '', '', '$know_from', '$ddate', '$ttime', '$_SESSION[vercode_enq]', '$event_name', '$EVENT_YEAR', '$sector')";

// print_r($q);exit;

if (!empty($enq_str) && !empty($fname) && !empty($lname) && !empty(mysqli_escape_string($link,htmlspecialchars($_POST['company']))) && empty($res)) {

	mysqli_query($link,"insert into $ENQUIRY_TBL_NAME (title,fname, lname, name, org, desig, addr, city, state, country, zip, fone, cellno, fax, email, website, enq1, enq2, enq3, enq4, enq5, enq6, enq7, enq8, enq9, comments, task_assigned_to1, task_assigned_to2, task_assigned_from, sp_msg, know_from, ddate, ttime, reg_id, event_name, event_year, sector) values('$title','$fname','$lname','$name', '$company', '$desig', '$addr1.$addr2', '$city', '$state', '$country', '$zip', '$fone', '$fone', '$fax', '$email', '$website', '$enquiry', '$enquiry2', '$enquiry3', '$enquiry4', '$enquiry5', '$enquiry6', '$enquiry7', '$enquiry8', '$enquiry9', '$comments', '$ENQUIRY_RECIPIENTS_ADMIN_MAIL_STR', '', '', '', '$know_from', '$ddate', '$ttime', '$_SESSION[vercode_enq]', '$event_name', '$EVENT_YEAR', '$sector')") or die(mysqli_error($link));

}

$wnt_info_arr = explode(",", $enq_str);

//print_r($_POST);exit;

foreach ($wnt_info_arr as $wnt_info_arr_ele) {



	$wnt_info_arr_ele = trim($wnt_info_arr_ele);

	if ($wnt_info_arr_ele != "") {

		//echo "<br />t:".$wnt_info_arr_ele;

		//mysqli_query($link,"insert into $ENQUIRY_TBL_NAME (title, name, org, desig, addr, city, state, country, zip, fone, cellno, fax, email, website, enq1, enq2, enq3, enq4, enq5, enq6, enq7, comments, task_assigned_to1, task_assigned_to2, task_assigned_from, sp_msg, know_from, ddate, ttime, reg_id, event_name, event_year) values('$_POST[title]', '$_POST[name]', '$_POST[company]', '$_POST[desig]', '$_POST[addr1].$_POST[addr2]', '$_POST[city]', '$_POST[state]', '$_POST[country]', '$_POST[zip]', '$fone', '$_POST[cellno]', '$_POST[fax]', '$email', '$_POST[website]', '$wnt_info_arr_ele', '', '', '', '', '', '', '$comments', '', '', '', '', '$know_from', '$ddate', '$ttime', '$_SESSION[vercode_enq]', '$EVENT_NAME', '$EVENT_YEAR')") or die(mysqli_error($link));







		$wnt_info_arr_ele_pos = array_search($wnt_info_arr_ele, $ENQUIRY_WNT_INFO_ARR);



		if (($wnt_info_arr_ele_pos >= 0) && ($wnt_info_arr_ele_pos <= 7) && ($wnt_info_arr_ele_pos !== false)) {



			

		}

	}

}





$temp_p_email = $email;

$temp_p_name = $name;



require "enq_emailer_admin.php";

//$str_career = "New Enquiry on http://www.bangaloreindiabio.in";	

$str_career = $ENQUIRY_FROM_SUBJECT_ADMIN_MAIL . $enq_str;

$str_career_bdy = $enq_mail_msg_admin;




$body = $str_career_bdy;





/*

foreach ($ENQUIRY_RECIPIENTS_ADMIN_MAIL as $emailid) {

	$mail->AddAddress($emailid);

	if (!$mail->Send()) {

		//echo $emailid.'###';

	}

	$mail->clearAddresses();

}*/


// print_r($ENQUIRY_RECIPIENTS_ADMIN_MAIL);
// exit;
elastic_mail_frm($str_career, $str_career_bdy, $ENQUIRY_RECIPIENTS_ADMIN_MAIL, " ");



/*---------------------------------------------------------------------------------------------------------------------------*/





//user







$temp_p_email = $ENQUIRY_FROM_EMAIL_USER_MAIL;

$temp_p_name = $ENQUIRY_FROM_NAME_USER_MAIL;



require "enq_emailer_user.php";

$str_career = $ENQUIRY_FROM_SUBJECT_USER_MAIL;

$str_career_bdy = $enq_emailer_mail_msg_user;



$ENQUIRY_RECIPIENTS_USER_MAIL[] = '';

$ENQUIRY_RECIPIENTS_USER_MAIL[] = $email;



//$ENQUIRY_RECIPIENTS_USER_MAIL = array('test.interlinks@gmail.com','', 'sagar.patil@interlinks.in');


// print_r ($ENQUIRY_RECIPIENTS_USER_MAIL);
// exit;
elastic_mail_frm($str_career, $str_career_bdy, $ENQUIRY_RECIPIENTS_USER_MAIL, " ");



//  echo "$enq_mail_msg_admin<br />";

// 	 echo "<br />$str_career_bdy";

// 	 exit;







echo "<script language='javascript'>window.location='enquiry_confirmation.php?dele_typ=$enq2&en=$eventName';</script>";

exit;

