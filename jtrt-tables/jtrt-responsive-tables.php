<?php
/*
Plugin Name: JTRT Responsive Tables
Plugin URI: https://github.com/mythirdeye/jtrt-tables
Description: Custom responsive tables plugin for Wordpress
Author: John Tendik
Version: 1.3
License: GPLv2
*/

//
// ACTIONS *****************************************
//
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

	$jtrt_options = get_option('jtrt_tables_options');

	add_thickbox();

	?>

	<div class="wrap">

		<h2>JT Responsive Tables</h2>
		<form method="post" action="options.php">
		<div id="tabs">
		    <ul>
		        <li><a href="#fragment-1"><span>Docs</span></a></li>
		        <li><a href="#fragment-2"><span>Table Settings</span></a></li>
		        <li><a href="#fragment-3"><span>Table Generator</span></a></li>
		    </ul>
		    <div id="fragment-1" data-tab-index="0">
						<table class="form-table">
							<tbody>
									<tr>
										<th scope="row">
											<h3>Documentation & Information</h3>	
										</th>

										<td>
											<div class="jtrt-blockquote">
												<p>Thank you for choosing to download this plugin. I really hope it serves you well :) If you have any problems, please contact me through github or wordpress and I will do my best to help out.</p>
												<h4>Documentation:</h4>
												<p>This is a very simple and straight forward plugin so a full featured docs isn't necessary. If you have problems working with the plugin, you can watch the video below to learn the process and how this plugin works. However, there is a useful readme/instructions page over at my github directory <a href="https://github.com/mythirdeye/jtrt-tables">here.</a> You can also use the github link to contribute to the project if you want to make it better!</p>
											</div>
										</td>
									</tr>
									<tr>
										<th scope="row">
											<h3>Video Tutorial</h3>	
										</th>

										<td>
											<div class="jtrt-blockquote">
												<iframe width="420" height="315" src="https://www.youtube.com/embed/OTxaksRothY" frameborder="0" allowfullscreen></iframe>
											</div>
										</td>
									</tr>
									<tr>
										<th scope="row">
											<h3>Credits</h3>	
										</th>

										<td>
											<div class="jtrt-blockquote">
												<p>So far this plugin is built and run by me only, no other contributers to this project. However, I make use of various other free scripts, libraries and tools that I did not create or contribute to in any way shape or form therefore I do not take credit for those works. These plugins are Jquery, Footables, and jquerycsvtotable. Full credits goes to their respective authors and contributers. 
												<br><br>
												To learn more about Jquery, <a href="https://jquery.com/">click here</a>
												<br>
												To learn more about FooTables, <a href="http://fooplugins.com/plugins/footable-jquery/">click here</a>
												<br>
												To learn more about jquerycsvtotable, <a href="https://code.google.com/p/jquerycsvtotable/">click here</a>
											</p>
											</div>
										</td>
									</tr>
							</tbody>
						</table>
			        
			        

		    </div>

		    <div id="fragment-2" data-tab-index="1">
			        

		    			<?php settings_fields( 'jtrt-options-group' ); ?>

		    			<?php do_settings_sections( 'jtrt-options-group' ); ?>
						<table class="form-table">
							<tbody>
									<tr>
										<th scope="row">
											<h3>FooTable Breakpoints Help</h3></br>
											
										</th>

										<td>
											<div class="jtrt-blockquote">
												"Breakpoints are the heart and soul of FooTable. Whenever your site is viewed on a mobile device, or if the browser window is resized, FooTable checks the width of the table. If that width is smaller than the width of a breakpoint, certain columns in the table will be hidden.

												FooTable has two default breakpoints : tablet and phone. You can change the default size of these breakpoints below, so that they match your site's theme.
												"</br></br>
												<a href="http://fooplugins.com/footable-lite/documentation/">Read more at the plugin documentation</a>
											</div>
										</td>
									</tr>
									<tr>
										<th scope="row">
											<label for="foo_breakpoint_mobile"><b>Mobile Breakpoint</b></label></br>
										</th>

										<td>
											<input type="text" id="foo_breakpoint_mobile" name='jtrt_tables_options[kwrc_table_foo_breakpoint_mobile]' value='<?php echo (empty($jtrt_options['kwrc_table_foo_breakpoint_mobile']) ? '480' : $jtrt_options['kwrc_table_foo_breakpoint_mobile']); ?>'>
											<br>
											<span class="description">The width of the phone breakpoint.</span>
										</td>
									</tr>
									<tr>
										<th scope="row">
											<label for="foo_breakpoint_tablet"><b>Tablet Breakpoint</b></label></br>
										</th>

										<td>
											<input type="text" id="foo_breakpoint_tablet" name='jtrt_tables_options[kwrc_table_foo_breakpoint_tablet]' value='<?php echo (empty($jtrt_options['kwrc_table_foo_breakpoint_tablet']) ? '920' : $jtrt_options['kwrc_table_foo_breakpoint_tablet']); ?>'>
											<br>
											<span class="description">The width of the tablet breakpoint.</span>
										</td>
									</tr>
								</tbody>
							</table>	
								
					</div>
					

		    <div id="fragment-3" data-tab-index="2">
		    
		    			<?php settings_fields( 'jtrt-options-group' ); ?>

		    			<?php do_settings_sections( 'jtrt-options-group' ); ?>

					   <table class="form-table">
					   		
							<tbody>
								<tr>
									<th scope="row">
											<h3>Table Generator Help</h3></br>
											
										</th>

										<td>
											<div class="jtrt-blockquote">
												<p>Please note that when using this plugin, you should only have 2 columns visible on the mobile sized screens and only 4 visible columns on the tablet sized screens. This ensures that the table is looking great, without squishing all the content inside.</p>
												<p><b>Table Color Legend:</b></br>
												Red cells: Hidden on both Mobile and Tablet sized screens.</br>
												Blue cells: Hidden only on Mobile sized screens.</br>
												Yellow cells: Hidden only on Tablet sized screens.</br>
												</p>

											</div>
										</td>
								</tr>
								<tr>
									<th scope="row">
										<label for="upload_image"><b>CSV file</b></label>
									</th>

									<td>
										<input id="upload_image" type="text" size="36" input type='text' name='jtrt_tables_options[kwrc_table_link]' value='<?php echo empty($jtrt_options['kwrc_table_link']) ? 'Insert CSV HERE' : $jtrt_options['kwrc_table_link']; ?>'/> 

										<input id="upload_image_button" class="button" type="button" value="Upload file" />
										<small>Enter a URL or upload a CSV file</small></br></br>
										<!-- <a id="jtrt-generate-table-button" class="button">Generate Table</a> -->
										
										<input alt="#TB_inline?height=700&amp;width=900&amp;inlineId=jtrt_thickbox_tableviewer" title="Table Generator Viewer" id="jtrt-generate-table-button" class="thickbox button" type="button" value="Generate Table" />  
									</td>
								</tr>
																
							</tbody>

						</table>

						
										
					
								

					
						
						<div id="jtrt_thickbox_tableviewer" style="display:none">
						<h2>Generated Table Viewer/Editor</h2>
						<table class="form-table">
							<tbody>
								<tr>
									<th scope="row">
										<label for="upload_image"><b>Enable Table Filters</b></label>
									</th>

									<td>
										<input type="checkbox" name="jtrt_filters_check" value="true"> Enable Tabler Filters <small>This will allow you to search through the form using a search box and filter the content</small>
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label for="upload_image"><b>Enable Table Sorting</b></label>
									</th>

									<td>
										<input type="checkbox" name="jtrt_sorting_check" value="true"> Enable Tabler Sorting <small>This will allow you to sort the table</small>
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label for="upload_image"><b>Mobile/Tablet Hide Column Buttons</b></label>
									</th>

									<td>
										<label class="switch" id="jtrt_switch">
											<span class="button active" data-switch="mobile">Mobile</span>
											<span class="button" data-switch="tablet">Tablet</span>
										</label>
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label for="upload_image"><b>Column Count Helper</b></label>
									</th>

									<td>
										<p id="jtrt_column_counter"></p>
									</td>
								</tr>
							</tbody>
						</table>

						<div class="form-table">		
							<div class="insert_jtrt_here">
					
							</div>
							
						</div>

						<table class="form-table">
							<tbody>
								<tr>
									<th scope="row">
										<label for="upload_image"><b>Generate HTML</b></label>
									</th>

									<td>
										<a id="jtrt-generate-html-button" class="button" style="margin-right:10px">Generate HTML</a>
										<a id="jtrt-generate-shortcode-button" class="button" style="margin-right:10px">Generate Shortcode</a>
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label for="upload_image"><b>Copy Paste HTML</b></label>
									</th>

									<td>
										<form action="" class="generated-html-jtrt">
										<textarea name="jtrt_html_box" id="jtrt_html_box" cols="30" rows="10"></textarea></form>
									</td>
								</tr>
							</tbody>
						</table>

						</div> <!-- end thickbox -->

							
				
				<table class="form-table">
					<tbody>
							<tr>
								<th scope="row">
									<h3>Saved Tables</h3>	
								</th>

								<td>
									
										<p>Your saved tables will show up here and you can edit, view and delete them from the database!</p>
								
								</td>
							</tr>							
					</tbody>
				</table>
				<table class="widefat">
				<thead>
					<tr>
						<th>Table # </th>
						<th>Table ID</th>		
						<th>Table Shortcode</th>
						<th>Table Options</th>
					</tr>
				</thead>
				<tfoot>
				    <tr>
						<th>Table # </th>
						<th>Table ID</th>		
						<th>Table Shortcode</th>
						<th>Table Options</th>
				    </tr>
				</tfoot>
				<tbody>
					
				  	<?php 

						check_remaining_tables_jtrt();

					?>
				</tbody>
				</table>
				
		    </div> <!-- END FRAGMENT 3 -->

		</div>
		<?php submit_button(); ?>
				</form>	
	</div> <!-- end wrap -->

	<?php

}


function jtrt_tables_script_caller( $hook_suffix ) {

	if ( 'settings_page_jtrt_tables' !== $hook_suffix ) {
        return;
    }

	wp_enqueue_media();
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'table-generator-from-csv', plugins_url( '/js/jquery.csvToTable.js', __FILE__ ), array( 'jquery' ), 1, true );
	wp_register_script( 'jtrt-csv-upload', plugins_url( '/js/jtrt-js-handler.js', __FILE__ ), array( 'jquery' ), 1, true );


    $jtrt_options_array = array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	);

    wp_localize_script( 'jtrt-csv-upload', 'jtrt_options_arr', $jtrt_options_array );
	wp_enqueue_script( 'jtrt-csv-upload' );
	$jtrt_options = get_option('jtrt_tables_options');


	wp_enqueue_style( 'jtrt-custom-style', plugins_url( '/css/jtrt-tables.css', __FILE__ ) );
	

}

function jtrt_front_end_styles() {

    wp_enqueue_style( 'jtrt_footable_css_import', plugins_url( '/includes/footable.core.min.css', __FILE__ ) );
    wp_register_script( 'footable_init_hook', plugins_url( '/includes/footable.min.js', __FILE__), array( 'jquery' ), 0, true );

    $jtrt_options = get_option('jtrt_tables_options');

    if (!isset($jtrt_options['kwrc_table_foo_breakpoint_tablet'])){
    	$jtrt_options['kwrc_table_foo_breakpoint_tablet'] = 980;
    }
    if (!isset($jtrt_options['kwrc_table_foo_breakpoint_mobile'])){
    	$jtrt_options['kwrc_table_foo_breakpoint_mobile'] = 480;
    }

    $jtrt_options_array = array(
		'jtrt_mobile_bp' => $jtrt_options['kwrc_table_foo_breakpoint_mobile'],
		'jtrt_tablet_bp' => $jtrt_options['kwrc_table_foo_breakpoint_tablet']
	);


	

    wp_localize_script( 'footable_init_hook', 'jtrt_options_arr', $jtrt_options_array );
    wp_enqueue_script( 'footable_init_hook' );
    wp_register_script( 'jtrt-footable-sorting', plugins_url( '/includes/footable.sort.min.js', __FILE__ ), array( 'jquery' ), 1, true );
	wp_enqueue_script( 'jtrt-footable-sorting' );
	wp_register_script( 'jtrt-footable-filter', plugins_url( '/includes/footable.filter.min.js', __FILE__ ), array( 'jquery' ), 1, true );
	wp_enqueue_script( 'jtrt-footable-filter' );
    wp_register_script( 'jtrt-csv-upload2', plugins_url( '/js/jtrt-js-handler-frontend.js', __FILE__ ), array( 'jquery' ), 1, true );
	wp_enqueue_script( 'jtrt-csv-upload2' );	
    // wp_enqueue_style( 'custom-style', plugins_url( 'css/jtrt-tables.css', __FILE__ ) );
    
}


function jtrt_creates_db_tables() {
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	global $wpdb;
	global $charset_collate;
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$sql_create_table = "CREATE TABLE " . $jtrt_tables_name . " ( 
          jttable_id bigint(20) unsigned NOT NULL auto_increment,
          object_type TEXT,
          PRIMARY KEY  (jttable_id) 
     ) $charset_collate; ";
 
	dbDelta( $sql_create_table );

}
 
register_activation_hook( __FILE__, 'jtrt_creates_db_tables' );

add_action('wp_ajax_jtrttablesave1', 'jtrt_add_db_data');
add_action('wp_ajax_jtrttabledelete1', 'jtrt_delete_db_data');
add_action('wp_ajax_jtrttableedit1', 'jtrt_edit_table_db');
add_action('wp_ajax_jtrttableedit2', 'jtrt_update_table_db');

function jtrt_add_db_data(){
	
	global $wpdb;

	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$dataHTML = $_POST['data'];

		$wpdb->insert(
		     $jtrt_tables_name,
		     array(
		     	'object_type'=>$dataHTML,
		      ),
		     array (
		        '%s'
		     )
	 	);
	
	echo 'success';
	wp_die();

}

function jtrt_delete_db_data(){
	global $wpdb;
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$delete_post_id = $_POST['id'];
	$wpdb->delete( $jtrt_tables_name, array( 'jttable_id' => $delete_post_id ) );
	echo 'deleted';
}

function jtrt_shortcode_table( $atts ){
	global $wpdb;
	$jtrt_settings = shortcode_atts( array(
        'id' => '1'
    ), $atts );
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $jtrt_tables_name WHERE jttable_id = " . $jtrt_settings['id'] );
	echo html_entity_decode(stripslashes($retrieve_data[0]->object_type));
	
}
add_shortcode( 'jtrt_tables', 'jtrt_shortcode_table' );

function check_remaining_tables_jtrt(){
	global $wpdb;
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$jtrt_vars = $wpdb->get_results("SELECT * FROM $jtrt_tables_name");
	foreach ($jtrt_vars as $key=>$val) {
		echo "<tr>
				<td>
					<p>". $key ."</p>							
				</td>
				<td>									
					<p id='jtrt_table_id'>". $val->jttable_id ."</p>
				</td>
				<td>									
					<p>[jtrt_tables id='". $val->jttable_id ."']</p>
				</td>
				<td>
					<a class='button thickbox' href='#TB_inline?height=700&amp;width=900&amp;inlineId=jtrt_thickbox_tableviewer' data-jtrt-id-table='".$val->jttable_id."' id='jtrt_edit_table'>Edit Table</a>			
					<a class='button' href='#' data-jtrt-id-table='".$val->jttable_id."' id='jtrt_delete_table'>Delete Table</a>									
				</td>
			</tr>";
	}
}

function jtrt_edit_table_db(){
	global $wpdb;
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$edit_post_id = $_POST['id'];
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $jtrt_tables_name WHERE jttable_id = " . $edit_post_id );
	echo html_entity_decode(stripslashes($retrieve_data[0]->object_type));
}

function jtrt_update_table_db(){
	global $wpdb;
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$edit_post_id = $_POST['id'];
	$edit_content = $_POST['html'];
	$wpdb->update( 
		$jtrt_tables_name, 
		array( 
			'object_type' => $edit_content
			
		), 
		array( 'jttable_id' => $edit_post_id ), 
		array( 
			'%s'	
		), 
		array( '%d' ) 
	);
	echo 'success, updated the database';
}

?>