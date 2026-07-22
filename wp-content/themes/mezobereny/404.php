<?php
/**
 * 404 - a keresett oldal nem található.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<div class="site-columns">
	<?php get_sidebar( 'left' ); ?>

	<main id="primary" class="site-main">
		<div class="mb-404">
			<div class="mb-404-code">404</div>
			<h1><?php esc_html_e( 'A keresett oldal nem található', 'mezobereny' ); ?></h1>
			<p><?php esc_html_e( 'Előfordulhat, hogy az oldal elköltözött vagy törölték. Próbálkozz a keresővel, vagy térj vissza a kezdőlapra.', 'mezobereny' ); ?></p>
			<?php get_search_form(); ?>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( '« Vissza a kezdőlapra', 'mezobereny' ); ?></a></p>
		</div>
	</main>

	<?php get_sidebar( 'right' ); ?>
</div>

<?php get_footer(); ?>
