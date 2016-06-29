(function( $ ) {


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
	function Jtrt_Steps_Handler(container) {
		
		this.container = container;
		this.children = this.container.children();
		this.activePage = this.container.children('.active');
		this.activePageNum = this.activePage.attr('id')[8];
		
		var _this = this;
		var jt_steps_ui = jQuery('.jt_table_steps ul');
		
		
		this.nextStep = function(dir){
			if(dir === "prev"){
				this.updatePageNum("down");
			}else{
				this.updatePageNum("up");
			}
			
			this.activePage.fadeOut(300,function(){
				jQuery(this).removeClass('active');
				_this.activePage = _this.container.children('#jt_step_' + _this.activePageNum).fadeIn(300).addClass('active');
			});

			jt_steps_ui.find('.jt_step_active').removeClass('jt_step_active');
			jt_steps_ui.find('li').eq(this.activePageNum - 1).addClass('jt_step_active');										
		}

		
		this.updatePageNum = function(dir){
			if(dir == "up"){
				this.activePageNum++;
				if(this.activePageNum > 4){
					this.activePageNum = 4;
				}
			}else{
				this.activePageNum--;
				if(this.activePageNum < 1){
					this.activePageNum = 1;
				}
			}
		}
	}
	
	var jtrt_Steps = new Jtrt_Steps_Handler(jQuery('.jtrt_editor_container'));
	var jtTables = new JtrtTables(jQuery('table.jtrt_table_creator'));
	var jtTablesStyles = "";
	var tablePig = jQuery('.jtrt_style_pig_bt');
	var jtrtStyles = new Jtrt_styles_editor(jQuery('#jt_step_3 .jtrt_options_styles'));
	var jtrt_table_style_type = "inherit";

	jtrtStyles.handleOnLoad();
	jtrtStyles.handleOnChange();

	function getParameterByName(name, url) {
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
	
	if(getParameterByName('post') != null){
		jtrt_Steps.nextStep();
	}
	
	jQuery('.jt_step_1_btn').on('click',function(){
		if(!jQuery(this).hasClass('scratch')){
			return;
		}
		
		jtrt_Steps.nextStep();
	});
	
	jQuery('#jt_upload_Csv').on('change',function(elem){
		jtTables.handleCSVImport(jQuery(this));
		jtrt_Steps.nextStep();
	});
	
	jQuery('div.jt_nav_container a').on('click',function(){
		jtrt_Steps.nextStep(jQuery(this).attr('data-jt-steps-dir'));
	});

	function updateTableStyles(){
		if(jQuery('#jtrt_table_styles_type select').attr('data-table-style-type') === "bootstrap"){
			jQuery('#bootstrap_opts_jtrt fieldset ul li input').each(function(){
				
				if(jQuery(this).val() === "true"){
					jtTables.container.addClass(jQuery(this).attr('data-bt-classes-jt'));
				}else{
					jtTables.container.removeClass(jQuery(this).attr('data-bt-classes-jt'));
				}
				
			});
			jtrt_table_style_type = "bootstrap";
		}
		else if(jQuery('#jtrt_table_styles_type select').attr('data-table-style-type') === "example1"){
			var classList = $('.jtrt_example_pig').attr('class').split(" ");
			var exampleStyle = classList[1];
			jtrt_table_style_type = "example,"+ exampleStyle;
		}
	}
	
	jQuery('#publish').on("click",function(e){
		
		jQuery('div#jtrt_table_container .jtrt_error_message').remove();
		updateTableOptions();
		updateTableStyles();

		var data = {
		'action': 'gen_table_1',
		'idd': jQuery('input#post_ID').val(),
		'data': jQuery('div#jtrt_table_container').html(),
		'table_name': jQuery('input#title').val(),
		'table_styles': jtrt_table_style_type			
		};
		
		jQuery.post(ajaxurl, data, function(response) {
			jQuery('#publish').click();
		});
			
	});
	
	
	function updateTableOptions(){
		
		var table = jQuery('table.jtrt_table_creator');
		var optsContainer = jQuery('#jtrt_table_creator_options_container');
		
		var opts = ['data-breakpoints', 'data-filtering', 'data-paging', 'data-sorting'];
		
		for(var i = 0; i < opts.length; i++){
			if(opts[i] == "data-breakpoints"){
				var jttable_breakpoints = {
					"x-small": 480,
					"small": 768,
					"medium": 992,
					"large": 1200,
					"x-large": 1400
				};
				optsContainer.find('fieldset#data-breakpoints input').each(function(i,elem){
					if(jQuery(this).attr('type') === "hidden"){
						return;
					}
					jttable_breakpoints[jQuery(this).attr('data-jtbp')] = parseInt(jQuery(this).val());
				});
				jQuery('#jtrt_hidden_tableBP').val(fixJson(JSON.stringify(jttable_breakpoints)));
			}else if(opts[i] == "data-paging"){
				var optValue = optsContainer.find('fieldset#'+opts[i]+' input#jtrt_table_allow_paging').val();
				var optValue2 = optsContainer.find('fieldset#'+opts[i]+' input#jtrt_table_allow_paging_rowCount').val();
				table.attr(opts[i], optValue);
				table.attr('data-paging-size',optValue2);
			}else{
				var optValue = optsContainer.find('fieldset#'+opts[i]+' input').val();
				table.attr(opts[i], optValue);
			}
		}
		
		optsContainer.find('');
		
	}
	

	var fixJson = function(str) {
		return String(str)
			.replace(/"/g, "&quot;");
	};
	
	jQuery('#jtrt_table_creator_options_container fieldset:not(#data-breakpoints) ul li input').each(function(i,elem){
		if(jQuery(this).val() == "true"){
			jQuery(this).prop('checked', true);
		}	
	});
	
	
	// Change the title position options to reflect the saved values. 
	var showTitleOpt = jQuery('#jtrt_showTitle_pos').attr('data-jt-titlepos');
	jQuery('#jtrt_showTitle_pos').find('option[value="'+showTitleOpt+'"]').prop('selected', true);
	
	// Change the enabled options to reflect the saved values. //don't select first fieldset inputs and dont select the rowcount input
	jQuery('#jtrt_table_creator_options_container fieldset:not(:first-child) ul li input:not(#jtrt_table_allow_paging_rowCount)').on('click', function(){
		jQuery(this).val(jQuery(this).prop('checked'));
	});
	

	
	
	
	
	
	
	// ****
	// **** Table Sorting Functionality
	// **** Credits to johnny https://johnny.github.io/jquery-sortable/
	// ****

	$('.jtrt_table_creator').sortable({
		containerSelector: 'table',
		itemPath: '> tbody',
		itemSelector: 'tr:not(:last-child)',
		placeholder: '<tr class="placeholder"/>',
		onDrop: function  ($item, container, _super) {
			jtTables.recountRows();
			$item.removeClass('moving');
		},
		onDragStart: function ($item, container, _super) {
			$item.addClass('moving');
		}
	});

	var oldIndex;
	$('tr.sorted_head').sortable({
	containerSelector: 'tr',
	itemSelector: 'td:not(:first-child)',
	placeholder: '<td class="placeholder"/>',
	vertical: false,
	exclude: '.jtrt_custom_td',
	onDragStart: function ($item, container, _super) {
		oldIndex = $item.index();
		$item.appendTo($item.parent());
		_super($item, container);
	},
	onDrop: function  ($item, container, _super) {
		var field,
			newIndex = $item.index();
		if(newIndex == 0){
			return;
		}
		if(newIndex != oldIndex) {
		$item.closest('table').find('tbody tr').each(function (i, row) {
			row = $(row);
			if(newIndex < oldIndex) {
			row.children().eq(newIndex).before(row.children()[oldIndex]);
			} else if (newIndex > oldIndex) {
			row.children().eq(newIndex).after(row.children()[oldIndex]);
			}
		});
		}

		_super($item, container);
	}
	});



})( jQuery );
