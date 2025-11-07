function validate_registration_form_3(){
	if(document.getElementById("cata").value == "")
	{
		alert("Please select your registration category.");
		document.getElementById("cata").focus();
		return false;
	}
	if(document.getElementById("title").value == "")
	{
		alert("Please select your title");
		document.getElementById("title").focus();
		return false;
	}
	if(document.getElementById("fname").value == "")
	{
		alert("Please enter your first name");
		document.getElementById("fname").focus();
		return false;
	}
	if(document.getElementById("lname").value == "")
	{
		alert("Please enter your last name");
		document.getElementById("lname").focus();
		return false;
	}
	if(document.getElementById("org").value == "")
	{
		alert("Please enter your organisation name");
		document.getElementById("org").focus();
		return false;
	}
	if(document.getElementById("desig").value == "")
	{
		alert("Please enter your Designation");
		document.getElementById("desig").focus();
		return false;
	}
	if(document.getElementById("addr1").value == "")
	{
		alert("Please enter address line 1.");
		document.getElementById("addr1").focus();
		return false;
	}
	if(document.getElementById("city").value == "")
	{
		alert("Please enter city.");
		document.getElementById("city").focus();
		return false;
	}
	if(document.getElementById("state").value == "")
	{
		alert("Please enter state.");
		document.getElementById("state").focus();
		return false;
	}
	if(document.getElementById("country").value == "")
	{
		alert("Please enter country.");
		document.getElementById("country").focus();
		return false;
	}
	if(document.getElementById("pin").value == "")
	{
		alert("Please enter postal code.");
		document.getElementById("pin").focus();
		return false;
	}
	
	if(document.getElementById("email").value == "")
	{
		alert("Please enter your email");
		document.getElementById("email").focus();
		return false;
	} else if(document.getElementById("email").value != "") 
	{
		var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var toArr= document.getElementById("email").value.split(","); 			//split into array
		for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
		{
			if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
			{	
				alert("Invalid email address \n"+toArr[i]);
				document.getElementById("email").focus();
				return false;
			}
		}
	}
	
	/*if(document.getElementById("c_code").value == "")
	{
		alert("Please fill delegate"+"'s country code");
		document.getElementById("c_code").focus();
		return false;
	}*/
	if(document.getElementById("mobile").value == "")
	{
		alert("Please fill delegate mobile number");
		document.getElementById("mobile").focus();
		return false;
	}
	
	if(document.getElementById("g-recaptcha-response").value == "") {
		alert("Please re-enter your reCAPTCHA.");
		document.getElementById("g-recaptcha-response").focus();
		return false;
	}
	
	// document.reg_registration_form_3.submit();
	 return true;
}