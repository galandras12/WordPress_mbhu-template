<?php
/**
 * Főoldal sablon: lapozó, gyorslink gombsor, majd kétoszlopos
 * "Kiemelt hírek" / "Kiemelt cikkek" elrendezés - a mezobereny.hu főoldalához hasonlóan.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<?php
// Statikus kezdőlap esetén a fő lekérdezés maga a kezdőlap, ezért a híreket
// külön lekérdezéssel hozzuk; egyébként a fő lekérdezés a legutóbbi bejegyzéseket adja.
$mb_static_front = ( 'page' === get_option( 'show_on_front' ) );
if ( $mb_static_front ) {
	$mb_news = new WP_Query( array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => false,
		'paged'               => max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) ),
	) );
} else {
	$mb_news = $GLOBALS['wp_query'];
}

// A bejegyzéseket felváltva osztjuk a két oszlopba.
$mb_columns = array( array(), array() );
$mb_i       = 0;
while ( $mb_news->have_posts() ) {
	$mb_news->the_post();
	ob_start();
	get_template_part( 'template-parts/article-card', null, array( 'heading' => 'h3' ) );
	$mb_columns[ $mb_i % 2 ][] = ob_get_clean();
	$mb_i++;
}
wp_reset_postdata();
?>

<div class="site-columns">
	<?php get_sidebar( 'left' ); ?>

	<main id="primary" class="site-main" tabindex="-1">

		<?php mezobereny_pagination( $mb_news ); ?>

		<?php mezobereny_quicklinks(); ?>

		<?php
		if ( $mb_static_front ) {
			while ( have_posts() ) {
				the_post();
				if ( '' !== trim( get_the_content() ) ) {
					echo '<div class="entry-content mb-front-content">';
					the_content();
					echo '</div>';
				}
			}
		}
		?>

		<?php if ( $mb_i > 0 ) : ?>

			<div class="mb-news-columns">
				<div class="mb-news-column">
					<h2 class="mb-column-title"><?php esc_html_e( 'Kiemelt hírek', 'mezobereny' ); ?></h2>
					<?php echo implode( '', $mb_columns[0] ); // phpcs:ignore WordPress.Security.EscapeOutput -- a kártyák már escape-elt kimenetek. ?>
				</div>

				<div class="mb-news-column">
					<h2 class="mb-column-title"><?php esc_html_e( 'Kiemelt cikkek', 'mezobereny' ); ?></h2>
					<?php echo implode( '', $mb_columns[1] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</div>
			</div>

		<?php else : ?>
			<p><?php esc_html_e( 'Nincs még megjelenített tartalom. Hozz létre bejegyzéseket a hírekhez.', 'mezobereny' ); ?></p>
		<?php endif; ?>

	</main>

	<?php get_sidebar( 'right' ); ?>
</div>

<?php get_footer(); ?>
