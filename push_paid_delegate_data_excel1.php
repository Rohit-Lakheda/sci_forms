<?php 

	require("includes/form_constants_both.php");
	require "dbcon_open.php";

	$query  = "SELECT * FROM it_2024_reg_tbl where (pay_status = 'Paid') ORDER BY srno";
	//echo $query;exit;
	$numresults=mysqli_query($link,$query);
	$numrows=mysqli_num_rows($numresults);
	
	$result = mysqli_query($link,$query) or die("SQL Query failed ...");//fetching main data
	
$csv_output = '';
$file = 'paid_delegate-'.date("Y-m-d_h:m:s");

$csv_output  .= "Reg. Number\tTIN Number\tFull Name\tDesignation\tEmail Id\tCountry Code\tPhone\tOrganisation,Country\tBadge Printing Category\tRegistration Category\tDay Registration\tVIP Access\tDINING ZONE (R / D1 / D2 / D3)\tIT AWARDS\tBIO AWARDS\tDELEGATE KIT\tEvent Type(IT/BIO)";

	$csv_output .= "\n";
	$i_cnt = 1;
	//$$eventdbConnectionObjectNameAssoc[$selectedEvents]->connecttodb();//connecting to  database	
	while ($row = mysqli_fetch_array($result))
	{	
		$lmt=$row['sub_delegates'];
		
		for($i=1;$i<=$lmt;$i++) {
			$query12 = "SELECT * FROM it_2024_badge_data where email='" . $row['email'.$i] . "'";

			//echo "<br />a :".$query;
			//exit;
			$qr_chk_table_status1 = mysqli_num_rows(mysqli_query($link,$query12));
						
			if(($qr_chk_table_status1 >=1) ) {
				continue;
			}

			$mob=explode('-',$row['cellno'.$i]);
			$country_code=$mob[0];
			$mobile=$mob[1];

			$reg_cat=(empty($row['cata'])?' ':$row['cata']);
			$badge_cat=$row['org_reg_type'];
			if(!empty($row['cata' . $i])){
				$badge_cat = $row['cata' . $i];
			}
			$sector=$row['sector'];
			
			$partner_it ='No';
			if($badge_cat == 'Premium Delegate') {
				if($row['sector']=='Information Technology' || $row['sector']=='Electronics'){
					$partner_it ='Yes';
				}
			}
			
			$partner_bio ='No';
			if($badge_cat == 'Premium Delegate') {
				if($row['sector']=='Biotechnology'){
					$partner_bio ='Yes';
				}
			}
			
			$csv_output .= $i_cnt;
			$csv_output .="\t";	
			$csv_output .=$row['tin_no'];
			$csv_output .="\t";
			$csv_output .=$row['fname'.$i].' '.$row['lname'.$i];
			$csv_output .="\t";
			$csv_output .=(empty($row['job_title'.$i])?' ':$row['job_title'.$i]);
			$csv_output .="\t";
			$csv_output .=$row['email'.$i];
			$csv_output .="\t";
			$csv_output .=(empty($country_code)?' ':$country_code);
			$csv_output .="\t";
			$csv_output .=(empty($mobile)?' ':$mobile);
			$csv_output .="\t";
			$csv_output .=$row['org'].','.(empty($row['country'])?' ':$row['country']);
			$csv_output .="\t";
			$csv_output .='Delegate';
			$csv_output .="\t";

			$csv_output .='Delegate';
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
			$csv_output .=" ";//(empty($sector)?' ':$sector);
			$csv_output .="\t";

			$i_cnt = $i_cnt + 1 ;
			$csv_output .="\n";
		}
	}
	
	//$$eventdbConnectionObjectNameAssoc[$selectedEvents]->disconnecttodb();//disconnecting from  database	
	
header("mso-data-placement:same-cell");	
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: xls" . date("Y-m-d") . ".xls");
header("Content-disposition: filename=".$file.".xls");

print $csv_output;
exit;

?>