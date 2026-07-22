<?php
/**
 * A weboldal lábléce.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
?>
	<footer id="colophon" class="site-footer">
		<div class="container">
			<p class="mb-copyright">
				&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>
			</p>
			<nav class="mb-footer-nav" aria-label="<?php esc_attr_e( 'Lábléc linkek', 'mezobereny' ); ?>">
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
						'depth'          => 1,
					) );
				} else {
					echo '<ul><li><a href="' . esc_url( home_url( '/impresszum' ) ) . '">' . esc_html__( 'Impresszum', 'mezobereny' ) . '</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/oldalterkep' ) ) . '">' . esc_html__( 'Oldaltérkép', 'mezobereny' ) . '</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/gyik' ) ) . '">' . esc_html__( 'Gyakran Ismételt Kérdések', 'mezobereny' ) . '</a></li>';
					echo '<li><a href="' . esc_url( home_url( '/akadalymentesites' ) ) . '">' . esc_html__( 'Akadálymentesítési nyilatkozat', 'mezobereny' ) . '</a></li></ul>';
				}
				?>
			</nav>
		</div>
	</footer>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
