<?php
/**
 * Customise the WordPress admin and login pages.
 */

/**
 * Removes default dashboard widgets to keep the admin clean.
 */
function ensemen_disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );
}

add_action( 'wp_dashboard_setup', 'ensemen_disable_default_dashboard_widgets', 999 );

/**
 * Enqueues the custom login page stylesheet.
 */
function ensemen_login_css() {
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'admin-login-css', get_theme_file_uri( '/dist/css/admin-login.css' ), array(), $theme_version );
}

add_action( 'login_enqueue_scripts', 'ensemen_login_css', 10 );

/**
 * Changes the login logo link to point to the site homepage.
 *
 * @return string
 */
function ensemen_login_url() {
	return home_url();
}

add_filter( 'login_headerurl', 'ensemen_login_url' );

/**
 * Changes the login logo alt text to the site name.
 *
 * @return string
 */
function ensemen_login_title() {
	return get_option( 'blogname' );
}

add_filter( 'login_headertext', 'ensemen_login_title' );

/**
 * Outputs the custom logo image on the login page via inline CSS.
 */
function ensemen_login_logo() {
	echo '<style type="text/css">
	h1 a {
		background-image: url(' . esc_url( get_template_directory_uri() ) . '/assets/svg/logo.svg) !important;
		background-size: contain !important;
		background-position: center !important;
		background-repeat: no-repeat !important;
		width: 400px !important;
		height: 140px !important;
	}
	</style>';
}

add_action( 'login_head', 'ensemen_login_logo' );

/**
 * Replaces the admin footer text with the agency credit.
 */
function ensemen_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Developed by <a href="https://dig.id" target="_blank">dig.id</a></span>.', 'ensemen' );
}

add_filter( 'admin_footer_text', 'ensemen_custom_admin_footer' );

/**
 * Removes the WordPress logo from the admin toolbar.
 *
 * @param WP_Admin_Bar $wp_admin_bar Admin bar instance.
 */
function ensemen_remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}

add_action( 'admin_bar_menu', 'ensemen_remove_wp_logo', 999 );

/**
 * Allows SVG uploads for administrator and editor users.
 *
 * @param array $upload_mimes Allowed mime types.
 * @return array
 */
add_filter(
	'upload_mimes',
	function ( $upload_mimes ) {
		if ( ! current_user_can( 'administrator' ) || ! current_user_can( 'editor' ) ) {
			return $upload_mimes;
		}

		$upload_mimes['svg']  = 'image/svg+xml';
		$upload_mimes['svgz'] = 'image/svg+xml';

		return $upload_mimes;
	}
);

/**
 * Fixes SVG mime type detection on upload.
 *
 * @param array        $wp_check_filetype_and_ext Filetype check result.
 * @param string       $file                      Full path to the file.
 * @param string       $filename                  The file name.
 * @param string[]     $mimes                     Allowed mime types.
 * @param string|false $real_mime                 Detected mime type.
 * @return array
 */
add_filter(
	'wp_check_filetype_and_ext',
	function ( $wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime ) {

		if ( ! $wp_check_filetype_and_ext['type'] ) {
			$check_filetype  = wp_check_filetype( $filename, $mimes );
			$ext             = $check_filetype['ext'];
			$type            = $check_filetype['type'];
			$proper_filename = $filename;

			if ( $type && str_starts_with( $type, 'image/' ) && 'svg' !== $ext ) {
				$ext  = false;
				$type = false;
			}

			$wp_check_filetype_and_ext = compact( 'ext', 'type', 'proper_filename' );
		}

		return $wp_check_filetype_and_ext;
	},
	10,
	5
);

// Disable comments completely.
add_action(
	'admin_init',
	function () {
		global $pagenow;

		if ( 'edit-comments.php' === $pagenow ) {
			wp_safe_redirect( admin_url() );
			exit;
		}

		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

		foreach ( get_post_types() as $post_type ) {
			if ( post_type_supports( $post_type, 'comments' ) ) {
				remove_post_type_support( $post_type, 'comments' );
				remove_post_type_support( $post_type, 'trackbacks' );
			}
		}
	}
);

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );
add_filter( 'comments_array', '__return_empty_array', 10, 2 );

add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
	}
);

add_action(
	'init',
	function () {
		if ( is_admin_bar_showing() ) {
			remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		}
	}
);

// Register ACF Options pages for theme-wide settings (logo, header, socials, etc.).
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => __( 'Theme Settings', 'ensemen' ),
			'menu_title' => __( 'Theme Settings', 'ensemen' ),
			'menu_slug'  => 'theme-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
			'icon_url'   => 'dashicons-admin-generic',
			'position'   => 2,
		)
	);
}

// Redirect attachment pages to the parent post or homepage.
add_action(
	'template_redirect',
	function () {
		global $post;
		if ( ! is_attachment() || ! isset( $post->post_parent ) || ! is_numeric( $post->post_parent ) ) {
			return;
		}

		if ( 0 !== $post->post_parent && 'trash' !== get_post_status( $post->post_parent ) ) {
			wp_safe_redirect( get_permalink( $post->post_parent ), 301 );
		} else {
			wp_safe_redirect( get_bloginfo( 'wpurl' ), 302 );
		}
		exit;
	},
	1
);
