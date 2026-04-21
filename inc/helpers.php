<?php
/**
 * General-purpose helper functions.
 */

/**
 * Outputs one or more values to the browser console.
 * For development/debugging only — remove calls before going to production.
 *
 * @param mixed ...$data Values to log.
 */
function digid_console_log( ...$data ) {
	$json = wp_json_encode( $data );
	add_action(
		'shutdown',
		function () use ( $json ) {
			echo "<script>console.log({$json})</script>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	);
}
