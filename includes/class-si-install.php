<?php
/**
 * Installation related functions and actions.
 *
 * @class    SI_Install
 * @version  1.4.0
 * @package  Social_Icons/Classes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Install Class
 */
class SI_Install {

	/**
	 * Hook in tabs.
	 */
	public static function init() {
		add_filter( 'plugin_action_links_' . SI_PLUGIN_BASENAME, array( __CLASS__, 'plugin_action_links' ) );
		add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Display action links in the Plugins list table.
	 * @param  array $actions
	 * @return array
	 */
	public static function plugin_action_links( $actions ) {
		$new_actions = array(
			'settings' => '<a href="' . admin_url( 'edit.php?post_type=social_icon' ) . '" title="' . esc_attr( __( 'View Social Icons Settings', 'social-icons' ) ) . '">' . __( 'Settings', 'social-icons' ) . '</a>',
		);

		return array_merge( $new_actions, $actions );
	}

	/**
	 * Display row meta in the Plugins list table.
	 * @param  array  $plugin_meta
	 * @param  string $plugin_file
	 * @return array
	 */
	public static function plugin_row_meta( $plugin_meta, $plugin_file ) {
		if ( SI_PLUGIN_BASENAME == $plugin_file ) {
			$new_plugin_meta = array(
				'docs'    => '<a href="' . esc_url( apply_filters( 'social_icons_docs_url', 'https://themegrill.com/docs/social-icons/' ) ) . '" title="' . esc_attr( __( 'View Social Icons Documentation', 'social-icons' ) ) . '">' . __( 'Docs', 'social-icons' ) . '</a>',
				'support' => '<a href="' . esc_url( apply_filters( 'social_icons_support_url', 'https://themegrill.com/support-forum/' ) ) . '" title="' . esc_attr( __( 'Visit Free Customer Support Forum', 'social-icons' ) ) . '">' . __( 'Free Support', 'social-icons' ) . '</a>',
			);

			return array_merge( $plugin_meta, $new_plugin_meta );
		}

		return (array) $plugin_meta;
	}
}

SI_Install::init();
