<?php
/**
 * Social Icons Meta Boxes
 *
 * Sets up the write panels used by custom post types.
 *
 * @class    SI_Admin_Meta_Boxes
 * @version  1.4.0
 * @package  Social_Icons/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Admin_Meta_Boxes Class
 */
class SI_Admin_Meta_Boxes {

	/**
	 * Is meta boxes saved once?
	 *
	 * @var boolean
	 */
	private static $saved_meta_boxes = false;

	/**
	 * Meta box error messages.
	 *
	 * @var array
	 */
	public static $meta_box_errors  = array();

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'remove_meta_boxes' ), 10 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 20 );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );

		// Save Icon Meta Boxes
		add_action( 'social_icons_process_social_icon_meta', 'SI_Meta_Box_Group_Data::save', 10, 2 );

		// Error handling (for showing errors from meta boxes on next page load)
		add_action( 'admin_notices', array( $this, 'output_errors' ) );
		add_action( 'shutdown', array( $this, 'save_errors' ) );
	}

	/**
	 * Add an error message.
	 * @param string $text
	 */
	public static function add_error( $text ) {
		self::$meta_box_errors[] = $text;
	}

	/**
	 * Save errors to an option.
	 */
	public function save_errors() {
		update_option( 'social_icons_meta_box_errors', self::$meta_box_errors );
	}

	/**
	 * Show any stored error messages.
	 */
	public function output_errors() {
		$errors = maybe_unserialize( get_option( 'social_icons_meta_box_errors' ) );

		if ( ! empty( $errors ) ) {

			echo '<div id="social_icons_errors" class="error notice is-dismissible">';

			foreach ( $errors as $error ) {
				echo '<p>' . wp_kses_post( $error ) . '</p>';
			}

			echo '</div>';

			// Clear
			delete_option( 'social_icons_meta_box_errors' );
		}
	}

	/**
	 * Add SI Meta boxes.
	 */
	public function add_meta_boxes() {
		add_meta_box( 'social-icons-group-data', __( 'Social Data', 'social-icons' ), 'SI_Meta_Box_Group_Data::output', 'social_icon', 'normal', 'high' );
	}

	/**
	 * Remove bloat.
	 */
	public function remove_meta_boxes() {
		remove_meta_box( 'commentstatusdiv', 'social_icon', 'normal' );
		remove_meta_box( 'slugdiv', 'social_icon', 'normal' );
	}

	/**
	 * Check if we're saving, the trigger an action based on the post type.
	 * @param int $post_id
	 * @param object $post
	 */
	public function save_meta_boxes( $post_id, $post ) {
		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
			return;
		}

		// Don't save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the nonce
		if ( empty( $_POST['social_icons_meta_nonce'] ) || ! wp_verify_nonce( $_POST['social_icons_meta_nonce'], 'social_icons_save_data' ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check user has permission to edit
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// We need this save event to run once to avoid potential endless loops. This would have been perfect:
		self::$saved_meta_boxes = true;

		// Check the post type
		if ( in_array( $post->post_type, array( 'social_icon' ) ) ) {
			do_action( 'social_icons_process_' . $post->post_type . '_meta', $post_id, $post );
		}
	}
}

new SI_Admin_Meta_Boxes();
