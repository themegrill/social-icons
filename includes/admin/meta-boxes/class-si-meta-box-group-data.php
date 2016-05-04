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


				echo '</div>';

				echo '<div class="options_group">';


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

		do_action( 'social_icons_group_options_save', $post_id );
	}
}
