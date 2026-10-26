<?php
/**
 * Egyedi widgetek a mezobereny.hu jobb oldalsávjában látott
 * jellegzetes dobozokhoz: "Köszöntő" és "Anyakönyvi hírek".
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Köszöntő widget: polgármesteri fotó + üdvözlő szöveg + link.
 */
class Mezobereny_Greeting_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'mezobereny_greeting',
			__( 'Mezőberény: Köszöntő', 'mezobereny' ),
			array( 'description' => __( 'Fénykép + üdvözlő szöveg doboz, pl. a polgármesteri köszöntőhöz.', 'mezobereny' ) )
		);
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo '<div class="widget-body mb-greeting-widget">';
		if ( ! empty( $instance['image_id'] ) ) {
			echo wp_get_attachment_image( (int) $instance['image_id'], array( 90, 110 ) );
		}
		if ( ! empty( $instance['text'] ) ) {
			echo wpautop( wp_kses_post( $instance['text'] ) );
		}
		if ( ! empty( $instance['link_url'] ) && ! empty( $instance['link_text'] ) ) {
			echo '<a href="' . esc_url( $instance['link_url'] ) . '">' . esc_html( $instance['link_text'] ) . ' »</a>';
		}
		echo '</div>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? $instance['title'] : __( 'Köszöntő', 'mezobereny' );
		$image_id  = isset( $instance['image_id'] ) ? $instance['image_id'] : '';
		$text      = isset( $instance['text'] ) ? $instance['text'] : '';
		$link_url  = isset( $instance['link_url'] ) ? $instance['link_url'] : '';
		$link_text = isset( $instance['link_text'] ) ? $instance['link_text'] : __( 'Tovább a köszöntőhöz', 'mezobereny' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Cím:', 'mezobereny' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image_id' ) ); ?>"><?php esc_html_e( 'Kép melléklet-azonosítója (media library ID):', 'mezobereny' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_id' ) ); ?>" type="number" value="<?php echo esc_attr( $image_id ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e( 'Szöveg:', 'mezobereny' ); ?></label>
			<textarea class="widefat" rows="5" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>"><?php echo esc_textarea( $text ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>"><?php esc_html_e( 'Link URL:', 'mezobereny' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_url' ) ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>"><?php esc_html_e( 'Link szövege:', 'mezobereny' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text' ) ); ?>" type="text" value="<?php echo esc_attr( $link_text ); ?>">
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = array();
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['image_id']  = absint( $new_instance['image_id'] );
		$instance['text']      = wp_kses_post( $new_instance['text'] );
		$instance['link_url']  = esc_url_raw( $new_instance['link_url'] );
		$instance['link_text'] = sanitize_text_field( $new_instance['link_text'] );
		return $instance;
	}
}

/**
 * Anyakönyvi hírek widget: "Megházasodtak" / "Elhunytak" fül-váltós lista.
 */
class Mezobereny_Registry_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'mezobereny_registry',
			__( 'Mezőberény: Anyakönyvi hírek', 'mezobereny' ),
			array( 'description' => __( 'Megházasodtak / Elhunytak fül-váltós lista.', 'mezobereny' ) )
		);
	}

	public function widget( $args, $instance ) {
		static $instance_count = 0;
		$instance_count++;
		$uid = 'mb-registry-' . $instance_count;

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$married  = ! empty( $instance['married'] ) ? $instance['married'] : '';
		$deceased = ! empty( $instance['deceased'] ) ? $instance['deceased'] : '';
		$heading  = ! empty( $instance['month_label'] ) ? $instance['month_label'] : '';
		?>
		<?php
		// Tiszta CSS "radio-hack" fül-váltó - nincs hozzá JavaScript, így AMP
		// oldalakon is működik (az AMP eltávolítja az egyedi szkripteket).
		$id_married  = $uid . '-married';
		$id_deceased = $uid . '-deceased';
		?>
		<div class="widget-body mb-registry-widget" id="<?php echo esc_attr( $uid ); ?>">
			<?php if ( $heading ) : ?>
				<p><strong><?php echo esc_html( $heading ); ?></strong></p>
			<?php endif; ?>
			<input type="radio" class="mb-registry-radio" name="<?php echo esc_attr( $uid ); ?>-tabs" id="<?php echo esc_attr( $id_married ); ?>" checked>
			<input type="radio" class="mb-registry-radio" name="<?php echo esc_attr( $uid ); ?>-tabs" id="<?php echo esc_attr( $id_deceased ); ?>">
			<div class="mb-registry-tabs">
				<label for="<?php echo esc_attr( $id_married ); ?>"><?php esc_html_e( 'Megházasodtak', 'mezobereny' ); ?></label>
				<label for="<?php echo esc_attr( $id_deceased ); ?>"><?php esc_html_e( 'Elhunytak', 'mezobereny' ); ?></label>
			</div>
			<div class="mb-registry-panel mb-registry-panel-married"><?php echo wpautop( wp_kses_post( $married ) ); ?></div>
			<div class="mb-registry-panel mb-registry-panel-deceased"><?php echo wpautop( wp_kses_post( $deceased ) ); ?></div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title       = isset( $instance['title'] ) ? $instance['title'] : __( 'Anyakönyvi hírek', 'mezobereny' );
		$month_label = isset( $instance['month_label'] ) ? $instance['month_label'] : '';
		$married     = isset( $instance['married'] ) ? $instance['married'] : '';
		$deceased    = isset( $instance['deceased'] ) ? $instance['deceased'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Cím:', 'mezobereny' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'month_label' ) ); ?>"><?php esc_html_e( 'Felirat (pl. "2026. június hónapban házasságot kötöttek"):', 'mezobereny' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'month_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'month_label' ) ); ?>" type="text" value="<?php echo esc_attr( $month_label ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'married' ) ); ?>"><?php esc_html_e( 'Megházasodtak (soronként):', 'mezobereny' ); ?></label>
			<textarea class="widefat" rows="5" id="<?php echo esc_attr( $this->get_field_id( 'married' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'married' ) ); ?>"><?php echo esc_textarea( $married ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'deceased' ) ); ?>"><?php esc_html_e( 'Elhunytak (soronként):', 'mezobereny' ); ?></label>
			<textarea class="widefat" rows="5" id="<?php echo esc_attr( $this->get_field_id( 'deceased' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'deceased' ) ); ?>"><?php echo esc_textarea( $deceased ); ?></textarea>
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return array(
			'title'       => sanitize_text_field( $new_instance['title'] ),
			'month_label' => sanitize_text_field( $new_instance['month_label'] ),
			'married'     => wp_kses_post( $new_instance['married'] ),
			'deceased'    => wp_kses_post( $new_instance['deceased'] ),
		);
	}
}

function mezobereny_register_widgets() {
	register_widget( 'Mezobereny_Greeting_Widget' );
	register_widget( 'Mezobereny_Registry_Widget' );
}
add_action( 'widgets_init', 'mezobereny_register_widgets' );
