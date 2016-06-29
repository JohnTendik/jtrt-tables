<?php

/**
 * Fired during plugin deactivation
 *
 * @link       //
 * @since      1.0.0
 *
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/includes
 * @author     John Tendik <johntendik@hotmail.com>
 */
class Jtrt_Responsive_Tables_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		global $wpdb;
		global $charset_collate;
		$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
		$wpdb->query("DROP TABLE IF EXISTS $jtrt_tables_name");

	}

}
