/**
 * Kisegítő eszköztár: betűméret, kontrasztos nézet, szövegtávolság, alaphelyzet.
 * A beállítást a böngésző menti (localStorage); ha az nem érhető el
 * (privát mód, tiltott tárhely), az eszközök a lap betöltéséig működnek.
 * A mentett állapotot a <head>-ben lévő rövid szkript (inc/accessibility.php)
 * már betöltés előtt alkalmazza, itt csak a vezérlők állapotát szinkronizáljuk.
 */
( function () {
	'use strict';

	var KEYS = { font: 'mb-font-size', contrast: 'mb-contrast', spacing: 'mb-spacing' };
	var root = document.documentElement;

	function read( key ) {
		try {
			return window.localStorage.getItem( key );
		} catch ( e ) {
			return null;
		}
	}

	function write( key, value ) {
		try {
			window.localStorage.setItem( key, value );
		} catch ( e ) { /* tárhely nem elérhető - nem végzetes */ }
	}

	function clear( key ) {
		try {
			window.localStorage.removeItem( key );
		} catch ( e ) { /* ugyanígy */ }
	}

	function currentFont() {
		if ( root.classList.contains( 'mb-font-larger' ) ) {
			return 'larger';
		}
		return root.classList.contains( 'mb-font-large' ) ? 'large' : 'normal';
	}

	function applyFont( size ) {
		root.classList.remove( 'mb-font-large', 'mb-font-larger' );
		if ( size === 'large' ) {
			root.classList.add( 'mb-font-large' );
		} else if ( size === 'larger' ) {
			root.classList.add( 'mb-font-larger' );
		}
	}

	function sync() {
		var font = currentFont();
		document.querySelectorAll( '[data-mb-font]' ).forEach( function ( btn ) {
			btn.setAttribute( 'aria-pressed', btn.getAttribute( 'data-mb-font' ) === font ? 'true' : 'false' );
		} );
		document.querySelectorAll( '[data-mb-contrast]' ).forEach( function ( btn ) {
			btn.setAttribute( 'aria-pressed', root.classList.contains( 'mb-contrast' ) ? 'true' : 'false' );
		} );
		document.querySelectorAll( '[data-mb-spacing]' ).forEach( function ( btn ) {
			btn.setAttribute( 'aria-pressed', root.classList.contains( 'mb-spacing' ) ? 'true' : 'false' );
		} );
	}

	// Másik lapon végzett módosítás átvétele.
	function restoreFromStorage() {
		var font = read( KEYS.font );
		applyFont( font === 'large' || font === 'larger' ? font : 'normal' );
		root.classList.toggle( 'mb-contrast', read( KEYS.contrast ) === '1' );
		root.classList.toggle( 'mb-spacing', read( KEYS.spacing ) === '1' );
		sync();
	}

	function init() {
		root.classList.add( 'mb-js' );
		restoreFromStorage();

		document.querySelectorAll( '[data-mb-font]' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var size = btn.getAttribute( 'data-mb-font' );
				applyFont( size );
				write( KEYS.font, size );
				sync();
			} );
		} );

		document.querySelectorAll( '[data-mb-contrast]' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var on = root.classList.toggle( 'mb-contrast' );
				write( KEYS.contrast, on ? '1' : '0' );
				sync();
			} );
		} );

		document.querySelectorAll( '[data-mb-spacing]' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var on = root.classList.toggle( 'mb-spacing' );
				write( KEYS.spacing, on ? '1' : '0' );
				sync();
			} );
		} );

		document.querySelectorAll( '[data-mb-reset]' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				applyFont( 'normal' );
				root.classList.remove( 'mb-contrast', 'mb-spacing' );
				clear( KEYS.font );
				clear( KEYS.contrast );
				clear( KEYS.spacing );
				sync();
			} );
		} );

		window.addEventListener( 'storage', restoreFromStorage );
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
} )();
