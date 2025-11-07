<?php
echo "<script language='javascript'>window.location = 'http://www.bengaluruite.biz/it_forms/enquiry.php';</script>";
exit;
session_start();

require("includes/form_constants.php");
require "dbcon_open.php";
require "get_user_no.php";

do {
	$i = 0;
	$text = get_rand_id(6);
	$_SESSION["vercode_exp"] = $text;

	$chq_qr_demo = mysqli_query($link,"SELECT * FROM ".$EVENT_DB_FORM_REG_EXPRESSION_OF_INTEREST." WHERE reg_id = '$text'")or die(mysqli_error($link));
	$chq_no_demo = mysqli_num_rows($chq_qr_demo);

	if($chq_no_demo > 0) {
		$i++;
		continue;
	} else {
		$i = 0;
	}
} while($i != 0);
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
        <title><?php echo $EVENT_NAME;?></title>
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
        <link href="js/telephoneWithFlags/css/intlTelInput.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/custom-material.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/custom-style.css" rel="stylesheet" type="text/css" />
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
                        <img src="<?php echo $EVENT_LOGO_LINK;?>" alt="logo" class="logo-default dips-logo" /> 
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
	                    <h3 class="page-title">Bengaluru ITE.BIZ 2016: Expression of Interest Form for Registering On Spot </h3>
	                    <!-- END PAGE TITLE-->
	                    <!-- END PAGE HEADER-->
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="portlet light bordered" id="registration_form_1">
	                                <div class="portlet-title">
	                                    <div class="caption">
	                                        <i class=" icon-layers font-red"></i>
	                                        <span class="caption-subject font-red bold uppercase"> Expression of Interest Form for Registering On Spot
	                                        </span>
	                                    </div>
	                                </div>
	                                <div class="portlet-body form">
									<?php if(date('Y-m-d') <= '2016-11-29') {?>
	                                <h3><strong>Only On Spot Payments for Bengaluru ITE.Biz 2016 are available now. You can register for Bengaluru ITE.Biz 2016 by filling following form and making payment on the spot at the venue.</strong></h3>
	                                
	                                    <form action="expression_of_interest_on_spot2.php" class="form-horizontal" name="exhibitors_form_1" id="exhibitors_form_1" method="post" onsubmit="return validate_registration_form_3();">
	                                    	<input name="vercode" type="hidden" id="vercode" value="<?php echo $_SESSION['vercode_exp'];?>"/>
	                                        <div class="form-wizard">
	                                            <div class="form-body">
	                                                <ul class="nav nav-pills nav-justified steps">
	                                                  <li class="active">
	                                                        <a href="#tab1" data-toggle="tab" class="step">
	                                                            <span class="number"> 1 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Personal Details </span>
	                                                        </a>
	                                                    </li>
                                                        <?php /*?><li>
	                                                        <a href="#tab1" data-toggle="tab" class="step">
	                                                            <span class="number"> 2 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Personal Details </span>
	                                                        </a>
	                                                    </li><?php */?>
	                                                    <li>
	                                                        <a data-toggle="tab" class="step dips-default-cursor">
	                                                            <span class="number"> 2 </span>
	                                                            <span class="desc">
	                                                                <i class="fa fa-check"></i> Confirmation </span>
	                                                        </a>
	                                                    </li>
	                                                </ul>
	                                                <div id="bar" class="progress progress-striped" role="progressbar">
	                                                    <div class="progress-bar progress-bar-success"> </div>
	                                                </div>
	                                                <div class="tab-content">
														<div class="tab-pane active">
															<div class="group form-group">
																<label class="control-label col-md-3">Registration Category<span class="dips-required"> * </span></label>
																<div class="col-md-9">
																	<div class="mdl-select mdl-js-select mdl-select--floating-label" style="margin-top: -23px; width: 90%;">
																        <select class="mdl-select__input dips-mdl-select-input" name="cata" id="cata" required>
																   			<option value="">-- Select Registration Category --</option>
																			<?php $countryList = array('3 Day Delegate will be charged @ Rs. 3000 + Service Tax @ 15% = Rs. 3,450', 'Single Day Delegate will be charged @ Rs. 1500 + Service Tax @ 15% = Rs. 1,725', '3 Day Student Delegate will be charged @ Rs. 1500 + Service Tax @ 15% = Rs. 1,725', 'Single Day Student Delegate will be charged @ Rs. 750 + Service Tax @ 15% = Rs. 860.00');
																				foreach ($countryList as $country) {
																					echo '<option value="' . $country . '">' . $country . '</option>'; 
																				}
																			?>
																        </select>
																	</div>
																</div>
															</div>
                                                            <div class="group form-group">
																	<label class="control-label col-md-3"> Name <span class="required"> * </span>
																		</label>
																	<div class="col-md-9">
																		<div class="col-md-2 rs-mb30" style="margin-top: -21px;">
																			<div class="mdl-select mdl-js-select mdl-select--floating-label">
																		        <select class="mdl-select__input dips-mdl-select-input" name="title" id="title" required>
																		   			<option value=""></option>
																					<?php $titleList = array('Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.');
															                            foreach ($titleList as $title) {
															                            	echo '<option value="' . $title . '">' . $title . '</option>';
															                            }
															                    	?>
																		        </select>
																		        <label class="mdl-select__label" for="professsion">Title</label>
																			</div>
																		</div>
																		<div class="col-md-4 rs-mb30" style="margin-top: -11px;">
																			<input name="fname" type="text" class="dips-name-textbox" id="fname" maxlength="100" required style="width: 100%;"/>
																			<span class="dips-highlight "></span> 
																			<span class="bar "></span> 
																			<label class="md-textbox-lable">&nbsp;&nbsp;First Name</label>
																		</div>
																		<div class="col-md-4 rs-mb30" style="margin-top: -11px;">
																			<input name="lname" type="text" class="dips-name-textbox" id="lname" maxlength="100" required style="width: 100%;"/>
																			<span class="dips-highlight "></span> 
																			<span class="bar "></span> 
																			<label class="md-textbox-lable">&nbsp;&nbsp;Last Name</label>
																		</div>
																	</div>
																</div>
                                                            <div class="group form-group">
														    	<label class="control-label col-md-3">Designation <span class="dips-required"> * </span></label>
																<div class="col-md-6">
																	<input name="desig" type="text" id="desig" class="dips-not-required" required />
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																</div>
															</div>
                                                            <div class="group form-group">
														    	<label class="control-label col-md-3">Organisation <span class="dips-required"> * </span></label>
																<div class="col-md-6">
																	<input name="org" type="text" id="org" class="dips-not-required" required />
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																</div>
															</div>
															<div class="group form-group">
															    <label class="control-label col-md-3">Address 1<span class="dips-required"> * </span></label>
															    <div class="col-md-6">
															      <input name="addr1" type="text" id="addr1" maxlength="249" required />
															      <span class="dips-highlight "></span> <span class="bar "></span>
														      	</div>
															  </div>
                                                              <div class="group form-group">
																   <label class="control-label col-md-3">Address 2</label>
																    <div class="col-md-6">
																      <input name="addr2" type="text" id="addr2" maxlength="249" />
																      <span class="dips-highlight "></span> <span class="bar "></span>
															      </div>
															  </div>
															<div class="group form-group">
                                                                <label class="control-label col-md-3">City<span class="dips-required"> * </span></label>
                                                                <div class="col-md-6">
																	<input name="city" type="text" id="city" maxlength="100" required  />
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																</div>
															</div>
															<div class="group form-group">
																<label class="control-label col-md-3">State<span class="dips-required"> * </span></label>
																<div class="col-md-6">
																	<input name="state" type="text" id="state" maxlength="100" required />
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																</div>
															</div>
															<div class="group form-group">
																<label class="control-label col-md-3">Country<span class="dips-required"> * </span></label>
																<div class="col-md-6">
																	<div class="mdl-select mdl-js-select mdl-select--floating-label" style="margin-top: -23px;">
																        <select class="mdl-select__input dips-mdl-select-input" name="country" id="country" required>
																   			<option value=""></option>
																			<?php $countryList = array("AF"=>"Afghanistan","AL"=>"Albania","DZ"=>"Algeria","AS"=>"AmericanSamoa","AD"=>"Andorra","AO"=>"Angola","AI"=>"Anguilla","AQ"=>"Antarctica","AR"=>"Argentina","AM"=>"Armenia","AW"=>"Aruba","AU"=>"Australia","AT"=>"Austria","AZ"=>"Azerbaijan","BS"=>"Bahamas","BH"=>"Bahrain","BD"=>"Bangladesh","BB"=>"Barbados","BY"=>"Belarus","BE"=>"Belgium","BZ"=>"Belize","BJ"=>"Benin","BM"=>"Bermuda","BT"=>"Bhutan","BO"=>"Bolivia","BA"=>"BosniaandHerzegowina","BW"=>"Botswana","BV"=>"BouvetIsland","BR"=>"Brazil","IO"=>"BritishIndianOceanTerritory","BN"=>"BruneiDarussalam","BG"=>"Bulgaria","BF"=>"BurkinaFaso","BI"=>"Burundi","KH"=>"Cambodia","CM"=>"Cameroon","CA"=>"Canada","CV"=>"CapeVerde","KY"=>"CaymanIslands","CF"=>"CentralAfricanRepublic","TD"=>"Chad","CL"=>"Chile","CN"=>"China","CX"=>"ChristmasIsland","CC"=>"Cocos(Keeling)Islands","CO"=>"Colombia","KM"=>"Comoros","CG"=>"Congo","CD"=>"Congo,theDemocraticRepublicofthe","CK"=>"CookIslands","CR"=>"CostaRica","CI"=>"Coted'Ivoire","HR"=>"Croatia(Hrvatska)","CU"=>"Cuba","CY"=>"Cyprus","CZ"=>"CzechRepublic","DK"=>"Denmark","DJ"=>"Djibouti","DM"=>"Dominica","DO"=>"DominicanRepublic","EC"=>"Ecuador","EG"=>"Egypt","SV"=>"ElSalvador","GQ"=>"EquatorialGuinea","ER"=>"Eritrea","EE"=>"Estonia","ET"=>"Ethiopia","FK"=>"FalklandIslands(Malvinas)","FO"=>"FaroeIslands","FJ"=>"Fiji","FI"=>"Finland","FR"=>"France","GF"=>"FrenchGuiana","PF"=>"FrenchPolynesia","TF"=>"FrenchSouthernTerritories","GA"=>"Gabon","GM"=>"Gambia","GE"=>"Georgia","DE"=>"Germany","GH"=>"Ghana","GI"=>"Gibraltar","GR"=>"Greece","GL"=>"Greenland","GD"=>"Grenada","GP"=>"Guadeloupe","GU"=>"Guam","GT"=>"Guatemala","GN"=>"Guinea","GW"=>"Guinea-Bissau","GY"=>"Guyana","HT"=>"Haiti","HM"=>"HeardandMcDonaldIslands","VA"=>"HolySee(VaticanCityState)","HN"=>"Honduras","HK"=>"HongKong","HU"=>"Hungary","IS"=>"Iceland","IN"=>"India","ID"=>"Indonesia","IR"=>"Iran(IslamicRepublicof)","IQ"=>"Iraq","IE"=>"Ireland","IL"=>"Israel","IT"=>"Italy","JM"=>"Jamaica","JP"=>"Japan","JO"=>"Jordan","KZ"=>"Kazakhstan","KE"=>"Kenya","KI"=>"Kiribati","KP"=>"Korea,DemocraticPeople'sRepublicof","KR"=>"Korea,Republicof","KW"=>"Kuwait","KG"=>"Kyrgyzstan","LA"=>"LaoPeople'sDemocraticRepublic","LV"=>"Latvia","LB"=>"Lebanon","LS"=>"Lesotho","LR"=>"Liberia","LY"=>"LibyanArabJamahiriya","LI"=>"Liechtenstein","LT"=>"Lithuania","LU"=>"Luxembourg","MO"=>"Macau","MK"=>"Macedonia,TheFormerYugoslavRepublicof","MG"=>"Madagascar","MW"=>"Malawi","MY"=>"Malaysia","MV"=>"Maldives","ML"=>"Mali","MT"=>"Malta","MH"=>"MarshallIslands","MQ"=>"Martinique","MR"=>"Mauritania","MU"=>"Mauritius","YT"=>"Mayotte","MX"=>"Mexico","FM"=>"Micronesia,FederatedStatesof","MD"=>"Moldova,Republicof","MC"=>"Monaco","MN"=>"Mongolia","MS"=>"Montserrat","MA"=>"Morocco","MZ"=>"Mozambique","MM"=>"Myanmar","NA"=>"Namibia","NR"=>"Nauru","NP"=>"Nepal","NL"=>"Netherlands","AN"=>"NetherlandsAntilles","NC"=>"NewCaledonia","NZ"=>"NewZealand","NI"=>"Nicaragua","NE"=>"Niger","NG"=>"Nigeria","NU"=>"Niue","NF"=>"NorfolkIsland","MP"=>"NorthernMarianaIslands","NO"=>"Norway","OM"=>"Oman","PK"=>"Pakistan","PW"=>"Palau","PA"=>"Panama","PG"=>"PapuaNewGuinea","PY"=>"Paraguay","PE"=>"Peru","PH"=>"Philippines","PN"=>"Pitcairn","PL"=>"Poland","PT"=>"Portugal","PR"=>"PuertoRico","QA"=>"Qatar","RE"=>"Reunion","RO"=>"Romania","RU"=>"RussianFederation","RW"=>"Rwanda","KN"=>"SaintKittsandNevis","LC"=>"SaintLUCIA","VC"=>"SaintVincentandtheGrenadines","WS"=>"Samoa","SM"=>"SanMarino","ST"=>"SaoTomeandPrincipe","SA"=>"SaudiArabia","SN"=>"Senegal","SC"=>"Seychelles","SL"=>"SierraLeone","SG"=>"Singapore","SK"=>"Slovakia(SlovakRepublic)","SI"=>"Slovenia","SB"=>"SolomonIslands","SO"=>"Somalia","ZA"=>"SouthAfrica","GS"=>"SouthGeorgiaandtheSouthSandwichIslands","ES"=>"Spain","LK"=>"SriLanka","SH"=>"St.Helena","PM"=>"St.PierreandMiquelon","SD"=>"Sudan","SR"=>"Suriname","SJ"=>"SvalbardandJanMayenIslands","SZ"=>"Swaziland","SE"=>"Sweden","CH"=>"Switzerland","SY"=>"SyrianArabRepublic","TW"=>"Taiwan,ProvinceofChina","TJ"=>"Tajikistan","TZ"=>"Tanzania,UnitedRepublicof","TH"=>"Thailand","TG"=>"Togo","TK"=>"Tokelau","TO"=>"Tonga","TT"=>"TrinidadandTobago","TN"=>"Tunisia","TR"=>"Turkey","TM"=>"Turkmenistan","TC"=>"TurksandCaicosIslands","TV"=>"Tuvalu","UG"=>"Uganda","UA"=>"Ukraine","AE"=>"UnitedArabEmirates","GB"=>"UnitedKingdom","US"=>"UnitedStates","UM"=>"UnitedStatesMinorOutlyingIslands","UY"=>"Uruguay","UZ"=>"Uzbekistan","VU"=>"Vanuatu","VE"=>"Venezuela","VN"=>"VietNam","VG"=>"VirginIslands(British)","VI"=>"VirginIslands(U.S.)","WF"=>"WallisandFutunaIslands","EH"=>"WesternSahara","YE"=>"Yemen","ZM"=>"Zambia","ZW"=>"Zimbabwe");
																				foreach ($countryList as $country) {
																					$selected = '';
																					if('India' == $country) {
																						$selected = 'selected=selected';
																					}
																					echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>'; 
																				}
																			?>
																        </select>
																	</div>
																</div>
															</div>
															<div class="group form-group">
																<label class="control-label col-md-3">Postal Code<span class="dips-required"> * </span></label>
																<div class="col-md-6">
																	<input name="pin" type="text" id="pin" required  />
																	<span class="dips-highlight "></span> 
																	<span class="bar "></span> 
																</div>
															</div>
                                                            <div class="group form-group">
																	<label class="control-label col-md-3">Email Address<span class="dips-required"> * </span></label>
																	<div class="col-md-6">
																		<input name="email" type="email" class="dips-email" id="email" maxlength="150" required />
																		<span class="dips-highlight "></span> 
																		<span class="bar "></span> 
																	</div>
																</div>
																<div class="group form-group">
																	<label class="control-label col-md-3">Mobile Number<span class="dips-required"> * </span></label>
																	<div class="col-md-9"  style="margin-top: -23px;">
																		<span type="tel" id="mobile-country-code" data-fax-iso-code-hidden-field-name="cellnoCountryCode"></span>
																		<input type="hidden" name="cellnoCountryCode" id="cellnoCountryCode" />
																		<input type="hidden" id="cellnoCountryCodeIso" name="cellnoCountryCodeIso"/>
																		<input name="mobile" type="text" id="mobile" class="dips-telephone-textbox" maxlength="10"  required />
																		<span class="dips-highlight "></span> 
																		<span class="bar "></span> 
																		<span class="help-block">+Country Code-Mobile Number(xxx-xxxxxxxxxx)</span>
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
	                                            </div>
	                                            <div class="form-actions">
	                                                <div class="row">
	                                                    <div class="col-md-offset-3 col-md-9">
	                                                        <button type="submit" class="btn sbold uppercase green-jungle"> Continue
	                                                            <i class="fa fa-angle-right"></i>
	                                                        </button>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </form>
										<?php } else {?>
											<h3>Online spot registration are closed.</h3>
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
        <script src="js/telephoneWithFlags/js/intlTelInput.js"></script>
        <script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="js/common.js"></script>
        <script src="js/expression_of_interest_on_spot.js"></script>
        <script>
			jQuery(document).ready(function() {  
				Registration.init('registration_form_1', 0);

				<?php if(!empty($_SESSION['foneCountryIso'])) { ?>
					$("#telCountryIsoCode").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['foneCountryIso'];?>" ]});
				<?php } else {?>
					$("#telCountryIsoCode").intlTelInput();
				<?php }?>

				<?php if(!empty($_SESSION['faxCountryIso'])) { ?>
					$("#faxCountryIsoCode").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['faxCountryIso'];?>" ]});
				<?php } else {?>
					$("#faxCountryIsoCode").intlTelInput();
				<?php }?>
				
				 <?php if(!empty($_SESSION['cellnoCountryCodeIso'])) { ?>
				 	$("#mobile-country-code").intlTelInput({preferredCountries: [ "<?php echo $_SESSION['cellnoCountryCodeIso'];?>" ]});
				 <?php } else {?>
					 $("#mobile-country-code").intlTelInput();
				 <?php } ?>	 
			});
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
    </body>

</html>