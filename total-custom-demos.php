<?php
/*
Plugin Name: Total - Custom Demos
Description: Custom demos for the Total WordPress Theme.
Version: 1.0.0
Author: AJ Clarke
Author URI: http://www.wpexplorer.com/ 
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Custom demo importer class
class Total_Custom_Demos {

	/**
	 * Start things up
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Delete transient so you can see your demos and not Total's if user has already viewed demos page
		delete_transient( 'wpex_demos_data' );

		// Alter demos remote url
		add_filter( 'wpex_get_demos_remote_url', array( 'Total_Custom_Demos', 'remote_url' ) );

		// Returns json data based on your defined array
		add_action( 'init', array( 'Total_Custom_Demos', 'json_data' ), 0 );

	}

	/**
	 * Alters the default remote URL
	 *
	 * @since 1.0.0
	 */
	public static function remote_url() {
		return esc_url( home_url( '/?action=get_total_demos' ) );
	}

	/**
	 * Filter the Total metabox
	 *
	 * @since 1.0.0
	 */
	public static function json_data() {

		// Define directory paths/urls
		$dir_path       = plugin_dir_path( __FILE__ );
		$demos_dir_path = $dir_path .'demos/';
		$demos_dir_url  = plugin_dir_url( __FILE__ ) .'demos/';

		// Include custom functions
		require_once( $dir_path .'helpers/demos-array.php' );
		require_once( $dir_path .'helpers/recommended-plugins.php' );

		// Check current action
		if ( empty( $_GET['action'] ) || 'get_total_demos' != $_GET['action'] ) {
			return;
		}

		// Declare json array
		$json_array = array(
			'theme'      => 'Total',
			'categories' => array(),
			'plugins'    => total_custom_demos_recommended_plugins_list() ,
		);

		// Get and sanitize custom demos array
		$demos_array = total_custom_demos_array();

		// Loop through demos and add xml, theme options, widgets, sliders
		foreach ( $demos_array as $demo_id => $demo_data ) {

			// Add screenshot
			$demos_array[$demo_id]['screenshot'] = $demos_dir_url . $demo_id .'/screenshot.jpg';

			// Add xml file
			$demos_array[$demo_id]['xml'] = $demos_dir_url . $demo_id .'/sample-data.xml';

			// Add theme options
			$demos_array[$demo_id]['theme_mods'] = $demos_dir_url . $demo_id .'/theme-options.txt';

			// Add widgets
			if ( file_exists( $demos_dir_path . $demo_id .'/widgets.txt' ) ) {
				$demos_array[$demo_id]['widgets'] = $demos_dir_url . $demo_id .'/widgets.txt';
			}

			// Add sliders
			$sliders_dir = $demos_dir_path . $demo_id .'/revolution-sliders/';
			if ( file_exists( $sliders_dir ) && is_dir( $sliders_dir ) ) {
				
				// Add sliders array
				$demos_array[$demo_id]['sliders'] = array();

				// Loop through zips in revolution-sliders directory and add to array
				$slider_zips = glob( $sliders_dir .'*.zip' );
				foreach ( $slider_zips as $file ) {
					$key = str_replace( '.zip', '', basename( $file ) );
					$demos_array[$demo_id]['sliders'][$key] = $demos_dir_url . $demo_id .'/revolution-sliders/'. $key .'.zip';
				}

			}

		}

		// Add demos to array
		$json_array['demos'] = $demos_array;

		// For testing
		//print_r( $json_array ); return;

		// Encode array into json and echo
		echo json_encode( $json_array );

		// Exit
		exit;

	}

}
new Total_Custom_Demos;