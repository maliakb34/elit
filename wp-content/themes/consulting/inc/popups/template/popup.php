<?php
$global_popup_id           = consulting_theme_option( 'popups', '' );
$current_post_id           = ! empty( $_POST['id'] ) && ! wp_verify_nonce( $_POST['consulting_popup_nonce'] ) ? sanitize_key( $_POST['id'] ) : 'none';
$post_popup_id             = ! empty( get_post_meta( $current_post_id, 'popups_single' ) ) ? array_shift( get_post_meta( $current_post_id, 'popups_single' ) ) : '';
$post_and_global_popups_id = ! empty( $post_popup_id ) ? $post_popup_id : $global_popup_id;
$popup_id                  = ! empty( $_POST['popups_id'] ) ? $_POST['popups_id'] : $post_and_global_popups_id;
$popup_animation           = ! empty( $_POST['animation'] ) ? $_POST['animation'] : '';

if ( ! empty( $popup_id ) ) :
	$popup_template_name   = get_post_meta( $popup_id, 'popups_template', 'classic' );
	$popup_width           = array_shift( get_post_meta( $popup_id, 'popups_width', '' ) );
	$popup_height          = array_shift( get_post_meta( $popup_id, 'popups_height', '' ) );
	$popup_image_id        = array_shift( get_post_meta( $popup_id, 'popups_image_bg', '' ) );
	$popup_image_bg        = wp_get_attachment_image_url( $popup_image_id, 'full' );
	$popups_color_bg       = array_shift( get_post_meta( $popup_id, 'popups_color_bg', '' ) );
	$popups_border_radius  = array_shift( get_post_meta( $popup_id, 'popups_border_radius', '' ) );
	$popup_width_max_width = ( $popup_width ) ? ' max-width: ' . $popup_width . 'px;' : '';

	$css_styles .= ( $popup_height ) ? ' max-height: ' . $popup_height . 'px;' : '';
	$css_styles .= ( $popup_image_bg ) ? ' background-image: url("' . $popup_image_bg . '");' : '';
	$css_styles .= ( $popups_color_bg ) ? ' background-color: ' . $popups_color_bg . ';' : '';
	$css_styles .= ( $popups_border_radius ) ? ' border-radius: ' . $popups_border_radius . 'px;' : ' border-radius: 0px;';

	$css_class .= $popup_template_name . ' ' . $popup_animation;
	?>
<div class="consulting-popup">
	<div class="consulting-close-popup-wrapper"></div>
	<div class="consulting-popup-content <?php echo esc_attr( $css_class ); ?>" style="<?php echo esc_attr( $popup_width_max_width ); ?>">
		<span class="stm-lnr-close stm-popup-close consulting-close-popup"></span>
		<div class="consulting-popup-content-box" style="<?php echo esc_attr( $css_styles ); ?>">
			<?php
			$vc_enabled = get_post_meta( $popup_id, '_wpb_vc_js_status', true );
			if ( $vc_enabled ) {
				$popup_post    = get_post( $popup_id );
				$popup_content = $popup_post->post_content;
				WPBMap::addAllMappedShortcodes();
				echo do_shortcode( apply_filters( 'the_content', $popup_content ) );

				$shortcodes_custom_css = get_post_meta( $popup_id, '_wpb_shortcodes_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					$shortcodes_custom_css = wp_strip_all_tags( $shortcodes_custom_css );
					echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
					echo esc_html( $shortcodes_custom_css );
					echo '</style>';
				}
			}

			if ( class_exists( '\\Elementor\\Plugin' ) ) {
				$plugin_name   = \Elementor\Plugin::instance();
				$popup_content = $plugin_name->frontend->get_builder_content( $popup_id );
				echo do_shortcode( $popup_content );
			}
			?>
		</div>
	</div>
</div>
	<?php
endif;
