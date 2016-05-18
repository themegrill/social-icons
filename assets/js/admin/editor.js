/* global tinymce */
( function() {

	/**
	 * Check is empty.
	 *
	 * @param  {string} value
	 * @return {bool}
	 */
	function siShortcodesIsEmpty( value ) {
		value = value.toString();

		if ( 0 !== value.length ) {
			return false;
		}

		return true;
	}

	/**
	 * Add the shortcodes downdown.
	 */
	tinymce.PluginManager.add( 'social_icons_shortcodes', function( editor ) {
		var ed = tinymce.activeEditor;

		editor.addButton( 'social_icons_shortcodes', {
			title : ed.getLang( 'social_icons_shortcodes.shortcode_title' ),
			icon: 'social-icons-shortcodes',
			onclick: function() {
				editor.windowManager.open({
					title: ed.getLang( 'social_icons_shortcodes.shortcode_title' ),
					body: [
						{
							type:  'textbox',
							name:  'id',
							label: ed.getLang( 'social_icons_shortcodes.id' )
						}
					],
					onsubmit: function ( e ) {
						var id = siShortcodesIsEmpty( e.data.id ) ? '' : ' id="' + e.data.id + '"';

						if ( ! siShortcodesIsEmpty( e.data.id ) ) {
							editor.insertContent( '[social_icons' + id + ']' );
						} else {
							editor.windowManager.alert( ed.getLang( 'social_icons_shortcodes.require_group_id' ) );
						}
					}
				});
			}
		});
	});
})();
