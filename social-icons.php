<?php
/**
 * Plugin Name: Social Icons
 * Plugin URI: https://themegrill.com/plugins/social-icons/
 * Description: Social Icons provides you with an easy way to display various popular social icons via widgets and shortcodes. You can drag the widget in your sidebars and change the settings from the widget form itself. Also you can use the shortcode and paste it on your page, post or wherever you like.
 * Version: 1.7.2
 * Author: ThemeGrill
 * Author URI: http://themegrill.com
 * License: GPLv3 or later
 * Text Domain: social-icons
 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Social_Icons' ) ) :

/**
 * Main Social Icons Class.
 *
 * @class Social_Icons
 * @version 1.7.0
 */
final class Social_Icons {

	/**
	 * Plugin version.
	 * @var string
	 */
	public $version = '1.7.2';

	/**
	 * Instance of this class.
	 * @var object
	 */
	protected static $_instance = null;

	/**
	 * Main Social Icons Instance.
	 *
	 * Ensure only one instance of Social Icons is loaded or can be loaded.
	 *
	 * @static
	 * @see    SI()
	 * @return Social_Icons - Main instance.
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 * @since 1.4
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'social-icons' ), '1.4' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since 1.4
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'social-icons' ), '1.4' );
	}

	/**
	 * Social Icons Constructor.
	 */
	private function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'social_icons_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'init', array( 'SI_Shortcodes', 'init' ) );
		add_filter( 'kses_allowed_protocols' , array( $this, 'allowed_protocols' ) );
	}

	/**
	 * Define SI Constants.
	 */
	private function define_constants() {
		$this->define( 'SI_PLUGIN_FILE', __FILE__ );
		$this->define( 'SI_ABSPATH', dirname( __FILE__ ) . '/' );
		$this->define( 'SI_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'SI_VERSION', $this->version );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string $name
	 * @param string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Includes.
	 */
	private function includes() {
		include_once( SI_ABSPATH . 'includes/functions-si-core.php' );
		include_once( SI_ABSPATH . 'includes/functions-si-widget.php' );
		include_once( SI_ABSPATH . 'includes/class-si-autoloader.php' );
		include_once( SI_ABSPATH . 'includes/class-si-install.php' );
		include_once( SI_ABSPATH . 'includes/class-si-ajax.php' );

		if ( $this->is_request( 'admin' ) ) {
			include_once( SI_ABSPATH . 'includes/admin/class-si-admin.php' );
		}

		// Socicons.
		include_once( SI_ABSPATH . '/includes/libraries/socicons.php' );

		if ( $this->is_request( 'frontend' ) ) {
			$this->frontend_includes();
		}

		include_once( SI_ABSPATH . 'includes/class-si-post-types.php' );         // Registers post types
	}

	/**
	 * Include required frontend files.
	 */
	public function frontend_includes() {
		include_once( SI_ABSPATH . 'includes/class-si-frontend-scripts.php' );   // Frontend Scripts
		include_once( SI_ABSPATH . 'includes/class-si-shortcodes.php' );         // Shortcodes Class
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/social-icons/social-icons-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/social-icons-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'social-icons' );

		load_textdomain( 'social-icons', WP_LANG_DIR . '/social-icons/social-icons-' . $locale . '.mo' );
		load_plugin_textdomain( 'social-icons', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * List of allowed social protocols in HTML attributes.
	 * @param  array $protocols Array of allowed protocols.
	 * @return array
	 */
	public function allowed_protocols( $protocols ) {
		$social_protocols = array(
			'skype',
			'viber',
			'whatsapp',
		);

		return array_merge( $protocols, $social_protocols );
	}

	/**
	 * Get the plugin url.
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get Ajax URL.
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}
}

endif;

/**
 * Main instance of Social Icons.
 *
 * Returns the main instance of SI to prevent the need to use globals.
 *
 * @since  1.4.0
 * @return Social_Icons
 */
function SI() {
	return Social_Icons::get_instance();
}

// Global for backwards compatibility.
$GLOBALS['social_icons'] = SI();
