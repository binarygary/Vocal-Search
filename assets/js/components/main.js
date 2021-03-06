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
	};

	plugin.cache = function () {
		$c.window  = $( window );
		$c.body    = $( document.body );
		$c.search  = $( vsSettings.search_field );
		$c.form    = $( vsSettings.search_form );
		$c.command = vsSettings.command;
	};

	plugin.bindEvents = function () {
		if (!annyang) {
			return;
		}

		console.log(vsSettings.admin_commands);

		if ( vsSettings.backend ) {
			$( document ).ready( $c.listen() );
		} else {
			$c.search.on( 'click', $c.listen );
		}
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

			admin_commands = $.map(vsSettings.admin_commands, function (value, key) { return key; });

			sorted.forEach( function( phrase ) {
				console.log(phrase);
				console.log(admin_commands);
				admin_commands.forEach( function( admin_command ) {
					if ( admin_command.toLowerCase() === phrase ) {
						window.location.href = vsSettings.admin_commands[admin_command];
					}
				} );
			});

			sorted.forEach( function( phrase ) {
				var found = phrase.indexOf( $c.command.toLowerCase() );
				if ( found !== -1 ) {
					$c.search.val( phrase.split( $c.command.toLowerCase() ).pop() );
					$c.form.submit();
				}
			});
		});
	};

	$( plugin.init );
}( window, document, jQuery, window.VocalSearch ) );
