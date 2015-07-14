<?php

/*

Plugin Name: JT Responsive Tables

Plugin URI: //

Description: Custom responsive tables plugin for Wordpress

Author: John Tendik

Version: 1.0

*/




////////////////////////////////////////////////////
// ACTIONS *****************************************
////////////////////////////////////////////////////
add_action( 'admin_menu', 'jtrt_tables_admin_menu' );
add_action( 'admin_enqueue_scripts', 'jtrt_tables_script_caller' );
add_action( 'wp_enqueue_scripts', 'jtrt_front_end_styles' );

function jtrt_tables_admin_menu() { 

	add_options_page( 'JT_Tables', 'JT R. Tables', 'manage_options', 'jtrt_tables', 'jtrt_tables_plugin_options_page' );

	add_action( 'admin_init', 'register_jtrt_tables_plugin_settings' );

}

function register_jtrt_tables_plugin_settings(){

	register_setting( 'jtrt-options-group', 'jtrt_tables_options' );
	
}

function jtrt_tables_plugin_options_page(){

	$options = get_option('jtrt_tables_options');

	?>

	<div class="wrap">

		<h2>JT Responsive Tables</h2>

		<p>Step 1: Upload a CSV File using the file uploader or link one from an external source. You must save the form, (Click save changes button) before the link can be registered in the script</p>
		<p>Step 2: Once the link is saved, press the "Generate Table" button</p>
		<p>Step 3: Click on the Header columns to select them, the rows will highlight blue. The blue rows will be hidden when the form is tablet sized.</p>
		<p>Step 4: Once you select the rows that you want to hide on mobile sizes, press the generate HTML link and copy paste the HTML from the textbox into your post.</p>
		<p>NOTE: You should have a maximum of 4 columns visible for the mobile sizes to work properly, all other columns should be hidden. Otherwise the table will be too large and flow off the screen.(ie. If you have 12 columns, at least 8 of those should be hidden.)</p>


		<form method="post" action="options.php">

	    	<?php settings_fields( 'jtrt-options-group' ); ?>

	    	<?php do_settings_sections( 'jtrt-options-group' ); ?>

		   	<fieldset class="jtrt_fieldset">

				<label for="upload_image"><b>CSV file</b></label></br>

				<input id="upload_image" type="text" size="36" <input type='text' name='jtrt_tables_options[kwrc_table_link]' value='<?php echo $options['kwrc_table_link']; ?>'/> 

				<input id="upload_image_button" class="button" type="button" value="Upload file" />

				<small>Enter a URL or upload a CSV file</small>

				<br/>

			</fieldset>

			<fieldset class="jtrt_fieldset">

				<a id="jtrt-generate-table-button" class="button">Generate Table</a>

				<a id="jtrt-generate-html-button" class="button">Generate HTML</a>
				
				<div class="insert_jtrt_here">
					
				</div>

				<textarea name="jtrt_html_box" id="jtrt_html_box" cols="30" rows="10"></textarea>

			</fieldset>


	    
	    	<?php submit_button(); ?>

		</form>
	</div>

	<?php

}

function jtrt_tables_script_caller( $hook_suffix ) {

	if ( 'settings_page_jtrt_tables' !== $hook_suffix ) {
        return;
    }

	wp_enqueue_media();
	wp_enqueue_script( 'table-generator-from-csv', plugins_url( 'jtrt-tables/js/jquery.csvToTable.js', dirname(__FILE__) ), array( 'jquery' ), 1, true );
	wp_register_script( 'jtrt-csv-upload', plugins_url( 'jtrt-tables/js/jtrt-js-handler.js', dirname(__FILE__) ), array( 'jquery' ), 1, true );
	wp_enqueue_script( 'jtrt-csv-upload' );
	wp_enqueue_style( 'custom-style', plugins_url( 'jtrt-tables/jtrt-tables.css' ) );

}

function jtrt_front_end_styles() {

    wp_enqueue_style( 'jtrt_footable_css_import', plugins_url( 'jtrt-tables/includes/footable.core.min.css' ) );
    wp_register_script( 'footable_init_hook', plugins_url( 'jtrt-tables/includes/footable.min.js' ), array( 'jquery' ), 0, true );
    wp_enqueue_script( 'footable_init_hook' );
    wp_register_script( 'jtrt-csv-upload2', plugins_url( 'jtrt-tables/js/jtrt-js-handler-frontend.js', dirname(__FILE__) ), array( 'jquery' ), 1, true );
	wp_enqueue_script( 'jtrt-csv-upload2' );
    wp_enqueue_style( 'custom-style', plugins_url( 'jtrt-tables/jtrt-tables.css' ) );
    
}


?>