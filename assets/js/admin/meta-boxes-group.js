/* global social_icons_admin_meta_boxes_group */
jQuery( function( $ ) {

	// Icon inputs
	$( '#social-icons-group-data' ).on( 'click','.sortable_icons a.insert', function() {
		$( this ).closest( '.sortable_icons' ).find( 'tr.no-items' ).remove();
		$( this ).closest( '.sortable_icons' ).find( 'tbody' ).append( $( this ).data( 'row' ) );
		return false;
	});
	$( '#social-icons-group-data' ).on( 'click','.sortable_icons a.delete', function() {
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

		if ( url.indexOf( 'feed' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-rss' );
			found = true;
		} else if ( url.indexOf( 'vk.com' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-vkontakte' );
			found = true;
		} else if ( url.indexOf( 'last.fm' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-lastfm' );
			found = true;
		} else if ( url.indexOf( 'youtu.be' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-youtube' );
			found = true;
		} else if ( url.indexOf( 'play.google.com' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-play' );
			found = true;
		} else if ( url.indexOf( 'plus.google.com' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-googleplus' );
			found = true;
		} else if ( url.indexOf( 'feedburner.google.com' ) !== -1 ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-mail' );
			found = true;
		} else {
			$( social_icons_admin_meta_boxes_group.allowed_socicons ).each( function( ix, icon ) {
				if ( url.indexOf( icon ) !== -1 ) {
					$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-' + icon );
					found = true;
					return;
				}
			});
		}

		if ( ! found ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort dashicons-plus' );
		}
	});
});
