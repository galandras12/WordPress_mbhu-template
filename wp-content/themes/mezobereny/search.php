<?php
/**
 * Keresési találatok sablon.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<div class="site-columns">
	<?php get_sidebar( 'left' ); ?>

	<main id="primary" class="site-main">
		<h1 class="mb-page-title-box">
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Keresési találatok: %s', 'mezobereny' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'mb-article' ); ?>>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="mb-meta">
						<span><?php echo esc_html( get_the_date() ); ?></span>
					</p>
					<div class="mb-excerpt"><?php mezobereny_excerpt(); ?></div>
					<p><a class="mb-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Bővebben »', 'mezobereny' ); ?></a></p>
				</article>
			<?php endwhile; ?>
			<?php mezobereny_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nincs a keresésnek megfelelő találat.', 'mezobereny' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</main>

	<?php get_sidebar( 'right' ); ?>
</div>

<?php get_footer(); ?>
