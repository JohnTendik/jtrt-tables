<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://johntendik.github.io
 * @since      1.0.0
 *
 * @package    Jtrt_Responsive_Tables
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
global $wpdb;
global $charset_collate;
$jtrt_tables_name = $wpdb->prefix . "jtrt_tables";
$posts_table = $wpdb->posts;
$wpdb->query("DROP TABLE IF EXISTS $jtrt_tables_name");
$wpdb->query( "DELETE FROM ".$posts_table." WHERE post_type IN ( 'jtrt_tables_post' );" );
$wpdb->query( "DELETE meta FROM {$wpdb->postmeta} meta LEFT JOIN {$wpdb->posts} posts ON posts.ID = meta.post_id WHERE posts.ID IS NULL;" );