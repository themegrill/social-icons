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
						'linked_icons' => array(
							'label'  => __( 'Linked Icons', 'social-icons' ),
							'target' => 'linked_group_data',
							'class'  => 'linked_group_data',
						),
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
						'description' => __( 'Define whether or not the entire background should be style based, or just with the default style.', 'social-icons' ),
					) );

					// Choose Icon size
					social_icons_wp_text_input( array(
						'id'          => 'icon_font_size',
						'label'       => __( 'Choose Icon Size', 'social-icons' ),
						'placeholder' => __( 'Default', 'social-icons' ),
						'desc_tip'    => true,
						'description' => __( 'Leave blank for default icon font size.', 'social-icons' ),
						'type'        => 'number',
						'custom_attributes' => array(
							'step' => '1',
							'min'  => '14',
							'max'  => '40',
						),
					) );

					// Choose Icon Padding
					social_icons_wp_text_input( array(
						'id'          => 'icon_padding',
						'label'       => __( 'Choose Icon Padding', 'social-icons' ),
						'placeholder' => __( 'Default', 'social-icons' ),
						'desc_tip'    => true,
						'description' => __( 'Leave blank for default icon font size.', 'social-icons' ),
						'type'        => 'number',
						'custom_attributes' => array(
							'step' => '1',
							'min'  => '10',
							'max'  => '80',
						),
					) );

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
			<div id="linked_group_data" class="panel social_icons_options_panel hidden"><?php

				echo '<div class="options_group">';

				?>
				<div class="form-field sortable_icons">
					<label><?php _e( 'Sortable Icons', 'social-icons' ); ?></label>
					<table class="widefat">
						<thead>
							<tr>
								<th class="sort">&nbsp;</th>
								<th><?php _e( 'Label', 'social-icons' ); ?> <?php echo si_help_tip( __( 'This is the label of the social icon shown to the users.', 'social-icons' ) ); ?></th>
								<th colspan="2"><?php _e( 'Social URL', 'social-icons' ); ?> <?php echo si_help_tip( __( 'This is the URL to the social media which users will surf.', 'social-icons' ) ); ?></th>
							</tr>
						</thead>
						<tbody><?php
							if ( metadata_exists( 'post', $post->ID, '_sortable_icons' ) ) {
								$sortable_icons = get_post_meta( $post->ID, '_sortable_icons', true );
							} else {
								$sortable_icons = si_get_default_sortable_socicons();
							}

							if ( $sortable_icons ) {
								foreach ( $sortable_icons as $name => $icon ) {
									$name = 'socicon-' . strstr( $name, '_', true );
									include( 'views/html-group-social-icon.php' );
								}
							} else {
								printf( '<tr class="no-items"><td colspan="5"><p>%s</p></td></tr>', esc_html( 'No sortable icons found.', 'social-icons' ) );
							}
						?></tbody>
						<tfoot>
							<tr>
								<th colspan="5">
									<a href="#" class="button insert" data-row="<?php
										$name = 'dashicons-plus';
										$icon = array(
											'label' => '',
											'url'   => '',
										);
										ob_start();
										include( 'views/html-group-social-icon.php' );
										echo esc_attr( ob_get_clean() );
									?>"><?php _e( 'Add Icon', 'social-icons' ); ?></a>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<?php

				echo '</div>';

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
		$manage_label     = isset( $_POST['_manage_label'] ) ? 'yes' : 'no';
		$greyscale_icons  = isset( $_POST['_greyscale_icons'] ) ? 'yes' : 'no';
		$open_new_tab     = isset( $_POST['_open_new_tab'] ) ? 'yes' : 'no';

		// Sortable Icons.
		$sortable_icons = array();

		if ( isset( $_POST['_si_icon_urls'] ) ) {
			$icon_labels   = isset( $_POST['_si_icon_labels'] ) ? $_POST['_si_icon_labels'] : array();
			$icon_urls     = isset( $_POST['_si_icon_urls'] )  ? wp_unslash( array_map( 'trim', $_POST['_si_icon_urls'] ) ) : array();
			$icon_url_size = sizeof( $icon_urls );
			$allowed_icons = si_get_allowed_socicons();

			for ( $i = 0; $i < $icon_url_size; $i ++ ) {
				if ( ! empty( $icon_urls[ $i ] ) ) {
					$icon_url   = esc_url_raw( $icon_urls[ $i ] );
					$icon_name  = si_get_social_icon_name( $icon_url );
					$icon_label = si_clean( $icon_labels[ $i ] );

					// Validate the icon supported.
					if ( ! in_array( $icon_name, $allowed_icons ) ) {
						SI_Admin_Meta_Boxes::add_error( sprintf( __( 'The social url %s cannot be used as it does not have an allowed icon.', 'social-icons' ), '<code>' . esc_url( $icon_url ) . '</code>' ) );
						continue;
					}

					$sortable_icons[ $icon_name . '_' . $i ] = array(
						'label' => $icon_label,
						'url'   => $icon_url,
					);
				}
			}
		}

		// Save
		update_post_meta( $post_id, 'background_style', $background_style );
		update_post_meta( $post_id, 'icon_font_size', $icon_font_size );
		update_post_meta( $post_id, '_manage_label', $manage_label );
		update_post_meta( $post_id, '_greyscale_icons', $greyscale_icons );
		update_post_meta( $post_id, '_open_new_tab', $open_new_tab );
		update_post_meta( $post_id, '_sortable_icons', $sortable_icons );

		do_action( 'social_icons_group_options_save', $post_id );
	}
}
