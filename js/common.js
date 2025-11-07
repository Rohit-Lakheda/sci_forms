jQuery(document).ready(function() {  
	$('.dips-mdl-select-input').change(function() {
		var dipsSelectedValue = $(this).val();
		
		if(dipsSelectedValue != '' && dipsSelectedValue != '-1') {
			$(this).parents('.mdl-select').addClass('dips-mdl-select');
		} else {
			$(this).parents('.mdl-select').removeClass('dips-mdl-select');
		}
	});

	$.fn.inputFilter = function(inputFilter) {
		return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
		  if (inputFilter(this.value)) {
			this.oldValue = this.value;
			this.oldSelectionStart = this.selectionStart;
			this.oldSelectionEnd = this.selectionEnd;
		  } else if (this.hasOwnProperty("oldValue")) {
			this.value = this.oldValue;
			this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
		  }
		});
	 };

});
var Registration = function() {
    return {
        //main function to initiate the module
        init: function(formId, step) {
            if (jQuery().bootstrapWizard) {
                var r = $("#submit_form"),
                    t = $(".alert-danger", r),
                    i = $(".alert-success", r);
                $("#" + formId).bootstrapWizard({
                    nextSelector: ".button-next",
                    previousSelector: ".button-previous",
                    onTabClick: function(e, r, t, i) {
                        return !1
                    },
                    onNext: function(e, a, n) {
                        return i.hide(), t.hide(), 0 == r.valid() ? !1 : void o(e, a, n)
                    },
                    onPrevious: function(e, r, a) {
                        i.hide(), t.hide(), o(e, r, a)
                    },
                    onTabShow: function(e, r, t) {
                        var i = r.find("li").length,
                            a = step + 1,
                            o = a / i * 100;
                        $("#" + formId).find(".progress-bar").css({
                            width: o + "%"
                        })
                    }
                }), $("#" + formId).find(".button-previous").hide(), $("#" + formId + " .button-submit").click(function() {
                    //alert("Finished! Hope you like it :)")
                }).hide()/*, $("#country_list", r).change(function() {
                    r.validate().element($(this))
                })*/
            }
        }
    };
}();

function check_num(e, txt) {
    var val = document.getElementById(txt).value;

    // If val is Not a Number
    if (isNaN(val)) {
        //alert('Please enter only numbers!');
        document.getElementById(txt).value = '';
    }
}

function check_char(ev,txt2) {
	/*var unicode2=ev.keyCode? ev.keyCode : ev.charCode;
	var text2 = txt2;
	if((unicode2=="48") || (unicode2=="49") || (unicode2=="50") || (unicode2=="51") || (unicode2=="52") || (unicode2=="53") || (unicode2=="54") || (unicode2=="55") || (unicode2=="56") || (unicode2=="57") || (unicode2=="96") || (unicode2=="97") || (unicode2=="98") || (unicode2=="99") || (unicode2=="100") || (unicode2=="101") || (unicode2=="102") || (unicode2=="103") || (unicode2=="104") || (unicode2=="105"))
	{
		//alert("Please enter character");
		document.getElementById(txt2).value="";
	}*/
	/*var inputtxt = document.getElementById(txt2).value;
	var letters = /^[a-zA-Z\s]+$/;  
	if(!inputtxt.match(letters))  
     {  
      document.getElementById(txt2).value="";
     }  */
}

var ComponentsPickers = function () {

    var handleDatePickers = function () {
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
                format: 'dd-mm-yyyy',
                endDate: new Date()
            });
        }
    }

    return {
        //main function to initiate the module
        init: function () {
            handleDatePickers();
        }
    };
}();

var RegistrationNew = function () {
    return {
        //main function to initiate the module
        init: function (formId, step) {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            var form = $('#' + formId);
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            // default form wizard
            $('#' + formId).bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    /*
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                    */
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    /*if (form.valid() == false) {
                        return false;
                    }*/

                    //handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    //handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = step + 1;
                    var $percent = (current / total) * 100;
                    $('#reg_registration_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            /*$('#reg_registration_1').find('.button-previous').hide();
            $('#reg_registration_1 .button-submit').click(function () {
                alert('Finished! Hope you like it :)');
            }).hide();*/
        }
    };
}();

function countChar(val) {
	var len = val.value.length;
	if (len > 100) {
		val.value = val.value.substring(0, 100);
	} else {
		$('#word_left3').text(100 - len);
		$('#display_count3').text(len);
	}
}