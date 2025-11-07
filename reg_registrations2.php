<?php  
	session_start(); 
	if(($_POST["vercode"] != $_SESSION["vercode_reg"]) || ($_SESSION["vercode_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location = 'reg_registrations.php';</script>";
		exit; 
	}
	require("includes/form_constants.php");

	require "dbcon_open.php";
	
	if($_POST['supo_mem']!= ""){
			$spl_type = @$_POST['supo_mem'];
	}
	
	$exhi = @$_REQUEST['exhi'];
	$exhibitor_id = "";
	if($exhi== "E34XH3IDf6gyy77"){
		$exhibitor_id = $_REQUEST['exhibitor_id'];
	}
	
	
	$temp_ticket_type = @$_POST['ticket_type'];
	
	$spl_delegate_asso_type="";
	
	$nt_sele_mem_cnt=0;
	
	if($spl_type == "Members Of Supporting Associations"){	
	
		
		if(@$_POST['assoc_name_txt'] != ""){
				$spl_delegate_asso_type = @$_POST['assoc_name_txt'];
			}
		else{
				$nt_sele_mem_cnt++;
		}
		
		
		if($spl_delegate_asso_type != ""){
			$spl_delegate_asso_type = "Members Of Supporting Associations - ".$spl_delegate_asso_type;
		}
		
		if($nt_sele_mem_cnt>=5){
			session_destroy();
			echo "<script language='javascript'>alert('Please select Associations .');</script>";
			echo "<script language='javascript'>window.location = 'reg_registrations.php';</script>";
			exit; 
		}
	
	}
	
	
	
	$ddate = date("Y-m-d");
	$ttime = date("H:i:s A");
	$reg_id = $_SESSION['vercode_reg'];	
	$ret = @$_GET['ret'];		
	
	if($ret == "retds4fu324rn_ed24d3it"){	
		mysqli_query($link,"delete from ".$EVENT_DB_FORM_REG_DEMO." where reg_id = '$reg_id' ") or die(mysqli_error($link));
		
	}
	
	
	$cata = @$_POST['cata'];
	//echo $cata."cata<br />";
	$cata_m = @$_POST['cata_m'];

	if($cata == ""){
		session_destroy();
		echo "<script language='javascript'>alert('Please select registration category.');</script>";
		echo "<script language='javascript'>window.location = 'reg_registrations.php';</script>";
		exit; 
	}
	if($cata_m == ""){
		session_destroy();
		echo "<script language='javascript'>alert('Please select delegate type.');</script>";
		echo "<script language='javascript'>window.location = 'reg_registrations.php';</script>";
		exit; 
	}
	
	$comp_date=$EVENT_DB_COMP_DATE;
	$date1=date("Y/m/d");
	$curr = @$_POST['curr'];
	$pay_status = 'Not Paid';//"Complimentary";
	$paymode = @$_POST['paymode'];
	$total_dele = "";
	$vercode = @$_POST['vercode'];
	$grp = $_POST['grp'];
	
	
	if($grp == "Single"){
		$total_dele = 1; 
	}
	else{
		$total_dele = $_POST['total_dele']; 
	}
	
	if(($total_dele>7)||($total_dele<1)){
		session_destroy();
		echo "<script language='javascript'>alert('In group min 3 and maximum 7 delegates are allowded.');</script>";
		echo "<script language='javascript'>window.location = 'reg_registrations.php';</script>";
		exit;
	}
	
	
	
	$amt_ext = "";
	$dollar = "";
	
	if($curr=="Indian"){
		$dollar = "1";
		$amt_ext = "Rs.";
		$nationality = "Indian Organization";
	}
	else if($curr=="Foreign"){
		$dollar = "71";
		$amt_ext = "USD";
		$nationality = "International Organization";
	}
	
	
	
	if($curr == "Indian")//------------------------------------------------------- if for Indian Start
	{		
		$amt_ext = "Rs.";
		$dollar = "1";
	
		
	  
	}//---------------------------------------------------------------------------------- End If for Indian 
	else if($curr == "Foreign")//-------------------------------------------------------  Else If for Foreign Start
	{
			$amt_ext = "US $";
			$dollar = "71";  			
		
   }//------------------------------------------------------------------------------------ End Elseif for Foreign 
	
	$rate = "0";
	$rate_org = "0";
		
	$amt = $total_dele * $rate_org;
	$dis = 0;	
	$temp_amt = 0;
	$mem_disc = 0;
	$gr_discount = 0;	
	$admin_discount = 0;
	$tax= 0;
	$total= 0;
	$main_amt = 0; 
	
	/*if($amt == 0)
	{
		session_destroy();
		echo "<script language='javascript'>alert('Very rare condition occures. Please try after 30 sec.');</script>";
		echo "<script language='javascript'>window.location='reg_registrations.php';</script>";
		exit;
	}
	*/
	
	mysqli_query($link,"insert into ".$EVENT_DB_FORM_REG_DEMO."(org_reg_type,nationality,cata,curr,gr_type,sub_delegates,paymode,pay_status,amt_ext,amt_per_del,selection_amt,total,reg_id,reg_date,reg_time,sp_msg,dollar,membership_name,ticket_type) values ('$cata_m','$nationality','$cata','$curr','$grp','$total_dele','$paymode','$pay_status','$amt_ext','$rate_org','$amt','$amt','$reg_id','$ddate','$ttime','$temp_sess_sp_msg','$dollar','$spl_delegate_asso_type','$temp_ticket_type')")or die(mysqli_error($link));
	
	
	$qry = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	$res = mysqli_fetch_array($qry);
	
	//----------------------------------------- End Geneating Tin Number ----------------------------------------------------
	
	if($cata == "Exhibitors Delegate"){		
		
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-EXHC-";
	}
	else if($cata == "Sponsor Delegate"){	
		
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-SPOC-";
	}
	else if($cata == "Speaker Delegate"){
	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-SPKC-";
	}
	else if($cata == "Complimentary Invitee Delegate"){
	
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-INVC-";
	}
	else{
		
		$EVENT_DB_TIN_NO="TIN-".ucfirst($EVENT_TABLE_PRFIX).$EVENT_YEAR."-";
	}
	
	
	$tin_no = $EVENT_DB_TIN_NO;
	$tin_no1 = "";
	
	$i = 0;
	$j = 0;
	
	$temp_srno_gt = $res['srno'];
	do
	{
		$i = 0;
		$j = 0;
	
		$tin_no1 = $tin_no.$temp_srno_gt.mt_rand(1,99999);
		
		$qry = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_DEMO." WHERE tin_no = '$tin_no1'");
		$res_no = mysqli_num_rows($qry);
		
		$qry1 = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG." WHERE tin_no = '$tin_no1'");
		$res_no1 = mysqli_num_rows($qry1);
		
		
		if( ($res_no == 0 ) || ($res_no1 == 0))
		{
			$i++;
			$j++;
						
		}		
		else 
		{
			$i = 0;
			$j = 0;
			$tin_no1 = "";					
		}
		
	}while( ($i<=0) || ($j<=0) );
	
	//------------------------------------------ End Geneating Tin Number ----------------------------------------------------

	//$pin_no1 = str_replace("TIN","PRN",$tin_no1);
	

	 
	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET amt_per_del = '$amt_per_del' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET gr_discount = '$gr_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET admin_discount = '$admin_discount' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tax = '$tax' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET total = '$total' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET membership_discount = '$mem_disc' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));	
	mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET tin_no = '$tin_no1' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	//mysqli_query($link,"UPDATE ".$EVENT_DB_FORM_REG_DEMO." SET pin_no = '$pin_no1' WHERE reg_id = '$reg_id'")or die(mysqli_error($link));
	
	echo "<script language='javascript'>window.location = 'reg_registrations3.php?exhi=$exhi&exhibitor_id=$exhibitor_id&exhi_log=r34tr1';</script>";		
		
	exit;
	
?>