<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       //
 * @since      1.0.0
 *
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/admin
 * @author     John Tendik <johntendik@hotmail.com>
 */
class Jtrt_Responsive_Tables_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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
		if(CheckIfJTRTExists()){
			wp_enqueue_style('plugin_name-admin-ui-css',
                'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css',
                false,
                PLUGIN_VERSION,
                false);
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../dist/admin/css/jtrt-responsive-tables-admin.min.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
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
	    if(CheckIfJTRTExists()){
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script( $this->plugin_name . '-vendor', plugin_dir_url( __FILE__ ) . '../dist/admin/js/jtrt-responsive-tables-vendor-admin.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../dist/admin/js/jtrt-responsive-tables-admin.min.js', array( 'jquery' ), $this->version, true );
		}
		
		
	}
	

	public function jtrt_tables_post() {
		
		/**
		 * This function will create, and register the JTRT Tables custom post type and create the admin menu page. 
		 */

		require_once plugin_dir_path( __FILE__ ) . 'partials/jtrt_tables_customPT.php' ;
		

	}
	
	public function jtrt_table_add_meta_box() {
		// First meta box is the general settings area
		add_meta_box(
			'jtrt_tables_post',
			__( 'JTRT Table Creator', 'jtrt-table-text-domain' ),
			'jtrt_meta_box_callback_1',
			'jtrt_tables_post'
		);
	}
	
	
	public function jtrt_save_metabox_data( $post_id ) {
		// Check if our nonce is set.
		if ( ! isset( $_POST['jtrt_save_nonce_check'] ) ) {
			return;
		}
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['jtrt_save_nonce_check'], 'jtrt_save_metabox_data' ) ) {
			return;
		}
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}
		
		/* OK, it's safe for us to save the data now. */
		// Make sure that it is set.
		if ( ! isset( $_POST['jtrt_general_settings'] ) ) {
			return;
		}
		
		// Sanitize user input.
		$my_data = $_POST['jtrt_general_settings'];
        $my_data2 = $_POST['jtrt_styles_settings'];
        
		// Update the meta field in the database.
		update_post_meta( $post_id, 'jtrt_general_settings', array_map( 'sanitize_text_field', $my_data ) );
        update_post_meta( $post_id, 'jtrt_styles_settings', array_map( 'sanitize_text_field', $my_data2 ) );
		
	}
	
	public function jtrt_tables_generate_ajax(){
        
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
		global $wpdb;
        // reuqired for ajax and wordpress db interactions

		$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";    // database table prefix
		$dataHTML = $_POST['data'];                           // The data recieved from ajax
		$dataIDD = $_POST['idd'];                             // The data recieved from ajax, the ID of the post
		$dataTableName = $_POST['table_name'];                // data from ajax, table namespace
        $dataTableStyles = $_POST['table_styles'];

        // Store variables for easier reference later. 
        
        // if the ajax information is empty, or incomplete, die. 
		if($dataHTML == "" || empty($dataHTML) || !isset($dataHTML))
			return false;

        // Variable to let us know if the database has the table already
		$check_if_exists_table = $wpdb->get_var("SELECT jttable_IDD FROM $jtrt_tables_name WHERE jttable_IDD=".$dataIDD);

        // If the information recieved from AJAX does not match results from the databse, insert the table into the Database
		if($check_if_exists_table == NULL){
			if($_POST['table_name'] != ""){
				$dataTableName = $_POST['table_name'];
			}else{
				$dataTableName = "jtrt_table" . $dataIDD;
			}
			
            $wpdb->insert( 
                $jtrt_tables_name,
                array( 
                    'jttable_IDD' => $dataIDD, 
                    'object_type' => $dataHTML,
                    'jttable_name' => $dataTableName,
					'jttable_styles' => $dataTableStyles                                 
                ), 
                array( 
                    '%d', 
                    '%s',
                    '%s',
					'%s'
                ) 
            );
                
		}else{
			if($_POST['table_name'] != ""){
				$dataTableName = $_POST['table_name'];
			}else{
				$dataTableName = "jtrt_table" . $dataIDD;
			}
            $wpdb->update( 
                $jtrt_tables_name, 
                array( 
                    'jttable_IDD' => $dataIDD, 
                    'object_type' => trim($dataHTML),
                    'jttable_name' => $dataTableName,
					'jttable_styles' => $dataTableStyles
                ), 
                array( 'jttable_IDD' => $dataIDD )
                
            );
		}		
		wp_die();
	}
	
	public function delete_jtrt_tables_func($postid){
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		global $wpdb;
		global $post_type;
		$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
    	if ( $post_type != 'jtrt_tables_post' ) return;
    	$wpdb->delete( $jtrt_tables_name, array( 'jttable_IDD' => $postid ), array( '%d' ) );
	}
	
} // End Of admin class
function CheckIfJTRTExists(){
	$currentPage = get_current_screen();
	return ($currentPage->id === "jtrt_tables_post") ? true : false;
}
require_once plugin_dir_path( __FILE__ ) . 'partials/admin-extras.php';