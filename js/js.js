$(document).ready(function(){
	$('.parallax').parallax();
	$('select').material_select();
	$('.modal-trigger').leanModal();

	var options = [
    	{selector: '#steps', offset: 300, callback: 'Materialize.showStaggeredList("#steps")' },
  	];
  	Materialize.scrollFire(options);

  	$("#available_times_table input").each(function() {
  		var time_value = $(this).val();
		switch (time_value) {
			case '0':
				$(this).css({'border-bottom':'#bf360c 1px solid', 'color':'#bf360c'});
				break;
			case '1':
				$(this).css({'border-bottom':'#4caf50 1px solid', 'color':'#4caf50'});
				break;
			default:
				$(this).css({'border-bottom':'', 'color':''});
				break;
		};
  	});

	$("#student_or_family").click(function() {
		var student_or_family_choice = $("#student_or_family").val();

		switch(student_or_family_choice) {
			case 1:

				break;
			case 2:

				break;
			default:

		}
	});

	var $form = $('form'),
    	origForm = $form.serialize();
    	console.log(origForm);

	$('form :input').on('change input', function() {
		if (($form.serialize() !== origForm)) {
			$('#show_information,#show_preferences,#show_matches').prop('disabled',true);
			$('#submit_buttons_div #reset_info').removeClass('hide');
		} else {
			$('#show_information,#show_preferences,#show_matches').prop('disabled',false);
			$('#submit_buttons_div #reset_info').addClass('hide');
		}
	});

	$('#reset_info').click(function() {
		var original_form_values = {};
		$.each(origForm.split('&'), function (index, elem) {
   			var vals = elem.split('=');
   			vals[1] = vals[1].replace(/\+/g," ");
   			original_form_values[vals[0]] = vals[1];	
		});
		console.log(original_form_values);
		console.log(pre_file_name_src);
		if (pre_file_name_src == "img/users_imgs/") {
			$('#img_preview').attr('hidden',true);
		} else {
			$('#img_preview').attr('src',pre_file_name_src);
		}
		$('form :input').each(function() {
			if ($(this).prop('name') in original_form_values) {
				if ($(this).prop('type') != 'checkbox') {
   					$(this).val(original_form_values[$(this).prop('name')]);
   				} else {
   					switch (original_form_values[$(this).prop('name')]) {
	   					case 'on':
	   						$(this).prop('checked', true);
	   						break;
	   					default:
	   					 	$(this).prop('checked', false);
	   					 	break;
   					}
   				}  
			} else {
				$(this).prop('checked', false);
			};
			if ($(this).prop('type') == 'text') {
				changeTimeAvailbalecolors($(this),$(this).val());
			};		 	
		})
		$('#show_information,#show_preferences,#show_matches').prop('disabled',false);
		$('#submit_buttons_div #reset_info').addClass('hide');
		$('select').material_select();
	});

	var current_tab = '';

	$('#show_information').click(function() {
		var type = $(this).attr('type');
		$('#adjustable_container').hide().load(type + "/information_" + type +".php", function() {
			$(this).fadeIn(1000);
			$('#show_information,#show_preferences,#show_matches').prop('disabled',false);
			current_tab = 'information';
		});
	});

	$('#show_preferences').click(function() {
		var type = $(this).attr('type');
		$('#adjustable_container').hide().load(type + "/preferences_" + type +".php", function() {
			$(this).fadeIn(1000);
			$('#show_information,#show_preferences,#show_matches').prop('disabled',false);
			current_tab = 'preferences';
		});
	});

	$('#show_matches').click(function() {
		var type = $(this).attr('type');
		$('#adjustable_container').hide().load("matches.php", function() {
			$(this).fadeIn(1000);
			$('#show_information,#show_preferences,#show_matches').prop('disabled',false);
			current_tab = 'matches';
		});
	});

	$(".times").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if (e.shiftKey || !(e.keyCode == 48 || e.keyCode == 49 || e.keyCode == 96 || e.keyCode == 97)) {
            e.preventDefault();
        }
        if ($(this).val() != 0) {
        	e.preventDefault();
        };
    });

	$(".times").focusout(function() {
		changeTimeAvailbalecolors($(this),$(this).val());
	});

	function changeTimeAvailbalecolors($this,time_value) {
		switch (time_value) {
			case '0':
				$this.css({'border-bottom':'#bf360c 1px solid', 'color':'#bf360c'});
				break;
			case '1':
				$this.css({'border-bottom':'#4caf50 1px solid', 'color':'#4caf50'});
				break;
			default:
				$this.css({'border-bottom':'', 'color':''});
				break;
		};
	}

	$("#myForm input").each(function() {
		if ($(this).value != " ") {
			$('label[for="'+$(this).attr('name')+'"]').addClass("active");
		};
	});

	// $('#close_contact_modal').click(function() {
	// 	$(this).parent().parent().closeModal();
	// });

 	function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {	
            	$('#img_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    var visit = 0;
    var pre_file_name = "";
    var pre_file_name_src = "";
    $("#img_preview_input").change(function(){
    	if (visit == 0) {
    		pre_file_name = $('#img_preview').attr('src').split('_').pop();
    		pre_file_name_src = $('#img_preview').attr('src');
    		visit = 1;
    	};
    	var new_file_name = $(this).val().replace(/C:\\fakepath\\/i,'');
    	readURL(this);
        if (pre_file_name != new_file_name) {
        	$('#img_preview').prop('hidden',false);
        	$('#show_information,#show_preferences,#show_matches').prop('disabled',true);
			$('#submit_buttons_div #reset_info').removeClass('hide');
    	} else if ($form.serialize() == origForm) {
			$('#show_information,#show_preferences,#show_matches').prop('disabled',false);
			$('#submit_buttons_div #reset_info').addClass('hide');
		}
    });

    $('#img_preview_input').css("display",'none');

    $('#img_preview_button').bind( 'click', function (e) {
    	e.preventDefault();

    	$('#img_preview_input').click();
    });


    if (!$('#img_preview').prop('src')) {
    	$('#img_preview').prop('hidden',true);
    };

    google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Studied Abroad',     14],
          ['Haven\'t Studied Abroad',      86],
        ]);

        var options = {
          legend: 'none',
          slices: {
            0: { color: '#2e7d32' },
            1: { color: '#c62828' }
          },
          'width':500,
          'height':500
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }


});