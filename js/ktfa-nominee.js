function showYesValue() {
	/*var contributed_csr_initiatives = document.getElementById("contributed_csr_initiatives").value;
	if (contributed_csr_initiatives == 'Yes') {
		$('#soft_copy_csr_initiatives').removeAttr('disabled');
	} else {
		$('#soft_copy_csr_initiatives').attr('disabled', 'disabled');
	}
	$('#word_left3').text('100');
	$('#display_count3').text('0');
	$('#soft_copy_csr_initiatives').val('');*/
}

function showYesValueRnD() {
	var invested_significant_innovation_rnd = document.getElementById("invested_significant_innovation_rnd").value;
	if (invested_significant_innovation_rnd == 'Yes') {
		$('#percentage-innovation-rnd-div').show();
		$('#what_form_of_rnd').removeAttr('disabled');
	} else {
		$('#percentage-innovation-rnd-div').hide();
		$('#what_form_of_rnd').attr('disabled', 'disabled');
	}
	$('#display_count2').text('0');
	$('#word_left2').text('200');
	$('#percentage_invested_significant_innovation_rnd').val('');
	$('#what_form_of_rnd').val('');
}

function disabledCheckbox() {
	
	if(document.getElementById("what_factor_part_of_sustainability5").checked == true) {
		//alert(document.getElementById("what_factor_part_of_sustainability5").checked);
		$('#uniform-what_factor_part_of_sustainability1').children().removeClass();
		$('#uniform-what_factor_part_of_sustainability2').children().removeClass();
		$('#uniform-what_factor_part_of_sustainability3').children().removeClass();
		$('#uniform-what_factor_part_of_sustainability4').children().removeClass();
		document.getElementById("what_factor_part_of_sustainability1").checked = false;
		document.getElementById("what_factor_part_of_sustainability2").checked = false;
		document.getElementById("what_factor_part_of_sustainability3").checked = false;
		document.getElementById("what_factor_part_of_sustainability4").checked = false;
	}
}

function uncheckNoneCheckbox() {
	//alert('ok');
	$('#uniform-what_factor_part_of_sustainability5').children().removeClass();
	document.getElementById("what_factor_part_of_sustainability5").checked = false;
}

function showPromoterDiv() {
	var invested_significant_innovation_rnd = document.getElementById("personal_wealth_promoter").value;
	if (invested_significant_innovation_rnd == 'Yes') {
		$('#percentage_promoter').removeAttr('disabled');
	} else {
		$('#percentage_promoter').attr('disabled', 'disabled');
	}
	$('#percentage_promoter').val('');
}

function validate_reg_registration_form_1() {
	if(document.getElementById("org").value == "") {
		alert("Please enter Name of Company.");
        document.getElementById("org").focus();
		return false;
	}
	if(document.getElementById("org_type").value == "") {
		alert("Please enter Type of Company.");
        document.getElementById("org_type").focus();
		return false;
	}
	//alert(document.getElementById("date_incorporation").value);
	if(document.getElementById("date_incorporation").value == "") {
		alert("Please enter Date of Incorporation.");
        document.getElementById("date_incorporation").focus();
		return false;
	}
	if(document.getElementById("business_concept").value == "") {
		alert("Please enter Business Concept.");
        document.getElementById("business_concept").focus();
		return false;
	}
	if(document.getElementById("city_registered_ofc").value == "") {
		alert("Please enter City/ Region of Registered Office within Karnataka.");
        document.getElementById("city_registered_ofc").focus();
		return false;
	}
	if(document.getElementById("city_corporate_ofc").value == "") {
		alert("Please enter City/ Region of Corporate Office within Karnataka.");
        document.getElementById("city_corporate_ofc").focus();
		return false;
	}
	
	if(document.getElementById("dir_name").value == "") {
		alert("Please enter Name of Director / Proprietor / Promoter.");
        document.getElementById("dir_name").focus();
		return false;
	}
	if(document.getElementById("dir_desig").value == "") {
		alert("Please enter Designation of Director / Proprietor / Promoter.");
        document.getElementById("dir_desig").focus();
		return false;
	}
	if ((document.getElementById("dir_gender1").checked == false) && (document.getElementById("dir_gender2").checked == false)) {
		alert("Please selct Gender of Director / Proprietor / Promoter.");
        document.getElementById("dir_email").focus();
		return false;
	}
	
	if(document.getElementById("dir_email").value == "") {
		alert("Please enter Email Address of Director / Proprietor / Promoter.");
        document.getElementById("dir_email").focus();
		return false;
	}
	if(document.getElementById("dir_code").value == "") {
		alert("Please enter Country Code of Director / Proprietor / Promoter.");
        document.getElementById("dir_code").focus();
		return false;
	}
	if(document.getElementById("dir_mob").value == "") {
		alert("Please enter Mobile number of Director / Proprietor / Promoter.");
        document.getElementById("dir_mob").focus();
		return false;
	}
	
	if(document.getElementById("award_co_name").value == "") {
		alert("Please enter Name of Award Co-ordinator.");
        document.getElementById("award_co_name").focus();
		return false;
	}
	if(document.getElementById("award_co_desig").value == "") {
		alert("Please enter Designation of Award Co-ordinator.");
        document.getElementById("award_co_desig").focus();
		return false;
	}
	if ((document.getElementById("award_co_gender1").checked == false) && (document.getElementById("award_co_gender2").checked == false)) {
		alert("Please selct Gender of Award Co-ordinator.");
        document.getElementById("dir_email").focus();
		return false;
	}
	
	if(document.getElementById("award_co_email").value == "") {
		alert("Please enter Email Address of Award Co-ordinator.");
        document.getElementById("award_co_email").focus();
		return false;
	}
	if(document.getElementById("award_co_code").value == "") {
		alert("Please enter Country Code of Award Co-ordinator.");
        document.getElementById("award_co_code").focus();
		return false;
	}
	if(document.getElementById("award_co_mob").value == "") {
		alert("Please enter Mobile number of Award Co-ordinator.");
        document.getElementById("award_co_mob").focus();
		return false;
	}
	if(document.getElementById("tech_category").value == "") {
		alert("Please select Category Under Technology.");
        document.getElementById("tech_category").focus();
		return false;
	}
	if(document.getElementById("turnover_fy_2015").value == "") {
		alert("Please enter Financials (turnover) of FY 2015.");
        document.getElementById("turnover_fy_2015").focus();
		return false;
	}
	if(document.getElementById("turnover_fy_2016").value == "") {
		alert("Please enter Financials (turnover) of FY 2016.");
        document.getElementById("turnover_fy_2016").focus();
		return false;
	}
	if(document.getElementById("percentage_emp_karnataka").value == "") {
		alert("Please select percentage of employees within Karnataka.");
        document.getElementById("percentage_emp_karnataka").focus();
		return false;
	}
	if(document.getElementById("avg_growth_emp").value == "") {
		alert("Please select average growth in number of employees in the last 1 year with 2015 as the base year.");
        document.getElementById("avg_growth_emp").focus();
		return false;
	}
	if(document.getElementById("percentage_emp_compensation").value == "") {
		alert("Please select percentage of employment compensation provided to employees within Karnataka.");
        document.getElementById("percentage_emp_compensation").focus();
		return false;
	}
	if(document.getElementById("contributed_csr_initiatives").value == "") {
		alert("Please select Have you contributed in some way or been recognized for any of your CSR initiatives.");
        document.getElementById("contributed_csr_initiatives").focus();
		return false;
	}
	//alert(document.getElementById("contributed_csr_initiatives").value);
	/*if(document.getElementById("contributed_csr_initiatives").value == "Yes") {
		if(document.getElementById("soft_copy_csr_initiatives").value == "") {
			alert("Provide details for the same and share soft copies of any documents you may have as proof of activity.");
	        document.getElementById("soft_copy_csr_initiatives").focus();
			return false;
		}
	}*/
	if(document.getElementById("invested_significant_innovation_rnd").value == "") {
		alert("Please select Have you invested a significant part of your earning into innovation and R&D.");
        document.getElementById("invested_significant_innovation_rnd").focus();
		return false;
	}
	
	if(document.getElementById("invested_significant_innovation_rnd").value == "Yes") {
		if(document.getElementById("percentage_invested_significant_innovation_rnd").value == "") {
			alert("Please mention percentage of earning invested in R&D.");
	        document.getElementById("percentage_invested_significant_innovation_rnd").focus();
			return false;
		}
		if(document.getElementById("what_form_of_rnd").value == "") {
			alert("Please describe what form of R&D and how it would enhance your business.");
	        document.getElementById("what_form_of_rnd").focus();
			return false;
		}
	}
	
	if ((document.getElementById("what_factor_part_of_sustainability1").checked == false) && (document.getElementById("what_factor_part_of_sustainability2").checked == false)
		&& (document.getElementById("what_factor_part_of_sustainability3").checked == false) && (document.getElementById("what_factor_part_of_sustainability4").checked == false)
		&& (document.getElementById("what_factor_part_of_sustainability5").checked == false)) {
        alert("Please select What factors does your organization consider as a part of sustainability.");
        document.getElementById("what_factor_part_of_sustainability1").focus();
        return false;
    }
	if(document.getElementById("org_commitment_to_sustainability").value == "") {
		alert("Please select How has your organization's commitment to sustainability - in terms of management attention and investment - changed in the past year.");
        document.getElementById("org_commitment_to_sustainability").focus();
		return false;
	}
	if(document.getElementById("personal_wealth_promoter").value == "") {
		alert("Please select personal wealth of the promoter invested for this initiative.");
        document.getElementById("personal_wealth_promoter").focus();
		return false;
	}
	
	if (document.getElementById("personal_wealth_promoter").value == 'Yes') {
		if(document.getElementById("percentage_promoter").value == "") {
			alert("Please select percentage of personal / promoter investment in the initiative.");
	        document.getElementById("percentage_promoter").focus();
			return false;
		}
	}
	
	if(document.getElementById("5_yr_growth_projection").value == "") {
		alert("Please select revenues of FY 15 as the base, please specify what would be the 5 year growth projection based on your current growth plan.");
        document.getElementById("5_yr_growth_projection").focus();
		return false;
	}
	if(document.getElementById("awards_achievements_external_recognition").value == "") {
		alert("Please mention any of your organisation's achievements in the past 2 years.");
        document.getElementById("awards_achievements_external_recognition").focus();
		return false;
	}
	
    if ((document.getElementById("i_agree").checked == false)) {
        alert("Please select terms and conditions checkbox.");
        document.getElementById("i_agree").focus();
        return false;
    }

    if(document.getElementById("g-recaptcha-response").value == "") {
		alert("Please re-enter your reCAPTCHA.");
		return false;
	}
    //document.getElementById("reg_registration_form_1").submit();
    return true;
}