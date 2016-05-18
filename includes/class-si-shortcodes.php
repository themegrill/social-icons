<?php
/**
 * Social Icons Shortcodes.
 *
 * @class    SI_Shortcodes
 * @version  1.4.0
 * @package  Social_Icons/Classes
 * @category Class
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * RP_Shortcodes Class
 */
class SI_Shortcodes {

	/**
	 * Init Shortcodes.
	 */
	public static function init() {
		$shortcodes = array(
			'social_icons_group' => __CLASS__ . '::group',
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
		}
	}

	/**
	 * Social Icons group shortcode.
	 */
	public static function group( $atts ) {

	}
}
