/**
 * Widgets JS
 */
jQuery( function ( $ ) {
	var social_icons = [
		'modelmayhem', 'mixcloud', 'drupal', 'swarm', 'istock', 'yammer', 'ello', 'stackoverflow', 'persona', 'triplej', 'houzz', 'rss', 'paypal', 'odnoklassniki', 'airbnb', 'periscope', 'outlook', 'coderwall', 'tripadvisor', 'appnet', 'goodreads', 'tripit', 'lanyrd', 'slideshare', 'buffer', 'disqus', 'vkontakte', 'whatsapp', 'patreon', 'storehouse', 'pocket', 'mail', 'blogger', 'technorati', 'reddit', 'dribbble', 'stumbleupon', 'digg', 'envato', 'behance', 'delicious', 'deviantart', 'forrst', 'play', 'zerply', 'wikipedia', 'apple', 'flattr', 'github', 'renren', 'friendfeed', 'newsvine', 'identica', 'bebo', 'zynga', 'steam', 'xbox', 'windows', 'qq', 'douban', 'meetup', 'playstation', 'android', 'snapchat', 'twitter', 'facebook', 'googleplus', 'pinterest', 'foursquare', 'yahoo', 'skype', 'yelp', 'feedburner', 'linkedin', 'viadeo', 'xing', 'myspace', 'soundcloud', 'spotify', 'grooveshark', 'lastfm', 'youtube', 'vimeo', 'dailymotion', 'vine', 'flickr', '500px', 'instagram', 'wordpress', 'tumblr', 'twitch', '8tracks', 'amazon', 'icq', 'smugmug', 'ravelry', 'weibo', 'baidu', 'angellist', 'ebay', 'imdb', 'stayfriends', 'residentadvisor', 'google', 'yandex', 'sharethis', 'bandcamp', 'itunes', 'deezer', 'medium', 'telegram', 'openid', 'amplement'
	];

	// Hidden Options
	$( document.body ).on( 'si-init-hidden-options', function() {
		$( 'input.show_label' ).change( function() {
			var icons_list = $( this ).parents( '.widget-content' ).find( '.social-icons-list' );
			if ( $( this ).is( ':checked' ) ) {
				icons_list.removeClass( 'hide-icons-label' );
			} else {
				icons_list.addClass( 'hide-icons-label' );
			}
		}).change();
	}).trigger( 'si-init-hidden-options' );

	// Add Social Icons
	$( document.body ).on( 'click', '.social-icons-add-button button', function( e ) {
		e.preventDefault();

		var icons_list = $( this ).parents( '.widget-content' ).find( '.social-icons-list' );

		// URL and Label fields
		var url_field_id     = icons_list.data( 'url-field-id' );
		var url_field_name   = icons_list.data( 'url-field-name' );
		var label_field_id   = icons_list.data( 'label-field-id' );
		var label_field_name = icons_list.data( 'label-field-name' );

		// URL and Label Template
		var $tmpl = $( $.trim( $( '#tmpl-social-icons-field' ).html() ) );
		$tmpl.find( '.social-icons-field-url' ).attr( 'id', url_field_id ).attr( 'name', url_field_name + '[]' );
		$tmpl.find( '.social-icons-field-label' ).attr( 'id', label_field_id ).attr( 'name', label_field_name + '[]' );

		icons_list.append( $tmpl );
		icons_list.last().find( 'input:first-child' ).trigger( 'focus' );

		$( this ).parents( '.widget-content' ).find( '.social-icons-list:last input:first-child' ).trigger( 'focus' );
	});

	// Detect Social Icons from domain
	$( document.body ).on( 'keyup', '.social-icons-field-url', function() {
		var $this = $( this ), url = $this.val().toLowerCase(), found = false;

		if ( url.indexOf( 'feed' ) !== -1 ) {
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle socicon socicon-rss' );
			found = true;
		} else if ( url.indexOf( 'vk.com' ) !== -1 ) {
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle socicon socicon-vkontakte' );
			found = true;
		} else if ( url.indexOf( 'last.fm' ) !== -1 ) {
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle socicon socicon-lastfm' );
			found = true;
		} else if ( url.indexOf( 'youtu.be' ) !== -1 ) {
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle socicon socicon-youtube' );
			found = true;
		} else if ( url.indexOf( 'plus.google.com' ) !== -1 ) {
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle socicon socicon-googleplus' );
			found = true;
		} else if ( url.indexOf( 'feedburner.google.com' ) !== -1 ) {
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle socicon socicon-mail' );
			found = true;
		} else {
			$( social_icons ).each( function( ix, icon ) {
				if ( url.indexOf( icon ) !== -1 ) {
					$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle socicon socicon-' + icon );
					found = true;
					return;
				}
			});
		}

		if ( ! found ) {
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle dashicons dashicons-plus' );
			$( '.social-icons-add-button' ).find( 'button' ).attr( 'disabled', 'disabled' );
		} else {
			$( '.social-icons-add-button' ).find( 'button' ).removeAttr( 'disabled' );
		}
	});

	// Remove Social Icons
	$( document.body ).on( 'click', '.social-icons-field-remove', function( e ) {
		e.preventDefault();
		$( this ).parents( '.social-icons-field' ).remove();
	});

	// Event handler for widget open button
	$( document.body ).on( 'click', 'div.widget[id*=themegrill_social_icons] .widget-title, div.widget[id*=themegrill_social_icons] .widget-title-action', function() {
		if ( $( this ).parents( '#available-widgets' ).length ) {
			return;
		}

		widgetSortable( $( this ).parents( '.widget[id*=themegrill_social_icons]' ) );
	});

	// Event handler for widget added and updated
	$( document ).on( 'widget-added widget-updated', function( e, widget ) {
		if ( widget.is( '[id*=themegrill_social_icons]' ) ) {
			e.preventDefault();
			widgetSortable( widget );
		}

		// Trigger hidden options
		$( document.body ).trigger( 'si-init-hidden-options' );
	});

	function widgetSortable( widget ) {
		widget.find( '.social-icons-list' ).sortable({
			items: 'li',
			cursor: 'move',
			axis: 'y',
			handle: 'span.socicon',
			scrollSensitivity: 40,
			forcePlaceholderSize: true,
			helper: 'clone',
			opacity: 0.65
		});
	}
});
