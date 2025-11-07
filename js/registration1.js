function show_cata() {
    if (document.getElementById("Indian").checked == true) {
    	$('.international-tariff').hide();
    	$('.indian-tariff').show();
    	//$('#del_type').show();
    	$('#reg_type').show();
    	$('#div_single_day').show();
    	$('#Single_Day_button').show();
    	$("#Full_Day").trigger('click');
    	/*$("#cata1").trigger('click');
    	if($("#cata2").parent('span').hasClass("checked")) {
    		$("#cata2").trigger('click');
    	}
    	if($("#cata3").parent('span').hasClass("checked")) {
    		$("#cata3").trigger('click');
    	}
    	if($("#cata4").parent('span').hasClass("checked")) {
    		$("#cata4").trigger('click');
    	}
    	
    	document.getElementById("cata1").checked = true;
		document.getElementById("cata2").checked = false;
		document.getElementById("cata3").checked = false;
		document.getElementById("cata4").checked = false;*/
    	if(document.getElementById("Single_Day").checked == true) {
			if(document.getElementById("Industry").checked == true) {
				$("#cata3").trigger('click');
			} else {
				$("#cata4").trigger('click');
			}
		} else if(document.getElementById("Full_Day").checked == true) {
			$("#cata1").trigger('click');
		}
    } else if (document.getElementById("Foreign").checked == true) {
    	$('.international-tariff').show();
    	$('.indian-tariff').hide();
    	$("#Full_Day").trigger('click');
    	$("#cata2").trigger('click');
    	//$('#del_type').hide();
    	//$('#reg_type').hide();
    	$('#Single_Day_button').hide();
    	$('#div_single_day').hide();
    	//$("#Full_Day").prop("checked", true);
    	$("#Single_Day").prop("checked", false);
    	$('#day1').prop("checked", false);
		$('#day2').prop("checked", false);
		$('#day3').prop("checked", false);
    	/*$("#cata2").trigger('click');
    	if($("#cata1").parent('span').hasClass("checked")) {
    		$("#cata1").trigger('click');
    	}
    	if($("#cata3").parent('span').hasClass("checked")) {
    		$("#cata3").trigger('click');
    	}
    	if($("#cata4").parent('span').hasClass("checked")) {
    		$("#cata4").trigger('click');
    	}
    	
    	document.getElementById("cata2").checked = true;
		document.getElementById("cata1").checked = false;*/
    } else {
        alert("Please select the Nationality type.");
        document.getElementById("Indian").focus();
        return false;
    }
    
	if (document.getElementById("BT").checked == true) {
    	if (document.getElementById("Indian").checked == true) {
    		document.getElementById("credit_card").style.display = "none";
	        document.getElementById("debit_card").style.display = "none";
	        document.getElementById("bank_transfer1").style.display = "block";
	        document.getElementById("bank_transfer2").style.display = "none";
	        document.getElementById("cheque").style.display = "none";
    	} else if (document.getElementById("Foreign").checked == true) {
    		document.getElementById("credit_card").style.display = "none";
	        document.getElementById("debit_card").style.display = "none";
	        document.getElementById("bank_transfer2").style.display = "block";
	        document.getElementById("bank_transfer1").style.display = "none";
	        document.getElementById("cheque").style.display = "none";
    	}
    }
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
	if(document.getElementById('Single_Day').checked==true)
	{
		document.getElementById('div_full_day').style.display='none';
		document.getElementById('div_single_day').style.display='block';	
        show_div_day_details();
	}
	else if(document.getElementById('Full_Day').checked==true)
	{
		document.getElementById('div_single_day').style.display='none';
		document.getElementById('div_full_day').style.display='block';		
	}	
	
}
function show_div_day_details()
{
    if(document.getElementById('day1').checked==true)
    {
        
        document.getElementById('secondday').style.display='none';
        document.getElementById('thirdday').style.display='none';
        document.getElementById('firstday').style.display='block';    
        
    }
    else if(document.getElementById('day2').checked==true)
    {
        
        document.getElementById('firstday').style.display='none';
        document.getElementById('thirdday').style.display='none';
        document.getElementById('secondday').style.display='block';    
       
    }
    else if(document.getElementById('day3').checked==true)
    {
        
        document.getElementById('secondday').style.display='none';
        document.getElementById('firstday').style.display='none';
        document.getElementById('thirdday').style.display='block';    
        
    }

}
function validate_registration_form_2() {
	if(document.getElementById("total_dele").value == "") {
		alert("Please select number of delegate(s).");
        document.getElementById("total_dele").focus();
        return false;
	}
	
	var $assoc_name = document.getElementById("assoc_name").value;
	if($assoc_name != 'ABAI' && $assoc_name != 'Spread' && $assoc_name != 'KSRSAC' && $assoc_name != 'TiE Bangalore' && $assoc_name != 'YESSS Abstract Presenter' && $assoc_name != 'KBITS') {
	    if ((document.getElementById("Indian").checked == false) && (document.getElementById("Foreign").checked == false)) {
	        alert("Please select the Nationality type.");
	        document.getElementById("Indian").focus();
	        return false;
	    }
	}
    if(document.getElementById("Industry").checked == false && document.getElementById("Student").checked == false) {
    	alert("Please select delegate type.");
        document.getElementById("Industry").focus();
        return false;
    }
    if($assoc_name != 'ABAI' && $assoc_name != 'Spread' && $assoc_name != 'KSRSAC' && $assoc_name != 'TiE Bangalore' && $assoc_name != 'YESSS Abstract Presenter' && $assoc_name != 'KBITS') {
	    if (document.getElementById("Indian").checked == true) {
			if(document.getElementById("Single_Day").checked == false && document.getElementById("Full_Day").checked == false && document.getElementById("3_days_speaker").checked == false && document.getElementById("3_days_power_bank").checked == false) {
				alert("Please select type of registration.");
	            document.getElementById("Single_Day").focus();
	            return false;
			}
	    }
	    if (document.getElementById("Indian").checked == true) {
			if(document.getElementById("Single_Day").checked == true) {
				if(document.getElementById("day1").checked == false && document.getElementById("day2").checked == false && document.getElementById("day3").checked == false) {
					alert("Please select the at least one day.");
		            document.getElementById("day1").focus();
		            return false;
				}
			}
	    }
	    
	    if (document.getElementById("Foreign").checked == true) {
	    	if(document.getElementById("Full_Day").checked == false && document.getElementById("3_days_speaker").checked == false && document.getElementById("3_days_power_bank").checked == false) {
				alert("Please select type of registration.");
	            document.getElementById("Full_Day").focus();
	            return false;
			}
	    }
	    
	    if (document.getElementById("Indian").checked == true) {
	    	if(document.getElementById("cata1").checked == false && document.getElementById("cata3").checked == false && document.getElementById("cata4").checked == false && document.getElementById("cata5").checked == false && document.getElementById("cata7").checked == false) {
				alert("Please select type of registration.");
	            document.getElementById("Full_Day").focus();
	            return false;
			}
	    } else if (document.getElementById("Foreign").checked == true) {
	    	if(document.getElementById("cata2").checked == false && document.getElementById("cata6").checked == false && document.getElementById("cata8").checked == false) {
				alert("Please select type of registration.....");
	            document.getElementById("Full_Day").focus();
	            return false;
			}
	    }
    }
    
    /*if (document.getElementById("Indian").checked == true) {
        if ((document.getElementById("cata1").checked == false)) {
        	alert("Please select the Nationality type.");
            document.getElementById("Indian").focus();
            return false;
        }
    }
    if (document.getElementById("Foreign").checked == true) {
        if ((document.getElementById("cata2").checked == false)) {
        	alert("Please select the Nationality type.");
            document.getElementById("Foreign").focus();
            return false;
        }
    }*/

    /*if ((document.getElementById("Single").checked == false) && (document.getElementById("Group").checked == false)) {
        alert("Please select the Group type.");
        document.getElementById("Single").focus();
        return false;
    }
    if (document.getElementById("Group").checked == true) {
    	var total_dele = document.getElementById("total_dele").value;
        if (total_dele == "" || total_dele <= 1 || total_dele >= 8) {
            alert("Group Members Should be min. 2 & max. 7, including you.");
            document.getElementById("total_dele").focus();
            document.getElementById("total_dele").value = "";
            return false;
        }
    }*/
    if ((document.getElementById("Cc").checked == false) && (document.getElementById("Cheque").checked == false) && (document.getElementById("BT").checked == false) && (document.getElementById("Dc").checked == false)) {
        alert("Please select the Payment Mode.");
        document.getElementById("Cc").focus();
        return false;
    }
    
    if(document.getElementById("g-recaptcha-response").value == "") {
		alert("Please re-enter your reCAPTCHA.");
		return false;
	}
    //document.getElementById("reg_registration_form_1").submit();
    return true;
}

function showTxt() {
	if (document.getElementById("Indian").checked == false && document.getElementById("Foreign").checked == false) {
		alert("Please select the Nationality type.");
	} else {
	    if (document.getElementById("Cc").checked == true) {
	        document.getElementById("credit_card").style.display = "block";
	        document.getElementById("debit_card").style.display = "none";
	        document.getElementById("bank_transfer1").style.display = "none";
	        document.getElementById("bank_transfer2").style.display = "none";
	        document.getElementById("cheque").style.display = "none";
	
	    }
	    if (document.getElementById("Cheque").checked == true) {
	    	document.getElementById("credit_card").style.display = "none";
	        document.getElementById("debit_card").style.display = "none";
	        document.getElementById("bank_transfer1").style.display = "none";
	        document.getElementById("bank_transfer2").style.display = "none";
	        document.getElementById("cheque").style.display = "block";
	
	    }
	    if (document.getElementById("BT").checked == true) {
	    	if (document.getElementById("Indian").checked == true) {
	    		document.getElementById("credit_card").style.display = "none";
		        document.getElementById("debit_card").style.display = "none";
		        document.getElementById("bank_transfer1").style.display = "block";
		        document.getElementById("bank_transfer2").style.display = "none";
		        document.getElementById("cheque").style.display = "none";
	    	} else if (document.getElementById("Foreign").checked == true) {
	    		document.getElementById("credit_card").style.display = "none";
		        document.getElementById("debit_card").style.display = "none";
		        document.getElementById("bank_transfer2").style.display = "block";
		        document.getElementById("bank_transfer1").style.display = "none";
		        document.getElementById("cheque").style.display = "none";
	    	}
	    }
	    if (document.getElementById("Dc").checked == true) {
	    	document.getElementById("credit_card").style.display = "none";
	        document.getElementById("debit_card").style.display = "block";
	        document.getElementById("bank_transfer1").style.display = "none";
	        document.getElementById("bank_transfer2").style.display = "none";
	        document.getElementById("cheque").style.display = "none";
	    }
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
	var $assoc_name = document.getElementById("assoc_name").value;
	if($assoc_name != 'ABAI' && $assoc_name != 'Spread' && $assoc_name != 'KSRSAC' && $assoc_name != 'TiE Bangalore' && $assoc_name != 'YESSS Abstract Presenter' && $assoc_name != 'KBITS') {
		if(document.getElementById("Single_Day").checked == true) {
			$('#div_single_day').show();
			$('#day1').prop("checked", false);
			$('#day2').prop("checked", false);
			$('#day3').prop("checked", false);
			if(document.getElementById("Industry").checked == true) {
				$("#cata3").trigger('click');
			} else {
				$("#cata4").trigger('click');
			}
		} else if(document.getElementById("Full_Day").checked == true) {
			$('#div_single_day').hide();
			if (document.getElementById("Foreign").checked == true) {
				$("#cata2").trigger('click');
			} else {
				$("#cata1").trigger('click');
			}
		} else if(document.getElementById("3_days_speaker").checked == true) {
			$('#div_single_day').hide();
			if (document.getElementById("Foreign").checked == true) {
				$("#cata6").trigger('click');
			} else {
				$("#cata5").trigger('click');
			}
		} else if(document.getElementById("3_days_power_bank").checked == true) {
			$('#div_single_day').hide();
			if (document.getElementById("Foreign").checked == true) {
				$("#cata8").trigger('click');
			} else {
				$("#cata7").trigger('click');
			}
		}
	}
}

function assignSingleDay() {
	var $assoc_name = document.getElementById("assoc_name").value;
	//if($assoc_name != 'ABAI' && $assoc_name != 'Spread' && $assoc_name != 'KSRSAC' && $assoc_name != 'TiE Bangalore') {
		if (document.getElementById("Indian").checked == true) {
			if(document.getElementById("Single_Day").checked == true) {
				if(document.getElementById("Industry").checked == true) {
					$("#cata3").trigger('click');
				} else {
					$("#cata4").trigger('click');
				}
			} else if(document.getElementById("Full_Day").checked == true) {
				$("#cata1").trigger('click');
			}
		} else {
			$("#cata2").trigger('click');
		}
	//}
}