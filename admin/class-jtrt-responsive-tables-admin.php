<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://johntendik.github.io
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
			wp_enqueue_style( $this->plugin_name . "-handsontable", plugin_dir_url( __FILE__ ) . 'css/vendor/handsontable.full.min.css', array(), $this->version, 'all' ); 
		
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jtrt-responsive-tables-admin.css', array(), $this->version, 'all' );
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
			wp_enqueue_media();
			wp_enqueue_script( $this->plugin_name . "-handsontable", plugin_dir_url( __FILE__ ) . 'js/vendor/handsontable.full.min.js',array(), $this->version, true );
			wp_enqueue_script( $this->plugin_name . "-colorpicker", plugin_dir_url( __FILE__ ) . 'js/vendor/colorpicker.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . "-papa", plugin_dir_url( __FILE__ ) . 'js/vendor/papaparse.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . "-class", plugin_dir_url( __FILE__ ) . 'js/vendor/jtrt-responsive-tables-class.js',array(), $this->version, true );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jtrt-responsive-tables-admin.js', array( 'jquery' ), $this->version, false );
		}
	}

	public function jtrt_create_tables_cpost(){
		/**
		 * This function will create, and register the JTRT Tables 
		 * custom post type and create the admin menu page. 
		 * File is loaded from offshore because I don't like messy long files.
		 **/
		require_once plugin_dir_path( __FILE__ ) . 'partials/jtrt-custom-post-type.php' ;
	}

	public function jtrt_cpost_add_meta_box(){
		/**
		 * This is the function that will create the Metabox for our edit tables page.
		 **/
		 add_meta_box(
			'jtrt_tables_post',
			__( 'JTRT Table Creator', $this->plugin_name ),
			'jtrt_meta_box_html_callback',
			'jtrt_tables_post',
			'advanced',
            'high'
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
		if ( ! isset( $_POST['jtrt-table-data'] ) ) {
			return;
		}
		
		// Sanitize user input.
		$my_data = $_POST['jtrt-table-data'];

        
		// Update the meta field in the database.
		update_post_meta( $post_id, 'jtrt_data_settings', array_map(null, $my_data ) );
		
	}

	public function get_old_table_callback(){
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		global $wpdb;

		$getTableId = $_POST['tableId'];
		$tableopt = $_POST['tableOpt'];
		$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";

		if($tableopt == "delete"){
			global $post_type;
			$wpdb->delete( $jtrt_tables_name, array( 'jttable_IDD' => $getTableId ), array( '%d' ) );
			
			echo false;
			return false;
		}

		
		$retrieve_data = $wpdb->get_results( "SELECT * FROM $jtrt_tables_name WHERE jttable_IDD = " . $getTableId );

		if($retrieve_data){ 
			echo html_entity_decode(stripslashes($retrieve_data[0]->object_type));
		}else{
			echo 'no';
		}


	}


	public function jtrt_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'jtrt_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}

/*
 * Add the duplicate link to action list for post_row_actions
 */
public function jtrt_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		
        if ($post->post_type=='jtrt_tables_post')
        {
            $actions['duplicate'] = '<a href="admin.php?action=jtrt_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
        }
       
	}
	return $actions;
}
 


}

// load in the extra functions 
require_once plugin_dir_path( __FILE__ ) . 'partials/jtrt-adminClass-extras.php';
