<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include 'includes/form_constants_both.php';
include 'dbcon_open.php';

exit;
$data = array();
$data['firstName']= 'Sagar';
$data['lastName']= '';
$data['email']= 'sa@gmail.com';
$data['mobile']='9975133607';
$data['organization']= ('VO');
//$data['designation']= 'Dev';
//$data['type']= 2;
//$data['category_id']= 391;
//$data['print_val']= 'Delegate';
//print_r($data);
//exit;
$result = callWizVisitorAPI($data);
echo '#';print_r(json_decode($result));
exit;


function callAPI1($data, $url = '', $method = 'POST') {
		if(empty($url)) {
			/*$url = 'https://chkdin.com/organizer/apicall/v2/push_attendee';
			$data['skey'] = 'chkdinasd8724wfsdf6asdkj5wbts';*/
			$url = 'https://wizitbts.wiz365.io/api/auth/signup';
			//$data['api_key'] = 'scan626246ff10216s477754768osk';
		}
		$curl = curl_init();

		switch ($method){
		  case "POST":
			 curl_setopt($curl, CURLOPT_POST, 1);
			 if ($data) {
				 // Attach encoded JSON string to the POST fields
				//curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

				// Set the content type to application/json
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

				// Return response instead of outputting
				//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				/*$fields_string = '';
				foreach($data as $key=>$value) {
					$fields_string .= $key.'='.$value.'&'; 
				}
				rtrim($fields_string, '&');
				curl_setopt($curl,CURLOPT_POST, count($data));
				curl_setopt($curl,CURLOPT_POSTFIELDS, $fields_string);*/
				curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
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
	function callWizVisitorAPI1($data) {
		$result = callAPI1($data);
		//print_r($result);exit;
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
		$data['name'] = $data['firstName'] . ' ' . $data['lastName'];
		$sql = "INSERT INTO it_2022_reg_api_log(name,email,booking_id,ticket_id,ticket_type,status,message,created_at,request, response) VALUES('$data[name]','$data[email]','$login_link','','','$response[id]','$msg','$date', '$request', '$result')";
		mysqli_query($link,$sql);

		return $result; 
	}

 
