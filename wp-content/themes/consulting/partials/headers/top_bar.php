<div class="top_bar <?php echo esc_attr( consulting_top_bar_classes() ); ?>">
	<div class="container">
		<?php
		if ( function_exists( 'icl_object_id' ) && (bool) consulting_theme_option( 'wpml_switcher', false ) ) {
			if ( consulting_theme_option( 'wpml_switcher_style', false ) === 'wpml_default' ) {
				echo '<div class="lang_sel header_lang_sel">';
				do_action( 'wpml_add_language_selector' );
				echo '</div>';
			} else {
				consulting_topbar_lang();
			}
		}

		$top_bar_info_display = consulting_theme_option( 'offices_contact_display' );
		$top_bar_info         = consulting_theme_option( 'offices_contact', array() );
		$top_bar_align        = ( consulting_theme_option( 'offices_contact_align' ) ) ? consulting_theme_option( 'offices_contact_align' ) : 'right';
		if ( ! empty( $top_bar_info_display ) ) {
			?>
			<div class="top_bar_info_wr" style="justify-content: <?php echo esc_attr( $top_bar_align ); ?>">
				<?php if ( count( $top_bar_info ) > 1 ) : ?>
					<div class="top_bar_info_switcher">
						<div class="active">
							<span><?php echo esc_attr( $top_bar_info[0]['top_bar_contact_office'] ) ? wp_kses_post( $top_bar_info[0]['top_bar_contact_office'] ) : esc_html__( 'Active Office', 'consulting' ); ?></span>
						</div>
						<ul>
							<?php foreach ( $top_bar_info as $key => $val ) : ?>
							<li>
								<a href="#" data-href="top_bar_info_<?php echo esc_attr( $key ); ?>"><?php echo $val['top_bar_contact_office'] ? wp_kses_post( $val['top_bar_contact_office'] ) : esc_html__( 'Top bar Office', 'consulting' ); ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php
				endif;
				foreach ( $top_bar_info as $key => $val ) :
					?>
					<ul class="top_bar_info" id="top_bar_info_<?php echo esc_attr( $key ); ?>"
						<?php
						if ( 0 === $key ) {
							echo ' style="display: block;"'; }
						?>
					>
					<?php if ( ! empty( $val['top_bar_contact_address'] ) ) : ?>
						<li>
							<?php if ( ! empty( $val['top_bar_contact_address_icon']['icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $val['top_bar_contact_address_icon']['icon'] ); ?>" style="font-size: <?php echo esc_attr( $val['top_bar_contact_address_icon']['size'] ); ?>px; color: <?php echo esc_attr( $val['top_bar_contact_address_icon']['color'] ); ?>;"></i>
							<?php endif; ?>
							<span><?php echo esc_attr( $val['top_bar_contact_address'] ) ? wp_kses_post( $val['top_bar_contact_address'] ) : esc_html__( 'Top bar address', 'consulting' ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( ! empty( $val['top_bar_contact_hours'] ) ) : ?>
						<li>
							<?php if ( ! empty( $val['top_bar_contact_hours_icon']['icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $val['top_bar_contact_hours_icon']['icon'] ); ?>" style="font-size: <?php echo esc_attr( $val['top_bar_contact_hours_icon']['size'] ); ?>px; color: <?php echo esc_attr( $val['top_bar_contact_hours_icon']['color'] ); ?>;"></i>
							<?php endif; ?>
							<span><?php echo esc_attr( $val['top_bar_contact_hours'] ) ? wp_kses_post( $val['top_bar_contact_hours'] ) : esc_html__( 'Top bar hours', 'consulting' ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( ! empty( $val['top_bar_contact_email'] ) ) : ?>
						<li>
							<?php if ( ! empty( $val['top_bar_contact_email_icon']['icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $val['top_bar_contact_email_icon']['icon'] ); ?>" style="font-size: <?php echo esc_attr( $val['top_bar_contact_email_icon']['size'] ); ?>px; color: <?php echo esc_attr( $val['top_bar_contact_email_icon']['color'] ); ?>;"></i>
							<?php endif; ?>
							<span><?php echo esc_attr( $val['top_bar_contact_email'] ) ? wp_kses_post( $val['top_bar_contact_email'] ) : esc_html__( 'Top bar email', 'consulting' ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( ! empty( $val['top_bar_contact_phone'] ) ) : ?>
						<li>
							<?php if ( ! empty( $val['top_bar_contact_phone_icon']['icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $val['top_bar_contact_phone_icon']['icon'] ); ?>" style="font-size: <?php echo esc_attr( $val['top_bar_contact_phone_icon']['size'] ); ?>px; color: <?php echo esc_attr( $val['top_bar_contact_phone_icon']['color'] ); ?>;"></i>
							<?php endif; ?>
							<span><?php echo esc_attr( $val['top_bar_contact_phone'] ) ? wp_kses_post( $val['top_bar_contact_phone'] ) : esc_html__( 'Top bar phone', 'consulting' ); ?></span>
						</li>
						<?php endif; ?>
					</ul>
				<?php endforeach; ?>
			</div>
		<?php } ?>

		<?php
		$socials = consulting_get_socials();
		if ( consulting_theme_option( 'top_bar_socials', false ) ) {
			?>
			<div class="top_bar_socials">
				<?php foreach ( $socials as $key => $val ) : ?>
					<a target="_blank" href="<?php echo esc_attr( $val ); ?>">
						<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
					</a>
				<?php endforeach; ?>
			</div>
		<?php } ?>

		<?php if ( class_exists( 'WooCommerce' ) && consulting_theme_option( 'wc_topbar_cart_hide', false ) ) : ?>
			<div class="top_bar_cart">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
					<i class="stm-shopping-cart8">&nbsp;</i><?php get_template_part( 'partials/mini', 'cart' ); ?></a>
			</div>
		<?php endif; ?>

		<?php if ( consulting_theme_option( 'top_bar_search', false ) ) { ?>
			<div class="top_bar_search header_search_in_popup">
				<i class="fa fa-search search-icon">&nbsp;</i>
				<?php get_search_form( true ); ?>
			</div>
		<?php } ?>
	</div>
</div>
