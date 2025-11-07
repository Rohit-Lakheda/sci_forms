function go_back() {
	var assoc_nameurl = '';
	if(assoc_name != '') {
		assoc_nameurl = '&assoc_name=' + assoc_name;

		window.location = ('registration.php?ret=retds4fu324rn_ed24d3it' + assoc_nameurl + '&en=' + en);
	} else {
		if(a != '') {
			a = '&a=' + a;		
		}
		window.location = ('registration.php?ret=retds4fu324rn_ed24d3it' + a + assoc_nameurl + '&en=' + en);
	}
    
}

function validate_registration_form_2() {
    if ((document.getElementById("org").value == "")) {
        alert("Please Enter Organization Name.");
        document.getElementById("org").focus();
        return false;
    }

    if ((document.getElementById("addr1").value == "")) {
        alert("Please Enter Address 1.");
        document.getElementById("addr1").focus();
        return false;
    }

    if ((document.getElementById("city").value == "")) {
        alert("Please Enter City.");
        document.getElementById("city").focus();
        return false;
    }
    if ((document.getElementById("state").value == "")) {
        alert("Please Enter State.");
        document.getElementById("state").focus();
        return false;
    }
    if ((document.getElementById("country").value == "")) {
        alert("Please Enter Country.");
        document.getElementById("country").focus();
        return false;
    }
    if ((document.getElementById("pin").value == "")) {
        
        alert("Please Enter pin/zip code.");
        document.getElementById("pin").focus();
        return false;
    }
    /*if ((document.getElementById("gst_number").value == "")) {
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
    }*/
    if (document.getElementById("gst").value == "Registered") {
    	if (document.getElementById("gst_number").value == "") {
	        alert("Please enter GST Number.");
	        document.getElementById("gst_number").focus();
	        return false;
    	}
    }
    //document.reg_registration_form_2.submit();
    return true;
}

function go_back1() {
    window.location = ('registration_comp.php?ret=retds4fu324rn_ed24d3it' + goBackUrl);
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