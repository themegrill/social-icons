<?php
/**
 * Social Icons Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Social_Icons/Functions
 * @version  1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Clean variables using sanitize_text_field
 * @param  string|array $var
 * @return string
 */
function si_clean( $var ) {
	return is_array( $var ) ? array_map( 'si_clean', $var ) : sanitize_text_field( $var );
}

/**
 * Sanitize a string destined to be a tooltip.
 *
 * @since  1.4.0  Tooltips are encoded with htmlspecialchars to prevent XSS. Should not be used in conjunction with esc_attr()
 * @param  string $var
 * @return string
 */
function si_sanitize_tooltip( $var ) {
	return htmlspecialchars( wp_kses( html_entity_decode( $var ), array(
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'small'  => array(),
		'span'   => array(),
		'ul'     => array(),
		'li'     => array(),
		'ol'     => array(),
		'p'      => array(),
	) ) );
}

/**
 * Queue some JavaScript code to be output in the footer.
 * @param string $code
 */
function si_enqueue_js( $code ) {
	global $si_queued_js;

	if ( empty( $si_queued_js ) ) {
		$si_queued_js = '';
	}

	$si_queued_js .= "\n" . $code . "\n";
}

/**
 * Output any queued javascript code in the footer.
 */
function si_print_js() {
	global $si_queued_js;

	if ( ! empty( $si_queued_js ) ) {
		// Sanitize.
		$si_queued_js = wp_check_invalid_utf8( $si_queued_js );
		$si_queued_js = preg_replace( '/&#(x)?0*(?(1)27|39);?/i', "'", $si_queued_js );
		$si_queued_js = str_replace( "\r", '', $si_queued_js );

		$js = "<!-- Social Icons JavaScript -->\n<script type=\"text/javascript\">\njQuery(function($) { $si_queued_js });\n</script>\n";

		/**
		 * social_icons_queued_js filter.
		 * @param string $js JavaScript code.
		 */
		echo apply_filters( 'social_icons_queued_js', $js );

		unset( $si_queued_js );
	}
}

/**
 * Get the allowed socicon lists.
 * @return array
 */
function si_get_allowed_socicons() {
	return apply_filters( 'social_icons_allowed_socicon', array( 'modelmayhem', 'mixcloud', 'drupal', 'swarm', 'istock', 'yammer', 'ello', 'stackoverflow', 'persona', 'triplej', 'houzz', 'rss', 'paypal', 'odnoklassniki', 'airbnb', 'periscope', 'outlook', 'coderwall', 'tripadvisor', 'appnet', 'goodreads', 'tripit', 'lanyrd', 'slideshare', 'buffer', 'disqus', 'vkontakte', 'whatsapp', 'patreon', 'storehouse', 'pocket', 'mail', 'blogger', 'technorati', 'reddit', 'dribbble', 'stumbleupon', 'digg', 'envato', 'behance', 'delicious', 'deviantart', 'forrst', 'play', 'zerply', 'wikipedia', 'apple', 'flattr', 'github', 'renren', 'friendfeed', 'newsvine', 'identica', 'bebo', 'zynga', 'steam', 'xbox', 'windows', 'qq', 'douban', 'meetup', 'playstation', 'android', 'snapchat', 'twitter', 'facebook', 'googleplus', 'pinterest', 'foursquare', 'yahoo', 'skype', 'yelp', 'feedburner', 'linkedin', 'viadeo', 'xing', 'myspace', 'soundcloud', 'spotify', 'grooveshark', 'lastfm', 'youtube', 'vimeo', 'dailymotion', 'vine', 'flickr', '500px', 'instagram', 'wordpress', 'tumblr', 'twitch', '8tracks', 'amazon', 'icq', 'smugmug', 'ravelry', 'weibo', 'baidu', 'angellist', 'ebay', 'imdb', 'stayfriends', 'residentadvisor', 'google', 'yandex', 'sharethis', 'bandcamp', 'itunes', 'deezer', 'medium', 'telegram', 'openid', 'amplement', 'viber', 'zomato', 'quora', 'draugiem', 'endomodo', 'filmweb', 'stackexchange', 'wykop', 'teamspeak', 'teamviewer', 'ventrilo', 'younow', 'raidcall', 'mumble', 'bebee', 'hitbox', 'reverbnation', 'formulr', 'battlenet', 'chrome', 'diablo', 'discord', 'issuu', 'macos', 'firefox', 'heroes', 'hearthstone', 'overwatch', 'opera', 'warcraft', 'starcraft', 'keybase', 'alliance', 'livejournal', 'googlephotos', 'horde', 'etsy', 'zapier', 'google-scholar', 'researchgate', 'wechat', 'strava', 'line', 'lyft', 'uber', 'songkick', 'viewbug', 'googlegroups', 'blizzard', 'beam', 'curse', 'player', 'streamjar', 'nintendo', 'hellocton' ) );
}

/**
 * Get the icon from supported URL lists.
 * @return array
 */
function si_get_supported_url_icon() {
	return apply_filters( 'social_icons_get_supported_url_icon', array(
		'feed'                  => 'rss',
		'ok.ru'                 => 'odnoklassniki',
		'vk.com'                => 'vkontakte',
		'last.fm'               => 'lastfm',
		'youtu.be'              => 'youtube',
		'battle.net'            => 'battlenet',
		'blogspot.com'          => 'blogger',
		'play.google.com'       => 'play',
		'plus.google.com'       => 'googleplus',
		'photos.google.com'     => 'googlephotos',
		'groups.google.com'     => 'googlegroups',
		'chrome.google.com'     => 'chrome',
		'scholar.google.com'    => 'google-scholar',
		'feedburner.google.com' => 'mail',
	) );
}

/**
 * Get the default sortable socicon lists.
 * @return array
 */
function si_get_default_sortable_socicons() {
	return apply_filters( 'social_icons_get_default_sortable_socicons', array(
		'twitter' => array(
			'url'   => 'https://twitter.com/themegrill',
			'label' => __( 'Follow Me', 'social-icons' ),
		),
		'facebook' => array(
			'url'   => 'https://facebook.com/themegrill',
			'label' => __( 'Friend me on Facebook', 'social-icons' ),
		),
	) );
}

/**
 * Checks whether the content passed contains a specific short code.
 *
 * @param  string $tag Shortcode tag to check.
 * @return bool
 */
function si_post_content_has_shortcode( $tag = '' ) {
	global $post;

	return is_singular() && is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, $tag );
}

/**
 * Display a Social Icons help tip.
 *
 * @param  string $tip Help tip text
 * @param  bool   $allow_html Allow sanitized HTML if true or escape
 * @return string
 */
function si_help_tip( $tip, $allow_html = false ) {
	if ( $allow_html ) {
		$tip = si_sanitize_tooltip( $tip );
	} else {
		$tip = esc_attr( $tip );
	}

	return '<span class="social-icons-help-tip" data-tip="' . $tip . '"></span>';
}
