<?php
/**
 * Mezőberény Városi Sablon - alapfüggvények
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MEZOBERENY_VERSION', '1.1.0' );

/* -----------------------------------------------------------
   Alapbeállítások / theme support
----------------------------------------------------------- */
function mezobereny_setup() {
	load_theme_textdomain( 'mezobereny', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );

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

	/**
	 * Kompatibilitás a hivatalos "AMP" WordPress-pluginnal (Automattic).
	 * A plugin ez alapján tudja, hogy a téma saját sablonjait használhatja
	 * az AMP-verzióhoz (Transitional/Standard mód), nem csak a beépített
	 * "Reader" sablonokat. A plugin automatikusan szanitizálja a kimenetet
	 * (pl. <img> → <amp-img>), és eltávolítja az AMP által nem engedélyezett
	 * egyedi JavaScriptet - lásd readme.txt "AMP támogatás" szakasz.
	 */
	add_theme_support( 'amp' );
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
	wp_enqueue_style( 'mezobereny-style', get_stylesheet_uri(), array(), MEZOBERENY_VERSION );

	// A "Great Vibes" díszbetű helyi (saját tárhelyről kiszolgált) példánya,
	// SIL Open Font License 1.1 alatt (assets/fonts/OFL.txt). Nem töltünk be
	// betűtípust a Google szervereiről: nincs külső kérés (GDPR - a látogató IP-je
	// nem jut el a Google-höz), nincs CORS-hiba, és AMP alatt is működik.
	// A latin-ext részhalmaz tartalmazza a magyar ő/ű betűket.
	$font_dir = get_template_directory_uri() . '/assets/fonts/';
	$font_css = "@font-face{font-family:'Great Vibes';font-style:normal;font-weight:400;font-display:swap;"
		. "src:url('" . esc_url( $font_dir . 'great-vibes-latin-ext.woff2' ) . "') format('woff2');"
		. "unicode-range:U+0100-02BA,U+02BD-02C5,U+02C7-02CC,U+02CE-02D7,U+02DD-02FF,U+0304,U+0308,U+0329,U+1D00-1DBF,U+1E00-1E9F,U+1EF2-1EFF,U+2020,U+20A0-20AB,U+20AD-20C4,U+2113,U+2C60-2C7F,U+A720-A7FF;}"
		. "@font-face{font-family:'Great Vibes';font-style:normal;font-weight:400;font-display:swap;"
		. "src:url('" . esc_url( $font_dir . 'great-vibes-latin.woff2' ) . "') format('woff2');"
		. "unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}";
	wp_add_inline_style( 'mezobereny-style', $font_css );

	// AMP oldalon az egyedi JavaScript nem engedélyezett - ott nem töltjük be.
	if ( ! mezobereny_is_amp() ) {
		wp_enqueue_script( 'mezobereny-accessibility', get_template_directory_uri() . '/assets/js/accessibility.js', array(), MEZOBERENY_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mezobereny_scripts' );

/* -----------------------------------------------------------
   Segédfüggvények: dátum + névnap + morzsamenü
----------------------------------------------------------- */
require get_template_directory() . '/inc/accessibility.php';
require get_template_directory() . '/inc/namedays.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/template-tags.php';

/* -----------------------------------------------------------
   Tartalomszélesség (beágyazott médiához)
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

/**
 * Magyar nyelvű oldalon a naptár widget fejlécében a WordPress alapból csak
 * a napnevek első betűjét írja ki ("h k s c p s v"), ami félreérthető (a
 * szerda és a szombat is "s"). A hagyományos magyar rövidítéseket használjuk:
 * H, K, Sze, Cs, P, Szo, V. A teljes napnév továbbra is aria-label-ben van.
 */
function mezobereny_calendar_weekday_initials() {
	if ( 0 !== strpos( get_locale(), 'hu' ) ) {
		return;
	}
	global $wp_locale;
	// A 0. index a vasárnap (WordPress konvenció).
	$short = array( 0 => 'V', 1 => 'H', 2 => 'K', 3 => 'Sze', 4 => 'Cs', 5 => 'P', 6 => 'Szo' );
	foreach ( $short as $index => $label ) {
		if ( isset( $wp_locale->weekday[ $index ] ) ) {
			$wp_locale->weekday_initial[ $wp_locale->weekday[ $index ] ] = $label;
		}
	}
}
add_action( 'after_setup_theme', 'mezobereny_calendar_weekday_initials', 20 );
