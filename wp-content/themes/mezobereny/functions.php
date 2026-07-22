<?php
/**
 * Mezőberény Városi Sablon - alapfüggvények
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MEZOBERENY_VERSION', '1.0.0' );

/* -----------------------------------------------------------
   Elméleti beállítások / theme support
----------------------------------------------------------- */
function mezobereny_setup() {
	load_theme_textdomain( 'mezobereny', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Szépia városkép fejléc - a mezobereny.hu-hoz hasonló panoráma banner.
	add_theme_support( 'custom-header', array(
		'width'                  => 1600,
		'height'                 => 230,
		'flex-width'             => true,
		'flex-height'            => true,
		'header-text'            => false,
		'default-image'          => '',
	) );

	// Opcionális logókép (ha nem a szöveges cirkalmas feliratot szeretnék használni).
	add_theme_support( 'custom-logo', array(
		'height'      => 120,
		'width'       => 320,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary'    => __( 'Bal oldali Menü doboz', 'mezobereny' ),
		'quicklinks' => __( 'Gyorslink gombsor (főoldal teteje)', 'mezobereny' ),
		'footer'     => __( 'Lábléc linksor', 'mezobereny' ),
	) );
}
add_action( 'after_setup_theme', 'mezobereny_setup' );

/* -----------------------------------------------------------
   Widget területek
----------------------------------------------------------- */
function mezobereny_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Bal oldalsáv - Elérhetőségek', 'mezobereny' ),
		'id'            => 'sidebar-left-contact',
		'description'   => __( 'Az "Elérhetőségek" doboz a bal oldalsáv tetején (cím, telefon, e-mail, épület fotó).', 'mezobereny' ),
		'before_widget' => '<div id="%1$s" class="widget-box mb-contact-box %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Bal oldalsáv - Banner képek', 'mezobereny' ),
		'id'            => 'sidebar-left-banners',
		'description'   => __( 'Pályázati / partner banner képek a Menü doboz felett.', 'mezobereny' ),
		'before_widget' => '<div id="%1$s" class="widget-box mb-banner-widgets %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Jobb oldalsáv', 'mezobereny' ),
		'id'            => 'sidebar-right',
		'description'   => __( 'Köszöntő, Keresés, Eseménynaptár, Anyakönyvi hírek, stb. - egymás alatt jelennek meg.', 'mezobereny' ),
		'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mezobereny_widgets_init' );

/* -----------------------------------------------------------
   Stílusok / szkriptek
----------------------------------------------------------- */
function mezobereny_scripts() {
	wp_enqueue_style(
		'mezobereny-google-fonts',
		'https://fonts.googleapis.com/css2?family=Great+Vibes&family=Georgia&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'mezobereny-style', get_stylesheet_uri(), array(), MEZOBERENY_VERSION );
	wp_enqueue_script( 'mezobereny-accessibility', get_template_directory_uri() . '/assets/js/accessibility.js', array(), MEZOBERENY_VERSION, true );
	wp_enqueue_script( 'mezobereny-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), MEZOBERENY_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mezobereny_scripts' );

/* -----------------------------------------------------------
   Segédfüggvények: dátum + névnap + morzsamenü
----------------------------------------------------------- */
require get_template_directory() . '/inc/namedays.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/template-tags.php';

/* -----------------------------------------------------------
   Alapértelmezett widgetek első aktiváláskor (kényelmi funkció)
----------------------------------------------------------- */
function mezobereny_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mezobereny_content_width', 700 );
}
add_action( 'after_setup_theme', 'mezobereny_content_width' );

/**
 * Fallback menü, ha még nincs "Bal oldali Menü doboz" beállítva a Megjelenés > Menük alatt.
 */
function mezobereny_fallback_primary_menu() {
	echo '<ul>';
	wp_list_pages( array( 'title_li' => '' ) );
	echo '</ul>';
}
