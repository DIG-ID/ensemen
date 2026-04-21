<?php
/**
 * Theme setup: theme supports, nav menus, sidebars, and plugin integrations.
 */

/**
 * Registers nav menus and theme supports.
 */
function digid_theme_setup() {

	register_nav_menus(
		array(
			'main-menu'      => __( 'Main Menu', 'digid' ),
			'secondary-menu' => __( 'Secondary Menu', 'digid' ),
			'footer-menu'    => __( 'Footer Menu', 'digid' ),
		)
	);

	add_theme_support( 'menus' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' )
	);
}

add_action( 'after_setup_theme', 'digid_theme_setup' );

/**
 * Registers widgetized areas.
 */
function digid_register_sidebars() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'digid' ),
			'id'            => 'footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Header Language Switcher', 'digid' ),
			'id'            => 'header_ls',
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		)
	);
}

add_action( 'widgets_init', 'digid_register_sidebars' );

/**
 * Removes auto <p> wrapping from Contact Form 7 fields.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

if ( ! function_exists( 'digid_acf_google_maps_key' ) ) :
	/**
	 * Sets the Google Maps API key for ACF map fields.
	 * Requires DIGID_GOOGLE_MAPS_API_KEY to be set in functions.php.
	 */
	function digid_acf_google_maps_key() {
		if ( defined( 'DIGID_GOOGLE_MAPS_API_KEY' ) && DIGID_GOOGLE_MAPS_API_KEY ) {
			acf_update_setting( 'google_api_key', DIGID_GOOGLE_MAPS_API_KEY );
		}
	}
endif;

add_action( 'acf/init', 'digid_acf_google_maps_key' );

/**
 * Lowers Yoast SEO metabox priority so ACF fields appear above it.
 *
 * @return string
 */
function digid_lower_yoast_metabox_priority() {
	return 'core';
}

add_filter( 'wpseo_metabox_prio', 'digid_lower_yoast_metabox_priority' );
