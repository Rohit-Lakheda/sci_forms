function validate_reg_registration_form_1() {
  if (document.getElementById("session_track").value == "") {
    alert("Please Select Your Session Track.");
    document.getElementById("speaker_title").focus();
    return false;
  }

  if (document.getElementById("speaker_title").value == "") {
    alert("Please select title.");
    document.getElementById("speaker_title").focus();
    return false;
  }
  if (document.getElementById("speaker_fname").value == "") {
    alert("Please enter first name.");
    document.getElementById("speaker_fname").focus();
    return false;
  }
  if (document.getElementById("speaker_lname").value == "") {
    alert("Please enter last name.");
    document.getElementById("speaker_lname").focus();
    return false;
  }
  if (document.getElementById("desig").value == "") {
    alert("Please enter Designation.");
    document.getElementById("desig").focus();
    return false;
  }
  if (document.getElementById("org").value == "") {
    alert("Please enter Name of Company.");
    document.getElementById("org").focus();
    return false;
  }
  if (document.getElementById("speaker_email_1").value == "") {
    alert("Please enter Email Id.");
    document.getElementById("speaker_email_1").focus();
    return false;
  } else {
    var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var toArr = document.getElementById("speaker_email_1").value.split(","); //split into array
    for (
      var i = 0;
      i < toArr.length;
      i++ //loop array to validate correct address
    ) {
      if (!toArr[i].match(reg)) {
        //if not match, alert and stop loop
        alert("Invalid email address \n" + toArr[i]);
        document.getElementById("speaker_email_1").focus();
        return false;
      }
    }
  }
  if (document.getElementById("speaker_mob_cntry_code").value == "") {
    alert("Please enter mobile Country Code.");
    document.getElementById("speaker_mob_cntry_code").focus();
    return false;
  }
  if (document.getElementById("speaker_mob").value == "") {
    alert("Please enter Mobile number.");
    document.getElementById("speaker_mob").focus();
    return false;
  }
  /*if(document.getElementById("addr1").value == "") {
		alert("Please enter Address1.");
        document.getElementById("addr1").focus();
		return false;
	}
	if(document.getElementById("city").value == "") {
		alert("Please enter City.");
        document.getElementById("city").focus();
		return false;
	}
	
	if(document.getElementById("state").value == "") {
		alert("Please enter State.");
        document.getElementById("state").focus();
		return false;
	}*/
  if (document.getElementById("country").value == "") {
    alert("Please select Country.");
    document.getElementById("country").focus();
    return false;
  }

  if (document.getElementById("linkedin_link").value == "") {
    alert("Please enter LinkedIn Profile link.");
    document.getElementById("linkedin_link").focus();
    return false;
  } else {
    var url = document.getElementById("linkedin_link").value;
    if (
      url == "Not-Applicable" ||
      url == "Not Applicable" ||
      url == "not applicable"
    ) {
    } else {
      //if (/^(https?:\/\/)?((w{3}\.)?)linkedin.com\/.*/i.test(url))
      //{
      //}
      //else
      //{
      //	alert("Invalid LinkedIn Profile link.");
      //	document.getElementById("linkedin_link").value = "";
      //	document.getElementById("linkedin_link").focus();
      //	return false;
      //}
    }
  }
  /*if(document.getElementById("pin").value == "") {
		alert("Please enter Postal Code.");
        document.getElementById("pin").focus();
		return false;
	}*/

  if (document.getElementById("photo").value == "") {
    alert("Please upload photo.");
    document.getElementById("photo").focus();
    return false;
  }
  if (document.getElementById("shrt_bgrphy_fl").value == "") {
    alert("Please enter Profile.");
    document.getElementById("shrt_bgrphy_fl").focus();
    return false;
  }

  if (document.getElementById("vercode").value == "") {
    alert("Please enter text see in the image.");
    document.getElementById("vercode").focus();
    return false;
  } else {
    if (
      document.getElementById("vercode").value !=
      document.getElementById("vercode_sp2").value
    ) {
      alert("Please enter correct text see in the image.");
      document.getElementById("vercode").value = "";
      document.getElementById("vercode").focus();
      return false;
    }
  }

  /*	if(document.getElementById("g-recaptcha-response").value == "") {
		alert("Please re-enter your reCAPTCHA.");
		return false;
	}
	*/
  //document.getElementById("reg_registration_form_1").submit();
  return true;
}

function checkFileType(thisObj) {
  var ext = $("#photo").val().split(".").pop().toLowerCase();
  if ($.inArray(ext, ["gif", "png", "jpg", "jpeg"]) == -1) {
    alert("Invalid file! Please upload only image.");
    $("#photo").val("");
  } else {
    var fileSize = thisObj.files[0];
    var sizeInMb = fileSize.size / 1024;
    var sizeLimit = 1024 * 4;
    if (sizeInMb > sizeLimit) {
      alert("Photo size should be less than 2-MB.");
      $("#photo").val("");
    }

    /*var reader = new FileReader();
        reader.readAsDataURL(thisObj.files[0]);
        reader.onload = function (e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                var height = this.height;
                var width = this.width;
                //console.log(this);
                //if ((height == 400 || height <= 1100) && (width >= 750 || width <= 800)) {
                if (height > 400 && width > 400) {
                    alert("Height and Width must not exceed 400x400.");
	    			$('#photo').val('');
                    return false;
                }
                return true;
            };
        }*/
  }
}
