<?php
/**
 * Social Icons Admin.
 *
 * @class    SI_Admin
 * @version  1.4.0
 * @package  Social_Icons/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Admin Class
 */
class SI_Admin {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'admin_footer', 'si_print_js', 25 );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		include_once( 'functions-si-admin.php' );
		include_once( 'functions-si-meta-box.php' );
		include_once( 'class-si-admin-assets.php' );
		include_once( 'class-si-admin-post-types.php' );
	}

	/**
	 * Change the admin footer text on Social Icons admin pages.
	 * @param  string $footer_text
	 * @return string
	 */
	public function admin_footer_text( $footer_text ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$current_screen = get_current_screen();
		$si_pages       = si_get_screen_ids();

		// Check to make sure we're on a Social Icons admin page
		if ( isset( $current_screen->id ) && apply_filters( 'social_icons_display_admin_footer_text', in_array( $current_screen->id, $si_pages ) ) ) {
			// Change the footer text
			if ( ! get_option( 'social_icons_admin_footer_text_rated' ) ) {
				$footer_text = sprintf( __( 'If you like <strong>Social Icons</strong> please leave us a %s&#9733;&#9733;&#9733;&#9733;&#9733;%s rating. A huge thank you from ThemeGrill in advance!', 'social-icons' ), '<a href="https://wordpress.org/support/view/plugin-reviews/social-icons?filter=5#postform" target="_blank" class="si-rating-link" data-rated="' . esc_attr__( 'Thanks :)', 'social-icons' ) . '">', '</a>' );
				si_enqueue_js( "
					jQuery( 'a.si-rating-link' ).click( function() {
						jQuery.post( '" . SI()->ajax_url() . "', { action: 'social_icons_rated' } );
						jQuery( this ).parent().text( jQuery( this ).data( 'rated' ) );
					});
				" );
			} else {
				$footer_text = __( 'Thank you for creating with Social Icons.', 'social-icons' );
			}
		}

		return $footer_text;
	}
}

new SI_Admin();
