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
	return apply_filters( 'social_icons_allowed_socicon', array( 'hackernews', 'smashwords', 'kobo', 'bookbub', 'mailru', 'gitlab', 'instructables', 'portfolio', 'codered', 'origin', 'nextdoor', 'udemy', 'livemaster', 'crunchbase', 'homefy', 'calendly', 'realtor', 'tidal', 'qobuz', 'natgeo', 'mastodon', 'unsplash', 'homeadvisor', 'angieslist', 'codepen', 'slack', 'openaigym', 'logmein', 'fiverr', 'gotomeeting', 'aliexpress', 'guru', 'appstore', 'homes', 'zoom', 'alibaba', 'craigslist', 'wix', 'redfin', 'googlecalendar', 'shopify', 'freelancer', 'seedrs', 'bing', 'doodle', 'bonanza', 'squarespace', 'toptal', 'gust', 'ask', 'trulia', 'loomly', 'ghost', 'upwork', 'fundable', 'booking', 'googlemaps', 'zillow', 'niconico', 'toneden', 'augment', 'bitbucket', 'fyuse', 'yt-gaming', 'sketchfab', 'mobcrush', 'microsoft', 'pandora', 'messenger', 'gamewisp', 'bloglovin', 'tunein', 'gamejolt', 'trello', 'spreadshirt', '500px', '8tracks', 'airbnb', 'alliance', 'amazon', 'amplement', 'android', 'angellist', 'apple', 'appnet', 'baidu', 'bandcamp', 'battlenet', 'mixer', 'bebee', 'bebo', 'behance', 'blizzard', 'blogger', 'buffer', 'chrome', 'coderwall', 'curse', 'dailymotion', 'deezer', 'delicious', 'deviantart', 'diablo', 'digg', 'discord', 'disqus', 'douban', 'draugiem', 'dribbble', 'drupal', 'ebay', 'ello', 'endomondo', 'envato', 'etsy', 'facebook', 'feedburner', 'filmweb', 'firefox', 'flattr', 'flickr', 'formulr', 'foursquare', 'github', 'goodreads', 'google', 'googlescholar', 'googlegroups', 'googlephotos', 'googleplus', 'grooveshark', 'hackerrank', 'hearthstone', 'hellocoton', 'heroes', 'smashcast', 'horde', 'houzz', 'icq', 'identica', 'imdb', 'instagram', 'issuu', 'istock', 'itunes', 'keybase', 'lanyrd', 'lastfm', 'line', 'linkedin', 'livejournal', 'lyft', 'macos', 'mail', 'medium', 'meetup', 'mixcloud', 'modelmayhem', 'mumble', 'myspace', 'nintendo', 'npm', 'odnoklassniki', 'openid', 'opera', 'outlook', 'overwatch', 'patreon', 'paypal', 'periscope', 'pinterest', 'play', 'player', 'playstation', 'pocket', 'qq', 'quora', 'raidcall', 'ravelry', 'reddit', 'renren', 'researchgate', 'residentadvisor', 'reverbnation', 'rss', 'sharethis', 'skype', 'slideshare', 'smugmug', 'snapchat', 'songkick', 'soundcloud', 'spotify', 'stackexchange', 'stackoverflow', 'starcraft', 'stayfriends', 'steam', 'storehouse', 'strava', 'streamjar', 'stumbleupon', 'swarm', 'teamspeak', 'teamviewer', 'telegram', 'tripadvisor', 'tripit', 'triplej', 'tumblr', 'twitch', 'twitter', 'uber', 'ventrilo', 'viadeo', 'viber', 'viewbug', 'vimeo', 'vine', 'vkontakte', 'warcraft', 'wechat', 'weibo', 'whatsapp', 'wikipedia', 'windows', 'wordpress', 'wykop', 'xbox', 'xing', 'yahoo', 'yammer', 'yandex', 'yelp', 'younow', 'youtube', 'zapier', 'zerply', 'zomato', 'zynga' ) );
}

/**
 * Get the elements of socicon lists.
 * @return array
 */
function si_get_allowed_socicons_elements() {
	return apply_filters( 'social_icons_get_allowed_socicons_elements', array(
		'hackernews' => array(
			'url'   => 'https://news.ycombinator.com/',
			'color' => '#FF6601',
		),
		'smashwords' => array(
			'url'   => 'https://www.smashwords.com/',
			'color' => '#4181C3',
		),
		'kobo' => array(
			'url'   => 'https://www.kobo.com/',
			'color' => '#BF0000',
		),
		'bookbub' => array(
			'url'   => 'https://www.bookbub.com/',
			'color' => '#E70005',
		),
		'mailru' => array(
			'url'   => 'https://news.mail.ru/',
			'color' => '#FDA840',
		),
		'gitlab' => array(
			'url'   => 'https://gitlab.com/',
			'color' => '#e65228',
		),
		'instructables' => array(
			'url'   => 'https://www.instructables.com/',
			'color' => '#f8b514',
		),
		'portfolio' => array(
			'url'   => 'https://www.myportfolio.com/',
			'color' => '#54AFFF',
		),
		'codered' => array(
			'url'   => 'https://www.onsolve.com/',
			'color' => '#466eb5',
		),
		'origin' => array(
			'url'   => 'https://www.origin.com/',
			'color' => '#F56C2E',
		),
		'nextdoor' => array(
			'url'   => 'https://nextdoor.com/',
			'color' => '#01B247',
		),
		'udemy' => array(
			'url'   => 'https://www.udemy.com/',
			'color' => '#17aa1c',
		),
		'udemy' => array(
			'url'   => 'https://www.udemy.com/',
			'color' => '#ec5252',
		),
		'livemaster' => array(
			'url'   => 'https://www.livemaster.com/',
			'color' => '#e76d00',
		),
		'crunchbase' => array(
			'url'   => 'https://www.crunchbase.com/',
			'color' => '#0288d1',
		),
		'homefy' => array(
			'url'   => 'https://www.homefy.com/',
			'color' => '#ffd100',
		),
		'calendly' => array(
			'url'   => 'https://calendly.com/',
			'color' => '#00a3fa',
		),
		'realtor' => array(
			'url'   => 'https://www.realtor.com/',
			'color' => '#D52228',
		),
		'tidal' => array(
			'url'   => 'http://tidal.com/',
			'color' => '#01FFFF',
		),
		'qobuz' => array(
			'url'   => 'https://www.qobuz.com/',
			'color' => '#298FBF',
		),
		'natgeo' => array(
			'url'   => 'https://www.nationalgeographic.com/',
			'color' => '#222222',
		),
		'mastodon' => array(
			'url'   => 'https://mastodon.social/',
			'color' => '#2986D6',
		),
		'unsplash' => array(
			'url'   => 'https://unsplash.com/',
			'color' => '#000000',
		),
		'homeadvisor' => array(
			'url'   => 'https://www.homeadvisor.com/',
			'color' => '#EF8B1D',
		),
		'angieslist' => array(
			'url'   => 'https://www.angieslist.com/',
			'color' => '#299F37',
		),
		'codepen' => array(
			'url'   => 'https://codepen.io/',
			'color' => '#000000',
		),
		'slack' => array(
			'url'   => 'https://slack.com/',
			'color' => '#4B6BC6',
		),
		'openaigym' => array(
			'url'   => 'https://gym.openai.com/',
			'color' => '#29A8B3',
		),
		'logmein' => array(
			'url'   => 'https://www.logmein.com/',
			'color' => '#45B6F3',
		),
		'fiverr' => array(
			'url'   => '',
			'color' => '#0DB62A',
		),
		'gotomeeting' => array(
			'url'   => 'https://www.gotomeeting.com/',
			'color' => '#FD7A2B',
		),
		'aliexpress' => array(
			'url'   => 'https://www.aliexpress.com/',
			'color' => '#E92C00',
		),
		'guru' => array(
			'url'   => 'https://www.guru.com/',
			'color' => '#4C81C0',
		),
		'appstore' => array(
			'url'   => '', // Not found.
			'color' => '#007AFF',
		),
		'homes' => array(
			'url'   => 'https://www.homes.com/',
			'color' => '#F7841B',
		),
		'zoom' => array(
			'url'   => 'https://zoom.us/',
			'color' => '#F7841B',
		),
		'alibaba' => array(
			'url'   => 'https://www.alibaba.com/',
			'color' => '#FF6A00',
		),
		'craigslist' => array(
			'url'   => 'https://www.craigslist.org/',
			'color' => '#561A8B',
		),
		'wix' => array(
			'url'   => 'http://www.wix.com/',
			'color' => '#0096FF',
		),
		'redfin' => array(
			'url'   => 'https://www.redfin.com/',
			'color' => '#C82022',
		),
		'googlecalendar' => array(
			'url'   => 'https://calendar.google.com/',
			'color' => '#3D81F6',
		),
		'shopify' => array(
			'url'   => 'https://www.shopify.com/',
			'color' => '#5C6AC4',
		),
		'freelancer' => array(
			'url'   => 'https://www.freelancer.com/',
			'color' => '#0088CA',
		),
		'seedrs' => array(
			'url'   => 'https://www.seedrs.com/',
			'color' => '#7FBB31',
		),
		'bing' => array(
			'url'   => 'https://www.bing.com/',
			'color' => '#008485',
		),
		'doodle' => array(
			'url'   => 'https://doodle.com/',
			'color' => '#0064DC',
		),
		'bonanza' => array(
			'url'   => 'https://www.bonanza.com/',
			'color' => '#62764A',
		),
		'squarespace' => array(
			'url'   => 'https://www.squarespace.com/',
			'color' => '#121212',
		),
		'toptal' => array(
			'url'   => 'https://www.toptal.com/',
			'color' => '#4C73AA',
		),
		'gust' => array(
			'url'   => 'https://gust.com/',
			'color' => '#1E2E3E',
		),
		'ask' => array(
			'url'   => 'https://www.ask.com/',
			'color' => '#CF0000',
		),
		'trulia' => array(
			'url'   => 'https://www.trulia.com/',
			'color' => '#20BF63',
		),
		'loomly' => array(
			'url'   => 'https://www.loomly.com/',
			'color' => '#00425f',
		),
		'ghost' => array(
			'url'   => 'https://ghost.org/',
			'color' => '#33393C',
		),
		'upwork' => array(
			'url'   => 'https://www.upwork.com/',
			'color' => '#5BBC2F',
		),
		'fundable' => array(
			'url'   => 'https://www.fundable.com/',
			'color' => '#1d181f',
		),
		'booking' => array(
			'url'   => 'https://www.booking.com/',
			'color' => '#003580',
		),
		'googlemaps' => array(
			'url'   => 'https://maps.google.com/',
			'color' => '#4285F4',
		),
		'zillow' => array(
			'url'   => 'https://www.zillow.com/',
			'color' => '#0074e4',
		),
		'niconico' => array(
			'url'   => 'http://www.nicovideo.jp/',
			'color' => '#000000',
		),
		'toneden' => array(
			'url'   => 'https://www.toneden.io/',
			'color' => '#777BF9',
		),
		'augment' => array(
			'url'   => 'http://www.augment.com/',
			'color' => '#E71204',
		),
		'bitbucket' => array(
			'url'   => 'https://bitbucket.org/',
			'color' => '#243759',
		),
		'fyuse' => array(
			'url'   => 'https://fyu.se/',
			'color' => '#FF3143',
		),
		'yt-gaming' => array(
			'url'   => 'https://gaming.youtube.com/',
			'color' => '#E91D00',
		),
		'sketchfab' => array(
			'url'   => 'https://sketchfab.com/',
			'color' => '#00A5D6',
		),
		'mobcrush' => array(
			'url'   => 'https://www.mobcrush.com/',
			'color' => '#FFEE00',
		),
		'microsoft' => array(
			'url'   => 'https://www.microsoft.com/',
			'color' => '#666666',
		),
		'pandora' => array(
			'url'   => 'http://www.pandora.net/',
			'color' => '#224099',
		),
		'messenger' => array(
			'url'   => 'https://www.messenger.com/',
			'color' => '#0084ff',
		),
		'gamewisp' => array(
			'url'   => 'https://gamewisp.com/',
			'color' => '#F8A853',
		),
		'bloglovin' => array(
			'url'   => 'https://www.bloglovin.com/',
			'color' => '#000000',
		),
		'tunein' => array(
			'url'   => 'https://tunein.com/',
			'color' => '#36b4a7',
		),
		'gamejolt' => array(
			'url'   => 'https://gamejolt.com/',
			'color' => '#191919',
		),
		'trello' => array(
			'url'   => 'https://trello.com/',
			'color' => '#0079bf',
		),
		'spreadshirt' => array(
			'url'   => 'https://www.spreadshirt.com/',
			'color' => '#00b2a6',
		),
		'500px' => array(
			'url'   => 'https://500px.com/',
			'color' => '#58a9de',
		),
		'8tracks' => array(
			'url'   => 'https://8tracks.com/',
			'color' => '#122c4b',
		),
		'airbnb' => array(
			'url'   => 'https://www.airbnb.com/',
			'color' => '#ff5a5f',
		),
		'alliance' => array(
			'url'   => 'https://alliance.com/',
			'color' => '#144587',
		),
		'amazon' => array(
			'url'   => 'https://www.amazon.com/',
			'color' => '#ff9900',
		),
		'amplement' => array(
			'url'   => 'https://www.amplement.com/',
			'color' => '#0996c3',
		),
		'android' => array(
			'url'   => 'https://www.android.com/',
			'color' => '#8ec047',
		),
		'angellist' => array(
			'url'   => 'https://angel.co/',
			'color' => '#000000',
		),
		'apple' => array(
			'url'   => 'https://www.apple.com/',
			'color' => '#b9bfc1',
		),
		'appnet' => array(
			'url'   => 'https://www.appnet.com/',
			'color' => '#494949',
		),
		'baidu' => array(
			'url'   => 'http://www.baidu.com/',
			'color' => '#2629d9',
		),
		'bandcamp' => array(
			'url'   => 'https://bandcamp.com/',
			'color' => '#619aa9',
		),
		'battlenet' => array(
			'url'   => 'https://us.battle.net/',
			'color' => '#0096CD',
		),
		'mixer' => array(
			'url'   => 'https://mixer.com/',
			'color' => '#1FBAED',
		),
		'bebee' => array(
			'url'   => 'https://www.bebee.com/',
			'color' => '#f28f16',
		),
		'bebo' => array(
			'url'   => 'https://bebo.com/',
			'color' => '#ef1011',
		),
		'behance' => array(
			'url'   => 'https://www.behance.net/',
			'color' => '#000000',
		),
		'blizzard' => array(
			'url'   => 'https://www.blizzard.com/',
			'color' => '#01b2f1',
		),
		'blogger' => array(
			'url'   => 'https://www.blogger.com/',
			'color' => '#ec661c',
		),
		'buffer' => array(
			'url'   => 'https://buffer.com/',
			'color' => '#000000',
		),
		'chrome' => array(
			'url'   => 'https://chrome.google.com/',
			'color' => '#757575',
		),
		'coderwall' => array(
			'url'   => 'https://coderwall.com/',
			'color' => '#3e8dcc',
		),
		'curse' => array(
			'url'   => 'https://www.curse.com/',
			'color' => '#f26522',
		),
		'dailymotion' => array(
			'url'   => 'http://www.dailymotion.com/',
			'color' => '#004e72',
		),
		'deezer' => array(
			'url'   => 'https://www.deezer.com/',
			'color' => '#32323d',
		),
		'delicious' => array(
			'url'   => 'https://del.icio.us/',
			'color' => '#020202',
		),
		'deviantart' => array(
			'url'   => 'https://www.deviantart.com/',
			'color' => '#c5d200',
		),
		'diablo' => array(
			'url'   => 'http://us.battle.net/',
			'color' => '#8b1209',
		),
		'digg' => array(
			'url'   => 'http://digg.com/',
			'color' => '#1d1d1b',
		),
		'discord' => array(
			'url'   => 'https://discordapp.com/',
			'color' => '#7289da',
		),
		'disqus' => array(
			'url'   => 'https://disqus.com/',
			'color' => '#2e9fff',
		),
		'douban' => array(
			'url'   => 'https://www.douban.com/',
			'color' => '#3ca353',
		),
		'draugiem' => array(
			'url'   => 'https://www.draugiem.lv/',
			'color' => '#ffa32b',
		),
		'dribbble' => array(
			'url'   => 'https://dribbble.com/',
			'color' => '#e84d88',
		),
		'drupal' => array(
			'url'   => 'https://www.drupal.org/',
			'color' => '#00598e',
		),
		'ebay' => array(
			'url'   => 'https://www.ebay.com/',
			'color' => '#333333',
		),
		'ello' => array(
			'url'   => 'https://ello.co/',
			'color' => '#000000',
		),
		'endomondo' => array(
			'url'   => 'https://www.endomondo.com/',
			'color' => '#86ad00',
		),
		'envato' => array(
			'url'   => 'https://envato.com/',
			'color' => '#597c3a',
		),
		'etsy' => array(
			'url'   => 'https://www.etsy.com/',
			'color' => '#f56400',
		),
		'facebook' => array(
			'url'   => 'https://www.facebook.com/',
			'color' => '#3e5b98',
		),
		'feedburner' => array(
			'url'   => 'https://feedburner.google.com/',
			'color' => '#ffcc00',
		),
		'filmweb' => array(
			'url'   => 'http://www.filmweb.pl/',
			'color' => '#ffc404',
		),
		'firefox' => array(
			'url'   => 'https://www.mozilla.org/en-US/firefox/',
			'color' => '#484848',
		),
		'flattr' => array(
			'url'   => 'https://flattr.com/',
			'color' => '#f67c1a',
		),
		'flickr' => array(
			'url'   => 'https://www.flickr.com/',
			'color' => '#1e1e1b',
		),
		'formulr' => array(
			'url'   => 'https://www.formulr.tv/',
			'color' => '#ff5a60',
		),
		'foursquare' => array(
			'url'   => 'https://foursquare.com/',
			'color' => '#f94877',
		),
		'github' => array(
			'url'   => 'https://github.com/',
			'color' => '#221e1b',
		),
		'goodreads' => array(
			'url'   => 'https://www.goodreads.com/',
			'color' => '#463020',
		),
		'google' => array(
			'url'   => 'https://www.google.com/',
			'color' => '#4285f4',
		),
		'googlescholar' => array(
			'url'   => 'https://scholar.google.com/',
			'color' => '#4285f4',
		),
		'googlegroups' => array(
			'url'   => 'https://groups.google.com/',
			'color' => '#4f8ef5',
		),
		'googlephotos' => array(
			'url'   => 'https://photos.google.com/',
			'color' => '#212121',
		),
		'googleplus' => array(
			'url'   => 'https://plus.google.com/',
			'color' => '#dd4b39',
		),
		'grooveshark' => array(
			'url'   => 'http://groovesharks.im/',
			'color' => '#000000',
		),
		'hackerrank' => array(
			'url'   => 'https://www.hackerrank.com/',
			'color' => '#2ec866',
		),
		'hearthstone' => array(
			'url'   => 'https://playhearthstone.com/',
			'color' => '#ec9313',
		),
		'hellocoton' => array(
			'url'   => 'http://www.hellocoton.fr/',
			'color' => '#d30d66',
		),
		'heroes' => array(
			'url'   => 'http://us.battle.net/',
			'color' => '#2397f7',
		),
		'smashcast' => array(
			'url'   => 'https://www.smashcast.tv/',
			'color' => '#000000',
		),
		'horde' => array(
			'url'   => 'https://www.horde.org/',
			'color' => '#84121c',
		),
		'houzz' => array(
			'url'   => 'https://www.houzz.com/',
			'color' => '#7cc04b',
		),
		'icq' => array(
			'url'   => 'https://icq.com/',
			'color' => '#7ebd00',
		),
		'identica' => array(
			'url'   => 'http://www.identica.co.uk/',
			'color' => '#000000',
		),
		'imdb' => array(
			'url'   => 'http://www.imdb.com/',
			'color' => '#e8ba00',
		),
		'instagram' => array(
			'url'   => 'https://www.instagram.com/',
			'color' => '#9c7c6e',
		),
		'issuu' => array(
			'url'   => 'https://issuu.com/',
			'color' => '#f26f61',
		),
		'istock' => array(
			'url'   => 'https://www.istockphoto.com/',
			'color' => '#000000',
		),
		'itunes' => array(
			'url'   => 'https://www.itunes.com/',
			'color' => '#ff5e51',
		),
		'keybase' => array(
			'url'   => 'https://keybase.io/',
			'color' => '#ff7100',
		),
		'lanyrd' => array(
			'url'   => 'http://lanyrd.com/',
			'color' => '#3c80c9',
		),
		'lastfm' => array(
			'url'   => 'https://www.last.fm/',
			'color' => '#d41316',
		),
		'line' => array(
			'url'   => 'https://line.me/',
			'color' => '#00b901',
		),
		'linkedin' => array(
			'url'   => 'https://www.linkedin.com/',
			'color' => '#3371b7',
		),
		'livejournal' => array(
			'url'   => 'https://www.livejournal.com/',
			'color' => '#0099cc',
		),
		'lyft' => array(
			'url'   => 'https://www.lyft.com/',
			'color' => '#ff00bf',
		),
		'macos' => array(
			'url'   => 'https://macos.com/',
			'color' => '#000000',
		),
		'mail' => array(
			'url'   => 'mail@domain.com',
			'color' => '#000000',
		),
		'medium' => array(
			'url'   => 'https://medium.com/',
			'color' => '#000000',
		),
		'meetup' => array(
			'url'   => 'https://www.meetup.com/',
			'color' => '#e2373c',
		),
		'mixcloud' => array(
			'url'   => 'https://www.mixcloud.com/',
			'color' => '#000000',
		),
		'modelmayhem' => array(
			'url'   => 'https://www.modelmayhem.com/',
			'color' => '#000000',
		),
		'mumble' => array(
			'url'   => 'https://www.mumble.com/',
			'color' => '#5ab5d1',
		),
		'myspace' => array(
			'url'   => 'https://myspace.com/',
			'color' => '#323232',
		),
		'nintendo' => array(
			'url'   => 'https://www.nintendo.com/',
			'color' => '#f58a33',
		),
		'npm' => array(
			'url'   => 'https://www.npmjs.com/',
			'color' => '#C12127',
		),
		'odnoklassniki' => array(
			'url'   => 'https://ok.ru/',
			'color' => '#f48420',
		),
		'openid' => array(
			'url'   => 'http://openid.net/',
			'color' => '#f78c40',
		),
		'opera' => array(
			'url'   => 'http://www.opera.com/',
			'color' => '#ff1b2d',
		),
		'outlook' => array(
			'url'   => 'https://outlook.live.com/',
			'color' => '#0072c6',
		),
		'overwatch' => array(
			'url'   => 'https://playoverwatch.com/',
			'color' => '#9e9e9e',
		),
		'patreon' => array(
			'url'   => 'https://www.patreon.com/',
			'color' => '#e44727',
		),
		'paypal' => array(
			'url'   => 'https://www.paypal.com/',
			'color' => '#009cde',
		),
		'periscope' => array(
			'url'   => 'https://www.pscp.tv/',
			'color' => '#3aa4c6',
		),
		'pinterest' => array(
			'url'   => 'https://www.pinterest.com/',
			'color' => '#c92619',
		),
		'play' => array(
			'url'   => 'https://play.google.com/',
			'color' => '#000000',
		),
		'player' => array(
			'url'   => 'https://player.me/',
			'color' => '#6e41bd',
		),
		'playstation' => array(
			'url'   => 'https://www.playstation.com/',
			'color' => '#000000',
		),
		'pocket' => array(
			'url'   => 'https://getpocket.com/',
			'color' => '#ed4055',
		),
		'qq' => array(
			'url'   => 'https://en.mail.qq.com/',
			'color' => '#4297d3',
		),
		'quora' => array(
			'url'   => 'https://www.quora.com/',
			'color' => '#cb202d',
		),
		'raidcall' => array(
			'url'   => 'http://www.raidcall.com.ru/',
			'color' => '#073558',
		),
		'ravelry' => array(
			'url'   => 'https://www.ravelry.com/',
			'color' => '#b6014c',
		),
		'reddit' => array(
			'url'   => 'https://www.reddit.com/',
			'color' => '#e74a1e',
		),
		'renren' => array(
			'url'   => 'http://www.renren-inc.com/',
			'color' => '#2266b0',
		),
		'researchgate' => array(
			'url'   => 'https://www.researchgate.net/',
			'color' => '#00ccbb',
		),
		'residentadvisor' => array(
			'url'   => 'https://www.residentadvisor.net/',
			'color' => '#b3be1b',
		),
		'reverbnation' => array(
			'url'   => 'https://www.reverbnation.com/',
			'color' => '#000000',
		),
		'rss' => array(
			'url'   => 'https://woocommerce.io/feed/',
			'color' => '#f26109',
		),
		'sharethis' => array(
			'url'   => 'http://platform-api.sharethis.com/js/sharethis.js',
			'color' => '#01bf01',
		),
		'skype' => array(
			'url'   => 'skype:username?chat',
			'color' => '#28abe3',
		),
		'slideshare' => array(
			'url'   => 'https://www.slideshare.net/',
			'color' => '#4ba3a6',
		),
		'smugmug' => array(
			'url'   => 'https://www.smugmug.com/',
			'color' => '#acfd32',
		),
		'snapchat' => array(
			'url'   => 'https://www.snapchat.com/',
			'color' => '#fffa37',
		),
		'songkick' => array(
			'url'   => 'https://www.songkick.com/',
			'color' => '#f80046',
		),
		'soundcloud' => array(
			'url'   => 'https://soundcloud.com/',
			'color' => '#fe3801',
		),
		'spotify' => array(
			'url'   => 'https://www.spotify.com/',
			'color' => '#7bb342',
		),
		'stackexchange' => array(
			'url'   => 'https://stackexchange.com/',
			'color' => '#2f2f2f',
		),
		'stackoverflow' => array(
			'url'   => 'https://stackoverflow.com/',
			'color' => '#fd9827',
		),
		'starcraft' => array(
			'url'   => 'https://starcraft2.com/',
			'color' => '#002250',
		),
		'stayfriends' => array(
			'url'   => 'https://www.stayfriends.com/',
			'color' => '#f08a1c',
		),
		'steam' => array(
			'url'   => 'http://store.steampowered.com/',
			'color' => '#171a21',
		),
		'storehouse' => array(
			'url'   => 'https://www.storehouse.co/',
			'color' => '#25b0e6',
		),
		'strava' => array(
			'url'   => 'https://www.strava.com/',
			'color' => '#fc4c02',
		),
		'streamjar' => array(
			'url'   => 'https://streamjar.tv/',
			'color' => '#503a60',
		),
		'stumbleupon' => array(
			'url'   => 'https://www.stumbleupon.com/',
			'color' => '#e64011',
		),
		'swarm' => array(
			'url'   => 'https://www.swarmapp.com/',
			'color' => '#fc9d3c',
		),
		'teamspeak' => array(
			'url'   => 'https://www.teamspeak.com/',
			'color' => '#465674',
		),
		'teamviewer' => array(
			'url'   => 'https://www.teamviewer.com/',
			'color' => '#168ef4',
		),
		'telegram' => array(
			'url'   => 'https://telegram.org/',
			'color' => '#0088cc',
		),
		'tripadvisor' => array(
			'url'   => 'https://www.tripadvisor.com/',
			'color' => '#4b7e37',
		),
		'tripit' => array(
			'url'   => 'https://www.tripit.com/',
			'color' => '#1982c3',
		),
		'triplej' => array(
			'url'   => 'http://www.abc.net.au/triplej/',
			'color' => '#e53531',
		),
		'tumblr' => array(
			'url'   => 'https://www.tumblr.com/',
			'color' => '#45556c',
		),
		'twitch' => array(
			'url'   => 'https://www.twitch.tv/',
			'color' => '#6441a5',
		),
		'twitter' => array(
			'url'   => 'https://twitter.com/',
			'color' => '#4da7de',
		),
		'uber' => array(
			'url'   => 'https://www.uber.com/',
			'color' => '#000000',
		),
		'ventrilo' => array(
			'url'   => 'http://www.ventrilo.com/',
			'color' => '#77808a',
		),
		'viadeo' => array(
			'url'   => 'http://viadeo.com/',
			'color' => '#e4a000',
		),
		'viber' => array(
			'url'   => 'viber://pa?chatURI=uri&text=message',
			'color' => '#7b519d',
		),
		'viewbug' => array(
			'url'   => 'https://www.viewbug.com/',
			'color' => '#2f9fcf',
		),
		'vimeo' => array(
			'url'   => 'https://vimeo.com/',
			'color' => '#51b5e7',
		),
		'vine' => array(
			'url'   => 'https://vine.co/',
			'color' => '#00b389',
		),
		'vkontakte' => array(
			'url'   => '',
			'color' => '#5a7fa6',
		),
		'warcraft' => array(
			'url'   => 'https://worldofwarcraft.com/',
			'color' => '#1eb10a',
		),
		'wechat' => array(
			'url'   => '',
			'color' => '#09b507',
		),
		'weibo' => array(
			'url'   => 'https://weibo.com/',
			'color' => '#e31c34',
		),
		'whatsapp' => array(
			'url'   => 'whatsapp://send?text=Message',
			'color' => '#20b038',
		),
		'wikipedia' => array(
			'url'   => 'https://wikipedia.org/',
			'color' => '#000000',
		),
		'windows' => array(
			'url'   => 'https://www.microsoft.com/en-us/windows/',
			'color' => '#00bdf6',
		),
		'wordpress' => array(
			'url'   => 'https://wordpress.org/',
			'color' => '#464646',
		),
		'wykop' => array(
			'url'   => 'https://www.wykop.pl/',
			'color' => '#328efe',
		),
		'xbox' => array(
			'url'   => 'https://www.xbox.com/',
			'color' => '#92c83e',
		),
		'xing' => array(
			'url'   => 'https://www.xing.com/',
			'color' => '#005a60',
		),
		'yahoo' => array(
			'url'   => 'https://www.yahoo.com/',
			'color' => '#6e2a85',
		),
		'yammer' => array(
			'url'   => 'https://www.yammer.com/',
			'color' => '#1175c4',
		),
		'yandex' => array(
			'url'   => 'https://www.yandex.com/',
			'color' => '#ff0000',
		),
		'yelp' => array(
			'url'   => 'https://www.yelp.com/',
			'color' => '#c83218',
		),
		'younow' => array(
			'url'   => 'https://www.younow.com/',
			'color' => '#61c03e',
		),
		'youtube' => array(
			'url'   => 'https://youtu.be/038jmlSH3iM',
			'color' => '#e02a20',
		),
		'zapier' => array(
			'url'   => 'https://zapier.com/',
			'color' => '#ff4a00',
		),
		'zerply' => array(
			'url'   => 'https://zerply.com/',
			'color' => '#9dbc7a',
		),
		'zomato' => array(
			'url'   => 'https://www.zomato.com/',
			'color' => '#cb202d',
		),
		'zynga' => array(
			'url'   => 'https://www.zynga.com/',
			'color' => '#dc0606',
		),
	) );
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
		'trello'                => 'trello',
		'last.fm'               => 'lastfm',
		'weixin:'               => 'wechat',
		'youtu.be'              => 'youtube',
		'fyu.se'                => 'fyuse',
		'mail.ru'               => 'mailru',
		'onsolve'               => 'codered',
		'pscp.tv'               => 'periscope',
		'angel.co'              => 'angellist',
		'nicovideo'             => 'niconico',
		'gym.openai'            => 'openaigym',
		'ycombinator'           => 'hackernews',
		'del.icio.us'           => 'delicious',
		'us.battle.net'         => 'diablo',
		'us.battle.net'         => 'heroes',
		'battle.net'            => 'battlenet',
		'blogspot.com'          => 'blogger',
		'nationalgeographic'    => 'natgeo',
		'playoverwatch'         => 'overwatch',
		'playhearthstone'       => 'hearthstone',
		'play.google.com'       => 'play',
		'maps.google.com'       => 'googlemaps',
		'plus.google.com'       => 'googleplus',
		'photos.google.com'     => 'googlephotos',
		'groups.google.com'     => 'googlegroups',
		'scholar.google.com'    => 'googlescholar',
		'calendar.google.com'   => 'googlecalendar',
		'chrome.google.com'     => 'chrome',
		'gaming.youtube.com'    => 'yt-gaming',
		'feedburner.google.com' => 'feedburner',
		'feeds.feedburner.com'  => 'feedburner',
	) );
}

/**
 * Get the default sortable socicon lists.
 * @return array
 */
function si_get_default_sortable_socicons() {
	return apply_filters( 'social_icons_get_default_sortable_socicons', array(
		'twitter' => array(
			'url'   => 'https://twitter.com/themegrill/',
			'label' => __( 'Follow Me', 'social-icons' ),
		),
		'facebook' => array(
			'url'   => 'https://facebook.com/themegrill/',
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
