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
	return apply_filters( 'social_icons_allowed_socicon', array( 'hackernews', 'smashwords', 'kobo', 'bookbub', 'mailru', 'gitlab', 'instructables', 'portfolio', 'codered', 'origin', 'nextdoor', 'udemy', 'livemaster', 'crunchbase', 'homefy', 'calendly', 'realtor', 'tidal', 'qobuz', 'natgeo', 'mastodon', 'unsplash', 'homeadvisor', 'angieslist', 'codepen', 'slack', 'openaigym', 'logmein', 'fiverr', 'gotomeeting', 'aliexpress', 'guru', 'appstore', 'homes', 'zoom', 'alibaba', 'craigslist', 'wix', 'redfin', 'googlecalendar', 'shopify', 'freelancer', 'seedrs', 'bing', 'doodle', 'bonanza', 'squarespace', 'toptal', 'gust', 'ask', 'trulia', 'loomly', 'ghost', 'upwork', 'fundable', 'booking', 'googlemaps', 'zillow', 'niconico', 'toneden', 'augment', 'bitbucket', 'fyuse', 'yt-gaming', 'sketchfab', 'mobcrush', 'microsoft', 'pandora', 'messenger', 'gamewisp', 'bloglovin', 'tunein', 'gamejolt', 'trello', 'spreadshirt', '500px', '8tracks', 'airbnb', 'alliance', 'amazon', 'amplement', 'android', 'angellist', 'apple', 'appnet', 'baidu', 'bandcamp', 'battlenet', 'mixer', 'bebee', 'bebo', 'behance', 'blizzard', 'blogger', 'buffer', 'chrome', 'coderwall', 'curse', 'dailymotion', 'deezer', 'delicious', 'deviantart', 'diablo', 'digg', 'discord', 'disqus', 'douban', 'draugiem', 'dribbble', 'drupal', 'ebay', 'ello', 'endomodo', 'envato', 'etsy', 'facebook', 'feedburner', 'filmweb', 'firefox', 'flattr', 'flickr', 'formulr', 'forrst', 'foursquare', 'friendfeed', 'github', 'goodreads', 'google', 'googlescholar', 'googlegroups', 'googlephotos', 'googleplus', 'grooveshark', 'hackerrank', 'hearthstone', 'hellocoton', 'heroes', 'smashcast', 'horde', 'houzz', 'icq', 'identica', 'imdb', 'instagram', 'issuu', 'istock', 'itunes', 'keybase', 'lanyrd', 'lastfm', 'line', 'linkedin', 'livejournal', 'lyft', 'macos', 'mail', 'medium', 'meetup', 'mixcloud', 'modelmayhem', 'mumble', 'myspace', 'newsvine', 'nintendo', 'npm', 'odnoklassniki', 'openid', 'opera', 'outlook', 'overwatch', 'patreon', 'paypal', 'periscope', 'persona', 'pinterest', 'play', 'player', 'playstation', 'pocket', 'qq', 'quora', 'raidcall', 'ravelry', 'reddit', 'renren', 'researchgate', 'residentadvisor', 'reverbnation', 'rss', 'sharethis', 'skype', 'slideshare', 'smugmug', 'snapchat', 'songkick', 'soundcloud', 'spotify', 'stackexchange', 'stackoverflow', 'starcraft', 'stayfriends', 'steam', 'storehouse', 'strava', 'streamjar', 'stumbleupon', 'swarm', 'teamspeak', 'teamviewer', 'technorati', 'telegram', 'tripadvisor', 'tripit', 'triplej', 'tumblr', 'twitch', 'twitter', 'uber', 'ventrilo', 'viadeo', 'viber', 'viewbug', 'vimeo', 'vine', 'vkontakte', 'warcraft', 'wechat', 'weibo', 'whatsapp', 'wikipedia', 'windows', 'wordpress', 'wykop', 'xbox', 'xing', 'yahoo', 'yammer', 'yandex', 'yelp', 'younow', 'youtube', 'zapier', 'zerply', 'zomato', 'zynga' ) );
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
		'gaming.youtube.com'    => 'yt-gaming',
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
