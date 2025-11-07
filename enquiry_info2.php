
<?php 
	$name = @$_POST['name'];
	$name = str_replace(" ", "", $name);
	$company = @$_POST['company'];
	$company = str_replace(" ", "", $company);
	$addr = @$_POST['addr1'];
	$addr = str_replace(" ", "", $addr);
	$ddate=date("d-M-Y");
	$ttime=date("H:i:s A");
	$email = @$_POST['email'];
	
	//if(($name == "")  ||  ($company == "")  ||  ($addr == ""))
	if(($name == "") ||  ($addr == "") || ($email == ""))
	{
		echo "<script language='javascript'>alert('Please Enter Required Details.');</script>";
		mysqli_close($link);
		echo "<script language='javascript'>document.location = ('enquiry.php');</script>";
		exit();
	}	
	
	$enq = @$_POST['enq'];
	$enq_str = $enq;
	$arr=explode(",",$enq);
	$enq_str = "";
	for($i=1; $i<=8; $i++)
	{
		if($arr[$i] != "")
		{
			$enq_str = $enq_str.$arr[$i].", ";
		}		
		//echo $arr[$i]."<br>";
	}
	
	
	//echo "<br>";
	//exit;
//------------------------------------------------- Capturing enquiry fields ------------------------------------------	
	if(@$_POST['find_us'] == "Others")
	{
		$know_from = @$_POST['specify'];
	}
	else
	{
		$know_from = @$_POST['find_us'];
	}
	  
	//admin
	
		$ENQUIRY_RECIPIENTS_ADMIN_MAIL = array($EVENT_ENQUIRY_EMAIL, 'utsav.activ@gmail.com', 'accounts@mmactiv.in', 'test.interlinks@gmail.com', 'smr.mmactiv@gmail.com', 'tabasum.mmactiv@gmail.com','mahinder.mmactiv@gmail.com','gurunath.angadi@mmactiv.in','kaustubh.patil@mmactiv.in');
	
		
		$temp_p_email = $email;
		$temp_p_name = $name;
		
		require "enq_emailer.php";	
		$str_career = "New Enquiry on http://www.bangaloreindiabio.in";	
		$str_career_bdy = $mail_msg;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
	
		foreach($ENQUIRY_RECIPIENTS_ADMIN_MAIL as $emailid)
		{
			if(mail($emailid,$str_career,$str_career_bdy,$headers))
			{
				//echo "<br />mail successful : 1<br />";
			}
			else
			{
					//echo "<br />mail failed : 1<br />";
			}
		
		} 
	
/*---------------------------------------------------------------------------------------------------------------------------*/
	 	
		//user
	
		$ENQUIRY_RECIPIENTS_USER_MAIL = array($email,'test.interlinks@gmail.com');
		
		$temp_p_email = "enquiry@bangaloreindiabio.in";
		$temp_p_name = "Bangalore INDIA BIO";
		
		require "enq_emailer_user.php";
		$str_career = "Thank you for sending enquiry on http://www.bangaloreindiabio.in";	
		$str_career_bdy = $enq_emailer_mail_msg_user;
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$temp_p_email. "\r\n".'Reply-To: '.$temp_p_email. "\r\n".'X-Mailer: PHP/' . phpversion();	
	
		foreach($ENQUIRY_RECIPIENTS_USER_MAIL as $emailid)
		{
			if(mail($emailid,$str_career,$str_career_bdy,$headers))
			{
				//echo "<br />mail successful : 1<br />";
			}
			else
			{
					//echo "<br />mail failed : 1<br />";
			}
		
		}
	
	
	/*
	echo "$mail_msg<br />";
	echo "<br />$str";
	exit;*/
	
	require "dbcon_open.php";	
	mysqli_query($link,"insert into bio_2013_enq_table(title, name, org, desig, addr, city, state, country, zip, fone, cellno, fax, email, website, enq1, enq2, enq3, enq4, enq5, enq6, enq7, comments, task_assigned_to1, task_assigned_to2, task_assigned_from, sp_msg, know_from, ddate, ttime) values('$_POST[title]', '$_POST[name]', '$_POST[company]', '$_POST[desig]', '$_POST[addr1].$_POST[addr2]', '$_POST[city]', '$_POST[state]', '$_POST[country]', '$_POST[zip]', '$_POST[fone]', '$_POST[cellno]', '$_POST[fax]', '$email', '$_POST[website]', '$enq_str', '', '', '', '', '', '', '$_POST[comments]', '', '', '', '', '$know_from', '$ddate', '$ttime')") or die(mysqli_error($link));	
	mysqli_close($link);
	echo "<script language='javascript'>window.location='enquiry_confirmation.php';</script>";
?>

<html>
<title>Bangalore INDIA BIO</title>
<body> 

<script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1511695-33']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>


</body>
</html>