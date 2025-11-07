<?php

	session_start(); 
	require "includes/form_constants.php";
	require "dbcon_open.php";
	if(!isset($_SESSION['USER_SRNO']) || empty($_SESSION['USER_SRNO'])) {
		echo "<script language='javascript'>alert('Your session has been expired!');</script>";
		echo "<script language='javascript'>window.location='it_yesss_abstracts_reg.php';</script>";
		exit;
	}
	//echo $_POST["q2_uni_product"];exit;
	//print_r($_POST);exit;
	if(isset($_FILES['comp_prof']['name']) && !empty($_FILES['comp_prof']['name'])) {
		
			 $maxsize    = 2097152;
			 $file_size = $_FILES['comp_prof']['size'];
   			 $file_type = $_FILES['comp_prof']['type'];
			 //$mimeType = array('pdf');
			 $file_type = pathinfo($_FILES['comp_prof']['name'],PATHINFO_EXTENSION);
			if($file_type != 'pdf'){
				echo "<script language='javascript'>alert('Please upload only pdf format files.');</script>";
				echo "<script language='javascript'>window.location='it_yesss_abstracts_reg.php';</script>";
				exit;
			}
			if($file_size > $maxsize){
				echo "<script language='javascript'>alert('File size must under 2MB!');</script>";
				echo "<script language='javascript'>window.location='it_yesss_abstracts_reg.php';</script>";
				exit;
			}

			$profileUploadPath = 'profile/';
			
			if(!file_exists($profileUploadPath)) {
				mkdir($profileUploadPath, 0777);
			}
			
			$profileUploadPath .= $_SESSION['USER_SRNO'] . '/'; 
			
			if(!file_exists($profileUploadPath)) {
				mkdir($profileUploadPath, 0777);
			}
			
			$filePath = $profileUploadPath . 'Profile.' . pathinfo($_FILES['comp_prof']['name'], PATHINFO_EXTENSION);
			//print_r($_FILES);
			move_uploaded_file($_FILES['comp_prof']['tmp_name'], $filePath);
			
			$sql = "UPDATE it_2016_yesss_startups SET comp_prof='$filePath', profileLastUpdateDate='" . date('Y-m-d') . "' WHERE srno = $_SESSION[USER_SRNO]";
			mysqli_query($link,$sql)or die(mysqli_error($link));
		}/* else {
				echo "<script language='javascript'>window.location='it_yesss_abstracts_reg.php?status=error';</script>";
				exit;
			}*/
	
	$q1_inno_idea = @$_POST["q1_inno_idea"];	
	$q2_uni_product = @$_POST["q2_uni_product"];	
	$q4_idea_stage = @$_POST["q4_idea_stage"];	
	$q5_annual_turn = @$_POST["q5_annual_turn"];	
	$q6_mark_strategy = @$_POST["q6_mark_strategy"];	
	$q7_busi_model = @$_POST["q7_busi_model"];	
	$q8_busi_plan = @$_POST["q8_busi_plan"];	
	$q1_inno_idea_new = @$_POST["q1_inno_idea_new"];
	$totalFundRound = @$_POST["totalFundRound"];
	$publicFunding = @$_POST['publicFunding'];
	$fundPersonName =  @$_POST['fundPersonName'];
	$linkedin = @$_POST['linkedin'];
	$q5_annual_turn_new =  @$_POST['q5_annual_turn_new'];
	$totalEmp = @$_POST["totalEmp"];
	$totalFounders = @$_POST["totalFounders"];
	
	if ($publicFunding == "No") {
	    $fundPersonName = '';
	} else {
	    $fundPersonName = $_POST['fundPersonName'];
	}

	$cnt="";
	$q3_busi_stage = "";
	if(@$_POST['q3_busi_stage1'] != ""){
		$q3_busi_stage = @$_POST['q3_busi_stage1'];
	}
	
	if(@$_POST['q3_busi_stage2'] != ""){
		
		if($q3_busi_stage=="")
		{
			$q3_busi_stage=@$_POST['q3_busi_stage2'];
		}
		else
		{
			$q3_busi_stage .= "#".@$_POST['q3_busi_stage2'];
		}
		
	}
	
	if(@$_POST['q3_busi_stage3'] != ""){
		
		if($q3_busi_stage=="")
		{
			$q3_busi_stage=@$_POST['q3_busi_stage3'];
		}
		else
		{
			$q3_busi_stage .= "#".@$_POST['q3_busi_stage3'];
		}
		
	}
	
	if(@$_POST['q3_busi_stage4'] != ""){
		
		if($q3_busi_stage=="")
		{
			$q3_busi_stage=@$_POST['q3_busi_stage4'];
		}
		else
		{
			$q3_busi_stage .= "#".@$_POST['q3_busi_stage4'];
		}
		
	}
	
	if(@$_POST['q3_busi_stage5'] != ""){
		
		if($q3_busi_stage=="")
		{
			$q3_busi_stage=@$_POST['q3_busi_stage5'];
		}
		else
		{
			$q3_busi_stage .= "#".@$_POST['q3_busi_stage5'];
		}	
		
	}
	
	if(@$_POST['q3_busi_stage6'] != ""){
		
		if($q3_busi_stage=="")
		{
			$q3_busi_stage=@$_POST['q3_busi_stage6'];
		}
		else
		{
			$q3_busi_stage .= "#".@$_POST['q3_busi_stage6'];
		}			
	}
	
	if(@$_POST['q3_busi_stage7'] != ""){
		
		if($q3_busi_stage=="")
		{
			$q3_busi_stage=@$_POST['q3_busi_stage7'];
		}
		else
		{
			$q3_busi_stage .= "#".@$_POST['q3_busi_stage7'];
		}	
		
	}
	
	
	if(@$_POST['q3_busi_stage8'] != ""){
		
		
		if($q3_busi_stage=="")
		{
			$q3_busi_stage=@$_POST['other_name'];
		}
		else
		{
			$q3_busi_stage .= "#".@$_POST['other_name'];
		}	
		
	}
	
	
		//echo $cnt; echo $enq1; exit;
	$enq_str=explode("#",$q3_busi_stage);
	$enq_str=implode(",",$enq_str);
	

	
	
	$que_cnt="";
	$q9_yesss_prog = "";
	if(@$_POST['q9_yesss_prog1'] != ""){
		$q9_yesss_prog = @$_POST['q9_yesss_prog1'];
	}
	
	if(@$_POST['q9_yesss_prog2'] != ""){
		
		if($q9_yesss_prog=="")
		{
			$q9_yesss_prog=@$_POST['q9_yesss_prog2'];
		}
		else
		{
			$q9_yesss_prog .= "#".@$_POST['q9_yesss_prog2'];
		}
		
	}
	
	if(@$_POST['q9_yesss_prog3'] != ""){
		
		if($q9_yesss_prog=="")
		{
			$q9_yesss_prog=@$_POST['q9_yesss_prog3'];
		}
		else
		{
			$q9_yesss_prog .= "#".@$_POST['q9_yesss_prog3'];
		}
		
	}
	
	if(@$_POST['q9_yesss_prog4'] != ""){
		
		if($q9_yesss_prog=="")
		{
			$q9_yesss_prog=@$_POST['q9_yesss_prog4'];
		}
		else
		{
			$q9_yesss_prog .= "#".@$_POST['q9_yesss_prog4'];
		}
		
	}
	
	if(@$_POST['q9_yesss_prog5'] != ""){
		
		if($q9_yesss_prog=="")
		{
			$q9_yesss_prog=@$_POST['q9_yesss_prog5'];
		}
		else
		{
			$q9_yesss_prog .= "#".@$_POST['q9_yesss_prog5'];
		}	
		
	}
	
	if(@$_POST['q9_yesss_prog6'] != ""){
		
		
		if($q9_yesss_prog=="")
		{
			$q9_yesss_prog=@$_POST['other_name'];
		}
		else
		{
			$q9_yesss_prog .= "#".@$_POST['other_name'];
		}	
		
	}
	
	
		//echo $cnt; echo $enq1; exit;
	$q9_yesss_prog_str=explode("#",$q9_yesss_prog);
	$q9_yesss_prog_str=implode(",",$q9_yesss_prog_str);



	$que_cnt="";
	$q10_yesss_prog = "";
	if(@$_POST['q10_yesss_prog1'] != ""){
		$q10_yesss_prog = @$_POST['q10_yesss_prog1'];
	}
	
	if(@$_POST['q10_yesss_prog2'] != ""){
		
		if($q10_yesss_prog=="")
		{
			$q10_yesss_prog=@$_POST['q10_yesss_prog2'];
		}
		else
		{
			$q10_yesss_prog .= "#".@$_POST['q10_yesss_prog2'];
		}
		
	}
	
	if(@$_POST['q10_yesss_prog3'] != ""){
		
		if($q10_yesss_prog=="")
		{
			$q10_yesss_prog=@$_POST['q10_yesss_prog3'];
		}
		else
		{
			$q10_yesss_prog .= "#".@$_POST['q10_yesss_prog3'];
		}
		
	}
	
	if(@$_POST['q10_yesss_prog4'] != ""){
		
		if($q10_yesss_prog=="")
		{
			$q10_yesss_prog=@$_POST['q10_yesss_prog4'];
		}
		else
		{
			$q10_yesss_prog .= "#".@$_POST['q10_yesss_prog4'];
		}
		
	}
	
	
	
	
	
		//echo $cnt; echo $enq1; exit;
	$q10_yesss_prog_str=explode("#",$q10_yesss_prog);
	$q10_yesss_prog_str=implode(",",$q10_yesss_prog_str);
	
	


	$que_cnt="";
	$q11_yesss_prog = "";
	if(@$_POST['q11_yesss_prog1'] != ""){
		$q11_yesss_prog = @$_POST['q11_yesss_prog1'];
	}
	
	if(@$_POST['q11_yesss_prog2'] != ""){
		
		if($q11_yesss_prog=="")
		{
			$q11_yesss_prog=@$_POST['q11_yesss_prog2'];
		}
		else
		{
			$q11_yesss_prog .= "#".@$_POST['q11_yesss_prog2'];
		}
		
	}
	
	if(@$_POST['q11_yesss_prog3'] != ""){
		
		if($q11_yesss_prog=="")
		{
			$q11_yesss_prog=@$_POST['q11_yesss_prog3'];
		}
		else
		{
			$q11_yesss_prog .= "#".@$_POST['q11_yesss_prog3'];
		}
		
	}
	
	if(@$_POST['q11_yesss_prog4'] != ""){
		
		if($q11_yesss_prog=="")
		{
			$q11_yesss_prog=@$_POST['q11_yesss_prog4'];
		}
		else
		{
			$q11_yesss_prog .= "#".@$_POST['q11_yesss_prog4'];
		}
		
	}
	
	if(@$_POST['q11_yesss_prog5'] != ""){
		
		if($q11_yesss_prog=="")
		{
			$q11_yesss_prog=@$_POST['q11_yesss_prog5'];
		}
		else
		{
			$q11_yesss_prog .= "#".@$_POST['q11_yesss_prog5'];
		}	
		
	}
	if(@$_POST['q11_yesss_prog6'] != ""){
		
		if($q11_yesss_prog=="")
		{
			$q11_yesss_prog=@$_POST['q11_yesss_prog6'];
		}
		else
		{
			$q11_yesss_prog .= "#".@$_POST['q11_yesss_prog6'];
		}	
		
	}
	if(@$_POST['q11_yesss_prog7'] != ""){
		
		if($q11_yesss_prog=="")
		{
			$q11_yesss_prog=@$_POST['q11_yesss_prog7'];
		}
		else
		{
			$q11_yesss_prog .= "#".@$_POST['q11_yesss_prog7'];
		}	
		
	}
	if(@$_POST['q11_yesss_prog8'] != ""){
		
		
		if($q11_yesss_prog=="")
		{
			$q11_yesss_prog=@$_POST['other_name_funding'];
		}
		else
		{
			$q11_yesss_prog .= "#".@$_POST['other_name_funding'];
		}	
		
	}
	
	
		//echo $cnt; echo $enq1; exit;
	$q11_yesss_prog_str=explode("#",$q11_yesss_prog);
	$q11_yesss_prog_str=implode(",",$q11_yesss_prog_str);



	$que_cnt="";
	$q12_yesss_prog = "";
	if(@$_POST['q12_yesss_prog1'] != ""){
		$q12_yesss_prog = @$_POST['q12_yesss_prog1'];
	}
	
	if(@$_POST['q12_yesss_prog2'] != ""){
		
		if($q12_yesss_prog=="")
		{
			$q12_yesss_prog=@$_POST['q12_yesss_prog2'];
		}
		else
		{
			$q12_yesss_prog .= "#".@$_POST['q12_yesss_prog2'];
		}
		
	}
	
	if(@$_POST['q12_yesss_prog3'] != ""){
		
		if($q12_yesss_prog=="")
		{
			$q12_yesss_prog=@$_POST['q12_yesss_prog3'];
		}
		else
		{
			$q12_yesss_prog .= "#".@$_POST['q12_yesss_prog3'];
		}
		
	}
	
	if(@$_POST['q12_yesss_prog4'] != ""){
		
		if($q12_yesss_prog=="")
		{
			$q12_yesss_prog=@$_POST['q12_yesss_prog4'];
		}
		else
		{
			$q12_yesss_prog .= "#".@$_POST['q12_yesss_prog4'];
		}
		
	}
	
		//echo $cnt; echo $enq1; exit;
	$q12_yesss_prog_str=explode("#",$q12_yesss_prog);
	$q12_yesss_prog_str=implode(",",$q12_yesss_prog_str);
	


	
	if(($q1_inno_idea == "") ||($q2_uni_product == "") || ($q3_busi_stage == "") || ($q4_idea_stage == "") || ($q5_annual_turn == "") || ($q6_mark_strategy == "") || ($q7_busi_model == "") || ($q8_busi_plan == "") || ($q9_yesss_prog == "")){
		
		echo "<script language='javascript'>alert('Please Enter Required Information');</script>";
		echo "<script language='javascript'>window.location = 'it_yesss_abstracts_reg.php';</script>";
		exit;
	}
	
	

	
	$query = "UPDATE $YESSS_ABSTRCT_REG_TBL_NAME SET q1_inno_idea = '$q1_inno_idea', q2_uni_product = '$q2_uni_product', q3_busi_stage = '$q3_busi_stage', q4_idea_stage = '$q4_idea_stage', q5_annual_turn = '$q5_annual_turn',q6_mark_strategy = '$q6_mark_strategy', q7_busi_model = '$q7_busi_model', q8_busi_plan = '$q8_busi_plan', q9_yesss_prog = '$q9_yesss_prog', q1_inno_idea_new = '$q1_inno_idea_new', q10_yesss_prog = '$q10_yesss_prog', q11_yesss_prog = '$q11_yesss_prog', q12_yesss_prog = '$q12_yesss_prog', totalFundRound = '$totalFundRound', linkedin = '$linkedin', publicFunding = '$publicFunding', fundPersonName = '$fundPersonName', q5_annual_turn_new = '$q5_annual_turn_new', cur_wrk_emp='$totalEmp', totalFounders='$totalFounders' WHERE srno = '$_SESSION[USER_SRNO]'";
	//echo $query;exit;
	$result = mysqli_query($link,$query)or die(mysqli_error($link));	
		
	
	//user
		$query1 = "SELECT * FROM $YESSS_ABSTRCT_REG_TBL_NAME WHERE srno = '$_SESSION[USER_SRNO]'";
		$queryRes = mysqli_query($link,$query1);
		$resultArray = mysqli_fetch_array($queryRes);
		$workSector = str_replace("#",",",$resultArray['work_sector']);
	
		require "class.phpmailer.php";
		require "yesss_abstracts_emailer_user.php";
		
		$str_career = $YESSS_ABSTRCT_REG_FROM_SUBJECT_USER_MAIL;	
		$str_career_bdy = $enq_abstract_mail_msg_user;
		$temp_p_email = $EVENT_ENQUIRY_EMAIL;
		$temp_p_name = $EVENT_NAME." ".$EVENT_YEAR;
		
		
		$YESSS_ABSTRCT_REG_RECIPIENTS_USER_MAIL = array('',$resultArray['email'],'','test.interlinks@gmail.com');
	
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($YESSS_ABSTRCT_REG_RECIPIENTS_USER_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				   
				}
				$mail->clearAddresses();
			}
		
		
		
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
	
		/*foreach($YESSS_ABSTRCT_REG_RECIPIENTS_USER_MAIL as $emailid)
		{
			if(mail($emailid,$str_career,$str_career_bdy,$headers))
			{
				//echo "<br />mail successful : 1<br />";
			}
			else
			{
					//echo "<br />mail failed : 1<br />";
			}
		
		}*/
		
		
		
	//admin 
	
	$YESSS_ABSTRCT_REG_RECIPIENTS_ADMIN_MAIL = array('','test.interlinks@gmail.com','','utsav.kumar@mmactiv.in','', $EVENT_ENQUIRY_EMAIL);

	//$YESSS_ABSTRCT_REG_RECIPIENTS_ADMIN_MAIL = array('','test.interlinks@gmail.com');
	
		$temp_p_email = $resultArray['email'];
		$temp_p_name = $resultArray['fname']." ".$resultArray['lname'];
		
		require "yesss_abstracts_emailer_admin.php";
		
		$str_career = $YESSS_ABSTRCT_REG_FROM_SUBJECT_ADMIN_MAIL;
		$str_career_bdy = $enq_abstract_mail_msg_admin;
		
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = $temp_p_email;
			$mail->FromName = $temp_p_name;
			$mail->Subject = $str_career;
			$mail->IsHTML(true);
			$mail->Body = $str_career_bdy;			
			foreach($YESSS_ABSTRCT_REG_RECIPIENTS_ADMIN_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				   
				}
				$mail->clearAddresses();
			}
		
		
		 
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
		
		
		/*foreach($YESSS_ABSTRCT_REG_RECIPIENTS_ADMIN_MAIL as $emailid)
		{
			if(mail($emailid,$str_career,$str_career_bdy,$headers))
			{
				//echo "<br />mail successful : 1<br />";
			}
			else
			{
					//echo "<br />mail failed : 1<br />";
			}
		
		}*/
		
		
	/*echo $enq_abstract_mail_msg_user;	
	echo $enq_abstract_mail_msg_admin;
	exit;*/
		
	$fname = $resultArray['fname'];
	$lname = $resultArray['lname'];
	session_destroy();
	echo "<script language='javascript'>window.location = 'it_yesss_abstracts_reg5.php?nm=$fname$lname';</script>";	
	exit;
	
	
?>