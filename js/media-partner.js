
var mceObjParent = new Object();

	tinyMCE.init({
		// General options
				
		mode : "textareas",
		theme : "simple",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
		
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		//onchange_callback : "countChar",
		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
	
		
		
		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
		
	
	});

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
	
	
	function validate_ex()
	{
		/*if(document.getElementById("exhi_name").value == "")
		{
			alert("Please enter Name of Exhibitor.");
			document.getElementById("exhi_name").focus();
			return false;
		}*/
	/*	
		if(document.getElementById("booth_no").value == "")
		{
			alert("Please enter Booth/Pavilion no.");
			document.getElementById("booth_no").focus();
			return false;
		}
	*/	
		/*if(document.getElementById("booth_area").value == "")
		{
			alert("Please enter booth area.");
			document.getElementById("booth_area").focus();
			return false;
		}
		var chk_booth_area = parseInt(document.getElementById("booth_area").value);
		
		if(chk_booth_area<3){
			
			alert("Booth/ Stall area should be greator or equal to 3sqm");
			document.getElementById("booth_area").focus();
			return false;
		}
		
		if(document.getElementById("booth_area_unit").value == "")
		{
			alert("Please enter booth area unit.");
			document.getElementById("booth_area_unit").focus();
			return false;
		}
		
		if(document.getElementById("fascia_name").value == "")
		{
			alert("Please enter Name required on Fascia.");
			document.getElementById("fascia_name").focus();
			return false;
		}*/
		
		
		if(document.getElementById("cp_title").value == "")
		{
			alert("Please enter contact person title.");
			document.getElementById("cp_title").focus();
			return false;
		}
		if(document.getElementById("cp_fname").value == "")
		{
			alert("Please enter contact person first name.");
			document.getElementById("cp_fname").focus();
			return false;
		}
		if(document.getElementById("cp_lname").value == "")
		{
			alert("Please enter contact person last name.");
			document.getElementById("cp_lname").focus();
			return false;
		}
		if(document.getElementById("desig").value == "")
		{
			alert("Please enter contact person designation.");
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
		if(document.getElementById("zip").value == "")
		{
			alert("Please enter pin/zip code.");
			document.getElementById("zip").focus();
			return false;
		}
	
		if(document.getElementById("mob").value == "")
		{
			alert("Please enter  Mobile no.");
			document.getElementById("mob").focus();
			return false;
		}
		
		if(document.getElementById("email").value == "")
		{
			alert("Please enter your email id.");
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
					alert("invalid email address \n"+toArr[i]);
					document.getElementById("email").focus();
					return false;
				}
			}
		}	
		
		var var_exbhi_profile = tinyMCE.get("exbhi_profile").getContent();
		
		if(var_exbhi_profile==""){
			alert("Please enter profile details.");
			document.getElementById("exbhi_profile").focus();
			return false;
		}
		
		prof_len = var_exbhi_profile.length;
		
		if(prof_len>750){
			alert("Please enter profile less than 750 characters.");
			document.getElementById("exbhi_profile").focus();
			return false;
		}
		
		
		
		if(document.getElementById("g-recaptcha-response").value == "") {
			alert("Please re-enter your reCAPTCHA.");
			document.getElementById("g-recaptcha-response").focus();
			return false;
		}
	
	//document.getElementById("exhibitors_form_1").submit();
	
	
	return true;
}

function chk_act()
{
	if(document.getElementById("find_us").value == "Others")
	{
		document.getElementById("oth").style.display = "block";
		document.getElementById("specify").focus();		
	}
	else
	{
		document.getElementById("oth").style.display = "none";
	}
}
	