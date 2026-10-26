<?php
/**
 * Statikus oldal sablon (pl. Elérhetőségek, Városunkról, stb.).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<div class="site-columns">
	<?php get_sidebar( 'left' ); ?>

	<main id="primary" class="site-main mb-single" tabindex="-1">
		<?php mezobereny_pagination(); ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<h1 class="mb-page-title-box"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Oldalak:', 'mezobereny' ),
					'after'  => '</div>',
				) );
				?>
			</div>
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</main>

	<?php get_sidebar( 'right' ); ?>
</div>

<?php get_footer(); ?>
