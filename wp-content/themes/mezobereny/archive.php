<?php
/**
 * Archívum sablon (kategória, címke, dátum szerinti listák).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<div class="site-columns">
	<?php get_sidebar( 'left' ); ?>

	<main id="primary" class="site-main">
		<?php mezobereny_pagination(); ?>

		<h1 class="mb-page-title-box"><?php the_archive_title(); ?></h1>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'mb-article' ); ?>>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="mb-meta">
						<span><?php esc_html_e( 'Létrehozva:', 'mezobereny' ); ?> <?php echo esc_html( get_the_date() ); ?></span>
						<span><?php esc_html_e( 'Szerző:', 'mezobereny' ); ?> <?php the_author(); ?></span>
					</p>
					<div class="mb-excerpt"><?php mezobereny_excerpt(); ?></div>
					<p><a class="mb-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Bővebben »', 'mezobereny' ); ?></a></p>
				</article>
			<?php endwhile; ?>
			<?php mezobereny_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nincs megjeleníthető tartalom.', 'mezobereny' ); ?></p>
		<?php endif; ?>
	</main>

	<?php get_sidebar( 'right' ); ?>
</div>

<?php get_footer(); ?>
