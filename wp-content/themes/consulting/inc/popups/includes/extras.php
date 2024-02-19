<?php
add_filter( 'wp_footer', 'consulting_popups_wrap' );

function consulting_popups_wrap() {
	$popup_global_event  = consulting_theme_option( 'popups_event', '0' );
	$popups_single_event = get_post_meta( get_the_ID(), 'popups_single_event', true );
	$popup_event         = ! empty( $popups_single_event ) ? $popups_single_event : $popup_global_event;

	$popup_global_event_delay  = consulting_theme_option( 'popup_event_open_delay', '0' );
	$popups_single_event_delay = get_post_meta( get_the_ID(), 'popup_single_event_open_delay', true );
	$popup_event_open_delay    = ! empty( $popups_single_event_delay ) ? $popups_single_event_delay : $popup_global_event_delay;

	$popup_global_event_showing_in  = consulting_theme_option( 'popup_event_showing_in', '1' );
	$popups_single_event_showing_in = get_post_meta( get_the_ID(), 'popup_single_event_showing_in', true );
	$popup_event_showing_in         = ! empty( $popups_single_event_showing_in ) ? $popups_single_event_showing_in : $popup_global_event_showing_in;

	$popup_global_responsive  = consulting_theme_option( 'popup_responsive', '' );
	$popups_single_responsive = get_post_meta( get_the_ID(), 'popup_single_responsive', true );
	$popup_responsive         = ! empty( $popups_single_responsive ) ? $popups_single_responsive : $popup_global_responsive;

	$new_popups_link = array_map( 'consulting_popups_link_revival', array_keys( consulting_popups() ) );
	$popups_link     = implode( ', ', $new_popups_link );

	echo '<div id="popup_wrapper" data-event="' . esc_attr( $popup_event ) . '"  data-delay="' . esc_attr( $popup_event_open_delay ) . '" data-showing_in="' . esc_attr( $popup_event_showing_in ) . '" data-popup_links="' . esc_attr( $popups_link ) . '" data-popup_responsive="' . esc_attr( $popup_responsive ) . '"></div>';
}

add_filter( 'manage_posts_columns', 'consulting_popups_link', 5 );

function consulting_popups_link( $columns ) {
	$post_type = get_post_type();
	if ( 'stm_popups' === $post_type ) {
		$columns['consulting_popup_link'] = esc_html__( 'The popup will display when a user clicks a link or a button with the popup’s ID.', 'consulting' );
	}
	return $columns;
}

function consulting_popups_link_id( $column, $id ) {
	$post_type = get_post_type();
	if ( 'stm_popups' === $post_type ) {
		if ( 'consulting_popup_link' === $column ) {
			?>
			<input type="text" value="consulting_popup_<?php echo esc_attr( $id ); ?>" class="consulting-popup-class" readonly />
			<div class="popup-class-copied"><?php echo esc_html__( 'Text copied', 'consulting' ); ?></div>
			<?php
		}
	}
}

add_action( 'manage_posts_custom_column', 'consulting_popups_link_id', 5, 2 );

function consulting_popups_link_revival( $popup_link ) {
	return '#consulting_popup_' . $popup_link;
}

add_filter( 'admin_footer', 'consulting_popups_link_inside' );

function consulting_popups_link_inside() {
	$post_type = get_post_type();
	if ( 'stm_popups' === $post_type ) {
		if ( ! empty( get_the_ID() ) ) {
			echo '<div class="consulting-popups-link-inside">
		<div class="consulting-popups-link-inside__text">' . esc_html__( 'The popup will display when a user clicks a link or a button with the popup’s ID.', 'consulting' ) . '</div>
		<div class="consulting-popups-link-inside__field">
			[<input type="text" value="consulting_popup_' . esc_attr( get_the_ID() ) . '" class="consulting-popup-class" readonly />]
			<div class="popup-class-copied">' . esc_html__( 'Text copied', 'consulting' ) . '</div>
		</div>
	</div>';
		}
	}
}
