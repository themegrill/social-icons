/* global social_icons_admin_widgets */
jQuery( function ( $ ) {

	// Hidden Options.
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

	// Add Social Icons.
	$( document.body ).on( 'click', '.social-icons-add-button button', function( e ) {
		e.preventDefault();

		var icons_list = $( this ).parents( '.widget-content' ).find( '.social-icons-list' );

		// URL and Label fields.
		var url_field_id     = icons_list.data( 'url-field-id' );
		var url_field_name   = icons_list.data( 'url-field-name' );
		var label_field_id   = icons_list.data( 'label-field-id' );
		var label_field_name = icons_list.data( 'label-field-name' );

		// URL and Label Template.
		var $tmpl = $( $.trim( $( '#tmpl-social-icons-field' ).html() ) );
		$tmpl.find( '.social-icons-field-url' ).attr( 'id', url_field_id ).attr( 'name', url_field_name + '[]' );
		$tmpl.find( '.social-icons-field-label' ).attr( 'id', label_field_id ).attr( 'name', label_field_name + '[]' );

		icons_list.append( $tmpl );
		icons_list.last().find( 'input:first-child' ).trigger( 'focus' );

		$( this ).parents( '.widget-content' ).find( '.social-icons-list:last input:first-child' ).trigger( 'focus' );
	});

	// Detect socicon from supported URL and allowed lists.
	$( document.body ).on( 'keyup', '.social-icons-field-url', function() {
		var $this = $( this ), $_socicon = false, url;

		if ( url = $this.val().toLowerCase() ) {
			$.each( social_icons_admin_widgets.supported_url_icon, function( index, icon ) {
				if ( url.indexOf( index ) !== -1 ) {
					$_socicon = icon;
					return true;
				}
			});

			if ( ! $_socicon ) {
				$.each( social_icons_admin_widgets.allowed_socicons, function( index, icon ) {
					if ( url.indexOf( icon ) !== -1 ) {
						$_socicon = icon;
						return true;
					}
				});
			}
		}

		if ( $_socicon ) {
			$( '.social-icons-add-button' ).find( 'button' ).removeAttr( 'disabled' );
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle socicon socicon-' + $_socicon );
		} else {
			$( '.social-icons-add-button' ).find( 'button' ).attr( 'disabled', 'disabled' );
			$this.parents( '.social-icons-field' ).find( '.social-icons-field-handle' ).attr( 'class', 'social-icons-field-handle dashicons dashicons-plus' );
		}
	});

	// Make repeater field siteorigin compat.
	$( document.body ).on( 'panelsopen', function( e ) {
		var target = $( e.target );

		// Check that this is for our widget class.
		if ( ! target.has( 'social-icons-list' ) ) {
			return false;
		}

		target.addClass( 'widget-content' );

		widgetSortable( target );

		// Trigger hidden options.
		$( document.body ).trigger( 'si-init-hidden-options' );
	});

	// Remove Social Icons.
	$( document.body ).on( 'click', '.social-icons-field-remove', function( e ) {
		e.preventDefault();
		$( this ).parents( '.social-icons-field' ).remove();
	});

	// Event handler for widget open button.
	$( document.body ).on( 'click', 'div.widget[id*=themegrill_social_icons] .widget-title, div.widget[id*=themegrill_social_icons] .widget-title-action', function() {
		if ( $( this ).parents( '#available-widgets' ).length ) {
			return;
		}

		widgetSortable( $( this ).parents( '.widget[id*=themegrill_social_icons]' ) );
	});

	// Event handler for widget added and updated.
	$( document ).on( 'widget-added widget-updated', function( e, widget ) {
		if ( widget.is( '[id*=themegrill_social_icons]' ) ) {
			e.preventDefault();
			widgetSortable( widget );
		}

		// Trigger hidden options.
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
