<?php
/**
 * A weboldal fejléce: felső kisegítő sáv, szépia városkép banner
 * díszes cirkalmas felirattal, morzsamenü + mai dátum/névnap sor.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<?php mezobereny_accessibility_bar(); ?>

	<header id="masthead" class="site-header">
		<div class="mb-header-visual">
			<div class="header-image-wrap">
				<?php if ( has_header_image() ) : ?>
					<?php
					// Explicit width/height kell ahhoz, hogy az AMP plugin biztonságosan
					// <amp-img>-gé tudja alakítani ezt a képet (layout="responsive").
					$mb_header_data = get_custom_header();
					$mb_header_w    = ! empty( $mb_header_data->width ) ? (int) $mb_header_data->width : 1600;
					$mb_header_h    = ! empty( $mb_header_data->height ) ? (int) $mb_header_data->height : 230;
					?>
					<img src="<?php echo esc_url( get_header_image() ); ?>" width="<?php echo esc_attr( $mb_header_w ); ?>" height="<?php echo esc_attr( $mb_header_h ); ?>" alt="">
				<?php else : ?>
					<div class="header-image-placeholder"></div>
				<?php endif; ?>
			</div>

			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<?php if ( is_front_page() || is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<svg class="mb-logo-flourish" viewBox="0 0 220 34" aria-hidden="true" focusable="false">
						<path d="M2 6 C 40 28, 90 -4, 130 18 S 200 30, 216 10" stroke="#241c10" stroke-width="2" fill="none"/>
					</svg>
					<?php $description = get_bloginfo( 'description', 'display' ); ?>
					<?php if ( $description ) : ?>
						<span class="site-description"><?php echo wp_kses_data( $description ); ?></span>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="mb-breadcrumb-row">
			<div class="container">
				<?php mezobereny_breadcrumb(); ?>
				<span class="mb-today"><?php echo esc_html( mezobereny_today_string() ); ?></span>
			</div>
		</div>

		<?php /* Tiszta CSS "checkbox-hack" kapcsoló - JavaScript nélkül működik,
		         így AMP oldalakon is használható (az AMP eltávolítja az egyedi
		         JS-t, de a natív checkbox/label/CSS mechanizmus megmarad). */ ?>
		<input type="checkbox" id="mb-mobile-nav-toggle" class="mb-mobile-nav-checkbox">
		<div class="mb-mobile-nav-bar">
			<label for="mb-mobile-nav-toggle" class="mb-mobile-nav-toggle">
				<span class="mb-hamburger" aria-hidden="true"></span>
				<?php esc_html_e( 'Menü', 'mezobereny' ); ?>
			</label>
		</div>
		<nav id="mb-mobile-nav" class="mb-mobile-nav" aria-label="<?php esc_attr_e( 'Főmenü', 'mezobereny' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '<ul>%3$s</ul>',
					'mb_no_item_ids' => true,
				) );
			} else {
				mezobereny_fallback_primary_menu();
			}
			?>
		</nav>
	</header>
