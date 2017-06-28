/**
 * Vocal Search
 * https://www.binarygary.com
 *
 * Licensed under the GPLv2+ license.
 */

window.VocalSearch = window.VocalSearch || {};

( function( window, document, $, plugin ) {
	console.log('loaded');
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

	$c.listen = function() {
		var commands = {
			'search *term': $c.search
		};

		annyang.addCommands(commands);

		annyang.start();
	};

	$c.search = function(term) {
		console.log(term);
	};

	$( plugin.init );
}( window, document, require( 'jquery' ), window.VocalSearch ) );
