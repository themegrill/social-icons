<?php
/**
 * Socicon
 *
 * @version 1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Get socicon.
 *
 * @param  string $icon Icon name.
 * @param  string $type Icon type.
 * @return array
 */
function get_socicon( $icon = '', $type = 'color' ) {
	$socicons = array(
		'hackerone' => array(
			'url'   => 'https://www.hackerone.com/',
			'color' => '#ec1075',
			'label' => '',
		),
		'beatport' => array(
			'url'   => 'https://www.beatport.com/',
			'color' => '#94d500',
			'label' => '',
		),
		'napster' => array(
			'url'   => 'https://www.napster.com/',
			'color' => '#000000',
			'label' => '',
		),
		'spip' => array(
			'url'   => 'https://www.spip.net/',
			'color' => '#E00D6F',
			'label' => '',
		),
		'wickr' => array(
			'url'   => 'https://wickr.com/',
			'color' => '#F29100',
			'label' => '',
		),
		'blackberry' => array(
			'url'   => 'https://blackberry.com/',
			'color' => '#000000',
			'label' => '',
		),
		'pixiv' => array(
			'url'   => 'https://www.pixiv.net/',
			'color' => '#049CFF',
			'label' => '',
		),
		'myanimelist' => array(
			'url'   => 'https://myanimelist.net/',
			'color' => '#2e51a2',
			'label' => '',
		),
		'gamefor' => array(
			'url'   => 'https://iamgamefor.com/',
			'color' => '#506F82',
			'label' => '',
		),
		'traxsource' => array(
			'url'   => 'https://www.traxsource.com/',
			'color' => '#40A0FF',
			'label' => '',
		),
		'indiedb' => array(
			'url'   => 'https://www.indiedb.com/',
			'color' => '#77C628',
			'label' => '',
		),
		'moddb' => array(
			'url'   => 'https://www.moddb.com/',
			'color' => '#CC0300',
			'label' => '',
		),
		'hackernews' => array(
			'url'   => 'https://news.ycombinator.com/',
			'color' => '#FF6601',
			'label' => '',
		),
		'smashwords' => array(
			'url'   => 'https://www.smashwords.com/',
			'color' => '#4181C3',
			'label' => '',
		),
		'kobo' => array(
			'url'   => 'https://www.kobo.com/',
			'color' => '#BF0000',
			'label' => '',
		),
		'bookbub' => array(
			'url'   => 'https://www.bookbub.com/',
			'color' => '#E70005',
			'label' => '',
		),
		'mailru' => array(
			'url'   => 'https://news.mail.ru/',
			'color' => '#FDA840',
			'label' => '',
		),
		'gitlab' => array(
			'url'   => 'https://gitlab.com/',
			'color' => '#e65228',
			'label' => '',
		),
		'instructables' => array(
			'url'   => 'https://www.instructables.com/',
			'color' => '#f8b514',
			'label' => '',
		),
		'portfolio' => array(
			'url'   => 'https://www.myportfolio.com/',
			'color' => '#54AFFF',
			'label' => '',
		),
		'codered' => array(
			'url'   => 'https://www.onsolve.com/',
			'color' => '#466eb5',
			'label' => '',
		),
		'origin' => array(
			'url'   => 'https://www.origin.com/',
			'color' => '#F56C2E',
			'label' => '',
		),
		'nextdoor' => array(
			'url'   => 'https://nextdoor.com/',
			'color' => '#01B247',
			'label' => '',
		),
		'udemy' => array(
			'url'   => 'https://www.udemy.com/',
			'color' => '#17aa1c',
			'label' => '',
		),
		'udemy' => array(
			'url'   => 'https://www.udemy.com/',
			'color' => '#ec5252',
			'label' => '',
		),
		'livemaster' => array(
			'url'   => 'https://www.livemaster.com/',
			'color' => '#e76d00',
			'label' => '',
		),
		'crunchbase' => array(
			'url'   => 'https://www.crunchbase.com/',
			'color' => '#0288d1',
			'label' => '',
		),
		'homefy' => array(
			'url'   => 'https://www.homefy.com/',
			'color' => '#ffd100',
			'label' => '',
		),
		'calendly' => array(
			'url'   => 'https://calendly.com/',
			'color' => '#00a3fa',
			'label' => '',
		),
		'realtor' => array(
			'url'   => 'https://www.realtor.com/',
			'color' => '#D52228',
			'label' => '',
		),
		'tidal' => array(
			'url'   => 'http://tidal.com/',
			'color' => '#01FFFF',
			'label' => '',
		),
		'qobuz' => array(
			'url'   => 'https://www.qobuz.com/',
			'color' => '#298FBF',
			'label' => '',
		),
		'natgeo' => array(
			'url'   => 'https://www.nationalgeographic.com/',
			'color' => '#222222',
			'label' => '',
		),
		'mastodon' => array(
			'url'   => 'https://mastodon.social/',
			'color' => '#2986D6',
			'label' => '',
		),
		'unsplash' => array(
			'url'   => 'https://unsplash.com/',
			'color' => '#000000',
			'label' => '',
		),
		'homeadvisor' => array(
			'url'   => 'https://www.homeadvisor.com/',
			'color' => '#EF8B1D',
			'label' => '',
		),
		'angieslist' => array(
			'url'   => 'https://www.angieslist.com/',
			'color' => '#299F37',
			'label' => '',
		),
		'codepen' => array(
			'url'   => 'https://codepen.io/',
			'color' => '#000000',
			'label' => '',
		),
		'slack' => array(
			'url'   => 'https://slack.com/',
			'color' => '#4B6BC6',
			'label' => '',
		),
		'openaigym' => array(
			'url'   => 'https://gym.openai.com/',
			'color' => '#29A8B3',
			'label' => '',
		),
		'logmein' => array(
			'url'   => 'https://www.logmein.com/',
			'color' => '#45B6F3',
			'label' => '',
		),
		'fiverr' => array(
			'url'   => '',
			'color' => '#0DB62A',
			'label' => '',
		),
		'gotomeeting' => array(
			'url'   => 'https://www.gotomeeting.com/',
			'color' => '#FD7A2B',
			'label' => '',
		),
		'aliexpress' => array(
			'url'   => 'https://www.aliexpress.com/',
			'color' => '#E92C00',
			'label' => '',
		),
		'guru' => array(
			'url'   => 'https://www.guru.com/',
			'color' => '#4C81C0',
			'label' => '',
		),
		'appstore' => array(
			'url'   => '', // Not found.
			'color' => '#007AFF',
			'label' => '',
		),
		'homes' => array(
			'url'   => 'https://www.homes.com/',
			'color' => '#F7841B',
			'label' => '',
		),
		'zoom' => array(
			'url'   => 'https://zoom.us/',
			'color' => '#F7841B',
			'label' => '',
		),
		'alibaba' => array(
			'url'   => 'https://www.alibaba.com/',
			'color' => '#FF6A00',
			'label' => '',
		),
		'craigslist' => array(
			'url'   => 'https://www.craigslist.org/',
			'color' => '#561A8B',
			'label' => '',
		),
		'wix' => array(
			'url'   => 'http://www.wix.com/',
			'color' => '#0096FF',
			'label' => '',
		),
		'redfin' => array(
			'url'   => 'https://www.redfin.com/',
			'color' => '#C82022',
			'label' => '',
		),
		'googlecalendar' => array(
			'url'   => 'https://calendar.google.com/',
			'color' => '#3D81F6',
			'label' => '',
		),
		'shopify' => array(
			'url'   => 'https://www.shopify.com/',
			'color' => '#5C6AC4',
			'label' => '',
		),
		'freelancer' => array(
			'url'   => 'https://www.freelancer.com/',
			'color' => '#0088CA',
			'label' => '',
		),
		'seedrs' => array(
			'url'   => 'https://www.seedrs.com/',
			'color' => '#7FBB31',
			'label' => '',
		),
		'bing' => array(
			'url'   => 'https://www.bing.com/',
			'color' => '#008485',
			'label' => '',
		),
		'doodle' => array(
			'url'   => 'https://doodle.com/',
			'color' => '#0064DC',
			'label' => '',
		),
		'bonanza' => array(
			'url'   => 'https://www.bonanza.com/',
			'color' => '#62764A',
			'label' => '',
		),
		'squarespace' => array(
			'url'   => 'https://www.squarespace.com/',
			'color' => '#121212',
			'label' => '',
		),
		'toptal' => array(
			'url'   => 'https://www.toptal.com/',
			'color' => '#4C73AA',
			'label' => '',
		),
		'gust' => array(
			'url'   => 'https://gust.com/',
			'color' => '#1E2E3E',
			'label' => '',
		),
		'ask' => array(
			'url'   => 'https://www.ask.com/',
			'color' => '#CF0000',
			'label' => '',
		),
		'trulia' => array(
			'url'   => 'https://www.trulia.com/',
			'color' => '#20BF63',
			'label' => '',
		),
		'loomly' => array(
			'url'   => 'https://www.loomly.com/',
			'color' => '#00425f',
			'label' => '',
		),
		'ghost' => array(
			'url'   => 'https://ghost.org/',
			'color' => '#33393C',
			'label' => '',
		),
		'upwork' => array(
			'url'   => 'https://www.upwork.com/',
			'color' => '#5BBC2F',
			'label' => '',
		),
		'fundable' => array(
			'url'   => 'https://www.fundable.com/',
			'color' => '#1d181f',
			'label' => '',
		),
		'booking' => array(
			'url'   => 'https://www.booking.com/',
			'color' => '#003580',
			'label' => '',
		),
		'googlemaps' => array(
			'url'   => 'https://maps.google.com/',
			'color' => '#4285F4',
			'label' => '',
		),
		'zillow' => array(
			'url'   => 'https://www.zillow.com/',
			'color' => '#0074e4',
			'label' => '',
		),
		'niconico' => array(
			'url'   => 'http://www.nicovideo.jp/',
			'color' => '#000000',
			'label' => '',
		),
		'toneden' => array(
			'url'   => 'https://www.toneden.io/',
			'color' => '#777BF9',
			'label' => '',
		),
		'augment' => array(
			'url'   => 'http://www.augment.com/',
			'color' => '#E71204',
			'label' => '',
		),
		'bitbucket' => array(
			'url'   => 'https://bitbucket.org/',
			'color' => '#243759',
			'label' => '',
		),
		'fyuse' => array(
			'url'   => 'https://fyu.se/',
			'color' => '#FF3143',
			'label' => '',
		),
		'yt-gaming' => array(
			'url'   => 'https://gaming.youtube.com/',
			'color' => '#E91D00',
			'label' => '',
		),
		'sketchfab' => array(
			'url'   => 'https://sketchfab.com/',
			'color' => '#00A5D6',
			'label' => '',
		),
		'mobcrush' => array(
			'url'   => 'https://www.mobcrush.com/',
			'color' => '#FFEE00',
			'label' => '',
		),
		'microsoft' => array(
			'url'   => 'https://www.microsoft.com/',
			'color' => '#666666',
			'label' => '',
		),
		'pandora' => array(
			'url'   => 'http://www.pandora.net/',
			'color' => '#224099',
			'label' => '',
		),
		'messenger' => array(
			'url'   => 'https://www.messenger.com/',
			'color' => '#0084ff',
			'label' => '',
		),
		'gamewisp' => array(
			'url'   => 'https://gamewisp.com/',
			'color' => '#F8A853',
			'label' => '',
		),
		'bloglovin' => array(
			'url'   => 'https://www.bloglovin.com/',
			'color' => '#000000',
			'label' => '',
		),
		'tunein' => array(
			'url'   => 'https://tunein.com/',
			'color' => '#36b4a7',
			'label' => '',
		),
		'gamejolt' => array(
			'url'   => 'https://gamejolt.com/',
			'color' => '#191919',
			'label' => '',
		),
		'trello' => array(
			'url'   => 'https://trello.com/',
			'color' => '#0079bf',
			'label' => '',
		),
		'spreadshirt' => array(
			'url'   => 'https://www.spreadshirt.com/',
			'color' => '#00b2a6',
			'label' => '',
		),
		'500px' => array(
			'url'   => 'https://500px.com/',
			'color' => '#58a9de',
			'label' => '',
		),
		'8tracks' => array(
			'url'   => 'https://8tracks.com/',
			'color' => '#122c4b',
			'label' => '',
		),
		'airbnb' => array(
			'url'   => 'https://www.airbnb.com/',
			'color' => '#ff5a5f',
			'label' => '',
		),
		'alliance' => array(
			'url'   => 'https://alliance.com/',
			'color' => '#144587',
			'label' => '',
		),
		'amazon' => array(
			'url'   => 'https://www.amazon.com/',
			'color' => '#ff9900',
			'label' => '',
		),
		'amplement' => array(
			'url'   => 'https://www.amplement.com/',
			'color' => '#0996c3',
			'label' => '',
		),
		'android' => array(
			'url'   => 'https://www.android.com/',
			'color' => '#8ec047',
			'label' => '',
		),
		'angellist' => array(
			'url'   => 'https://angel.co/',
			'color' => '#000000',
			'label' => '',
		),
		'apple' => array(
			'url'   => 'https://www.apple.com/',
			'color' => '#b9bfc1',
			'label' => '',
		),
		'appnet' => array(
			'url'   => 'https://www.appnet.com/',
			'color' => '#494949',
			'label' => '',
		),
		'baidu' => array(
			'url'   => 'http://www.baidu.com/',
			'color' => '#2629d9',
			'label' => '',
		),
		'bandcamp' => array(
			'url'   => 'https://bandcamp.com/',
			'color' => '#619aa9',
			'label' => '',
		),
		'battlenet' => array(
			'url'   => 'https://us.battle.net/',
			'color' => '#0096CD',
			'label' => '',
		),
		'mixer' => array(
			'url'   => 'https://mixer.com/',
			'color' => '#1FBAED',
			'label' => '',
		),
		'bebee' => array(
			'url'   => 'https://www.bebee.com/',
			'color' => '#f28f16',
			'label' => '',
		),
		'bebo' => array(
			'url'   => 'https://bebo.com/',
			'color' => '#ef1011',
			'label' => '',
		),
		'behance' => array(
			'url'   => 'https://www.behance.net/',
			'color' => '#000000',
			'label' => '',
		),
		'blizzard' => array(
			'url'   => 'https://www.blizzard.com/',
			'color' => '#01b2f1',
			'label' => '',
		),
		'blogger' => array(
			'url'   => 'https://www.blogger.com/',
			'color' => '#ec661c',
			'label' => '',
		),
		'buffer' => array(
			'url'   => 'https://buffer.com/',
			'color' => '#000000',
			'label' => '',
		),
		'chrome' => array(
			'url'   => 'https://chrome.google.com/',
			'color' => '#757575',
			'label' => '',
		),
		'coderwall' => array(
			'url'   => 'https://coderwall.com/',
			'color' => '#3e8dcc',
			'label' => '',
		),
		'curse' => array(
			'url'   => 'https://www.curse.com/',
			'color' => '#f26522',
			'label' => '',
		),
		'dailymotion' => array(
			'url'   => 'http://www.dailymotion.com/',
			'color' => '#004e72',
			'label' => '',
		),
		'deezer' => array(
			'url'   => 'https://www.deezer.com/',
			'color' => '#32323d',
			'label' => '',
		),
		'delicious' => array(
			'url'   => 'https://del.icio.us/',
			'color' => '#020202',
			'label' => '',
		),
		'deviantart' => array(
			'url'   => 'https://www.deviantart.com/',
			'color' => '#c5d200',
			'label' => '',
		),
		'diablo' => array(
			'url'   => 'http://us.battle.net/',
			'color' => '#8b1209',
			'label' => '',
		),
		'digg' => array(
			'url'   => 'http://digg.com/',
			'color' => '#1d1d1b',
			'label' => '',
		),
		'discord' => array(
			'url'   => 'https://discordapp.com/',
			'color' => '#7289da',
			'label' => '',
		),
		'disqus' => array(
			'url'   => 'https://disqus.com/',
			'color' => '#2e9fff',
			'label' => '',
		),
		'douban' => array(
			'url'   => 'https://www.douban.com/',
			'color' => '#3ca353',
			'label' => '',
		),
		'draugiem' => array(
			'url'   => 'https://www.draugiem.lv/',
			'color' => '#ffa32b',
			'label' => '',
		),
		'dribbble' => array(
			'url'   => 'https://dribbble.com/',
			'color' => '#e84d88',
			'label' => '',
		),
		'drupal' => array(
			'url'   => 'https://www.drupal.org/',
			'color' => '#00598e',
			'label' => '',
		),
		'ebay' => array(
			'url'   => 'https://www.ebay.com/',
			'color' => '#333333',
			'label' => '',
		),
		'ello' => array(
			'url'   => 'https://ello.co/',
			'color' => '#000000',
			'label' => '',
		),
		'endomondo' => array(
			'url'   => 'https://www.endomondo.com/',
			'color' => '#86ad00',
			'label' => '',
		),
		'envato' => array(
			'url'   => 'https://envato.com/',
			'color' => '#597c3a',
			'label' => '',
		),
		'etsy' => array(
			'url'   => 'https://www.etsy.com/',
			'color' => '#f56400',
			'label' => '',
		),
		'facebook' => array(
			'url'   => 'https://www.facebook.com/',
			'color' => '#3e5b98',
			'label' => __( 'Friend me on Facebook', 'social-icons' ),
		),
		'feedburner' => array(
			'url'   => 'https://feedburner.google.com/',
			'color' => '#ffcc00',
			'label' => '',
		),
		'filmweb' => array(
			'url'   => 'http://www.filmweb.pl/',
			'color' => '#ffc404',
			'label' => '',
		),
		'firefox' => array(
			'url'   => 'https://www.mozilla.org/en-US/firefox/',
			'color' => '#484848',
			'label' => '',
		),
		'flattr' => array(
			'url'   => 'https://flattr.com/',
			'color' => '#f67c1a',
			'label' => '',
		),
		'flickr' => array(
			'url'   => 'https://www.flickr.com/',
			'color' => '#1e1e1b',
			'label' => '',
		),
		'formulr' => array(
			'url'   => 'https://www.formulr.tv/',
			'color' => '#ff5a60',
			'label' => '',
		),
		'foursquare' => array(
			'url'   => 'https://foursquare.com/',
			'color' => '#f94877',
			'label' => '',
		),
		'github' => array(
			'url'   => 'https://github.com/',
			'color' => '#221e1b',
			'label' => '',
		),
		'goodreads' => array(
			'url'   => 'https://www.goodreads.com/',
			'color' => '#463020',
			'label' => '',
		),
		'google' => array(
			'url'   => 'https://www.google.com/',
			'color' => '#4285f4',
			'label' => '',
		),
		'googlescholar' => array(
			'url'   => 'https://scholar.google.com/',
			'color' => '#4285f4',
			'label' => '',
		),
		'googlegroups' => array(
			'url'   => 'https://groups.google.com/',
			'color' => '#4f8ef5',
			'label' => '',
		),
		'googlephotos' => array(
			'url'   => 'https://photos.google.com/',
			'color' => '#212121',
			'label' => '',
		),
		'googleplus' => array(
			'url'   => 'https://plus.google.com/',
			'color' => '#dd4b39',
			'label' => '',
		),
		'grooveshark' => array(
			'url'   => 'http://groovesharks.im/',
			'color' => '#000000',
			'label' => '',
		),
		'hackerrank' => array(
			'url'   => 'https://www.hackerrank.com/',
			'color' => '#2ec866',
			'label' => '',
		),
		'hearthstone' => array(
			'url'   => 'https://playhearthstone.com/',
			'color' => '#ec9313',
			'label' => '',
		),
		'hellocoton' => array(
			'url'   => 'http://www.hellocoton.fr/',
			'color' => '#d30d66',
			'label' => '',
		),
		'heroes' => array(
			'url'   => 'http://us.battle.net/',
			'color' => '#2397f7',
			'label' => '',
		),
		'smashcast' => array(
			'url'   => 'https://www.smashcast.tv/',
			'color' => '#000000',
			'label' => '',
		),
		'horde' => array(
			'url'   => 'https://www.horde.org/',
			'color' => '#84121c',
			'label' => '',
		),
		'houzz' => array(
			'url'   => 'https://www.houzz.com/',
			'color' => '#7cc04b',
			'label' => '',
		),
		'icq' => array(
			'url'   => 'https://icq.com/',
			'color' => '#7ebd00',
			'label' => '',
		),
		'identica' => array(
			'url'   => 'http://www.identica.co.uk/',
			'color' => '#000000',
			'label' => '',
		),
		'imdb' => array(
			'url'   => 'http://www.imdb.com/',
			'color' => '#e8ba00',
			'label' => '',
		),
		'instagram' => array(
			'url'   => 'https://www.instagram.com/',
			'color' => '#9c7c6e',
			'label' => '',
		),
		'issuu' => array(
			'url'   => 'https://issuu.com/',
			'color' => '#f26f61',
			'label' => '',
		),
		'istock' => array(
			'url'   => 'https://www.istockphoto.com/',
			'color' => '#000000',
			'label' => '',
		),
		'itunes' => array(
			'url'   => 'https://www.itunes.com/',
			'color' => '#ff5e51',
			'label' => '',
		),
		'keybase' => array(
			'url'   => 'https://keybase.io/',
			'color' => '#ff7100',
			'label' => '',
		),
		'lanyrd' => array(
			'url'   => 'http://lanyrd.com/',
			'color' => '#3c80c9',
			'label' => '',
		),
		'lastfm' => array(
			'url'   => 'https://www.last.fm/',
			'color' => '#d41316',
			'label' => '',
		),
		'line' => array(
			'url'   => 'https://line.me/',
			'color' => '#00b901',
			'label' => '',
		),
		'linkedin' => array(
			'url'   => 'https://www.linkedin.com/',
			'color' => '#3371b7',
			'label' => '',
		),
		'livejournal' => array(
			'url'   => 'https://www.livejournal.com/',
			'color' => '#0099cc',
			'label' => '',
		),
		'lyft' => array(
			'url'   => 'https://www.lyft.com/',
			'color' => '#ff00bf',
			'label' => '',
		),
		'macos' => array(
			'url'   => 'https://macos.com/',
			'color' => '#000000',
			'label' => '',
		),
		'mail' => array(
			'url'   => 'mail@domain.com',
			'color' => '#000000',
			'label' => '',
		),
		'medium' => array(
			'url'   => 'https://medium.com/',
			'color' => '#000000',
			'label' => '',
		),
		'meetup' => array(
			'url'   => 'https://www.meetup.com/',
			'color' => '#e2373c',
			'label' => '',
		),
		'mixcloud' => array(
			'url'   => 'https://www.mixcloud.com/',
			'color' => '#000000',
			'label' => '',
		),
		'modelmayhem' => array(
			'url'   => 'https://www.modelmayhem.com/',
			'color' => '#000000',
			'label' => '',
		),
		'mumble' => array(
			'url'   => 'https://www.mumble.com/',
			'color' => '#5ab5d1',
			'label' => '',
		),
		'myspace' => array(
			'url'   => 'https://myspace.com/',
			'color' => '#323232',
			'label' => '',
		),
		'nintendo' => array(
			'url'   => 'https://www.nintendo.com/',
			'color' => '#f58a33',
			'label' => '',
		),
		'npm' => array(
			'url'   => 'https://www.npmjs.com/',
			'color' => '#C12127',
			'label' => '',
		),
		'odnoklassniki' => array(
			'url'   => 'https://ok.ru/',
			'color' => '#f48420',
			'label' => '',
		),
		'openid' => array(
			'url'   => 'http://openid.net/',
			'color' => '#f78c40',
			'label' => '',
		),
		'opera' => array(
			'url'   => 'http://www.opera.com/',
			'color' => '#ff1b2d',
			'label' => '',
		),
		'outlook' => array(
			'url'   => 'https://outlook.live.com/',
			'color' => '#0072c6',
			'label' => '',
		),
		'overwatch' => array(
			'url'   => 'https://playoverwatch.com/',
			'color' => '#9e9e9e',
			'label' => '',
		),
		'patreon' => array(
			'url'   => 'https://www.patreon.com/',
			'color' => '#e44727',
			'label' => '',
		),
		'paypal' => array(
			'url'   => 'https://www.paypal.com/',
			'color' => '#009cde',
			'label' => '',
		),
		'periscope' => array(
			'url'   => 'https://www.pscp.tv/',
			'color' => '#3aa4c6',
			'label' => '',
		),
		'pinterest' => array(
			'url'   => 'https://www.pinterest.com/',
			'color' => '#c92619',
			'label' => '',
		),
		'play' => array(
			'url'   => 'https://play.google.com/',
			'color' => '#000000',
			'label' => '',
		),
		'player' => array(
			'url'   => 'https://player.me/',
			'color' => '#6e41bd',
			'label' => '',
		),
		'playstation' => array(
			'url'   => 'https://www.playstation.com/',
			'color' => '#000000',
			'label' => '',
		),
		'pocket' => array(
			'url'   => 'https://getpocket.com/',
			'color' => '#ed4055',
			'label' => '',
		),
		'qq' => array(
			'url'   => 'https://en.mail.qq.com/',
			'color' => '#4297d3',
			'label' => '',
		),
		'quora' => array(
			'url'   => 'https://www.quora.com/',
			'color' => '#cb202d',
			'label' => '',
		),
		'raidcall' => array(
			'url'   => 'http://www.raidcall.com.ru/',
			'color' => '#073558',
			'label' => '',
		),
		'ravelry' => array(
			'url'   => 'https://www.ravelry.com/',
			'color' => '#b6014c',
			'label' => '',
		),
		'reddit' => array(
			'url'   => 'https://www.reddit.com/',
			'color' => '#e74a1e',
			'label' => '',
		),
		'renren' => array(
			'url'   => 'http://www.renren-inc.com/',
			'color' => '#2266b0',
			'label' => '',
		),
		'researchgate' => array(
			'url'   => 'https://www.researchgate.net/',
			'color' => '#00ccbb',
			'label' => '',
		),
		'residentadvisor' => array(
			'url'   => 'https://www.residentadvisor.net/',
			'color' => '#b3be1b',
			'label' => '',
		),
		'reverbnation' => array(
			'url'   => 'https://www.reverbnation.com/',
			'color' => '#000000',
			'label' => '',
		),
		'rss' => array(
			'url'   => 'https://woocommerce.io/feed/',
			'color' => '#f26109',
			'label' => '',
		),
		'sharethis' => array(
			'url'   => 'http://platform-api.sharethis.com/js/sharethis.js',
			'color' => '#01bf01',
			'label' => '',
		),
		'skype' => array(
			'url'   => 'skype:username?chat',
			'color' => '#28abe3',
			'label' => '',
		),
		'slideshare' => array(
			'url'   => 'https://www.slideshare.net/',
			'color' => '#4ba3a6',
			'label' => '',
		),
		'smugmug' => array(
			'url'   => 'https://www.smugmug.com/',
			'color' => '#acfd32',
			'label' => '',
		),
		'snapchat' => array(
			'url'   => 'https://www.snapchat.com/',
			'color' => '#fffa37',
			'label' => '',
		),
		'songkick' => array(
			'url'   => 'https://www.songkick.com/',
			'color' => '#f80046',
			'label' => '',
		),
		'soundcloud' => array(
			'url'   => 'https://soundcloud.com/',
			'color' => '#fe3801',
			'label' => '',
		),
		'spotify' => array(
			'url'   => 'https://www.spotify.com/',
			'color' => '#7bb342',
			'label' => '',
		),
		'stackexchange' => array(
			'url'   => 'https://stackexchange.com/',
			'color' => '#2f2f2f',
			'label' => '',
		),
		'stackoverflow' => array(
			'url'   => 'https://stackoverflow.com/',
			'color' => '#fd9827',
			'label' => '',
		),
		'starcraft' => array(
			'url'   => 'https://starcraft2.com/',
			'color' => '#002250',
			'label' => '',
		),
		'stayfriends' => array(
			'url'   => 'https://www.stayfriends.com/',
			'color' => '#f08a1c',
			'label' => '',
		),
		'steam' => array(
			'url'   => 'http://store.steampowered.com/',
			'color' => '#171a21',
			'label' => '',
		),
		'storehouse' => array(
			'url'   => 'https://www.storehouse.co/',
			'color' => '#25b0e6',
			'label' => '',
		),
		'strava' => array(
			'url'   => 'https://www.strava.com/',
			'color' => '#fc4c02',
			'label' => '',
		),
		'streamjar' => array(
			'url'   => 'https://streamjar.tv/',
			'color' => '#503a60',
			'label' => '',
		),
		'stumbleupon' => array(
			'url'   => 'https://www.stumbleupon.com/',
			'color' => '#e64011',
			'label' => '',
		),
		'swarm' => array(
			'url'   => 'https://www.swarmapp.com/',
			'color' => '#fc9d3c',
			'label' => '',
		),
		'teamspeak' => array(
			'url'   => 'https://www.teamspeak.com/',
			'color' => '#465674',
			'label' => '',
		),
		'teamviewer' => array(
			'url'   => 'https://www.teamviewer.com/',
			'color' => '#168ef4',
			'label' => '',
		),
		'telegram' => array(
			'url'   => 'https://telegram.org/',
			'color' => '#0088cc',
			'label' => '',
		),
		'tripadvisor' => array(
			'url'   => 'https://www.tripadvisor.com/',
			'color' => '#4b7e37',
			'label' => '',
		),
		'tripit' => array(
			'url'   => 'https://www.tripit.com/',
			'color' => '#1982c3',
			'label' => '',
		),
		'triplej' => array(
			'url'   => 'http://www.abc.net.au/triplej/',
			'color' => '#e53531',
			'label' => '',
		),
		'tumblr' => array(
			'url'   => 'https://www.tumblr.com/',
			'color' => '#45556c',
			'label' => '',
		),
		'twitch' => array(
			'url'   => 'https://www.twitch.tv/',
			'color' => '#6441a5',
			'label' => '',
		),
		'twitter' => array(
			'url'   => 'https://twitter.com/',
			'color' => '#4da7de',
			'label' => __( 'Follow Me', 'social-icons' ),
		),
		'uber' => array(
			'url'   => 'https://www.uber.com/',
			'color' => '#000000',
			'label' => '',
		),
		'ventrilo' => array(
			'url'   => 'http://www.ventrilo.com/',
			'color' => '#77808a',
			'label' => '',
		),
		'viadeo' => array(
			'url'   => 'http://viadeo.com/',
			'color' => '#e4a000',
			'label' => '',
		),
		'viber' => array(
			'url'   => 'viber://pa?chatURI=uri&text=message',
			'color' => '#7b519d',
			'label' => '',
		),
		'viewbug' => array(
			'url'   => 'https://www.viewbug.com/',
			'color' => '#2f9fcf',
			'label' => '',
		),
		'vimeo' => array(
			'url'   => 'https://vimeo.com/',
			'color' => '#51b5e7',
			'label' => '',
		),
		'vine' => array(
			'url'   => 'https://vine.co/',
			'color' => '#00b389',
			'label' => '',
		),
		'vkontakte' => array(
			'url'   => '',
			'color' => '#5a7fa6',
			'label' => '',
		),
		'warcraft' => array(
			'url'   => 'https://worldofwarcraft.com/',
			'color' => '#1eb10a',
			'label' => '',
		),
		'wechat' => array(
			'url'   => '',
			'color' => '#09b507',
			'label' => '',
		),
		'weibo' => array(
			'url'   => 'https://weibo.com/',
			'color' => '#e31c34',
			'label' => '',
		),
		'whatsapp' => array(
			'url'   => 'whatsapp://send?text=Message',
			'color' => '#20b038',
			'label' => '',
		),
		'wikipedia' => array(
			'url'   => 'https://wikipedia.org/',
			'color' => '#000000',
			'label' => '',
		),
		'windows' => array(
			'url'   => 'https://www.microsoft.com/en-us/windows/',
			'color' => '#00bdf6',
			'label' => '',
		),
		'wordpress' => array(
			'url'   => 'https://wordpress.org/',
			'color' => '#464646',
			'label' => '',
		),
		'wykop' => array(
			'url'   => 'https://www.wykop.pl/',
			'color' => '#328efe',
			'label' => '',
		),
		'xbox' => array(
			'url'   => 'https://www.xbox.com/',
			'color' => '#92c83e',
			'label' => '',
		),
		'xing' => array(
			'url'   => 'https://www.xing.com/',
			'color' => '#005a60',
			'label' => '',
		),
		'yahoo' => array(
			'url'   => 'https://www.yahoo.com/',
			'color' => '#6e2a85',
			'label' => '',
		),
		'yammer' => array(
			'url'   => 'https://www.yammer.com/',
			'color' => '#1175c4',
			'label' => '',
		),
		'yandex' => array(
			'url'   => 'https://www.yandex.com/',
			'color' => '#ff0000',
			'label' => '',
		),
		'yelp' => array(
			'url'   => 'https://www.yelp.com/',
			'color' => '#c83218',
			'label' => '',
		),
		'younow' => array(
			'url'   => 'https://www.younow.com/',
			'color' => '#61c03e',
			'label' => '',
		),
		'youtube' => array(
			'url'   => 'https://youtu.be/038jmlSH3iM',
			'color' => '#e02a20',
			'label' => '',
		),
		'zapier' => array(
			'url'   => 'https://zapier.com/',
			'color' => '#ff4a00',
			'label' => '',
		),
		'zerply' => array(
			'url'   => 'https://zerply.com/',
			'color' => '#9dbc7a',
			'label' => '',
		),
		'zomato' => array(
			'url'   => 'https://www.zomato.com/',
			'color' => '#cb202d',
			'label' => '',
		),
		'zynga' => array(
			'url'   => 'https://www.zynga.com/',
			'color' => '#dc0606',
			'label' => '',
		),
	);

	if ( empty( $icon ) ) {
		return apply_filters( 'get_socicons_list', array_keys( $socicons ) );
	} elseif ( isset( $socicons[ $icon ][ $type ] ) ) {
		return apply_filters( 'get_socicon-' . $icon, $socicons[ $icon ][ $type ] );
	}

	return false;
}
