<?php

	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	
	
	//$sql = mysqli_query($link,"Select * FROM it_2022_thankyou_speaker ");
	

	
	
	$reg_date = date('Y-m-d');
	$reg_time = date('H:i:s');

	require "class.phpmailer.php";	
	include "speaker-profile-user-mail.php";
	
	$i_cnt=1;
	
	//echo "0"."<br />";
	
	while($sql_result = mysqli_fetch_assoc($sql)){
		
		//echo "1"."<br />";
		
		$spkr_name = $sql_result['spkr_name'];
		
		$spkr_email = trim($sql_result['spkr_email']);
	
		$receipents  = array('test.interlinks@gmail.com', 'hemalatha.br@mmactiv.com', $spkr_email);
		
		$Subject    = 'Thank You for Speaking at Bengaluru Tech Summit 2022';
		
		$enq_emailer_mail_msg_user = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Bengaluru Tech Summit 2022</title>
</head>

<body style='font-family:Arial, Helvetica, sans-serif; font-size:14px;'>
<div>
<img src='https://bengalurutechsummit.com/web/it_forms/images/logo.png' border='0' />
</div>
<p align='justify'><br />
  <strong>Dear ".$spkr_name.",</strong><br />
  <br />
  Greetings  from Bengaluru Tech Summit 2022.<br />
  <br />
  At the onset, we take  this opportunity to express our heartfelt gratitude and appreciation for  participating as a Speaker at the Bengaluru Tech Summit 2022 from November  16-18, 2022. We are privileged &amp; honored to have the participation of a  wide range speakers from across the globe. <br />
  <br />
  The Opening ceremony was  initiated with the  Inaugural Address by Shri.  Narendra Modi, Hon'ble Prime Minister of India virtually. We also had the  in-person presence of  eminent  personalities including Shri. Basavaraj S. Bommai, Hon'ble Chief Minister of Karnataka  H.E. Mr. Petri Honkonen, Minister of Science and Culture, Finland; H.E. Mr.  Omar Bin Sultan Al Olama, Minister of State for Artificial Intelligence,  Digital Economy and Remote Work Applications, United Arab Emirates; H.E. Mr.  Tim Watts, Assistant Minister for Foreign Affairs, Australia; Dr. C.N. Ashwath  Narayan, Hon'ble Minister for Electronics, IT, Bt and S&amp;T; Higher  Education;  Skill Development,  Entrepreneurship and Livelihood, Government of Karnataka; Mr. Martin Schroeter,  Chairman &amp; CEO, Kyndryl amongst many others. The inauguration was also  telecasted live across various Electronic, Digital such as Mirror Now, The  Economic Times, News 18 Kannada, India Today and many more. There was  widespread promotions and live telecast across major Social Media platforms.<br />
  <br />
  The three-day physical  Summit was a grand success with the participation of 32 countries; 405  speakers; 72 sessions; 585 exhibitors and over 2000 start-ups. The Summit saw a  confluence of Conference attracting over 6000 delegates and Expo consisting of  ITE &amp; Biotech majors; 12 Country pavilions; R&amp;D labs and Start-up  pavilions attracting over 50000 footfalls. Additional there were 28 Workshops  &amp; Product Launches bringing great traction for the audience. <br />
  <br />
  Few key mentions by  Government of Karnataka:</p>
<ul>
  <li>BTS Silver Jubilee Icon awards presented  to top tech companies in recognition of their contribution to the State for  over 25 years </li>
  <li>Felicitation of 10 Unicorns and 3  Decacorns </li>
  <li>Announcement of the Karnataka  Research, Development and Innovation Policy </li>
  <li>Launch of 22  innovative products and solutions by startups</li>
  <li>Launch of Bengaluru  Science and Technology Cluster (BeST) that intends to bring together the best  minds in science, engineering, entrepreneurship, academia and government</li>
  <li>The prestigious IT  Ratna of Karnataka was awarded to Infosys and Intel</li>
  <li>IT Pride of Karnataka awarded to TCS, Bosch,  Mindtree, and 21 other companies</li>
  <li>MOUs signed with 9  startups</li>
</ul>
<p>The GIA partners with 164  Delegates, 101 Speakers, 3 Ministers level delegations, 6 Ambassadors from  outside India had a great networking and knowledge sharing opportunity. The  partners were representatives from 20 Countries including Germany, Thailand,  Australia, France, Finland, Sweden, Denmark, Netherlands, UK, Japan, Singapore,  South Korea, Austria, Poland, Switzerland, Canada, Israel, Lithuania, Italy,  United States of America. </p>
<p>The Expo was a  major success for both MNCs and Startups. About 350 Start-ups across diverse  sectors viz., IT Services, AI &amp; ML, IoT, Digital Learning, Mobility,  Blockchain, Robotics &amp; Drone, Cyber Security, Gaming, HealthTech, Fintech,  Edutech, SmartTech and Agri Tech showcased their innovative products. A country  focus pavilion from Canada, Netherlands, Germany, Australia, UK, South Korea, USA,  Denmark also garnered business connects. The Lab2Market  Pavilion had the display of India's premier R&amp;D institutes including CSIR  Labs, ICMR Labs, DRDO Labs, C-DAC, C-DOT, NAL, IIAP, ISRO, IIITB, and BIRAC. </p>
<p>The Summit also saw  fruitful B2B Meetings via InterlinX &amp; Virtual Platform. Over 2500 meetings were  conducted physically and virtually. </p>
<p>In its 25th  edition, Bengaluru Tech Summit only got bigger and better. This would not have  been possible without your support and active participation in the Summit.<br />
  You can access all the BTS 2022 programmes/  Sessions via <a href='https://www.bengalurutechsummit.com/BTS-2022-Program-at-Glance.php'>https://www.bengalurutechsummit.com/BTS-2022-Program-at-Glance.php</a> <br />
  <br />
  We look forward to  your continued support and partnership with the Government of Karnataka. The  BTS 2023 dates would be announced soon. Stay tuned!<br />
  <br />
  With  regards,</p>
<p>Bengaluru  Tech Summit 2022 Organizing team &nbsp;</p>
</body>
</html>";
		
	
		//echo elastic_mail_spkr($Subject, $enq_emailer_mail_msg_user, $receipents);
		
		echo "<br/>".$i_cnt.".)".$spkr_email;
		$i_cnt++;

	}

	
	
	exit;
?>