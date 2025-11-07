var mceObjParent = new Object();

tinyMCE.init({
		// General options
		mode : "specific_textareas",
        editor_selector : "exbhi_profile",
		//selector: "#exbhi_profile",
		//mode : "textarea",
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
		
		charLimit : 700, // this is a default value which can get modified later
		//set up a new editor function 
		setup : function(ed) {
		 //peform this action every time a key is pressed
		 ed.onKeyUp.add(function(ed, e) {//alert('okj');
			
		 //define local variables
		 var tinymax, tinylen, htmlcount;
		 //manually setting our max character limit
		 tinymax = ed.settings.charLimit;
		 var profileText = ed.getContent();
		 //alert(profileText);
		//grabbing the length of the curent editors content
		var temptext = ed.getContent().replace(/(<([^>]+)>)/ig,"");
		temptext = temptext.replace(/&nbsp;/gi, "");
	     tinylen = temptext.length;
		 //alert(tinylen+'auto');
		 //setting up the text string that will display in the path area
		 htmlcount = "Character Count: " + tinylen + "/" + tinymax;//alert(ed.getContent());
		 //if the user has exceeded the max turn the path bar red.
		 if (tinymax < tinylen) {
				$('#limit-char').html('<span style="color:red;"><strong>' + htmlcount + '</strong></span>');
			 	/*e.preventDefault();
		        e.stopPropagation();
		        return false;*/
		 } else {
			// prevent insertion of typed character
			 $('#limit-char').html(htmlcount);
		 }
		 });
		},
		 
		//onchange_callback : "countChar",
		// Example content CSS (should be your site CSS)
		content_css : "assets/global/plugins/tiny_mce/themes/simple/skins/default/content.css",

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

function validate_ex() {
	if($('#exhi_profile').length) {
		if (document.getElementById("exhi_profile").value == "") {
			alert("Please select Sector.");
			document.getElementById("exhi_profile").focus();
			return false;
		}
	}

	/*if (document.getElementById("category").value == "") {
		alert("Please select category.");
		document.getElementById("category").focus();
		return false;
	}*/
	if (document.getElementById("exhi_name").value == "") {
		alert("Please enter Name of Exhibitor.");
		document.getElementById("exhi_name").focus();
		return false;
	}
	/*if (document.getElementById("booth_space").value == "") {
		alert("Please select booth space.");
		document.getElementById("booth_space").focus();
		return false;
	}*/
	/*
	  if(document.getElementById("booth_no").value == "") { alert("Please enter
	  Booth/Pavilion no."); document.getElementById("booth_no").focus(); return
	  false; }
	 
	if (document.getElementById("booth_area").value == "") {
		alert("Please enter booth area.");
		document.getElementById("booth_area").focus();
		return false;
	}
	var chk_booth_area = parseInt(document.getElementById("booth_area").value);

	if (chk_booth_area < 3) {

		alert("Booth/ Stall area should be greater or equal to 3 sqm");
		document.getElementById("booth_area").focus();
		return false;
	}

	if (document.getElementById("booth_area_unit").value == "") {
		alert("Please enter booth area unit.");
		document.getElementById("booth_area_unit").focus();
		return false;
	}*/

	if (document.getElementById("fascia_name").value == "") {
		alert("Please enter Name required on Fascia.");
		document.getElementById("fascia_name").focus();
		return false;
	}

	if (document.getElementById("cp_title").value == "") {
		alert("Please enter contact person title.");
		document.getElementById("cp_title").focus();
		return false;
	}
	if (document.getElementById("cp_fname").value == "") {
		alert("Please enter contact person first name.");
		document.getElementById("cp_fname").focus();
		return false;
	}
	if (document.getElementById("cp_lname").value == "") {
		alert("Please enter contact person last name.");
		document.getElementById("cp_lname").focus();
		return false;
	}
	if (document.getElementById("desig").value == "") {
		alert("Please enter contact person designation.");
		document.getElementById("desig").focus();
		return false;
	}
	if (document.getElementById("addr1").value == "") {
		alert("Please enter address line 1.");
		document.getElementById("addr1").focus();
		return false;
	}
	if (document.getElementById("city").value == "") {
		alert("Please enter city.");
		document.getElementById("city").focus();
		return false;
	}
	if (document.getElementById("state").value == "") {
		alert("Please enter state.");
		document.getElementById("state").focus();
		return false;
	}
	if (document.getElementById("country").value == "") {
		alert("Please enter country.");
		document.getElementById("country").focus();
		return false;
	}
	if (document.getElementById("zip").value == "") {
		alert("Please enter pin/zip code.");
		document.getElementById("zip").focus();
		return false;
	}

	if (document.getElementById("email").value == "") {
		alert("Please enter your email id.");
		document.getElementById("email").focus();
		return false;
	} else if (document.getElementById("email").value != "") {
		var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var toArr = document.getElementById("email").value.split(","); // split
																		// into
																		// array
		for (var i = 0; i < toArr.length; i++) // loop array to validate
												// correct address
		{
			if (!toArr[i].match(reg)) // if not match, alert and stop loop
			{
				alert("Invalid email address \n" + toArr[i]);
				document.getElementById("email").focus();
				return false;
			}
		}
	}

	if (document.getElementById("mob").value == "") {
		alert("Please enter Mobile number.");
		document.getElementById("mob").focus();
		return false;
	}

	if (document.getElementById("website").value == "") {
		alert("Please enter website.");
		document.getElementById("website").focus();
		return false;
	}

	/*if (document.getElementById("logo").value == "") {
		alert("Please upload Organisation Logo.");
		document.getElementById("logo").focus();
		return false;
	}*/

	/*if (document.getElementById("keywords").value == "") {
		alert("Please enter Keywords.");
		document.getElementById("keywords").focus();
		return false;
	}*/

	var var_exbhi_profile = tinyMCE.get("exbhi_profile").getContent();
	// alert(var_exbhi_profile);
	if (var_exbhi_profile == "") {
		alert("Please enter profile details.");
		document.getElementById("exbhi_profile").focus();
		return false;
	}

	var prof_len = var_exbhi_profile.replace(/(<([^>]+)>)/ig, "");
	prof_len = prof_len.replace(/&nbsp;/gi, "");
	proftinylen = prof_len.length;
	//console.log(prof_len);return false;
	//alert(proftinylen);
	if (proftinylen >= 751) {
		alert("Please enter profile details less than or equal to 750 characters.");
		document.getElementById("exbhi_profile").focus();
		return false;
	}

	if (document.getElementById("vercode_ex").value == "") {
		alert("Please fill the characters you see in image.");
		document.getElementById("vercode_ex").focus();
		return false;
	} else if (document.getElementById("vercode_ex").value != "") {
		compstr = document.getElementById("test").value;
		if (document.getElementById("vercode_ex").value != compstr) {
			alert("Please fill correct characters you see in image.");
			document.getElementById("vercode_ex").value = "";
			document.getElementById("vercode_ex").focus();
			return false;
		}
	}

	return true;
}

function chk_act() {
	if (document.getElementById("find_us").value == "Others") {
		document.getElementById("oth").style.display = "block";
		document.getElementById("specify").focus();
	} else {
		document.getElementById("oth").style.display = "none";
	}
}

function profileTextCount() {
	var var_exbhi_profile = tinyMCE.get("exbhi_profile").getContent();
	var prof_len = var_exbhi_profile.replace(/(<([^>]+)>)/ig, "");
	prof_len = prof_len.replace(/&nbsp;/gi, "");
	proftinylen = prof_len.length;
	//alert(proftinylen);
	htmlcount = "Character Count: " + proftinylen + "/700";
	//alert(htmlcount);
	$('#limit-char').text(htmlcount);
}

function addressTextCount() {
	/*var var_exbhi_profile = document.getElementById("addr1").value;
	proftinylen = var_exbhi_profile.length;
	//alert(proftinylen);
	htmlcount = "Character Count: " + proftinylen + "/150";
	//alert(htmlcount);
	$('#limit-char1').text(htmlcount);*/

	var tval = $('#addr1').val(),
	tlength = tval.length,
	set = 151;
	//remain = parseInt(set - tlength);
	var htmlcount = "Character Count: " + tlength + "/150";
	$('#limit-char1').text(htmlcount);
}