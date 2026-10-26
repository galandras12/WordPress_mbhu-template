<?php
/**
 * Archívum sablon (kategória, címke, dátum szerinti listák).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<div class="site-columns">
	<?php get_sidebar( 'left' ); ?>

	<main id="primary" class="site-main" tabindex="-1">
		<?php mezobereny_pagination(); ?>

		<h1 class="mb-page-title-box"><?php the_archive_title(); ?></h1>

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/article-card' ); ?>
			<?php endwhile; ?>
			<?php mezobereny_pagination(); ?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nincs megjeleníthető tartalom.', 'mezobereny' ); ?></p>
		<?php endif; ?>
	</main>

	<?php get_sidebar( 'right' ); ?>
</div>

<?php get_footer(); ?>
