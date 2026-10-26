<?php
/**
 * Hírkártya a listanézetekhez (főoldal, bejegyzéslista, archívum).
 * Paraméter: $args['heading'] - a cím elem szintje (h2 vagy h3).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$mb_heading = ( isset( $args['heading'] ) && 'h3' === $args['heading'] ) ? 'h3' : 'h2';
?>
<article <?php post_class( 'mb-article' ); ?>>
	<<?php echo $mb_heading; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></<?php echo $mb_heading; ?>>
	<p class="mb-meta">
		<span><?php esc_html_e( 'Létrehozva:', 'mezobereny' ); ?> <?php echo esc_html( get_the_date() ); ?></span>
		<span><?php esc_html_e( 'Szerző:', 'mezobereny' ); ?> <?php the_author(); ?></span>
	</p>
	<div class="mb-excerpt"><?php mezobereny_excerpt(); ?></div>
	<p><a class="mb-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Bővebben »', 'mezobereny' ); ?><span class="screen-reader-text"> <?php the_title(); ?></span></a></p>
</article>
