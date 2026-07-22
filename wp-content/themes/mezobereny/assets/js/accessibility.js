/**
 * Betűméret-váltó és kontrasztos nézet - a mezobereny.hu felső sávjában
 * látott "Betűméret A A A" és kontraszt-ikon funkció megvalósítása.
 */
( function () {
	'use strict';

	var STORAGE_FONT = 'mb-font-size';
	var STORAGE_CONTRAST = 'mb-contrast';
	var root = document.documentElement;

	function applyFont( size ) {
		root.classList.remove( 'mb-font-large', 'mb-font-larger' );
		if ( size === 'large' ) {
			root.classList.add( 'mb-font-large' );
		} else if ( size === 'larger' ) {
			root.classList.add( 'mb-font-larger' );
		}
	}

	function applyContrast( on ) {
		root.classList.toggle( 'mb-contrast', !! on );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		var savedFont = window.localStorage.getItem( STORAGE_FONT );
		if ( savedFont ) {
			applyFont( savedFont );
		}
		var savedContrast = window.localStorage.getItem( STORAGE_CONTRAST );
		if ( savedContrast === '1' ) {
			applyContrast( true );
		}

		document.querySelectorAll( '[data-mb-font]' ).forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var size = btn.getAttribute( 'data-mb-font' );
				applyFont( size );
				window.localStorage.setItem( STORAGE_FONT, size );
			} );
		} );

		var contrastBtn = document.querySelector( '[data-mb-contrast]' );
		if ( contrastBtn ) {
			contrastBtn.addEventListener( 'click', function () {
				var isOn = root.classList.toggle( 'mb-contrast' );
				window.localStorage.setItem( STORAGE_CONTRAST, isOn ? '1' : '0' );
			} );
		}
	} );
} )();
