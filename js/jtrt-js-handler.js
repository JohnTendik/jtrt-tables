(function($){

		var custom_uploader,
			form = $("form"),
			generate_table_button = $('a#jtrt-generate-table-button'),
			upload_image_link = $('#upload_image').val(),
			jtrt_table_viewer = $('div.insert_jtrt_here');

		jQuery('a#jtrt-generate-html-button').attr('disabled', true);

		$('#upload_image_button').on('click', function(e){
			
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

				$('#upload_image').val(attachment.url);

			});

			//Open the uploader dialog

			custom_uploader.open();

		});

		if(upload_image_link.indexOf(".csv") != -1){
			
		}

		generate_table_button.on("click", function(){
			
			$('div.insert_jtrt_here').CSVToTable(upload_image_link,{tableClass:"kwrc-table footable toggle-circle-filled"});
			
			jtrt_init_func($('div.insert_jtrt_here'));

			jQuery('a#jtrt-generate-html-button').attr('disabled', false);

		});
		


		function toggleAttr(el, attribute, vals){

			if (jQuery(el).attr(attribute) ==  vals[0]){

				jQuery(el).attr(attribute, vals[1]);

			}else if (jQuery(el).attr(attribute) == vals[1]){

				jQuery(el).attr(attribute, vals[0]);

			}

		}

		function jtrt_init_func(divi){

			divi.on('mousedown', "th", function(ev){

				isMouseDown = true;

				var cellindex = jQuery(this).index();

				jQuery(this).toggleClass('hide');

				var lala = divi.find('tr');

				lala.each(function(){

					jQuery(this).find('td').eq(cellindex).toggleClass('hide');

				});

				if (jQuery(this).attr('data-hide')) {

					jQuery(this).attr('data-hide', "");

				}else{

					jQuery(this).attr('data-hide', "phone, tablet");

				}

				ev.preventDefault();

			});

			jQuery('a#jtrt-generate-html-button').on('click',function(){

				findHiddenLinks(divi);

			});	

		}

		function findHiddenLinks(divi){

			divi.find('.hide').each(function(){

				jQuery(this).addClass('filler');

				jQuery(this).removeClass('hide');

			});

			var divHTML = divi.html();

			divi.siblings('textarea#jtrt_html_box').html(divHTML).show();

		}

	})(jQuery);