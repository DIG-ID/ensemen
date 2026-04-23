<?php
/**
 * Theme functions and definitions.
 *
 * @package ensemen
 */

// Font provider configuration — set per project.
// Options: 'google' | 'adobe' | 'none'
define( 'ensemen_FONT_PROVIDER', 'adobe' );
define( 'ensemen_GOOGLE_FONTS_URL', '' );
define( 'ensemen_ADOBE_FONTS_ID', 'byf0piz' ); // Typekit kit ID


// Google Maps API key — set per project. Leave empty to disable.
define( 'ensemen_GOOGLE_MAPS_API_KEY', '' );

// Theme setup: supports, nav menus, sidebars, plugin filters.
require get_template_directory() . '/inc/theme-setup.php';

// Scripts and styles.
require get_template_directory() . '/inc/enqueue.php';

// Admin and login customisations.
require get_template_directory() . '/inc/theme-admin-settings.php';

// Template tags and reusable output functions.
require get_template_directory() . '/inc/theme-template-tags.php';

// Helper/utility functions.
require get_template_directory() . '/inc/helpers.php';

// Performance optimizations.
require get_template_directory() . '/inc/performance.php';
