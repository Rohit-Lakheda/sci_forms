function validate_registration_form_2() {
    if(document.getElementById("fname").value == "")
    {
        alert("Please enter first name");
        document.getElementById("fname").focus();
        return false;
    }
    if(document.getElementById("lname").value == "")
    {
        alert("Please enter last name");
        document.getElementById("lname").focus();
        return false;
    }
    if ((document.getElementById("nickname").value == "")) {
        alert("Please Enter Pilot CallSign or Nickname.");
        document.getElementById("nickname").focus();
        return false;
    }
        
    if(document.getElementById("email").value == "") {
        alert("Please enter email");
        document.getElementById("email").focus();
        return false;
    } else if(document.getElementById("email").value != "")   {
        var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var toArr= document.getElementById("email").value.split(",");           //split into array
        for (var i=0;i<toArr.length;i++)                                        //loop array to validate correct address
        {
            if ( !toArr[i].match(reg) )                                         //if not match, alert and stop loop
            {   
                alert("Invalid email address \n"+toArr[i]);
                document.getElementById("email").focus();
                return false;
            }
        }
    }

    if ((document.getElementById("dob").value == "")) {
        alert("Please Enter Date of Birth.");
        document.getElementById("dob").focus();
        return false;
    }

    if ((document.getElementById("gender").value == "")) {
        alert("Please select Gender.");
        document.getElementById("gender").focus();
        return false;
    }

    if ((document.getElementById("fone").value == "")) {
        alert("Please enter Phone number.");
        document.getElementById("fone").focus();
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
        alert("Please Enter Postal Code.");
        document.getElementById("pin").focus();
        return false;
    }
    if ((document.getElementById("skill_level").value == "")) {
        alert('Please select Skill Level ');
        document.getElementById("skill_level").focus();
        return false;
    }

    if (document.getElementById("drone_experience").value == "") {
        alert("Please enter Drone Experience.");
        document.getElementById("drone_experience").focus();
        return false;
    }

    if ((document.getElementById("Cc").checked == false) && (document.getElementById("Cheque").checked == false) && (document.getElementById("BT").checked == false) && (document.getElementById("Dc").checked == false)) {
        alert("Please select the Payment Mode.");
        //document.getElementById("Cc").focus();
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

    return true;
}

function showTxt() {
    if (document.getElementById("Cc").checked == true) {
        //if (document.getElementById("sector").value == 'Information Technology') {
            document.getElementById("credit_card").style.display = "block";
            document.getElementById("debit_card").style.display = "none";
            document.getElementById("bank_transfer1").style.display = "none";
            document.getElementById("bank_transfer2").style.display = "none";
            document.getElementById("cheque").style.display = "none";
            
        /*} else if (document.getElementById("sector").value == 'Bio Technology') {               
            document.getElementById("bcredit_card").style.display = "block";
            document.getElementById("bdebit_card").style.display = "none";
            document.getElementById("bbank_transfer1").style.display = "none";
            document.getElementById("bbank_transfer2").style.display = "none";
            document.getElementById("bcheque").style.display = "none";
        }   */
    }
    if (document.getElementById("Cheque").checked == true) {
        //if (document.getElementById("sector").value == 'Information Technology') {
            document.getElementById("credit_card").style.display = "none";
            document.getElementById("debit_card").style.display = "none";
            document.getElementById("bank_transfer1").style.display = "none";
            document.getElementById("bank_transfer2").style.display = "none";
            document.getElementById("cheque").style.display = "block";
        /*} else if (document.getElementById("sector").value == 'Bio Technology') {
            document.getElementById("bcredit_card").style.display = "none";
            document.getElementById("bdebit_card").style.display = "none";
            document.getElementById("bbank_transfer1").style.display = "none";
            document.getElementById("bbank_transfer2").style.display = "none";
            document.getElementById("bcheque").style.display = "block";
        }  */ 

    }
    if (document.getElementById("BT").checked == true) {
        //if (document.getElementById("Indian").checked == true) {
            //if (document.getElementById("sector").value == 'Information Technology') {
                document.getElementById("credit_card").style.display = "none";
                document.getElementById("debit_card").style.display = "none";
                document.getElementById("bank_transfer1").style.display = "block";
                document.getElementById("bank_transfer2").style.display = "block";
                document.getElementById("cheque").style.display = "none";
            /*} else if (document.getElementById("sector").value == 'Bio Technology') {
                document.getElementById("bcredit_card").style.display = "none";
                document.getElementById("bdebit_card").style.display = "none";
                document.getElementById("bbank_transfer1").style.display = "block";
                document.getElementById("bbank_transfer2").style.display = "none";
                document.getElementById("bcheque").style.display = "none";
            }
        } else if (document.getElementById("Foreign").checked == true) {
            if (document.getElementById("sector").value == 'Information Technology') {
                document.getElementById("credit_card").style.display = "none";
                document.getElementById("debit_card").style.display = "none";
                document.getElementById("bank_transfer2").style.display = "block";
                document.getElementById("bank_transfer1").style.display = "none";
                document.getElementById("cheque").style.display = "none";
            } else if (document.getElementById("sector").value == 'Bio Technology') {
                document.getElementById("bcredit_card").style.display = "none";
                document.getElementById("bdebit_card").style.display = "none";
                document.getElementById("bbank_transfer2").style.display = "block";
                document.getElementById("bbank_transfer1").style.display = "none";
                document.getElementById("bcheque").style.display = "none";
            }
        }*/
    }
    /*if (document.getElementById("Dc").checked == true) {
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
}

function checkPhoneNumber(e, txt) {
	var intRegex = /^\d+$/;
	var str = document.getElementById(txt).value;
	if(!intRegex.test(str)) {
	   document.getElementById(txt).value="";
	}
}