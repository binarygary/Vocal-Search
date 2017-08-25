/**
 * Vocal Search
 * https://www.binarygary.com
 *
 * Licensed under the GPLv2+ license.
 */

window.VocalSearch = window.VocalSearch || {};

( function ( window, document, $, plugin ) {
	var $c = {};

	plugin.init = function () {
		plugin.cache();
		plugin.bindEvents();
		console.log(vsSettings);
	};

	plugin.cache = function () {
		$c.window  = $( window );
		$c.body    = $( document.body );
		$c.search  = $( vsSettings.search_field );
		$c.form    = $( vsSettings.search_form );
		$c.command = vsSettings.command;
	};

	plugin.bindEvents = function () {
		$c.search.on( 'click', $c.listen );
	};

	$c.listen = function () {
		var commands = {
			'*term' : function ( term ) {
				annyang.resume();
			}
		};

		annyang.addCommands( commands );

		annyang.start();

		annyang.addCallback('resultMatch', function(userSaid, commandText, phrases) {
			var sorted = [];
			for (var i = 0; i < phrases.length; i++) {
				sorted.push(phrases[i].toLowerCase());
			}
			sorted.sort();

			sorted.forEach( function( phrase ) {
				var found = phrase.indexOf( $c.command.toLowerCase() );
				if ( found !== -1 ) {
					console.log( $c.command.substr( found ) );
					$c.search.val( found );
					$c.search.form.submit();
				}
			});
		});
	};

	$( plugin.init );
}( window, document, jQuery, window.VocalSearch ) );
