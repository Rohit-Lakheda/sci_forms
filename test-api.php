<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include 'includes/form_constants_both.php';
include 'dbcon_open.php';

exit;

$data['name']= 'Test Rest';
$data['email']= 'bts3@gmail.com';
$data['country_code']= '66';
$data['mobile']='914694441';
$data['company']= urlencode('SCI & MMA & Interlinks');
$data['designation']= 'Dev';
//$data['type']= 2;
$data['category_id']= 391;
$data['print_val']= 'Delegate';
//print_r($data);
//exit;
$result = callUniversalAPI($data);
echo '#';print_r(json_decode($result));
exit;


function callAPI1($data, $url = '', $method = 'POST') {
		if(empty($url)) {
			/*$url = 'https://chkdin.com/organizer/apicall/v2/push_attendee';
			$data['skey'] = 'chkdinasd8724wfsdf6asdkj5wbts';*/
			$url = 'https://studio.chkdin.com/api/v1/push_guest';
			$data['api_key'] = 'scan626246ff10216s477754768osk';
		}
		$curl = curl_init();

		switch ($method){
		  case "POST":
			 curl_setopt($curl, CURLOPT_POST, 1);
			 if ($data) {
				$fields_string = '';
				foreach($data as $key=>$value) {
					$fields_string .= $key.'='.$value.'&'; 
				}
				rtrim($fields_string, '&');
				curl_setopt($curl,CURLOPT_POST, count($data));
				curl_setopt($curl,CURLOPT_POSTFIELDS, $fields_string);
				//curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
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

		if(!$result){die("Connection Failure");}

		curl_close($curl);

		return $result;
	}
	
	/**
	 * This function save the delegate data
	 */
	function callUniversalAPI1($data) {
	    //return;
		//print_r(json_encode($data));exit;
		// $data['ticket_id']= $ticket_id;
		$data['event_id']= 117535;
		$result = callAPI1($data);
		print_r($result);//exit;
		$response = json_decode($result, true);
		//print_r($response);exit;
		$request = json_encode($data);
		$date = date('Y-m-d H:i:s');
		$msg = '';
		if(isset($response['message'])) {
			$msg = $response['message'];
		}
		$login_link = '';
		if(isset($response['login_link'])) {
			$login_link = $response['login_link'];
		}
		$category_id = '';
		if(isset($data['category_id'])) {
			$category_id = $data['category_id'];
		}
		$sql = "INSERT INTO it_2022_reg_api_log(name,email,booking_id,ticket_id,ticket_type,status,message,created_at,request, response) VALUES('$data[name]','$data[email]','$login_link','$data[type]','$category_id','$response[success]','$msg','$date', '$request', '$result')";
		mysqli_query($link,$sql);

		return $result; 
	}


$sql = "SELECT * FROM it_2019_exhibitors_dir_user_details_tbl ";

/*$sql = "SELECT * FROM it_2019_reg_tbl WHERE tin_no='TIN-IT2019-139177815'";
$sql = "SELECT * FROM it_2019_reg_tbl WHERE cata ='Complimentary GIA Partner Delegate';";
$sql = "SELECT * FROM it_2019_reg_tbl WHERE pay_status='Complimentary';";
$sql = "SELECT * FROM it_2019_reg_tbl WHERE pay_status='Paid';";*/
$result = mysqli_query($link,$sql);

while($row = mysqli_fetch_assoc($result)) {
	$recordData[] = $row;
}
//print_r($recordData);
//exit;
foreach($recordData as $row) {
	//for($i = 1; $i<= $row['sub_delegates']; $i++) {
		$data = array();
		$data['name']= $row['title'] . ' ' . $row['fname'] . ' ' . $row['lname'];
		$data['email']= $row['email'];
		/*$dele_cellno_arr = explode("-", $row['mob']);
	            
		if(isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if(strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '+91';
			}
		}
		if(isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}*/

		$data['country_code']= '91';
		$data['phone']= $row['mob'];
		$data['company']= $row['org'];
		$data['designation']= (empty($row['desig']) ? '-' : $row['desig']);
		/*$data['additional_data_1']= $row['assoc_name'];
		$data['additional_data_2']= $row['city'];
		$data['additional_data_3']= $row['state'];*/
		$data['booking_id']= $row['exhibitor_id'];
		
		print_r($data);

		$res = $row;
		
		/*if($res['cata'] == 'Complimentary GIA Partner Delegate') {
			callUniversalAPI($data, 31422, 'GIA Partner');
			print_r($data);echo 'Complimentary GIA Partner Delegate';
		} else if($res['cata'] == 'Complimentary Media Delegate') {
			callUniversalAPI($data, 31426, 'Media');
			print_r($data);echo 'Complimentary Media Delegate';
		} else if($res['cata'] == 'Complimentary Sponsor Delegate') {
			callUniversalAPI($data, 31428, 'Sponsor');
			print_r($data);echo 'Complimentary Sponsor Delegate';
		} else if($res['cata'] == 'Complimentary Speaker Delegate') {
			callUniversalAPI($data, 31424, 'Speaker');
			print_r($data);echo 'Complimentary Speaker Delegate';
		} else if(($res['assoc_name'] == 'Nasscom')||($res['assoc_name'] == 'ABLE')||($res['assoc_name'] == 'ABAI')||($res['assoc_name'] == 'COAI')||($res['assoc_name'] == 'CLIK')||($res['assoc_name'] == 'RCI')||($res['assoc_name'] == 'TiE')||($res['assoc_name'] == 'IACC')||($res['assoc_name'] == 'IESA')||($res['assoc_name'] == 'MOBILE10X')||($res['assoc_name'] == 'Drone Federation of India')) {
			callUniversalAPI($data, 31427, 'Association Partner');
			print_r($data);echo 'Complimentary Association Partner Delegate';
		} else {
			if($res['org_reg_type'] == 'Poster'){
				callUniversalAPI($data, 31423, 'Poster');
				print_r($data);echo 'Poster Delegate';
			} else {
				callUniversalAPI($data, 31036, 'Delegate');
				print_r($data);echo 'Delegate';
			}
		}*/
		callUniversalAPI($data,31429,'Exhibitor');
	//}
}



/*$sql = "SELECT * FROM it_2019_speakers_directory_data_tbl";
$result = mysqli_query($link,$sql);
while($row = mysqli_fetch_assoc($result)) {
	$recordData[] = $row;
}
foreach($recordData as $row) {
	
		$data = array();
		$data['name']= $row['speaker_title'] . ' ' . $row['speaker_fname'] .' '.$row['speaker_mname'].' ' . $row['speaker_lname'];
		$data['email']= $row['speaker_email_1'];
		$data['country_code']= $row['speaker_mob_cntry_code'];
		$data['phone']= $row['speaker_mob'];
		$data['company']= $row['speaker_org'];
		$data['designation']= (empty($row['speaker_desig']) ? '-' : $row['speaker_desig' ]);
		$data['booking_id']= $row['speaker_id'];
		print_r($data);
		
			callUniversalAPI($data, 31424, 'Speaker');
}

exit;*/

/*$data['name']= 'Mr. Arindam Ray' ;
$data['email']= 'arindam.r@aqbsolutions.com';
$data['country_code']= '91';
$data['phone']='9831934645';
$data['company']= 'AQB Solutions Private Limited';
$data['designation']= '';
$data['booking_id']= '';
print_r($data);
exit;
callUniversalAPI($data, 31429, 'Exhibitor');
exit;*/


//echo $result;

 
