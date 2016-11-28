<?php

/**
 * Fired during plugin activation
 *
 * @link       http://johntendik.github.io
 * @since      1.0.0
 *
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/includes
 * @author     John Tendik <johntendik@hotmail.com>
 */
class Jtrt_Responsive_Tables_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		global $wpdb;
		global $charset_collate;
		$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
		$sql_create_table = "CREATE TABLE " . $jtrt_tables_name . " ( 
			jttable_id bigint(20) unsigned NOT NULL auto_increment,
			jttable_IDD bigint(20),
			object_type LONGTEXT,
			jttable_name TEXT,
			jttable_styles TEXT,
			PRIMARY KEY  (jttable_id) 
		) $charset_collate; ";
	
		dbDelta( $sql_create_table );
	}

}
