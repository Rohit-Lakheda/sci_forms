function validate_poster_form() {
	if (document.getElementById("sector").value == "") {
		alert("Please select sector");
		document.getElementById("sector").focus();
		return false;
	}
	
	if (document.getElementById("title").value == "") {
		alert("Please Enter Title of Poster");
		document.getElementById("title").focus();
		return false;
	}

	if (document.getElementById("lead_name").value == "") {
		alert("Please Enter Lead Author Name ");
		document.getElementById("lead_name").focus();
		return false;
	}
	if (document.getElementById("lead_email").value == "") {
		alert("Please Enter Lead Author Email ");
		document.getElementById("lead_email").focus();
		return false;
	}

	if (document.getElementById("lead_org").value == "") {
		alert("Please Enter Lead Author Organisation ");
		document.getElementById("lead_org").focus();
		return false;
	}
	if (document.getElementById("lead_ccode").value == "") {
		alert("Please Enter Country-Code ");
		document.getElementById("lead_ccode").focus();
		return false;
	}
	if (document.getElementById("lead_acode").value == "") {
		alert("Please Enter Area Code");
		document.getElementById("lead_acode").focus();
		return false;
	}
	if (document.getElementById("lead_phone").value == "") {
		alert("Please Enter Phone Number.");
		document.getElementById("lead_phone").focus();
		return false;
	}
	if (document.getElementById("lead_mob").value == "") {
		alert("Please Enter Mobile Number.");
		document.getElementById("lead_mob").focus();
		return false;
	}

	if (document.getElementById("lead_addr").value == "")

	{
		alert("Please Enter Lead Author Address.");
		document.getElementById("lead_addr").focus();
		return false;
	}

	if (document.getElementById("lead_city").value == "") {
		alert("Please Enter Lead Author City ");
		document.getElementById("lead_city").focus();
		return false;
	}

	if (document.getElementById("lead_state").value == "") {
		alert("Please Enter Lead Author State");
		document.getElementById("lead_state").focus();
		return false;
	}

	if (document.getElementById("lead_country").value == "") {
		alert("Please Enter Lead Country ");
		document.getElementById("lead_country").focus();
		return false;
	}

	if (document.getElementById("lead_zip").value == "") {
		alert("Please Enter Zip/Postal Code.");
		document.getElementById("lead_zip").focus();
		return false;
	}
	if (document.getElementById("pp_name").value == "") {
		alert("Please Enter Poster Presenter Name");
		document.getElementById("pp_name").focus();
		return false;
	}
	if (document.getElementById("pp_email").value == "") {
		alert("Please Enter Poster Presenter Author Email");
		document.getElementById("pp_email").focus();
		return false;
	}

	if (document.getElementById("pp_org").value == "") {
		alert("Please Enter Poster Presenter Organisation Name");
		document.getElementById("pp_org").focus();
		return false;
	}
	if (document.getElementById("pp_ccode").value == "") {
		alert("Please Enter Country Code.");
		document.getElementById("pp_ccode").focus();
		return false;
	}
	if (document.getElementById("pp_acode").value == "") {
		alert("Please Enter Area Code");
		document.getElementById("pp_acode").focus();
		return false;
	}
	if (document.getElementById("pp_phone").value == "") {
		alert("Please Enter Poster Presenter Phone Number");
		document.getElementById("pp_phone").focus();
		return false;
	}
	if (document.getElementById("pp_mob").value == "") {
		alert("Please Enter Poster Presenter Mobile Number");
		document.getElementById("pp_mob").focus();
		return false;
	}
	if (document.getElementById("pp_addr").value == "") {
		alert("Please Enter Poster Presenter Address.");
		document.getElementById("pp_addr").focus();
		return false;
	}
	if (document.getElementById("pp_city").value == "") {
		alert("Please Enter Poster Presenter City.");
		document.getElementById("pp_city").focus();
		return false;
	}
	if (document.getElementById("pp_state").value == "") {
		alert("Please Enter Poster Presenter state");
		document.getElementById("pp_state").focus();
		return false;
	}
	if (document.getElementById("pp_country").value == "") {
		alert("Please Enter Poster Presenter Country.");
		document.getElementById("pp_country").focus();
		return false;
	}
	if (document.getElementById("pp_zip").value == "") {
		alert("Please Enter Zip Code.");
		document.getElementById("pp_zip").focus();
		return false;
	}

	var i_them_cnt_desel = 0;
	for (var i_them_cnt = 1; i_them_cnt <= 8; i_them_cnt++) {

		/*if (document.getElementById("theme" + i_them_cnt).checked == false) {
			i_them_cnt_desel = i_them_cnt_desel + 1;

		}*/

	}

	/*if (i_them_cnt_desel >= 8) {
		alert("Please Select One Focus Area.");
		document.getElementById("theme1").focus();
		return false;
	}*/
	
	/*if(document.getElementById("theme8").checked==true) {
		if (document.getElementById("othrdiv").value == "") {
			alert("Please Specify Other value.");
			document.getElementById("othrdiv").focus();
			return false;
		}
	}*/
	if (document.getElementById("sess_abstract").value == "") {
		alert("Please upload Abstract file.");
		document.getElementById("sess_abstract").focus();
		return false;
	}
	if (document.getElementById("lead_auth_cv").value == "") {
		alert("Please upload Lead Author CV");
		document.getElementById("lead_auth_cv").focus();
		return false;
	}
	
	if(document.getElementById("Cc").checked==false && document.getElementById("cashfree").checked==false && document.getElementById("BT").checked==false && document.getElementById("paypal").checked==false) {
		alert("Please select payment mode.");
		document.getElementById("cashfree").focus();
		return false;
	}
	
	if (document.getElementById("vercode").value == "") {
		alert("Please fill the characters you see in image.");
		document.getElementById("vercode").focus();
		return false;
	} else if (document.getElementById("vercode").value != "") {
		compstr = document.getElementById("test").value;
		if (document.getElementById("vercode").value != compstr) {
			alert("Please fill correct characters you see in image.");
			document.getElementById("vercode").value = "";
			document.getElementById("vercode").focus();
			return false;
		}
	}

	return true;
}

function cpy_lead_auth() {
	if (document.getElementById("lead_presenter_same").checked == true) {

		document.getElementById("pp_name").value = document
				.getElementById("lead_name").value;
		document.getElementById("pp_email").value = document
				.getElementById("lead_email").value;
		document.getElementById("pp_org").value = document
				.getElementById("lead_org").value;
		document.getElementById("pp_ccode").value = document
				.getElementById("lead_ccode").value;
		document.getElementById("pp_acode").value = document
				.getElementById("lead_acode").value;
		document.getElementById("pp_phone").value = document
				.getElementById("lead_phone").value;
		document.getElementById("pp_mob").value = document
				.getElementById("lead_mob").value;
		document.getElementById("pp_addr").value = document
				.getElementById("lead_addr").value;
		document.getElementById("pp_city").value = document
				.getElementById("lead_city").value;
		document.getElementById("pp_state").value = document
				.getElementById("lead_state").value;
		document.getElementById("pp_country").value = document
				.getElementById("lead_country").value;
		document.getElementById("pp_zip").value = document
				.getElementById("lead_zip").value;

	} else {
		document.getElementById("pp_name").value = "";
		document.getElementById("pp_email").value = "";
		document.getElementById("pp_org").value = "";
		document.getElementById("pp_ccode").value = "";
		document.getElementById("pp_acode").value = "";
		document.getElementById("pp_phone").value = "";
		document.getElementById("pp_mob").value = "";
		document.getElementById("pp_addr").value = "";
		document.getElementById("pp_city").value = "";
		document.getElementById("pp_state").value = "";
		document.getElementById("pp_country").value = "";
		document.getElementById("pp_zip").value = "";

	}
}

function cpy_co_auth_same() {

	if (document.getElementById("co_auth_same").checked == true) {

		document.getElementById("acc_co_auth_name_1").value = document
				.getElementById("co_auth_name_1").value;
		document.getElementById("acc_co_auth_name_2").value = document
				.getElementById("co_auth_name_2").value;
		document.getElementById("acc_co_auth_name_3").value = document
				.getElementById("co_auth_name_3").value;
		document.getElementById("acc_co_auth_name_4").value = document
				.getElementById("co_auth_name_4").value;

	} else {
		document.getElementById("acc_co_auth_name_1").value = "";
		document.getElementById("acc_co_auth_name_2").value = "";
		document.getElementById("acc_co_auth_name_3").value = "";
		document.getElementById("acc_co_auth_name_4").value = "";

	}
}

function other_div() {
	if(document.getElementById("theme8").checked==true) {
		document.getElementById("othr").style.display = "block";
	} else {
		document.getElementById("othr").style.display = "none";
	}
}