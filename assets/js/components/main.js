/**
 * Vocal Search
 * https://www.binarygary.com
 *
 * Licensed under the GPLv2+ license.
 */

window.VocalSearch = window.VocalSearch || {};

( function( window, document, $, plugin ) {
	let $c = {};

	plugin.init = function() {
		plugin.cache();
		plugin.bindEvents();
	};

	plugin.cache = function() {
		$c.window = $( window );
		$c.body = $( document.body );
	};

	plugin.bindEvents = function() {
	};

	$( plugin.init );
}( window, document, require( 'jquery' ), window.VocalSearch ) );
