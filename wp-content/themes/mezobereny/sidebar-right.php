<?php
/**
 * Jobb oldalsáv: Köszöntő, Keresés, Eseménynaptár, Anyakönyvi hírek, stb.
 * A tényleges tartalmat a Megjelenés » Widgetek alatt lehet összeállítani
 * a "Jobb oldalsáv" widget-területen (sorrendben egymás alá kerülnek).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<aside class="sidebar-col sidebar-col-right" aria-label="<?php esc_attr_e( 'Oldalsáv', 'mezobereny' ); ?>">
	<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-right' ); ?>
	<?php else : ?>
		<div class="widget-box">
			<h2 class="widget-title"><?php esc_html_e( 'Keresés', 'mezobereny' ); ?></h2>
			<div class="widget-body"><?php get_search_form(); ?></div>
		</div>
		<div class="widget-box">
			<h2 class="widget-title"><?php esc_html_e( 'Eseménynaptár', 'mezobereny' ); ?></h2>
			<div class="widget-body"><?php get_calendar( true ); ?></div>
		</div>
	<?php endif; ?>
</aside>
