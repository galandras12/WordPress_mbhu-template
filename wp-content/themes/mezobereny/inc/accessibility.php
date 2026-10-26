<?php
/**
 * Kisegítő eszköztár (felső sáv), "Ugrás a tartalomra" link és az ezekhez
 * tartozó segédfüggvények.
 *
 * Az eszköztár (betűméret, kontraszt, szövegtávolság, alaphelyzet) JavaScriptet
 * igényel (assets/js/accessibility.js). AMP oldalakon az egyedi JavaScript
 * nem engedélyezett, ezért ott ezek a gombok nem jelennek meg (egy nem működő
 * vezérlő önmagában akadálymentességi hiba lenne) - helyette a teljes értékű,
 * nem AMP változatra mutató link látható, ha az létezik.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Az aktuális kérés az AMP plugin által kiszolgált AMP oldal?
 */
function mezobereny_is_amp() {
	return function_exists( 'amp_is_request' ) && amp_is_request();
}

/**
 * AMP oldalról a nem AMP (kanonikus) változat URL-je. Üres, ha nincs ilyen
 * (pl. "Standard" AMP módban az egész oldal AMP).
 */
function mezobereny_non_amp_url() {
	if ( ! mezobereny_is_amp() ) {
		return '';
	}
	if ( function_exists( 'amp_is_canonical' ) && amp_is_canonical() ) {
		return '';
	}
	if ( function_exists( 'amp_get_current_url' ) && function_exists( 'amp_remove_paired_endpoint' ) ) {
		return amp_remove_paired_endpoint( amp_get_current_url() );
	}
	return '';
}

/**
 * Az akadálymentesítési nyilatkozat oldala. Alapértelmezetten az
 * "akadalymentesites" URL-azonosítójú oldalt keresi; ha nincs ilyen, nem
 * jelenik meg link (hogy ne mutasson 404-re). Szűrővel felülírható.
 */
function mezobereny_accessibility_statement_url() {
	$url  = '';
	$page = get_page_by_path( 'akadalymentesites' );
	if ( $page && 'publish' === $page->post_status ) {
		$url = get_permalink( $page );
	}
	return (string) apply_filters( 'mezobereny_accessibility_statement_url', $url );
}

/**
 * Korábban mentett beállítások azonnali alkalmazása a <head>-ben, hogy az
 * oldal ne "villanjon" alapméretben betöltéskor. Hibatűrő: ha a
 * localStorage nem érhető el (privát mód, tiltott süti/tárhely), az oldal
 * változatlanul működik. AMP oldalon nem íródik ki.
 */
function mezobereny_print_a11y_boot_script() {
	if ( mezobereny_is_amp() ) {
		return;
	}
	$js = "(function(){var d=document.documentElement,c=d.classList;try{var s=window.localStorage,f=s.getItem('mb-font-size');"
		. "if(f==='large'){c.add('mb-font-large');}else if(f==='larger'){c.add('mb-font-larger');}"
		. "if(s.getItem('mb-contrast')==='1'){c.add('mb-contrast');}"
		. "if(s.getItem('mb-spacing')==='1'){c.add('mb-spacing');}}catch(e){}c.add('mb-js');})();";
	wp_print_inline_script_tag( $js );
}
add_action( 'wp_head', 'mezobereny_print_a11y_boot_script', 1 );

/**
 * "Ugrás a tartalomra" link (WCAG 2.4.1 - blokkok megkerülése).
 * A wp_body_open hookon keresztül a <body> legelső eleme.
 */
function mezobereny_skip_link() {
	echo '<a class="mb-skip-link screen-reader-text" href="#primary">' . esc_html__( 'Ugrás a tartalomra', 'mezobereny' ) . '</a>';
}
add_action( 'wp_body_open', 'mezobereny_skip_link', 5 );

/**
 * A felső kisegítő sáv tartalma.
 */
function mezobereny_accessibility_bar() {
	$statement_url = mezobereny_accessibility_statement_url();
	$non_amp_url   = mezobereny_non_amp_url();
	?>
	<div id="mb-topbar" role="region" aria-label="<?php esc_attr_e( 'Kisegítő lehetőségek', 'mezobereny' ); ?>">
		<div class="container">

			<?php if ( $statement_url ) : ?>
				<a class="mb-topbar-link" href="<?php echo esc_url( $statement_url ); ?>"><?php esc_html_e( 'Akadálymentesítés', 'mezobereny' ); ?></a>
			<?php endif; ?>

			<?php if ( $non_amp_url ) : ?>
				<a class="mb-topbar-link" href="<?php echo esc_url( $non_amp_url ); ?>"><?php esc_html_e( 'Teljes értékű oldal (betűméret, kontraszt)', 'mezobereny' ); ?></a>
			<?php endif; ?>

			<?php if ( ! mezobereny_is_amp() ) : ?>
				<div class="mb-a11y-tools mb-js-only">
					<span class="mb-topbar-label" id="mb-fs-label"><?php esc_html_e( 'Betűméret', 'mezobereny' ); ?></span>
					<span class="mb-a11y-group" role="group" aria-labelledby="mb-fs-label">
						<button type="button" class="font-a1" data-mb-font="normal" aria-pressed="true" title="<?php esc_attr_e( 'Normál betűméret', 'mezobereny' ); ?>" aria-label="<?php esc_attr_e( 'Normál betűméret', 'mezobereny' ); ?>">A</button>
						<button type="button" class="font-a2" data-mb-font="large" aria-pressed="false" title="<?php esc_attr_e( 'Nagyobb betűméret', 'mezobereny' ); ?>" aria-label="<?php esc_attr_e( 'Nagyobb betűméret', 'mezobereny' ); ?>">A</button>
						<button type="button" class="font-a3" data-mb-font="larger" aria-pressed="false" title="<?php esc_attr_e( 'Legnagyobb betűméret', 'mezobereny' ); ?>" aria-label="<?php esc_attr_e( 'Legnagyobb betűméret', 'mezobereny' ); ?>">A</button>
					</span>

					<button type="button" class="mb-icon-btn mb-contrast-toggle" data-mb-contrast aria-pressed="false" title="<?php esc_attr_e( 'Kontrasztos nézet', 'mezobereny' ); ?>" aria-label="<?php esc_attr_e( 'Kontrasztos nézet', 'mezobereny' ); ?>">
						<svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 3a9 9 0 0 1 0 18z" fill="currentColor"/></svg>
					</button>

					<button type="button" class="mb-icon-btn mb-spacing-toggle" data-mb-spacing aria-pressed="false" title="<?php esc_attr_e( 'Nagyobb szöveg- és sortávolság', 'mezobereny' ); ?>" aria-label="<?php esc_attr_e( 'Nagyobb szöveg- és sortávolság', 'mezobereny' ); ?>">
						<svg viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false"><path d="M4 5h16M4 12h16M4 19h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
					</button>

					<button type="button" class="mb-text-btn" data-mb-reset><?php esc_html_e( 'Alaphelyzet', 'mezobereny' ); ?></button>
				</div>
			<?php endif; ?>

			<?php
			/**
			 * Ide csatlakozhat pl. egy nyelvválasztó (Polylang / WPML) vagy
			 * további kisegítő link, a sáv jobb szélén.
			 */
			do_action( 'mezobereny_topbar_end' );
			?>
		</div>
	</div>
	<?php
}

/**
 * A mobil és az oldalsávi menü ugyanazt a menüt írja ki; az ismétlődő
 * elem-azonosítók (menu-item-NN) érvénytelen HTML-t, AMP-n validációs
 * hibát okoznának. A mobil menüből ezért elhagyjuk az id attribútumokat.
 */
function mezobereny_nav_menu_item_id( $id, $item, $args ) {
	if ( ! empty( $args->mb_no_item_ids ) ) {
		return '';
	}
	return $id;
}
add_filter( 'nav_menu_item_id', 'mezobereny_nav_menu_item_id', 10, 3 );
