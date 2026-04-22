<?php
/**
 * Enqueue scripts and styles.
 */

if ( ! function_exists( 'ensemen_enqueue_fonts' ) ) :
	/**
	 * Enqueues web fonts based on the provider configured in functions.php.
	 * Supports 'google', 'adobe' (Typekit), or 'none'.
	 */
	function ensemen_enqueue_fonts() {
		$provider = defined( 'ensemen_FONT_PROVIDER' ) ? ensemen_FONT_PROVIDER : 'none';

		if ( 'google' === $provider && defined( 'ensemen_GOOGLE_FONTS_URL' ) && ensemen_GOOGLE_FONTS_URL ) {
			wp_enqueue_style(
				'ensemen-fonts',
				ensemen_GOOGLE_FONTS_URL,
				array(),
				null
			);
		}

		if ( 'adobe' === $provider && defined( 'ensemen_ADOBE_FONTS_ID' ) && ensemen_ADOBE_FONTS_ID ) {
			wp_enqueue_style(
				'ensemen-fonts',
				'https://use.typekit.net/' . ensemen_ADOBE_FONTS_ID . '.css',
				array(),
				null
			);
		}
	}
endif;

add_action( 'wp_enqueue_scripts', 'ensemen_enqueue_fonts' );

if ( ! function_exists( 'ensemen_font_resource_hints' ) ) :
	/**
	 * Adds preconnect resource hints for the configured font provider
	 * via the native WordPress resource hints API.
	 *
	 * @param array  $urls          Resource hint URLs.
	 * @param string $relation_type Hint type (preconnect, dns-prefetch, etc.).
	 * @return array
	 */
	function ensemen_font_resource_hints( $urls, $relation_type ) {
		if ( 'preconnect' !== $relation_type ) {
			return $urls;
		}

		$provider = defined( 'ensemen_FONT_PROVIDER' ) ? ensemen_FONT_PROVIDER : 'none';

		if ( 'google' === $provider ) {
			$urls[] = 'https://fonts.googleapis.com';
			$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'crossorigin' );
		}

		if ( 'adobe' === $provider ) {
			$urls[] = array( 'href' => 'https://use.typekit.net', 'crossorigin' => 'crossorigin' );
		}

		return $urls;
	}
endif;

add_filter( 'wp_resource_hints', 'ensemen_font_resource_hints', 10, 2 );

if ( ! function_exists( 'ensemen_enqueue_google_maps' ) ) :
	/**
	 * Enqueues Google Maps API and init script on specific page templates.
	 * Requires ensemen_GOOGLE_MAPS_API_KEY to be set in functions.php.
	 * Add page templates to $templates as needed per project.
	 */
	function ensemen_enqueue_google_maps() {
		if ( ! defined( 'ensemen_GOOGLE_MAPS_API_KEY' ) || ! ensemen_GOOGLE_MAPS_API_KEY ) {
			return;
		}

		$templates = array(
			// 'page-templates/page-contact.php',
		);

		if ( empty( $templates ) || ! is_page_template( $templates ) ) {
			return;
		}

		$theme_version = wp_get_theme()->get( 'Version' );

		wp_enqueue_script(
			'ensemen-google-maps-init',
			get_theme_file_uri( '/assets/js/google-maps.js' ),
			array(),
			$theme_version,
			true
		);

		wp_enqueue_script(
			'ensemen-google-maps-api',
			add_query_arg(
				array(
					'key'      => ensemen_GOOGLE_MAPS_API_KEY,
					'callback' => 'initMap',
					'loading'  => 'async',
				),
				'https://maps.googleapis.com/maps/api/js'
			),
			array( 'ensemen-google-maps-init' ),
			null,
			true
		);
	}
endif;

add_action( 'wp_enqueue_scripts', 'ensemen_enqueue_google_maps' );

/**
 * Registers and enqueues the theme's main CSS and JS.
 */
function ensemen_enqueue_assets() {

	// Remove Gutenberg block styles if not using the block editor on the frontend.
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-blocks-style' );
	wp_dequeue_style( 'global-styles' );

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	// Enqueue theme stylesheet.
	wp_enqueue_style(
		'theme-styles',
		get_theme_file_uri( '/dist/css/main.css' ),
		array(),
		$theme_version
	);

	wp_enqueue_script(
		'theme-scripts',
		get_theme_file_uri( '/dist/js/main.js' ),
		array( 'jquery' ),
		$theme_version,
		true
	);
}

add_action( 'wp_enqueue_scripts', 'ensemen_enqueue_assets' );
