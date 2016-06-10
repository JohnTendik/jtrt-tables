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
		  function wpse172275_get_all_attributes( $tag, $text )
        {
            preg_match_all( '/' . get_shortcode_regex() . '/s', $text, $matches );
            $out = array();
            if( isset( $matches[2] ) )
            {
                foreach( (array) $matches[2] as $key => $value )
                {
                    if( $tag === $value )
                        $out[] = shortcode_parse_atts( $matches[3][$key] );  
                }
            }
            return $out;
        }
		 function get_table_styles_jtrt(){
            
            global $wpdb;
            $postid = get_the_ID();
            $jtrt_query = "";
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post(); 
                    $jtrt_query .= get_the_content();               
                } // end while
                $jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
                $test_array = wpse172275_get_all_attributes( 'jtrt_tables', $jtrt_query);

                if( !empty( $test_array ) ){
                    $table_array_id = "jttable_IDD IN (";
                    for($i = 0; $i < count($test_array); $i++){
                        if($i == (count($test_array) - 1)){
                            $table_array_id .= $test_array[$i]['id'] . ");";                    
                        }else{
                            $table_array_id .= $test_array[$i]['id'] . ", ";                    
                        }
                    }
                    $retrieve_data = $wpdb->get_results( "SELECT jttable_styles FROM $jtrt_tables_name WHERE ". $table_array_id );
                    $content = "";
                    if($retrieve_data){   
                        foreach($retrieve_data as $data){
                        $content .= $data->jttable_styles; 
                        }; 
                        return $content;
                    }else{
                        return "error";
                    }
                }
                
                
                
            } // end if
            
            
           
            
        }
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../dist/public/css/jtrt-responsive-tables-public.min.css', array(), $this->version, 'all' );
		$file = WP_PLUGIN_DIR . '/jtrt-responsive-tables/dist/public/css/jtrt_custom_styles.css';
        // Open the file to get existing content
        $current = file_get_contents($file);
        // Append a new person to the file
        $current = get_table_styles_jtrt();
        // Write the contents back to the file
        file_put_contents($file, $current);
        wp_enqueue_style( "jtrt_custom_css", plugin_dir_url( __FILE__ ) . '../dist/public/css/jtrt_custom_styles.css', array(), $this->version, 'all' );
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
		wp_enqueue_script( $this->plugin_name . "-vendor", plugin_dir_url( __FILE__ ) . '../dist/public/js/jtrt-responsive-tables-vendor-public.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../dist/public/js/jtrt-responsive-tables-public.min.js', array( 'jquery' ), $this->version, true );

	}

}
