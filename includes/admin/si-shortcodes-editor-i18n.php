<?php
/**
 * TinyMCE i18n
 *
 * @package  Social_Icons/i18n
 * @category i18n
 * @author   ThemeGrill
 * @version  1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '_WP_Editors' ) ) {
	require( ABSPATH . WPINC . '/class-wp-editor.php' );
}

if ( ! function_exists( 'social_icons_tinymce_plugin_translation' ) ) :

/**
 * TinyMCE Plugin Translation.
 * @return string $translated TinyMCE language strings.
 */
function social_icons_tinymce_plugin_translation() {

	// Default TinyMCE strings.
	$mce_translation = array(
		'id'               => __( 'Group ID', 'social_icons' ),
		'shortcode_title'  => __( 'Insert Social Icons', 'social_icons' ),
		'require_group_id' => __( 'You need enter with a Group ID!', 'social_icons' )
	);

	/**
	 * Filter translated strings prepared for TinyMCE.
	 * @param array $mce_translation Key/value pairs of strings.
	 * @since 1.4.0
	 */
	$mce_translation = apply_filters( 'social_icons_mce_translations', $mce_translation );

	$mce_locale = _WP_Editors::$mce_locale;
	$translated = 'tinyMCE.addI18n("' . $mce_locale . '.social_icons_shortcodes", ' . json_encode( $mce_translation ) . ");\n";

	return $translated;
}

endif;

$strings = social_icons_tinymce_plugin_translation();
