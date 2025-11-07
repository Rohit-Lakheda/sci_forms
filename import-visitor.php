<?php
exit;
	require 'includes/excel_reader.php';
	require 'includes/dbcon_open.php';
	$target_path = 'Visit.xls';
	$data = new Spreadsheet_Excel_Reader($target_path);
	$header = array('Name','Email','Country_Code','Phone','Designation','Organization', 'Country');
	$collection = array();
	for($i=0;$i<count($data->sheets);$i++) {
		if(count($data->sheets[$i]['cells'])>0) {
			$readData = array();
			for($j=1;$j<=count($data->sheets[$i]['cells']);$j++) {
				 for($k=1;$k<=count($header);$k++) {
					$h = $k - 1;
					if(!isset($data->sheets[$i]['cells'][$j][$k])) {
						$readData[$header[$h]] = null;
					} else {
						$readData[$header[$h]] = mysqli_real_escape_string($link, $data->sheets[$i]['cells'][$j][$k]);
					}
				}
				
				if(!empty($readData) && $readData['Name'] != 'Name') {
					$phone = $readData['Country_Code'] . '-' . $readData['Phone'];
					$name = $readData['Name'];
					$Email = strtolower(trim($readData['Email']));
					$Designation = $readData['Designation'];
					$Organization = $readData['Organization'];
					$Country = trim($readData['Country']);
					if(empty($Country) && $readData['Country_Code'] == '91') {
						$Country = 'India';
					}
					$sql = "INSERT INTO it_visitor_pass(fname,email,job_title, org, country, fone,event_year,sector,sys_ddate,ttime) VALUES('$name', '$Email', '$Designation', '$Organization', '$Country', '$phone', '2019', 'Information Technology', '2019-11-18', '11:09:07 AM')";
					//echo $sql;
					$stud_details_insert = mysqli_query($link, $sql)or die(mysqli_error($link));
					//exit;
				}
				/* if(!empty($readData)) {
					$collection[] = $readData;
				} */
			}
		}
	
	}
	print_r($collection);exit;
?>