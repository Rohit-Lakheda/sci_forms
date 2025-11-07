<?php
date_default_timezone_set('Asia/Kolkata');
/*****
	START EVENT Form Constants
 *****/
include 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$ORGANISATION_NAME = "Supercomputing India <br> C/O MM Activ Sci-Tech Communications PVT LTD";
$EVENT_NAME = "Supercomputing India";
$EVENT_NAME1 = 'Supercomputing India';
$EVENT_YEAR = "2025";
$EVENT_DATE = "09 - 13 DEC, " . $EVENT_YEAR;
$EVENT_WEBSITE_LINK = "https://sci25.supercomputingindia.org/";
$EVENT_WEBSITE_LINK_NAME = 'https://sci25.supercomputingindia.org';
$EVENT_BROCHURE_LINK = "https://sci25.supercomputingindia.org/assets/brochure/SCI2025_Brochure.pdf";


$EVENT_FORM_LINK = $EVENT_WEBSITE_LINK . "sci_forms/";
$EVENT_LOGO_LINK1 = $EVENT_LOGO_LINK = $EVENT_LOGO_URL = $EVENT_FORM_LINK . "images/SCI2025_logo_white.png";
$EVENT_LOGO_EMAILER = $EVENT_FORM_LINK . "images/SCI2025_logo_white.png";

$EVENT_SECRETERIATE_PERSON_EMAIL_ID = $EVENT_ENQUIRY_EMAIL_2 = $EVENT_ENQUIRY_EMAIL = "";

$EVENT_TBL_PREFIX = "sci";
$EVENT_TABLE_PRFIX = "sci";
$EVENT_CMS_TBL_NAME_PAGE_DTLS = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_cms_page_details";
$EVENT_CMS_TBL_NAME_ELE_ODR_DTLS = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_cms_element_order_details";
$EVENT_CMS_TBL_NAME_PARA_DTLS = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_cms_para_details";
$EVENT_VSTR_CNT_TBL_NAME = $EVENT_TBL_PREFIX . "_visitor_count";

$FACEBOOK_PAGE = 'https://www.facebook.com/SuperComputingIndia';
$TWITTER_PAGE = 'https://x.com/SCIndia2025';
$SERVICE_TAX = 18;
$EVENT_SECRT_ADDR = "No.11/6, NITON, Block \"C\",<br /> Second Floor, Palace Road,<br /> Bengaluru - 560001, Karnataka, India<br />Tel:  +91 08069328400<br/>
Email: <a href='mailto:sci@cdac.in' target='_blank'>sci@cdac.in</a><br/>
Website: <a href='https://sci25.supercomputingindia.org' target='_blank'>https://sci25.supercomputingindia.org</a>";

$EVENT_SECRT_ADDR_2 = $EVENT_SECRT_ADDR;

$EVENT_ADDR = "Bengaluru, India";
$EVENT_PAY_LINK = "https://sci25.supercomputingindia.org/pay/enter_reg_tin_no.php";
$EVENT_PAY_LINK_DR = "https://sci25.supercomputingindia.org/pay/enter_reg_tin_no_dr.php";
$EVENT_OL_PAY_ACT_LINK = "https://sci25.supercomputingindia.org/pay/reg_pay_1.php";
$EVENT_OL_PAY_ACT_LINK_DR = "https://sci25.supercomputingindia.org/pay/reg_pay_dr_1.php";
$EVENT_PAY_LINK_EX = "https://sci25.supercomputingindia.org/pay/enter_reg_tin_no_ex.php";
$EVENT_OL_PAY_ACT_LINK_EX = "https://sci25.supercomputingindia.org/pay/reg_pay_ex_1.php";
$EVENT_OL_PAY_ACT_LINK_POSTER = "https://sci25.supercomputingindia.org/pay/poster_pay.php";
$EVENT_VENUE = "Manipal Institute of Technology (MIT), Govindapura, Yelahanka, Bengaluru, India.";
$EVENT_CHEQUE_PAYBLE_AT_NAME = "MM ACTIV SCI TECH COMMUNICATIONS PVT. LTD.";
$EVENT_CHEQUE_PAYBLE_AT = "Bengaluru, India";
$EVENT_CHEQUE_PAYBLE_ADDRESS = "No.11/3, NITON,<br /> Block C, 2nd Floor,<br /> Palace Road, Bengaluru - 560 001, India<br />Tel:  +91.80.4113 1912/3<br/>Website: <a href='" . $EVENT_WEBSITE_LINK . "' target='_blank'>" . $EVENT_WEBSITE_LINK_NAME . "</a>";
$MMACTIV_ADDR = $EVENT_SECRT_ADDR; //"Ashirwad Bungalow, First floor, <br />36/A/2, S.No. 270, Pallod Farms, <br />Near Bank of Baroda.Baner Road,<br />Pune- 411045, India";
$MMACTIV_TEL_NO = "+91-20-27291769/79";
$MMACTIV_SERVICE_TAX_NO = $KARANATAKA_GST_NO = "29AABCM2615H1ZM";
$MMACTIV_LOGO = "https://sci25.supercomputingindia.org/images/SCI2025_logo_white.png";
$PAYMENT_REDIRECT_LINK = "https://sci25.supercomputingindia.org/pay/redirecturl.php";
$EVENT_INTERLINX_LINK = "https://sci25.supercomputingindia.org/interlinx-2025";
$EVENT_INTERLINX_LOGO = "https://sci25.supercomputingindia.org/interlinx-2025/assets/img/interlinx-logo.png";

$EVENT_DATA_SITE_KEY = '6LdlfCgTAAAAAAj-p_IZ9EcxE1k8TJiWdArSp31W';
$EVENT_DATA_SITE_KEY = '6LfQSykUAAAAADJMLEtELMPdfCpXTZevjAW0w6WS';

// $DOLLAR_RATE = 84;
function getDollarRate()
{
	// $api_url = "https://v6.exchangerate-api.com/v6/303f4de10b784cbb27e4a065/latest/USD"; // Example API
	$api_url = "https://v6.exchangerate-api.com/v6/2cee7d43ad3628f2cb8dec29/latest/USD"; // Example API
	$response = @file_get_contents($api_url);

	if ($response) {
		$data = json_decode($response, true);

		// Check if 'conversion_rates' and 'INR' exist in the response
		if (isset($data['conversion_rates']['INR'])) {
			return $data['conversion_rates']['INR']; // Get INR rate from the response
		}
	}

	return 87.5; // Default value if API fails
}

$DOLLAR_RATE = getDollarRate();

$CC_IND_PROCESSING_CHARGE_PER = 3;
$CC_INT_PROCESSING_CHARGE_PER = 7;
$PAYPAL_PROCESSING_CHARGE_PER = 9.5;

$PROMO_CODE = '2CgQSmP1';

/*****
	END EVENT Form Constants
 *****/

//Set useful variables for PayPal payment gateway
//$PAYPAL_URL = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$PAYPAL_URL = 'https://www.paypal.com/cgi-bin/webscr'; //Production PayPal API URL
$PAYPAL_ID = 'epayments1-facilitator@mmactiv.in'; //Business Email
$CANCEL_URL = $EVENT_WEBSITE_LINK . 'pay/paypal/paypal.php';
$NOTIFY_URL = $EVENT_WEBSITE_LINK . 'pay/paypal/payment.php';
$RETURN_URL = $EVENT_WEBSITE_LINK . 'pay/paypal/success.php';

$CANCEL_URL_POSTER = $EVENT_WEBSITE_LINK . 'pay/paypal/paypal_poster.php';
$NOTIFY_URL_POSTER = $EVENT_WEBSITE_LINK . 'pay/paypal/payment_poster.php';
$RETURN_URL_POSTER = $EVENT_WEBSITE_LINK . 'pay/paypal/success_poster.php';

$CANCEL_URL_EXHIBITOR = $EVENT_WEBSITE_LINK . 'pay/paypal/paypal_exhibitor.php';
$NOTIFY_URL_EXHIBITOR = $EVENT_WEBSITE_LINK . 'pay/paypal/payment_exhibitor.php';
$RETURN_URL_EXHIBITOR = $EVENT_WEBSITE_LINK . 'pay/paypal/success_exhibitor.php';

$CURRENCY_CODE = 'USD';
$EVENT_PAY_LINK_PAYPAL = $EVENT_WEBSITE_LINK . "pay/paypal/enter_reg_tin_no.php";

//Cashfree payment gateway
//Test mode
//$CF_API_KEY = '2361344a2d5c235df1469c685b431632';
//$CF_SECRETE = 'TEST834a5b6c69aad9a91bf02b70479e71d1b3fd7ba0';
//Prod mode
$CF_API_KEY = '2865935b1f775d222d58d06259395682';
$CF_SECRETE = '5a4a40743ce9e8d9262f1f0ad7ceae2c1044345b';
$CF_EVENT_PAY_LINK = $EVENT_WEBSITE_LINK . 'web/cashfree/enter_reg_tin_no.php';
$CF_PAYMENT_REDIRECT_LINK = $EVENT_WEBSITE_LINK . 'web/cashfree/redirecturl.php';
$CF_EVENT_OL_PAY_ACT_LINK = $EVENT_WEBSITE_LINK . 'web/cashfree/reg_pay_1.php';
$CF_EVENT_PAY_LINK = $EVENT_WEBSITE_LINK . 'web/cashfree/enter_reg_tin_no.php';
$CF_PAYMENT_REDIRECT_LINK_EX = $EVENT_WEBSITE_LINK . 'web/cashfree/redirecturl_ex.php';
$CF_EVENT_OL_PAY_ACT_LINK_EX = $EVENT_WEBSITE_LINK . 'web/cashfree/reg_pay_ex_1.php';
$CF_PAYMENT_REDIRECT_LINK_poster = $EVENT_WEBSITE_LINK . 'web/cashfree/redirecturl_poster.php';
$CF_EVENT_OL_PAY_ACT_LINK_poster = $EVENT_WEBSITE_LINK . 'web/cashfree/poster_pay.php';

$CF_MODE = 'PROD';
//$CF_MODE = 'TEST';
$CF_PAYMENT_LINK_SUCCESS = $EVENT_FORM_LINK . "registration9.php";
/*****
	Start Registration Form Constants
 *****/
$EVENT_DB_FORM_REG_WALK_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_walk_reg_tbl_demo";
$EVENT_DB_FORM_REG_WALK = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_walk_reg_tbl";
$EVENT_DB_FORM_REG_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_tbl_demo";
$EVENT_DB_FORM_REG = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_tbl";
$EVENT_DB_FORM_REG_TBL_LOGIN = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_tbl_login";
$EVENT_DB_FORM_REG_TBL_LOGIN_OPS_LOG = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_tbl_login_operation_log";
$EVENT_DB_FORM_INTERLINX_REG_TBL = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_interlinx_reg_table";
$EVENT_DB_FORM_INTERLINX_REG_TBL_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_interlinx_reg_table_demo";
$EVENT_DB_FORM_ALL_USERS_SCHEDULE = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_all_users_schedule";
$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_details_tbl";
$EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_user_details_tbl";
$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_details_tbl_demo";
$EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_user_details_tbl_demo";
$EVENT_DB_FORM_EXHIBITOR_TBL_GEN = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_tbl_general";
$EVENT_DB_FORM_TRANS_LOG = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_transaction_log";
$EVENT_DB_FORM_REG_EXPRESSION_OF_INTEREST = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_expression_of_interest";
$EVENT_DB_FORM_REG_DELEGATE = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_delegate";
$EVENT_DB_FORM_KTFA = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_tech_fast_award_nomination";
$EVENT_DB_FORM_SPEAKER_PROFILE = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_speakers_directory_data_tbl";
$EVENT_DB_FORM_AWARD_EVENING = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_award_evening";
$EVENT_DB_FORM_SHE_DRIVES_TECH = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_she_drives_technology";
$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_payment_tbl";
$EVENT_DB_FORM_EXHIBITOR_DIR_PAYMENT_TBL_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_payment_tbl_demo";

$EVENT_DB_FORM_SPKR_DATA = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_speakers_directory_data_tbl";
$EVENT_DB_FORM_SPKR_PARA = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_speakers_directory_para_tbl";
$EVENT_DB_FORM_SPKR_MAP = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_speakers_directory_mapping_tbl";
$EVENT_DB_FORM_DRONE_RACING_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_drone_racing_demo";
$EVENT_DB_FORM_DRONE_RACING = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_drone_racing";
$EVENT_DB_FORM_PROMO_CODE_TBL = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_promo_code_tbl";
$EVENT_DB_FORM_VISA_CLEARANCE = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_visa_clearance";

$EVENT_DB_FORM_FREE_CONTEST = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_free_contest";

$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_1 = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_details_tbl_phase_1";
$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_1 = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_details_tbl_demo_phase_1";

$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_PHASE_2 = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_details_tbl_phase_2";
$EVENT_DB_FORM_EXHIBITOR_DIR_DETAILS_DEMO_PHASE_2 = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_details_tbl_demo_phase_2";
$EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_PHASE_2 = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_user_details_tbl_phase_2";
$EVENT_DB_FORM_EXHIBITOR_DIR_USR_DETAILS_DEMO_PHASE_2 = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_exhibitors_dir_user_details_tbl_demo_phase_2";

$EVENT_DB_FORM_SKILL_SPKR_DATA = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_skill_speakers_directory_data_tbl";
$EVENT_DB_FORM_SKILL_SPKR_PARA = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_skill_speakers_directory_para_tbl";
$EVENT_DB_FORM_SKILL_SPKR_MAP = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_skill_speakers_directory_mapping_tbl";
$EVENT_DB_FORM_BEYOND_BENG_REG = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_beyond_beng_reg";
$EVENT_DB_FORM_PROMO_CODE_STALL_MANNING_TBL = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_promo_code_stall_manning_tbl";
$EVENT_DB_FORM_EXHIBITOR_ON_SPOT = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_on_spot_exhibiors";
$EVENT_DB_FORM_STALL_MANNING_TBL_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_stall_manning_tbl_demo";
$EVENT_DB_FORM_STALL_MANNING_TBL = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_stall_manning_tbl";

$EVENT_DB_FORM_MENTOR_INTERLINX_REG_TBL = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_interlinx_reg_table_mentor";
$EVENT_DB_FORM_ALL_USERS_SCHEDULE_MENTOR = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_all_users_schedule_mentor";
$EVENT_DB_FORM_global_meeting_table_MENTOR = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_global_meeting_table_mentor";


$EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_NAME = "";
$EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_EMAIL = "test.interlinks@gmail.com";
$EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_MOBILE_NO = "09611842827 ";
$EVENT_DB_FORM_EXHIBITOR_DIR_CONTACT_PERSON_PHONE_NO = "+91.80.41131912";

$EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_NAME = "";
$EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_EMAIL = "test.interlinks@gmail.com";
$EVENT_DB_FORM_EXHIBITOR_DIR_COMP_CONTACT_PERSON_MOBILE_NO = "";



$EVENT_DB_FORM_TECHNICAL_PERSON_NAME = "Mr. Vivek Patil";
$EVENT_DB_FORM_TECHNICAL_PERSON_EMAIL = "vivek.patil@mmactiv.com";
/*$EVENT_DB_FORM_TECHNICAL_PERSON_MOBILE_NO="";
	$EVENT_DB_FORM_TECHNICAL_PERSON_PHONE_NO="";*/



$DAY1 = 'DAY 1 - Tuesday, 09TH DECEMBER, 2025';
$DAY2 = 'DAY 2 - Wednesday, 10TH DECEMBER, 2025';
$DAY3 = 'DAY 3 - Thursday, 11TH DECEMBER, 2025';


/***
		TIN NO Start
 ***/

$EVENT_DB_TIN_NO = "TIN-SCI" . $EVENT_YEAR . "-";
$EVENT_DB_PRN_NO = "PRN-SCI" . $EVENT_YEAR . "-";
$EVENT_DB_EXI_ID = 'SCI' . $EVENT_YEAR . "_EXB_";
/***
		TIN NO End
 ***/

/**
		Start Complementary Date
 **/
$EVENT_DB_EXHI_DIR_REG_LINK = $EVENT_FORM_LINK . "exhibitors_form.php";
$EVENT_DB_COMP_DATE = "2015/07/30";
$EVENT_DB_COMP_LINK = $EVENT_FORM_LINK . "registration_comp.php";
/**
		End Complementary Date
 **/

$DEL_EARLY_BIRD_OFFER_DATE = '2023-06-05';

/*****
	End Registration Form Constants
 *****/


/*****
	Start Enquiry Form Constants
 *****/

// $ENQUIRY_WNT_INFO_ARR = array('Attending as Delegate','Startup / POD', 'Speaking Opportunity', 'Exhibition', 'Sponsoring', 'B2B Meetings', 'Visitor', 'Poster', 'Other');
$ENQUIRY_WNT_INFO_ARR = array(
								'Attending as Delegate',
								// 'Startup/POD',
								'Workshops & Tutorials',
								'Birds of a Feather',
								'Panel Discussions',
								'Doctoral Symposium',
								'HPC Across the Globe',
								'Women in Technology',
								'Quantum on the Horizon',
								'NSM Summit',
								'Startup',
								'MSME',
								'Other'
								);

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[0]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[0]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[0]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[1]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[1]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[1]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[2]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[2]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[2]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[3]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[3]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[3]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[4]][0] = "vivek@interlinks.in";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[4]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[4]][2] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[4]][3] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[5]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[5]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[5]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[6]][0] = "test.interlinks@gmail.com";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[6]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[6]][2] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[6]][3] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[7]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[7]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[7]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[8]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[8]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[8]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[9]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[9]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[9]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[10]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[10]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[10]][2] = "";

$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[11]][0] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[11]][1] = "";
$ENQUIRY_EMAIL_WNT_INFO_WISE[$ENQUIRY_WNT_INFO_ARR[11]][2] = "";


$ENQUIRY_TBL_NAME = $EVENT_TBL_PREFIX . "_enq_table";
$ENQUIRY_FROM_NAME_ADMIN_MAIL = "";
$ENQUIRY_FROM_EMAIL_ADMIN_MAIL = "";
$ENQUIRY_FROM_SUBJECT_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " Enquiry - ";
$ENQUIRY_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL,'test.interlinks@gmail.com');

$ENQUIRY_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$ENQUIRY_FROM_EMAIL_USER_MAIL = 'sci-expo@cdac.in';
$ENQUIRY_FROM_SUBJECT_USER_MAIL = "Thank you for sending enquiry on  " . $EVENT_NAME . " " . $EVENT_YEAR;
$ENQUIRY_RECIPIENTS_USER_MAIL = array('', 'test.interlinks@gmail.com');


/*****
	End Enquiry Form Constants
 *****/

/*****
	Start sponcer ship Enquiry Form Constants
 *****/

$SPON_ENQUIRY_TBL_NAME = $EVENT_TBL_PREFIX . "_enq_table";
$SPON_ENQUIRY_FROM_NAME_ADMIN_MAIL = "";
$SPON_ENQUIRY_FROM_EMAIL_ADMIN_MAIL = "";
$SPON_ENQUIRY_FROM_SUBJECT_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " - Expression of Interest received for Sponsorship  ";
$SPON_ENQUIRY_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'test.interlinks@gmail.com');

$SPON_ENQUIRY_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$SPON_ENQUIRY_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$SPON_ENQUIRY_FROM_SUBJECT_USER_MAIL = "Thank you for your interest to Sponsor " . $EVENT_WEBSITE_LINK . " " . $EVENT_YEAR;
$SPON_ENQUIRY_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');


/*****
	End sponcer ship Enquiry Form Constants
 *****/


/*****
	Start join mailing list Form Constants
 *****/

$JN_MA_LST_TBL_NAME = $EVENT_TBL_PREFIX . "_" . "join_mailing_list";
$JN_MA_LST_FROM_NAME_ADMIN_MAIL = "";
$JN_MA_LST_FROM_EMAIL_ADMIN_MAIL = "";
$JN_MA_LST_FROM_SUBJECT_ADMIN_MAIL = " New Mailing List Entry For " . $EVENT_NAME . " " . $EVENT_YEAR;
$JN_MA_LST_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'test.interlinks@gmail.com');

$JN_MA_LST_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$JN_MA_LST_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$JN_MA_LST_FROM_SUBJECT_USER_MAIL = "Thanks for Submitting Your Details on " . $EVENT_NAME . " " . $EVENT_YEAR;
$JN_MA_LST_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');



/*****
	End join mailing list Constants
 *****/


/*****
	Start Refer Friend list Form Constants
 *****/

$RFR_FRND_TBL_NAME = $EVENT_TBL_PREFIX . "_refer_a_friend";
$RFR_FRND_FROM_NAME_ADMIN_MAIL = "";
$RFR_FRND_FROM_EMAIL_ADMIN_MAIL = "";
$RFR_FRND_FROM_SUBJECT_ADMIN_MAIL = "New refer a friend request on " . $EVENT_NAME . " " . $EVENT_YEAR;
$RFR_FRND_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'test.interlinks@gmail.com');

$RFR_FRND_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$RFR_FRND_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$RFR_FRND_FROM_SUBJECT_USER_MAIL = "has suggested you to visit " . $EVENT_WEBSITE_LINK;
$RFR_FRND_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');

/*****
	Sending Data to Chkdin API
 *****/

/*****
	End Refer Friend list Form Constants
 *****/

/*****
	Start RSVP Form Constants
 *****/

$RSVP_TBL_NAME = $RSVP_COMP_REG_TBL_NAME = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_rsvp";
$RSVP_FROM_NAME_ADMIN_MAIL = "";
$RSVP_FROM_EMAIL_ADMIN_MAIL = "";
$RSVP_FROM_SUBJECT_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " NEW RSVP Confirmation";
$RSVP_RECIPIENTS_ADMIN_MAIL = array('', $EVENT_ENQUIRY_EMAIL, '', $EVENT_ENQUIRY_EMAIL_2, '', '', '', '');

if (isset($rsvp_city) && $rsvp_city == 'New_Delhi') {
	//$RSVP_DAY = "Monday";
	$RSVP_NAME = 'Super Computing India 2025 Curtain Raiser @ New Delhi';
	$RSVP_HEADING = 'Super Computing India 2025 Curtain Raiser @ New Delhi';
	$RSVP_DATE = "Tuesday, 31st October 2025";
	$RSVP_DATE1 = "Tuesday, 31<sup>st</sup> October, 2025";
	$RSVP_TIME = "11.00 AM to 12.30 PM";
	$RSVP_CITY = 'New Delhi';
	$RSVP_LOCATION = "Kamal Mahal Hall, ITC Maurya Hotel, Sardar Patel Marg, Akhaura Block, Diplomatic Enclave, Chanakyapuri, New Delhi- 110021";
	$RSVP_PROG = 'Function followed by Lunch';
	$RSVP_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
	$RSVP_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
	$RSVP_FROM_SUBJECT_USER_MAIL = "Thank you for RSVP on " . $RSVP_HEADING;
	$RSVP_RECIPIENTS_USER_MAIL = array('test.interlinks@gmail.com');
	$RSVP_CONTACT_PERSON = "";
	$RSVP_RECIPIENTS_USER_MSG = "";


	$RSVP_RECIPIENTS_USER_MSG = $RSVP_RECIPIENTS_USER_MSG . "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
			<p>Dear " . @$name . ",<br />
			  <br />
			  Greetings from " . $EVENT_NAME . " " . $EVENT_YEAR . " !!<br />
			  <br />
			  Thank you for RSVP on " . $RSVP_HEADING . " <br />
			  <br />
			  Mentioned below are the details of event for your kind reference<br />
			<br />

			  <strong>Date:&nbsp;</strong>$RSVP_DATE1<br />
			  <strong>Time:&nbsp;</strong>$RSVP_TIME<br />
			  <strong>Note:&nbsp;</strong>$RSVP_PROG<br />
			  <strong>Venue:&nbsp;</strong>$RSVP_LOCATION<br /><br />

			  Looking forward to meet you.<br />

			  <br />
			 Thank You,<br />
			  <strong>Team " . $EVENT_NAME . ",</strong> Event Secretariat  
			  <br />
			 $EVENT_SECRT_ADDR
			</div>";
} else if (isset($rsvp_city) && $rsvp_city == 'Delhi') {
	//$RSVP_DAY = "Monday";
	$RSVP_NAME = 'Delhi Industry Meet';
	$RSVP_HEADING = 'RSVP for Delhi Industry Meet - BTS 2025';
	$RSVP_DATE = "24th September, 2025";
	$RSVP_DATE1 = "24<sup>th</sup> Sept, 2025";
	$RSVP_TIME = "11:30 AM to 1:00 PM";
	$RSVP_CITY = 'Delhi';
	$RSVP_LOCATION = "ITC Maurya Hotel, Delhi";
	$RSVP_PROG = 'Industry Meet';
	$RSVP_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
	$RSVP_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
	$RSVP_FROM_SUBJECT_USER_MAIL = "Thank you for RSVP on " . $RSVP_HEADING;
	$RSVP_RECIPIENTS_USER_MAIL = array('test.interlinks@gmail.com');
	$RSVP_CONTACT_PERSON = "";
	$RSVP_RECIPIENTS_USER_MSG = "
		<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>";


	$RSVP_RECIPIENTS_USER_MSG = $RSVP_RECIPIENTS_USER_MSG . "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
			<p>Dear " . @$name . ",<br />
			  <br />
			  Greetings from " . $EVENT_NAME . " " . $EVENT_YEAR . " !!<br />
			  <br />
			  Thank you for RSVP on " . $RSVP_HEADING . " <br />
			  <br />
			  Mentioned below are the details of event for your kind reference<br />
			<br />

			  <strong>Date:&nbsp;</strong>$RSVP_DATE1<br />
			  <strong>Time:&nbsp;</strong>$RSVP_TIME<br />
			  <strong>Note:&nbsp;</strong>$RSVP_PROG<br />
			  <strong>Venue:&nbsp;</strong>$RSVP_LOCATION<br /><br />

			  Looking forward to meet you.<br />

			  <br />
			 Thank You,<br />
			  <strong>Team " . $EVENT_NAME . ",</strong> Event Secretariat  
			  <br />
			 $EVENT_SECRT_ADDR
			</div>";
}





/*****
	End RSVP  Form Constants
 *****/


/*****
	Start HOF (Hall Of Fame) Form Constants
 *****/


$WOF_REG_FORM_TBL = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_wof_reg_tbl";
$WOF_REG_FORM_TBL_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_wof_reg_tbl_demo";

$WOF_REG_FORM_NAME_ADMIN_MAIL = "";
$WOF_REG_FORM_EMAIL_ADMIN_MAIL = "";
$WOF_REG_FORM_SUBJECT_ADMIN_MAIL = "New Wall of Fame Submission for  " . $EVENT_NAME . " " . $EVENT_YEAR;
$WOF_REG_FORM_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, $EVENT_ENQUIRY_EMAIL_2, 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', 'ambika.kiran@mmactiv.com');


$WOF_REG_FORM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$WOF_REG_FORM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$WOF_REG_FORM_SUBJECT_USER_MAIL = "Thank you for submitting your details for " . $EVENT_NAME . " " . $EVENT_YEAR . " Wall Of Fame";
$WOF_REG_FORM_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');

$WOF_REG_FORM_RECIPIENTS_USER_MSG = "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>";

$name = "User";

$WOF_REG_FORM_RECIPIENTS_USER_MSG = $WOF_REG_FORM_RECIPIENTS_USER_MSG . "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
<p>Dear " . @$name . ",<br />
  <br />
  Greetings from " . $EVENT_NAME . " " . $EVENT_YEAR . " !!<br />
  <br />
  We acknowledge your submission for " . $EVENT_NAME . " " . $EVENT_YEAR . " Wall Of Fame. <br />
  <br />
  This is to inform that your Wall of Fame submission under review. We will get back to you soon. <br /><br />

  <br />
 Thank You,<br />
  <br />
  <strong>Team " . $EVENT_NAME . ",</strong><br />
Event Secretariat  
  <strong><br />
 $EVENT_SECRT_ADDR
</div>";


/*****
	End HOF (Hall Of Fame)  Form Constants
 *****/




/*****
	Start RSVP Form Constants
 *****/

$EOI_RSVP_TBL_NAME = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_rsvp";
$EOI_RSVP_FROM_NAME_ADMIN_MAIL = "";
$EOI_RSVP_FROM_EMAIL_ADMIN_MAIL = "";
$EOI_RSVP_FROM_SUBJECT_ADMIN_MAIL = "New Expression of Interest to attend Curtain Raiser of " . $EVENT_NAME . " " . $EVENT_YEAR;
$EOI_RSVP_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, $EVENT_ENQUIRY_EMAIL_2, 'test.interlinks@gmail.com', 'bhavya.mmactiv@gmail.com', 'ambika.kiran@mmactiv.com');


$EOI_RSVP_DAY = "Friday";
$EOI_RSVP_DATE = "May 22, 2015";
$EOI_RSVP_TIME = "07.00 pm onwards";
$EOI_RSVP_LOCATION = "Bengaluru";

$EOI_RSVP_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$EOI_RSVP_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$EOI_RSVP_FROM_SUBJECT_USER_MAIL = "Thank you for your interest to attend Curtain Raiser of  " . $EVENT_NAME . " " . $EVENT_YEAR;
$EOI_RSVP_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');

$EOI_RSVP_RECIPIENTS_USER_MSG = "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>";


$EOI_RSVP_RECIPIENTS_USER_MSG = $EOI_RSVP_RECIPIENTS_USER_MSG . "<div style='font-family:Arial, Helvetica, sans-serif; font-size:12px;'>
<p>Dear " . @$name . ",<br />
  <br />
  Greetings from " . $EVENT_NAME . " " . $EVENT_YEAR . " !!<br />
  <br />
  We acknowledge your interest to attend Curtain Raiser Programme of " . $EVENT_NAME . " " . $EVENT_YEAR . " scheduled on " . $EOI_RSVP_DAY . ", " . $EOI_RSVP_DATE . ", " . $EOI_RSVP_TIME . " at " . $EOI_RSVP_LOCATION . ".. <br />
  <br />
  This is to inform you that this Curtain Raiser is only by invitation and your expression to attend this programme is at the discretion of Organisers. The screening committee will scrutinize the application and select few will be invited to attend this programme. <br /><br />

  We shall inform you by email/call about confirmation to attend this programme.<br />

  <br />
 Thank You,<br />
  <br />
  <strong>Team " . $EVENT_NAME . ",</strong><br />
Event Secretariat  
  <strong><br />
 $EVENT_SECRT_ADDR
</div>";


/*****
	End RSVP  Form Constants
 *****/


/*****
	Start POSTER Form Constants
 *****/
$PSTR_LAST_DATE_OF_SUB = "November 22th, 2025";
$PSTR_LAST_DATE_OF_SUB_HTML = "25<sup>th</sup> September 2025.";
$PSTR_LAST_DATE_OF_SUB1 = '2025-07-27 23:59';
$PSTR_REG_FEE = "";
$PSTR_CONCT_PERSON = "$EVENT_NAME Event Secretariat";
$PSTR_EMAIL_ID = $EVENT_ENQUIRY_EMAIL;
$PSTR_EMAIL_ID = "enquiry@bengalurutechsummit.com";
$PSTR_EMAIL_ID_2 = "prabha.j@mmactiv.com";
$PSTR_ADDR = "Ms.Prabha<br />MM Activ Sci-Tech Communications Pvt. Ltd.<br />No.11/6, 'NITON', <br /> Block C, 2nd Floor, <br />Palace Road, Bengaluru - 560 052, India<br />";
$PSTR_CONTACT_NO = "+91.80.4113.1912 / 13";
$PSTR_MOBILE_NO = $PSTR_CONTACT_NO_2 = "+91.9916785005";
$PSTR_FAX_NO = "+91.80.4113.1914";

$PSTR_FILE_PATH_TO_UPLOAD = $EVENT_FORM_LINK;

$PSTR_TBL_NAME = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_poster_submission_tbl";
$PSTR_TBL_NAME_DEMO = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_poster_submission_tbl_demo";

$PSTR_FROM_SUBJECT_ADMIN_MAIL = "New Poster Presentation Entry has been Submitted on " . $EVENT_NAME . " " . $EVENT_YEAR;

$PSTR_RECIPIENTS_ADMIN_MAIL = array('', 'test.interlinks@gmail.com', '', 'prabha.j@mmactiv.com', '', $EVENT_ENQUIRY_EMAIL);

$PSTR_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$PSTR_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$PSTR_FROM_SUBJECT_USER_MAIL = "Thanks for Submitting Poster Presentation Form on " . $EVENT_NAME . " " . $EVENT_YEAR;
$PSTR_RECIPIENTS_USER_MAIL = array('test.interlinks@gmail.com');


/*****
	End POSTER Form Constants 
 *****/

/*****
	Start VISITOR Form Constants
 *****/

$VSTR_TBL_NAME = $EVENT_TABLE_PRFIX . "_visitor_pass";
$VSTR_FROM_NAME_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$VSTR_FROM_EMAIL_ADMIN_MAIL = "";
$VSTR_FROM_SUBJECT_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " Confirmation for Business Visitor Registration";
$VSTR_FROM_BODY_ADMIN_MAIL = "";
$VSTR_RECIPIENTS_ADMIN_MAIL = array('', $EVENT_ENQUIRY_EMAIL, '', $EVENT_ENQUIRY_EMAIL_2, '', 'test.interlinks@gmail.com', '', '', '', '');

$VSTR_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$VSTR_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$VSTR_FROM_SUBJECT_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " -  Thank You for Confirmation of Business Visitor Registration";
$VSTR_FROM_BODY_USER_MAIL = "";
$VSTR_RECIPIENTS_USER_MAIL = array('', @$email, '', 'test.interlinks@gmail.com');
$VISITOR_WNT_INFO_ARR = array('Gather Information / Technology Update', 'Purchase / Recommend a Service / Technology', 'Explore prospective partners & forge Alliances ', ' 	Evaluate the show for future participation', 'Make Contacts / Visit Partners', ' 	Meet an Exhibitor', 'Other');
$EVENT_EXTENSION_SMALL = 'BTS';
$VSTR_DAY1_TIME = 'Wednesday, 19 NOVEMBER,2025 - 12:00 PM - 06:00PM';
$VSTR_DAY2_TIME = 'Thursday, 20 NOVEMBER,2025 - 10:00 AM - 06:00PM';
$VSTR_DAY3_TIME = 'Friday, 21 NOVEMBER,2025 - 10:00 AM - 04:00PM';


$VSTR_DAY1_TIME_STUD = 'Wednesday 19 NOVEMBER,2025 - 02:00 PM - 06:00PM';
$VSTR_DAY2_TIME_STUD = 'Thursday, 20 NOVEMBER,2025 - 02:00 PM - 06:00PM';
$VSTR_DAY3_TIME_STUD = 'Friday, 21 NOVEMBER,2025 - 02:00 PM - 04:00PM';



/*****
	End VISITOR Form Constants
 *****/

/*****
	Start Know Your Sponsors Enquiry Form Constants
 *****/

$KNW_UR_SPONSR_ENQUIRY_TBL_NAME = $EVENT_TBL_PREFIX . "_know_our_sponsor_dtls";
$KNW_UR_SPONSR_ENQUIRY_FROM_NAME_ADMIN_MAIL = "";
$KNW_UR_SPONSR_ENQUIRY_FROM_EMAIL_ADMIN_MAIL = "";
$KNW_UR_SPONSR_ENQUIRY_FROM_SUBJECT_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " Know Our Sponsors Enquiry - ";
$KNW_UR_SPONSR_ENQUIRY_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'test.interlinks@gmail.com', '');

$KNW_UR_SPONSR_ENQUIRY_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$KNW_UR_SPONSR_ENQUIRY_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$KNW_UR_SPONSR_ENQUIRY_FROM_SUBJECT_USER_MAIL = "Thank you for sending know our sponsor details on " . $EVENT_NAME . " " . $EVENT_YEAR;
$KNW_UR_SPONSR_ENQUIRY_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');


/*****
	End Know Your Sponsors Enquiry Form Constants
 *****/

/*****
	Start YESSS Abstract Constants
 *****/

$WOEK_SECTOR = array('Education', 'Embedded Technology', 'Healthcare', 'BFSI', 'Telecom value added services', 'e-Governance', 'Energy and Environment', 'Web Based B2B, B2C application', 'Agriculture', 'Retail', 'Automotive/Manufacturing', 'Other');
$HORIZONTALS_WORK = array('IoT', 'Mobility', 'Security', 'SAS', 'Social', 'Cloud Computing', 'Enterprise', 'Consumer Internet', 'Other');
$FUNDING = array('0-50 Lakhs', '50 Lakhs-1 Cr', '2 Cr-5 Cr', '5 Cr and Above');
$FROM_WHOM_FUNDING = array('Friends & Family', 'Govt Funding', 'Angel Investors', 'Venture Capitalists', 'Private Equity', 'Loan/Debt from Bank', 'Other');
$FUNDING_TO_RAISE = array('0-50 Lakhs', '50 Lakhs-1 Cr', '2 Cr-5 Cr', '5 Cr and Above');
$YESSS_ABSTRCT_REG_TBL_NAME = "it_2016_yesss_startups";
$YESSS_ABSTRCT_REG_FROM_SUBJECT_USER_MAIL = "Thank you for submitting abstract for the YESSS programme on " . $EVENT_NAME . " " . $EVENT_YEAR;
$YESSS_ABSTRCT_REG_FROM_SUBJECT_ADMIN_MAIL = "New abstract has been Submitted for the YESSS programme on " . $EVENT_NAME . " " . $EVENT_YEAR;
$YESSS_ABSTRCT_REG_RECIPIENTS_USER_MSG = "We thank you for submitting your abstract for the YESSS programme. Our team will get in touch with you shortly with regard to your presentation in the YESSS programme.";
$FROM_MAIL = "YESSS Secretariat";
$BUSINESS_STAGE = array('Idea stage based on market research', 'Product protutype and field testing', 'Commercial validation including business models', 'Deployment Early Customers and Team Building', 'Full Business Launch and Successful first year of business with revenues', 'Fine tuning business to achieve profitability', 'Planning for scaling and growth based on successful business profitability');
$YESSS_PROGRAMM = array('Networking with IT industry captains', 'Technology Mentoring', 'Incubating Facility', 'Business Mentoring', 'Attracting investment for your business idea/innovation', 'Others');
$YESSS_ADDR = "BengaluruITE.BIZ Secretariat,<br/>No.11/6, 'NITON', <br /> Block 'C', 2nd Floor, <br />Palace Road, Bengaluru - 560 052, India<br />Tel:  +91.80.4113 1912/3 | Email: <a href='mailto:ambika.kiran@mmactiv.com'>ambika.kiran@mmactiv.com</a><br/>Website: <a href='" . $EVENT_WEBSITE_LINK . "' target='_blank'>" . $EVENT_WEBSITE_LINK . "</a>";
/*****
	End YESSS Abstract Constants
 *****/

/*****
	Start Download Presentations
 *****/



$DWNLD_PRSTN_TBL_NAME = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_tbl_login";
$DWNLD_PRSTN_ACCESS_LOG_TBL_NAME = $EVENT_TBL_PREFIX . "_" . $EVENT_YEAR . "_reg_tbl_login_operation_log";
$DWNLD_PRSTN_TBL_NAME = $EVENT_TBL_PREFIX . "_2014_reg_tbl_login";
$DWNLD_PRSTN_ACCESS_LOG_TBL_NAME = $EVENT_TBL_PREFIX . "_2014_reg_tbl_login_operation_log";
$DWNLD_PRSTN_FROM_NAME_ADMIN_MAIL = "";
$DWNLD_PRSTN_FROM_EMAIL_ADMIN_MAIL = "";
$DWNLD_PRSTN_FROM_SUBJECT_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " Download Presentations";
$DWNLD_PRSTN_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'test.interlinks@gmail.com', '');

$DWNLD_PRSTN_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$DWNLD_PRSTN_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$DWNLD_PRSTN_FROM_SUBJECT_USER_MAIL = "Thank you thankful to you for being a part of " . $EVENT_NAME . " " . $EVENT_YEAR;
$DWNLD_PRSTN_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');

$DWNLD_PRSTN_FRGT_PASS_FROM_SUBJECT_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " Presentations Download Panel Details ";
$DWNLD_PRSTN_FRGT_PASS_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');
$DWNLD_PRSTN_LOGIN_LINK = $EVENT_FORM_LINK . "login.php";

/*****
	End Know Your Sponsors Enquiry Form Constants
 *****/


/*****
	Start Feedback Form Event Constants
 *****/


$FEEDBK_FORM_EVENT_TBL_NAME = $EVENT_TBL_PREFIX . "_feedback_table";
$FEEDBK_FORM_EVENT_FROM_NAME_ADMIN_MAIL = "";
$FEEDBK_FORM_EVENT_FROM_EMAIL_ADMIN_MAIL = "";
$FEEDBK_FORM_EVENT_FROM_SUBJECT_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " Feed Back - ";
$FEEDBK_FORM_EVENT_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'test.interlinks@gmail.com', '');

$FEEDBK_FORM_EVENT_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$FEEDBK_FORM_EVENT_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$FEEDBK_FORM_EVENT_FROM_SUBJECT_USER_MAIL = "Thank you for sending Feed Back on " . $EVENT_WEBSITE_LINK . " " . $EVENT_YEAR;
$FEEDBK_FORM_EVENT_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');

/*****
	Start Feedback Form Event Constants
 *****/

/*****
	Start Unsubcribe Form
 *****/


$UNSBCRB_FORM_EVENT_TBL_NAME = $EVENT_TBL_PREFIX . "_unsubcribe_table";
$UNSBCRB_FORM_EVENT_FROM_NAME_ADMIN_MAIL = "";
$UNSBCRB_FORM_EVENT_FROM_EMAIL_ADMIN_MAIL = "";
$UNSBCRB_FORM_EVENT_FROM_SUBJECT_ADMIN_MAIL = $EVENT_NAME . " " . $EVENT_YEAR . " Feed Back - ";
$UNSBCRB_FORM_EVENT_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'test.interlinks@gmail.com');

$UNSBCRB_FORM_EVENT_FROM_NAME_USER_MAIL = $EVENT_NAME . " " . $EVENT_YEAR;
$UNSBCRB_FORM_EVENT_FROM_EMAIL_USER_MAIL = $EVENT_ENQUIRY_EMAIL;
$UNSBCRB_FORM_EVENT_FROM_SUBJECT_USER_MAIL = "Thank you for sending Feed Back on " . $EVENT_WEBSITE_LINK . " " . $EVENT_YEAR;
$UNSBCRB_FORM_EVENT_FROM_BODY_USER_MAIL = "<p class='style3'>Dear User,<br />
                As per your request you have been removed from our mailing list.<br />
                In case you wish to start receiving our mails in future, you can join our mailing list by <a href='" . $EVENT_FORM_LINK . "join_mailing_list.php' target='_blank'>clicking here</a>.<br /><br />
                Thanking You,</p>     
				<p class='style3'  align='left' >" . $EVENT_NAME . " Secretariat <br />
                  " . $EVENT_SECRT_ADDR . "<br />
              Email:<a href='mailto:" . $ENQUIRY_FROM_EMAIL_USER_MAIL . "' target='_blank'>" . $ENQUIRY_FROM_EMAIL_USER_MAIL . "</a></p>";

$UNSBCRB_FORM_EVENT_RECIPIENTS_USER_MAIL = array(@$email, 'test.interlinks@gmail.com');

/*****
	Start Feedback Form Event Constants
 *****/

function getFooter12()
{
	$html = '<!-- BEGIN FOOTER -->
				<div class="page-footer">
					<div class="page-footer-inner">
						<div class="row">
						<span class="col-md-6 col-sm-8 col-xs-12">&copy; Copyright ' . date('Y') . '-' . (date('Y') + 1) . ' - <a href="https://mmactiv.in/" target="_blank" class="yellow">MM Activ Sci-Tech Communications Pvt. Ltd.</a> All Rights Reserved</span>
				        	<span class="col-md-6">Web Interface Conceived & Driven By :  <a href="http://interlinks.in/" target="_blank" class="yellow">SCI Knowledge Interlinks</a></span>
				        </div>
			        </div>
			        <div class="scroll-to-top">
                		<i class="icon-arrow-up"></i>
		            </div>
		        </div>
		        <!-- END FOOTER -->';

	return $html;
}


$ASSOC_NAME_EXHIBITOR = 'Startup';



function elastic_mail2($subject, $message, $to)
{
	
	$mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = true;
	$mail->Host       = 'smtp.cdac.in';
    $mail->Port       = 587;
    $mail->Username   = 'sci-expo@cdac.in';
    $mail->Password   = 'CdacblR12!@3456789';
    $mail->SetFrom('sci-expo@cdac.in', 'Super Computing India 2025');
    $mail->Subject    = $subject;
    $mail->MsgHTML($message);
    $mail->SMTPSecure = 'tls';

    $to = array_filter($to);
    if (!empty($to)) {
        // Send to ALL recipients, not just the first one
        foreach ($to as $email) {
            if (!empty($email)) {
                $mail->AddAddress($email);
            }
        }
        if(!$mail->Send()) {
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }
        $mail->clearAddresses();
    }
}

function elastic_mail($subject, $message, $to)
{
	$mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->SMTPDebug  = 2;
    $mail->SMTPAuth   = false;
	$mail->Host       = 'smtp.cdac.in';
    $mail->Port       = 587;
    $mail->Username   = '';
    $mail->Password   = '';
    $mail->SetFrom('sci@cdac.in', 'Supercomputing India 2025');
    $mail->Subject    = $subject;
    $mail->MsgHTML($message);
    $to = array_filter($to);
    if (empty($to)) {
        //echo 'Error: No recipient email addresses provided.';
        return false;
    }
    foreach ($to as $email) {
        //echo 'Adding email: ' . $email . "\n";
        $mail->AddAddress($email);
        if(!$mail->Send()) {
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }
        $mail->clearAddresses();
    }
}


function elastic_mail_spkr($subject, $message, $to)
{

	$url = 'https://api.elasticemail.com/v2/email/send';

	try {
		//$to = array('sagarpatil2112@gmail.com', 'test.interlinks@gmail.com');
		$to = implode(";", $to);
		$post = array(
			'from' => 'conference@bengalurutechsummit.com', // 'vivek.patil@mmactiv.com',
			'fromName' => "Supercomputing India 2025",
			'apikey' => '',
			'subject' => $subject,
			'to' => $to,
			'bodyHtml' => $message
		); //,//'<h1>Html Body</h1>',
		//'bodyText' => 'Text Body');

		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $post,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_SSL_VERIFYPEER => false
		));

		$result = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($result, true);
		if (isset($data['success']) && $data['success']) {
			//print_r($data);
			return true;
		} else {
			//echo $qr_gt_user_inx_login_data_ans['pri_email'] . '#<br/>';
		}
		//echo $result . '<br/>';
		return false;
	} catch (Exception $ex) {
		//echo $ex->getMessage();
	}

	//exit;
}


function elastic_mail_frm($subject, $message, $to, $frm)
{
    $recipients = array_filter($to); // Remove empty emails

    if (empty($recipients)) {
        return [
            'status' => false,
            'message' => 'No recipients provided.'
        ];
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.cdac.in';
        $mail->Port       = 587;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Username   = 'sci@cdac.in';
        $mail->Password   = 'CdacblR12!@3456789';

        // General settings
        $mail->setFrom('sci@cdac.in', 'Supercomputing India 2025');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Disable debug for speed
        $mail->SMTPDebug = 0;

        // Reuse the same connection for all recipients
        $mail->SMTPKeepAlive = true;

        foreach ($recipients as $email) {
            $mail->addAddress(trim($email));

            // **Send without waiting for confirmation**
            $thisResult = @$mail->send();

            // Skip waiting for response, just clear
            $mail->clearAddresses();
        }

        // Close SMTP connection
        $mail->smtpClose();

        return [
            'status' => true,
            'message' => 'Emails processed.'
        ];

    } catch (Exception $e) {
        return [
            'status' => false,
            'message' => 'Exception: ' . $e->getMessage()
        ];
    }
}



function callWizAPI($data, $url = '', $method = 'POST')
{
	/*if (empty($url)) {
		   $url = 'https://wizitbts.wiz365.io/api/auth/signup';
		   //$data['api_key'] = 'scan626246ff10216s477754768osk';
	   }
	   $curl = curl_init();

	   switch ($method) {
		   case "POST":
			   curl_setopt($curl, CURLOPT_POST, 1);
			   if ($data) {
				   // Attach encoded JSON string to the POST fields
				   //curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

				   // Set the content type to application/json
				   curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

				   // Return response instead of outputting
				   //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				   
				   curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
			   }
			   break;
		   case "PUT":
			   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			   if ($data)
				   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			   break;
		   default:
			   if ($data)
				   $url = sprintf("%s?%s", $url, http_build_query($data));
	   }
	   //print_r($data);
	   // OPTIONS:
	   curl_setopt($curl, CURLOPT_URL, $url);
	   //curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	   // EXECUTE:
	   $result = curl_exec($curl);

	   if (!$result) {
		   die("Connection Failure");
	   }

	   curl_close($curl);

	   return $result;*/
}


/**
 * This function save the delegate data
 */
function callWizVisitorAPI($data)
{
	/*$result = callWizAPI($data);
	   //print_r($result);exit;
	   $response = json_decode($result, true);
	   //print_r($response);exit;
	   $request = json_encode($data);
	   $date = date('Y-m-d H:i:s');
	   $msg = '';
	   if (isset($response['message'])) {
		   $msg = $response['message'];
	   }
	   $login_link = '';
	   if (isset($response['login_link'])) {
		   $login_link = $response['login_link'];
	   }
	   $category_id = '';
	   if (isset($data['category_id'])) {
		   $category_id = $data['category_id'];
	   }
	   $data['name'] = $data['firstName'] . ' ' . $data['lastName'];
	   $sql = "INSERT INTO it_2025_reg_api_log(name,email,booking_id,ticket_id,ticket_type,status,message,created_at,request, response) VALUES('$data[name]','$data[email]','$login_link','','','$response[id]','$msg','$date', '$request', '$result')";
	   mysqli_query($link,$sql);

	   return $result;*/
}
