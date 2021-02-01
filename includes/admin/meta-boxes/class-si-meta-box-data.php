<?php
/**
 * Social Icon Data
 *
 * @class    SI_Meta_Box_Icon_Data
 * @version  1.7.4
 * @package  Social_Icons/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Meta_Box_Data Class
 */
class SI_Meta_Box_Data {
	/**
	 * Output the meta box.
	 * @param WP_Post $post
	 */
	public static function shortcode( $post ) {
		global $post;
		$shortcode = '[social_icons_group id="' . $post->ID . '"]';

		echo '<p>' . esc_html__( 'Copy and paste the shortcode on your post, page to render social icons.', 'social-icons' ) . '</p>';
		echo '<p><span class="shortcode"><input type="text" class="widefat code" onfocus="this.select();" readonly="readonly" value="' . esc_attr( $shortcode ) . '" /></span></p>';
	}
}
