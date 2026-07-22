<?php
/**
 * Keresés widget - "Mindenhol" legördülő + keresőmező, ahogy a mezobereny.hu-n is látható.
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$unique_id = wp_unique_id( 'mb-search-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id . '-scope' ); ?>" class="screen-reader-text"><?php esc_html_e( 'Keresés helye', 'mezobereny' ); ?></label>
	<select id="<?php echo esc_attr( $unique_id . '-scope' ); ?>" name="post_type">
		<option value=""><?php esc_html_e( 'Mindenhol', 'mezobereny' ); ?></option>
		<option value="post"><?php esc_html_e( 'Hírek', 'mezobereny' ); ?></option>
		<option value="page"><?php esc_html_e( 'Oldalak', 'mezobereny' ); ?></option>
	</select>
	<label for="<?php echo esc_attr( $unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Keresés:', 'mezobereny' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php esc_attr_e( 'Keresés…', 'mezobereny' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
	<input type="submit" class="search-submit" value="<?php esc_attr_e( 'Keresés', 'mezobereny' ); ?>">
</form>
