 <?php

// Function to send payment data to the API endpoint
function sendPaymentData($tinNo, $link) {
    // Set headers
    header("Content-Type: application/json");
    // Prepare SQL query
    $escapedTinNo = mysqli_real_escape_string($link, $tinNo);
    $sql = "SELECT * FROM `prawaas_2024_reg_tbl` WHERE tin_no = '$escapedTinNo'";
    
    // Perform the query
    $result = mysqli_query($link, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        //return json_encode(['error' => 'No payment data found for the provided TIN number.']);
    }
    // Fetch the row
    $row = mysqli_fetch_assoc($result);
    $paymentDataJSON = [];

    // Loop through the row and construct the payment data array
    foreach ($row as $key => $value) {
        $paymentDataJSON[$key] = $value;
    }

    // Decode the payment data array into a JSON string
    $paymentDataJSON = ($paymentDataJSON);
    // echo $paymentDataJSON;


    // API endpoint to Send Delegate data
    //    $apiURL = 'https://live.dreamcast.in/eventbot/startupmahakumbh/api/dataWebhook';
    // $apiURL = 'https://registration.startupmahakumbh.org/api/dataWebhook';
    $apiURL = 'https://prawaas.com/api/test/api_webhook.php';

    // Set the access token
    $accessToken = 'YWwe3y5E2qkUBQF';

    // Append the access token to the API URL
       
    $data_string = ($paymentDataJSON);

    //insert into database
    $no_del = $row['sub_delegates'];
    for($i=1; $i<=$no_del; $i++){
        $del_name = $row['badge' . $i];
       
        $del_email = $row['email' . $i];
       
        $del_mobile = $row['cellno' . $i];
       
        $del_designation = $row['job_title' . $i];
       
        //mysqli real string
        
        $del_company = $row['org'];
        $del_name = mysqli_real_escape_string($link, $del_name);
       
        $badge_type = $row['cata' . $i];
        // $sql = "INSERT INTO `sm_2024_reg_api_log` (`name`, `email`, `cellno`, `design`, `org`, `ticket_type` ) VALUES ('$del_name', '$del_email', '$del_mobile', '$del_designation', '$del_company', '$badge_type' )";
        // $result = mysqli_query($link, $sql);
        
    }

    //log this data_string
    $log = fopen("log2.txt", "a");
    fwrite($log, json_encode($data_string));
    fclose($log);



    // Initialize cURL session
    $ch = curl_init($apiURL);

    // Set the request as a POST method
    curl_setopt($ch, CURLOPT_POST, 1);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

    // Set the content type to JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'accesstoken: ' . $accessToken,
        'Content-Type: application/json'
    ));

    // Return response instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
    }

    // Close cURL session
    curl_close($ch);
    
    // return $response;
    
}




// echo "HI";
require 'dbcon_open.php';
// echo "Hello";
// die;
$tin = "TIN-PRWS2024-543735313";

sendPaymentData($tin, $link);

?>
<?php
/*
function callUniversalAPI($data)
{
    require 'dbcon_open.php';
	if (isset($data['category_id']) && ($data['category_id'] == 743 || $data['category_id'] == 722 || $data['category_id'] == 734 || $data['category_id'] == 735 || $data['category_id'] == 736 || $data['category_id'] == 733 || $data['category_id'] == 739 || $data['category_id'] == 729 || $data['category_id'] == 728)) {
		//print_r($data);exit;
		/*if($data['email'] != 'pritam1@gmail.com') {
			return;
		}*/
		//print_r(json_encode($data));exit;
		// $data['ticket_id']= $ticket_id;
        /*
		$data['country_code'] = 91;
		$result = callAPI($data);
		//print_r($result);//exit;
		$response = json_decode($result, true);
		//print_r($response);exit;
		$request = json_encode($data);
		$date = date('Y-m-d H:i:s');
		$msg = '';
		/*if (isset($response['message'])) {
			$msg = $response['message'];
		}*/
		/*$login_link = '';
		if (isset($response['login_link'])) {
			$login_link = $response['login_link'];
		}
		$category_id = '';
		if (isset($data['category_id'])) {
			$category_id = $data['category_id'];
		}

		$sql = "INSERT INTO prawaas_2024_reg_api_log(name,email,booking_id,ticket_id,ticket_type,status,message,created_at,request, response) VALUES('$data[name]','$data[email]','$login_link','$category_id','$data[print_val]','$response[success]','$msg','$date', '$request', '$result')";
		mysqli_query($link,$sql);

		return $result;
	}
	return;
}