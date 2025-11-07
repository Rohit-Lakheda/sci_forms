function validate_registration_form_2() {
	if(document.getElementById("sector").value == "") {
		alert("Please select sector.");
        document.getElementById("sector").focus();
        return false;
	}

    if ((document.getElementById("Indian").checked == false) && (document.getElementById("Foreign").checked == false)) {
        alert("Please select the Nationality type.");
        document.getElementById("Indian").focus();
        return false;
    }

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

    
    if((document.getElementById("cata1").checked == false) && (document.getElementById("cata2").checked == false) && (document.getElementById("cata3").checked == false) && (document.getElementById("cata4").checked == false))
    {
                alert("Please select delegate Category.");
                document.getElementById("cata1").focus();
                return false;
    }
    
    if((document.getElementById("cata_m1").checked == false) && (document.getElementById("cata_m2").checked == false) && (document.getElementById("cata_m3").checked == false) && (document.getElementById("cata_m4").checked == false))
    {
                alert("Please select delegate type.");
                document.getElementById("cata_m1").focus();
                return false;
    }
	
	if(cata_type == 'QM3D14X') {
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
		if(document.getElementById("total_dele").value == "") {
			alert("Please select number of delegate(s).");
			document.getElementById("total_dele").focus();
			return false;
		}
		
		if(document.getElementById("country").value == "") {
			alert("Please select How do you know about Event.");
			document.getElementById("event_know").focus();
			return false;
		} else if(document.getElementById("country").value == 'Other') {
			if(document.getElementById("other_country").value == "") {
				alert("Please enter Other GIA Country Name.");
				document.getElementById("other_country").focus();
				return false;
			}
		}
	}
	if(cata_type == 'AS5OC') {
		if(document.getElementById("total_dele").value == "") {
			alert("Please select number of delegate(s).");
			document.getElementById("total_dele").focus();
			return false;
		}
		if(document.getElementById("assoc_name").value == "") {
			alert("Please Select Association.");
			document.getElementById("assoc_name").focus();
			return false;
		}
	}
    
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

    if (document.getElementById("vercode_reg").value == "") {
        alert("Please fill the characters you see in image.");
        document.getElementById("vercode_reg").focus();
        return false;
    } else if (document.getElementById("vercode_reg").value != "") {
        compstr = document.getElementById("test").value;
        if (document.getElementById("vercode_reg").value != compstr) {
            alert("Please fill correct characters you see in image.");
            document.getElementById("vercode_reg").value = "";
            document.getElementById("vercode_reg").focus();
            return false;
        }
    }
    //document.getElementById("reg_registration_form_1").submit();
    return true;
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

function show_cata()
{

    if(document.getElementById("Indian").checked == true)
    {
        //document.getElementById("cat_ind").style.display = "block";
        //document.getElementById("cat_int").style.display = "none";
        //document.getElementById("cata4").checked = false;   
        //document.getElementById("cata5").checked = false;   
        //document.getElementById("cata6").checked = false;   
    } 
    else if(document.getElementById("Foreign").checked == true)
    {
        
        //document.getElementById("cat_int").style.display = "block";
        //document.getElementById("cat_ind").style.display = "none";
        //document.getElementById("cata1").checked = false;
        //document.getElementById("cata2").checked = false;
        //document.getElementById("cata3").checked = false;   
    }
    else{       
        alert("Please select the Nationality type.");
        document.getElementById("Indian").focus();
        return false;
    } 
    
    //chkPostr_2();
    
}

function chkPostr_2(){
    
        
        if(document.getElementById("Indian").checked == true){
            
            if(document.getElementById("cata_m4").checked == true){
                
                document.getElementById("cata2").disabled = true;   
            }
            else{
                                                
                document.getElementById("cata2").disabled = false;      
            }
            
            
        }
        else if(document.getElementById("Foreign").checked == true){            
            
            if(document.getElementById("cata_m4").checked == true){
                
                document.getElementById("cata5").disabled = true;   
            }
            else{
                                                
                document.getElementById("cata5").disabled = false;      
            }
            
        }   
        else{           
            alert("Please select the Nationality type.");
            document.getElementById("Indian").focus();
            return false;
        }
    

}

function chkPostr(){
    

    
}

function check_num(e,txt)
{
    /*var unicode=e.keyCode? e.keyCode : e.charCode;
    var text1 = txt;
    if((unicode == "48") || (unicode == "49") || (unicode == "50") || (unicode == "51") || (unicode=="52") || (unicode=="53") || (unicode=="54") || (unicode=="55") || (unicode=="56") || (unicode=="57") || (unicode=="96") || (unicode=="97") || (unicode=="98") || (unicode=="99") || (unicode=="100") || (unicode=="101") || (unicode=="102") || (unicode=="103") || (unicode=="104") || (unicode=="105") || (unicode=="8") || (unicode=="46") || (unicode=="9") || (unicode=="16"))
    {
        
    }
    
    else if((unicode!="48") || (unicode!="49") || (unicode!="50") || (unicode!="51") || (unicode!="52") || (unicode!="53") || (unicode!="54") || (unicode!="55") || (unicode!="56") || (unicode!="57") || (unicode!="96") || (unicode!="97") || (unicode!="98") || (unicode!="99") || (unicode!="100") || (unicode!="101") || (unicode!="102") || (unicode!="103") || (unicode!="104") || (unicode!="105") || (unicode!="8") || (unicode!="46") || (unicode!="9") || (unicode!="16"))
    {
        alert("Please enter numbers");
        document.getElementById(text1).value="";
    } */
	
	var intRegex = /^\d+$/;
	var str = document.getElementById(txt).value;
	if(!intRegex.test(str)) {
	   document.getElementById(txt).value="";
	}
}
function check_char(ev,txt2)
{
    var unicode2=ev.keyCode? ev.keyCode : ev.charCode;
    var text2 = txt2;
    if((unicode2=="48") || (unicode2=="49") || (unicode2=="50") || (unicode2=="51") || (unicode2=="52") || (unicode2=="53") || (unicode2=="54") || (unicode2=="55") || (unicode2=="56") || (unicode2=="57") || (unicode2=="96") || (unicode2=="97") || (unicode2=="98") || (unicode2=="99") || (unicode2=="100") || (unicode2=="101") || (unicode2=="102") || (unicode2=="103") || (unicode2=="104") || (unicode2=="105"))
    {
        alert("Please enter character");
        document.getElementById(txt2).value="";
    }   
}

function showTxt()
{
    if(document.getElementById("Cc").checked == true)
    {
        document.getElementById("pay1").style.display = "block";            
        document.getElementById("pay2").style.display = "none"; 
        document.getElementById("pay3").style.display = "none"; 
        document.getElementById("pay4").style.display = "none"; 
            
    }
    if(document.getElementById("Cheque").checked == true)
    {
        document.getElementById("pay1").style.display = "none";         
        document.getElementById("pay2").style.display = "block";    
        document.getElementById("pay3").style.display = "none";
        document.getElementById("pay4").style.display = "none"; 
                
    }
    if(document.getElementById("BT").checked == true)
    {
        document.getElementById("pay1").style.display = "none";         
        document.getElementById("pay2").style.display = "none"; 
        document.getElementById("pay3").style.display = "block";
        document.getElementById("pay4").style.display = "none"; 
        
    }
    if(document.getElementById("Dc").checked == true)
    {
        document.getElementById("pay1").style.display = "none";         
        document.getElementById("pay2").style.display = "none"; 
        document.getElementById("pay3").style.display = "none";
        document.getElementById("pay4").style.display = "block";    
        
    }
    
    
}
