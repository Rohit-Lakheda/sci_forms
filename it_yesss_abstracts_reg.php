<?php 
 echo "<script language='javascript'>window.location = 'enquiry.php';</script>";
exit;
require "includes/form_constants.php";

require "yesss_abstracts_reg_captcha.php";
$page = basename($_SERVER['SCRIPT_NAME']); 

$date = '2016-11-07 19:00';
if(isset($_GET['email']) && $_GET['email'] == 'bipin.chandra@esyasoft.com') {
	$date = '2016-11-08 15:00';
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title><?php echo $EVENT_NAME . ' ' . $EVENT_YEAR; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        
        <link href="assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />
        <link href="css/custom-material.css" rel="stylesheet" type="text/css" />
        <link href="css/custom-style.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
        </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-boxed page-content-white page-md dips-background-color-body">
    	<!-- BEGIN HEADER -->
    	<!-- For header fixed .navbar-fixed-top -->
        <div class="page-header navbar dips-background-color-header">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner container">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="<?php echo $EVENT_WEBSITE_LINK;?>" target="_blank">
                        <img src="<?php echo $EVENT_LOGO_URL;?>" alt="logo" class="logo-default dips-logo" /> 
                    </a>
                </div>
                <!-- END LOGO -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="container">
        	<!-- BEGIN PAGE CONTENT -->
			<div class="page-container">
            	<!-- BEGIN CONTENT -->
	            <div class="page-content-wrapper">
	                <!-- BEGIN CONTENT BODY -->
	                <div class="page-content dips-page-content">
	                    <!-- BEGIN PAGE TITLE-->
	                    <h3 class="page-title"> Inviting Abstracts for YESSS Programme. </h3>
	                    <!-- END PAGE TITLE-->
	                    <!-- END PAGE HEADER-->
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="registration_form_2">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Abstracts Submission for YESSS Programme.
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
										<?php if(date('Y-m-d H:i') <= $date) {?>
	                                    <form action="it_yesss_abstracts_reg2.php" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post">
	                                        <div class="form-wizard">
	                                            <div class="form-body">
	                                                <ul class="nav nav-pills nav-justified steps">
	                                                    <li class="active">
	                                                        <a class="step dips-default-cursor">
	                                                            <span class="number"> 1 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Registration </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step">
	                                                            <span class="number"> 2 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Information </span>
	                                                        </a>
	                                                    </li>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step dips-default-cursor">
	                                                            <span class="number"> 3 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Confirm </span>
	                                                        </a>
	                                                    </li>
	                                                </ul>
	                                                <div id="bar" class="progress progress-striped" role="progressbar">
	                                                    <div class="progress-bar progress-bar-success"> </div>
	                                                </div>
	                                                <div class="tab-content">
														<div class="tab-pane active">
															<h3 class="block">Provide Your Information</h3>
															<div class="group form-group">
																	<label class="control-label col-md-3"> Entrepreneur's Name <span class="required"> * </span>
																		</label>
																	<div class="col-md-9">
																		<div class="col-md-2" style="margin-top: -21px;">
																			<div class="mdl-select mdl-js-select mdl-select--floating-label">
																		        <select class="mdl-select__input dips-mdl-select-input" name="title" id="title" required>
																		   			<option value=""></option>
																					<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
															                            foreach ($titleList as $title) {
															                            	
															                            	echo '<option value="' . $title . '" ' . $selected . '>' . $title . '</option>';
															                            }
															                    	?>
																		        </select>
																		        <label class="mdl-select__label" for="professsion">Title</label>
																			</div>
																		</div>
																		<div class="col-md-4" style="margin-top: -11px;">
																			<input name="fname" type="text" class="dips-name-textbox" id="fname" maxlength="100" required style="width: 100%;"/>
																			<span class="dips-highlight "></span> 
																			<span class="bar "></span> 
																			<label class="md-textbox-lable">&nbsp;&nbsp;First Name</label>
																		</div>
																		<div class="col-md-4" style="margin-top: -11px;">
																			<input name="lname" type="text" class="dips-name-textbox" id="lname" maxlength="100"  required style="width: 100%;" />
																			<span class="dips-highlight "></span> 
																			<span class="bar "></span> 
																			<label class="md-textbox-lable">&nbsp;&nbsp;Last Name</label>
																		</div>
																	</div>
																</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input type="text" name="desig" id="desig" required="required"/>
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Designation <span class="dips-required"> * </span></label>
																</div>
															</div>
                                                           <div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input type="text" name="org" class="dips-not-required" id="org" required="required"/>
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Start-Up Company Name <span class="dips-required"> * </span></label>
																</div>
															</div> 
                                                            <div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input type="text" name="website" class="dips-not-required" id="website" required="required"/>
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Website </label>
																</div>
															</div>
                                                            <div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input type="text" name="total_emp" id="total_emp" maxlength="3" required="required"/>
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;No of Employees <span class="dips-required"> * </span></label>
																</div>
															</div>
                                                           <div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-9">
                                                                     <div class="col-md-2" style="margin-top: -18px;">
                                                                        <div class="mdl-select mdl-js-select mdl-select--floating-label">
                                                                            <select class="mdl-select__input dips-mdl-select-input" name="month"  id="month" required>
                                                                                <option value=""></option>
                                                                                <?php $monthList = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUNE', 'JULY', 'AUG', 'SEPT', 'OCT', 'NOV', 'DEC');
                                                                                    foreach ($monthList as $month) {
                                                                                       
                                                                                        echo '<option value="' . $month . '" ' . $selected . '>' . $month . '</option>';
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                            <label class="mdl-select__label" for="professsion" >Month <span class="dips-required"> * </span></label>
                                                                        </div>
                                                                    </div>

																	<div class="col-md-4" style="margin-top: -11px;">
																			<input name="month_year_inception" type="text" class="dips-name-textbox" id="month_year_inception" maxlength="4" required style="width: 100%;" onkeyup="check_num(event,'month_year_inception')"/>
																			<span class="dips-highlight "></span> 
																			<span class="bar "></span> 
																			<label class="md-textbox-lable">&nbsp;&nbsp;Year of Inception <span class="dips-required"> * </span></label>
																	</div>
																</div>
															</div> 
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input name="address1" type="text" id="address1" maxlength="249" required />
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Address 1<span class="dips-required"> * </span></label>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input name="address2" type="text" id="address2" maxlength="249" class="dips-not-required" required />
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Address 2 </label>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input name="city" type="text" id="city" maxlength="100" required  onkeyup="check_char(event,'city')" />
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;City<span class="dips-required"> * </span></label>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input name="state" type="text" id="state" maxlength="100" required onkeyup="check_char(event,'state')" />
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;State<span class="dips-required"> * </span></label>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<div class="mdl-select mdl-js-select mdl-select--floating-label">
																        <select class="mdl-select__input dips-mdl-select-input" name="country" id="country">
																   			<option value=""></option>
																			<?php $countryList = array("AF"=>"Afghanistan","AL"=>"Albania","DZ"=>"Algeria","AS"=>"AmericanSamoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia","BA"=>"BosniaandHerzegowina","BW"=>"Botswana","BV"=>"BouvetIsland","BR"=>"Brazil","IO"=>"BritishIndianOceanTerritory","BN"=>"BruneiDarussalam","BG"=>"Bulgaria","BF"=>"BurkinaFaso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"CapeVerde","KY"=>"CaymanIslands","CF"=>"CentralAfricanRepublic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"ChristmasIsland","CC"=>"Cocos(Keeling)Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo,theDemocraticRepublicofthe","CK"=>"CookIslands","CR"=>"CostaRica","CI"=>"Coted'Ivoire","HR"=>"Croatia(Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"CzechRepublic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"DominicanRepublic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"ElSalvador","GQ"=>"EquatorialGuinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"FalklandIslands(Malvinas)","FO"=>"FaroeIslands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"FrenchGuiana","PF"=>"FrenchPolynesia","TF"=>"FrenchSouthernTerritories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"HeardandMcDonaldIslands","VA"=>"HolySee(VaticanCityState)","HN"=>"Honduras","HK"=>"HongKong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran(IslamicRepublicof)","IQ"=>"Iraq","IE"=>"Ireland","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea,DemocraticPeople'sRepublicof","KR"=>"Korea,Republicof","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"LaoPeople'sDemocraticRepublic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"LibyanArabJamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia,TheFormerYugoslavRepublicof","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"MarshallIslands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia,FederatedStatesof","MD"=>"Moldova,Republicof","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"NetherlandsAntilles","NC"=>"NewCaledonia","NZ"=>"NewZealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"NorfolkIsland","MP"=>"NorthernMarianaIslands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"PapuaNewGuinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"PuertoRico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"RussianFederation","RW"=>"Rwanda","KN"=>"SaintKittsandNevis","LC"=>"SaintLUCIA","VC"=>"SaintVincentandtheGrenadines","WS"=>"Samoa","SM"=>"SanMarino","ST"=>"SaoTomeandPrincipe","SA"=>"SaudiArabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"SierraLeone","SG"=>"Singapore","SK"=>"Slovakia(SlovakRepublic)","SI"=>"Slovenia","SB"=>"SolomonIslands","SO"=>"Somalia","ZA"=>"SouthAfrica","GS"=>"SouthGeorgiaandtheSouthSandwichIslands","ES"=>"Spain","LK"=>"SriLanka","SH"=>"St.Helena","PM"=>"St.PierreandMiquelon","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"SvalbardandJanMayenIslands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"SyrianArabRepublic","TW"=>"Taiwan,ProvinceofChina","TJ"=>"Tajikistan","TZ"=>"Tanzania,UnitedRepublicof","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"TrinidadandTobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"TurksandCaicosIslands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"UnitedArabEmirates","GB"=>"UnitedKingdom","US"=>"UnitedStates","UM"=>"UnitedStatesMinorOutlyingIslands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela","VN"=>"VietNam","VG"=>"VirginIslands(British)","VI"=>"VirginIslands(U.S.)","WF"=>"WallisandFutunaIslands","EH"=>"WesternSahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe");
																				if(empty($qr_gt_user_data_ans_row['country'])) {
																					$qr_gt_user_data_ans_row['country'] = 'India';
																				}
																				foreach ($countryList as $country) {
																					$selected = '';
																					if($qr_gt_user_data_ans_row['country'] == $country) {
																						$selected = 'selected=selected';
																					}
																					echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>'; 
																				}
																			?>
																        </select>
																        <label class="mdl-select__label" for="professsion">Country<span class="dips-required"> * </span></label>
																	</div>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input name="pin" type="text" id="pin" maxlength="20" class="dips-not-required" required  onkeyup="check_num(event,'pin')"/>
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Postal Code </label>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-9">
																		<span type="tel" id="telCountryIsoCode" data-fax-iso-code-hidden-field-name="foneCountryCode"></span>
																	
																		<input type="hidden" name="foneCountryCode" id="foneCountryCode"/>
																		<input type="hidden" id="foneCountryCodeIso" />
																		<input name="fone" type="text" id="fone" class="dips-telephone-textbox dips-not-required" maxlength="20" required onkeyup="check_num(event, 'fone');" />
																		<span class="highlight "></span> 
																		<span class="bar "></span> 
																		<label class="md-textbox-lable">&nbsp;&nbsp;Telephone Number </label>
																		<span class="help-block">+Country Code-Area Code-Phone Number(xxx-xxxx-xxxxx)</span>
																</div>
															</div>
															<div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-9">
																		<span type="tel" id="faxCountryIsoCode" data-fax-iso-code-hidden-field-name="faxCountryCode"></span>
																		
																		<input type="hidden" name="faxCountryCode" id="faxCountryCode"/>
																		<input type="hidden" id="faxCountryCodeIso" />
																		<input name="fax" type="text" id="fax" class="dips-telephone-textbox dips-not-required" maxlength="20" required onkeyup="check_num(event, 'fax');" />
																		<span class="highlight "></span> 
																		<span class="bar "></span> 
																		<label class="md-textbox-lable">&nbsp;&nbsp;Fax Number </label>
																		<span class="help-block">+Country Code-Area Code-Fax Number(xxx-xxxx-xxxxx)</span>
																</div>
															</div>
														</div>
                                                     <div class="group form-group">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="email" id="email" required="required"/>
                                                                <span class="highlight "></span> 
                                                                <span class="bar "></span> 
                                                                <label class="md-textbox-lable">&nbsp;&nbsp;Email <span class="dips-required"> * </span></label>
                                                            </div>
                                                        </div>
                                                       <div class="group form-group">
																<div class="col-md-3"></div>
																<div class="col-md-6">
																	<input type="text" name="mob_no" id="mob_no" onkeyup="check_num(event, 'mob_no');" required="required"/>
																	<span class="highlight "></span> 
																	<span class="bar "></span> 
																	<label class="md-textbox-lable">&nbsp;&nbsp;Mobile No <span class="dips-required"> * </span></label>
																</div>
															</div>
                                                       <div class="form-group form-md-checkboxes">
					                                            <label class="control-label col-md-3"> Main Vertical/Sector of Work <span class="dips-required"> * </span><br>(Please select the appropriate box)</label>
																<div class="col-md-9">
																	<div class="md-checkbox-list">
						                                            	<?php $id = 0;
						                                            		for($listIndex = 0; $listIndex < 2; $listIndex++) {
						                                            			$length = count($WOEK_SECTOR);
						                                            			$index = count($WOEK_SECTOR) /2;
						                                            			if($listIndex == 0) {
						                                            				$index = 0;
						                                            				$length = count($WOEK_SECTOR) /2;
						                                            			}
						                                            	?>
						                                            			<div class="md-checkbox-inline">
							                                            			<?php 
									                                            		for($index = $index; $index < $length; $index++) {
									                                            			$id++;
										                                            		$checked = '';
										                                            		
										                                    		?>
											                                                <div class="md-checkbox">
											                                                    <input type="checkbox" name="enquiry<?php echo $id;?>" id="enquiry<?php echo $id;?>" value="<?php echo $WOEK_SECTOR[$index];?>" class="md-check" <?php echo $checked;?> <?php if($WOEK_SECTOR[$index] == 'Other') { ?>onclick="show_othr_fun('enquiry<?php echo $id;?>');"<?php }?>>
											                                                    <label for="enquiry<?php echo $id;?>">
											                                                        <span></span>
											                                                        <span class="check"></span>
											                                                        <span class="box"></span> <?php echo $WOEK_SECTOR[$index];?></label>
											                                                </div>
										                                               		<?php if($WOEK_SECTOR[$index] == 'Other') { ?>
											                                            		<div class="rs-mb30" id="div_enq_other" style="display:none;">
																									<input name="other_name" id="other_name" type="text" class="dips-not-required" placeholder="Other"/>
																									<span class="dips-highlight "></span> 
																									<span class="bar "></span> 
																								</div>
											                                            	<?php }
									                                            		}?>
							                                            		</div>
							                                            	<?php }?>
							                                    	</div>
						                                   		</div>
					                                        </div> 
					                                    <div class="form-group form-md-checkboxes">
					                                            <label class="control-label col-md-3"> Horizontals of work <span class="dips-required"> * </span><br>(Please select the appropriate box)</label>
																<div class="col-md-9">
																	<div class="md-checkbox-list">
						                                            	<?php $id = 0;
						                                            		for($listIndex = 0; $listIndex < 2; $listIndex++) {
						                                            			$length = count($HORIZONTALS_WORK);
						                                            			$index = count($HORIZONTALS_WORK) /2;
						                                            			if($listIndex == 0) {
						                                            				$index = 0;
						                                            				$length = count($HORIZONTALS_WORK) /2;
						                                            			}
						                                            	?>
						                                            			<div class="md-checkbox-inline">
							                                            			<?php 
									                                            		for($index = $index; $index < $length; $index++) {
									                                            			$id++;
										                                            		$checked = '';
										                                            		
										                                    		?>
											                                                <div class="md-checkbox">
											                                                    <input type="checkbox" name="horizonWork<?php echo $id;?>" id="horizonWork<?php echo $id;?>" value="<?php echo $HORIZONTALS_WORK[$index];?>" class="md-check" <?php echo $checked;?> <?php if($HORIZONTALS_WORK[$index] == 'Other') { ?>onclick="show_horizon_othr_fun('horizonWork<?php echo $id;?>');"<?php }?>>
											                                                    <label for="horizonWork<?php echo $id;?>">
											                                                        <span></span>
											                                                        <span class="check"></span>
											                                                        <span class="box"></span> <?php echo $HORIZONTALS_WORK[$index];?></label>
											                                                </div>
										                                               		<?php if($HORIZONTALS_WORK[$index] == 'Other') { ?>
											                                            		<div class="rs-mb30" id="div_horizon_other" style="display:none;">
																									<input name="horizon_other_name" id="horizon_other_name" type="text" class="dips-not-required" placeholder="Other"/>
																									<span class="dips-highlight "></span> 
																									<span class="bar "></span> 
																								</div>
											                                            	<?php }
									                                            		}?>
							                                            		</div>
							                                            	<?php }?>
							                                    	</div>
						                                   		</div>
					                                        </div>         
                                                       <div class="form-group">
																<label class="control-label col-md-3"> 
																</label>
																<div class="col-md-4">
																	<div class="g-recaptcha" data-sitekey="<?php echo $EVENT_DATA_SITE_KEY; ?>"></div>
																</div>
															</div>       
													</div>
	                                            </div>
                                                
	                                            <div class="form-actions">
	                                                <div class="row">
	                                                    <div class="col-md-offset-3 col-md-9">
	                                                        <button type="button" class="btn sbold uppercase green-jungle" onClick="validate_yesss_abstracts_reg();"> Continue
	                                                            <i class="fa fa-angle-right"></i>
	                                                        </button>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </form>
										<?php } else {?>
											<h3>YESSS registrations are closed</h3>
										<?php }?>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <!-- END CONTENT BODY -->
	            </div>
	            <!-- END CONTENT -->
        	</div>
        	<!-- END PAGE CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 
            	<div class="row">
            	<span class="col-md-6 col-sm-8 col-xs-12">&copy; Copyright <?php echo date('Y') . '-' . (date('Y') +1);?> - <a href="http://mmactiv.in/" target="_blank" class="yellow">MM Activ Sci-Tech Communications Pvt. Ltd.</a> All Rights Reserved</span>
            	<span class="col-md-6">Web Interface Conceived & Driven By :  <a href="http://interlinks.in/" target="_blank" class="yellow">SCI Knowledge Interlinks</a></span>
            	</div>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
		<script src="assets/global/plugins/respond.min.js"></script>
		<script src="assets/global/plugins/excanvas.min.js"></script> 
		<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="js/material.min.js"></script>
        <script src="js/material-select.js"></script>
        <script src="telephoneWithFlags/js/intlTelInput.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="js/common.js"></script>
        <script src="js/yesss_reg.js"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_2', 0);
				$("#telCountryIsoCode").intlTelInput();
				$("#faxCountryIsoCode").intlTelInput();
				/* var foneCountryCodeIso = $('#foneCountryCodeIso').val();
				if(foneCountryCodeIso != '') {
					$("#telCountryIsoCode").intlTelInput("setCountry", foneCountryCodeIso);
				} */
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>