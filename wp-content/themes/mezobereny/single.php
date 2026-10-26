<?php
/**
 * Egyedi bejegyzés sablon (hír/cikk részletes nézete).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<div class="site-columns">
	<?php get_sidebar( 'left' ); ?>

	<main id="primary" class="site-main mb-single" tabindex="-1">

		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h1 class="mb-page-title-box"><?php the_title(); ?></h1>
				<p class="entry-meta">
					<span><?php esc_html_e( 'Létrehozva:', 'mezobereny' ); ?> <?php echo esc_html( get_the_date() ); ?></span> ·
					<span><?php esc_html_e( 'Szerző:', 'mezobereny' ); ?> <?php the_author(); ?></span>
					<?php $cats = get_the_category_list( ', ' ); ?>
					<?php if ( $cats ) : ?> · <span><?php esc_html_e( 'Kategória:', 'mezobereny' ); ?> <?php echo $cats; ?></span><?php endif; ?>
				</p>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Oldalak:', 'mezobereny' ),
						'after'  => '</div>',
					) );
					?>
				</div>
			</article>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		<?php endwhile; ?>

	</main>

	<?php get_sidebar( 'right' ); ?>
</div>

<?php get_footer(); ?>
