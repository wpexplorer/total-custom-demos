<?php
// Your custom demos array
function total_custom_demos_array() {

	// Return array
	return array(


		// Demo 1
		// Make sure to change the slug "charlotte" to your demo slug (all lowercase and no spaces)
		'charlotte' => array(

			// Demo name
			'name' => 'Charlotte',

			// Slug
			'demo_slug' => 'charlotte', // Same as the Key above = IMPORTANT!!

			// Your preview URL
			// Requires the Total 3.6.1 update to work
			'demo_url' => 'YOUR DEMO URL',

			// Enter menu locations to auto set menus ( leave locations empty if they don't have a menu )
			'nav_menu_locations' => array(
				'main_menu'   => 'main',
				'footer_menu' => 'footer',
			),

			// Homepage slug ( remove from array if you aren't using a static homepage for this demo homepage )
			'homepage_slug' => 'home',

			// Posts page slug ( remove from array if posts page is not defined )
			'page_for_posts' => 'blog',

			// Shop Slug ( remove from array if there isn't a shop )
			'shop_slug' => 'shop',

			// Plugins used for demo / use the same names as the plugin's name
			// Plugins must be a part of the array in the function located in the helpers/recommended-plugins.php file
			'plugins' => array(
				'Contact Form 7',
				'WPBakery Visual Composer',
				'Slider Revolution',
			),

		),


		// Demo 2 here...copy/paste and edit demo 1 (without all the commenting of course)
		// Example....
		'flat' => array(
			'name' => 'Flat',
			'demo_slug' => 'flat',
			'demo_url' => 'totaltheme.wpengine.com/flat/',
			'nav_menu_locations' => array(
				'main_menu'   => 'main',
				'footer_menu' => 'footer',
			),
			'homepage_slug' => 'home',
			'page_for_posts' => 'blog',
			'shop_slug' => 'shop',
			'plugins' => array(
				'Contact Form 7',
				'WPBakery Visual Composer',
				'Slider Revolution',
				'WooCommerce'
			),
		),


	);
}