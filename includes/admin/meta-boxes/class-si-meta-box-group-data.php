<?php
/**
 * Social Icon Data
 *
 * @class    SI_Meta_Box_Icon_Data
 * @version  1.4.0
 * @package  Social_Icons/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Meta_Box_Group_Data Class
 */
class SI_Meta_Box_Group_Data {

	/**
	 * Output the meta box.
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		global $post, $thepostid;

		wp_nonce_field( 'social_icons_save_data', 'social_icons_meta_nonce' );

		$thepostid = $post->ID;

		?>
		<style type="text/css">
			#edit-slug-box, #minor-publishing-actions { display:none }
		</style>
		<div id="group_options" class="panel-wrap group_data">
			<ul class="group_data_tabs si-tabs">
				<?php
					$group_data_tabs = apply_filters( 'social_icons_group_data_tabs', array(
						'general' => array(
							'label'  => __( 'General', 'social-icons' ),
							'target' => 'general_group_data',
							'class'  => 'general_group_data',
						),
						'grouping' => array(
							'label'  => __( 'Grouping', 'social-icons' ),
							'target' => 'grouping_group_data',
							'class'  => 'grouping_group_data',
						)
					) );

					foreach ( $group_data_tabs as $key => $tab ) {
						?><li class="<?php echo $key; ?>_options <?php echo $key; ?>_tab <?php echo implode( ' ', (array) $tab['class'] ); ?>">
							<a href="#<?php echo $tab['target']; ?>"><?php echo esc_html( $tab['label'] ); ?></a>
						</li><?php
					}

					do_action( 'social_icons_group_write_panel_tabs' );
				?>
			</ul>
			<div id="general_group_data" class="panel social_icons_options_panel hidden"><?php

				echo '<div class="options_group">';

					// Background Style
					social_icons_wp_select( array(
						'id'    => 'background_style',
						'label' => __( 'Background Style', 'social-icons' ),
						'options' => array(
							'none'           => __( 'None', 'social-icons' ),
							'square'         => __( 'Square', 'social-icons' ),
							'rounded'        => __( 'Rounded', 'social-icons' ),
							'square centre'  => __( 'Square Centre', 'social-icons' ),
							'rounded centre' => __( 'Rounded Centre', 'social-icons' ),
						),
						'desc_tip'    => 'true',
						'description' => __( 'Define whether or not the entire background should be style based, or just with the default style.', 'social-icons' )
					) );

					// Choose Icon size
					social_icons_wp_text_input( array( 'id' => 'icon_font_size',  'label' => __( 'Choose Icon Size', 'social-icons' ), 'placeholder' => __( 'Default', 'social-icons' ), 'desc_tip' => true, 'description' => __( 'Leave blank for default icon font size.', 'social-icons' ), 'type' => 'number', 'custom_attributes' => array(
						'step' => '1',
						'min'  => '14',
						'max'  => '40'
					) ) );

				echo '</div>';

				echo '<div class="options_group">';

					// Manage Label
					social_icons_wp_checkbox( array( 'id' => '_manage_label', 'label' => __( 'Manage Label', 'social-icons' ), 'description' => __( 'Enable this to display social icons label.', 'social-icons' ) ) );

					// Greyscale Icon
					social_icons_wp_checkbox( array( 'id' => '_greyscale_icons', 'label' => __( 'Greyscale Icon', 'social-icons' ), 'description' => __( 'Enable this to allow greyscale social icons.', 'social-icons' ) ) );

					// Open in New tab
					social_icons_wp_checkbox( array( 'id' => '_open_new_tab', 'label' => __( 'Open New Tab', 'social-icons' ), 'description' => __( 'Enable this to allow links to open in new tab.', 'social-icons' ) ) );

				echo '</div>';

				do_action( 'social_icons_group_options_general' );

			?></div>
			<div id="grouping_group_data" class="panel social_icons_options_panel hidden"><?php


			?></div>
			<?php do_action( 'social_icons_group_data_panels' ); ?>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Save meta box data.
	 * @param int $post_id
	 */
	public static function save( $post_id ) {
		// Add/replace data to array
		$background_style = si_clean( $_POST['background_style'] );
		$icon_font_size   = si_clean( $_POST['icon_font_size'] );

		echo '<pre>' . print_r( $icon_font_size, true ) . '</pre>';

		// Save
		update_post_meta( $post_id, 'background_style', $background_style );
		update_post_meta( $post_id, 'icon_font_size', $icon_font_size );

		do_action( 'social_icons_group_options_save', $post_id );
	}
}
