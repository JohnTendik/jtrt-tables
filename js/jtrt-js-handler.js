(function($){

		var custom_uploader,
			jtrt_form = jQuery("form"),
			generate_table_button = jQuery('input#jtrt-generate-table-button'),
			upload_image_link = jQuery('#upload_image').val(),
			jtrt_table_viewer = jQuery('div.insert_jtrt_here'),
			jtrt_table_switch = jQuery('label.switch span.active').attr('data-switch'),
			jtrt_table_column_text = jtrt_form.find('p#jtrt_column_counter'),
			jtrt_filter_enabled = jQuery('input[name="jtrt_filters_check"]'),
			jtrt_sort_enabled = jQuery('input[name="jtrt_sorting_check"]'),
			has_filter_enabled = false;


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

				title: 'Choose CSV File',

				button: {

					text: 'Choose CSV File'

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
			jQuery('a#jtrt-generate-shortcode-button').html('Generate Shortcode');
			if(upload_image_link.indexOf(".csv") != -1){

			jQuery('div.insert_jtrt_here').CSVToTable(upload_image_link,{tableClass:"footable toggle-circle-filled",jtrt_table_sort:"",jtrt_table_filter:""});
	
			jtrt_init_func(jQuery('div.insert_jtrt_here'));

			jQuery('a#jtrt-generate-html-button').attr('disabled', false);
			}else{
				alert("You must first upload a CSV file to convert");
				return false;
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

		function sanitize(input) {
		var output = input.replace(/<script[^>]*?>.*?<\/script>/gi, '').
           replace(/\s+/g, '-').toLowerCase().
					 replace(/<[\/\!]*?[^<>]*?>/gi, '').
					 replace(/<style[^>]*?>.*?<\/style>/gi, '').
					 replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '');
	    return output;
		};

		function jtrt_init_func(jtrt_divi){

			jtrt_divi.find('th').addClass("hide-mobile");

			jtrt_backend_column_selector(jtrt_divi);

			jQuery('a#jtrt-generate-html-button').on('click',function(){

				findHiddenLinks(jtrt_divi);

			});	

			jQuery('a#jtrt-generate-shortcode-button').on('click',function(){
				findHiddenLinks(jtrt_divi);
				var newCustomerForm = jQuery('textarea#jtrt_html_box').html();
				var jtrt_table_id_name = sanitize(jQuery("input[name='jtrt_table_id']").val());
				var jtrt_ajax_data = {
					'action': 'jtrttablesave1',
					'data': newCustomerForm,
					'jttitle': jtrt_table_id_name
				}

				jQuery.ajax({  
					type:"POST",  
					url: jtrt_options_arr.ajax_url,  
					data: jtrt_ajax_data, dataType: 'html', 
					success:function(data) {			       
			            location.reload();
			        },
			        error: function(errorThrown){
			            alert(errorThrown);
			            console.log(errorThrown);
			        }
				});
			});

		}

		function findHiddenLinks(jtrt_divi){



			jtrt_divi.find('.hide').each(function(){

				jQuery(this).addClass('filler');

				jQuery(this).removeClass('hide');

			});
			
			if (jtrt_filter_enabled.is(":checked")) {
				if(has_filter_enabled == false){
				jtrt_divi.prepend('<input id="filter_table_jtrt" type="text" />');
				has_filter_enabled = true;
				}
				jtrt_divi.find('table').attr('data-filter', '#filter_table_jtrt');
			}else{
				jtrt_divi.find('input#filter_table_jtrt').remove();
				has_filter_enabled = false;
				jtrt_divi.find('table').attr('data-filter', 'false');
			};

			if(jtrt_sort_enabled.is(":checked")){
				jtrt_divi.find('table').attr('data-sort', 'true');
				var lala = jtrt_divi.find('th');
				lala.each(function(d,i){

					var varthis = jQuery(this);
					
					var val = jtrt_divi.find('tr td').eq(d).html();
					if($.isNumeric(val)){
						varthis.attr('data-type',"numeric");
					}else{
						varthis.attr('data-type', '');
					}
				});
			}else{
				jtrt_divi.find('table').attr('data-sort', 'false');
			}

			var divHTML = jtrt_divi.html();
			jQuery('table.form-table textarea#jtrt_html_box').html(divHTML).show();

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

				jtrt_column_counter(jtrt_divi);

				ev.preventDefault();

			});
		}

		function jtrt_column_counter(jtrt_divi){
			var jtrt_tablet_column_count = jtrt_divi.find('th.hide-tablet').size(),
				jtrt_mobile_column_count = jtrt_divi.find('th.hide-mobile').size(),
				jtrt_table_header_count = jtrt_divi.find('th').size();

			jtrt_table_column_text.text('You need to hide ' + (jtrt_table_header_count - jtrt_tablet_column_count - 4) + ' columns for the tablet sizes and at least ' + (jtrt_table_header_count - jtrt_mobile_column_count - 2) + ' columns for the mobile sizes.');

		}		

		jQuery("#tabs").tabs({
   			 active: localStorage.getItem("currentTabIndex"),
    			activate: function(event, ui) {
       			 localStorage.setItem("currentTabIndex", ui.newPanel[0].dataset["tabIndex"]);
 			   }
			}); 

		
		jQuery('a#jtrt_delete_table').on('click',function(){
				
				var jtrt_delete_id = jQuery(this).attr('data-jtrt-id-table');

				var jtrt_ajax_data = {
					'action': 'jtrttabledelete1',
					'id': jtrt_delete_id
				}
				if (confirm('Are you sure you want to delete this table from the database?')) {
				   jQuery.ajax({  
						type:"POST",  
						url: jtrt_options_arr.ajax_url,  
						data: jtrt_ajax_data, dataType: 'html', 
						success:function(data) {			          
				            location.reload();
				        },
				        error: function(errorThrown){
				            alert(errorThrown);
				            console.log(errorThrown);
				        }
					});
				} else {
				    return;
				}
				
		});

		var loaded = false;
		editRequest = null;

		jQuery('a#jtrt_edit_table').on('click', function(){
			if(loaded){
				location.reload();
			}

			var selfThis = jQuery(this);
			var jtrt_delete_id = selfThis.attr('data-jtrt-id-table');

			var jtrt_ajax_data = {
				'action': 'jtrttableedit1',
				'id': jtrt_delete_id
			};

			ajaxCallForEdit(jtrt_ajax_data);
		
		});

		function ajaxCallForEdit(jtrt_ajax_data){

				var editRequest = jQuery.ajax({  
					type:"POST",  
					url: jtrt_options_arr.ajax_url,  
					data: jtrt_ajax_data,
					cache: false,

					beforeSend : function(){           
					        if(editRequest != null) {
					            editRequest.abort();
					        }
					    },
					success:function(data) {
						loaded = true;
						if(loaded){
							editRequest.abort();
							jtrt_delete_id = "";
							loaded = false;
						}
			            // This outputs the result of the ajax request
			            htmlBlockjtrt1 = JSON.parse(data);
			            htmlBlockjtrt = jQuery('div.insert_jtrt_here').html(htmlBlockjtrt1['content']);
			 			htmlBlockjtrt.show();
			 			jQuery("input[name='jtrt_table_id']").attr('value', htmlBlockjtrt1['name']);
			 			if(htmlBlockjtrt.html().indexOf("input") >= 0){
			 				jQuery('input[name="jtrt_filters_check"]').prop('checked', true);
			 			}else{
			 				jQuery('input[name="jtrt_filters_check"]').prop('checked', false);
			 			}
			 			if(htmlBlockjtrt.html().indexOf('data-sort="true"') >= 0){
			 				jQuery('input[name="jtrt_sorting_check"]').prop('checked', true);
			 			}else{
			 				jQuery('input[name="jtrt_sorting_check"]').prop('checked', false);
			 			}
			 			jtrt_backend_column_selector(htmlBlockjtrt);
			 			jQuery('a#jtrt-generate-html-button').attr('disabled', false);
			 			jQuery('a#jtrt-generate-html-button').on('click', function(){
			 				findHiddenLinks(htmlBlockjtrt);
			 			});
			 			
			 			jtrt_delete_id = htmlBlockjtrt1['id'];

			 			jQuery('a#jtrt-generate-shortcode-button').html('Update Table').on('click', function(){
			 				console.log(jtrt_delete_id);
			 				findHiddenLinks(htmlBlockjtrt);
							var newCustomerForm = jQuery('textarea#jtrt_html_box').html();
							var newtabletitle = sanitize(jQuery("input[name='jtrt_table_id']").val());
			 				jQuery.ajax({  
								type:"POST",  
								url: jtrt_options_arr.ajax_url,  
								data: {
									'action': 'jtrttableedit2',
									'id': jtrt_delete_id,
									'html': newCustomerForm,
									'title': newtabletitle
								}, 
								success:function(data) {
									location.reload();
									console.log(data);
								},
								error: function(error){
									alert(error);
								}
							});
			 			});

			           			          
			        },
			        error: function(errorThrown){
			            alert(errorThrown);
			            console.log(errorThrown);
			        }
				});
			
			
		}

	})(jQuery);