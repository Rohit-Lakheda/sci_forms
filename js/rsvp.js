
	function validateEnquiry1223() {

   if (document.getElementById("title").value == "") {

        alert("Please Select Title!");
        document.getElementById("title").focus();
        return false;
    }
    if (document.getElementById("name").value == "") {
        alert("Please fill your Name!");
        document.getElementById("name").focus();
        return false;
    }

    if (document.getElementById("org").value == "") {
        alert("Please fill your Organisation!");
        document.getElementById("org").focus();
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

    if(document.getElementById("mob").value == ""){
			alert("Please enter  Contact No.");
			document.getElementById("mob").focus();
			return false;
	}
	
	if(document.getElementById("city").value == ""){
		alert("Please enter City");
		document.getElementById("city").focus();
		return false;
	}

    /*if(document.getElementById("g-recaptcha-response").value == "") {
		alert("Please re-enter your reCAPTCHA.");
		//document.getElementById("g-recaptcha-response").focus();
		return false;
	} */
    
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
  //  document.getElementById("enq").submit();

}

function check_num(e,txt)
	{
		var unicode=e.keyCode? e.keyCode : e.charCode;
		var text1 = txt;
		if((unicode == "48") || (unicode == "49") || (unicode == "50") || (unicode == "51") || (unicode=="52") || (unicode=="53") || (unicode=="54") || (unicode=="55") || (unicode=="56") || (unicode=="57") || (unicode=="96") || (unicode=="97") || (unicode=="98") || (unicode=="99") || (unicode=="100") || (unicode=="101") || (unicode=="102") || (unicode=="103") || (unicode=="104") || (unicode=="105") || (unicode=="8") || (unicode=="46") || (unicode=="9") || (unicode=="16"))
		{
			
		}
		
		else if((unicode!="48") || (unicode!="49") || (unicode!="50") || (unicode!="51") || (unicode!="52") || (unicode!="53") || (unicode!="54") || (unicode!="55") || (unicode!="56") || (unicode!="57") || (unicode!="96") || (unicode!="97") || (unicode!="98") || (unicode!="99") || (unicode!="100") || (unicode!="101") || (unicode!="102") || (unicode!="103") || (unicode!="104") || (unicode!="105") || (unicode!="8") || (unicode!="46") || (unicode!="9") || (unicode!="16"))
		{
			//alert("Please enter numbers");
			document.getElementById(text1).value="";
		}	
	}

	function check_char(ev,txt2)
	{
		var unicode2=ev.keyCode? ev.keyCode : ev.charCode;
		var text2 = txt2;
		if((unicode2=="48") || (unicode2=="49") || (unicode2=="50") || (unicode2=="51") || (unicode2=="52") || (unicode2=="53") || (unicode2=="54") || (unicode2=="55") || (unicode2=="56") || (unicode2=="57") || (unicode2=="96") || (unicode2=="97") || (unicode2=="98") || (unicode2=="99") || (unicode2=="100") || (unicode2=="101") || (unicode2=="102") || (unicode2=="103") || (unicode2=="104") || (unicode2=="105"))
		{
			//alert("Please enter character");
			document.getElementById(txt2).value="";
		}	
	}
	
	