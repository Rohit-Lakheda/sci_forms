<?php 

		require "class.phpmailer.php";
		
		require "Bangalore-ITE.php";
 		$JN_MA_LST_RECIPIENTS_ADMIN_MAIL = array('test.interlinks@gmail.com','pranoti.manapure@interlinks.in');
		echo $test_emailer."<br />";
		
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host = "localhost"; // SMTP server
			$mail->From = "test.interlinks@gmail.com";
			$mail->FromName = "Bangalore ITE.biz";
			$mail->Subject = "HUBALI ITE 2013 - Emailer";
			$mail->IsHTML(true);
			$mail->Body = $test_emailer;			
			foreach($JN_MA_LST_RECIPIENTS_ADMIN_MAIL as $emailid)
			{
				$mail->AddAddress($emailid);		
				if(!$mail->Send())
				{
				   
				   
				}
				$mail->clearAddresses();
			}
			
		
		echo "Test";
?>