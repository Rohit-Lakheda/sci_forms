
function validate_registration_form_2() {
	
     if(document.getElementById("title").value == "")
    {
        alert("Please enter Title of name (e.g. Mr. / Mrs. / Ms.)");
        document.getElementById("title").focus();
        return false;
    }
	
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
    if ((document.getElementById("city_origin").value == "")) {
        alert("Please Enter city of origin.");
        document.getElementById("city_origin").focus();
        return false;
    }
	 if ((document.getElementById("profession").value == "")) {
        alert("Please Enter city profession.");
        document.getElementById("profession").focus();
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
	
	if ((document.getElementById("bengaluru_role").value == "")) {
        alert("Please enter details of about 'How Bengaluru has played Important Role in your TECH-LIFE?' (Only in 280 Characters).");
        document.getElementById("bengaluru_role").focus();
        return false;
    }
	
	if ((document.getElementById("profile_photo").value == "")) {
        alert("Please Upload Your profile photo");
        document.getElementById("profile_photo").focus();
        return false;
    }
	
	if ((document.getElementById("user_profile").value == "")) {
        alert("Please enter your profile (Only in 280 Characters).");
        document.getElementById("user_profile").focus();
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


	function isValidFile(id1, sizeMb) {
		var sizeByte = 2097152;
		if(sizeMb == '4') {
			sizeByte = 4194304;
		}
		 var myfile= $('#' + id1).val();
		var fileSize = document.getElementById(id1).files[0];
		var ext = myfile.split('.').pop().toLowerCase();
		 if( ext=="jpeg" || ext=="png" || ext=="jpg" || ext=="gif" ){
		  
		   } else{
			   $('#' + id1).val('');
			   alert("Please upload jpeg/png/jpg format files.");
			   return false;
		   }
			if (fileSize.size > sizeByte) // 2 mb for bytes.
	       {
	           $('#' + id1).val('');
			    alert("File size must less than " + sizeMb + "MB!");
	           return false;
	       }
	}
