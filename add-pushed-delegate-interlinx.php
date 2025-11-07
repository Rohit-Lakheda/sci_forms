<?php

	require("includes/form_constants_both.php");
	require "dbcon_open.php";
	require "class.phpmailer.php";

	 exit;	

//$a = array('TIN-BTS2024-211350779','TIN-BTS2024-244254395','TIN-BTS2024-261485186','TIN-BTS2024-313081346','TIN-BTS2024-314195565','TIN-BTS2024-328996741','TIN-BTS2024-342399424','TIN-BTS2024-351762546');
//$a = array('TIN-BTS2024-203142832','TIN-BTS2024-24044323','TIN-BTS2024-30252405','TIN-BTS2024-335446462','TIN-BTS2024-354586149','TIN-BTS2024-430977948','TIN-BTS2024-86675073');
foreach($a as $b) {
	$res = $qr_gt_user_data_ans_row = mysqli_fetch_array(mysqli_query($link,"SELECT * FROM $EVENT_DB_FORM_REG WHERE tin_no='$b'"));

	for ($i = 1; $i <= $res['sub_delegates']; $i++) {
		$dele_title = $res['title' . $i];
		$dele_fname = $res['fname' . $i];
		$dele_lname = $res['lname' . $i];
		$dele_email = $res['email' . $i];
		$job_title = $res['job_title' . $i];
		$dele_cellno = str_replace('+', '', $res['cellno' . $i]);
		$dele_cellno_arr = explode("-", $dele_cellno);

		if (isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if (strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '91';
			}
		}
		if (isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}
		//Call save Operator API
		$data = array();
		$data['api_key'] = 'scan626246ff10216s477754768osk';
		$data['event_id'] = 117859;
		$data['name'] = $dele_fname . ' ' . $dele_lname;
		$data['email'] = $dele_email;
		$data['country_code'] = $country_code;
		$data['mobile'] = $phone;
		$data['company'] = $res['org'];
		$data['designation'] = $job_title;
		$data['category_id'] = 1879;

		$data['country'] = $res['country'];
		$data['city'] = $res['city'];

		if (!empty($res['day1']) || !empty($res['day2']) || !empty($res['day3'])) {
			// Count the number of non-empty days
			$day_count = 0;
			if (!empty($res['day1']))
				$day_count++;
			if (!empty($res['day2']))
				$day_count++;
			if (!empty($res['day3']))
				$day_count++;

			// Set the value of $data['qsn_366'] based on the count
			if ($day_count > 2) {
				$data['qsn_366'] = 'Delegate';
			} else {
				$data['qsn_366'] = 'Single Day';

				// Collect the non-empty days into an array
				$days = [];
				if (!empty($res['day1']))
					$days[] = $res['day1'];
				if (!empty($res['day2']))
					$days[] = $res['day2'];
				if (!empty($res['day3']))
					$days[] = $res['day3'];

				// Append the days in a formatted string
				$data['qsn_366'] .= ' (' . implode(' - ', $days) . ')';
			}
		} else {
			$data['qsn_366'] = 'Delegate';
		}

		//$data['qsn_366'] = 'Delegate';



		sendchkdinapi($data);
		print_r($data);
		//Call API
		//callUniversalAPI($data);//exit;
	}//exit;
		
		
}
	