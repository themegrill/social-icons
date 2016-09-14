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
	$( '.sortable_icons tbody' ).sortable({
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
		var $this = $( this ), url = $this.val().toLowerCase(), $_socicon = false;

		// Detect from URL format.
		$.each( social_icons_admin_meta_boxes_group.detected_socicons, function( index, icon ) {
			if ( url.indexOf( index ) !== -1 ) {
				$_socicon = icon;
			}
		});

		// Detect from name.
		if ( ! $_socicon ) {
			$.each( social_icons_admin_meta_boxes_group.allowed_socicons, function( index, icon ) {
				if ( url.indexOf( icon ) !== -1 ) {
					$_socicon = icon;
				}
			});
		}

		if ( $_socicon ) {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort socicon-' + $_socicon );
		} else {
			$this.parents( 'tr' ).find( '.sort' ).attr( 'class', 'sort dashicons-plus' );
		}
	});
});
