<?php 
exit;
	require("includes/form_constants_both.php");
	require "dbcon_open.php";

	$query  = "SELECT ud.*,ed.exhibitor_name, ed.country FROM it_2022_exhibitors_dir_user_details_tbl_phase_2 as ud,it_2022_exhibitors_dir_details_tbl_phase_2 as ed where (ed.exhibitor_id=ud.exhibitor_id) order by ud.srno" ;
	//echo $query;
	$numresults=mysqli_query($link,$query);
	$numrows=mysqli_num_rows($numresults);
	
	$result = mysqli_query($link,$query) or die("SQL Query failed ...");//fetching main data
	
$csv_output = '';
$file = 'All_Exhibitor_Stall_Attendees_Details'.date("Y-m-d_h:m:s");

$csv_output  .= "Reg. Number\tTIN Number\tFull Name\tDesignation\tEmail Id\tCountry Code\tPhone\tOrganisation,Country\tBadge Printing Category\tRegistration Category\tDay Registration\tVIP Access\tDINING ZONE (R / D1 / D2 / D3)\tIT AWARDS\tBIO AWARDS\tDELEGATE KIT\tEvent Type(IT/BIO)";

	$csv_output .= "\n";
	$i_cnt = 1;
	//$$eventdbConnectionObjectNameAssoc[$selectedEvents]->connecttodb();//connecting to  database	
	while ($row = mysqli_fetch_array($result))
	{	
		$query12 = "SELECT * FROM it_2022_reg_api_log where email='" . $row['email'] . "'";

		//echo "<br />a :".$query;
		//exit;
		$qr_chk_table_status1 = mysqli_num_rows(mysqli_query($link,$query12));
					
		if(($qr_chk_table_status1 >=1) ) {
			continue;
		}
		if($row['sector']=='Information Technology'){
			$sector='IT';
		}else if($row['sector']=='Bio Technology'){
			$sector='BIO';
		}

		$csv_output .= $i_cnt;
		$csv_output .="\t";	
		$csv_output .=$row['exhibitor_id'];
		$csv_output .="\t";
		$csv_output .=$row['fname'].' '.(empty($row['mname'])?' ':$row['mname']).' '.$row['lname'];
		$csv_output .="\t";
		$csv_output .=$row['desig'];
		$csv_output .="\t";
		$csv_output .=$row['email'];
		$csv_output .="\t";

		$dele_cellno     = str_replace('+', '', $row['mob']);
		$dele_cellno_arr = explode("-", $dele_cellno);

		if(isset($dele_cellno_arr[0])) {
			$country_code = $dele_cellno_arr[0];
			if(strlen($country_code) >= 6) {
				$phone = $country_code;
				$country_code = '91';
			}
		}
		if(isset($dele_cellno_arr[1])) {
			$phone = $dele_cellno_arr[1];
		}
		
		$csv_output .=$country_code;
		$csv_output .="\t";
		$csv_output .= $phone;//(empty($row['mob'])?' ':$row['mob']);
		$csv_output .="\t";
		$csv_output .=$row['exhibitor_name'].','.(empty($row['country'])?' ':$row['country']);
		$csv_output .="\t";
		
		$csv_output .='Exhibitor';//$row['category'];
		$csv_output .="\t";

		$csv_output .='Exhibitor';//$row['category'];
		$csv_output .="\t";

		$csv_output .=" ";
		$csv_output .="\t";

		$csv_output .=" ";
		$csv_output .="\t";

		$csv_output .=" ";
		$csv_output .="\t";
 
		$csv_output .=" ";
		$csv_output .="\t";

		$csv_output .=" ";
		$csv_output .="\t";

		$csv_output .=" ";
		$csv_output .="\t";
		$csv_output .=(empty($sector)?' ':$sector);
		$csv_output .="\t";

		$i_cnt = $i_cnt + 1 ;
		$csv_output .="\n";
	}
	
	//$$eventdbConnectionObjectNameAssoc[$selectedEvents]->disconnecttodb();//disconnecting from  database	
	
header("mso-data-placement:same-cell");	
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: xls" . date("Y-m-d") . ".xls");
header("Content-disposition: filename=".$file.".xls");

print $csv_output;
exit;

?>