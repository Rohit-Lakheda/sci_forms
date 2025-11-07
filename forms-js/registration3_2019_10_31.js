jQuery(document).ready(function() {
});

function go_back() {
	if(a != '') {
		a = '&a=' + a;		
	}
	window.location=('registration3.php?ret=retds4fu324rn_ed24d3it&en=' + en + a);
}


function go_back1() {//alert('registration_comp3.php?ret=retds4fu324rn_ed24d3it&' + cata_type);
	window.location=('registration_comp3.php?ret=retds4fu324rn_ed24d3it&' + cata_type);
}


function validate_registration_form_3(){
	var spouseCount = delegateCount = 0;
	for(var j=1;j<=total_delegates;j++)
	{
		if(document.getElementById("title"+j).value == "")
		{
			alert("Please fill delegate "+j+"'s title ");
			document.getElementById("title"+j).focus();
			return false;
		}
		if(document.getElementById("fname"+j).value == "")
		{
			alert("Please fill delegate "+j+"'s first name");
			document.getElementById("fname"+j).focus();
			return false;
		}
		if(document.getElementById("lname"+j).value == "")
		{
			alert("Please fill delegate "+j+"'s last name");
			document.getElementById("lname"+j).focus();
			return false;
		}
		if(document.getElementById("job_title"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s Designation");
			document.getElementById("job_title"+j).focus();
			return false;
		}
		if(document.getElementById("badge"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s badge name");
			document.getElementById("badge"+j).focus();
			return false;
		}
		
		if(document.getElementById("email_m"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s email");
			document.getElementById("email_m"+j).focus();
			return false;
		} else if(document.getElementById("email_m"+j).value != "") 
		{
			var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var toArr= document.getElementById("email_m"+j).value.split(","); 			//split into array
			for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
			{
				if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
				{	
					alert("Invalid email address \n"+toArr[i]);
					document.getElementById("email_m"+j).focus();
					return false;
				}
			}
		}
		
		/*if(document.getElementById("c_code"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s country code");
			document.getElementById("c_code"+j).focus();
			return false;
		}*/
		if(document.getElementById("cellno"+j).value == "")
		{
			alert("Please fill delegate"+j+"'s mobile code");
			document.getElementById("cellno"+j).focus();
			return false;
		}
	}
	 //document.reg_registration_form_3.submit();
	 return true;
}