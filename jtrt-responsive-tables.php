<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://johntendik.github.io
 * @since             1.0.0
 * @package           Jtrt_Responsive_Tables
 *
 * @wordpress-plugin
 * Plugin Name:       JTRT Responsive Tables
 * Plugin URI:        https://wordpress.org/plugins/jtrt-responsive-tables/
 * Description:       The most advanced table editor for wordpress.
 * Version:           4.1
 * Author:            John Tendik
 * Author URI:        https://github.com/mythirdeye/jtrt-tables
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jtrt-responsive-tables
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jtrt-responsive-tables-activator.php
 */
function activate_jtrt_responsive_tables() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jtrt-responsive-tables-activator.php';
	Jtrt_Responsive_Tables_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jtrt-responsive-tables-deactivator.php
 */
function deactivate_jtrt_responsive_tables() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jtrt-responsive-tables-deactivator.php';
	Jtrt_Responsive_Tables_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jtrt_responsive_tables' );
register_deactivation_hook( __FILE__, 'deactivate_jtrt_responsive_tables' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jtrt-responsive-tables.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jtrt_responsive_tables() {

	$plugin = new Jtrt_Responsive_Tables();
	$plugin->run();

}
run_jtrt_responsive_tables();
