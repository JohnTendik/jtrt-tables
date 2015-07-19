(function($){

		var custom_uploader,
			form = jQuery("form"),
			generate_table_button = jQuery('a#jtrt-generate-table-button'),
			upload_image_link = jQuery('#upload_image').val(),
			jtrt_table_viewer = jQuery('div.insert_jtrt_here'),
			jtrt_table_switch = jQuery('label.switch span.active').attr('data-switch');


		jQuery('a#jtrt-generate-html-button').attr('disabled', true);

		jQuery('#upload_image_button').on('click', function(e){
			
			e.preventDefault();

			//If the uploader object has already been created, reopen the dialog

			if (custom_uploader) {

				custom_uploader.open();

				return;

			}

			//Extend the wp.media object

			custom_uploader = wp.media.frames.file_frame = wp.media({

				title: 'Choose Image',

				button: {

					text: 'Choose Image'

				},

				multiple: false

			});


			//When a file is selected, grab the URL and set it as the text field's value

			custom_uploader.on('select', function() {

				attachment = custom_uploader.state().get('selection').first().toJSON();

				jQuery('#upload_image').val(attachment.url);

			});

			//Open the uploader dialog

			custom_uploader.open();

		});

		
		generate_table_button.on("click", function(){
		
			if(upload_image_link.indexOf(".csv") != -1){

			jQuery('div.insert_jtrt_here').CSVToTable(upload_image_link,{tableClass:"footable toggle-circle-filled"});
	
			jtrt_init_func(jQuery('div.insert_jtrt_here'));

			jQuery('a#jtrt-generate-html-button').attr('disabled', false);
			}else{

				alert("You must first upload a CSV file to convert");

			}
			
		});



		jQuery('label.switch span').on('click', function(e){
			var current_switch = jQuery('label.switch span.active');
			jtrt_table_switch = current_switch.attr('data-switch');
			if(jQuery(this).hasClass("active")){
				return
			}else{
				jQuery(this).addClass("active");
				current_switch.removeClass("active");
				current_switch = jQuery('label.switch span.active');
				jtrt_table_switch = current_switch.attr('data-switch');
			}	
		});
		


		function toggleAttr(el, attribute, vals){

			if (jQuery(el).attr(attribute) ==  vals[0]){

				jQuery(el).attr(attribute, vals[1]);

			}else if (jQuery(el).attr(attribute) == vals[1]){

				jQuery(el).attr(attribute, vals[0]);

			}

		}

		function jtrt_init_func(jtrt_divi){

			jtrt_divi.find('th').addClass("hide-mobile");

			jtrt_backend_column_selector(jtrt_divi);

			jQuery('a#jtrt-generate-html-button').on('click',function(){

				findHiddenLinks(jtrt_divi);

			});	

		}

		function findHiddenLinks(jtrt_divi){

			jtrt_divi.find('.hide').each(function(){

				jQuery(this).addClass('filler');

				jQuery(this).removeClass('hide');

			});

			var divHTML = jtrt_divi.html();

			jtrt_divi.siblings('textarea#jtrt_html_box').html(divHTML).show();

		}

		function jtrt_backend_column_selector(jtrt_divi){
			jtrt_divi.on('mousedown', "th", function(ev){

				var jThis = jQuery(this);
				var isMouseDown = true;
				var cellindex = jQuery(this).index(),
				new_jtrt_attr_array = [];

				if(jThis.hasClass('hide-mobile')){
					new_jtrt_attr_array.push("phone");
				}
				if(jThis.hasClass('hide-tablet')){
					new_jtrt_attr_array.push("tablet");
				}
				
				if(jtrt_table_switch == "mobile"){
					jQuery(this).toggleClass('hide-mobile');

					if(jThis.hasClass('hide-mobile') && jThis.hasClass('hide-tablet')){
						
					}else{
						
					}

					var lala = jtrt_divi.find('tr');

					lala.each(function(){

						jQuery(this).find('td').eq(cellindex).toggleClass('hide-mobile');

					});

					if(jThis.hasClass('hide-mobile')){
						new_jtrt_attr_array.push("phone");
						jtrt_attr_array = jThis.attr('data-hide', new_jtrt_attr_array);
					}else{
						new_jtrt_attr_array.splice(new_jtrt_attr_array.indexOf('phone'),1);
						jtrt_attr_array = jThis.attr('data-hide', new_jtrt_attr_array);	
					}
				}

				if(jtrt_table_switch == "tablet"){
					jQuery(this).toggleClass('hide-tablet');

					if(jThis.hasClass('hide-mobile') && jThis.hasClass('hide-tablet')){
						
					}else{
						
					}

					var lala = jtrt_divi.find('tr');

					lala.each(function(){

						jQuery(this).find('td').eq(cellindex).toggleClass('hide-tablet');

					});

					if(jThis.hasClass('hide-tablet')){
						new_jtrt_attr_array.push("tablet");
						jtrt_attr_array = jThis.attr('data-hide', new_jtrt_attr_array);
					}else{
						new_jtrt_attr_array.splice(new_jtrt_attr_array.indexOf('tablet'),1);
						jtrt_attr_array = jThis.attr('data-hide', new_jtrt_attr_array);	
					}
				}

				

				ev.preventDefault();

			});
		}

		jQuery('#tabs').tabs();

	})(jQuery);