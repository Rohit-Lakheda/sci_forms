function validate_ex() {
  if (
    document.getElementById("booth_size1").checked == false &&
    document.getElementById("booth_size2").checked == false
  ) {
    alert("Please select booth size.");
    document.getElementById("booth_size1").focus();
    return false;
  }
  if (document.getElementById("sector").value == "") {
    alert("Please enter sector.");
    document.getElementById("sector").focus();
    return false;
  }
  if (document.getElementById("subsector").value == "") {
    alert("Please select subsector.");
    document.getElementById("subsector").focus();
    return false;
  }

  if (document.getElementById("exhi_name").value == "") {
    alert("Please enter Name of Exhibitor.");
    document.getElementById("exhi_name").focus();
    return false;
  }
  if (document.getElementById("ci_certf").value == "") {
    alert("Please Upload Organisation Registration Certificate.");
    document.getElementById("ci_certf").focus();
    return false;
  }
  if (document.getElementById("addr1").value == "") {
    alert("Please enter Invoice Address.");
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
  /*if (document.getElementById("country").value == "") {
		alert("Please enter country.");
		document.getElementById("country").focus();
		return false;
	}*/
  if (document.getElementById("zip").value == "") {
    alert("Please enter pin/zip code.");
    document.getElementById("zip").focus();
    return false;
  }
  if (document.getElementById("fon").value == "") {
    alert("Please enter Telephone Number.");
    document.getElementById("fon").focus();
    return false;
  }
  if (document.getElementById("gst").value == "") {
    alert("Please select GST number registered or not.");
    document.getElementById("gst").focus();
    return false;
  }
  if (document.getElementById("gst").value == "Registered") {
    if (document.getElementById("gst_number").value == "") {
      alert("Please enter GST number.");
      document.getElementById("gst_number").focus();
      return false;
    }
  }
  if (document.getElementById("pan_number").value == "") {
    alert("Please enter PAN Number.");
    document.getElementById("pan_number").focus();
    return false;
  }

  if (document.getElementById("cp_title").value == "") {
    alert("Please enter  title.");
    document.getElementById("cp_title").focus();
    return false;
  }
  if (document.getElementById("cp_fname").value == "") {
    alert("Please enter  first name.");
    document.getElementById("cp_fname").focus();
    return false;
  }
  if (document.getElementById("cp_lname").value == "") {
    alert("Please enter  last name.");
    document.getElementById("cp_lname").focus();
    return false;
  }
  if (document.getElementById("cp_desig").value == "") {
    alert("Please enter  Designation.");
    document.getElementById("cp_desig").focus();
    return false;
  }
  if (document.getElementById("email").value == "") {
    alert("Please enter  email id.");
    document.getElementById("email").focus();
    return false;
  } else if (document.getElementById("email").value != "") {
    var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var toArr = document.getElementById("email").value.split(","); // split
    // into
    // array
    for (
      var i = 0;
      i < toArr.length;
      i++ // loop array to validate // correct address
    ) {
      if (!toArr[i].match(reg)) {
        // if not match, alert and stop loop
        alert("Invalid email address \n" + toArr[i]);
        document.getElementById("email").focus();
        return false;
      }
    }
  }

  if (document.getElementById("mob").value == "") {
    alert("Please enter contact person Mobile number.");
    document.getElementById("mob").focus();
    return false;
  }

  if (document.getElementById("website").value == "") {
    alert("Please enter website.");
    document.getElementById("website").focus();
    return false;
  }

  /*var var_exbhi_profile = tinyMCE.get("exbhi_profile").getContent();
	// alert(var_exbhi_profile);
	if (var_exbhi_profile == "") {
		alert("Please enter Organisation Profile.");
		document.getElementById("exbhi_profile").focus();
		return false;
	}*/

  /*var prof_len = var_exbhi_profile.replace(/(<([^>]+)>)/ig, "");
	prof_len = prof_len.replace(/&nbsp;/gi, "");
	proftinylen = prof_len.length;
	// alert(proftinylen);
	proftinylen = $('#charlimit').val();alert(proftinylen);*/

  /*var var_exbhi_profile = tinyMCE.get("exbhi_profile").getContent();
	var prof_len = var_exbhi_profile.replace(/(<([^>]+)>)/ig, "");
	prof_len = prof_len.replace(/&nbsp;/gi, "");
	proftinylen = prof_len.length;
	if (proftinylen >= 781) {
		alert("Please enter profile details less than or equal to 780 characters.");
		document.getElementById("exbhi_profile").focus();
		return false;
	}*/

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

function showTxt() {
  /*if (document.getElementById("sector").value == "") {
		alert("Please select Sector.");
	} else {*/
  /*if (document.getElementById("sector").value == 'Information Technology') {	
			document.getElementById("bite").style.display = "block";
			document.getElementById("bib").style.display = "none";
		} else if (document.getElementById("sector").value == 'Bio Technology') {	
			document.getElementById("bite").style.display = "none";
			document.getElementById("bib").style.display = "block";
		}*/
  if (document.getElementById("Cc").checked == true) {
    document.getElementById("credit_card").style.display = "none";
    document.getElementById("debit_card").style.display = "none";
    document.getElementById("bank_transfer1").style.display = "none";
    document.getElementById("bank_transfer2").style.display = "none";
    document.getElementById("cheque").style.display = "none";
    /*if (document.getElementById("sector").value == 'Information Technology') {				
    			document.getElementById("credit_card").style.display = "none";
				document.getElementById("debit_card").style.display = "none";
				document.getElementById("bank_transfer1").style.display = "none";
				document.getElementById("bank_transfer2").style.display = "none";
				document.getElementById("cheque").style.display = "none";
				
			} else if (document.getElementById("sector").value == 'Bio Technology') {				
				document.getElementById("bcredit_card").style.display = "none";
				document.getElementById("bdebit_card").style.display = "none";
				document.getElementById("bbank_transfer1").style.display = "none";
				document.getElementById("bbank_transfer2").style.display = "none";
				document.getElementById("bcheque").style.display = "none";
			}	*/
  }
  if (document.getElementById("Cheque").checked == true) {
    document.getElementById("credit_card").style.display = "none";
    document.getElementById("debit_card").style.display = "none";
    document.getElementById("bank_transfer1").style.display = "none";
    document.getElementById("bank_transfer2").style.display = "none";
    document.getElementById("cheque").style.display = "block";
    /*if (document.getElementById("sector").value == 'Information Technology') {
				document.getElementById("credit_card").style.display = "none";
				document.getElementById("debit_card").style.display = "none";
				document.getElementById("bank_transfer1").style.display = "none";
				document.getElementById("bank_transfer2").style.display = "none";
				document.getElementById("cheque").style.display = "block";
			} else if (document.getElementById("sector").value == 'Bio Technology') {
				document.getElementById("bcredit_card").style.display = "none";
				document.getElementById("bdebit_card").style.display = "none";
				document.getElementById("bbank_transfer1").style.display = "none";
				document.getElementById("bbank_transfer2").style.display = "none";
				document.getElementById("bcheque").style.display = "block";
			}	*/
  }
  if (document.getElementById("BT").checked == true) {
    if (document.getElementById("Indian").checked == true) {
      document.getElementById("credit_card").style.display = "none";
      document.getElementById("debit_card").style.display = "none";
      document.getElementById("bank_transfer1").style.display = "block";
      document.getElementById("bank_transfer2").style.display = "none";
      document.getElementById("cheque").style.display = "none";
      /*if (document.getElementById("sector").value == 'Information Technology') {
					document.getElementById("credit_card").style.display = "none";
					document.getElementById("debit_card").style.display = "none";
					document.getElementById("bank_transfer1").style.display = "block";
					document.getElementById("bank_transfer2").style.display = "none";
					document.getElementById("cheque").style.display = "none";
				} else if (document.getElementById("sector").value == 'Bio Technology') {
					document.getElementById("bcredit_card").style.display = "none";
					document.getElementById("bdebit_card").style.display = "none";
					document.getElementById("bbank_transfer1").style.display = "block";
					document.getElementById("bbank_transfer2").style.display = "none";
					document.getElementById("bcheque").style.display = "none";
				}*/
    } else if (document.getElementById("Foreign").checked == true) {
      document.getElementById("credit_card").style.display = "none";
      document.getElementById("debit_card").style.display = "none";
      document.getElementById("bank_transfer2").style.display = "block";
      document.getElementById("bank_transfer1").style.display = "none";
      document.getElementById("cheque").style.display = "none";
      /*if (document.getElementById("sector").value == 'Information Technology') {
					document.getElementById("credit_card").style.display = "none";
					document.getElementById("debit_card").style.display = "none";
					document.getElementById("bank_transfer2").style.display = "block";
					document.getElementById("bank_transfer1").style.display = "none";
					document.getElementById("cheque").style.display = "none";
				} else if (document.getElementById("sector").value == 'Bio Technology') {
					document.getElementById("bcredit_card").style.display = "none";
					document.getElementById("bdebit_card").style.display = "none";
					document.getElementById("bbank_transfer2").style.display = "block";
					document.getElementById("bbank_transfer1").style.display = "none";
					document.getElementById("bcheque").style.display = "none";
				}*/
    }
  }
  if (document.getElementById("Dc").checked == true) {
    if (document.getElementById("sector").value == "Information Technology") {
      document.getElementById("credit_card").style.display = "none";
      document.getElementById("debit_card").style.display = "block";
      document.getElementById("bank_transfer1").style.display = "none";
      document.getElementById("bank_transfer2").style.display = "none";
      document.getElementById("cheque").style.display = "none";
    } else if (document.getElementById("sector").value == "Bio Technology") {
      document.getElementById("bcredit_card").style.display = "none";
      document.getElementById("bdebit_card").style.display = "block";
      document.getElementById("bbank_transfer1").style.display = "none";
      document.getElementById("bbank_transfer2").style.display = "none";
      document.getElementById("bcheque").style.display = "none";
    }
  }
  //}
}

function chk_act() {
  if (document.getElementById("find_us").value == "Others") {
    document.getElementById("oth").style.display = "block";
    document.getElementById("specify").focus();
  } else {
    document.getElementById("oth").style.display = "none";
  }
}

function validate_exo() {
  if (document.getElementById("booth_size").value == "") {
    alert("Please select booth size.");
    document.getElementById("booth_size1").focus();
    return false;
  }
  if (document.getElementById("sector").value == "") {
    alert("Please enter sector.");
    document.getElementById("sector").focus();
    return false;
  }
  if (document.getElementById("subsector").value == "") {
    alert("Please select subsector.");
    document.getElementById("subsector").focus();
    return false;
  }

  if (document.getElementById("delegate_type").value == "") {
    alert("Please select Select Category.");
    document.getElementById("delegate_type").focus();
    return false;
  }

  if (document.getElementById("exhi_name").value == "") {
    alert("Please enter Name of Exhibitor.");
    document.getElementById("exhi_name").focus();
    return false;
  }
  if (document.getElementById("ci_certf").value == "") {
    alert("Please Upload Organisation Registration Certificate.");
    document.getElementById("ci_certf").focus();
    return false;
  }
  if (document.getElementById("addr1").value == "") {
    alert("Please enter Invoice Address.");
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
  /*if (document.getElementById("country").value == "") {
		alert("Please enter country.");
		document.getElementById("country").focus();
		return false;
	}*/
  if (document.getElementById("zip").value == "") {
    alert("Please enter pin/zip code.");
    document.getElementById("zip").focus();
    return false;
  }
  if (document.getElementById("fon").value == "") {
    alert("Please enter Telephone Number.");
    document.getElementById("fon").focus();
    return false;
  }
  if (document.getElementById("gst").value == "") {
    alert("Please select GST number registered or not.");
    document.getElementById("gst").focus();
    return false;
  }
  if (document.getElementById("gst").value == "Registered") {
    if (document.getElementById("gst_number").value == "") {
      alert("Please enter GST number.");
      document.getElementById("gst_number").focus();
      return false;
    }
  }
  if (document.getElementById("pan_number").value == "") {
    alert("Please enter PAN Number.");
    document.getElementById("pan_number").focus();
    return false;
  }

  if (document.getElementById("cp_title").value == "") {
    alert("Please enter  title.");
    document.getElementById("cp_title").focus();
    return false;
  }
  if (document.getElementById("cp_fname").value == "") {
    alert("Please enter  first name.");
    document.getElementById("cp_fname").focus();
    return false;
  }
  if (document.getElementById("cp_lname").value == "") {
    alert("Please enter  last name.");
    document.getElementById("cp_lname").focus();
    return false;
  }
  if (document.getElementById("cp_desig").value == "") {
    alert("Please enter  Designation.");
    document.getElementById("cp_desig").focus();
    return false;
  }
  if (document.getElementById("email").value == "") {
    alert("Please enter  email id.");
    document.getElementById("email").focus();
    return false;
  } else if (document.getElementById("email").value != "") {
    var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var toArr = document.getElementById("email").value.split(","); // split
    // into
    // array
    for (
      var i = 0;
      i < toArr.length;
      i++ // loop array to validate // correct address
    ) {
      if (!toArr[i].match(reg)) {
        // if not match, alert and stop loop
        alert("Invalid email address \n" + toArr[i]);
        document.getElementById("email").focus();
        return false;
      }
    }
  }

  if (document.getElementById("mob").value == "") {
    alert("Please enter contact person Mobile number.");
    document.getElementById("mob").focus();
    return false;
  }

  if (document.getElementById("website").value == "") {
    alert("Please enter website.");
    document.getElementById("website").focus();
    return false;
  }

  /*var var_exbhi_profile = tinyMCE.get("exbhi_profile").getContent();
	// alert(var_exbhi_profile);
	if (var_exbhi_profile == "") {
		alert("Please enter Organisation Profile.");
		document.getElementById("exbhi_profile").focus();
		return false;
	}*/

  /*var prof_len = var_exbhi_profile.replace(/(<([^>]+)>)/ig, "");
	prof_len = prof_len.replace(/&nbsp;/gi, "");
	proftinylen = prof_len.length;
	// alert(proftinylen);
	proftinylen = $('#charlimit').val();alert(proftinylen);*/

  /*var var_exbhi_profile = tinyMCE.get("exbhi_profile").getContent();
	var prof_len = var_exbhi_profile.replace(/(<([^>]+)>)/ig, "");
	prof_len = prof_len.replace(/&nbsp;/gi, "");
	proftinylen = prof_len.length;
	if (proftinylen >= 781) {
		alert("Please enter profile details less than or equal to 780 characters.");
		document.getElementById("exbhi_profile").focus();
		return false;
	}*/

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
