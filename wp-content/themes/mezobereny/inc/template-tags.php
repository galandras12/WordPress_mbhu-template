<?php
/**
 * Sablon segédfüggvények: morzsamenü, lapozó, gyorslink gombsor.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * "Kezdőlap » Aktuális oldal" morzsamenü, ahogy a mezobereny.hu fejlécében is látható.
 */
function mezobereny_breadcrumb() {
	$sep = ' <span class="mb-breadcrumb-sep" aria-hidden="true">»</span> ';
	$current = '';

	if ( is_front_page() ) {
		// Csak "Kezdőlap" jelenik meg.
	} elseif ( is_search() ) {
		$current = __( 'Keresési találatok', 'mezobereny' );
	} elseif ( is_404() ) {
		$current = __( 'A keresett oldal nem található', 'mezobereny' );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$current = single_term_title( '', false );
	} elseif ( is_archive() ) {
		$current = get_the_archive_title();
	} elseif ( is_singular() ) {
		$current = get_the_title();
	}

	echo '<nav class="mb-breadcrumb" aria-label="' . esc_attr__( 'Morzsamenü', 'mezobereny' ) . '">';
	if ( '' === $current ) {
		echo '<span aria-current="page">' . esc_html__( 'Kezdőlap', 'mezobereny' ) . '</span>';
	} else {
		echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Kezdőlap', 'mezobereny' ) . '</a>';
		echo $sep . '<span aria-current="page">' . esc_html( $current ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</nav>';
}

/**
 * Kör alakú, számozott lapozó a tartalom tetején (1 2 3 4 5 stílus).
 */
function mezobereny_pagination( $query = null ) {
	if ( ! $query instanceof WP_Query ) {
		global $wp_query;
		$query = $wp_query;
	}
	$big   = 999999999;
	$links = paginate_links( array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'current'   => max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) ),
		'total'     => (int) $query->max_num_pages,
		'type'      => 'array',
		'prev_next' => false,
	) );

	if ( empty( $links ) || count( $links ) < 2 ) {
		return;
	}

	echo '<nav class="mb-pagination" aria-label="' . esc_attr__( 'Lapozás', 'mezobereny' ) . '">';
	foreach ( $links as $link ) {
		echo $link; // phpcs:ignore WordPress.Security.EscapeOutput -- a paginate_links() már escape-elt kimenete.
	}
	echo '</nav>';
}

/**
 * A főoldal tetején lévő gyorslink gombsor (Helyi rendeletek, Egészségügyi ellátás, stb.).
 * A "quicklinks" menüből épül fel; az utolsó előtti tétel kiemelhető zöld
 * "highlight" stílussal, ha a menütételhez CSS class "highlight" van rendelve.
 */
function mezobereny_quicklinks() {
	if ( ! has_nav_menu( 'quicklinks' ) ) {
		return;
	}

	wp_nav_menu( array(
		'theme_location'  => 'quicklinks',
		'container'       => 'div',
		'container_class' => 'mb-quicklinks',
		'items_wrap'      => '%3$s',
		'depth'           => 1,
		'fallback_cb'     => false,
		'walker'          => new Mezobereny_Quicklinks_Walker(),
	) );
}

/**
 * Egyszerű walker, ami a menütételhez rendelt CSS osztályt ("highlight")
 * átemeli az <a> elemre, hogy a zöld kiemelő gomb stílust megkaphassa.
 */
class Mezobereny_Quicklinks_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$extra   = in_array( 'highlight', $classes, true ) ? ' mb-quicklink-highlight' : '';
		$output .= '<a class="mb-quicklink' . esc_attr( $extra ) . '" href="' . esc_url( $item->url ) . '">';
		$output .= '<span>' . esc_html( $item->title ) . '</span></a>';
	}

	// Az alapértelmezett end_el() egy záró </li>-t írna ki, de itt nincs <li>
	// (érvénytelen HTML lenne, AMP-n validációs hiba).
	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {}
}

/**
 * Rövid kivonat egységes hosszra vágva a hírkártyákhoz.
 */
function mezobereny_excerpt( $length = 32 ) {
	echo wp_trim_words( get_the_excerpt(), $length, '…' );
}
