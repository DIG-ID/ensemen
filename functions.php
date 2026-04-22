<?php
/**
 * Theme functions and definitions.
 *
 * @package ensemen
 */

// Font provider configuration — set per project.
// Options: 'google' | 'adobe' | 'none'
define( 'ensemen_FONT_PROVIDER', 'google' );
define( 'ensemen_GOOGLE_FONTS_URL', 'https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,700;1,6..96,400&family=Open+Sans:wght@300;400;600;700&display=swap' );
define( 'ensemen_ADOBE_FONTS_ID', '' ); // Typekit kit ID, e.g. 'abc1234'


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
