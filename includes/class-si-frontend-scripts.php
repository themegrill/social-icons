<?php
/**
 * Handle frontend scripts.
 *
 * @class    SI_Frontend_Scripts
 * @version  1.4.0
 * @package  Social_Icons/Classes
 * @category Class
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Frontend_Scripts Class
 */
class SI_Frontend_Scripts {

	/**
	 * Contains an array of script handles registered by SI.
	 * @var array
	 */
	private static $styles = array();

	/**
	 * Hooks in methods.
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_scripts' ) );
	}

	/**
	 * Get styles for the frontend.
	 * @access private
	 * @return array
	 */
	public static function get_styles() {
		return apply_filters( 'social_icons_enqueue_styles', array(
			'social-icons-general' => array(
				'src'     => self::get_asset_url( 'assets/css/social-icons.css' ),
				'deps'    => '',
				'version' => SI_VERSION,
				'media'   => 'all',
			),
		) );
	}

	/**
	 * Return protocol relative asset URL.
	 * @param string $path
	 */
	private static function get_asset_url( $path ) {
		return str_replace( array( 'http:', 'https:' ), '', plugins_url( $path, SI_PLUGIN_FILE ) );
	}

	/**
	 * Register a style for use.
	 *
	 * @uses   wp_register_style()
	 * @access private
	 * @param  string   $handle
	 * @param  string   $path
	 * @param  string[] $deps
	 * @param  string   $version
	 * @param  string   $media
	 */
	private static function register_style( $handle, $path, $deps = array(), $version = SI_VERSION, $media = 'all' ) {
		self::$styles[] = $handle;
		wp_register_style( $handle, $path, $deps, $version, $media );
	}

	/**
	 * Register and enqueue a styles for use.
	 *
	 * @uses   wp_enqueue_style()
	 * @access private
	 * @param  string   $handle
	 * @param  string   $path
	 * @param  string[] $deps
	 * @param  string   $version
	 * @param  string   $media
	 */
	private static function enqueue_style( $handle, $path = '', $deps = array(), $version = SI_VERSION, $media = 'all' ) {
		if ( ! in_array( $handle, self::$styles ) && $path ) {
			self::register_style( $handle, $path, $deps, $version, $media );
		}
		wp_enqueue_style( $handle );
	}

	/**
	 * Register/enqueue frontend scripts.
	 */
	public static function load_scripts() {
		if ( si_post_content_has_shortcode( 'social_icons_group' ) || apply_filters( 'social_icons_enable_stylesheets', true ) ) {

			// CSS Styles
			if ( $enqueue_styles = self::get_styles() ) {
				foreach ( $enqueue_styles as $handle => $args ) {
					self::enqueue_style( $handle, $args['src'], $args['deps'], $args['version'], $args['media'] );
				}
			}
		}
	}
}

SI_Frontend_Scripts::init();
