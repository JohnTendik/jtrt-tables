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
	
	var jtrt_table_content = jQuery('.jtrt_table_creator');
	jtrt_table_content.hide();
	jtrt_table_content.find('thead tr:not(.sorted_head)').remove();
	jtrt_table_content.find('tr td.jtrt_custom_td').remove();
	jtrt_table_content.find('tbody tr:last-child').remove();
	var fixJson = function(str) {
		return String(str)
			.replace(/\\/g, "");
	};

	jtrt_table_content.each(function(i,elem){
		var jtrt_table_id = jQuery(jtrt_table_content[i]).attr('data-jtrt-id');
		var tableBPs = JSON.parse(jQuery('input#jtrt_hidden_tableBP'+jtrt_table_id).val());
		jQuery(this).footable({
			"useParentWidth": true,
			"breakpoints": {
				"xs": tableBPs['x-small'],
				"sm": tableBPs['small'],
				"md": tableBPs['medium'],
				"lg": tableBPs['large'],
				"xl": tableBPs['x-large']
			}			
		});
	});
	jtrt_table_content.show();
	
})( jQuery );
