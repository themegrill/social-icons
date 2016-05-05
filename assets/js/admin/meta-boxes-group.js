jQuery( function( $ ) {

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
});
