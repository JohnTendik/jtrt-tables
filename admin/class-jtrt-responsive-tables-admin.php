<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/mythirdeye/jtrt-tables
 * @since      2.0.0
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
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
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
	 * @since    2.0.0
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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jtrt-responsive-tables-admin.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'jqjtrui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all' );
       
        wp_enqueue_style( 'wp-color-picker' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
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
        
		wp_enqueue_script( 'csvToTable', plugin_dir_url( __FILE__ ) . 'js/jquery.csvToTable.js', array( 'jquery' ), 1.2, true ); // The lovely script which will do some hardcore CSV conversion 
		wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('jquery-ui-dialog');
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jtrt-responsive-tables-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, true ); // The bulk of the js script, handles most of the admin functions
		wp_enqueue_media(); // This is so we can use the upload media from Wordpress
        
	}
    
    // Create our custom JTRT Tables post type.
	public function jtrt_tables_post() {

		$labels = array(
			'name'                  => _x( 'JTRT Tables', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'JTRT Table', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'JTRT Table', 'text_domain' ),
			'name_admin_bar'        => __( 'JTRT Table', 'text_domain' ),
			'archives'              => __( 'Table Archives', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Table:', 'text_domain' ),
			'all_items'             => __( 'All Tables', 'text_domain' ),
			'add_new_item'          => __( 'Add New Table', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Table', 'text_domain' ),
			'edit_item'             => __( 'Edit Table', 'text_domain' ),
			'update_item'           => __( 'Update Table', 'text_domain' ),
			'view_item'             => __( 'View Table', 'text_domain' ),
			'search_items'          => __( 'Search Table', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into table', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Table', 'text_domain' ),
			'items_list'            => __( 'Tables list', 'text_domain' ),
			'items_list_navigation' => __( 'Tables list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter Tables list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'JTRT Table', 'text_domain' ),
			'description'           => __( 'Easy tables for display! ', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 75,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'jtrt_tables_post', $args );

	}

    // This function is called by a Wordpress Hook which will add our custom meta boxes to our custom post type.
    // There are multiple metaboxes to display here
	public function jtrt_table_add_meta_box_1() {
        
        // First meta box is the general settings area
		add_meta_box(
			'jtrt_tables_post',
			__( 'General Table Settings', 'jtrt-table-text-domain' ),
			'jtrt_meta_box_callback_1',
			'jtrt_tables_post'
		);
        
        // Second meta box is the table editor
		add_meta_box(
			'jtrt_tables_post2',
			__( 'Table Column Editor', 'jtrt-table-text-domain' ),
			'jtrt_meta_box_callback_2',
			'jtrt_tables_post'
		);
        
        add_meta_box(
			'jtrt_tables_post3',
			__( 'Table Style Editor', 'jtrt-table-text-domain' ),
			'jtrt_meta_box_callback_3',
			'jtrt_tables_post'
		);
        
	}

    // Saving our Meta box values, This function is again called by a wordpress hook
	public function myplugin_save_meta_box_data( $post_id ) {
		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_save_meta_box_data' ) ) {
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
        $my_data2 = $_POST['jtrt_style_settings'];
        
		// Update the meta field in the database.
		update_post_meta( $post_id, 'jtrt_general_settings', array_map( 'sanitize_text_field', $my_data ) );
        update_post_meta( $post_id, 'jtrt_style_settings', array_map( 'sanitize_text_field', $my_data2 ) );
	}	

    // This is an AJAX function which will be called from the Bulky Javascript file. It will store the metabox information and table settings into the wordpress database
	public function jtrt_tables_generate_ajax(){
        
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        
		global $wpdb;
        // reuqired for ajax and wordpress db interactions

		$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";    // database table prefix
		$dataHTML = $_POST['data'];                           // The data recieved from ajax
		$dataIDD = $_POST['idd'];                             // The data recieved from ajax, the ID of the post
		$dataTableName = $_POST['table_name'];                // data from ajax, table namespace
        $dataTableStyles = $_POST['table_styles'];
        $dataTableStylesJson = json_decode($dataTableStyles);
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
                    'jttable_styles' => $dataTableStyles['container_styles'].$dataTableStyles['table_styles']                
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
                    'jttable_styles' => $dataTableStyles['container_styles'].$dataTableStyles['table_styles'] 
                ), 
                array( 'jttable_IDD' => $dataIDD )
                
            );
		}		
		wp_die();
	}


    // Remove the table from the databse if the trash is emptied. 
	public function delete_jtrt_tables_func($postid){
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		global $wpdb;
		global $post_type;
		$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
    	if ( $post_type != 'jtrt_tables_post' ) return;
    	$wpdb->delete( $jtrt_tables_name, array( 'jttable_IDD' => $postid ), array( '%d' ) );
	}

    



} // end admin class


// Extra functions that do not belong inside the class apparently
// include our functions for shortcode & settings page
require_once plugin_dir_path( __FILE__ ) . 'partials/jtrt-responsive-tables-shortcode-gen.php';	
require_once plugin_dir_path( __FILE__ ) . 'partials/jtrt-responsive-tables-cpt-settings-page.php';	
	

// the callback function for displaying the first metabox
function jtrt_meta_box_callback_1( $post ) {
	require_once plugin_dir_path( __FILE__ ) . 'partials/jtrt-responsive-tables-post-meta-1-display.php';		
}

// the callback function for displaying the second metabox
function jtrt_meta_box_callback_2( $post ) {
	require_once plugin_dir_path( __FILE__ ) . 'partials/jtrt-responsive-tables-post-meta-2-display.php';		
}

function jtrt_meta_box_callback_3( $post ) {
	require_once plugin_dir_path( __FILE__ ) . 'partials/jtrt-responsive-tables-post-meta-3-display.php';		
}

// functions to display custom columns on our custom post type table
add_filter('manage_jtrt_tables_post_posts_columns', 'bs_event_table_head');
function bs_event_table_head( $defaults ) {
    $defaults['short_code_jt']  = 'Shortcode';
    return $defaults;
}

add_action( 'manage_jtrt_tables_post_posts_custom_column', 'bs_event_table_content', 10, 2 );

function bs_event_table_content( $column_name, $post_id ) {
    if ($column_name == 'short_code_jt') {
      echo "[jtrt_tables id='" . $post_id . "']";
    }
}

