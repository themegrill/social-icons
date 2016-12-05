<?php
/**
 * Social Icons Admin Functions
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Social_Icons/Admin/Functions
 * @version  1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get all social icons screen ids.
 * @return array
 */
function si_get_screen_ids() {
	return apply_filters( 'social_icons_screen_ids', array( 'edit-social_icon', 'social_icon' ) );
}

/**
 * Get the social icon name for given website url.
 *
 * @param  string $url Social site link.
 * @return string
 */
function si_get_social_icon_name( $url ) {
	$icon = '';

	if ( $url = strtolower( $url ) ) {
		foreach ( si_get_supported_url_icon() as $link => $icon_name ) {
			if ( strstr( $url, $link ) ) {
				$icon = $icon_name;
			}
		}

		if ( ! $icon ) {
			foreach ( si_get_allowed_socicons() as $icon_name ) {
				if ( strstr( $url, $icon_name ) ) {
					$icon = $icon_name;
				}
			}
		}
	}

	return apply_filters( 'social_icons_get_icon_name', $icon, $url );
}
