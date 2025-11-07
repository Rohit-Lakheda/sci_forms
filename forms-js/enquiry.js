function disp_findus_oth() {

    if (document.getElementById("find_us").value == "Others") {

        document.getElementById("div_find_us").style.display = "block";

        document.getElementById("other_txtbx_find_us").value = "";

        document.getElementById("other_txtbx_find_us").focus();

    } else {

        document.getElementById("div_find_us").style.display = "none";

    }

}





function validateEnquiry(eventName) {

    if (document.getElementById("sector").value == "") {

        alert("Please Select Sector!");

        document.getElementById("sector").focus();

        return false;

    }

    if ((document.getElementById("enquiry1").checked == false) && (document.getElementById("enquiry2").checked == false)
        && (document.getElementById("enquiry3").checked == false) && 
    (document.getElementById("enquiry4").checked == false) &&
     (document.getElementById("enquiry5").checked == false) &&
     (document.getElementById("enquiry6").checked == false) && 
     (document.getElementById("enquiry7").checked == false) && 
     (document.getElementById("enquiry8").checked == false) && 
     (document.getElementById("enquiry9").checked == false) &&
        (document.getElementById("enquiry10").checked == false) &&
        (document.getElementById("enquiry11").checked == false)

    ) {

        alert('You didn\'t choose any of information Criteria!');

        document.getElementById("enquiry1").focus();

        return false;

    }



    if (document.getElementById("enquiry12").checked == true) {



        document.getElementById("div_enq_other").style.display = "block";



        if (document.getElementById("other_name").value == "") {

            alert('Please Enter value of other enquiry criteria!');

            document.getElementById("other_name").focus();

            return false;

        }



    } else {



        document.getElementById("div_enq_other").style.display = "none";

    }

	

	// if($('input.enq-chk:checked').length >= 3) {

	// 	alert('Please select one or two Want Information About fields!');

	// 	document.getElementById("enquiry1").focus();

	// 	return false;

	// }

    if (document.getElementById("title").value == "") {



        alert("Please Select Title!");

        document.getElementById("title").focus();

        return false;

    }

    if (document.getElementById("fname").value == "") {

        alert("Please fill your First Name!");

        document.getElementById("fname").focus();

        return false;

    }

    if (document.getElementById("lname").value == "") {

        alert("Please fill your Last Name!");

        document.getElementById("lname").focus();

        return false;

    }



    if (document.getElementById("company").value == "") {

        alert("Please fill your Organisation!");

        document.getElementById("company").focus();

        return false;

    }



    if (document.getElementById("desig").value == "") {

        alert("Please fill your Designation!");

        document.getElementById("desig").focus();

        return false;

    }



    if (document.getElementById("email").value == "") {

        alert("Please fill your email address!");

        document.getElementById("email").focus();

        return false;

    } else if (document.getElementById("email").value != "") {

        var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        var toArr = document.getElementById("email").value.split(","); //split into array

        for (var i = 0; i < toArr.length; i++) //loop array to validate correct address

        {

            if (!toArr[i].match(reg)) //if not match, alert and stop loop

            {

                alert("Invalid email address \n" + toArr[i] + '!');

                document.getElementById("email").focus();

                return false;

            }

        }

    }



    if (document.getElementById("comment").value == "") {

        alert('Please Enter your Comment!');

        document.getElementById("comment").focus();

        return false;

    }



    if (document.getElementById("city").value == "") {

        alert("Please fill your city name!");

        document.getElementById("city").focus();

        return false;

    }







    if (document.getElementById("country").value == "") {

        alert("Please fill your Country!");

        document.getElementById("country").focus();

        return false;

    }



    if (document.getElementById("find_us").value == "") {

        alert("Please select how did you know about Event?");

        document.getElementById("find_us").focus();

        return false;

    }



    if (document.getElementById("find_us").value == "Others") {

        if (document.getElementById("other_txtbx_find_us").value == "") {

            alert("Please enter other value of how did you know about " + eventName + " Event!"); 

            document.getElementById("other_txtbx_find_us").focus();

            return false;

        }

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

    /*if(document.getElementById("g-recaptcha-response").value == "") {

		alert("Please re-enter your reCAPTCHA.");

		//document.getElementById("g-recaptcha-response").focus();

		return false;

	}*/

    //document.getElementById("enq").submit();

	return true;

}



function show_othr_fun(id) {

    if (document.getElementById(id).checked == false) {

        document.getElementById("div_enq_other").style.display = "none";



    } else if (document.getElementById(id).checked == true) {

        document.getElementById("div_enq_other").style.display = "block";

        document.getElementById("other_name").value = "";

    }



}