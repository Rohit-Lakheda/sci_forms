function show_cata() {

	/*if(document.getElementById("Single_Day").checked == true) {

		$("#cata2").trigger('click');

	}*/ /*else if(document.getElementById("Full_Day").checked == true) {

		$("#cata1").trigger('click');

	}*/

	

	if ( document.getElementById("Indian").checked == true) {

		$('.international-tariff').hide();

    	//$('.indian-tariff').show();

    	//$('.indian-tariff-1').show();

    	/*document.getElementById("paypal").checked = false;

		document.getElementById("gpay").checked = true;

		document.getElementById("Cc").checked = false;

		var valie = $('#sector').val();*/

		

		$('.indian-tariff').show();

		

		/*if(document.getElementById("member_Yes").checked == true) {

			$('#genotypic-div').show();

		} else if (document.getElementById("member_No").checked == true) {

			$('#genotypic-div').hide();

		}*/

		

    	$('.del-type-con').show();

	} else if ( document.getElementById("Foreign").checked == true) {

		$('.international-tariff').show();

    	$('.indian-tariff').hide();

    	/*$('.del-type-con').hide();

		document.getElementById("Industry").checked = true;

		

    	document.getElementById("paypal").checked = true;

		document.getElementById("Cc").checked = false;

		document.getElementById("gpay").checked = false;

		

		$('.partner-del').show();

		$('.conference-del').hide();*/



    	//$('.indian-tariff-1').hide();

		//$('#tech-div').hide();

		//$('#genotypic-div').hide();

	}

	/*else if(document.getElementById("delegate-virtual").checked == true && document.getElementById("Indian").checked == true){

		$('.international-tariff').hide();

		$('.international-tariff-v').hide();

    	$('.indian-tariff-v').show();

    	document.getElementById("paypal").checked = false;

	} else if (document.getElementById("delegate-virtual").checked == true && document.getElementById("Foreign").checked == true) {

		$('.international-tariff').show();

		$('.international-tariff-v').show();

    	$('.indian-tariff-v').hide();

		//$('#tech-div').hide();

		//$('#genotypic-div').hide();

	}*/

    /*if (document.getElementById("Indian").checked == true) {

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

		document.getElementById("cata4").checked = false;*\

    	if(document.getElementById("Single_Day").checked == true) {

			/*if(document.getElementById("Industry").checked == true) {

				$("#cata3").trigger('click');

			} else {

				$("#cata4").trigger('click');

			}*\

    		$("#cata2").trigger('click');

		} else if(document.getElementById("Full_Day").checked == true) {

			$("#cata1").trigger('click');

		}

    } else if (foreignEl && foreignEl.checked == true) {

    	$('.international-tariff').show();

    	$('.indian-tariff').hide();

    	$("#Full_Day").trigger('click');

    	$("#cata3").trigger('click');

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

		document.getElementById("cata1").checked = false;*\

    } else {

        alert("Please select the Nationality type.");

        document.getElementById("Indian").focus();

        return false;

    }*/

    

	/*if (document.getElementById("BT").checked == true) {

    	if (indianEl && indianEl.checked == true) {

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

    }*/

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

	// Declare all element references at the top
	var sectorEl = document.getElementById("sector");
	var indianEl = document.getElementById("Indian");
	var foreignEl = document.getElementById("Foreign");
	var fullDayEl = document.getElementById("Full_Day");
	if(sectorEl && sectorEl.value == "") {

		alert("Please select sector.");

        sectorEl.focus();

        return false;

	}

	var orgRegTypeEl = document.getElementById("org_reg_type");
	if(orgRegTypeEl && orgRegTypeEl.value == "") {

		alert("Please select Organisation Type.");

        orgRegTypeEl.focus();

        return false;

	}

	var totalDeleEl = document.getElementById("total_dele");
	if(totalDeleEl && totalDeleEl.value == "") {

		alert("Please select number of delegate(s).");

        totalDeleEl.focus();

        return false;

	}

	if(assoc_name != '') {

		if(assoc_name == 'Faculty') {

			if(document.getElementById("member_of_assoc").value == "") {

				alert("Please select Faculty.");

				document.getElementById("member_of_assoc").focus();

				return false;

			}

		}

		if(assoc_name == 'Program-Coordinators') {

			if(document.getElementById("member_of_assoc").value == "") {

				alert("Please select Program Coordinators.");

				document.getElementById("member_of_assoc").focus();

				return false;

			}

		}

	}



	

	if (indianEl && foreignEl && (indianEl.checked == false) && (foreignEl.checked == false)) {

        alert("Please select the Nationality type.");

        indianEl.focus();

        return false;

    }

	

	/*if(document.getElementById("Industry").checked == false && document.getElementById("Student").checked == false && document.getElementById("Poster").checked == false) {

    	alert("Please select delegate type.");

        document.getElementById("Industry").focus();

        return false;

    }*/

	var valie = $('#sector').val();

	if (indianEl && indianEl.checked == true){// && valie == 'Bio Technology') {

		/*if(document.getElementById("member_Yes").checked == false && document.getElementById("member_No").checked == false) {

			alert("Please select Are you member of Genotypic Techchnology?");

			document.getElementById("member_Yes").focus();

			return false;

		} else {

			if(document.getElementById("member_Yes").checked == true) {

				var promo_code = $('#promo_code').val();

				if(promo_code == '') {

					alert("Please enter Genotypic Techchnology Member code");

					document.getElementById("promo_code").focus();

					return false;

				}

			}

		}*/

		/*if(document.getElementById("event_know").value == "") {

			alert("Please select How do you know about Event.");

			document.getElementById("event_know").focus();

			return false;

		} else if(document.getElementById("event_know").value == "Others") {

			if(document.getElementById("other_value").value == "") {

				alert("Please enter other value of How do you know about Event.");

				document.getElementById("other_value").focus();

				return false;

			}

		}*/



	} else {

		/*$('#tech-div').hide();

		$('#genotypic-div').hide();*/

	}

	/*var $assoc_name = document.getElementById("assoc_name").value;

	if($assoc_name != 'ABAI' && $assoc_name != 'Spread' && $assoc_name != 'KSRSAC' && $assoc_name != 'TiE Bangalore' && $assoc_name != 'YESSS Abstract Presenter' && $assoc_name != 'KBITS') {

	    if ((document.getElementById("Indian").checked == false) && (document.getElementById("Foreign").checked == false)) {

	        alert("Please select the Nationality type.");

	        document.getElementById("Indian").focus();

	        return false;

	    }

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

	    } else if (foreignEl && foreignEl.checked == true) {

	    	if(document.getElementById("cata2").checked == false && document.getElementById("cata6").checked == false && document.getElementById("cata8").checked == false) {

				alert("Please select type of registration.....");

	            document.getElementById("Full_Day").focus();

	            return false;

			}

	    }

    }*/

    

	//if(document.getElementById("Single_Day").checked == false && document.getElementById("Full_Day").checked == false) {

	if(fullDayEl && fullDayEl.checked == false) {	

		alert("Please select type of registration.");

        fullDayEl.focus();

        return false;

	}

	

	/*if(document.getElementById("Single_Day").checked == true) {

		//if(document.getElementById("day1").checked == false && document.getElementById("day2").checked == false && document.getElementById("day3").checked == false) {

		if(document.getElementById("day1").checked == false &&document.getElementById("day2").checked == false && document.getElementById("day3").checked == false) {	

			alert("Please select the at least one day.");

            document.getElementById("day2").focus();

            return false;

		}

		$("#cata2").trigger('click');

	}*/ /*else if(document.getElementById("Full_Day").checked == true) {

		$("#cata1").trigger('click');

	}*/

	

    if (indianEl && indianEl.checked == true) {

		//if(document.getElementById("Single_Day").checked == false && document.getElementById("Full_Day").checked == false) {

		if(fullDayEl && fullDayEl.checked == false) {

			alert("Please select type of registration.");

            fullDayEl.focus();

            return false;

		}

		

		/*if(document.getElementById("Single_Day").checked == true) {

			if(document.getElementById("day1").checked == false && document.getElementById("day2").checked == false && document.getElementById("day3").checked == false) {

				alert("Please select the at least one day.");

	            document.getElementById("day1").focus();

	            return false;

			}

			//$("#cata2").trigger('click');

		}*/

    } else if (foreignEl && foreignEl.checked == true) {

    	if(fullDayEl && fullDayEl.checked == false) {

			alert("Please select type of registration.");

            fullDayEl.focus();

            return false;

		}

    }

    

    /*if (document.getElementById("Indian").checked == true) {

    	//if(document.getElementById("cata1").checked == false && document.getElementById("cata2").checked == false) {

		if(document.getElementById("cata1").checked == false) {

			alert("Please select type of registration...");

            document.getElementById("Full_Day").focus();

            return false;

		}

    } else if (foreignEl && foreignEl.checked == true) {

    	if(document.getElementById("cata1").checked == false) {

			alert("Please select type of registration.");

            document.getElementById("Full_Day").focus();

            return false;

		}

    }*/

    

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

	/*if (document.getElementById("Indian").checked == true) {

		if ((document.getElementById("Cc").checked == false)) {// && (document.getElementById("Cheque").checked == false) && (document.getElementById("BT").checked == false) && (document.getElementById("Dc").checked == false)) {

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

	}*/ 

    

    /*if(document.getElementById("g-recaptcha-response").value == "") {

		alert("Please re-enter your reCAPTCHA.");

		return false;

	}*/

    

    if ((document.getElementById("org").value == "")) {

        alert("Please Enter Organization Name.");

        document.getElementById("org").focus();

        return false;

    }



    /*if ((document.getElementById("addr1").value == "")) {

        alert("Please Enter Address 1.");

        document.getElementById("addr1").focus();

        return false;

    }*/



    if ((document.getElementById("city").value == "")) {

        alert("Please Enter City.");

        document.getElementById("city").focus();

        return false;

    }

    if ((document.getElementById("country").value == "")) {

        alert("Please Enter Country.");

        document.getElementById("country").focus();

        return false;

    }

    /*if ((document.getElementById("pin").value == "")) {

        

        alert("Please Enter pin/zip code.");

        document.getElementById("pin").focus();

        return false;

    }

    if ((document.getElementById("gst_number").value == "")) {

        alert('Please enter GST number OR if you want to leave this field empty, then add it\'s value "Not Available"');

        document.getElementById("gst_number").focus();

        return false;

    }

*/

    if (document.getElementById("fone").value == "") {

        alert("Please enter your Phone Number.");

        document.getElementById("fone").focus();

        return false;

    }/* else {

    	var fone = document.getElementById("fone").value.split("-");

    	if(fone[1] == undefined) {

    		alert("Please enter valid Phone Number.\n Like this format :Area Code-Phone Number");

            document.getElementById("fone").focus();

            return false;

    	} else if(fone[2] != undefined) {

    		alert("Please enter valid Phone Number.\n Like this format :Area Code-Phone Number");

            document.getElementById("fone").focus();

            return false;

    	}

    }*/

    /*if (document.getElementById("fax").value != "") {

    	var fone = document.getElementById("fax").value.split("-");

    	if(fone[1] == undefined) {

    		alert("Please enter valid Fax Number.\n Like this format :Area Code-Phone Number");

            document.getElementById("fax").focus();

            return false;

    	} else if(fone[2] != undefined) {

    		alert("Please enter valid Fax Number.\n Like this format :Area Code-Phone Number");

            document.getElementById("fax").focus();

            return false;

    	}

    }

    if (document.getElementById("gst").value == "Registered") {

    	if (document.getElementById("gst_number").value == "") {

	        alert("Please enter GST Number.");

	        document.getElementById("gst_number").focus();

	        return false;

    	}

    }*/

    if (document.getElementById("is_gst_invoice_needed").value == "") {

		alert("Please select Do you need a GST based Invoice?.");

		document.getElementById("is_gst_invoice_needed").focus();

		return false;

	}

    if (document.getElementById("is_gst_invoice_needed").value == "Yes") {

    	if (document.getElementById("gst_inv_addr").value == "") {

	        alert("Please enter Invoice Address.");

	        document.getElementById("gst_inv_addr").focus();

	        return false;

    	}

    	if (document.getElementById("gst_inv_reg_no").value == "") {

	        alert("Please enter Organisation GST Registration No.");

	        document.getElementById("gst_inv_reg_no").focus();

	        return false;

    	}

    	if (document.getElementById("gst_inv_pan").value == "") {

	        alert("Please enter Organisation Pan No.");

	        document.getElementById("gst_inv_pan").focus();

	        return false;

    	}

    	if (document.getElementById("gst_inv_state").value == "") {

	        alert("Please enter State.");

	        document.getElementById("gst_inv_state").focus();

	        return false;

    	}

    	if (document.getElementById("gst_inv_cp").value == "") {

	        alert("Please enter Contact Person Name.");

	        document.getElementById("gst_inv_cp").focus();

	        return false;

    	}

    	if (document.getElementById("gst_inv_phone").value == "") {

	        alert("Please enter Phone No.");

	        document.getElementById("gst_inv_phone").focus();

	        return false;

    	}

    	if (document.getElementById("gst_inv_email").value == "") {

	        alert("Please enter Email Address.");

	        document.getElementById("gst_inv_email").focus();

	        return false;

    	} else if(document.getElementById("gst_inv_email").value != "") {

    			var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    			var toArr= document.getElementById("gst_inv_email").value.split(","); 			//split into array

    			for (var i=0;i<toArr.length;i++) {

    				if ( !toArr[i].match(reg) ) {	

    					alert("Invalid email address \n"+toArr[i]);

    					document.getElementById("gst_inv_email").focus();

    					return false;

    				}

    			}

    		}

    }

    

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

	} else {

		

	    //if (document.getElementById("Cc").checked == true) {

    			/*document.getElementById("credit_card").style.display = "block";

				document.getElementById("debit_card").style.display = "none";

				document.getElementById("bank_transfer1").style.display = "none";

				document.getElementById("bank_transfer2").style.display = "none";

				document.getElementById("cheque").style.display = "none";*/

			/*if (document.getElementById("sector").value == 'Information Technology') {

    			document.getElementById("credit_card").style.display = "block";

				document.getElementById("debit_card").style.display = "none";

				document.getElementById("bank_transfer1").style.display = "none";

				document.getElementById("bank_transfer2").style.display = "none";

				document.getElementById("cheque").style.display = "none";

				

			} else if (document.getElementById("sector").value == 'Bio Technology') {				

				document.getElementById("bcredit_card").style.display = "block";

				document.getElementById("bdebit_card").style.display = "none";

				document.getElementById("bbank_transfer1").style.display = "none";

				document.getElementById("bbank_transfer2").style.display = "none";

				document.getElementById("bcheque").style.display = "none";

			}	*/

	    }

	    /*if (document.getElementById("Cheque").checked == true) {

			if (document.getElementById("sector").value == 'Information Technology') {

				document.getElementById("credit_card").style.display = "none";

				document.getElementById("debit_card").style.display = "none";

				document.getElementById("bank_transfer1").style.display = "none";

				document.getElementById("bank_transfer2").style.display = "none";

				document.getElementById("cheque").style.display = "block";

			} else if (document.getElementById("sector").value == 'Bio Technology') {

				document.getElementById("bcredit_card").style.display = "none";

				document.getElementById("bdebit_card").style.display = "none";

				document.getElementById("bbank_transfer1").style.display = "none";

				document.getElementById("bbank_transfer2").style.display = "none";

				document.getElementById("bcheque").style.display = "block";

			}	

	

	    }*/

	    /*if (document.getElementById("BT").checked == true) {

	    	if (indianEl && indianEl.checked == true) {				

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

			if (document.getElementById("sector").value == 'Information Technology') {

				document.getElementById("credit_card").style.display = "none";

				document.getElementById("debit_card").style.display = "block";

				document.getElementById("bank_transfer1").style.display = "none";

				document.getElementById("bank_transfer2").style.display = "none";

				document.getElementById("cheque").style.display = "none";

			} else if (document.getElementById("sector").value == 'Bio Technology') {

				document.getElementById("bcredit_card").style.display = "none";

				document.getElementById("bdebit_card").style.display = "block";

				document.getElementById("bbank_transfer1").style.display = "none";

				document.getElementById("bbank_transfer2").style.display = "none";

				document.getElementById("bcheque").style.display = "none";

			}

	    }*/

	    

	    /*if (document.getElementById("paypal").checked == true) {

	    	document.getElementById("credit_card").style.display = "none";

			document.getElementById("debit_card").style.display = "none";

			document.getElementById("bank_transfer1").style.display = "none";

			document.getElementById("bank_transfer2").style.display = "none";

			document.getElementById("cheque").style.display = "none";

			

			document.getElementById("bcredit_card").style.display = "none";

			document.getElementById("bdebit_card").style.display = "none";

			document.getElementById("bbank_transfer1").style.display = "none";

			document.getElementById("bbank_transfer2").style.display = "none";

			document.getElementById("bcheque").style.display = "none";

	    }

	    if (document.getElementById("gpay").checked == true) {

			

			document.getElementById("credit_card").style.display = "block";

			document.getElementById("debit_card").style.display = "none";

			document.getElementById("bank_transfer1").style.display = "none";

			document.getElementById("bank_transfer2").style.display = "none";

			document.getElementById("cheque").style.display = "none";

			

	    }*/

	//}

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

	//var $assoc_name = document.getElementById("assoc_name").value;

	//if($assoc_name != 'ABAI' && $assoc_name != 'Spread' && $assoc_name != 'KSRSAC' && $assoc_name != 'TiE Bangalore' && $assoc_name != 'YESSS Abstract Presenter' && $assoc_name != 'KBITS') {

		/*if(document.getElementById("Single_Day").checked == true) {

			$('#div_single_day').show();

			/*$('#day1').prop("checked", false);*/

			/*$('#day2').prop("checked", false);

			$('#day3').prop("checked", false);*/

			/*if(document.getElementById("Industry").checked == true) {

				$("#cata3").trigger('click');

			} else {

				$("#cata4").trigger('click');

			}*/

			/*$("#cata2").trigger('click');

		} else*/ 

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

	/*var $assoc_name = document.getElementById("assoc_name").value;

	//if($assoc_name != 'ABAI' && $assoc_name != 'Spread' && $assoc_name != 'KSRSAC' && $assoc_name != 'TiE Bangalore') {

		if (indianEl && indianEl.checked == true) {

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

		}*/

	//}



	/*if(document.getElementById("Industry").checked == true || document.getElementById("Student").checked == true) {

		$('.normal-cata').show();

		$('.poster-cata').hide();

		

	} else if(document.getElementById("Poster").checked == true) {

		$('.normal-cata').hide();

		$('.poster-cata').show();

	}*/

	

	/*if(document.getElementById("Industry").checked == true && document.getElementById("Indian").checked == true) {

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

		/$('.main-tariff-table').show();

		$('.normal-cata').show();

		$('.poster-cata').hide();

		$('.indian-tariff').hide();

		$('.international-tariff').hide();

		$('.indian-tariff-1').show();

		$('.partner-del').hide();

		$('.conference-del').show();*\



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

	}*/

	$('#total_dele').val('');

}



function showPromoCode() {

	/*if(document.getElementById("member_Yes").checked == true) {

		$('#genotypic-div').show();

	} else if (document.getElementById("member_No").checked == true) {

		$('#genotypic-div').hide();

	}*/

}



/*function showForm(){

$('.main-form-div').hide();

	 if(document.getElementById("delegate-virtual").checked == true){

		$('.main-form-div').show();

		$('.del_type').hide();

		$('.teriff-table').hide();

		$('.teriff-table-virtual').show();

		if(document.getElementById("Indian").checked==true){

			$('.indian-tariff-v').show();

			$('.international-tariff-v').hide();

		}else if(document.getElementById("Foreign").checked==true){

			$('.indian-tariff-v').hide();

			$('.international-tariff-v').show();

		}

	}

	show_cata();

}*/

function validate_registration_form_assoc() {

	if(document.getElementById("assoc_name").value == "") {

		alert("Please select Association name.");

        document.getElementById("assoc_name").focus();

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

	

	if(document.getElementById("Industry").checked == false && document.getElementById("Student").checked == false) {

    	alert("Please select delegate type.");

        document.getElementById("Industry").focus();

        return false;

    }

	var valie = $('#sector').val();

	if (indianEl && indianEl.checked == true){// && valie == 'Bio Technology') {

		/*if(document.getElementById("member_Yes").checked == false && document.getElementById("member_No").checked == false) {

			alert("Please select Are you member of Genotypic Techchnology?");

			document.getElementById("member_Yes").focus();

			return false;

		} else {

			if(document.getElementById("member_Yes").checked == true) {

				var promo_code = $('#promo_code').val();

				if(promo_code == '') {

					alert("Please enter Genotypic Techchnology Member code");

					document.getElementById("promo_code").focus();

					return false;

				}

			}

		}*/

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

		

	}

	

    

	//if(document.getElementById("Single_Day").checked == false && document.getElementById("Full_Day").checked == false) {

	if(document.getElementById("Single_Day").checked == false) {	

		alert("Please select type of registration.");

        document.getElementById("Single_Day").focus();

        return false;

	}

	

	if(document.getElementById("Single_Day").checked == true) {

		//if(document.getElementById("day1").checked == false && document.getElementById("day2").checked == false && document.getElementById("day3").checked == false) {

		if(document.getElementById("day1").checked == false && document.getElementById("day2").checked == false && document.getElementById("day3").checked == false) {	

			alert("Please select the at least one day.");

            document.getElementById("day1").focus();

            return false;

		}

		$("#cata2").trigger('click');

	} /*else if(document.getElementById("Full_Day").checked == true) {

		$("#cata1").trigger('click');

	}*/

    if ((document.getElementById("Cc").checked == false) && (document.getElementById("Cheque").checked == false) && (document.getElementById("BT").checked == false) && (document.getElementById("Dc").checked == false)) {

        alert("Please select the Payment Mode.");

        document.getElementById("Cc").focus();

        return false;

    }

    

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



function checkPhoneNumber(e, txt) {

	/*var unicode=e.keyCode? e.keyCode : e.charCode;

	var text1 = txt;

	//alert(unicode);

	if((unicode == "48") || (unicode == "49") || (unicode == "50") || (unicode == "51") || (unicode=="52") || (unicode=="53") || (unicode=="54") || (unicode=="55") || (unicode=="56") || (unicode=="57") || (unicode=="96") || (unicode=="97") || (unicode=="98") || (unicode=="99") || (unicode=="100") || (unicode=="101") || (unicode=="102") || (unicode=="103") || (unicode=="104") || (unicode=="105")|| (unicode=="109") || (unicode=="173")|| (unicode=="189")  || (unicode=="8") || (unicode=="46") || (unicode=="9") || (unicode=="16"))

	{

		

	}

	else if((unicode!="48") || (unicode!="49") || (unicode!="50") || (unicode!="51") || (unicode!="52") || (unicode!="53") || (unicode!="54") || (unicode!="55") || (unicode!="56") || (unicode!="57") || (unicode!="96") || (unicode!="97") || (unicode!="98") || (unicode!="99") || (unicode!="100") || (unicode!="101") || (unicode!="102") || (unicode!="103") || (unicode!="104") || (unicode!="105")|| (unicode!="109") || (unicode!="173") || (unicode!="189") || (unicode!="8") || (unicode!="46") || (unicode!="9") || (unicode!="16"))

	{

		document.getElementById(text1).value="";

		//alert("Please enter only numbers");

	}*/



	var intRegex = /^\d+$/;

	var str = document.getElementById(txt).value;

	if(!intRegex.test(str)) {

	   document.getElementById(txt).value="";

	}

	

	/*var fone = document.getElementById(txt).value.split("-");

	if(fone[2] != undefined) {

		alert("Please enter valid Phone Number.\n Like this format :Area Code-Phone Number");

        document.getElementById(txt).focus();

        return false;

	}*/

}