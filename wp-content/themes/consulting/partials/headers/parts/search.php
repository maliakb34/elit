<?php
if ( (bool) consulting_theme_option( 'header_button', false ) ) :
	wp_enqueue_style( 'consulting-header-button', get_template_directory_uri() . '/assets/css/layouts/global_styles/header/button.css', null, CONSULTING_THEME_VERSION, 'all' );

	$header_button_title  = consulting_theme_option( 'header_button_link_text', false );
	$header_button_url    = consulting_theme_option( 'header_button_link_url', false );
	$header_button_target = (bool) consulting_theme_option( 'header_button_link_target', false ) ? 'target=_blank' : '';
	$header_button_follow = (bool) consulting_theme_option( 'header_button_link_follow', false ) ? 'rel=nofollow' : '';
	$header_button_mobile = (bool) consulting_theme_option( 'header_button_mobile', false );
	$header_button_icon   = consulting_theme_option( 'header_button_icon', false );
	?>
	<a href="<?php echo esc_url( $header_button_url ); ?>" <?php echo esc_attr( $header_button_target ); ?> <?php echo esc_attr( $header_button_follow ); ?> class="consulting-header-button
	<?php
	if ( ! $header_button_mobile ) {
		echo 'hide_on_mobile';
	}
	?>
	"><i class="<?php echo esc_attr( $header_button_icon['icon'] ); ?>"></i><?php echo esc_html( $header_button_title ); ?></a>
	<?php
endif;
