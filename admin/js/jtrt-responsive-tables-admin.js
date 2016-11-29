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

		window.myColorPicker = $('input.jtcoloreditpicker').colorPicker({
			customBG: '#222',
			margin: '4px -2px 0',
			doRender: 'div div',
			
			buildCallback: function($elm) {
				var colorInstance = this.color,
					colorPicker = this;

				$elm.prepend('<div class="cp-panel">' +
					'R <input type="text" class="cp-r" /><br>' +
					'G <input type="text" class="cp-g" /><br>' +
					'B <input type="text" class="cp-b" /><hr>' +
					'H <input type="text" class="cp-h" /><br>' +
					'S <input type="text" class="cp-s" /><br>' +
					'B <input type="text" class="cp-v" /><hr>' +
					'<input type="text" class="cp-HEX" />' +
				'</div>').on('change', 'input', function(e) {
					var value = this.value,
						className = this.className,
						type = className.split('-')[1],
						color = {};

					color[type] = value;
					colorInstance.setColor(type === 'HEX' ? value : color,
						type === 'HEX' ? 'HEX' : /(?:r|g|b)/.test(type) ? 'rgb' : 'hsv');
					colorPicker.render();
					this.blur();
				}).on('click',function(e){
					e.stopPropagation();
				});
			},

			cssAddon: // could also be in a css file instead
				'.cp-color-picker{box-sizing:border-box; width:226px;z-index:99999;}' +
				'.cp-color-picker .cp-panel {line-height: 21px; float:right;' +
					'padding:0 1px 0 8px; margin-top:-1px; overflow:visible}' +
				'.cp-xy-slider:active {cursor:none;}' +
				'.cp-panel, .cp-panel input {color:#bbb; font-family:monospace,' +
					'"Courier New",Courier,mono; font-size:12px; font-weight:bold;}' +
				'.cp-panel input {width:28px; height:12px; padding:2px 3px 1px;' +
					'text-align:right; line-height:12px; background:transparent;' +
					'border:1px solid; border-color:#222 #666 #666 #222;}' +
				'.cp-panel hr {margin:0 -2px 2px; height:1px; border:0;' +
					'background:#666; border-top:1px solid #222;}' +
				'.cp-panel .cp-HEX {width:44px; position:absolute; margin:1px -3px 0 -2px;}' +
				'.cp-alpha {width:155px;}',

			renderCallback: function($elm, toggled) {
				var colors = this.color.colors.RND,
					modes = {
						r: colors.rgb.r, g: colors.rgb.g, b: colors.rgb.b,
						h: colors.hsv.h, s: colors.hsv.s, v: colors.hsv.v,
						HEX: this.color.colors.HEX
					};

				$('input', '.cp-panel').each(function() {
					this.value = modes[this.className.substr(3)];
				});

				
			}

		});

		window.myColorPicker = $('input.jtcoloreditpickerOpts').colorPicker({
			customBG: '#222',
			margin: '4px -2px 0',
			doRender: 'div div',
			
			buildCallback: function($elm) {
				var colorInstance = this.color,
					colorPicker = this;

				$elm.prepend('<div class="cp-panel">' +
					'R <input type="text" class="cp-r" /><br>' +
					'G <input type="text" class="cp-g" /><br>' +
					'B <input type="text" class="cp-b" /><hr>' +
					'H <input type="text" class="cp-h" /><br>' +
					'S <input type="text" class="cp-s" /><br>' +
					'B <input type="text" class="cp-v" /><hr>' +
					'<input type="text" class="cp-HEX" />' +
				'</div>').on('change', 'input', function(e) {
					var value = this.value,
						className = this.className,
						type = className.split('-')[1],
						color = {};

					color[type] = value;
					colorInstance.setColor(type === 'HEX' ? value : color,
						type === 'HEX' ? 'HEX' : /(?:r|g|b)/.test(type) ? 'rgb' : 'hsv');
					colorPicker.render();
					this.blur();
				}).on('click',function(e){
					e.stopPropagation();
				});
			},

			cssAddon: // could also be in a css file instead
				'.cp-color-picker{box-sizing:border-box; width:226px;z-index:99999;}' +
				'.cp-color-picker .cp-panel {line-height: 21px; float:right;' +
					'padding:0 1px 0 8px; margin-top:-1px; overflow:visible}' +
				'.cp-xy-slider:active {cursor:none;}' +
				'.cp-panel, .cp-panel input {color:#bbb; font-family:monospace,' +
					'"Courier New",Courier,mono; font-size:12px; font-weight:bold;}' +
				'.cp-panel input {width:28px; height:12px; padding:2px 3px 1px;' +
					'text-align:right; line-height:12px; background:transparent;' +
					'border:1px solid; border-color:#222 #666 #666 #222;}' +
				'.cp-panel hr {margin:0 -2px 2px; height:1px; border:0;' +
					'background:#666; border-top:1px solid #222;}' +
				'.cp-panel .cp-HEX {width:44px; position:absolute; margin:1px -3px 0 -2px;}' +
				'.cp-alpha {width:155px;}',

			renderCallback: function($elm, toggled) {
				var colors = this.color.colors.RND,
					modes = {
						r: colors.rgb.r, g: colors.rgb.g, b: colors.rgb.b,
						h: colors.hsv.h, s: colors.hsv.s, v: colors.hsv.v,
						HEX: this.color.colors.HEX
					};

				$('input', '.cp-panel').each(function() {
					this.value = modes[this.className.substr(3)];
				});

			}

		});


		jQuery('.submitbox').append('<div style="text-align:center;padding:14px;"><strong>Shortcode</strong><br/><span style="padding:8px">[jtrt_tables id="'+jQuery('#post_ID').val()+'"]</span></div>')

	}); // .ready

})( jQuery );
