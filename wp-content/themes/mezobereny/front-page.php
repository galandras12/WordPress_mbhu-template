<?php
/**
 * Főoldal sablon: lapozó, gyorslink gombsor, majd kétoszlopos
 * "Kiemelt hírek" / "Kiemelt cikkek" elrendezés - a mezobereny.hu főoldalához hasonlóan.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<div class="site-columns">
	<?php get_sidebar( 'left' ); ?>

	<main id="primary" class="site-main">

		<?php mezobereny_pagination(); ?>

		<?php mezobereny_quicklinks(); ?>

		<?php if ( have_posts() ) : ?>

			<div class="mb-news-columns">
				<div class="mb-news-column">
					<h2 class="mb-column-title"><?php esc_html_e( 'Kiemelt hírek', 'mezobereny' ); ?></h2>
					<?php
					$i = 0;
					while ( have_posts() ) :
						the_post();
						if ( 0 !== $i % 2 ) { $i++; continue; }
						$i++;
						?>
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
				</div>

				<div class="mb-news-column">
					<h2 class="mb-column-title"><?php esc_html_e( 'Kiemelt cikkek', 'mezobereny' ); ?></h2>
					<?php
					rewind_posts();
					$i = 0;
					while ( have_posts() ) :
						the_post();
						if ( 0 === $i % 2 ) { $i++; continue; }
						$i++;
						?>
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
				</div>
			</div>

		<?php else : ?>
			<p><?php esc_html_e( 'Nincs még megjelenített tartalom. Hozz létre bejegyzéseket a hírekhez.', 'mezobereny' ); ?></p>
		<?php endif; ?>

	</main>

	<?php get_sidebar( 'right' ); ?>
</div>

<?php get_footer(); ?>
