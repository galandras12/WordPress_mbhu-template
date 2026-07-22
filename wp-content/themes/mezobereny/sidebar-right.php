<?php
/**
 * Jobb oldalsáv: Köszöntő, Keresés, Eseménynaptár, Anyakönyvi hírek, stb.
 * A tényleges tartalmat a Megjelenés » Widgetek alatt lehet összeállítani
 * a "Jobb oldalsáv" widget-területen (sorrendben egymás alá kerülnek).
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="sidebar-col sidebar-col-right">
	<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-right' ); ?>
	<?php else : ?>
		<div class="widget-box">
			<h2 class="widget-title"><?php esc_html_e( 'Keresés', 'mezobereny' ); ?></h2>
			<div class="widget-body"><?php get_search_form(); ?></div>
		</div>
		<div class="widget-box">
			<h2 class="widget-title"><?php esc_html_e( 'Eseménynaptár', 'mezobereny' ); ?></h2>
			<div class="widget-body"><?php echo get_calendar( true ); ?></div>
		</div>
		<p><em><?php esc_html_e( 'Adj hozzá további widgeteket (Köszöntő, Anyakönyvi hírek, Kép, Egyéni HTML stb.) a Megjelenés » Widgetek alatt a "Jobb oldalsáv" területhez.', 'mezobereny' ); ?></em></p>
	<?php endif; ?>
</div>
