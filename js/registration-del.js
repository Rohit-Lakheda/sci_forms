function show_cata() {
	if ( document.getElementById("Indian").checked == true) {
		$('.international-tariff').hide();
    	document.getElementById("paypal").checked = false;
		document.getElementById("gpay").checked = true;
		document.getElementById("Cc").checked = false;
		var valie = $('#sector').val();
		$('.indian-tariff').show();
    	//$('.del-type-con').show();
	} else if ( document.getElementById("Foreign").checked == true) {
		$('.international-tariff').show();
    	$('.indian-tariff').hide();
    	//$('.del-type-con').hide();
		//document.getElementById("Industry").checked = true;
		
    	document.getElementById("paypal").checked = true;
		document.getElementById("Cc").checked = false;
		document.getElementById("gpay").checked = false;
		
		$('.partner-del').show();
		$('.conference-del').hide();
	}
	//assignSingleDay();
}

function show_div_group_user() {
    if (document.getElementById("Single").checked == true) {
        document.getElementById("div_group_user").style.display = "none";
        document.getElementById('total_dele').value = '';
    } else if (document.getElementById("Group").checked == true) {
        document.getElementById("div_group_user").style.display = "block";
    } else {
    	document.getElementById("div_group_user").style.display = "none";
    	document.getElementById('total_dele').value = '';
    }
}
function show_div_type_reg()
{
    //alert(document.getElementById('Single_Day').checked);
	/*if(document.getElementById('Single_Day').checked==true)
	{
		document.getElementById('div_full_day').style.display='none';
		document.getElementById('div_single_day').style.display='block';	
        show_div_day_details();
	}
	else if(document.getElementById('Full_Day').checked==true)
	{
		document.getElementById('div_single_day').style.display='none';
		document.getElementById('div_full_day').style.display='block';		
	}	*/
	
	document.getElementById('div_single_day').style.display='block';	
    document.getElementById('div_full_day').style.display='none';   
	
}
function show_div_day_details()
{
    /*if(document.getElementById('day1').checked==true)
    {
        
        document.getElementById('secondday').style.display='none';
        document.getElementById('thirdday').style.display='none';
        document.getElementById('firstday').style.display='block';    
        
    }
    else*/ 
	if(document.getElementById('day2').checked==true)
    {
        
        //document.getElementById('firstday').style.display='none';
        document.getElementById('thirdday').style.display='none';
        document.getElementById('secondday').style.display='block';    
       
    }
    else if(document.getElementById('day3').checked==true)
    {
        
        document.getElementById('secondday').style.display='none';
       // document.getElementById('firstday').style.display='none';
        document.getElementById('thirdday').style.display='block';    
        
    }

}
function validate_registration_form_2() {
	/*if( document.getElementById("delegate-virtual").checked== false) {
		alert("Please select conference type.");
        document.getElementById("delegate-virtual").focus();
        return false;
	}*/
	if(document.getElementById("sector").value == "") {
		alert("Please select sector.");
        document.getElementById("sector").focus();
        return false;
	}
	if(document.getElementById("total_dele").value == "") {
		alert("Please select number of delegate(s).");
        document.getElementById("total_dele").focus();
        return false;
	}

	
	if ((document.getElementById("Indian").checked == false) && (document.getElementById("Foreign").checked == false)) {
        alert("Please select the Nationality type.");
        document.getElementById("Indian").focus();
        return false;
    }
	
	/*if(document.getElementById("Industry").checked == false && document.getElementById("Student").checked == false && document.getElementById("Poster").checked == false) {
    	alert("Please select delegate type.");
        document.getElementById("Industry").focus();
        return false;
    }*/
	var valie = $('#sector').val();
	if (document.getElementById("Indian").checked == true){// && valie == 'Bio Technology') {
		if(document.getElementById("event_know").value == "") {
			alert("Please select How do you know about Event.");
			document.getElementById("event_know").focus();
			return false;
		} else if(document.getElementById("event_know").value == "Others") {
			if(document.getElementById("other_value").value == "") {
				alert("Please enter other value of How do you know about Event.");
				document.getElementById("other_value").focus();
				return false;
			}
		}

	} else {
		/*$('#tech-div').hide();
		$('#genotypic-div').hide();*/
	}
    
	if (document.getElementById("Indian").checked == true) {
		if ((document.getElementById("Cc").checked == false) && (document.getElementById("gpay").checked == false)) {// && (document.getElementById("Cheque").checked == false) && (document.getElementById("BT").checked == false) && (document.getElementById("Dc").checked == false)) {
			alert("Please select the Payment Mode.");
			document.getElementById("Cc").focus();
			return false;
		}
	} else if (document.getElementById("Foreign").checked == true) {
		if ((document.getElementById("paypal").checked == false)) {
			alert("Please select the Payment Mode.");
			document.getElementById("paypal").focus();
			return false;
		}
	} 
    
    /*if(document.getElementById("g-recaptcha-response").value == "") {
		alert("Please re-enter your reCAPTCHA.");
		return false;
	}*/
    
    if (document.getElementById("vercodevp").value == "") {
        alert("Please fill the characters you see in image.");
        document.getElementById("vercodevp").focus();
        return false;
    } else if (document.getElementById("vercodevp").value != "") {
        compstr = document.getElementById("test").value;
        if (document.getElementById("vercodevp").value != compstr) {
            alert("Please fill correct characters you see in image.");
            document.getElementById("vercodevp").value = "";
            document.getElementById("vercodevp").focus();
            return false;
        }
    }
    
    //document.getElementById("reg_registration_form_1").submit();
    return true;
}

function showTxt() {
	if (document.getElementById("Indian").checked == false && document.getElementById("Foreign").checked == false) {
		alert("Please select the Nationality type.");
	}
}

function check_dele(e, txt) {
    var val = document.getElementById(txt).value;
    //alert(e.keyCode);
	if(e.keyCode === 48 ||e.keyCode === 96 ||e.keyCode === 49 || e.keyCode === 97 || e.keyCode === 56 || e.keyCode === 57 || e.keyCode === 104 || e.keyCode === 105 || isNaN(val)) {
		$('#del-error').show();
        //alert('Please enter only numbers!');
        document.getElementById(txt).value = '';
    } else {
    	$('#del-error').hide();
    }
}

function showDays() {
		if(document.getElementById("Full_Day").checked == true) {
			//$('#div_single_day').hide();
			if (document.getElementById("Foreign").checked == true) {
				$("#cata3").trigger('click');
			} else {
				$("#cata1").trigger('click');
			}
			$("#cata1").trigger('click');
		}else if(document.getElementById("3_days_speaker").checked == true) {
			//$('#div_single_day').hide();
			if (document.getElementById("Foreign").checked == true) {
				$("#cata6").trigger('click');
			} else {
				$("#cata5").trigger('click');
			}
		} else if(document.getElementById("3_days_power_bank").checked == true) {
			//$('#div_single_day').hide();
			if (document.getElementById("Foreign").checked == true) {
				$("#cata8").trigger('click');
			} else {
				$("#cata7").trigger('click');
			}
		}
	//}
}

function assignSingleDay() {
	if(document.getElementById("Industry").checked == true && document.getElementById("Indian").checked == true) {
		$('.main-tariff-table').show();
		$('.normal-cata').show();
		$('.poster-cata').hide();
		$('.indian-tariff').show();
		$('.international-tariff').hide();
		$('.partner-ind').show();
		$('.indian-tariff-1').hide();
		$('.partner-del').show();
		$('.conference-del').hide();
		//$('.attendee').hide();
		document.getElementById("pay").style.display="block";
	} else if(document.getElementById("Student").checked == true && document.getElementById("Indian").checked == true) {
		/*$('.main-tariff-table').show();
		$('.normal-cata').show();
		$('.poster-cata').hide();
		$('.indian-tariff').hide();
		$('.international-tariff').hide();
		$('.indian-tariff-1').show();
		$('.partner-del').hide();
		$('.conference-del').show();*/

		$('.main-tariff-table').show();
		$('.normal-cata').show();
		$('.poster-cata').hide();
		$('.indian-tariff').show();
		$('.international-tariff').hide();
		$('.partner-ind').hide();
		$('.indian-tariff-1').show();
		$('.partner-del').hide();
		$('.conference-del').show();
		//$('.attendee').hide();
		document.getElementById("pay").style.display="block";
	} else if(document.getElementById("Visitors").checked == true && document.getElementById("Indian").checked == true) {
		$('.normal-cata').show();
		$('.poster-cata').hide();
		$('.main-tariff-table').hide();
		$('.partner-del').hide();
		$('.conference-del').hide();
		//$('.attendee').show();
		document.getElementById("pay").style.display="none";
	} else if(document.getElementById("Industry").checked == true && document.getElementById("Foreign").checked == true){
		$('.main-tariff-table').show();
		$('.normal-cata').show();
		$('.poster-cata').hide();
		$('.indian-tariff').hide();
		$('.international-tariff').show();
		
		$('.partner-ind').hide();
		$('.indian-tariff-1').hide();
		//$('.partner-del').show();
		//$('.conference-del').hide();
		//$('.attendee').hide();
		document.getElementById("pay").style.display="block";
	} else if(document.getElementById("Student").checked == true && document.getElementById("Foreign").checked == true) {
		$('.main-tariff-table').show();
		$('.normal-cata').show();
		$('.poster-cata').hide();
		$('.indian-tariff').hide();
		$('.international-tariff').show();
		$('.indian-tariff-1').hide();
		$('.partner-del').hide();
		$('.conference-del').show();
		//$('.attendee').hide();
		document.getElementById("pay").style.display="block";
	} else if(document.getElementById("Visitors").checked == true && document.getElementById("Foreign").checked == true) {
		$('.main-tariff-table').hide();
		$('.normal-cata').show();
		$('.poster-cata').hide();
		$('.partner-del').hide();
		$('.conference-del').hide();
		//$('.attendee').show();
		document.getElementById("pay").style.display="none";
	}
	$('#total_dele').val('');
}

function showPromoCode() {
	/*if(document.getElementById("member_Yes").checked == true) {
		$('#genotypic-div').show();
	} else if (document.getElementById("member_No").checked == true) {
		$('#genotypic-div').hide();
	}*/
}
