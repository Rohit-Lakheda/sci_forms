function validate_ex2()
{
		var nt_fill_cnt = 0;
		var fill_cnt = 0;
		
		
	var total_exbhitors = 2;	
	for(var j=1;j<=total_exbhitors;j++)
	{
		if(document.getElementById("title"+j).value == "")
		{
			alert("Please fill exhibitor "+j+"'s title ");
			document.getElementById("title"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		
		if(document.getElementById("fname"+j).value == "")
		{
			alert("Please fill exhibitor "+j+"'s first name");
			document.getElementById("fname"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		if(document.getElementById("lname"+j).value == "")
		{
			alert("Please fill exhibitor "+j+"'s last name");
			document.getElementById("lname"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		if(document.getElementById("desig"+j).value == "")
		{
			alert("Please fill exhibitor "+j+"'s Designation");
			document.getElementById("desig"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		}
		if(document.getElementById("mob"+j).value == "")
		{
			
			alert("Please fill exhibitor "+j+"'s Mobile Number");
			document.getElementById("mob"+j).focus();
			return false;
			
		}
		/*if(document.getElementById("dept"+j).value == "")
		{
			
			alert("Please fill exhibitor "+j+"'s department name");
			document.getElementById("dept"+j).focus();
			return false;
			
		}*/
		if(document.getElementById("email"+j).value == "")
		{
			
			alert("Please fill exhibitor "+j+"'s Email address");
			document.getElementById("email"+j).focus();
			return false;
			
			/*nt_fill_cnt++;
			continue;*/
		 } else if(document.getElementById("email"+j).value != "") {
			var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var toArr= document.getElementById("email"+j).value.split(","); 			//split into array
			for (var i=0;i<toArr.length;i++) 				    					//loop array to validate correct address
			{
				if ( !toArr[i].match(reg) ) 										//if not match, alert and stop loop
				{	
					alert("invalid email address \n"+toArr[i]);
					document.getElementById("email"+j).focus();
					return false;
				}
			}
		}	
		
	}

	//if(document.getElementById("same-stall").value == "No") {
		
	//}
	//document.getElementById("reg_registration_form_2").submit();
	
	return true;
}

function countChar(val)
{
	var len = val.value.length;
	if (len > 800) 
	{
		val.value = val.value.substring(0, 800);
	}
	else 
	{
		$('#count').text(800 - len);
	}
};