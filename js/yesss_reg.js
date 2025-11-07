function check_num(e,txt)
{
	var unicode=e.keyCode? e.keyCode : e.charCode;
	var text1 = txt;
	if((unicode == "48") || (unicode == "49") || (unicode == "50") || (unicode == "51") || (unicode=="52") || (unicode=="53") || (unicode=="54") || (unicode=="55") || (unicode=="56") || (unicode=="57") || (unicode=="96") || (unicode=="97") || (unicode=="98") || (unicode=="99") || (unicode=="100") || (unicode=="101") || (unicode=="102") || (unicode=="103") || (unicode=="104") || (unicode=="105") || (unicode=="8") || (unicode=="46") || (unicode=="9") || (unicode=="16"))
	{
		
	}
	
	else if((unicode!="48") || (unicode!="49") || (unicode!="50") || (unicode!="51") || (unicode!="52") || (unicode!="53") || (unicode!="54") || (unicode!="55") || (unicode!="56") || (unicode!="57") || (unicode!="96") || (unicode!="97") || (unicode!="98") || (unicode!="99") || (unicode!="100") || (unicode!="101") || (unicode!="102") || (unicode!="103") || (unicode!="104") || (unicode!="105") || (unicode!="8") || (unicode!="46") || (unicode!="9") || (unicode!="16"))
	{
		alert("Please enter numbers");
		document.getElementById(text1).value="";
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

	function validate_yesss_abstracts_reg()
	{
			if(document.getElementById("title").value == "")
			{
				alert("Please Select Entrepreneur's title.");
				document.getElementById("title").focus();
				return false;
			}
			if(document.getElementById("fname").value == "")
			{
				alert("Please Enter Entrepreneur's First Name.");
				document.getElementById("fname").focus();
				return false;
			}
			if(document.getElementById("lname").value == "")
			{
				alert("Please Enter Entrepreneur's Last Name.");
				document.getElementById("lname").focus();
				return false;
			}
			if(document.getElementById("desig").value == "")
			{
				alert("Please Enter Designation.");
				document.getElementById("desig").focus();
				return false;
			}
			if(document.getElementById("org").value == "")
			{
				alert("Please Enter Start-Up Company Name.");
				document.getElementById("org").focus();
				return false;
			}
			
			if(document.getElementById("month").value == "")
			{
				alert("Please Enter Month Inception.");
				document.getElementById("month").focus();
				return false;
			}
			
			if(document.getElementById("month_year_inception").value == "")
			{
				alert("Please Enter Year Of Inception.");
				document.getElementById("month_year_inception").focus();
				return false;
			}
			
			
			if(document.getElementById("total_emp").value == "")
			{
				alert("Please Enter No. Of Employees");
				document.getElementById("total_emp").focus();
				return false;
			}
			if(document.getElementById("address1").value == "")
			{
				alert("Please Enter Address");
				document.getElementById("address1").focus();
				return false;
			}
			if(document.getElementById("city").value == "")
			{
				alert("Please Enter City");
				document.getElementById("city").focus();
				return false;
			}
			if(document.getElementById("state").value == "")
			{
				alert("Please Enter State");
				document.getElementById("state").focus();
				return false;
			}
			if(document.getElementById("country").value == "")
			{
				alert("Please Select Country");
				document.getElementById("country").focus();
				return false;
			}
			if(document.getElementById("email").value == "")
			{
				alert("Please Enter Email-Id.");
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
			}
			
			if(document.getElementById("mob_no").value == "")
			{
				alert("Please Enter Mobile Number");
				document.getElementById("mob_no").focus();
				return false;
			}
            
			if((document.getElementById("enquiry1").checked == false)     &&	 (document.getElementById("enquiry2").checked == false)     &&	    (document.getElementById("enquiry3").checked == false)     &&	    (document.getElementById("enquiry4").checked == false)     &&	   (document.getElementById("enquiry5").checked == false)    &&	    (document.getElementById("enquiry6").checked == false) && (document.getElementById("enquiry7").checked == false)  && (document.getElementById("enquiry8").checked == false)  && (document.getElementById("enquiry9").checked == false) && (document.getElementById("enquiry10").checked == false) && (document.getElementById("enquiry11").checked == false) && (document.getElementById("enquiry12").checked == false))		
			{		
				alert ('You didn\'t choose any of Main Vertical/Sector Of Work!');		
				document.getElementById("enquiry1").focus();
				return false;		
			}	
	
		    if(document.getElementById("enquiry12").checked == true){
		
			document.getElementById("div_enq_other").style.display="block";
			
				if(document.getElementById("other_name").value == "")
				{
					alert ('Please Enter Other Main Vertical/Sector of work!');		
					document.getElementById("other_name").focus();
					return false;	
				}
		
	 		} else {
	 	
			document.getElementById("enquiry12").style.display="none";
		 }	
		

	 if((document.getElementById("horizonWork1").checked == false)     &&	 (document.getElementById("horizonWork2").checked == false)     &&	    (document.getElementById("horizonWork3").checked == false)     &&	    (document.getElementById("horizonWork4").checked == false)     &&	   (document.getElementById("horizonWork5").checked == false)    &&	    (document.getElementById("horizonWork6").checked == false) && (document.getElementById("horizonWork7").checked == false)  && (document.getElementById("horizonWork8").checked == false)  && (document.getElementById("horizonWork9").checked == false) && (document.getElementById("horizonWork10").checked == false))		
			{		
				alert ('You didn\'t choose any of Horizontal of work!');		
				document.getElementById("horizonWork1").focus();
				return false;		
			}	
	
	if(document.getElementById("horizonWork10").checked == true){
		
		document.getElementById("div_horizon_other").style.display="block";
			
			if(document.getElementById("horizon_other_name").value == "")
			{
				alert ('Please Enter Other Horizontal of work!');		
				document.getElementById("horizon_other_name").focus();
				return false;	
			}
	} else{
	 	
		document.getElementById("horizonWork10").style.display="none";
	 }			

	   if(document.getElementById("g-recaptcha-response").value == "") {
			alert("Please re-enter your reCAPTCHA.");
			return false;
		}
		document.getElementById("reg_registration_form_2").submit();
		return true;
	}
	
	function show_othr_fun(){
	
	 if(document.getElementById("enquiry12").checked == false){
	 	
		document.getElementById("div_enq_other").style.display="none";
		
	 }	
	 else if(document.getElementById("enquiry12").checked == true){
	
		document.getElementById("div_enq_other").style.display="block";
		document.getElementById("other_name").value="";
	 }	
	 
  }
  

  function show_horizon_othr_fun(){
	
	 if(document.getElementById("horizonWork10").checked == false){
	 	
		document.getElementById("div_horizon_other").style.display="none";
		
	 }	
	 else if(document.getElementById("horizonWork10").checked == true){
	
		document.getElementById("div_horizon_other").style.display="block";
		document.getElementById("horizon_other_name").value="";
	 }	
	 
  }
 
  function show_funding_othr_fun(){
	
	 if(document.getElementById("q11_yesss_prog8").checked == false){
	 	
		document.getElementById("div_funding_other_que").style.display="none";
		
	 }	
	 else if(document.getElementById("q11_yesss_prog8").checked == true){
	
		document.getElementById("div_funding_other_que").style.display="block";
		document.getElementById("other_name_funding").value="";
	 }	
	 
  }

function go_back() {
    window.location = ('it_yesss_abstracts_reg.php?ret=retds4fu324rn_ed24d3it');
}
	

function validateQusetionForm(){
	if(document.getElementById("q1_inno_idea").value == "")
	{
		alert("Please Enter Your Innovative Idea.");
		document.getElementById("q1_inno_idea").focus();
		return false;
	}
	if(document.getElementById("q1_inno_idea_new").value == "")
	{
			alert("Please Enter Information About Market.");
			document.getElementById("q1_inno_idea_new").focus();
			return false;
	}
	if(document.getElementById("q2_uni_product").value == "")
	{
		alert("Please Enter Unique Product.");
		document.getElementById("q2_uni_product").focus();
		return false;
	}
	if((document.getElementById("q3_busi_stage1").checked == false)  &&	 (document.getElementById("q3_busi_stage2").checked == false) && (document.getElementById("q3_busi_stage3").checked == false)     &&	    (document.getElementById("q3_busi_stage4").checked == false)     &&	   (document.getElementById("q3_busi_stage5").checked == false)    &&	    (document.getElementById("q3_busi_stage6").checked == false) && (document.getElementById("q3_busi_stage7").checked == false))	{	
		alert ('You didn\'t choose any of Business Stage!');		
		document.getElementById("q3_busi_stage1").focus();
		return false;		
	}
	if(document.getElementById("totalEmp").value == "")
	{
		alert("Please Enter Total No. of Employees.");
		document.getElementById("totalEmp").focus();
		return false;
	}
	if (document.getElementById("totalEmp").value != "") {
    	var total_Emp = document.getElementById("totalEmp").value;
        if (total_Emp == "" || total_Emp < 1 || total_Emp >= 501) {
            alert("Total No. of Employees should not more than 500.");
            document.getElementById("totalEmp").focus();
            document.getElementById("totalEmp").value = "";
            return false;
        }
    }
	if(document.getElementById("totalFounders").value == "")
	{
		alert("Please Enter Total No. of Founders.");
		document.getElementById("totalFounders").focus();
		return false;
	}
	if (document.getElementById("totalFounders").value != "") {
    	var total_Founders = document.getElementById("totalFounders").value;
        if (total_Founders == "" || total_Founders < 1 || total_Founders >= 16) {
            alert("Total No. of Founders should not more than 15.");
            document.getElementById("totalFounders").focus();
            document.getElementById("totalFounders").value = "";
            return false;
        }
    }
	if(document.getElementById("linkedin").value == "")
	{
		alert("Please Enter LinkedIn Url.");
		document.getElementById("linkedin").focus();
		return false;
	}
	if(document.getElementById("q4_idea_stage").value == "")
	{
		alert("Please Enter What You Expect To Convert Idea.");
		document.getElementById("q4_idea_stage").focus();
		return false;
	}
	if(document.getElementById("q5_annual_turn").value == "")
	{
		alert("Please Enter How long been you have operational.");
		document.getElementById("q5_annual_turn").focus();
		return false;
	}
	if(document.getElementById("q5_annual_turn_new").value == "")
	{
		alert("Please Enter Annual Turnover.");
		document.getElementById("q5_annual_turn_new").focus();
		return false;
	}
	if(document.getElementById("q6_mark_strategy").value == "")
	{
		alert("Please Enter Market Strategy.");
		document.getElementById("q6_mark_strategy").focus();
		return false;
	}
	if(document.getElementById("q7_busi_model").value == "")
	{
		alert("Please Enter Your Business Model.");
		document.getElementById("q7_busi_model").focus();
		return false;
	}
	if(document.getElementById("q8_busi_plan").value == "")
	{
		alert("Please Enter Your Business Plan.");
		document.getElementById("q8_busi_plan").focus();
		return false;
	}	

	if((document.getElementById("q10_yesss_prog1").checked == false)     &&	 (document.getElementById("q10_yesss_prog2").checked == false)     &&	    (document.getElementById("q10_yesss_prog3").checked == false)     &&	    (document.getElementById("q10_yesss_prog4").checked == false))		
	{		
		alert ('You didn\'t choose How much funding has been raised!');		
		document.getElementById("q10_yesss_prog1").focus();
		return false;		
	}



	if((document.getElementById("q11_yesss_prog1").checked == false)     &&	 (document.getElementById("q11_yesss_prog2").checked == false)     &&	    (document.getElementById("q11_yesss_prog3").checked == false)     &&	    (document.getElementById("q11_yesss_prog4").checked == false)     &&	   (document.getElementById("q11_yesss_prog5").checked == false)    &&	 (document.getElementById("q11_yesss_prog6").checked == false)  && (document.getElementById("q11_yesss_prog7").checked == false)  && (document.getElementById("q11_yesss_prog8").checked == false))	
	{		
		alert ('You didn\'t choose From whom you raised funding!');		
		document.getElementById("q11_yesss_prog1").focus();
		return false;		
	}
	
	 if(document.getElementById("q11_yesss_prog8").checked == true){
	
		document.getElementById("div_funding_other_que").style.display="block";
		if(document.getElementById("other_name_funding").value == "")
		{
			alert ('Please Enter Organisation Or Person Name Responsible for funding.');		
			document.getElementById("other_name_funding").focus();
			return false;	
		}
		
	 }
	 else{
	 	
		document.getElementById("q11_yesss_prog8").style.display="none";
	 }	

	 if((document.getElementById("Yes").checked == false) && (document.getElementById("No").checked == false) ){
	 	alert ('You didn\'t choose Funding is public or not!');		
		document.getElementById("Yes").focus();
		return false;
	 }

	 if(document.getElementById("Yes").checked == true){
	 	if(document.getElementById("fundPersonName").value == ''){

	 		alert ('Please enter person or organization name who is responsible for public funding.');		
			document.getElementById("fundPersonName").focus();
			return false;	
	 	}

	 }

	 if((document.getElementById("q12_yesss_prog1").checked == false)     &&	 (document.getElementById("q12_yesss_prog2").checked == false)     &&	    (document.getElementById("q12_yesss_prog3").checked == false)     &&	    (document.getElementById("q12_yesss_prog4").checked == false))		
	{		
		alert ('You didn\'t choose How much funding you are looking to raise!');		
		document.getElementById("q12_yesss_prog1").focus();
		return false;		
	}
	
	if(document.getElementById("totalFundRound").value == "")
	{
		alert("Please Enter Rounds of Funds.");
		document.getElementById("totalFundRound").focus();
		return false;
	}

	if((document.getElementById("q9_yesss_prog1").checked == false)     &&	 (document.getElementById("q9_yesss_prog2").checked == false)     &&	    (document.getElementById("q9_yesss_prog3").checked == false)     &&	    (document.getElementById("q9_yesss_prog4").checked == false)     &&	   (document.getElementById("q9_yesss_prog5").checked == false)    &&	    (document.getElementById("q9_yesss_prog6").checked == false) )		
	{		
		alert ('You didn\'t choose What you expect from YESSS!');		
		document.getElementById("q9_yesss_prog1").focus();
		return false;		
	}
	
	 if(document.getElementById("q9_yesss_prog6").checked == true){
	
		document.getElementById("div_enq_other_que").style.display="block";
		if(document.getElementById("other_name").value == "")
		{
			alert ('Please Enter Other Expectation from YESSS.');		
			document.getElementById("other_name").focus();
			return false;	
		}
		
	 }else{
	 	
		document.getElementById("q9_yesss_prog6").style.display="none";
	 }	
	
	document.getElementById("reg_registration_form_3").submit();
	return true;
	
	}

 function show_othr_que_div(){
	
	 if(document.getElementById("q9_yesss_prog6").checked == false){
	 	
		document.getElementById("div_enq_other_que").style.display="none";
		
	 }	
	 else if(document.getElementById("q9_yesss_prog6").checked == true){
	
		document.getElementById("div_enq_other_que").style.display="block";
		document.getElementById("other_name").value="";
	 }	
	 
  }

  function show_div_group_user() {
    if (document.getElementById("No").checked == true) {
        document.getElementById("div_group_user").style.display = "none";
        document.getElementById('fundPersonName').value = '';
    } else if (document.getElementById("Yes").checked == true) {
        document.getElementById("div_group_user").style.display = "block";
    } else {
    	document.getElementById("div_group_user").style.display = "none";
    	document.getElementById('fundPersonName').value = '';
    }
}

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1511695-47']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();