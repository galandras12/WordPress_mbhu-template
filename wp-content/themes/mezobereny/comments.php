<?php
/**
 * Hozzászólások sablon.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area widget-box">
	<div class="widget-body">
		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
				$count = get_comments_number();
				printf( esc_html( _n( '%s hozzászólás', '%s hozzászólás', $count, 'mezobereny' ) ), number_format_i18n( $count ) );
				?>
			</h2>
			<ol class="comment-list">
				<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
				?>
			</ol>
			<?php the_comments_navigation(); ?>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'A hozzászólások zárva vannak.', 'mezobereny' ); ?></p>
		<?php endif; ?>

		<?php comment_form(); ?>
	</div>
</div>
