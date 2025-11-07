<?php
	session_start();
	require("includes/form_constants_both.php");
	//$_SESSION["vercode_reg"] = '24TNJ6';
	$sector = $_SESSION['sector'];
	$event_name = 'Bangalore IT';
	
	/*if($sector == 'Bio Technology') {
		$event_name = 'Bangalore INDIA BIO';
	
		require "dbcon_open_bio.php";
	
		$EVENT_DB_FORM_SPKR_DATA = "india_bio_".$EVENT_YEAR."_speakers_directory_data_tbl";
		$EVENT_DB_FORM_SPKR_PARA = "india_bio_".$EVENT_YEAR."_speakers_directory_para_tbl";
		$EVENT_DB_FORM_SPKR_MAP = "india_bio_".$EVENT_YEAR."_speakers_directory_mapping_tbl";
	} else {
		
	}*/
	require "dbcon_open.php";

	$EVENT_DB_FORM_SPKR_DATA = $EVENT_DB_FORM_SKILL_SPKR_DATA;
	$EVENT_DB_FORM_SPKR_PARA = $EVENT_DB_FORM_SKILL_SPKR_PARA;
	$EVENT_DB_FORM_SPKR_MAP = $EVENT_DB_FORM_SKILL_SPKR_MAP;

	if((!isset($_SESSION["vercode_spkr_reg"]))||($_SESSION["vercode_spkr_reg"]==''))  
	{ 
    	session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched.');</script>";
		echo "<script language='javascript'>window.location=('skill-speakers-registration.php');</script>";
		echo "<script language='javascript'>document.location=('skill-speakers-registration.php');</script>";
		exit; 
	}
	$reg_id = $_SESSION['vercode_spkr_reg'];
	
	$sql = "SELECT * FROM $EVENT_DB_FORM_SPKR_DATA sd, $EVENT_DB_FORM_SPKR_MAP sm, $EVENT_DB_FORM_SPKR_PARA sp
			WHERE sd.reg_id='" . $_SESSION["vercode_spkr_reg"] . "' AND sd.speaker_id=sm.speaker_id AND sm.element_id=sp.element_id";
	
	$qr_gt_user_data_id = mysqli_query($link,$sql);
	$qr_gt_user_data_ans_no = mysqli_num_rows($qr_gt_user_data_id);
	if( ($qr_gt_user_data_ans_no<=0) || ($qr_gt_user_data_ans_no=="") ){
		session_destroy();
		echo "<script language='javascript'>alert('Verification images mis-matched..');</script>";
		echo "<script language='javascript'>window.location=('skill-speakers-registration.php');</script>";
		echo "<script language='javascript'>document.location=('skill-speakers-registration.php');</script>";
		exit; 
	}	
	
	$qr_gt_user_data_ans_row = mysqli_fetch_array($qr_gt_user_data_id);

	session_destroy();
?>
<?php require 'includes/reg_form_header.php';?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered" id="registration_form_4">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-red"></i>
                                        <span class="caption-subject font-red bold uppercase">  Bengaluru Skill 2019 Speaker Registration Form
                                        </span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form action="" class="form-horizontal" name="reg_registration_form_4" id="reg_registration_form_4" method="post">
                                        <div class="form-wizard">
                                            <div class="form-body">
                                                <ul class="nav nav-pills nav-justified steps">
                                                    <li class="done">
														<a href="#tab1" data-toggle="tab" class="step">
														<span class="number"> 1 </span>
														<span class="desc">
														<i class="fa fa-check"></i> Information </span>
														</a>
													</li>
													<li class="done">
														<a data-toggle="tab" class="step dips-default-cursor">
														<span class="number"> 2 </span>
														<span class="desc">
														<i class="fa fa-check"></i> Receipt </span>
														</a>
													</li>
                                                </ul>
                                                <div id="bar" class="progress progress-striped" role="progressbar">
                                                    <div class="progress-bar progress-bar-success"> </div>
                                                </div>
                                                <div class="tab-content">
													<div class="tab-pane active">
														<h3 class="block">Speaker Detail</h3>
														<div class="row">
									                        <div class="col-md-12">
									                            <!-- BEGIN Registration Category TABLE PORTLET-->
									                            <div class="portlet light bordered">
									                                <div class="portlet-title">
									                                    <div class="caption">
									                                    	<i class="fa fa-info-circle font-dark"></i>
									                                        <span class="caption-subject">Speaker Detail</span>
									                                    </div>
									                                </div>
									                                <div class="portlet-body">
									                                    <div class="table-scrollable">
									                                    	<table class="table table-striped table-bordered table-hover">
									                                            <tbody>
									                                            	<tr>
									                                                    <td> <strong>Sector</strong> </td>
									                                                    <td> <?php echo $_SESSION['sector']; ?> </td>
									                                                </tr>
									                                                <!-- <tr>
									                                                    <td> <strong>Session Title</strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['speaker_session_title']; ?> </td>
									                                                </tr> -->
									                                                <?php /*?><tr>
									                                                    <td> <strong>Session Description</strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['speaker_session_desc']; ?> </td>
									                                                </tr><?php */?>
									                                                <tr>
									                                                    <td> <strong>Name</strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['speaker_title'] . ' ' . $qr_gt_user_data_ans_row['speaker_fname'] . ' ' . $qr_gt_user_data_ans_row['speaker_mname'] . ' ' . $qr_gt_user_data_ans_row['speaker_lname']; ?> </td>
									                                                </tr>
									                                                <tr>
									                                                    <td> <strong>Email</strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['speaker_email_1']; ?> </td>
									                                                </tr>
									                                                <tr>
									                                                    <td> <strong>Mobile Number</strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['speaker_mob_cntry_code']."-".$qr_gt_user_data_ans_row['speaker_mob']; ?> </td>
									                                                </tr>
									                                                <tr>
									                                                    <td> <strong>Organisation Name</strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['speaker_org']; ?> </td>
									                                                </tr>
									                                                <tr>
									                                                    <td> <strong>Designation </strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['speaker_desig']; ?> </td>
									                                                </tr>
									                                                <!-- <tr>
									                                                    <td> <strong>Profile </strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['speaker_profile_tag_line']; ?> </td>
									                                                </tr> -->
									                                                <tr>
									                                                    <td> <strong>Speakers Profile</strong> </td>
									                                                    <td> <?php echo $qr_gt_user_data_ans_row['para_desc']; ?> </td>
									                                                </tr>
									                                                <tr>
									                                                    <td> <strong>Speaker Photo URL</strong> </td>
									                                                    <td> <a href="<?php echo $qr_gt_user_data_ans_row['speaker_photo']; ?>" target="_blank">Click here to download</a></td>
									                                                </tr>
									                                               <!--  <tr>
									                                                    <td> <strong>Speaker Organisation Logo URL</strong> </td>
									                                                    <td> <a href="<?php echo $qr_gt_user_data_ans_row['speaker_logo']; ?>" target="_blank">Click here to download</a> </td>
									                                                </tr> -->
									                                            </tbody>
									                                        </table>
									                                    </div>
									                                </div>
									                            </div>
									                            <!-- END Registration Category TABLE PORTLET-->
										                        </div>
                    										</div>
														</div>
													</div>
	                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
	    <?php require 'includes/reg_form_footer.php';?>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_4', 3);
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>