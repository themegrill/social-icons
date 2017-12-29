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
		if ( empty( $atts ) ) {
			return '';
		}

		if ( ! isset( $atts['id'] ) ) {
			return '';
		}

		$atts = shortcode_atts( array(
			'id' => '',
		), $atts, 'social_icons_group' );

		$group_id = absint( $atts['id'] );

		// Check for Group ID
		if ( $group_id && 'social_icon' == get_post_type( $group_id ) ) {
			$group_data['background_style'] = get_post_meta( $group_id, 'background_style', true );
			$group_data['icon_font_size']   = get_post_meta( $group_id, 'icon_font_size', true );
			$group_data['icon_padding']     = get_post_meta( $group_id, 'icon_padding', true );
			$group_data['manage_label']     = get_post_meta( $group_id, '_manage_label', true );
			$group_data['greyscale_icons']  = get_post_meta( $group_id, '_greyscale_icons', true );
			$group_data['open_new_tab']     = get_post_meta( $group_id, '_open_new_tab', true );
			$group_data['sortable_icons']   = get_post_meta( $group_id, '_sortable_icons', true );

			// Output social icons.
			return self::social_icons_output( $group_data, $atts );
		}

		return false;
	}

	/**
	 * Output for social icons.
	 * @param  array $group_data
	 * @param  array $atts
	 * @return array
	 * @access private
	 */
	private static function social_icons_output( $group_data, $atts ) {
		$icon_class = false;
		$color_type = 'text';
		$class_list = array();

		// Label class.
		if ( 'yes' == $group_data['manage_label'] ) {
			$class_list[] = 'show-icons-label';
		}

		// Greyscale class.
		if ( 'yes' == $group_data['greyscale_icons'] ) {
			$icon_class   = '#555';
			$class_list[] = 'social-icons-greyscale';
		}

		// Background class.
		if ( $group_data['background_style'] ) {
			$class_list[] = 'icons-background-' . $group_data['background_style'];

			if ( 'none' !== $group_data['background_style'] ) {
				$color_type = 'background';
			}
		}

		// Custom icon padding and font size.
		$icon_padding   = empty( $group_data['icon_padding'] ) ? 10 : $group_data['icon_padding'];
		$icon_font_size = empty( $group_data['icon_font_size'] ) ? 16 : $group_data['icon_font_size'];

		ob_start();

		?><ul class="social-icons-lists <?php echo esc_attr( implode( ' ', $class_list ) ); ?>">

			<?php
			$count = 0;
			foreach ( $group_data['sortable_icons'] as $title => $field ) :

				$class      = str_replace( '_' . $count, '', $title );
				$icon_color = false !== $icon_class ? $icon_class : get_socicon( $class );
				$background = 'text' !== $color_type ? 'background-color: ' . $icon_color : 'color: ' . $icon_color; ?>

				<li class="social-icons-list-item">
					<a href="<?php echo esc_url( $field['url'] ); ?>" <?php echo ( 'yes' == $group_data['open_new_tab'] ? 'target="_blank"' : '' ); ?> class="social-icon">
						<span class="socicon socicon-<?php echo esc_attr( $class ); ?>" style="padding: <?php echo esc_attr( $icon_padding ); ?>px; font-size: <?php echo esc_attr( $icon_font_size ); ?>px; <?php echo esc_attr( $background ); ?>"></span>

						<?php if ( 'yes' == $group_data['manage_label'] ) : ?>
							<span class="social-icons-list-label"><?php echo esc_html( $field['label'] ); ?></span>
						<?php endif; ?>
					</a>
				</li>

			<?php
			$count++;
			endforeach; ?>

		</ul><?php

		return ob_get_clean();
	}
}
