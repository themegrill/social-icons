<?php
/**
 * Social Icons Widget Functions
 *
 * Widget related functions and widget registration.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Social_Icons/Functions
 * @version  1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include Widget classes.
include_once( dirname( __FILE__ ) . '/abstracts/abstract-si-widget.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-si-widget-social-icons.php' );

/**
 * Register Widgets.
 * @since 1.4.0
 */
function si_register_widgets() {
	register_widget( 'SI_Widget_Social_Icons' );
}
add_action( 'widgets_init', 'si_register_widgets' );
