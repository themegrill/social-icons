<?php
/**
 * Post Types
 *
 * Registers post types and taxonomies.
 *
 * @class    SI_Post_Types
 * @version  1.4.0
 * @package  Social_Icons/Classes/Social Icons
 * @category Class
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SI_Post_Types Class
 */
class SI_Post_Types {

	/**
	 * Hook in methods.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		add_action( 'init', array( __CLASS__, 'support_jetpack_omnisearch' ) );
		add_filter( 'rest_api_allowed_post_types', array( __CLASS__, 'rest_api_allowed_post_types' ) );
	}

	/**
	 * Register core post types.
	 */
	public static function register_post_types() {

		if ( ! is_blog_installed() ) {
			return;
		}

		if ( post_type_exists( 'social_icon' ) ) {
			return;
		}

		do_action( 'social_icons_register_post_type' );

		register_post_type( 'social_icon',
			apply_filters( 'social_icons_register_post_type_args',
				array(
					'labels'              => array(
							'name'               => __( 'Social Icons', 'social-icons' ),
							'singular_name'      => __( 'Social Icon', 'social-icons' ),
							'menu_name'          => _x( 'Social Icons', 'Admin menu name', 'social-icons' ),
							'add_new'            => __( 'Add New', 'social-icons' ),
							'add_new_item'       => __( 'Add New Social Icon', 'social-icons' ),
							'edit'               => __( 'Edit', 'social-icons' ),
							'edit_item'          => __( 'Edit Social Icon', 'social-icons' ),
							'new_item'           => __( 'New Social Icon', 'social-icons' ),
							'view'               => __( 'View Social Icons', 'social-icons' ),
							'view_item'          => __( 'View Social Icons', 'social-icons' ),
							'search_items'       => __( 'Search Social Icons', 'social-icons' ),
							'not_found'          => __( 'No Social Icons found', 'social-icons' ),
							'not_found_in_trash' => __( 'No Social Icons found in trash', 'social-icons' ),
							'parent'             => __( 'Parent Social Icon', 'social-icons' ),
						),
					'description'         => __( 'This is where you can add new icons set to your social icons.', 'social-icons' ),
					'public'              => false,
					'show_ui'             => true,
					'map_meta_cap'        => true,
					'publicly_queryable'  => true,
					'exclude_from_search' => false,
					'hierarchical'        => false,
					'rewrite'             => false,
					'query_var'           => false,
					'supports'            => array( 'title' ),
					'show_in_menu'        => 'options-general.php',
					'show_in_nav_menus'   => false,
					'show_in_admin_bar'   => true,
				)
			)
		);
	}

	/**
	 * Add Social Icons Support to Jetpack Omnisearch.
	 */
	public static function support_jetpack_omnisearch() {
		if ( class_exists( 'Jetpack_Omnisearch_Posts' ) ) {
			new Jetpack_Omnisearch_Posts( 'social_icon' );
		}
	}

	/**
	 * Added Social Icons for Jetpack related posts.
	 * @param  array $post_types
	 * @return array
	 */
	public static function rest_api_allowed_post_types( $post_types ) {
		$post_types[] = 'social_icon';

		return $post_types;
	}
}

SI_Post_Types::init();
