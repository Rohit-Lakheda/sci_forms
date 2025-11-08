<?php
ini_set('max_execution_time', '0');
//ini_set('display_errors', 1);
// session_start();
// print_r($_POST);
// // echo "\n";
// // echo "\n";
// die;


include 'csrf_token.php';
// Function to validate CSRF token
function validateCsrfToken($token)
{
	return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Retrieve the CSRF token from the form submission
	$formToken = isset($_POST['csrf_token']) ? $_POST['csrf_token'] : '';

	// Validate the CSRF token
	if (!validateCsrfToken($formToken)) {
		// mysqli_close($link);
		echo '<script type="text/javascript">
				alert("An error occurred. Please try again.");
				window.location.href = "https://sci25.supercomputingindia.org";
			  </script>';
		exit; // Stop further processing
	}

}

$del = $_POST['del'];
$cit = $_POST['cit'];
require "dbcon_open.php";
// $secretKey = "0x4AAAAAABS3bDRJl-equeiUW93Oq8Jhjhc";

// print_r($_POST);
// die;
// Check if CAPTCHA response is set
// if (isset($_POST['cf-turnstile-response'])) {
// 	$captchaResponse = $_POST['cf-turnstile-response'];

// 	// echo $captchaResponse;
// 	// die;
// 	// Verify CAPTCHA with Cloudflare
// 	$verifyUrl = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
// 	$data = [
// 		'secret' => $secretKey,
// 		'response' => $captchaResponse,
// 		// 'remoteip' => $_SERVER['REMOTE_ADDR'] // Optional, tracks the user's IP
// 	];

// 	// Send POST request to verify
// 	$options = [
// 		'http' => [
// 			'header' => "Content-type: application/x-www-form-urlencoded\r\n",
// 			'method' => 'POST',
// 			'content' => http_build_query($data),
// 		],
// 	];
// 	$context = stream_context_create($options);
// 	$result = file_get_contents($verifyUrl, false, $context);

// 	if ($result === FALSE) {
// 		echo "<script>alert('CAPTCHA verification failed. Please try again.');</script>";
// 		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
// 		exit;
// 		die("Error verifying CAPTCHA.");
// 	}

// $response = json_decode($result, true);
// echo $response;

// // Check verification status
// if ($response['success']) {
// CAPTCHA successful
// Process selected sectors
$selectedSectors = isset($_POST['sector']) ? (is_array($_POST['sector']) ? $_POST['sector'] : (is_string($_POST['sector']) ? explode(',', $_POST['sector']) : [])) : [];

// If "Others" is selected, replace it with the user input
if (in_array('Others', $selectedSectors) && !empty($_POST['other-sector-input'])) {
	$otherSector = htmlspecialchars($_POST['other-sector-input'], ENT_QUOTES, 'UTF-8');

	// Replace "Others" in the array with the actual user-entered value
	$selectedSectors = array_map(function ($sector) use ($otherSector) {
		return $sector === 'Others' ? $otherSector : $sector;
	}, $selectedSectors);

	// Store the user input separately in session
	$_SESSION['other-sector-input'] = $otherSector;
} else {
	$_SESSION['other-sector-input'] = ''; // Clear if "Others" is not selected
}

// Store updated sectors in session
$_SESSION['sector'] = $selectedSectors;

// Convert array to string for storing in DB or displaying
$sectorString = implode(', ', $selectedSectors);


require "form_includes/form_constants_both.php";
// print_r($_POST);exit;
$en = '';

$promocode = isset($_POST['promoCodeHidden']) ? mysqli_real_escape_string($link, $_POST['promoCodeHidden']) : '';
$adminDiscountPer = 0;
$event_date = '13-12-2025';
$event_date = date('Y-m-d', strtotime($event_date));


// Convert the array of selected sectors into a comma-separated string
$sectorString = implode(', ', $selectedSectors);

// $promocode = $_POST['promoCodeHidden'];
//update the res[]
// Check if promocode is not empty
if (!empty($promocode)) {
	// Handle TEST51 separately (hardcoded test promocode)
	if ($promocode == 'TEST51') {
		$PromoCode1 = 'TEST51';
		$adminDiscountPer = 0; // No percentage discount for TEST51
	} else {
		// Use prepared statements to prevent SQL injection for database promocodes
		$stmt = $link->prepare("SELECT * FROM promo_codes WHERE code = ? AND remaining > 0");
		$stmt->bind_param("s", $promocode);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$promo = $result->fetch_assoc();
			$adminDiscountPer = $promo['discount'];
			$PromoCode1 = $promo['code'];
		}
	}
}

//  <select class="form-control" name="pass_type" id="pass_type" required>
                                                    // <option value="">-- Select Pass Type --</option>
                                                    // <option value="workshop">Workshop + Tutorial</option>
                                                    // <option value="exhibition">Exhibition Pass</option>
                                                    // <option value="technical">Technical Program + Workshop + Tutorial + Exhibition</option>
                                                // </select>

//MAKE THIS AS 2-DAY DELEGATE PASS
//IF cata != Next Gen HPC Experience
//then pass_type is mandatory

$cata = isset($_POST['cata']) ? trim($_POST['cata']) : '';
$pass_type = ''; // Default
// echo $cata;
if ($cata !== 'Next Gen HPC Experience' && $cata !== 'Author') {
	if (empty($_POST['pass_type'])) {
		echo "<script>alert('Please select Pass Type.');</script>";
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
		exit;
	}

	if ($_POST['pass_type'] === 'technical') {
		$pass_type = 'Technical Program + Workshop + Tutorial + Exhibition';
	} elseif ($_POST['pass_type'] === 'exhibition') {
		$pass_type = 'Exhibition Pass';
	} elseif ($_POST['pass_type'] === 'workshop') {
		$pass_type = '2-Day Delegate Pass';
	} else {
		$pass_type = $cata;
	}
	// $pass_type = htmlspecialchars($_POST['pass_type'], ENT_QUOTES, 'UTF-8');
}
else {
	$pass_type = $cata;
}

// Debug will be shown after $days is read (see below)



// add a logic that if title1 is Ms. or Mrs. and promocode is SPECIALWO10 then only apply womens day promocode else make promocode and admin discount empty
// $title1 = htmlspecialchars($_POST['title1'], ENT_QUOTES, 'UTF-8');
// $currentDate = date('Y-m-d');
// if ($currentDate == '2025-03-08' && ($title1 == 'Ms.' || $title1 == 'Mrs.')) {
// 	$PromoCode1 = 'SPECIALWO10';
// 	$adminDiscountPer = 10;
// }

// $cata = htmlspecialchars($_POST['cata'], ENT_QUOTES, 'UTF-8');
// if ($cata == 'Investor Business Visitor') {
// 	$PromoCode1 = '';
// 	$adminDiscountPer = 100;
// }
// print_r($sectorString);
// die;
$ieee_member = isset($_POST['ieee_member']) && !empty($_POST['ieee_member']) 
	? mysqli_real_escape_string($link, htmlspecialchars($_POST['ieee_member'])) 
	: null;
$ieee_member_number = isset($_POST['ieee_member_number']) && !empty($_POST['ieee_member_number']) 
	? mysqli_real_escape_string($link, htmlspecialchars($_POST['ieee_member_number'])) 
	: null;
// Save amounts in food and kit columns instead of Yes/No
$food_amount = isset($_POST['food_amount']) ? (float)$_POST['food_amount'] : 0;
$kit_amount = isset($_POST['kit_amount']) ? (float)$_POST['kit_amount'] : 0;
$food = $food_amount; // Save amount in food column
$kit = $kit_amount; // Save amount in kit column
$abstract_title= isset($_POST['abstract_title']) && !empty($_POST['abstract_title']) 
	? mysqli_real_escape_string($link, htmlspecialchars($_POST['abstract_title'])) 
	: null;
$abstract_text = isset($_POST['abstract_text']) && !empty($_POST['abstract_text']) 
	? mysqli_real_escape_string($link, htmlspecialchars($_POST['abstract_text'])) 
	: null;
$org = htmlspecialchars($_POST['org'], ENT_QUOTES, 'UTF-8');
$abstract_presenter = htmlspecialchars($_POST['abstract_presenter'], ENT_QUOTES, 'UTF-8');
$abstract_email = htmlspecialchars($_POST['abstractno'], ENT_QUOTES, 'UTF-8');
$accompanying_person = htmlspecialchars($_POST['accompanying_person'], ENT_QUOTES, 'UTF-8');
// $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
// $state = htmlspecialchars($_POST['state'], ENT_QUOTES, 'UTF-8');
$country = htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8');

$packages = htmlspecialchars($_POST['package'], ENT_QUOTES, 'UTF-8');

// Get days from exhibition_day, or fallback to exhibition_day_all for exhibition pass
$days = '';
if (isset($_POST['exhibition_day']) && !empty($_POST['exhibition_day'])) {
	$days = htmlspecialchars($_POST['exhibition_day'], ENT_QUOTES, 'UTF-8');
} elseif (isset($_POST['exhibition_day_all']) && !empty($_POST['exhibition_day_all'])) {
	$days = htmlspecialchars($_POST['exhibition_day_all'], ENT_QUOTES, 'UTF-8');
}

$time_slot = isset($_POST['time_slot']) ? htmlspecialchars($_POST['time_slot'], ENT_QUOTES, 'UTF-8') : '';

$branch = htmlspecialchars($_POST['branch1'], ENT_QUOTES, 'UTF-8');

$course = htmlspecialchars($_POST['course1'], ENT_QUOTES, 'UTF-8');

$paper_id = htmlspecialchars($_POST['paper_id'], ENT_QUOTES, 'UTF-8');
// if del = author then paper id is mandatory
if ($del == 'author' && empty($paper_id)) {
	echo "<script>alert('Please enter Paper ID for Author registration.');</script>";
	echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
	exit;
}

// Handle ID card upload
$upload_id_card = '';
if (isset($_FILES['id_card1']) && !empty($_FILES['id_card1']['name'])) {
	$maxsize = 2097152; // 2MB
	$file_size = $_FILES['id_card1']['size'];
	$file_type = strtolower(pathinfo($_FILES['id_card1']['name'], PATHINFO_EXTENSION));
	$allowedTypes = array('pdf');
	
	if (!in_array($file_type, $allowedTypes)) {
		echo "<script>alert('Please upload only PDF files for ID card.');</script>";
		echo "<script>window.location='info.php?del=$del&cit=$cit';</script>";
		exit;
	}
	
	if ($file_size > $maxsize) {
		echo "<script>alert('ID card file size must be under 2MB!');</script>";
		echo "<script>window.location='info.php?del=$del&cit=$cit';</script>";
		exit;
	}
	
	$upload_path = 'upload1/';
	if (!file_exists($upload_path)) {
		mkdir($upload_path, 0777, true);
	}
	
	$new_filename = 'id_card_' . date("dmyHis") . '_' . $reg_id . '.' . $file_type;
	$file_destination = $upload_path . $new_filename;
	
	if (move_uploaded_file($_FILES['id_card1']['tmp_name'], $file_destination)) {
		$upload_id_card = 'https://sci25.supercomputingindia.org/sci_forms/upload1/' . $new_filename;
	} else {
		echo "<script>alert('Error in uploading ID card, please try again.');</script>";
		echo "<script>window.location='info.php?del=$del&cit=$cit';</script>";
		exit;
	}
}

// echo $upload_id_card;

$nationality_input = htmlspecialchars($_POST['nationality'], ENT_QUOTES, 'UTF-8');


// $total_dele = htmlspecialchars($_POST['attendees'], ENT_QUOTES, 'UTF-8');

// If IEEE member is yes, limit attendees to 1
if (isset($_POST['ieee_member']) && strtolower($_POST['ieee_member']) === 'yes') {
	// Check if IEEE member number is provided
	if (empty($_POST['ieee_member_number'])) {
		echo "<script language='javascript'>alert('Please enter your IEEE Member Number.');</script>";
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
		exit;
	}
	// If IEEE member is yes and member number is provided, force attendees to be exactly 1
	$total_dele = 1;
} else {
	// Normal case - use the submitted attendees count
	$total_dele = htmlspecialchars($_POST['attendees'], ENT_QUOTES, 'UTF-8');
}
// echo $total_dele;
// die();
// Get the selected org_reg_type and sanitize it
$org_reg_type = htmlspecialchars($_POST['org_reg_type'], ENT_QUOTES, 'UTF-8');

// If "Others" is selected, store the input value in a separate session variable
if ($org_reg_type == 'Others') {
	$org_reg_type = mysqli_escape_string($link, htmlspecialchars($_POST['Other-User-input'], ENT_QUOTES, 'UTF-8'));
	$_SESSION['org_reg_type'] = 'Others'; // Store the key value for "Others"
	$_SESSION['Other-User-input'] = htmlspecialchars($_POST['Other-User-input'], ENT_QUOTES, 'UTF-8');
} else {
	// For other selections, just store the selected option
	$_SESSION['org_reg_type'] = $org_reg_type;
	$_SESSION['Other-User-input'] = ''; // Clear the input if "Others" was not selected
}
// $bharat_user_type = mysqli_real_escape_string($link, htmlspecialchars($_POST['bharat_user_type'], ENT_QUOTES, 'UTF-8'));
// $year_of_birth = mysqli_real_escape_string($link, htmlspecialchars($_POST['year_of_birth'], ENT_QUOTES, 'UTF-8'));
// $year_of_inception = mysqli_real_escape_string($link, htmlspecialchars($_POST['year_of_inception'], ENT_QUOTES, 'UTF-8'));
// $bs_org_reg_type = mysqli_real_escape_string($link, htmlspecialchars($_POST['bs_org_reg_type'], ENT_QUOTES, 'UTF-8'));

// $_SESSION['bharat_user_type'] = $bharat_user_type;
// $_SESSION['year_of_birth'] = $year_of_birth;
// $_SESSION['year_of_inception'] = $year_of_inception;
// $_SESSION['bs_org_reg_type'] = $bs_org_reg_type;

// $investor_flag = mysqli_real_escape_string($link, htmlspecialchars($_POST['del'], ENT_QUOTES, 'UTF-8'));
$member_of_ivca = mysqli_real_escape_string($link, htmlspecialchars($_POST['ivca'], ENT_QUOTES, 'UTF-8'));
$are_you_investor = mysqli_real_escape_string($link, htmlspecialchars($_POST['are_you_investor'], ENT_QUOTES, 'UTF-8'));
$investor_association = mysqli_real_escape_string($link, htmlspecialchars($_POST['investor_association'], ENT_QUOTES, 'UTF-8'));

$_SESSION['ivca'] = $member_of_ivca;
$_SESSION['are_you_investor'] = $are_you_investor;
$_SESSION['investor_association'] = $investor_association;
// $gst_inv_addr = $gst_inv_reg_no = $gst_inv_pan = $gst_inv_state = $gst_inv_cp = $gst_inv_phone = $gst_inv_email = '';
// $cata = htmlspecialchars($_POST['cata'], ENT_QUOTES, 'UTF-8');
// $subevent = $_POST['subevent'];

// $cata2 = isset($_POST['cata2']) ? htmlspecialchars($_POST['cata2']) : '';

// $_SESSION['sector'] = $sector;
$_SESSION['org'] = $org;
$_SESSION['total_dele'] = $total_dele;
//$cata_m = @htmlspecialchars( $_POST['org_reg_type'],ENT_QUOTES, 'UTF-8');
// print_r($_SESSION);
// die;
$_SESSION['gst'] = htmlspecialchars($_POST['gst']);
$_SESSION['invoiceAddress'] = '';
$_SESSION['gstNumber'] = '';
$_SESSION['panNumber'] = '';
$_SESSION['gst_inv_state'] = '';
$_SESSION['contactPersonName'] = '';
$_SESSION['contactPersonEmail'] = '';
$_SESSION['contactPersonPhone'] = '';
$GSTreq = $_POST['gst'];
if ($GSTreq == 'Yes') {

	$gst_inv_addr = htmlspecialchars($_POST['invoiceAddress']);
	$gst_inv_reg_no = htmlspecialchars($_POST['gstNumber']);
	$gst_inv_pan = htmlspecialchars($_POST['panNumber']);
	$gst_inv_state = htmlspecialchars($_POST['gst_inv_state']);
	$gst_inv_cp = htmlspecialchars($_POST['contactPersonName']);
	$gst_inv_phone = htmlspecialchars($_POST['contactPersonPhone']);
	// add +91- before gst_inv_phone
	$gst_inv_phone1 = '+91-' . $gst_inv_phone;
	$gst_inv_email = htmlspecialchars($_POST['contactPersonEmail']);


	$_SESSION['invoiceAddress'] = $gst_inv_addr;
	$_SESSION['gstNumber'] = $gst_inv_reg_no;
	$_SESSION['panNumber'] = $gst_inv_pan;
	$_SESSION['gst_inv_state'] = $gst_inv_state;
	$_SESSION['contactPersonName'] = $gst_inv_cp;
	$_SESSION['contactPersonPhone'] = $gst_inv_phone;
	$_SESSION['contactPersonEmail'] = $gst_inv_email;
}
$del = $_POST['del'];
$cit = $_POST['cit'];
// store in session
$_SESSION['del'] = $del;
$_SESSION['cit'] = $cit;

$assoc_name = @htmlspecialchars($_POST['assoc_name']);
$assoc_name = trim($assoc_name);

//echo $_SESSION["vercode_reg"] . '#' . $_POST["vercode"];exit;
if (empty($_SESSION["vercode_reg"]) || ($_POST["vercode"] != $_SESSION["vercode_reg"])) {

	session_destroy();
	mysqli_close($link);
	echo "<script language='javascript'>alert('Invalid captcha. Please try again...!');</script>";
	if (!empty($assoc_name)) {
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
	} else {
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
	}
	exit;
}

$conf_type = "Virtual Conference";


//print_r($_POST);exit;
$total_dele = mysqli_real_escape_string($link, $total_dele);


if (empty($total_dele)) {
	echo "<script language='javascript'>alert('Please select number of delegate.');</script>";
	echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
	exit;
}

//require ("form_includes/form_constants.php");


$ddate = date("Y-m-d");
$ttime = date("H:i:s A");
$reg_id = $_SESSION['vercode_reg'];
$ret = @$_GET['ret'];

if ($ret == "retds4fu324rn_ed24d3it") {
	mysqli_query($link, "delete from " . $EVENT_DB_FORM_REG_DEMO . " where reg_id = '$reg_id' ") or die(mysqli_error($link));
}

// If pass_type is set (workshop, exhibition, or technical), use it as cata
// Otherwise, use the cata from POST
if (!empty($pass_type) && ($pass_type == '2-Day Delegate Pass' || $pass_type == 'Exhibition Pass' || $pass_type == 'Technical Program + Workshop + Tutorial + Exhibition')) {
	$cata = mysqli_real_escape_string($link, $pass_type);
} else {
	$cata = @mysqli_real_escape_string($link, $_POST['cata']);
}
$org_reg_type = htmlspecialchars($_POST['org_reg_type'], ENT_QUOTES, 'UTF-8');

// if ($org_reg_type == 'Investors' || $org_reg_type == 'Institutional Investor') {
// 	if ($cata == 'Gold Delegate Pass') {
// 		$cata = 'Investor Gold Pass';
// 	} else if ($cata == 'Silver Delegate Pass') {
// 		$cata = 'Investor Silver Pass';
// 	} else if ($cata == 'Bronze Delegate Pass') {
// 		$cata = 'Investor Bronze Pass';
// 	}
// }



// if dele != next gen hpc experience and dele != author then days must be day1 or day2 else day day2 day3 day4
// Skip validation if pass_type is Technical Program + Workshop + Tutorial + Exhibition
if ($pass_type != 'Technical Program + Workshop + Tutorial + Exhibition' && $del != 'author') {
	// Check if days is empty
	if (empty($days)) {
		echo "<script language='javascript'>alert('For selected delegate type, please select Day.');</script>";
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
		exit;
	}
	
	// For 2-Day Delegate Pass (workshop), days will be comma-separated like "Day1,Day2"
	if ($pass_type == '2-Day Delegate Pass') {
		// Validate 2-day combinations for workshop pass
		$validWorkshopDays = ['Day1,Day2', 'Day2,Day3', 'Day3,Day4'];
		if (!in_array($days, $validWorkshopDays)) {
			// Show debug info in error message
			$debugInfo = "Received days value: '" . htmlspecialchars($days, ENT_QUOTES) . "'. Expected: Day1,Day2, Day2,Day3, or Day3,Day4.";
			echo "<script language='javascript'>alert('For 2-Day Delegate Pass, please select a valid day combination.\\n\\n" . addslashes($debugInfo) . "');</script>";
			echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
			exit;
		}
	} elseif ($del != 'nextgen' && $pass_type != 'Exhibition Pass') {
		// For other pass types (not workshop, not exhibition, not nextgen)
		if ($days != 'Day1' && $days != 'Day2') {
			echo "<script language='javascript'>alert('For selected delegate type, please select Day.');</script>";
			echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
			exit;
		}
	} else {
		// For Exhibition Pass or nextgen
		if ($pass_type == 'Exhibition Pass') {
			// Exhibition Pass should have all days combined
			if ($days != 'Day2,Day3,Day4') {
				echo "<script language='javascript'>alert('For Exhibition Pass, all days are automatically selected.');</script>";
				echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
				exit;
			}
		} else {
			// For nextgen
			if ($days != 'Day2' && $days != 'Day3' && $days != 'Day4') {
				echo "<script language='javascript'>alert('For selected delegate type, please select Day.');</script>";
				echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
				exit;
			}
		}
	}
}

// Convert day values to display format
if (strpos($days, ',') !== false) {
	// Handle comma-separated days (for workshop and exhibition passes)
	$dayArray = explode(',', $days);
	$dayDisplayArray = [];
	foreach ($dayArray as $day) {
		if ($day == 'Day1') {
			$dayDisplayArray[] = 'Day 1 (9-12-2025)';
		} elseif ($day == 'Day2') {
			$dayDisplayArray[] = 'Day 2 (10-12-2025)';
		} elseif ($day == 'Day3') {
			$dayDisplayArray[] = 'Day 3 (11-12-2025)';
		} elseif ($day == 'Day4') {
			$dayDisplayArray[] = 'Day 4 (12-12-2025)';
		}
	}
	$days = implode(', ', $dayDisplayArray);
} else {
	// Handle single day values
	if ($days == 'Day1') {
		$days = 'Day 1 (9-12-2025)';
	} elseif ($days == 'Day2') {
		$days = 'Day 2 (10-12-2025)';
	} elseif ($days == 'Day3') {
		$days = 'Day 3 (11-12-2025)';
	} elseif ($days == 'Day4') {
		$days = 'Day 4 (12-12-2025)';
	}
}

//print_r($_POST);exit;
$curr = @mysqli_real_escape_string($link, htmlspecialchars($_POST['curr']));


$pay_status = "Not Paid";

$paymode = @mysqli_real_escape_string($link, htmlspecialchars($_POST['paymode']));
//$grp        = $_POST['grp'];
$member_of_assoc = @mysqli_real_escape_string($link, htmlspecialchars($_POST['member_of_assoc']));
$grp = 'Group';



if ($total_dele == 1) {
	$grp = 'Single';
}
if ($grp != "Single") {
	if (($total_dele > 7) || ($total_dele <= 1)) {
		session_destroy();
		mysqli_close($link);
		echo "<script language='javascript'>alert('In group min 2 and maximum 7 delegates are allowed.');</script>";
		if (!empty($assoc_name)) {
			echo "<script language='javascript'>window.location = 'registration.php?en=$en&assoc_name=$assoc_name';</script>";
		} else {
			echo "<script language='javascript'>window.location = 'registration.php?en=$en';</script>";
		}
		exit;
	}
}
if ($cata == 'Next Gen HPC Experience'){
	$grp = 'Group';	
}

//if paystatus == free and no of delegate >=2 then make paystatus = not paid
if ($pay_status == 'Free' && $total_dele >= 2) {
	$pay_status = 'Not Paid';
}

$assoc_srno = @mysqli_real_escape_string($link, htmlspecialchars($_POST['assoc_srno']));
$user_type = @mysqli_real_escape_string($link, htmlspecialchars($_POST['user_type']));
$promo_code = '';
if (!empty($assoc_srno) && !empty($user_type)) {
	$sql = "SELECT * FROM $EVENT_DB_FORM_PROMO_CODE_TBL WHERE srno=$assoc_srno AND assoc_name='$user_type'";
	$resulre = mysqli_query($link, $sql);
	if (mysqli_num_rows($resulre) <= 0) {
		mysqli_close($link);
		echo "<script language='javascript'>alert('Invalid promo code. Please try again!');</script>";
		echo "<script language='javascript'>window.location='registration.php';</script>";
		exit;
	}
	$resulre = mysqli_fetch_assoc($resulre);
	$promo_code = @mysqli_real_escape_string($link, $_POST['promo_code']);
	if ($resulre['promo_code'] != $promo_code) {
		mysqli_close($link);
		echo "<script language='javascript'>alert('Invalid promo code! Please try again.');</script>";
		echo "<script language='javascript'>window.location='registration.php';</script>";
		exit;
	}
}

$user_type1 = $user_type;

// $org = mysqli_real_escape_string($link, $org);
// Assuming $link is your MySQL connection
mysqli_set_charset($link, 'utf8');

// Then use mysqli_real_escape_string as usual
$org = mysqli_real_escape_string($link, $org);

// $nature = @mysqli_real_escape_string($link, $org);
// $addr1 = mysqli_real_escape_string($link, $ad);
// $addr2 = mysqli_real_escape_string($link, @htmlspecialchars($_POST['addr2']));
// $city = mysqli_real_escape_string($link, $city);
// $state = mysqli_real_escape_string($link, @htmlspecialchars($_POST['state']));
$address = mysqli_real_escape_string($link, htmlspecialchars($_POST['address']));
$city = mysqli_real_escape_string($link, htmlspecialchars($_POST['city']));
$state = mysqli_real_escape_string($link, htmlspecialchars($_POST['state']));
$zipcode = mysqli_real_escape_string($link, htmlspecialchars($_POST['zipcode'], ENT_QUOTES, 'UTF-8'));
$country = mysqli_real_escape_string($link, htmlspecialchars($_POST['country']));
// $pin = @mysqli_real_escape_string($link, htmlspecialchars($_POST['pin']));
// $gst = @mysqli_real_escape_string($link, htmlspecialchars($_POST['gst']));

// if zipcode is india then it must be 6 digits or else min 3 and max 10
if ($country == 'India') {
	if (!preg_match('/^\d{6}$/', $zipcode)) {
		echo "<script language='javascript'>alert('For India, Zipcode must be exactly 6 digits.');</script>";
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
		exit;
	}
} else {
	if (!preg_match('/^[a-zA-Z0-9\-\s\.,\/#&_\(\)]{3,10}$/', $zipcode)) {
		echo "<script language='javascript'>alert('For selected country, Zipcode must be between 3 to 10 characters.');</script>";
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
		exit;
	}
}

$_SESSION['address'] = $address;
$_SESSION['city'] = $city;
$_SESSION['state'] = $state;
$_SESSION['zipcode'] = $zipcode;
$_SESSION['country'] = $country;

if (($org == "") || ($country == "")) {
	echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
	echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
	exit;
}
if ($_POST['gst'] == 'Yes') {
	if (($gst_inv_addr == "") || ($gst_inv_reg_no == "") || ($gst_inv_pan == "") || ($gst_inv_state == "") || ($gst_inv_cp == "") || ($gst_inv_phone == "") || ($gst_inv_email == "")) {
		echo "<script language='javascript'>alert('Provide all required (* marked) detail.');</script>";
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
		exit;
	}
}
if ($_POST['gst'] == 'Yes') {
	$is_gst_invoice_needed = mysqli_real_escape_string($link, $GSTreq);
	$gst_inv_addr = mysqli_real_escape_string($link, $gst_inv_addr);
	$gst_inv_reg_no = mysqli_real_escape_string($link, $gst_inv_reg_no);
	$gst_inv_pan = mysqli_real_escape_string($link, $gst_inv_pan);
	$gst_inv_state = mysqli_real_escape_string($link, $gst_inv_state);
	$gst_inv_cp = mysqli_real_escape_string($link, $gst_inv_cp);
	$gst_inv_phone = mysqli_real_escape_string($link, $gst_inv_phone);
	$gst_inv_email = mysqli_real_escape_string($link, $gst_inv_email);

	if (($gst_inv_addr == "") || ($gst_inv_reg_no == "") || ($gst_inv_pan == "") || ($gst_inv_state == "") || ($gst_inv_cp == "") || ($gst_inv_phone == "") || ($gst_inv_email == "")) {
		echo "<script language='javascript'>alert('Provided all required (* marked) details .');</script>";
		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
		exit;
	}
}
$gem_connect = mysqli_real_escape_string($link, htmlspecialchars($_POST['gem_connect']));
$_SESSION['gem_connect'] = $gem_connect;


/* Start Company Registration Certificate Upload */
// if ($del == 'student' || $del == 'academic') {
// 	if (isset($_FILES['ci_certf']['name']) && !empty($_FILES['ci_certf']['name'])) {

// 		$maxsize = 2097152;
// 		$file_size = $_FILES['ci_certf']['size'];
// 		$file_type = strtolower(pathinfo($_FILES['ci_certf']['name'], PATHINFO_EXTENSION));
// 		$mimeType = array('doc', 'docx');

// 		if (!in_array($file_type, $mimeType)) {
// 			echo "<script>alert('Please upload only MS Word Document file (.doc or .docx).');</script>";
// 			echo "<script>window.location='info.php?del=$del&cit=$cit&rt=retds4fn324rn_ed24d3it';</script>";
// 			exit;
// 		}
// 		if ($file_size > $maxsize) {
// 			echo "<script>alert('File size must be under 2MB!');</script>";
// 			echo "<script>window.location='info.php?del=$del&cit=$cit&rt=retds4fn324rn_ed24d3it';</script>";
// 			exit;
// 		}

// 		$ci_certf_UploadPath = 'poster_certificate/';
// 		if (!file_exists($ci_certf_UploadPath)) {
// 			mkdir($ci_certf_UploadPath, 0777, true);
// 		}

// 		$filePath = $ci_certf_UploadPath . 'ci_certf_' . date("dmyHis") . $reg_id . '.' . $file_type;

// 		if (move_uploaded_file($_FILES['ci_certf']['tmp_name'], $filePath)) {
// 			$filePath = $EVENT_FORM_LINK . $filePath;
// 		} else {
// 			echo "<script>alert('Error in uploading certificate, please try again.');</script>";
// 			echo "<script>window.location='info.php?del=$del&cit=$cit&rt=retds4fn324rn_ed24d3it';</script>";
// 			exit;
// 		}

// 	} else {
// 		// User said YES to upload, but didn't select a file
// 		if (isset($_POST['poster']) && $_POST['poster'] === 'yes') {
// 			echo "<script>alert('Please upload your Certificate in MS Word format (.doc or .docx).');</script>";
// 			echo "<script>window.location='info.php?del=$del&cit=$cit&rt=retds4fn324rn_ed24d3it';</script>";
// 			exit;
// 		}
// 	}
// } else {
// 	$filePath = '';
// }


/* End Company Registration Certification upload */




//$assoc_name = str_replace('_', ' ', $assoc_name);
$amt_ext = "";
$dollar = "";
// $cata = "";

if ($curr == "ind") {
	$curr = "Indian";
	$dollar = "1";
	$amt_ext = "Rs.";
	$nationality = "Indian Organization";
	// if (mysqli_real_escape_string($link, @$_POST['cata']) != "") {
	// 	$cata = mysqli_real_escape_string($link, $_POST['cata']);
	// }

	//require "bharat_startup_api.php";
} else if ($curr == "int") {
	// include "exchange_rate_api.php";
	$curr = "Foreign";
	$dollar = $DOLLAR_RATE;
	$amt_ext = "USD";
	$nationality = "International Organization";
	// if (isset($_POST['cata']) && $_POST['cata'] != "") {
	// 	$cata = mysqli_real_escape_string($link, $_POST['cata']);
	// }
}


$paymode = '';

// $city = mysqli_real_escape_string($link, $_SESSION['city']);

// bharat startup data
$st_email = @mysqli_real_escape_string($link, htmlspecialchars($_POST['st_email']));
$st_name = @mysqli_real_escape_string($link, htmlspecialchars($_POST['st_name']));
$st_stage = @mysqli_real_escape_string($link, htmlspecialchars($_POST['st_stage']));
$exhi_profile = @mysqli_real_escape_string($link, htmlspecialchars($_POST['exhi_profile']));

// Store all 4 above data in session
$_SESSION['st_email'] = $st_email;
$_SESSION['st_name'] = $st_name;
$_SESSION['st_stage'] = $st_stage;
$_SESSION['exhi_profile'] = $exhi_profile;

$rate_org = $amt = $temp_sess_sp_msg = 0;
// echo $EVENT_DB_FORM_REG_DEMO;
// die;
// $query = "insert into " . $EVENT_DB_FORM_REG_DEMO . "(org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,pay_status,
// 	amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,assoc_name,member_of_assoc,
// 	assoc_srno,user_type,conference_type,adminDiscountPer,promocode1,st_email, company_profile, st_name, st_stage) values
// 	 ('$org_reg_type','$nationality','$cata','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org',
// 	 '$amt','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$assoc_name', '$member_of_assoc','$assoc_srno','$user_type1',
// 	 '$conf_type','$adminDiscountPer','$PromoCode1','$st_email','$exhi_profile','$st_name','$st_stage')";
// echo "\n";
// echo $query;
// print_r($_POST);
// die;
// print_r($sectorString);
// die;
$validOrgRegTypes = array(
	'High Performance Computing' => 'High Performance Computing',
									'Artificial Intelligence' => 'Artificial Intelligence',
									'Quantum Computing' => 'Quantum Computing',
									'Government / Public Sector' => 'Government / Public Sector',
									'Chip Design' => 'Chip Design',
									'Research & Academia' => 'Research & Academia',
									'Startups' => 'Startups',
									'MSMEs' => 'MSMEs',
									'Student' => 'Student',
									'Professor/Faculty' => 'Professor/Faculty',
									'Others' => 'Others'
);

if (!array_key_exists($org_reg_type, $validOrgRegTypes)) {
	$org_reg_type = 'Other - ' . $org_reg_type;
}
$pagesNumber = mysqli_real_escape_string($link, htmlspecialchars($_POST['pagesNumber'], ENT_QUOTES, 'UTF-8'));
//if Author then pagesNumber is mandatory
if ($del == 'author' && empty($pagesNumber)) {
	echo "<script>alert('Please enter Number of Pages for Author registration.');</script>";
	echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
	exit;
}

// echo"hy";
// die;
$ieee_status = (empty($ieee_member) || strtolower($ieee_member) === 'no') ? "Not Applicable" : "Awaiting";
mysqli_query($link, "insert into " . $EVENT_DB_FORM_REG_DEMO . "(org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,pay_status,
	amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,assoc_name,member_of_assoc,
	assoc_srno,user_type,conference_type,adminDiscountPer,promocode1,st_email, company_profile, st_name, st_stage,bharat_user_type,year_of_birth,year_of_inception,
	bs_org_reg_type, member_of_ivca, investor_flag, GeM, are_you_investor, investor_association,abstract_presenter,abstract_email,accompanying_person,
	ci_certf,abstract_text,abstract_title,ieee_member,ieee_mem_id,ieee_status,packages,dayS,time_slot,branch,course,id_card,national,paper_id, pagesNumber,food,kit) values
	 ('$sectorString','$nationality','$cata','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org',
	 '$amt','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$assoc_name', '$member_of_assoc','$assoc_srno','$user_type1',
	 '$conf_type','$adminDiscountPer','$PromoCode1','$st_email','$exhi_profile','$st_name','$st_stage','$bharat_user_type','$year_of_birth',
	 '$year_of_inception','$bs_org_reg_type', '$member_of_ivca', '$investor_flag','$gem_connect', '$are_you_investor', '$investor_association',
	 '$abstract_presenter','$abstract_email', '$accompanying_person','$filePath','$abstract_text','$abstract_title','$ieee_member','$ieee_member_number',
	 '$ieee_status','$packages','$days','$time_slot','$branch','$course','$upload_id_card','$nationality_input','$paper_id','$pagesNumber','$food','$kit')") or die(mysqli_error($link));
// die;
$qry = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE reg_id = '$reg_id'") or die(mysqli_error($link));
$res = mysqli_fetch_array($qry);


//----------------------------------------- End Generating Tin Number ----------------------------------------------------

$tin_no = $EVENT_DB_TIN_NO;
$tin_no1 = "";

$i = 0;
$j = 0;

$temp_srno_gt = $res['srno'];
do {
	$i = $j = 0;

	$tin_no1 = $tin_no . $temp_srno_gt . mt_rand(1, 99999);

	$qry = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG_DEMO . " WHERE tin_no = '$tin_no1'");
	$res_no = mysqli_num_rows($qry);

	$qry1 = mysqli_query($link, "SELECT * FROM " . $EVENT_DB_FORM_REG . " WHERE tin_no = '$tin_no1'");
	$res_no1 = mysqli_num_rows($qry1);

	if (($res_no == 0) || ($res_no1 == 0)) {
		$i++;
		$j++;
	} else {
		$i = 0;
		$j = 0;
		$tin_no1 = "";
	}
} while (($i <= 0) || ($j <= 0));

$validSectors = array(
            'High Performance Computing' => 'High Performance Computing',
                                                        'Artificial Intelligence' => 'Artificial Intelligence',
                                                        'Quantum Computing' => 'Quantum Computing',
                                                        'Government / Public Sector' => 'Government / Public Sector',
                                                        'Chip Design' => 'Chip Design',
                                                        'Research & Academia' => 'Research & Academia',
                                                        'Startups' => 'Startups',
                                                        'MSMEs' => 'MSMEs',
														'Student' => 'Student',
                                                        'Professor/Faculty' => 'Professor/Faculty',
                                                        'Others' => 'Others'
        );

$updatedSectors = array_map(function ($sector) use ($validSectors) {
	return array_key_exists($sector, $validSectors) ? $sector : 'Other - ' . $sector;
}, $selectedSectors);

$sectorString = implode(', ', $updatedSectors);

//------------------------------------------ End Geneating Tin Number ----------------------------------------------------
$reg_id_escaped = mysqli_real_escape_string($link, $reg_id);

// Sanitize all variables before use
$tin_no1 = mysqli_real_escape_string($link, $tin_no1);
$event_name = mysqli_real_escape_string($link, $event_name);
$sectorString = mysqli_real_escape_string($link, $sectorString);
$org = mysqli_real_escape_string($link, $org);
$address = mysqli_real_escape_string($link, $address);
$city = mysqli_real_escape_string($link, $city);
$state = mysqli_real_escape_string($link, $state);
$country = mysqli_real_escape_string($link, $country);
$zipcode = mysqli_real_escape_string($link, $zipcode);
$GSTreq = mysqli_real_escape_string($link, $GSTreq);
$gst_inv_addr = mysqli_real_escape_string($link, $gst_inv_addr);
$gst_inv_reg_no = mysqli_real_escape_string($link, $gst_inv_reg_no);
$gst_inv_pan = mysqli_real_escape_string($link, $gst_inv_pan);
$gst_inv_state = mysqli_real_escape_string($link, $gst_inv_state);
$gst_inv_cp = mysqli_real_escape_string($link, $gst_inv_cp);
$gst_inv_phone1 = mysqli_real_escape_string($link, $gst_inv_phone1);
$gst_inv_email = mysqli_real_escape_string($link, $gst_inv_email);
$upload_id_card = mysqli_real_escape_string($link, $upload_id_card);

// Combine everything into one update query
// Corrected update query
$updateQuery = "
    UPDATE $EVENT_DB_FORM_REG_DEMO SET
        tin_no = '$tin_no1',
        event_name = '$event_name',
        sector = '$sectorString',
        org = '$org',
        nature = '',
        addr1 = '$address',
        addr2 = '',
        city = '$city',
        state = '$state',
        country = '$country',
        pin = '$zipcode',
        fone = '',
        gst_number = '',
        is_gst_invoice_needed = '$GSTreq',
        gst_inv_addr = '$gst_inv_addr',
        gst_inv_reg_no = '$gst_inv_reg_no',
        gst_inv_pan = '$gst_inv_pan',
        gst_inv_state = '$gst_inv_state',
        gst_inv_cp = '$gst_inv_cp',
        gst_inv_phone = '$gst_inv_phone1',
        gst_inv_email = '$gst_inv_email',
        id_card = '$upload_id_card'
    WHERE reg_id = '$reg_id_escaped'
";

// Execute the combined query
if (!mysqli_query($link, $updateQuery)) {
    error_log("MySQL Error: " . mysqli_error($link));
    die("Failed to update registration details.");
}


$attendeesCount = $total_dele;
// echo $attendeesCount;
$attendees = [];
// var_dump($_POST["phone1"]); // This will print the value of each phone field
// print_r($_POST);
// Loop to fetch attendee details based on the number of attendees selected
$emails = [];
for ($i = 1; $i <= $attendeesCount; $i++) {
	$title = htmlspecialchars($_POST["title$i"]);
	$firstName = htmlspecialchars($_POST["firstname$i"]);
	$lastName = htmlspecialchars($_POST["lastname$i"]);
	$badge = $title . ' ' . $firstName . ' ' . $lastName;
	$email = htmlspecialchars($_POST["email$i"]);
	// Validate email based on delegation type
	if ($del === 'academia') {
		// Educational email validation
		// $educationalPatterns = [
		// 	'/\.edu$/i',
		// 	'/\.ac\.in$/i',
		// 	'/\.ac\.uk$/i',
		// 	'/\.edu\.in$/i',
		// 	'/\.edu\.[a-z]{2}$/i',
		// 	'/\.ac\.[a-z]{2}$/i',
		// 	'/\.edu\.au$/i',
		// 	'/\.edu\.sg$/i',
		// 	'/\.edu\.ph$/i',
		// 	'/\.edu\.mx$/i',
		// 	'/\.edu\.cn$/i',
		// 	'/\.edu\.hk$/i',
		// 	'/\.edu\.tw$/i',
		// 	'/\.edu\.jp$/i',
		// 	'/\.edu\.my$/i',
		// 	'/\.edu\.za$/i',
		// 	'/\.edu\.tr$/i',
		// 	'/\.edu\.br$/i',
		// 	'/\.edu\.ca$/i',
		// 	'/\.edu\.eg$/i',
		// 	'/\.edu\.pk$/i',
		// 	'/\.edu\.id$/i',
		// 	'/\.edu\.th$/i',
		// 	'/\.edu\.vn$/i',
		// 	'/\.edu\.kr$/i',
		// 	'/\.ac\.jp$/i',
		// 	'/\.ac\.kr$/i',
		// 	'/\.ac\.th$/i',
		// 	'/\.ac\.za$/i',
		// 	'/\.ac\.au$/i',
		// 	'/\.ac\.sg$/i',
		// 	'/\.ac\.hk$/i',
		// 	'/\.ac\.tw$/i',
		// 	'/\.ac\.my$/i',
		// 	'/\.ac\.id$/i',
		// 	'/\.ac\.eg$/i',
		// 	'/\.ac\.pk$/i',
		// 	'/\.ac\.vn$/i',
		// 	'/\.ac\.br$/i',
		// 	'/\.ac\.ca$/i'
		// ];
		
		// $isEduEmail = false;
		// foreach ($educationalPatterns as $pattern) {
		// 	if (preg_match($pattern, strtolower($email))) {
		// 		$isEduEmail = true;
		// 		break;
		// 	}
		// }
		
		// if (!$isEduEmail) {
		// 	echo "<script>
		// 		alert('Attendee " . ($i) . ": Please use educational email address (.edu, .ac.in, etc.)');
		// 		window.location = 'info.php?del=$del&cit=$cit';
		// 	</script>";
		// 	exit;
		// }
	// } elseif ($del === 'government') {
	// 	// Government email validation
	// 	$governmentPatterns = ['@gov.in', '@nic.in', '@gov.uk', '@gob.mx', '@gov.au', '@gov.sg', '@gov.ph', '@gov.', '@govt.', '@gob.'];
		
	// 	$isGovEmail = false;
	// 	$emailLower = strtolower($email);
	// 	foreach ($governmentPatterns as $pattern) {
	// 		if (strpos($emailLower, $pattern) !== false) {
	// 			$isGovEmail = true;
	// 			break;
	// 		}
	// 	}
		
	// 	if (!$isGovEmail) {
	// 		echo "<script>
	// 			alert('Attendee " . ($i) . ": Government employees must use official government email address');
	// 			window.location = 'info.php?del=$del&cit=$cit';
	// 		</script>";
	// 		exit;
	// 	}
 }

	$phone = htmlspecialchars($_POST["phone$i"]);
	// $designation = htmlspecialchars($_POST["designation$i"]);
	// $designation = htmlscriptlchars($_POST["designation$i"], ENT_QUOTES, 'UTF-8', false);

	 $cate =$pass_type ;

	//  echo $cate;
	//  exit;
	// $government_id_type = htmlscriptlchars($_POST["government_id_type$i"]);
	$government_id_number = htmlspecialchars($_POST["government_id_number$i"]);


	// Corrected line in attendees loop
$designation = htmlspecialchars($_POST["designation$i"], ENT_QUOTES, 'UTF-8', false);
$government_id_type = htmlspecialchars($_POST["government_id_type$i"]);

	// Check if the email is already in the emails array
	if (in_array($email, $emails)) {
		echo "<script>
        alert('Email should be unique for each attendee.');
        window.location = 'info.php?del=$del&cit=$cit';
    </script>";
		exit;
	}

	// Check if any of the emails exist in the database
	$query = "SELECT email1, email2, email3, email4, email5, email6, tin_no, approved_status
          FROM " . $EVENT_DB_FORM_REG . " 
          WHERE email1 = '$email' OR email2 = '$email' OR email3 = '$email' 
          OR email4 = '$email' OR email5 = '$email' OR email6 = '$email'";

	$checkEmail = mysqli_query($link, $query);
	$num = mysqli_num_rows($checkEmail);

	if ($num > 0) {
		$row = mysqli_fetch_assoc($checkEmail);
		$tin_no = $row['tin_no'];
		$status = $row['approved_status'];

		if ($status == "Rejected" || $status == "Pending") {
			echo "<script>
            alert('Email {$email} is already registered . Please contact us for more details.');
            window.location = '$EVENT_OL_PAY_ACT_LINK?id={$tin_no}';
        </script>";
		} else {
			echo "<script>
            alert('Email {$email} is already registered.');
            window.location = '$EVENT_OL_PAY_ACT_LINK?id={$tin_no}';
        </script>";
			exit;
		}
	}

	// Check if the email exists in the external API
	// $curl = curl_init();
	// curl_setopt_array($curl, array(
	// 	CURLOPT_URL => 'https://registration.startupmahakumbh.org/api/checkExistsUsers',
	// 	CURLOPT_RETURNTRANSFER => true,
	// 	CURLOPT_ENCODING => '',
	// 	CURLOPT_MAXREDIRS => 10,
	// 	CURLOPT_TIMEOUT => 0,
	// 	CURLOPT_FOLLOWLOCATION => true,
	// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 	CURLOPT_CUSTOMREQUEST => 'POST',
	// 	CURLOPT_POSTFIELDS => http_build_query(array('email' => $email)),
	// ));

	// $response = curl_exec($curl);
	// curl_close($curl);

	// $apiResponse = json_decode($response, true);

	// If API confirms email exists
	// 		if (!empty($apiResponse) && isset($apiResponse['status']) && $apiResponse['status'] === false) {
	// 			echo "<script>
	//     alert('Email {$email} is already registered.');
	//     window.location = 'https://sci25.supercomputingindia.org';
	// </script>";
	// 			exit;
	// 		}

	// If email is unique, continue with registration



	$emails[] = $email;

	// Store each attendee's details in an associative array
	$attendee = [
		'title' => $title,
		'first_name' => $firstName,
		'last_name' => $lastName,
		'badge' => $badge,
		'email' => $email,
		'phone' => $phone,
		'designation' => $designation,
		'cata' => $cate,
		'government_id_type' => $government_id_type,
		'government_id_number' => $government_id_number,
	];

	// Add this attendee's details to the attendees array
	$attendees[] = $attendee;
}

$_SESSION['attendees'] = $attendees;

// Store individual attendee details in session variables if needed
foreach ($attendees as $index => $attendee) {
	$_SESSION["attendee_title_$index"] = $attendee['title'];
	$_SESSION["attendee_first_name_$index"] = $attendee['first_name'];
	$_SESSION["attendee_last_name_$index"] = $attendee['last_name'];
	$_SESSION["attendee_email_$index"] = $attendee['email'];
	$_SESSION["attendee_phone_$index"] = $attendee['phone'];
	$_SESSION["attendee_designation_$index"] = $attendee['designation'];
	$_SESSION["attendee_government_id_type_$index"] = $attendee['government_id_type'];
	$_SESSION["attendee_government_id_number_$index"] = $attendee['government_id_number'];
}

// Insert each attendee's details into the database
// Limit attendees to a maximum of 6
$maxAttendees = min(count($attendees), 6);

// Prepare array to hold SQL field-value pairs
$updateFields = [];

for ($i = 0; $i < $maxAttendees; $i++) {
	$suffix = $i + 1;
	$attendee = $attendees[$i];

	// Create badge name
	$badge = $attendee['title'] . ' ' . $attendee['first_name'] . ' ' . $attendee['last_name'];

	// Escape and assign each field properly
	$updateFields[] = "title$suffix = '" . mysqli_real_escape_string($link, $attendee['title']) . "'";
	$updateFields[] = "fname$suffix = '" . mysqli_real_escape_string($link, $attendee['first_name']) . "'";
	$updateFields[] = "lname$suffix = '" . mysqli_real_escape_string($link, $attendee['last_name']) . "'";
	$updateFields[] = "badge$suffix = '" . mysqli_real_escape_string($link, $badge) . "'";
	$updateFields[] = "email$suffix = '" . mysqli_real_escape_string($link, $attendee['email']) . "'";
	$updateFields[] = "job_title$suffix = '" . mysqli_real_escape_string($link, $attendee['designation']) . "'";
	$updateFields[] = "cellno$suffix = '" . mysqli_real_escape_string($link, $attendee['phone']) . "'";
	$updateFields[] = "cata$suffix = '" . mysqli_real_escape_string($link, $attendee['cata']) . "'";
	$updateFields[] = "govt_id_type$suffix = '" . mysqli_real_escape_string($link, $attendee['government_id_type']) . "'";
	$updateFields[] = "govt_id_no$suffix = '" . mysqli_real_escape_string($link, $attendee['government_id_number']) . "'";
}

// Combine fields into one UPDATE query
$query = "UPDATE $EVENT_DB_FORM_REG_DEMO SET " . implode(", ", $updateFields) . " WHERE reg_id = '" . mysqli_real_escape_string($link, $reg_id) . "'";

// Execute the query
if (!mysqli_query($link, $query)) {
	error_log("MySQL Error: " . mysqli_error($link));
	echo "<script>alert('CAPTCHA verification failed. Please try again.');</script>";
	echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
	exit;
}

mysqli_close($link);

// echo "<pre>";
// print_r($_POST);
// print_r($_SESSION);
// echo "</pre>";
// die;
echo "<script language='javascript'>window.location = 'registration6.php';</script>";
// 	} else {
// 		// CAPTCHA failed
// 		echo "<script>alert('CAPTCHA verification failed. Please try again.');</script>";
// 		echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
// 		exit;
// 	}
// } else {
// 	echo "<script>alert('Please complete the CAPTCHA.');</script>";
// 	echo "<script language='javascript'>window.location = 'info.php?del=$del&cit=$cit';</script>";
// 	exit;
// }
exit;
?>
