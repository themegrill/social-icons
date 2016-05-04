<?php
/**
 * Social Icons Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Social_Icons/Functions
 * @version  1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Clean variables using sanitize_text_field
 * @param  string|array $var
 * @return string
 */
function si_clean( $var ) {
	return is_array( $var ) ? array_map( 'si_clean', $var ) : sanitize_text_field( $var );
}

/**
 * Sanitize a string destined to be a tooltip.
 *
 * @since  1.4.0  Tooltips are encoded with htmlspecialchars to prevent XSS. Should not be used in conjunction with esc_attr()
 * @param  string $var
 * @return string
 */
function si_sanitize_tooltip( $var ) {
	return htmlspecialchars( wp_kses( html_entity_decode( $var ), array(
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'small'  => array(),
		'span'   => array(),
		'ul'     => array(),
		'li'     => array(),
		'ol'     => array(),
		'p'      => array(),
	) ) );
}

/**
 * Get all Social Icons screen ids.
 * @return array
 */
function si_get_screen_ids() {
	return apply_filters( 'social_sharing_screen_ids', array( 'edit-social_icon', 'social_icon' ) );
}

/**
 * Queue some JavaScript code to be output in the footer.
 * @param string $code
 */
function si_enqueue_js( $code ) {
	global $si_queued_js;

	if ( empty( $si_queued_js ) ) {
		$si_queued_js = '';
	}

	$si_queued_js .= "\n" . $code . "\n";
}

/**
 * Output any queued javascript code in the footer.
 */
function si_print_js() {
	global $si_queued_js;

	if ( ! empty( $si_queued_js ) ) {

		echo "<!-- Social Icons JavaScript -->\n<script type=\"text/javascript\">\njQuery(function($) {";

		// Sanitize
		$si_queued_js = wp_check_invalid_utf8( $si_queued_js );
		$si_queued_js = preg_replace( '/&#(x)?0*(?(1)27|39);?/i', "'", $si_queued_js );
		$si_queued_js = str_replace( "\r", '', $si_queued_js );

		echo $si_queued_js . "});\n</script>\n";

		unset( $si_queued_js );
	}
}

/**
 * Checks whether the content passed contains a specific short code.
 *
 * @param  string $tag Shortcode tag to check.
 * @return bool
 */
function si_post_content_has_shortcode( $tag = '' ) {
	global $post;

	return is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, $tag );
}

/**
 * Display a Social Icons help tip.
 *
 * @param  string $tip Help tip text
 * @param  bool   $allow_html Allow sanitized HTML if true or escape
 * @return string
 */
function si_help_tip( $tip, $allow_html = false ) {
	if ( $allow_html ) {
		$tip = si_sanitize_tooltip( $tip );
	} else {
		$tip = esc_attr( $tip );
	}

	return '<span class="social-icons-help-tip" data-tip="' . $tip . '"></span>';
}
