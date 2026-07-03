<?php
/**
 * Security hardening: REST API user enumeration, author archives, login errors, security headers.
 *
 * @package ensemen
 */

/**
 * Restricts the REST API users endpoints to authenticated users.
 *
 * Prevents public user enumeration via /wp-json/wp/v2/users, which exposes
 * usernames (and potentially login e-mails) to brute-force attacks.
 *
 * @param array $endpoints Registered REST API endpoints.
 * @return array
 */
function ensemen_restrict_rest_user_endpoints( $endpoints ) {
	if ( ! is_user_logged_in() ) {
		unset( $endpoints['/wp/v2/users'] );
		unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	}
	return $endpoints;
}

add_filter( 'rest_endpoints', 'ensemen_restrict_rest_user_endpoints' );

/**
 * Blocks user enumeration via ?author=N query strings.
 *
 * Runs on init, before canonical redirects can expose the author slug.
 */
function ensemen_block_author_query_enumeration() {
	if ( is_admin() || is_user_logged_in() ) {
		return;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only check, no data is processed.
	if ( isset( $_GET['author'] ) ) {
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
}

add_action( 'init', 'ensemen_block_author_query_enumeration' );

/**
 * Redirects author archives to the homepage for unauthenticated visitors.
 *
 * Runs at priority 0 so it fires before redirect_canonical(), which would
 * otherwise redirect ?author=N to the pretty permalink revealing the username.
 */
function ensemen_block_author_archives() {
	if ( is_author() && ! is_user_logged_in() ) {
		wp_safe_redirect( home_url(), 301 );
		exit;
	}
}

add_action( 'template_redirect', 'ensemen_block_author_archives', 0 );

/**
 * Replaces detailed login error messages with a generic one.
 *
 * Prevents confirming whether a username exists on the site.
 *
 * @return string
 */
function ensemen_generic_login_error() {
	return __( 'Invalid credentials.', 'digid' );
}

add_filter( 'login_errors', 'ensemen_generic_login_error' );

// XML-RPC blocking and WordPress version hiding are handled by the
// Security Optimizer plugin (Site Security settings) — not duplicated here.

/**
 * Sends standard security headers on frontend responses.
 *
 * Note: these only cover pages rendered by WordPress. Static assets served
 * directly by the web server should get the same headers via Nginx config.
 */
function ensemen_send_security_headers() {
	if ( headers_sent() ) {
		return;
	}

	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
	// Minimal CSP: clickjacking protection only. A full CSP must be built at
	// server level after auditing all script/style sources (Stripe, Maps, etc.).
	header( "Content-Security-Policy: frame-ancestors 'self'" );

	if ( is_ssl() ) {
		header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains' );
	}
}

add_action( 'send_headers', 'ensemen_send_security_headers' );
