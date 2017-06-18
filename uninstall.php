<?php
/**
 * Social Icons Uninstall
 *
 * Uninstalls the plugin and associated data.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Social_Icons/Uninstaller
 * @version  1.4.0
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

/*
 * Only remove ALL demo importer data if SI_REMOVE_ALL_DATA constant is set to true in user's
 * wp-config.php. This is to prevent data loss when deleting the plugin from the backend
 * and to ensure only the site owner can perform this action.
 */
if ( defined( 'SI_REMOVE_ALL_DATA' ) && true === SI_REMOVE_ALL_DATA ) {
	// Delete options.
	$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'social_icons\_%';" );

	// Delete posts + data.
	$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE post_type IN ( 'social_icon' );" );
	$wpdb->query( "DELETE meta FROM {$wpdb->postmeta} meta LEFT JOIN {$wpdb->posts} posts ON posts.ID = meta.post_id WHERE posts.ID IS NULL;" );

	// Clear any cached data that has been removed.
	wp_cache_flush();
}
