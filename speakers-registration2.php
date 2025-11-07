<?php 
	session_start();
	require("includes/form_constants_both.php");
	
	if (empty($_SESSION["vercode_spkr_reg"]) || ($_POST["vercode"] != $_SESSION["vercode_spkr_reg"])) {
		session_destroy();
		echo "<script language='javascript'>alert('Your session has been expired. Please try again...!');</script>";
		echo "<script language='javascript'>window.location = 'speakers-registration.php';</script>";
		exit;
	}
	
	$sector = $_POST['sector'];
	$event_name = 'Bangalore IT';
	
	if($sector == 'Bio Technology') {
		$event_name = 'Bangalore INDIA BIO';
		
		require "dbcon_open_bio.php";
		
		$EVENT_DB_FORM_SPKR_DATA = "india_bio_".$EVENT_YEAR."_speakers_directory_data_tbl";
		$EVENT_DB_FORM_SPKR_PARA = "india_bio_".$EVENT_YEAR."_speakers_directory_para_tbl";
		$EVENT_DB_FORM_SPKR_MAP = "india_bio_".$EVENT_YEAR."_speakers_directory_mapping_tbl";
	} else {
		require "dbcon_open.php";
	}
	$_SESSION['sector'] = $sector;
	
	$db_speakers_directory_data_tbl = $EVENT_DB_FORM_SPKR_DATA;
	$db_speakers_directory_para_tbl = $EVENT_DB_FORM_SPKR_PARA;
	$db_speakers_directory_mapping_tbl = $EVENT_DB_FORM_SPKR_MAP;
	
	$rs = @$_GET['rs'];//check updatestatus
	$orderNo = 1;
	
	do
	{
		$cnt = 0;
		$temp_speaker_id = "SPKR-".date("Ymdhis").mt_rand(0,999999);
		$qr_check_temp_speaker_id = mysqli_query($link,"SELECT speaker_id FROM $db_speakers_directory_data_tbl WHERE speaker_id = '$temp_speaker_id'")or die(mysqli_error($link));
		$qr_check_temp_speaker_id_num = mysqli_num_rows($qr_check_temp_speaker_id);
		if($qr_check_temp_speaker_id_num > 0)
		{
			$cnt=1;
			continue;
		}
	}while($cnt == 1);
	
	$add_date = date("Y-m-d");
	$add_time = date("H:i:s A");
	
	$no_para = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['no_para']));
	$num_rows_para = $no_para;
	
	$no_bullet = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['no_bullet']));
	$num_rows_bullet = $no_bullet;
	
	//echo "<br />b:".$num_rows_bullet;
	//echo "<br />p:".$num_rows_para;
	
	$speaker_SelectedEvents = mysqli_real_escape_string($link,htmlspecialchars($event_name));
	$speaker_SelectedEvents = trim($speaker_SelectedEvents);
	$speaker_SelectedEvents = addslashes($speaker_SelectedEvents);

	
	$speaker_SelectedYear = mysqli_real_escape_string($link,htmlspecialchars($EVENT_YEAR));
	$speaker_SelectedYear = trim($speaker_SelectedYear);
	$speaker_SelectedYear = addslashes($speaker_SelectedYear);
	
	/*$speaker_session_title = @$_POST['speaker_session_title'];
	$speaker_session_title = trim($speaker_session_title);			
	$speaker_session_title = htmlentities($speaker_session_title);*/
	//$speaker_session_title = htmlentities($speaker_session_title);
	
	$speaker_session_desc = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_session_desc']));
	$speaker_session_desc = trim($speaker_session_desc);			
	$speaker_session_desc = addslashes($speaker_session_desc);
	
	$session_start_day =mysqli_real_escape_string($link,htmlspecialchars( @$_POST['session_start_day']));
	$session_start_day = trim($session_start_day);
	$session_start_day = addslashes($session_start_day);
	
	$session_start_month = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['session_start_month']));
	$session_start_month = trim($session_start_month);
	$session_start_month = addslashes($session_start_month);
	
	$session_start_year = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['session_start_year']));
	$session_start_year = trim($session_start_year);
	$session_start_year = addslashes($session_start_year);
	
	$session_start_hr =mysqli_real_escape_string($link,htmlspecialchars( @$_POST['session_start_hr']));
	$session_start_hr = trim($session_start_hr);
	$session_start_hr = addslashes($session_start_hr);
	
	$session_start_min = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['session_start_min']));
	$session_start_min = trim($session_start_min);
	$session_start_min = addslashes($session_start_min);
	
	$session_start_time_slot = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['session_start_time_slot']));
	$session_start_time_slot = trim($session_start_time_slot);
	$session_start_time_slot = addslashes($session_start_time_slot);
	
	$session_end_hr = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['session_end_hr']));
	$session_end_hr = trim($session_end_hr);
	$session_end_hr = addslashes($session_end_hr);
	
	$session_end_min = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['session_end_min']));
	$session_end_min = trim($session_end_min);
	$session_end_min = addslashes($session_end_min);
	
	$session_end_time_slot =mysqli_real_escape_string($link,htmlspecialchars( @$_POST['session_end_time_slot']));
	$session_end_time_slot = trim($session_end_time_slot);
	$session_end_time_slot = addslashes($session_end_time_slot);
	
	$speaker_title = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_title']));
	$speaker_title = trim($speaker_title);
	$speaker_title = addslashes($speaker_title);
	
	$speaker_fname = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_fname']));
	$speaker_fname = trim($speaker_fname);
	$speaker_fname = addslashes($speaker_fname);
	
	$speaker_mname = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_mname']));
	$speaker_mname = trim($speaker_mname);
	$speaker_mname = addslashes($speaker_mname);
	
	$speaker_lname =mysqli_real_escape_string($link,htmlspecialchars( @$_POST['speaker_lname']));
	$speaker_lname = trim($speaker_lname);
	$speaker_lname = addslashes($speaker_lname);
	
	$speaker_org = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_org']));
	$speaker_org = trim($speaker_org);
	$speaker_org = addslashes($speaker_org);
	
	$speaker_desig = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_desig']));
	$speaker_desig = trim($speaker_desig);
	$speaker_desig = addslashes($speaker_desig);
	
	$speaker_mobile_num =mysqli_real_escape_string($link,htmlspecialchars( @$_POST['speaker_mob']));
	$speaker_mob_country_code = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['speaker_mob_cntry_code']));

	$speaker_profile_tag_line =mysqli_real_escape_string($link,htmlspecialchars( @$_POST['para_desc_1']));
	$speaker_profile_tag_line = trim($speaker_profile_tag_line);
	$speaker_profile_tag_line = addslashes($speaker_profile_tag_line);
	
	$speaker_photo = @$_FILES['speaker_photo']['name'];
	$temp_hm_pg_disp_flag = 'Hide';//@$_POST['hm_pg_disp_flag'];
	$add_date =date("Y-m-d");
	$add_time =date("H:i:s A");
	
	if( ($speaker_title == "") || ($speaker_fname == "") || ($speaker_lname == "")){				
		echo "<script language='javascript'> alert('Please Enter Required Details');</script>";					
		echo "<script language='javascript'> window.location =('speakers-registration.php');</script>";
		exit();
	}
	
	if(basename($_FILES['speaker_photo']['name'] !="")){
		$temp_target_spker_photo_path = "upload1/";
		$temp_filename = "spkr_".mt_rand(1,99999).date("ymdHis").basename($_FILES['speaker_photo']['name']);
		$temp_target_spker_photo_path =$temp_target_spker_photo_path.$temp_filename;
		$temp_target_spker_photo_path =  str_replace(" ", "_",$temp_target_spker_photo_path);
			
		if(move_uploaded_file($_FILES['speaker_photo']['tmp_name'],$temp_target_spker_photo_path)){
			$temp_target_spker_photo_path = $EVENT_FORM_LINK.$temp_target_spker_photo_path;
		}	
		else{
			echo "<script language='javascript'> alert('There was an error uploading the file, ".basename($_FILES['speaker_photo']['name'])." please try again')";
			echo "<script language='javascript'> window.location =('speakers-registration.php');</script>";
			exit();
		}
	} else {
		//echo "<br />pass10-4<br />";
		$temp_target_spker_photo_path = $EVENT_FORM_LINK . "upload1/pnv_demo.jpg";
	}
	$reg_id = $_SESSION['vercode_spkr_reg'];
	$speaker_email_1 = mysqli_real_escape_string($link,htmlspecialchars($_POST['speaker_email_1']));
	mysqli_query($link,"INSERT INTO $db_speakers_directory_data_tbl(event_name,event_year,speaker_id,speaker_session_desc,speaker_session_dd,speaker_session_mm,speaker_session_yyyy,speaker_session_start_hr,speaker_session_start_min,speaker_session_start_sec,speaker_session_start_time,speaker_session_end_hr,speaker_session_end_min,speaker_session_end_sec,speaker_session_end_time,speaker_title,speaker_fname,speaker_mname,speaker_lname,speaker_mob_cntry_code,speaker_mob,speaker_org,speaker_desig,speaker_profile_tag_line,speaker_photo,added_date,added_time,added_by,order_no,hm_pg_disp_flag,reg_id, speaker_email_1, shrt_bgrphy_fl) 
	VALUES ('$speaker_SelectedEvents','$speaker_SelectedYear','$temp_speaker_id','$speaker_session_desc','$session_start_day','$session_start_month','$session_start_year','$session_start_hr','$session_start_min','','$session_start_time_slot','$session_end_hr','$session_end_min','','$session_end_time_slot','$speaker_title','$speaker_fname','$speaker_mname','$speaker_lname','$speaker_mob_country_code','$speaker_mobile_num','$speaker_org','$speaker_desig','$speaker_profile_tag_line','$temp_target_spker_photo_path','$add_date','$add_time','','$orderNo','$temp_hm_pg_disp_flag','$reg_id', '$speaker_email_1', '$sector')")or die(mysqli_error($link));
	
	/*if(basename($_FILES['speaker_logo']['name'] !="")){
	
		$temp_target_spker_photo_path_logo = "upload1/";
		$temp_filename = "spkr_logo_".mt_rand(1,99999).date("ymdHis").basename($_FILES['speaker_logo']['name']);
		$temp_target_spker_photo_path_logo =$temp_target_spker_photo_path_logo.$temp_filename;
		$temp_target_spker_photo_path_logo = str_replace(" ", "_",$temp_target_spker_photo_path_logo);
			
		if(move_uploaded_file($_FILES['speaker_logo']['tmp_name'],$temp_target_spker_photo_path_logo)){
				
			$temp_target_spker_photo_path_logo = $EVENT_FORM_LINK.$temp_target_spker_photo_path_logo;
			
			$id = mysqli_insert_id($link);
			
			$sql = "UPDATE $db_speakers_directory_data_tbl SET speaker_logo='$temp_target_spker_photo_path_logo' WHERE reg_id='$reg_id'";
			mysqli_query($link,$sql);
		} else{
			echo "<script language='javascript'> alert('There was an error uploading the file, ".basename($_FILES['speaker_logo']['name'])." please try again')";
			echo "<script language='javascript'> window.location =('speakers-registration.php');</script>";
			exit();
		}
	}*/
	$i =1;
	$i1 = 0; 
	do
	{	
		$temp_para_id = "PARA_".date("Ymdhis").mt_rand(1,99999);							
		$chq_qr_para = mysqli_query($link,"SELECT * FROM $db_speakers_directory_para_tbl WHERE element_id = '$temp_para_id'")or die(mysqli_error($link));
		$chq_no = mysqli_num_rows($chq_qr_para); 
		if($chq_no < 1)
		{						
			$i1++;
		}
		else
		{
			$i1=0;
			continue;
		}
	}while($i1 == 0);

	$para_title_add = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['para_title_'.$i]));
	$para_subtitle_add =mysqli_real_escape_string($link,htmlspecialchars( @$_POST['para_subtitle_'.$i]));
	$para_desc_add =mysqli_real_escape_string($link,htmlspecialchars( @$_POST['para_desc_'.$i]));
	$para_desc_add = addslashes($para_desc_add);
	$para_order_no = mysqli_real_escape_string($link,htmlspecialchars(@$_POST['order_no_para_'.$i]));
	$para_element_id = mysqli_real_escape_string($link,htmlspecialchars($temp_para_id));
	
	mysqli_query($link,"INSERT INTO $db_speakers_directory_para_tbl(element_id,para_title,para_sub_title,para_desc) VALUES ('$para_element_id','$para_title_add','$para_subtitle_add','$para_desc_add')") or die(mysqli_error($link));
	
	mysqli_query($link,"INSERT INTO $db_speakers_directory_mapping_tbl(order_no,speaker_id,element_id,element_type) VALUES ('$para_order_no','$temp_speaker_id','$para_element_id','PARA')") or die(mysqli_error($link));
 	
	
	$sql = "SELECT * FROM $EVENT_DB_FORM_SPKR_DATA sd, $EVENT_DB_FORM_SPKR_MAP sm, $EVENT_DB_FORM_SPKR_PARA sp
	WHERE sd.reg_id='" . $_SESSION["vercode_spkr_reg"] . "' AND sd.speaker_id=sm.speaker_id AND sm.element_id=sp.element_id";
	$qr_gt_user_data_id = mysqli_query($link,$sql);
	$res = mysqli_fetch_array($qr_gt_user_data_id);
	
	//call speaker Api
	// $data=array();
	// $data['api_key'] = 'scan626246ff10216s477754768osk';
	// $data['event_id'] = 117859;
	// $data['name']=$res['speaker_title'].' '.$res['speaker_fname'].' '.$res['speaker_mname'].' '.$res['speaker_lname'];
	// $data['email']=$res['speaker_email_1'];
	// $data['country_code']=$res['speaker_mob_cntry_code'];
	// $data['mobile']=$res['speaker_mob'];
	// $data['category_id']= 1869;
	// $data['company'] = $res['speaker_org'];
	// $data['designation'] = $res['speaker_desig'];
	// $data['qsn_366'] = "Speaker";
	// sendchkdinapi($data);;//exit;
	
	//callUniversalAPI($data,$ticket_id,$ticket_type);

	require 'class.phpmailer.php';
	require 'emailer_speaker.php';
	//echo $mail_body;exit;
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "72.9.105.77"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "72.9.105.77";      // sets  as the SMTP server
	$mail->Port       = 587;                   // set the SMTP port for the server
	$mail->Username   = "dcpl@dcbulkmailer.dimakhconsultants.com";  // username
	$mail->Password   = "dcpl5555";   

	$mail->SMTPAuth   = true;					// enable SMTP authentication
	$mail->SMTPSecure = "tls";                // sets the prefix to the servier
	$mail->Host       = "mail.bengalurutechsummit.com";      // sets  as the SMTP server
	$mail->Port       = 25;                   // set the SMTP port for the server
	$mail->Username   = "enquiry-bengalurutechsummit";  // username
	$mail->Password   = "Enq@ui2ry@be";		         // password
	$mail->SetFrom($EVENT_ENQUIRY_EMAIL, $EVENT_NAME . ' ' . $EVENT_YEAR);
	
	$Subject = "Thank you for Speaker registration on ". $EVENT_NAME . ' ' . $EVENT_YEAR ;
	if($sector == 'Bio Technology') {
		$Subject = "Thank you for Speaker registration on " . $EVENT_NAME . ' ' . $EVENT_YEAR;
	}
	$mail->Subject    = $Subject;
	$mail->MsgHTML($mail_body);
	$recipients = array('','test.interlinks@gmail.com', '', 'sandhya.nanjappa@mmactiv.com', '', '', '', $res['speaker_email_1']);
	//$recipients = array('','test.interlinks@gmail.com');
	foreach($recipients as $emailid) {
		$mail->AddAddress($emailid);
		if(!$mail->Send()) {
		}
		$mail->clearAddresses();
	}
	
	echo "<script language='javascript'>window.location = ('speakers-registration3.php');</script>";
	exit;
?>