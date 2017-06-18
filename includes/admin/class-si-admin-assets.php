<?php
/**
 * Social Icons Admin Assets
 *
 * Load Admin Assets.
 *
 * @class    SI_Admin_Assets
 * @version  1.4.0
 * @package  Social_Icons/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Admin_Assets Class
 */
class SI_Admin_Assets {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'siteorigin_panel_enqueue_admin_scripts', array( $this, 'siteorigin_panel_scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_styles() {
		global $wp_scripts;

		$screen         = get_current_screen();
		$screen_id      = $screen ? $screen->id : '';
		$jquery_version = isset( $wp_scripts->registered['jquery-ui-core']->ver ) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';

		// Register admin styles.
		wp_register_style( 'social-icons-admin', SI()->plugin_url() . '/assets/css/admin.css', array(), SI_VERSION );
		wp_register_style( 'social-icons-admin-widgets', SI()->plugin_url() . '/assets/css/widgets.css', array(), SI_VERSION );
		wp_register_style( 'jquery-ui-style', '//code.jquery.com/ui/' . $jquery_version . '/themes/smoothness/jquery-ui.css', array(), $jquery_version );

		// Add RTL support for admin styles.
		wp_style_add_data( 'social-icons-admin', 'rtl', 'replace' );
		wp_style_add_data( 'social-icons-admin-widgets', 'rtl', 'replace' );

		// Admin styles for SI pages only.
		if ( in_array( $screen_id, si_get_screen_ids() ) ) {
			wp_enqueue_style( 'social-icons-admin' );
			wp_enqueue_style( 'jquery-ui-style' );
		}

		if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_style( 'social-icons-admin-widgets' );
		}
	}

	/**
	 * Enqueue scripts.
	 */
	public function admin_scripts() {
		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';
		$suffix    = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Register Scripts.
		wp_register_script( 'social-icons-admin', SI()->plugin_url() . '/assets/js/admin/admin' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-widget', 'jquery-ui-core', 'jquery-tiptip' ), SI_VERSION );
		wp_register_script( 'si-admin-meta-boxes', SI()->plugin_url() . '/assets/js/admin/meta-boxes' . $suffix . '.js', array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable', 'jquery-tiptip' ), SI_VERSION );
		wp_register_script( 'jquery-tiptip', SI()->plugin_url() . '/assets/js/jquery-tiptip/jquery.tipTip' . $suffix . '.js', array( 'jquery' ), SI_VERSION, true );
		wp_register_script( 'si-admin-widgets', SI()->plugin_url() . '/assets/js/admin/widgets' . $suffix . '.js', array( 'jquery' ), SI_VERSION );
		wp_register_script( 'si-admin-group-meta-boxes', SI()->plugin_url() . '/assets/js/admin/meta-boxes-group' . $suffix . '.js', array( 'si-admin-meta-boxes' ), SI_VERSION );

		// Localize socicons.
		$socicons_params = array(
			'allowed_socicons'   => si_get_allowed_socicons(),
			'supported_url_icon' => si_get_supported_url_icon(),
		);

		wp_localize_script( 'si-admin-widgets', 'social_icons_admin_widgets', $socicons_params );
		wp_localize_script( 'si-admin-group-meta-boxes', 'social_icons_admin_meta_boxes_group', $socicons_params );

		// Social Icons admin pages.
		if ( in_array( $screen_id, si_get_screen_ids() ) ) {
			wp_enqueue_script( 'social-icons-admin' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-autocomplete' );
		}

		// Meta boxes.
		if ( in_array( $screen_id, array( 'social_icon', 'edit-social_icon' ) ) ) {
			wp_enqueue_script( 'si-admin-group-meta-boxes' );
		}

		// Widgets Specific.
		if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_script( 'si-admin-widgets' );
		}
	}

	/**
	 * Enqueue siteorigin panel scripts.
	 */
	public function siteorigin_panel_scripts() {
		wp_enqueue_script( 'si-admin-widgets' );
		wp_enqueue_style( 'social-icons-admin-widgets' );
	}
}

new SI_Admin_Assets();
