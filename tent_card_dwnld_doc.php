<?php 
	//ini_set("display_errors", "1");
//error_reporting(E_ALL);
	//require "include_in_all.php";
	
			
				
		/*$db_tbl_name = $eventDbTablePrefixArray[$tempTotalEventCount]."_".$selectedYear."_poster_submission_tbl";
				
		$query  = "SELECT * FROM ".$db_tbl_name .  ' ORDER BY srno';
	
		if(($qr_chk_table_status >=1) ){		
	
		//echo "<br />a :".$query;
		$numresults=mysqli_query($link,$query);
		$numrows=mysqli_num_rows($numresults);
		
		$result = mysqli_query($link,$query) or die("SQL Query failed ...");//fetching main data
		}//table checking
		
		*/

	$filename = 'tent_card' . date('YmdHis');
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=" . $filename . ".doc");

	$main_marksheet_copy2 = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Untitled Document</title>
      <style>
         .box{
         text-align:center;
         margin:0px auto;
         page-break-before: always
         }
		 .vertical-text {
         /*transform: rotate(90deg);*/
         color:#000;
         font-size:25px;
         border-top:2px solid #CCC;
         padding:30px;
         text-align:center;
         }
         .flip_V{ transform: scale(-1, 1);
         -webkit-transform:rotate(-180deg);
         -moz-transform:rotate(-180deg);
         -o-transform:rotate(-180deg);
         transform:rotate(-180deg); }
         .vertical-text1 {
         color:#000;
         font-size:25px;
		 padding:30px;
         text-align:center;
		 }
         .text{
			 font-weight:bold;
			 font-size:20px;
			 font-family:Arial, Helvetica, sans-serif;
		 }
		  .text1{
			  font-size:16px;
			 font-family:Arial, Helvetica, sans-serif;
		 }
      </style>
   </head>
   <body>
      <div style=" text-align:center;margin:0px auto;page-break-before: always">
         <div style="color:#000; font-size:25px; padding:30px; text-align:center;transform: scale(-1, 1);-webkit-transform:rotate(-180deg); -moz-transform:rotate(-180deg); -o-transform:rotate(-180deg);transform:rotate(-180deg);">
            <p style=" font-weight:bold;font-size:20px;font-family:Arial, Helvetica, sans-serif;">RAJKUMAR .D</p>
           
            <p style="font-size:16px; font-family:Arial, Helvetica, sans-serif;">Chairman & Managing Director</p>
             <p style="font-size:16px; font-family:Arial, Helvetica, sans-serif;">BPCL</p>
         </div>
         <div style="color:#000;font-size:25px; padding:30px;text-align:center;">
            <p style="font-weight:bold; font-size:20px;font-family:Arial, Helvetica, sans-serif;">RAJKUMAR .D</p>
           
            <p style="font-size:16px; font-family:Arial, Helvetica, sans-serif;">Chairman & Managing Director</p>
            <p style="font-size:16px; font-family:Arial, Helvetica, sans-serif;">BPCL</p>
         </div>
      </div>
      <div class="box">
          <div class="vertical-text flip_V"><p class="text">ABCD</p>
           
            <p class="text1">XZCV</p>
             <p class="text1">WERT</p>
         </div>
         <div class="vertical-text1"><p class="text">ABCD</p>
           
            <p class="text1">XZCV</p>
            <p class="text1">WERT</p>
         </div>
      </div>
   </body>
</html>';
	
	echo $main_marksheet_copy2;
?>