<?php
	$temp_pn = @$_GET ['pn'];
	
	if (($temp_pn == '')) {
		session_destroy ();
		echo "<script language='javascript'>alert('Error in process; Try again');</script>";
		echo "<script language='javascript'>window.location = 'visitor_pass_form1.php';</script>";
		exit ();
	}
	
	$temp_assoc_nm_vp = @$_REQUEST ['assoc_nm_vp'];
	require "includes/form_constants_both.php";
	require "dbcon_open.php";
	
	$qr_vp_d_id = mysqli_query ($link, "SELECT * FROM $VSTR_TBL_NAME WHERE pass_no = '$temp_pn'" ) or die ( mysqli_error ($link) );
	$res_vp_d = mysqli_fetch_array ( $qr_vp_d_id );
	
	require "visitor_pass_emailer_user-inst.php";
	echo $VSTR_FROM_BODY_ADMIN_MAIL;
?>