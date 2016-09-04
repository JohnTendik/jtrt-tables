<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       //
 * @since      1.0.0
 *
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/public
 * @author     John Tendik <johntendik@hotmail.com>
 */
class Jtrt_Responsive_Tables_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jtrt_Responsive_Tables_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jtrt_Responsive_Tables_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		 function get_table_styles_jtrt(){
			
			global $wpdb;
			$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";

			$test_array = isJTRTonThePage();

			if( !empty( $test_array ) ){
				$table_array_id = "jttable_IDD IN (";
				for($i = 0; $i < count($test_array); $i++){
					if($i == (count($test_array) - 1)){
						$table_array_id .= $test_array[$i]['id'] . ");";                    
					}else{
						$table_array_id .= $test_array[$i]['id'] . ", ";                    
					}
				}
				$retrieve_data = $wpdb->get_results( "SELECT jttable_styles, jttable_IDD FROM $jtrt_tables_name WHERE ". $table_array_id );
				$content = "";

				if($retrieve_data){   
					foreach($retrieve_data as $data){
						$content .= jtrt_custom_styler($data); 
					}; 
					return $content;
				}else{
					return "error";
				}
			}  
        }

		$test_array = isJTRTonThePage();

		wp_register_style( 'jtrt-table-styles-public', plugin_dir_url( __FILE__ ) . '../dist/public/css/jtrt-responsive-tables-public.min.css', array(), $this->version, 'all' );
		wp_register_style( 'jtrt-table-custom-styles-public', plugin_dir_url( __FILE__ ) . '../dist/public/css/jtrt_custom_styles.css', array(), $this->version, 'all' );

		if( !empty( $test_array ) ){

			wp_enqueue_style( 'jtrt-table-styles-public' );
			$file = WP_PLUGIN_DIR . '/jtrt-responsive-tables/dist/public/css/jtrt_custom_styles.css';
			// Open the file to get existing content
			$current = file_get_contents($file);
			// Append a new person to the file
			$current = get_table_styles_jtrt();
			// Write the contents back to the file
			file_put_contents($file, $current);
			wp_enqueue_style( "jtrt-table-custom-styles-public" );
		}

		
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jtrt_Responsive_Tables_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jtrt_Responsive_Tables_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$test_array = isJTRTonThePage();

		wp_register_script( "jtrt-table-vendor-scripts", plugin_dir_url( __FILE__ ) . '../dist/public/js/jtrt-responsive-tables-vendor-public.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( "jtrt-table-scripts", plugin_dir_url( __FILE__ ) . '../dist/public/js/jtrt-responsive-tables-public.min.js', array( 'jquery', 'jtrt-table-vendor-scripts' ), $this->version, true );

		if( !empty( $test_array ) ){
			wp_enqueue_script( "jtrt-table-vendor-scripts" );
			wp_enqueue_script( "jtrt-table-scripts" );
		}
	}

}

function jtrt_get_all_attrs( $tag, $text ){
	preg_match_all( '/' . get_shortcode_regex() . '/s', $text, $matches );
	$out = array();
	if( isset( $matches[2] ) ){
		foreach( (array) $matches[2] as $key => $value ){
			if( $tag === $value )
				$out[] = shortcode_parse_atts( $matches[3][$key] );  
		}
	}
	return $out;
}

function isJTRTonThePage(){
	global $wpdb;
	$postid = get_the_ID();
	$jtrt_query = "";
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); 
			$jtrt_query .= get_the_content();               
		} // end while

		$test_array = jtrt_get_all_attrs( 'jtrt_tables', $jtrt_query);
		if( !empty( $test_array ) ){
			if(strpos($jtrt_query, 'jtrt_custom_html') !== false){
				
				preg_match_all('/jtrt_custom_html.*jtrt_table_\d+|jtrt_table_\d+.*jtrt_custom_html/',$jtrt_query,$customhtmljt);

				foreach ($customhtmljt[0] as $key => $value) {
					preg_match_all('/jtrt_table_\d+/', $value, $matches);
					$id = explode("_", $matches[0][0]);
					array_push($test_array,array('id' => $id[2]));	
				}
				
				
				
			}
			return $test_array;
		}else{
			if(strpos($jtrt_query, 'jtrt_custom_html') !== false){
			
				preg_match_all('/jtrt_custom_html.*jtrt_table_\d+|jtrt_table_\d+.*jtrt_custom_html/',$jtrt_query,$customhtmljt);

				foreach ($customhtmljt[0] as $key => $value) {
					preg_match_all('/jtrt_table_\d+/', $value, $matches);
					$id = explode("_", $matches[0][0]);
					array_push($test_array,array('id' => $id[2]));	
				}

				return $test_array;
				
			}else{
				return false;
			}	
		}

		
	}
}

function jtrt_custom_styler($data){
	if(isset($data->jttable_styles) && strpos($data->jttable_styles, 'example') !== false){
		$styleType = explode(",",$data->jttable_styles)[1];
		$file = WP_PLUGIN_DIR . '/jtrt-responsive-tables/public/css/' . $styleType . ".css";
		$current = file_get_contents($file);
		$current = str_replace(".replace-me-for-specific-class.".$styleType,".jtrt_".$data->jttable_IDD."_exStyle_".$styleType,$current);
		return $current;
	}
}

function jtrt_check_for_custom_html($content){
	if(strpos($content, 'jtrt_custom_html') !== false){
	
		preg_match_all('/jtrt_custom_html.*jtrt_table_\d+|jtrt_table_\d+.*jtrt_custom_html/',$content,$customhtmljt);

		foreach ($customhtmljt[0] as $key => $value) {
			preg_match_all('/jtrt_table_\d+/', $value, $matches);
			$id = explode("_", $matches[0][0]);
			$content =  jtrt_handle_custom_HTML($id[2],$content);			
		}
		
		
		
	}
	
	return $content;
}

function jtrt_handle_custom_HTML($idd,$origContent){
	global $wpdb;
	$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
	$retrieve_data = $wpdb->get_results( "SELECT * FROM $jtrt_tables_name WHERE jttable_IDD = " . $idd );
    if($retrieve_data){   
       $htmlContent = "";
       if(get_post_meta($idd, 'jtrt_general_settings')[0]['showTitle'] !== undefined && get_post_meta($idd, 'jtrt_general_settings')[0]['showTitle'] === "true"){
          $htmlContent .="<h2 style='text-align:". get_post_meta($idd, 'jtrt_general_settings')[0]['titlePos'] .";'>".$retrieve_data[0]->jttable_name."</h2>";
       }
       ob_start();
       echo "<input name='' id='jtrt_hidden_tableBP".$idd."' type='hidden' value='".(isset(get_post_meta($idd, 'jtrt_general_settings')[0]['hiddenCols']) ? get_post_meta($idd, 'jtrt_general_settings')[0]['hiddenCols'] : '')."'>";
       $htmlContent .= ob_get_clean();
	   $htmlContent .= "<table class=\"jtrt_table_creator jtrt_table_" . $idd;
	   $origContent = str_replace("<table class=\"jtrt_table_creator jtrt_table_".$idd,$htmlContent,$origContent);
       if(strpos($retrieve_data[0]->jttable_styles, 'example') !== false){
           $jtrt_example_style = explode(",",$retrieve_data[0]->jttable_styles);
           $origContent = str_replace("jtrt_table_" . $idd,"jtrt_table_" . $idd ." jtrt_".$idd."_exStyle_".$jtrt_example_style[1],$origContent);
       }
       return $origContent;
    }
}

add_filter( 'the_content', 'jtrt_check_for_custom_html' );