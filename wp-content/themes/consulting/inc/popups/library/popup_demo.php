<?php
$elementor_popups = array(
	array(
		'title'    => 'Contact Form 1',
		'image'    => 'contact-form-1.png',
		'template' => 'contact-form-1',
		'triggers' => 'On Page Load, After Inactivity Time, On Exit Intent',
	),
	array(
		'title'    => 'Contact Form 2',
		'image'    => 'contact-form-2.png',
		'template' => 'contact-form-2',
		'triggers' => 'After Inactivity Time, On Page Load',
	),
	array(
		'title'    => 'Address',
		'image'    => 'address.png',
		'template' => 'address',
		'triggers' => 'On Page Load, After Inactivity Time',
	),
	array(
		'title'    => 'Countdown 1',
		'image'    => 'countdown-1.png',
		'template' => 'countdown-1',
		'triggers' => 'In Date Period, In Time Period',
	),
	array(
		'title'    => 'Countdown 2',
		'image'    => 'countdown-2.png',
		'template' => 'countdown-2',
		'triggers' => 'In Date Period, In Time Period',
	),
	array(
		'title'    => 'Discount 1',
		'image'    => 'discount-1.png',
		'template' => 'discount-1',
		'triggers' => 'On Page Load, In Date Period, After Inactivity Time',
	),
	array(
		'title'    => 'Discount 2',
		'image'    => 'discount-2.png',
		'template' => 'discount-2',
		'triggers' => 'On Exit Intent, In Date Period, On Page Load',
	),
	array(
		'title'    => 'Subscribe 1',
		'image'    => 'subscribe-1.png',
		'template' => 'subscribe-1',
		'triggers' => 'On Exit Intent, After Inactivity Time',
	),
	array(
		'title'    => 'Subscribe 2',
		'image'    => 'subscribe-2.png',
		'template' => 'subscribe-2',
		'triggers' => 'On Page Load, After Inactivity Time',
	),
	array(
		'title'    => 'Video',
		'image'    => 'video.png',
		'template' => 'video',
		'triggers' => 'On Exit Intent, After Inactivity Time',
	),
	array(
		'title'    => 'Call to action',
		'image'    => 'call-to-action.png',
		'template' => 'call-to-action',
		'triggers' => 'On Exit Intent, On Page Load, After Inactivity Time',
	),
	array(
		'title'    => 'Image',
		'image'    => 'image.png',
		'template' => 'image',
		'triggers' => 'After Inactivity Time, On Page Load, On Exit Intent',
	),
	array(
		'title'    => 'Download',
		'image'    => 'download.png',
		'template' => 'download',
		'triggers' => 'On Page Load, After Inactivity Time, On Exit Intent',
	),
	array(
		'title'    => 'Pricing',
		'image'    => 'pricing.png',
		'template' => 'pricing',
		'triggers' => 'After Inactivity Time, On Exit Intent, On Page Load',
	),
);
$wpbakery_popups  = array(
	array(
		'title'    => 'Contact Form 1',
		'image'    => 'contact-form-1.png',
		'template' => 'contact-form-1-wpbakery',
		'triggers' => 'On Page Load, After Inactivity Time, On Exit Intent',
	),
	array(
		'title'    => 'Contact Form 2',
		'image'    => 'contact-form-2.png',
		'template' => 'contact-form-2-wpbakery',
		'triggers' => 'After Inactivity Time, On Page Load',
	),
	array(
		'title'    => 'Discount 2',
		'image'    => 'discount-2.png',
		'template' => 'discount-2-wpbakery',
		'triggers' => 'On Exit Intent, In Date Period, On Page Load',
	),
	array(
		'title'    => 'Image',
		'image'    => 'image.png',
		'template' => 'image-wpbakery',
		'triggers' => 'After Inactivity Time, On Page Load, On Exit Intent',
	),
);

$all_popups       = get_option( 'consulting_popups' );
$installed_popups = ! empty( $all_popups ) ? implode( '-', $all_popups ) : '';
$all_posts        = consulting_popups_slug();
?>
	<div class="popup-library-box-title"><?php esc_html_e( 'Popups Library Templates', 'consulting' ); ?></div>
	<div class="popup-library-box">
		<div class="popup-library-box__tabs">
			<div class="tab-elementor active">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/popups/elementor.svg' ); ?>" alt="<?php esc_html_e( 'Consulting Popup with Elementor', 'consulting' ); ?>" />
				<span class="popup-count"><?php echo count( $elementor_popups ); ?></span>
			</div>
			<div class="tab-wpbakery">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/popups/wp_bakery.svg' ); ?>" alt="<?php esc_html_e( 'Consulting Popup with WPBakery', 'consulting' ); ?>" />
				<span class="popup-count"><?php echo count( $wpbakery_popups ); ?></span>
			</div>
		</div>
		<div class="popup-library-box__tabs-content">
			<div class="tab-elementor-content">
				<?php if ( defined( 'ELEMENTOR_VERSION' ) ) : ?>
				<div class="popup-library-box-sub-title"><?php esc_html_e( 'Select Popup', 'consulting' ); ?></div>
				<ul>
					<?php foreach ( $elementor_popups as $popup ) : ?>
						<li>
							<div class="popup-library-box__preview">
								<div class="popup-library-box__screen <?php if (in_array( $popup['template'], $all_posts, true ) ) : ?> installed<?php endif;// phpcs:ignore ?>">
									<div href="" class="popup-button-installed"><?php esc_html_e( 'Installed', 'consulting' ); ?></div>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/popups/templates/' . $popup['image'] ); ?>" alt="<?php echo esc_url( $popup['image'] ); ?>" />
									<div class="popup-library-box__buttons">
										<div class="popup-library-box__install">
											<span class="popup-button-install" data-popup="<?php echo esc_attr( $popup['template'] ); ?>" data-builder="elementor" data-installed-popup="<?php echo esc_attr( $installed_popups ); ?>"><?php esc_html_e( 'Install', 'consulting' ); ?></span>
											<span class="popup-button-installing"><i class="fa fa-spinner fa-spin popup-button-spinner"></i><?php esc_html_e( 'Installing...', 'consulting' ); ?></span>
										</div>
									</div>
								</div>
								<div class="popup-library-box__title"><?php echo esc_attr( $popup['title'] ); ?></div>
								<?php if ( ! empty( $popup['triggers'] ) ) : ?>
									<div class="popup-library-box__triggers"><a href="<?php echo esc_url( admin_url( 'admin.php?page=consulting_settings#popups' ) ); ?>"><?php esc_html_e( 'Recommended triggers:', 'consulting' ); ?></a> <?php echo esc_attr( $popup['triggers'] ); ?></div>
								<?php endif; ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php else : ?>
				<div class="tab-content-defined">
					<div class="plugin-logo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/popups/elementor-logo.svg' ); ?>" alt="<?php esc_html_e( 'Elementor Plugin Required', 'consulting' ); ?>" /></div>
					<div class="plugin-name"><?php esc_html_e( 'Elementor Plugin Required', 'consulting' ); ?></div>
					<a href="<?php echo esc_url( admin_url( 'plugin-install.php' ) ); ?>" class="plugin-button"><?php esc_html_e( 'install', 'consulting' ); ?></a>
				</div>
				<?php endif; ?>
			</div>

			<div class="tab-wpbakery-content">
				<?php if ( defined( 'WPB_VC_VERSION' ) ) : ?>
				<div class="popup-library-box-sub-title"><?php esc_html_e( 'Select Popup', 'consulting' ); ?></div>
				<ul>
					<?php foreach ( $wpbakery_popups as $popup ) : ?>
						<li>
							<div class="popup-library-box__preview">
								<div class="popup-library-box__screen<?php if ( in_array( $popup['template'], $all_posts, true ) ) : ?> installed<?php endif;// phpcs:ignore ?>">
									<div href="" class="popup-button-installed"><?php esc_html_e( 'Installed', 'consulting' ); ?></div>
									<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/popups/templates/' . $popup['image'] ); ?>" alt="<?php echo esc_url( $popup['title'] ); ?>" />
									<div class="popup-library-box__buttons">
										<div class="popup-library-box__install">
											<span class="popup-button-install" data-popup="<?php echo esc_attr( $popup['template'] ); ?>"  data-builder="wpbakery" data-installed-popup="<?php echo esc_attr( $installed_popups ); ?>"><?php esc_html_e( 'Install', 'consulting' ); ?></span>
											<span class="popup-button-installing"><i class="fa fa-spinner fa-spin popup-button-spinner"></i><?php esc_html_e( 'Installing...', 'consulting' ); ?></span>
										</div>
									</div>
								</div>
								<div class="popup-library-box__title"><?php echo esc_attr( $popup['title'] ); ?></div>
								<?php if ( ! empty( $popup['triggers'] ) ) : ?>
									<div class="popup-library-box__triggers"><a href="<?php echo esc_url( admin_url( 'admin.php?page=consulting_settings#popups' ) ); ?>"><?php esc_html_e( 'Recommended triggers:', 'consulting' ); ?></a> <?php echo esc_attr( $popup['triggers'] ); ?></div>
								<?php endif; ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php else : ?>
				<div class="tab-content-defined">
					<div class="plugin-logo wpbakery-logo"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/popups/wpbakery-logo.svg' ); ?>" alt="<?php esc_html_e( 'Elementor Plugin Required', 'consulting' ); ?>" /></div>
					<div class="plugin-name"><?php esc_html_e( 'WPBakery Plugin Required', 'consulting' ); ?></div>
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins&plugin_status=all' ) ); ?>" class="plugin-button"><?php esc_html_e( 'install', 'consulting' ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<script>
		var import_popup_nonce = '<?php echo esc_js( wp_create_nonce( 'stm_demo_import_popup' ) ); ?>';
		var default_popup      = '<?php echo esc_attr( apply_filters( 'stm_theme_default_popup', '' ) ); ?>';
	</script>
<?php
