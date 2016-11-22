(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

	$(document).ready(function(){

		var jtrt_table_data = JSON.parse($('#jtrt_options textarea').html());
		var table = $('table');

		jtrt_table_data[1].forEach(function(element) {
			var tRow = table.find('tr').eq(element['row']);
			var tCell = tRow.find('td').eq(element['col']);
			tCell.addClass(element['className']);

			if(element['borders']){
				var borderInfor = element['borders'];

				for (var key in borderInfor) {
					// skip loop if the property is from prototype
					if (!borderInfor.hasOwnProperty(key)) continue;

					var obj = borderInfor[key];
					for (var prop in obj) {
						// skip loop if the property is from prototype
						if(!obj.hasOwnProperty(prop)) continue;

						// your code
						if(key == "left" || key == "right" || key == "top" || key == "bottom"){
							if(obj['hide'] != true){
								tCell.addClass('border-'+key);
							}
						}
					}
				}

			}

			for (var k in element['jtcellstyle']){
				if (element['jtcellstyle'].hasOwnProperty(k)) {
					tCell.css(k,element['jtcellstyle'][k])
				}
			}

		}, this);

	});

})( jQuery );
