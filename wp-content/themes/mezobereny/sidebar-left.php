<?php
/**
 * Bal oldalsáv: "Elérhetőségek" doboz, banner képek, majd a "Menü" navigációs doboz.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<aside class="sidebar-col sidebar-col-left" aria-label="<?php esc_attr_e( 'Oldalsáv: elérhetőségek és menü', 'mezobereny' ); ?>">

	<?php if ( is_active_sidebar( 'sidebar-left-contact' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-left-contact' ); ?>
	<?php else : ?>
		<div class="widget-box mb-contact-box">
			<h2 class="widget-title"><?php esc_html_e( 'Elérhetőségek', 'mezobereny' ); ?></h2>
			<div class="widget-body">
				<p><em><?php esc_html_e( 'Töltsd fel a Megjelenés » Widgetek alatt a "Bal oldalsáv - Elérhetőségek" területre a cím, telefonszám, e-mail és épületfotó widgetet.', 'mezobereny' ); ?></em></p>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-left-banners' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-left-banners' ); ?>
	<?php endif; ?>

	<div class="widget-box mb-menu-box">
		<h2 class="widget-title"><?php esc_html_e( 'Menü', 'mezobereny' ); ?></h2>
		<nav class="widget-body" aria-label="<?php esc_attr_e( 'Főmenü', 'mezobereny' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '<ul>%3$s</ul>',
				) );
			} else {
				mezobereny_fallback_primary_menu();
			}
			?>
		</nav>
	</div>

</aside>
