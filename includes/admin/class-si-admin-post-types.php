<?php
/**
 * Post Types Admin
 *
 * @class    SI_Admin_Post_Types
 * @version  1.4.0
 * @package  Social_Icons/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Admin_Post_Types Class
 *
 * Handles the edit posts views and some functionality on the edit post screen for SI post types.
 */
class SI_Admin_Post_Types {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );
		add_filter( 'bulk_post_updated_messages', array( $this, 'bulk_post_updated_messages' ), 10, 2 );

		// WP List table columns. Defined here so they are always available for events such as inline editing.
		add_filter( 'manage_social_icon_posts_columns', array( $this, 'social_icons_columns' ) );
		add_action( 'manage_social_icon_posts_custom_column', array( $this, 'render_social_icon_columns' ), 2 );
		add_filter( 'manage_edit-social_icon_sortable_columns', array( $this, 'social_icon_sortable_columns' ) );

		add_filter( 'list_table_primary_column', array( $this, 'list_table_primary_column' ), 10, 2 );
		add_filter( 'post_row_actions', array( $this, 'row_actions' ), 2, 100 );

		// Edit post screens
		add_filter( 'enter_title_here', array( $this, 'enter_title_here' ), 1, 2 );
		add_action( 'edit_form_after_title', array( $this, 'edit_form_after_title' ) );

		// Meta-Box Class
		include_once( dirname( __FILE__ ) . '/class-si-admin-meta-boxes.php' );

		// Disable post type view mode options
		add_filter( 'view_mode_post_types', array( $this, 'disable_view_mode_options' ) );
	}

	/**
	 * Change messages when a post type is updated.
	 * @param  array $messages
	 * @return array
	 */
	public function post_updated_messages( $messages ) {
		global $post, $post_ID;

		$messages['social_icon'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => __( 'Social Icon updated.', 'social-icons' ),
			2 => __( 'Custom field updated.', 'social-icons' ),
			3 => __( 'Custom field deleted.', 'social-icons' ),
			4 => __( 'Social updated.', 'social-icons' ),
			5 => isset( $_GET['revision'] ) ? sprintf( __( 'Social Icon restored to revision from %s', 'social-icons' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => __( 'Social Icon updated.', 'social-icons' ),
			7 => __( 'Social Icon saved.', 'social-icons' ),
			8 => __( 'Social Icon submitted.', 'social-icons' ),
			9 => sprintf( __( 'Social Icon scheduled for: <strong>%1$s</strong>.', 'social-icons' ),
			  date_i18n( __( 'M j, Y @ G:i', 'social-icons' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Social Icon draft updated.', 'social-icons' ),
		);

		return $messages;
	}

	/**
	 * Specify custom bulk actions messages for different post types.
	 * @param  array $bulk_messages
	 * @param  array $bulk_counts
	 * @return array
	 */
	public function bulk_post_updated_messages( $bulk_messages, $bulk_counts ) {

		$bulk_messages['social_icon'] = array(
			'updated'   => _n( '%s social icon updated.', '%s social icons updated.', $bulk_counts['updated'], 'social-icons' ),
			'locked'    => _n( '%s social icon not updated, somebody is editing it.', '%s social icons not updated, somebody is editing them.', $bulk_counts['locked'], 'social-icons' ),
			'deleted'   => _n( '%s social icon permanently deleted.', '%s social icons permanently deleted.', $bulk_counts['deleted'], 'social-icons' ),
			'trashed'   => _n( '%s social icon moved to the Trash.', '%s social icons moved to the Trash.', $bulk_counts['trashed'], 'social-icons' ),
			'untrashed' => _n( '%s social icon restored from the Trash.', '%s social icons restored from the Trash.', $bulk_counts['untrashed'], 'social-icons' ),
		);

		return $bulk_messages;
	}

	/**
	 * Define custom columns for icons.
	 * @param  array $existing_columns
	 * @return array
	 */
	public function social_icons_columns( $existing_columns ) {
		$columns              = array();
		$columns['cb']        = $existing_columns['cb'];
		$columns['name']      = __( 'Name', 'social-icons' );
		$columns['shortcode'] = __( 'Shortcode', 'social-icons' ) . si_help_tip( __( 'Copy and paste the shortcode on your post, page to render social icons.', 'social-icons' ) );
		$columns['author']    = __( 'Author', 'social-icons' );
		$columns['date']      = __( 'Date', 'social-icons' );

		return $columns;
	}

	/**
	 * Output custom columns for icons.
	 * @param string $column
	 */
	public function render_social_icon_columns( $column ) {
		global $post;

		switch ( $column ) {
			case 'name':
				$edit_link = get_edit_post_link( $post->ID );
				$title     = _draft_or_post_title();

				echo '<strong><a class="row-title" href="' . esc_url( $edit_link ) . '">' . esc_html( $title ) . '</a>';

				_post_states( $post );

				echo '</strong>';

				$this->_render_social_icon_row_actions( $post, $title );
			break;
			case 'shortcode' :
				$shortcode = '[social_icons_group id="' . $post->ID . '"]';
				echo '<span class="shortcode"><input type="text" class="regular-text code" onfocus="this.select();" readonly="readonly" value="' . esc_attr( $shortcode ) . '" /></span>';
			break;
			default:
				break;
		}
	}

	/**
	 * Render social_icon row actions for old version of WordPress.
	 * Since WordPress 4.3 we don't have to build the row actions.
	 *
	 * @param WP_Post $post
	 * @param string  $title
	 */
	private function _render_social_icon_row_actions( $post, $title ) {
		global $wp_version;

		if ( version_compare( $wp_version, '4.3-beta', '>=' ) ) {
			return;
		}

		$post_type_object = get_post_type_object( $post->post_type );

		// Get actions
		$actions = array();

		if ( current_user_can( $post_type_object->cap->edit_post, $post->ID ) ) {
			$actions['edit'] = '<a href="' . admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=edit', $post->ID ) ) . '">' . __( 'Edit', 'social-icons' ) . '</a>';
		}

		if ( current_user_can( $post_type_object->cap->delete_post, $post->ID ) ) {

			if ( 'trash' == $post->post_status ) {
				$actions['untrash'] = "<a title='" . esc_attr( __( 'Restore this item from the Trash', 'social-icons' ) ) . "' href='" . wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $post->ID ) ), 'untrash-post_' . $post->ID ) . "'>" . __( 'Restore', 'social-icons' ) . "</a>";
			} elseif ( EMPTY_TRASH_DAYS ) {
				$actions['trash'] = "<a class='submitdelete' title='" . esc_attr( __( 'Move this item to the Trash', 'social-icons' ) ) . "' href='" . get_delete_post_link( $post->ID ) . "'>" . __( 'Trash', 'social-icons' ) . "</a>";
			}

			if ( 'trash' == $post->post_status || ! EMPTY_TRASH_DAYS ) {
				$actions['delete'] = "<a class='submitdelete' title='" . esc_attr( __( 'Delete this item permanently', 'social-icons' ) ) . "' href='" . get_delete_post_link( $post->ID, '', true ) . "'>" . __( 'Delete Permanently', 'social-icons' ) . "</a>";
			}
		}

		$actions = apply_filters( 'post_row_actions', $actions, $post );

		echo '<div class="row-actions">';

		$i = 0;
		$action_count = sizeof( $actions );

		foreach ( $actions as $action => $link ) {
			++$i;
			( $i == $action_count ) ? $sep = '' : $sep = ' | ';
			echo "<span class='$action'>$link$sep</span>";
		}
		echo '</div>';
	}

	/**
	 * Make columns sortable - https://gist.github.com/906872
	 * @param  array $columns
	 * @return array
	 */
	public function social_icon_sortable_columns( $columns ) {
		$custom = array(
			'name'   => 'title',
			'author' => 'author',
		);
		return wp_parse_args( $custom, $columns );
	}

	/**
	 * Set list table primary column for social icon
	 * Support for WordPress 4.3
	 *
	 * @param  string $default
	 * @param  string $screen_id
	 *
	 * @return string
	 */
	public function list_table_primary_column( $default, $screen_id ) {

		if ( 'edit-social_icon' === $screen_id ) {
			return 'name';
		}

		return $default;
	}

	/**
	 * Set row actions for social icon.
	 *
	 * @param  array $actions
	 * @param  WP_Post $post
	 *
	 * @return array
	 */
	public function row_actions( $actions, $post ) {

		if ( 'social_icon' === $post->post_type ) {
			if ( isset( $actions['inline hide-if-no-js'] ) ) {
				unset( $actions['inline hide-if-no-js'] );
			}
		}

		return $actions;
	}

	/**
	 * Change title boxes in admin.
	 * @param  string $text
	 * @param  object $post
	 * @return string
	 */
	public function enter_title_here( $text, $post ) {
		switch ( $post->post_type ) {
			case 'social_icon':
				$text = __( 'Social Icon name', 'social-icons' );
			break;
		}

		return $text;
	}

	/**
	 * Print group description textarea field
	 * @param WP_Post $post
	 */
	public function edit_form_after_title( $post ) {
		if ( 'social_icon' === $post->post_type ) {
			?>
			<textarea id="social-icons-group-description" name="excerpt" cols="5" rows="2" placeholder="<?php esc_attr_e( 'Description (optional)', 'social-icons' ); ?>"><?php echo $post->post_excerpt; ?></textarea>
			<?php
		}
	}

	/**
	 * Removes social icon from the list of post types that support "View Mode" switching.
	 * View mode is seen on posts where you can switch between list or excerpt. Our post types don't support
	 * it, so we want to hide the useless UI from the screen options tab.
	 *
	 * @param  array $post_types Array of post types supporting view mode
	 * @return array             Array of post types supporting view mode, without social icon
	 */
	public function disable_view_mode_options( $post_types ) {
		unset( $post_types['social_icon'] );
		return $post_types;
	}
}

new SI_Admin_Post_Types();
