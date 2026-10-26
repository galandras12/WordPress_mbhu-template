<?php
/**
 * Testreszabó (Megjelenés » Testreszabás » Stílus beállítások):
 * a jobb oldalsáv "Keresés" és "Eseménynaptár" dobozának ki-/bekapcsolása.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Be van kapcsolva a megadott doboz? Alapértelmezetten mindkettő látszik.
 *
 * @param string $key 'search' vagy 'calendar'.
 */
function mezobereny_box_enabled( $key ) {
	return (bool) get_theme_mod( 'mezobereny_show_' . $key, true );
}

function mezobereny_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'mezobereny_style', array(
		'title'       => __( 'Stílus beállítások', 'mezobereny' ),
		'description' => __( 'A jobb oldalsáv dobozainak megjelenítése. Kikapcsolva a doboz sem a téma alapértelmezett változatában, sem a Widgetek alatt hozzáadott Keresés / Naptár widgetként nem jelenik meg.', 'mezobereny' ),
		'priority'    => 30,
	) );

	$boxes = array(
		'search'   => __( 'Keresés doboz megjelenítése', 'mezobereny' ),
		'calendar' => __( 'Eseménynaptár doboz megjelenítése', 'mezobereny' ),
	);
	foreach ( $boxes as $key => $label ) {
		$wp_customize->add_setting( 'mezobereny_show_' . $key, array(
			'default'           => true,
			'type'              => 'theme_mod',
			'sanitize_callback' => 'rest_sanitize_boolean',
		) );
		$wp_customize->add_control( 'mezobereny_show_' . $key, array(
			'section' => 'mezobereny_style',
			'label'   => $label,
			'type'    => 'checkbox',
		) );
	}
}
add_action( 'customize_register', 'mezobereny_customize_register' );

/**
 * A "Jobb oldalsáv" területről kivesszük a Keresés (search-N) és a Naptár
 * (calendar-N) widgeteket, ha ki vannak kapcsolva. Csak a látogatói oldalon,
 * így a Widgetek képernyőn a beállított widgetek megmaradnak.
 */
function mezobereny_filter_sidebar_widgets( $sidebars ) {
	if ( is_admin() || empty( $sidebars['sidebar-right'] ) || ! is_array( $sidebars['sidebar-right'] ) ) {
		return $sidebars;
	}
	$hide = array();
	if ( ! mezobereny_box_enabled( 'search' ) ) {
		$hide[] = 'search-';
	}
	if ( ! mezobereny_box_enabled( 'calendar' ) ) {
		$hide[] = 'calendar-';
	}
	if ( $hide ) {
		$sidebars['sidebar-right'] = array_values( array_filter(
			$sidebars['sidebar-right'],
			function ( $widget_id ) use ( $hide ) {
				foreach ( $hide as $prefix ) {
					if ( 0 === strpos( (string) $widget_id, $prefix ) ) {
						return false;
					}
				}
				return true;
			}
		) );
	}
	return $sidebars;
}
add_filter( 'sidebars_widgets', 'mezobereny_filter_sidebar_widgets' );
