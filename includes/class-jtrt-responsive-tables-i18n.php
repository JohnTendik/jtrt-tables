<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://johntendik.github.io
 * @since      1.0.0
 *
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jtrt_Responsive_Tables
 * @subpackage Jtrt_Responsive_Tables/includes
 * @author     John Tendik <johntendik@hotmail.com>
 */
class Jtrt_Responsive_Tables_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'jtrt-responsive-tables',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
