/**
 * Mobil hamburger-menü kapcsoló. A mezőberény.hu-nak nincs gyári mobil
 * nézete - ez adja hozzá a kis képernyős navigációt, ugyanazzal a
 * "Menü" dobozzal megegyező tartalommal (lásd header.php #mb-mobile-nav).
 */
( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var toggle = document.querySelector( '.mb-mobile-nav-toggle' );
		var panel = document.getElementById( 'mb-mobile-nav' );
		if ( ! toggle || ! panel ) {
			return;
		}

		toggle.addEventListener( 'click', function () {
			var isOpen = panel.classList.toggle( 'is-open' );
			toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
			toggle.classList.toggle( 'is-active', isOpen );
		} );

		// Ablak átméretezésekor (pl. elforgatás után asztali méretre) zárjuk be a panelt.
		window.addEventListener( 'resize', function () {
			if ( window.innerWidth > 900 && panel.classList.contains( 'is-open' ) ) {
				panel.classList.remove( 'is-open' );
				toggle.setAttribute( 'aria-expanded', 'false' );
				toggle.classList.remove( 'is-active' );
			}
		} );
	} );
} )();
