<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://sohilchamadia8.wordpress.com/
 * @since      1.0.0
 *
 * @package    Get_Post_Data_Elementor_Addon
 * @subpackage Get_Post_Data_Elementor_Addon/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Get_Post_Data_Elementor_Addon
 * @subpackage Get_Post_Data_Elementor_Addon/includes
 * @author     Sohil Chamadia <sohilchamadia8@gmail.com>
 */
class Get_Post_Data_Elementor_Addon_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'get-post-data-elementor-addon',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
