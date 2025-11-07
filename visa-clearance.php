<?php 	

	//echo "<script language='javascript'>window.location = 'enquiry.php';</script>";

	//exit;

	require "form_includes/form_constants_both.php";

	require "visa-clearance-captcha.php";

?>

<?php $pageStyleCss = '<link rel="stylesheet" type="text/css" href="forms_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css"/>';

require 'form_includes/reg_form_header.php';?>

<style>

	.selected-flag {

    	margin-top: -5px;

	}

</style>

<div class="row">

	<div class="col-md-12">

		<div class="portlet light bordered" id="registration_form_2">

			<div class="portlet-title">

				<div class="caption">

					<i class=" icon-layers font-red"></i>

					<span class="caption-subject font-red bold uppercase"><?php echo $EVENT_NAME . ' ' . $EVENT_YEAR;?> : VISA Clearance Registration

					</span>

				</div>

			</div>

			<div class="portlet-body form">

				<form action="visa-clearance2.php" class="form-horizontal" name="reg_registration_form_2" id="reg_registration_form_2" method="post" onsubmit="return validateEnquiry1223();">

					<div class="form-wizard">

						<div class="form-body">

							<ul class="nav nav-pills nav-justified steps">

								<li class="active">

									<a href="#" data-toggle="tab" class="step">

									<span class="number"> 1 </span>

									<span class="desc">

									<i class="fa fa-check"></i> Delegate Details </span>

									</a>

								</li>

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

									<div class="form-group">

										<label class="control-label col-md-3">Organisation Name <span class="dips-required"> * </span></label>

										<div class="col-md-6"><input type="text" class="form-control" name="org_name" id="org_name" required="required"></div>

									</div>

									<div class="form-group">

										<label class="control-label col-md-3">Designation  <span class="dips-required"> * </span></label>

										<div class="col-md-6"><input type="text" class="form-control" name="designation" id="designation" required="required"></div>

									</div>

									<div class="form-group">

										<label class="control-label col-md-3">Passport Name <span class="dips-required"> * </span></label>

										<div class="col-md-6"><input type="text" class="form-control" name="passport_name" id="passport_name" required="required"></div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Father's/ Husband's Name<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="father_name" id="father_name" required="required" />

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Date of Birth<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="date_of_birth" id="date_of_birth" required="required" readonly="readonly"/>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Place of Birth<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="place_of_birth" id="place_of_birth" required="required" />

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Nationality <span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<select id="nationality" name="nationality" class="form-control" required="required">

												<option value="">-- Select Nationality --</option>

												<?php $nationality = array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "Bosniaand Herzegowina", "BW" => "Botswana", "BV" => "BouvetIsland", "BR" => "Brazil", "IO" => "British Indian Ocean Territory", "BN" => "Brunei Darussalam", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "CapeVerde", "KY" => "Cayman Islands", "CF" => "CentralAfricanRepublic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "ChristmasIsland", "CC" => "Cocos Keeling Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo the Democratic Republicofthe", "CK" => "Cook Islands", "CR" => "CostaRica", "CI" => "Coted Ivoire", "HR" => "Croatia(Hrvatska)", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "Czech Republic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "Dominican Republic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "ElSalvador", "GQ" => "Equatorial Guinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "Falkland Islands Malvinas", "FO" => "FaroeIslands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "French Guiana", "PF" => "French Polynesia", "TF" => "French Southern Territories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heardand McDonald Islands", "VA" => "HolySee Vatican City State", "HN" => "Honduras", "HK" => "Hong Kong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran Islamic Republic", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea Democratic People Republic", "KR" => "Korea Republic", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "LaoPeoples Democratic Republic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libyan Arab Jamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macau", "MK" => "Macedonia The Former Yugoslav Republic", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia,FederatedStatesof", "MD" => "Moldova Republic", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "Netherlands Antilles", "NC" => "NewCaledonia", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "MP" => "Northern Mariana Islands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PA" => "Panama", "PG" => "Papua New Guinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "PuertoRico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "Russian Federation", "RW" => "Rwanda", "KN" => "Saint Kittsand Nevis", "LC" => "SaintLUCIA", "VC" => "Saint VincentandtheGrenadines", "WS" => "Samoa", "SM" => "SanMarino", "ST" => "Sa oTomeand Principe", "SA" => "Saudi Arabia", "SN" => "Senegal", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SK" => "Slovakia SlovakRepublic", "SI" => "Slovenia", "SB" => "Solomon Islands", "SO" => "Somalia", "ZA" => "South Africa", "GS" => "South Georgiaand the South Sandwich Islands", "ES" => "Spain", "LK" => "SriLanka", "SH" => "St.Helena", "PM" => "St.Pierreand Miquelon", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "Svalbardand Jan Mayen Islands", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "Syrian Arab Republic", "TW" => "Taiwan", "TJ" => "Tajikistan", "TZ" => "Tanzania United Republic", "TH" => "Thailand", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "TrinidadandTobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "Turksand Caicos Islands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "United Arab Emirates", "GB" => "United Kingdom", "US" => "United States", "UM" => "United States Minor Outlying Islands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "VietNam", "VG" => "VirginIslands British ", "VI" => "Virgin Islands U.S.", "WF" => "Wallisand Futuna Islands", "EH" => "Western Sahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe");

													foreach ($nationality as $country) {

														echo '<option value="' . $country . '">' . $country . '</option>';

													}

												?>

											</select>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Passport Number<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="" class="form-control" name="passport_number" id="passport_number" required="required" />

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Date of Issue<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="date_of_issue" id="date_of_issue" required="required" readonly="readonly"/>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Place of Issue<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="place_of_issue" id="place_of_issue" required="required" />

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Date of Expiry<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="date_of_expiry" id="date_of_expiry" required="required" readonly="readonly"/>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label"> Entry Date In India<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="entry_date" id="entry_date" required="required" readonly="readonly"/>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Exit Date From India<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="exit_date" id="exit_date" required="required" readonly="readonly"/>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Mobile Number <span class="dips-required"> * </span></label>

										<div class="col-md-2">

										<input type="text" class="form-control" name="mobileCountryCode" id="mobileCountryCode" list="countryCodes" placeholder="-Country Code-" maxlength="5">

<datalist id="countryCodes">

    <?php 

        $titleList = array('+1','+1242','+1246','+1264','+1268','+1284','+1340','+1345','+1441','+1473','+1649','+1664','+1670','+1671','+1684','+1758','+1767','+1784','+1787','+1809','+1829','+1868','+1869','+1876','+1939','+35818','+441481','+441534','+441624','+7','+20','+27','+30','+31','+32','+33','+34','+36','+39','+40','+41','+43','+44','+45','+46','+47','+48','+49','+51','+52','+53','+54','+55','+56','+57','+58','+60','+61','+62','+63','+64','+65','+66','+81','+82','+84','+86','+90','+91','+92','+93','+94','+95','+98','+211','+212','+212','+213','+216','+218','+220','+221','+222','+223','+224','+225','+226','+227','+228','+229','+230','+231','+232','+233','+234','+235','+236','+237','+238','+239','+240','+241','+242','+243','+244','+245','+246','+248','+249','+250','+251','+252','+253','+254','+255','+256','+257','+258','+260','+261','+262','+262','+263','+264','+265','+266','+267','+268','+269','+290','+291','+297','+298','+299','+350','+351','+352','+353','+354','+355','+356','+357','+358','+359','+370','+371','+372','+373','+374','+375','+376','+377','+378','+379','+380','+381','+382','+385','+386','+387','+389','+420','+421','+423','+500','+501','+502','+503','+504','+505','+506','+507','+508','+509','+590','+590','+590','+591','+592','+593','+594','+595','+596','+597','+598','+599','+599','+599','+670','+672','+673','+674','+675','+676','+677','+678','+679','+680','+681','+682','+683','+685','+686','+687','+688','+689','+690','+691','+692','+850','+852','+853','+855','+856','+870','+880','+886','+960','+961','+962','+963','+964','+965','+966','+967','+968','+970','+971','+972','+973','+974','+975','+976','+977','+992','+993','+994','+995','+996','+998');

        foreach ($titleList as $title) {

            echo '<option value="' . $title . '">' . $title . '</option>';

        }

    ?>

</datalist>

											<span class="help-block">+Country Code</span>

										</div>

										<div class="col-md-4">

											<input class="form-control" name="mobile" type="text" id="mobile" maxlength="12" required onkeyup="check_num(event, 'mobile');"/>

											<span class="help-block">Mobile Number</span>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Email<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="email" class="form-control" name="email" id="email" required="required" />

										</div>

									</div>

									<h4 class="col-md-offset-1 block">Address in Country of Residence</h4>

									<div class="form-group">

										<label class="col-md-3 control-label">Address 1<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<textarea name="addr1" id="addr1" rows="" cols="" required="required" class="form-control"></textarea>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Address 2</label>

										<div class="col-md-6">

											<textarea name="addr2" id="addr2" rows="" cols="" class="form-control"></textarea>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">City<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="city" id="city" required="required"/>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">State<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="state" id="state" required="required"/>

										</div>

									</div>

									<div class="form-group">

										<label class="control-label col-md-3"> Country <span class="required"> * </span>

										</label>

										<div class="col-md-6">

											<select id="country" name="country" class="form-control">

												<option value="">-- Select Country --</option>

												<?php $countryList = array (  0=>"Afghanistan",  1=>"Albania",  2=>"Algeria",  3=>"American Samoa",  4=>"Andorra",  5=>"Angola",  6=>"Antigua and Barbuda",  7=>"Argentina",  8=>"Armenia",  9=>"Aruba",  10=>"Australia",  11=>"Austria",  12=>"Azerbaijan",  13=>"Bahamas, The",  14=>"Bahrain",  15=>"Bangladesh",  16=>"Barbados",  17=>"Belarus",  18=>"Belgium",  19=>"Belize",  20=>"Benin",  21=>"Bermuda",  22=>"Bhutan",  23=>"Bolivia",  24=>"Bosnia and Herzegovina",  25=>"Botswana",  26=>"Brazil",  27=>"British Virgin Islands",  28=>"Brunei Darussalam",  29=>"Bulgaria",  30=>"Burkina Faso",  31=>"Burundi",  32=>"Cote d'Ivoire",  33=>"Cabo Verde",  34=>"Cambodia",  35=>"Cameroon",  36=>"Canada",  37=>"Cayman Islands",  38=>"Central African Republic",  39=>"Chad",  40=>"Channel Islands",  41=>"Chile",  42=>"China",  43=>"Colombia",  44=>"Comoros",  45=>"Congo, Dem. Rep",  46=>"Congo, Rep.",  47=>"Costa Rica",  48=>"Croatia",  49=>"Cuba",  50=>"Curacao",  51=>"Cyprus",  52=>"Czech Republic",  53=>"Denmark",  54=>"Djibouti",  55=>"Dominica",  56=>"Dominican Republic ",  57=>"Ecuador",  58=>"Egypt, Arab Rep.",  59=>"El Salvador",  60=>"Equatorial Guinea",  61=>"Eritrea",  62=>"Estonia",  63=>"Ethiopia",  64=>"Faroe Islands",  65=>"Fiji",  66=>"Finland",  67=>"France",  68=>"French Polynesia",  69=>"Gabon",  70=>"Gambia, The ",  71=>"Georgia",  72=>"Germany",  73=>"Ghana",  74=>"Gibraltar",  75=>"Greece",  76=>"Greenland",  77=>"Grenada",  78=>"Guam",  79=>"Guatemala",  80=>"Guinea ",  81=>"Guinea-Bissau",  82=>"Guyana",  83=>"Haiti",  84=>"Honduras",  85=>"Hong Kong SAR, China",  86=>"Hungary",  87=>"Iceland",  88=>"India",  89=>"Indonesia",  90=>"Iran, Islamic Rep.",  91=>"Iraq",  92=>"Ireland",  93=>"Isle of Man",  94=>"Israel",  95=>"Italy",  96=>"Jamaica",  97=>"Japan",  98=>"Jordan",  99=>"Kazakhstan",  100=>"Kenya",  101=>"Kiribati",  102=>"Korea, Dem. People's Rep.",  103=>"Korea, Rep.",  104=>"Kosovo",  105=>"Kuwait",  106=>"Kyrgyz Republic",  107=>"Lao PDR",  108=>"Latvia",  109=>"Lebanon",  110=>"Lesotho",  111=>"Liberia",  112=>"Libya",  113=>"Liechtenstein",  114=>"Lithuania",  115=>"Luxembourg",  116=>"Macao SAR, China",  117=>"Macedonia, FYR ",  118=>"Madagascar",  119=>"Malawi",  120=>"Malaysia",  121=>"Maldives",  122=>"Mali",  123=>"Malta",  124=>"Marshall Islands",  125=>"Mauritania",  126=>"Mauritius",  127=>"Mexico",  128=>"Micronesia, Fed. Sts.",  129=>"Moldova",  130=>"Monaco",  131=>"Mongolia",  132=>"Montenegro",  133=>"Morocco",  134=>"Mozambique",  135=>"Myanmar",  136=>"Namibia",  137=>"Nauru",  138=>"Nepal",  139=>"Netherlands",  140=>"New Caledonia",  141=>"New Zealand",  142=>"Nicaragua",  143=>"Niger",  144=>"Nigeria ",  145=>"Northern Mariana Islands",  146=>"Norway",  147=>"Oman",  148=>"Pakistan ",  149=>"Palau",  150=>"Panama",  151=>"Papua New Guinea ",  152=>"Paraguay",  153=>"Peru ",  154=>"Philippines",  155=>"Poland",  156=>"Portugal",  157=>"Puerto Rico",  158=>"Qatar",  159=>"Romania",  160=>"Russian Federation",  161=>"Rwanda",  162=>"Sao Tome and Principe",  163=>"Samoa",  164=>"San Marino",  165=>"Saudi Arabia",  166=>"Senegal",  167=>"Serbia",  168=>"Seychelles",  169=>"Sierra Leone",  170=>"Singapore",  171=>"Sint Maarten (Dutch part)",  172=>"Slovak Republic",  173=>"Slovenia",  174=>"Solomon Islands",  175=>"Somalia",  176=>"South Africa",  177=>"South Sudan",  178=>"Spain",  179=>"Sri Lanka",  180=>"St. Kitts and Nevis",  181=>"St. Lucia",  182=>"St. Martin (French part)",  183=>"St. Vincent & the Grenadines",  184=>"Sudan",  185=>"Suriname",  186=>"Swaziland",  187=>"Sweden",  188=>"Switzerland",  189=>"Syrian Arab Republic",  190=>"Taiwan, China",  191=>"Tajikistan",  192=>"Tanzania",  193=>"Thailand",  194=>"Timor-Leste",  195=>"Togo",  196=>"Tonga",  197=>"Trinidad and Tobago",  198=>"Tunisia",  199=>"Turkey",  200=>"Turkmenistan",  201=>"Turks and Caicos Islands",  202=>"Tuvalu",  203=>"Uganda",  204=>"Ukraine",  205=>"United Arab Emirates",  206=>"United Kingdom",  207=>"United States",  208=>"Uruguay",  209=>"Uzbekistan",  210=>"Vanuatu",  211=>"Venezuela, RB",  212=>"Vietnam",  213=>"Virgin Islands (U.S.)",  214=>"West Bank and Gaza",  215=>"Yemen, Rep.",  216=>"Zambia",  217=>"Zimbabwe");

													foreach ($countryList as $country) {

														echo '<option value="' . $country . '">' . $country . '</option>'; 

													}

													?>

											</select>

										</div>

									</div>

									<div class="form-group">

										<label class="col-md-3 control-label">Postal Code<span class="dips-required"> * </span></label>

										<div class="col-md-6">

											<input type="text" class="form-control" name="pin" id="pin" required="required"/>

										</div>

									</div>

									<div class="form-group">

			                        	<label class="col-md-3 control-label">Enter text see in the image <span class="dips-required"> * </span></label>

			                            <div class="col-md-6">

			                            	<div class="input-group">

												<input name="vercode" type="text" class="form-control" id="vercode" maxlength="10" required autocomplete="off"/>

												<input name="test" type="hidden" id="test" value="<?php echo $_SESSION["vercode_visa"];?>" />

				  								<span class="input-group-addon" style="background-image: url('images/verify_img_bg.JPG'); text-align: center; font-size: 32px; padding: 0 15px 1px;"><?php echo $_SESSION["vercode_visa"];?></span>

											</div>

			                    		</div>

			                    	</div>

									<div class="form-actions">

										<div class="row">

											<div class="col-md-offset-3 col-md-9">

												<button type="submit" class="btn sbold uppercase green-jungle"> Submit

												<i class="fa fa-angle-right"></i>

												</button>

											</div>

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

<?php require 'form_includes/reg_form_footer.php';?>

<script type="text/javascript" src="forms_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>

	jQuery(document).ready(function() {  

		Registration.init('registration_form_2', 0);



		$("#date_of_birth").datepicker({

            autoclose: !0,

            format: "dd-mm-yyyy",

            endDate: '+0d'

        });

        

		$("#date_of_issue").datepicker({

            autoclose: !0,

            format: "dd-mm-yyyy",

            endDate: '+0d'

        });

        

		$("#date_of_expiry").datepicker({

            autoclose: !0,

            format: "dd-mm-yyyy",

            startDate: '+0d'

        });

        

		$("#entry_date").datepicker({

            autoclose: !0,

            format: "dd-mm-yyyy",

            startDate: '+0d'

        });

        

		$("#exit_date").datepicker({

            autoclose: !0,

            format: "dd-mm-yyyy",

            startDate: '+0d'

        });

	});



	function validateEnquiry1223() {

		if (document.getElementById("org_name").value == "") {

	        alert("Please fill your Organisation Name!");

	        document.getElementById("org_name").focus();

	        return false;

	    }

		if (document.getElementById("designation").value == "") {

	        alert("Please fill your designation!");

	        document.getElementById("designation").focus();

	        return false;

	    }

		if (document.getElementById("passport_name").value == "") {

	        alert("Please fill your Passport Name!");

	        document.getElementById("passport_name").focus();

	        return false;

	    }

		if (document.getElementById("father_name").value == "") {

	        alert("Please fill your Father's/ Husband's Name!");

	        document.getElementById("father_name").focus();

	        return false;

	    }

		if (document.getElementById("date_of_birth").value == "") {

	        alert("Please fill your Date of Birth!");

	        document.getElementById("date_of_birth").focus();

	        return false;

	    }

		if (document.getElementById("place_of_birth").value == "") {

	        alert("Please fill your Place of Birth!");

	        document.getElementById("place_of_birth").focus();

	        return false;

	    }

		if (document.getElementById("nationality").value == "") {

	        alert("Please fill your Nationality!");

	        document.getElementById("nationality").focus();

	        return false;

	    }

		if (document.getElementById("passport_number").value == "") {

	        alert("Please fill your Passport Number!");

	        document.getElementById("passport_number").focus();

	        return false;

	    }

		if (document.getElementById("date_of_issue").value == "") {

	        alert("Please fill your Date of Issue!");

	        document.getElementById("date_of_issue").focus();

	        return false;

	    }

		if (document.getElementById("place_of_issue").value == "") {

	        alert("Please fill your Place of Issue!");

	        document.getElementById("place_of_issue").focus();

	        return false;

	    }

		if (document.getElementById("date_of_expiry").value == "") {

	        alert("Please fill your Date of Expiry!");

	        document.getElementById("date_of_expiry").focus();

	        return false;

	    }

		if (document.getElementById("entry_date").value == "") {

	        alert("Please fill your Entry Date In India!");

	        document.getElementById("entry_date").focus();

	        return false;

	    }

		if (document.getElementById("exit_date").value == "") {

	        alert("Please fill your Exit Date From India!");

	        document.getElementById("exit_date").focus();

	        return false;

	    }

		if (document.getElementById("mobileCountryCode").value == "") {

	        alert("Please Select Country Code!");

	        document.getElementById("mobileCountryCode").focus();

	        return false;

	    }

		if (document.getElementById("mobile").value == "") {

	        alert("Please fill your Mobile Number!");

	        document.getElementById("mobile").focus();

	        return false;

	    }

		if (document.getElementById("email").value == "") {

	        alert("Please fill your Email!");

	        document.getElementById("email").focus();

	        return false;

	    } else if (document.getElementById("email").value != "") {

	        var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	        var toArr = document.getElementById("email").value.split(","); //split into array

	        for (var i = 0; i < toArr.length; i++)  {

	            if (!toArr[i].match(reg))  {

	                alert("Invalid email address \n" + toArr[i] + '!');

	                document.getElementById("email").focus();

	                return false;

	            }

	        }

	    }

		if (document.getElementById("addr1").value == "") {

	        alert("Please fill your Address 1!");

	        document.getElementById("addr1").focus();

	        return false;

	    }

		if (document.getElementById("city").value == "") {

	        alert("Please fill your City!");

	        document.getElementById("city").focus();

	        return false;

	    }

		if (document.getElementById("state").value == "") {

	        alert("Please fill your State!");

	        document.getElementById("state").focus();

	        return false;

	    }

		if (document.getElementById("country").value == "") {

	        alert("Please fill your Country!");

	        document.getElementById("country").focus();

	        return false;

	    }

		if (document.getElementById("pin").value == "") {

	        alert("Please fill your Postal Code!");

	        document.getElementById("pin").focus();

	        return false;

	    }

		   

	    if(document.getElementById("vercode").value == "") {

			alert("Please enter text see in the image.");

			document.getElementById("vercode").focus();

			return false;

		} else {

			if(document.getElementById("vercode").value != document.getElementById("test").value) {

				alert("Please enter correct text see in the image.");

				document.getElementById("vercode").value = '';

				document.getElementById("vercode").focus();

				return false;

			}

		}



		return true;

	}

</script>

</body>

</html>