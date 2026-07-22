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

	<div id="mb-topbar">
		<div class="container">
			<span class="mb-topbar-label"><?php esc_html_e( 'Betűméret', 'mezobereny' ); ?></span>
			<button type="button" class="font-a1" data-mb-font="normal">A</button>
			<button type="button" class="font-a2" data-mb-font="large">A</button>
			<button type="button" class="font-a3" data-mb-font="larger">A</button>
			<button type="button" class="mb-contrast-toggle" data-mb-contrast title="<?php esc_attr_e( 'Kontrasztos nézet', 'mezobereny' ); ?>" aria-label="<?php esc_attr_e( 'Kontrasztos nézet', 'mezobereny' ); ?>">◐</button>
		</div>
	</div>

	<header id="masthead" class="site-header">
		<div class="header-image-wrap">
			<?php if ( has_header_image() ) : ?>
				<img src="<?php echo esc_url( get_header_image() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php else : ?>
				<div class="header-image-placeholder"></div>
			<?php endif; ?>
		</div>

		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
				<?php $description = get_bloginfo( 'description', 'display' ); ?>
				<?php if ( $description ) : ?>
					<span class="site-description"><?php echo $description; ?></span>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<div class="mb-breadcrumb-row">
			<div class="container">
				<?php mezobereny_breadcrumb(); ?>
				<span class="mb-today"><?php echo esc_html( mezobereny_today_string() ); ?></span>
			</div>
		</div>
	</header>
