(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	


	// Global table obj
	var JTrtTableEditor = {};

	$(document).ready(function(){

		jQuery('ul#jt-steps li').on('click',function(){
			var thisid = jQuery(this).attr('data-jtrt-editor-section-id');

			if(jQuery('.jtrteditorsection#step'+thisid).hasClass('jtrteditorshow')){
				return false;
			}
				
			var activeLi = $(this).siblings('.active').removeClass('active');
			$(this).addClass('active');
			
			var currentShownSection = jQuery('.jtrteditorsection.jtrteditorshow').fadeOut();
			window.setTimeout(function(){
				currentShownSection.removeClass('jtrteditorshow');
				jQuery('.jtrteditorsection#step'+thisid).fadeIn().addClass('jtrteditorshow');
			},400);

		});

		jQuery('.leftSidejt ul li').on('click',function(){
			var thisid = jQuery(this).attr('data-jtrt-editor-section-id');
			
			if(jQuery('.rightSidejt #optionsSection'+thisid).hasClass('jtoptionsshow')){
				return false;
			}

			var activeLi = $(this).siblings('.active').removeClass('active');
			$(this).addClass('active');
			var currentShownSection = jQuery('.rightSidejt .optionsPagejt.jtoptionsshow').fadeOut();
			window.setTimeout(function(){
				currentShownSection.removeClass('jtoptionsshow');
				jQuery('.rightSidejt #optionsSection'+thisid).fadeIn().addClass('jtoptionsshow');
			},400);

		});

		JTrtTableEditor = new JTrtEditor(document.getElementById('jtrt-table-handson'));

		//Setup the click event for the publish/update button
		jQuery('#publish').on('click',JTrtTableEditor.handleOnSave);

		//click event for the undo/redo button
		jQuery('#jtundo,#jtredo').on('click',function(){
			JTrtTableEditor.rudo($(this).attr('data-jtrt-btnType'));
		});

		var modal = document.getElementById('jtFindAndReplaceModal');
		var linkModal = document.getElementById('jtlinkModal');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
			if (event.target == linkModal) {
				linkModal.style.display = "none";
			}
		}
		

		$('#jtrt_tables_post').removeClass("postbox");
		$('#normal-sortables, #jtrt_tables_post .hndle, #jtrt_tables_post .handlediv').remove();
		$('#jtrt_tables_post').prepend("<h1>JT Responsive Tables</h1>");


		$('#jtresponsiveoptionscontainer div[data-jtresponsive-select="'+$('#jtresponsiveoptionscontainerselect').val()+'"]').fadeIn();		

		$('#jtresponsiveoptionscontainerselect').on('change',function(){
			$('#jtresponsiveoptionscontainer div').hide();
			$('#jtresponsiveoptionscontainer div[data-jtresponsive-select="'+$(this).val()+'"]').show();
		});



		$('#jtrt-trytoconvertolddata').on('click',function(){

			var data = {
				'action': 'get_old_table',
				'tableId': $('#post_ID').val(),
				'tableOpt': 'convert'
			};

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			makeDBcall(data);

		});
		

		$('#jtrt-dontshowconvert').on('click',function(){

			var data = {
				'action': 'get_old_table',
				'tableId': $('#post_ID').val(),
				'tableOpt': 'delete'
			};

			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			makeDBcall(data);

		});

		function makeDBcall(data){
			jQuery.post(ajaxurl, data, function(response) {
				if(response == false){
					alert('This message will no longer appear. Thank you for using JTRT plugin!');
					$('#jtConverAvailMessage').fadeOut();
				}else{
					var tableHolder = $("<div></div>").html(response.substring(0, response.length - 1));
					var newData = [];
					tableHolder.find('table tr:not(.jtrt_custom_header)').each(function(indx,val){
						var thisRow = [];
						$(val).find('td:not(.jtrt_custom_td)').each(function(colind,colval){
							thisRow.push($(colval).html());
						});
						newData.push(thisRow);
					});
					JTrtTableEditor.handsOnTab.populateFromArray(0,0,newData);
				}
			});
		}

		$('input.jtcoloreditpicker').wpColorPicker();

		$('input.jtcoloreditpickerOpts').wpColorPicker();
	

		jQuery('.submitbox').append('<div style="text-align:center;padding:14px;"><strong>Shortcode</strong><br/><span style="padding:8px">[jtrt_tables id="'+jQuery('#post_ID').val()+'"]</span></div>')

	}); // .ready

})( jQuery );
