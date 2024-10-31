<?php
/*
 * Plugin Name: Range Slider Addon for ACF
 * Plugin URI:  https://wordpress.org/plugins/range-slider-addon-for-acf/
 * Description: This plugin provides an option in the backend to add a number range slider as an ACF field. It allow to set range by selecting min and max number.
 * Version:     1.2
 * Author:      Galaxy Weblinks
 * Author URI:  http://www.galaxyweblinks.com
 * Text Domain: rangeslideraddon
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) {
  exit; // disable direct access
}

/**
 * Add backend option for number range slider in field type "range slider" in ACF.
 * @param array $field
 * @return void
 */
class gwlrs_range_slider_plugin {

	// Construct
	function __construct() {

	// Legacy Version
	add_action('acf/register_fields', array($this, 'register_fields'));

	// Stable Version
	add_action('acf/include_field_types', array($this, 'include_field_types_range') );
	}

	//Legacy Version
	function register_fields() {
		include_once('includes/legacy.php');
	}

	//Stable Version
	function include_field_types_range() {
		include_once('includes/stable.php');
	}

}

new gwlrs_range_slider_plugin();

?>