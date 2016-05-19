jQuery( function( $ ) {
	var social_icons = [
		'modelmayhem', 'mixcloud', 'drupal', 'swarm', 'istock', 'yammer', 'ello', 'stackoverflow', 'persona', 'triplej', 'houzz', 'rss', 'paypal', 'odnoklassniki', 'airbnb', 'periscope', 'outlook', 'coderwall', 'tripadvisor', 'appnet', 'goodreads', 'tripit', 'lanyrd', 'slideshare', 'buffer', 'disqus', 'vkontakte', 'whatsapp', 'patreon', 'storehouse', 'pocket', 'mail', 'blogger', 'technorati', 'reddit', 'dribbble', 'stumbleupon', 'digg', 'envato', 'behance', 'delicious', 'deviantart', 'forrst', 'play', 'zerply', 'wikipedia', 'apple', 'flattr', 'github', 'renren', 'friendfeed', 'newsvine', 'identica', 'bebo', 'zynga', 'steam', 'xbox', 'windows', 'qq', 'douban', 'meetup', 'playstation', 'android', 'snapchat', 'twitter', 'facebook', 'googleplus', 'pinterest', 'foursquare', 'yahoo', 'skype', 'yelp', 'feedburner', 'linkedin', 'viadeo', 'xing', 'myspace', 'soundcloud', 'spotify', 'grooveshark', 'lastfm', 'youtube', 'vimeo', 'dailymotion', 'vine', 'flickr', '500px', 'instagram', 'wordpress', 'tumblr', 'twitch', '8tracks', 'amazon', 'icq', 'smugmug', 'ravelry', 'weibo', 'baidu', 'angellist', 'ebay', 'imdb', 'stayfriends', 'residentadvisor', 'google', 'yandex', 'sharethis', 'bandcamp', 'itunes', 'deezer', 'medium', 'telegram', 'openid', 'amplement', 'viber', 'zomato', 'quora', 'draugiem', 'endomodo', 'filmweb', 'stackexchange', 'wykop', 'teamspeak', 'teamviewer', 'ventrilo', 'younow', 'raidcall', 'mumble', 'bebee', 'hitbox', 'reverbnation', 'formulr'
	];

	// Icon inputs
	$( '#social-icons-group-data' ).on( 'click','.sortable_icons a.insert', function() {
		$( this ).closest( '.sortable_icons' ).find( 'tbody' ).append( $( this ).data( 'row' ) );
		return false;
	});
	$( '#social-icons-group-data' ).on( 'click','.sortable_icons a.delete',function() {
		$( this ).closest( 'tr' ).remove();
		return false;
	});

	// Social Icons ordering
	jQuery( '.sortable_icons tbody' ).sortable({
		items: 'tr',
		cursor: 'move',
		axis: 'y',
		handle: 'td.sort',
		scrollSensitivity: 40,
		forcePlaceholderSize: true,
		helper: 'clone',
		opacity: 0.65
	});

	// Detect Social Icons from domain
	$( document.body ).on( 'keyup', 'td.social_url input[type=text]', function() {
		var $this = $( this ), url = $this.val().toLowerCase(), found = false;

		console.log( url );

		if ( url.indexOf( 'feed' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', 'si-socicons socicon-rss' );
			found = true;
		} else if ( url.indexOf( 'vk.com' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', 'si-socicons socicon-vkontakte' );
			found = true;
		} else if ( url.indexOf( 'last.fm' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', 'si-socicons socicon-lastfm' );
			found = true;
		} else if ( url.indexOf( 'youtu.be' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', 'si-socicons socicon-youtube' );
			found = true;
		} else if ( url.indexOf( 'play.google.com' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', 'si-socicons socicon-play' );
			found = true;
		} else if ( url.indexOf( 'plus.google.com' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', 'si-socicons socicon-googleplus' );
			found = true;
		} else if ( url.indexOf( 'feedburner.google.com' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', 'si-socicons socicon-mail' );
			found = true;
		} else {
			$( social_icons ).each( function( ix, icon ) {
				if ( url.indexOf( icon ) !== -1 ) {
					$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', ' si-socicons socicon-' + icon );
					found = true;
					return;
				}
			});
		}

		if ( ! found ) {
			$this.parents( 'tr' ).find( '.si-socicons' ).attr( 'class', 'si-socicons dashicons dashicons-plus' );
		}
	});
});
