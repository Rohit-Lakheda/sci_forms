<?php
	$csv_output = "";
	$file = 'sall_Registration_data'.date("Y-m-d_h:m:s");
	
	require "dbcon_open.php";
		
	$data_map = $data_del_map = array();
	$query  = "SELECT * FROM it_2018_reg_tbl_copy1 WHERE pay_status!='Not Paid'";
	//echo "<br />".$query . ';';
	$result = mysqli_query($link,$query) or die("SQL Query failed ...");
	while ($rowr = mysqli_fetch_assoc($result)) {
		if(!isset($data_map['index_' . $rowr['tin_no']])) {
			$data_map['index_' . $rowr['tin_no']] = $rowr;
			//$sql = "UPDATE ".$db_tbl_name." SET title='1' WHERE tin_no='" . $rowr['tin_no'] . "';";
			//mysqli_query($link,$sql);
			//echo $sql . '<br/>';
		}
	}		
	//echo '<pre>';print_r($data_del_map);exit;
	//echo '<pre>';print_r($data_map);exit;
	//echo count($data_map);exit;
		

	
//---------------------------------------------------------------------------------------------------------------------------------------------------------
	
	$csv_output  .= "Reg. Number\tTIN Number\tFull Name\tEmail\tCountry Code\tPhone\tOrganization, Country\tDay Registration";
		
	$csv_output .= "\n";
	
	$i_cnt = 1;
	//$i_cnt_dele = 0;
	$reg_no =1000;
	//echo '<pre>';print_r($data_map);exit;
	$datamap = array();
	//==========***********************============= Speacial Address ==============*************============
	foreach ($data_map as $rowr) {
		for($i_cnt_dele=1;$i_cnt_dele<=$rowr['sub_delegates'];$i_cnt_dele++) {
			//$reg_code = explode('-', $rowr['reg_code'.$i_cnt_dele]);
			//if(in_array('SL',$reg_code)) {
				$reg_no++;
				$csv_output .= (string)str_pad($reg_no,6,"0",STR_PAD_LEFT);
				$csv_output .="\t";	

				$csv_output .=$rowr['tin_no'];
				$csv_output .="\t";

				$csv_output .=$rowr['title'.$i_cnt_dele] . ' ' . $rowr['fname'.$i_cnt_dele] . ' ' . $rowr['lname'.$i_cnt_dele];
				$csv_output .="\t";
				$csv_output .=$rowr['email'.$i_cnt_dele];
				$csv_output .="\t";
				$cellno =str_replace('+','',$rowr['cellno'.$i_cnt_dele]);
				$cellno = explode('-', $cellno);
				if(count($cellno) > 1) {
					$csv_output .=$cellno[0];
					$csv_output .="\t";
					$csv_output .=$cellno[1];
				} else {
					$csv_output .='';
					$csv_output .="\t";
					$csv_output .='';
				}
				$csv_output .="\t";

				$csv_output .=$rowr['org'] . ', ' . $rowr['country'];
				$csv_output .="\t";

				if (strpos($rowr['cata'], 'Single Day-') !== false) {
					$cata = str_replace('Single Day-','',$rowr['cata']);
					//$cata = str_replace('Oct','',$cata);
					$cata = str_replace(',','',$cata);
					$csv_output .= trim($cata);					
				} else {
					$csv_output .='Nov 29th,Nov 30th,Dec 1st';
				}
				$csv_output .="\t";

				$csv_output .="\n";
				//unset($data_map['index_' . $rowr['tin_no']]);
				//$rowr['reg_code'.$i_cnt_dele] = $rowr['email'.$i_cnt_dele] ='';
				
				if(empty($rowr['reg_no'.$i_cnt_dele])) {
					$sql = "UPDATE it_2018_reg_tbl_copy1 SET reg_no" . $i_cnt_dele . "='". str_pad($reg_no,6,"0",STR_PAD_LEFT) . "' WHERE tin_no='" . $rowr['tin_no'] . "';";
					mysqli_query($link,$sql);
					//echo $sql . '<br/>';
				}
			//}
		}
		$datamap[] = $rowr;
			
		//$i_cnt = $i_cnt + 1 ;
	}
	
	//echo $csv_output;exit;
	//echo '<pre>';print_r($datamap);exit;
//---------------------------------------- End Fetching Data of Complimentary Delegate From Complimetry Table ------------------


header("Content-type: application/vnd.ms-excel");
header("Content-disposition: xls" . date("Y-m-d") . ".xls");
header( "Content-disposition: filename=".$file.".xls");
echo $csv_output;exit;
//print $csv_output;
exit;

function url_exists($url){
   $headers=get_headers($url);
   return stripos($headers[0],"200 OK")?true:false;
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
