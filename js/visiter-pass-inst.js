function disp_other_v()
{	
		
	if(document.getElementById("purpose7").checked == true)
	{
		document.getElementById("div_other_v").style.display = "block";
		document.getElementById("other_v").value = "";
	}
	else
	{
		document.getElementById("other_v").value = "";
		document.getElementById("div_other_v").style.display = "none";		
	}
}

function disp_other_k123213()
{	
		
	if(document.getElementById("know7").checked == true)
	{
		document.getElementById("div_other_k").style.display = "block";
		document.getElementById("other_txtbx_find_us").value = "";
	}
	else
	{
		document.getElementById("other_txtbx_find_us").value = "";
		document.getElementById("div_other_k").style.display = "none";		
	}
}
function disp_association_name()
{			
	if(document.getElementById("know1").checked == true)
	{
		document.getElementById("div_association_name").style.display = "block";
		document.getElementById("association_name").value = "";
	}
	else
	{
		document.getElementById("association_name").value = "";
		document.getElementById("div_association_name").style.display = "none";		
	}
}


function chk_email(t_email)
{
	
	if(document.getElementById(t_email).value != "") 
  	{
		var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		var toArr= document.getElementById(t_email).value.split(","); 			//split into array
	    for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
		{
	    	if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
			{	
				alert("Invalid email address \n"+toArr[i]);
				document.getElementById(t_email).focus();
		        return false;
	    	}
			else
			{
				return true;
			}
	  	}
  	}
	else
	{
		return true;
	}
	
}

function validate_vpass(eventName)
{

	if(document.getElementById("title").value == "")
	{
		alert("Please Select Title.");
		document.getElementById("title").focus();
		return false;
	}
	if(document.getElementById("fname").value == "")
	{  
		alert("Please fill your First Name.");
		document.getElementById("fname").focus();
		return false;
	}
	
	/*if(document.getElementById("email").value == "")
	{
		alert("Please fill your email address.");
		document.getElementById("email").focus();
		return false;
	}
	else if(document.getElementById("email").value != "") 
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
  	}*/
	if(document.getElementById("job_title").value == "")
	{
	    alert("Please fill the Designation.");
        document.getElementById("job_title").focus();
        return false;
    }
	/*
	if(document.getElementById("website").value == "")
	{
	    alert("Please specify your website URL as www.bangalorenano.in.");
        document.getElementById("website").focus();
        return false;
    }
	*/
	if(document.getElementById("org").value == "")
	{
		alert("Please fill your College / Institute Name.");
		document.getElementById("org").focus();
		return false;
	}
	/*if(document.getElementById("addr").value == "")
	{
		alert("Please fill your address.");
		document.getElementById("addr").focus();
		return false;
	}
	if(document.getElementById("city").value == "")
	{
		alert("Please fill your City.");
		document.getElementById("city").focus();
		return false;
	}
	if(document.getElementById("state").value == "")
	{
		alert("Please fill your State.");
		document.getElementById("state").focus();
		return false;
	}
	if(document.getElementById("country").value == "")
	{
		alert("Please select Country.");
		document.getElementById("country").focus();
		return false;
	}
	if(document.getElementById("zip").value == "")
	{
		alert("Please fill your Postal Code.");
		document.getElementById("zip").focus();
		return false;
	}
	if(document.getElementById("fone").value == "")
	{
		alert("Please fill your Contact Number.");
		document.getElementById("fone").focus();
		return false;
	}*/
	/*
	if(document.getElementById("org_act").value == "")
	{
	    alert("Please fill the main activity of your Company.");
        document.getElementById("org_act").focus();
        return false;
    }*/
	
	/*if(document.getElementById("interest").value == "")
	{
	    alert("Please fill the main interest of your Company.");
        document.getElementById("interest").focus();
        return false;
    }
	
	if((document.getElementById("purpose1").checked == false)  &&  (document.getElementById("purpose2").checked == false)  &&  (document.getElementById("purpose3").checked == false)  &&  (document.getElementById("purpose4").checked == false)  &&  (document.getElementById("purpose5").checked == false)  &&  (document.getElementById("purpose6").checked == false) && (document.getElementById("purpose7").checked == false) && (document.getElementById("purpose8").checked == false))
	{
	    alert("Please select atleast one Purpose of Visit.");
        document.getElementById("purpose1").focus();
        return false;
    }
	if(document.getElementById("purpose8").checked == true) {
		if(document.getElementById("other_v").value == "") {
			alert("Please enter name of other purpose.");
	        document.getElementById("other_v").focus();
	        return false;
		}
	}*/
	/*
	if(document.getElementById("noOfEmp").value == "Select")
	{
	    alert("Please select number of employees.");
        document.getElementById("noOfEmp").focus();
        return false;
    }*/
	
	 /*if (document.getElementById("find_us").value == "") {
        alert("Please select how did you know about event?");
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
	if((document.getElementById("feedback1").checked == false)  &&  (document.getElementById("feedback2").checked == false))
	{
	    alert("Do You Wish to Receive Info from " + event_name + "?");
        document.getElementById("feedback1").focus();
        return false;
    }*/
	if(document.getElementById("vercodevp").value == "")
	{
	    alert("Please fill the characters you see in image.");
        document.getElementById("vercodevp").focus();
        return false;
    }
	else if(document.getElementById("vercodevp").value != "")
	{
		compstr = document.getElementById("test").value;
		if(document.getElementById("vercodevp").value != compstr)
		{
	    	alert("Please fill correct characters you see in image.");
        	document.getElementById("vercodevp").value = "";
			document.getElementById("vercodevp").focus();
        	return false;
		}	
    }
    //document.getElementById("visitor_form1").submit();
	
	return true;
}

function disp_other_v()
{	
		
	if(document.getElementById("purpose7").checked == true)
	{
		document.getElementById("div_other_v").style.display = "block";
		document.getElementById("other_v").value = "";
	}
	else
	{
		document.getElementById("other_v").value = "";
		document.getElementById("div_other_v").style.display = "none";		
	}
}

function disp_other_k()
{	
		
	if(document.getElementById("find_us").value == "Others")
	{
		document.getElementById("div_find_us").style.display = "block";
		document.getElementById("other_txtbx_find_us").value = "";
	}
	else
	{
		document.getElementById("other_txtbx_find_us").value = "";
		document.getElementById("div_find_us").style.display = "none";		
	}
}


function show_othr_fun(id) {
    if (document.getElementById(id).checked == false) {
        document.getElementById("div_enq_other").style.display = "none";

    } else if (document.getElementById(id).checked == true) {
        document.getElementById("div_enq_other").style.display = "block";
        document.getElementById("other_v").value = "";
    }

}