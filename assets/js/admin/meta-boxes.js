jQuery( function ( $ ) {

	// Allow Tabbing
	$( '#titlediv' ).find( '#title' ).keyup( function( event ) {
		var code = event.keyCode || event.which;

		// Tab key
		if ( code === '9' && $( '#social-icons-group-description' ).length > 0 ) {
			event.stopPropagation();
			$( '#social-icons-group-description' ).focus();
			return false;
		}
	});

	// Tabbed Panels
	$( document.body ).on( 'si-init-tabbed-panels', function() {
		$( 'ul.si-tabs' ).show();
		$( 'ul.si-tabs a' ).click( function() {
			var panel_wrap = $( this ).closest( 'div.panel-wrap' );
			$( 'ul.si-tabs li', panel_wrap ).removeClass( 'active' );
			$( this ).parent().addClass( 'active' );
			$( 'div.panel', panel_wrap ).hide();
			$( $( this ).attr( 'href' ) ).show();
			return false;
		});
		$( 'div.panel-wrap' ).each( function() {
			$( this ).find( 'ul.si-tabs li' ).eq( 0 ).find( 'a' ).click();
		});
	}).trigger( 'si-init-tabbed-panels' );
});
