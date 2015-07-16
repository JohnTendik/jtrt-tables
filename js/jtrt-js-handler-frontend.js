(function($){

	var jtrt_mobile_breakpoint = parseInt( jtrt_options_arr.jtrt_mobile_bp );
	var	jtrt_tablet_breakpoint = parseInt( jtrt_options_arr.jtrt_tablet_bp );

	if (isNaN(jtrt_tablet_breakpoint)) {
		jtrt_tablet_breakpoint = 920;
	};
	if (isNaN(jtrt_mobile_breakpoint)) {
		jtrt_mobile_breakpoint = 480;
	};

	$('.footable').footable({
		breakpoints: {
			phone: jtrt_mobile_breakpoint,
		  	tablet: jtrt_tablet_breakpoint
		}
	});


})(jQuery);