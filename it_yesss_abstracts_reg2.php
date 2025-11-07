<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
 	session_start(); 
	//print_r($_POST);exit;
	
	if( !isset($_SESSION["vercode_yesss_abstracts_reg"]) || ($_SESSION["vercode_yesss_abstracts_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Please Enter Verification Code.');</script>";
		echo "<script language='javascript'>window.location = 'it_yesss_abstracts_reg.php';</script>";
		exit;
	}
	
	$reg_id = @$_SESSION["vercode_yesss_abstracts_reg"];
	$title = @$_POST["title"];	
	$fname = @$_POST["fname"];	
	$lname = @$_POST["lname"];	
	$desig = @$_POST["desig"];	
	$org = @$_POST["org"];	
	$website = @$_POST["website"];	
	$total_emp = @$_POST["total_emp"];	
	$month = @$_POST["month"];	
	$month_year_inception = @$_POST["month_year_inception"];	
	$address1 = @$_POST["address1"];	
	$address2 = @$_POST["address2"];	
	$city = @$_POST["city"];	
	$state = @$_POST["state"];	
	$country = @$_POST["country"];	
	$pin = @$_POST["pin"];	
	$fone = @$_POST["foneCountryCode"]."-".@$_POST["fone"];	
	$fax = @$_POST['faxCountryCode']."-".@$_POST['fax'];
	$email = @$_POST['email'];
	$mob_no = @$_POST['mob_no'];
	
	//$comment = addslashes(@$_POST["comment"]);
	
	require "includes/form_constants.php";
	
	
		$cnt="";
		$enq1 = "";
		if(@$_POST['enquiry1'] != ""){
			$enq1 = @$_POST['enquiry1'];
		}
		
		if(@$_POST['enquiry2'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry2'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry2'];
			}
			
		}
		
		if(@$_POST['enquiry3'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry3'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry3'];
			}
			
		}
		
		if(@$_POST['enquiry4'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry4'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry4'];
			}
			
		}
		
		if(@$_POST['enquiry5'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry5'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry5'];
			}	
			
		}
		
		if(@$_POST['enquiry6'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry6'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry6'];
			}			
		}
		
		if(@$_POST['enquiry7'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry7'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry7'];
			}	
			
		}
		
		if(@$_POST['enquiry8'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry8'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry8'];
			}	
		}
		
		if(@$_POST['enquiry9'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry9'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry9'];
			}	
		}
		if(@$_POST['enquiry10'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry10'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry10'];
			}	
		}
		if(@$_POST['enquiry11'] != ""){
			
			if($enq1=="")
			{
				$enq1=@$_POST['enquiry11'];
			}
			else
			{
				$enq1 .= "#".@$_POST['enquiry11'];
			}	
		}
		if(@$_POST['enquiry12'] != ""){
			
			
			if($enq1=="")
			{
				$enq1=@$_POST['other_name'];
			}
			else
			{
				$enq1 .= "#".@$_POST['other_name'];
			}	
			
		}
		
		
			///echo $cnt; echo $enq1; 
		$enq_str=explode("#",$enq1);
		$enq_str=implode(",",$enq_str);
		
	


		$horizontal_cnt="";
		$horizonWork1 = "";
		if(@$_POST['horizonWork1'] != ""){
			$horizonWork1 = @$_POST['horizonWork1'];
		}
		
		if(@$_POST['horizonWork2'] != ""){
			
			if($horizonWork1=="")
			{
				$horizonWork1=@$_POST['horizonWork2'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizonWork2'];
			}
			
		}
		
		if(@$_POST['horizonWork3'] != ""){
			
			if($horizonWork1=="")
			{
				$horizonWork1=@$_POST['horizonWork3'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizonWork3'];
			}
			
		}
		
		if(@$_POST['horizonWork4'] != ""){
			
			if($horizonWork1=="")
			{
				$enq1=@$_POST['horizonWork4'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizonWork4'];
			}
			
		}
		
		if(@$_POST['horizonWork5'] != ""){
			
			if($horizonWork1=="")
			{
				$horizonWork1=@$_POST['horizonWork5'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizonWork5'];
			}	
			
		}
		
		if(@$_POST['horizonWork6'] != ""){
			
			if($horizonWork1=="")
			{
				$horizonWork1=@$_POST['horizonWork6'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizonWork6'];
			}			
		}
		
		if(@$_POST['horizonWork7'] != ""){
			
			if($horizonWork1=="")
			{
				$horizonWork1=@$_POST['horizonWork7'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizonWork7'];
			}	
			
		}
		
		if(@$_POST['horizonWork8'] != ""){
			
			if($horizonWork1=="")
			{
				$horizonWork1=@$_POST['horizonWork8'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizonWork8'];
			}	
		}
		if(@$_POST['horizonWork9'] != ""){
			
			if($horizonWork1=="")
			{
				$horizonWork1=@$_POST['horizonWork9'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizonWork9'];
			}	
		}
		if(@$_POST['horizonWork10'] != ""){
			
			
			if($horizonWork1=="")
			{
				$horizonWork1=@$_POST['horizon_other_name'];
			}
			else
			{
				$horizonWork1 .= "#".@$_POST['horizon_other_name'];
			}	
			
		}
		
		
			//echo $cnt; echo $horizonWork1; exit;
		$horizon_str=explode("#",$horizonWork1);
		$horizon_str=implode(",",$horizon_str);
		

	
	
	if(($fname == "") ||($lname == "") || ($email == "") || ($mob_no == "") ){
		
		echo "<script language='javascript'>alert('Please Enter Required Information');</script>";
		echo "<script language='javascript'>window.location = 'it_yesss_abstracts_reg.php';</script>";
		exit;
	}
	
	
	//require "includes/form_constants.php";

	
	$ses = @$_SESSION["vercode_yesss_abstracts_reg"];
	$ddate=date("Y-m-d");
	$ttime=date("H:i:s A");
	$yesss_abstracts_reg_identity = $EVENT_NAME." ".$EVENT_YEAR." interest for Abstracts for YESSS programme";
	$yesss_abstracts_reg_location = @$_REQUEST['yesss_abstracts_reg_city'];
	
	
	require "dbcon_open.php";
	//echo "INSERT INTO $ABSTRACT_TBL_NAME(name,org,desig,email,mob,reg_id,participant,comment,ddate,ttime,website,month_year_inception,tot_emp,address,city,pin,state) VALUES('$name','$org','$desig','$email','$mob','$ses','$enq1','$comment','$ddate','$ttime','$website','$month_year','$total_emp','$address','$city','$pin','$state')";
	
		
	$qr = "INSERT INTO $YESSS_ABSTRCT_REG_TBL_NAME(title,fname,lname,org,desig,email,mob_no,reg_id,work_sector,ddate,ttime,website,month_year_inception,total_emp,address1,address2,country,city,pin,state,fone,fax,horizon_work) VALUES('$title','$fname','$lname','$org','$desig','$email','$mob_no','$ses','$enq1','$ddate','$ttime','$website','$month_year_inception','$total_emp','$address1','$address2','$country','$city','$pin','$state','$fone','$fax','$horizonWork1')";

	//echo $qr;exit;
	
	$result = mysqli_query($link,$qr) or die(mysqli_error($link));
	
	$last_insert_id = mysqli_insert_id($link);
	$_SESSION['USER_SRNO'] = $last_insert_id;
	//user
	

	echo "<script language='javascript'>window.location = 'it_yesss_abstracts_reg3.php';</script>";	
	exit;
	
	
?>