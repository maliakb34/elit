<?php
consulting_get_header();
$custom_page_option = consulting_theme_option( '404_page' );
$page_id            = consulting_theme_option( '404_page_dropdown' );
wp_enqueue_style( 'elementor-frontend' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style( 'js_composer_front' );
?>
	<div class="page_404">
		<?php
		if ( ! empty( $custom_page_option ) && ! empty( $page_id ) ) {
			if ( defined( 'ELEMENTOR_VERSION' ) && ! empty( get_post_meta( $page_id, '_elementor_edit_mode', 'builder' ) ) ) {
				delete_post_meta( $page_id, '_wpb_vc_js_status' );
				$plugin_name  = \Elementor\Plugin::instance();
				$page_content = $plugin_name->frontend->get_builder_content( $page_id );
				echo do_shortcode( $page_content );
			} elseif ( defined( 'WPB_VC_VERSION' ) && 'true' === get_post_meta( $page_id, '_wpb_vc_js_status', true ) ) {
				delete_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
				?>
				<div class="container">
					<?php
					$page_post    = get_post( $page_id );
					$page_content = $page_post->post_content;
					WPBMap::addAllMappedShortcodes();
					echo do_shortcode( apply_filters( 'the_content', $page_content ) );
					$shortcodes_custom_css = get_post_meta( $page_id, '_wpb_shortcodes_custom_css', true );
					if ( ! empty( $shortcodes_custom_css ) ) {
						$shortcodes_custom_css = wp_strip_all_tags( $shortcodes_custom_css );
						echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
						echo esc_html( $shortcodes_custom_css );
						echo '</style>';
					}
					?>
				</div>
				<?php
			}
		} else {
			?>
			<div class="bottom">
				<div class="container">
					<h1>404</h1>
				</div>
				<div class="bottom_wr">
					<div class="container">
						<div class="media">
							<div class="media-body media-middle">
								<h3><?php esc_html_e( 'The page you are looking for does not exist.', 'consulting' ); ?></h3>
							</div>
							<div class="media-right media-middle">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
										class="button icon_right theme_style_3 bordered">
									<?php esc_html_e( 'homepage', 'consulting' ); ?>
									<i class="fa fa-chevron-right"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
<?php get_footer(); ?>
