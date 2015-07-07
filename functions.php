<?php
/**
 * WARNING: Please do not edit this file in any way
 * load the theme function files
 * Slightly Modified Options Framework
 */
 
 
 // Default RSS feed links
add_theme_support( 'automatic-feed-links' );

// Default custom header
add_theme_support( 'custom-header' );

// Default custom backgrounds
add_theme_support( 'custom-background' );

// Woocommerce Support
add_theme_support( 'woocommerce' );

// Allow shortcodes in widget text
add_filter('widget_text', 'do_shortcode');

// Default Title Tag
add_theme_support( 'title-tag' );
 
 
require_once ('admin/index.php');

if ( ! function_exists('bi_get_data') ) {
	function bi_get_data($id, $fallback = false) {
		global $smof_data;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset($smof_data[$id]) && $smof_data[$id] !== '' ) ? $smof_data[$id] : $fallback;
		return $output;
	}
}


require_once( get_template_directory() .'/functions/functions.php' );
require_once( get_template_directory() .'/functions/hooks.php' );
require_once( get_template_directory() .'/functions/function-extras.php' );
require_once( get_template_directory() .'/functions/custom-css.php' );
require_once( get_template_directory() .'/functions/tracking.php' );
require_once( get_template_directory() .'/functions/comments-layout.php' );

// Functions needed for admin
require_once( get_template_directory() .'/functions/post-types/post-type-helpers.php' );
require_once( get_template_directory() .'/functions/post-types/register-post-types.php' );
require_once( get_template_directory() .'/functions/post-types/register-taxonomies.php' );


/************* METABOX ****************/
// Re-define meta box path and URL
//define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/functions/meta-box' ) );
//define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/functions/meta-box' ) );
// Include the meta box script
//require_once RWMB_DIR . 'meta-box.php';
//require_once RWMB_DIR . 'setup.php';




/************* CUSTOM METABOX ****************/

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['test_metabox'] = array(
		'id'         => 'test_metabox',
		'title'      => __( 'Slider Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Enable Slider', 'cmb' ),
				'desc' => __( '<i>Tick Checkbox To Enable Slider On This Page</i>', 'cmb' ),
				'id'   => $prefix . 'enable_disable_slider',
				'type' => 'checkbox',
			),
		),
	);


	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'cmb/init.php';

}