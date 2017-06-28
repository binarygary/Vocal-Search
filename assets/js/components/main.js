/**
 * Vocal Search
 * https://www.binarygary.com
 *
 * Licensed under the GPLv2+ license.
 */

window.VocalSearch = window.VocalSearch || {};

( function ( window, document, $, plugin ) {
	let $c = {};

	plugin.init = function () {
		plugin.cache();
		plugin.bindEvents();
	};

	plugin.cache = function () {
		$c.window = $( window );
		$c.body   = $( document.body );
		$c.search = $( '.search-field' );
	};

	plugin.bindEvents = function () {
		$c.search.on( 'click', $c.listen );
	};

	$c.listen = function () {
		var commands = {
			'search for *term': function ( term ) {
				$c.search.val( term );
				$( 'form.search-form' ).submit();
			}
		};

		annyang.addCommands( commands );

		annyang.start();
	};

	$( plugin.init );
}( window, document, jQuery, window.VocalSearch ) );
