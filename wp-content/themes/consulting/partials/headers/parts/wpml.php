<?php
if ( (bool) consulting_theme_option( 'header_wpml_switcher', false ) ) :
	wp_enqueue_style( 'consulting-header-button', get_template_directory_uri() . '/assets/css/layouts/global_styles/header/button.css', null, CONSULTING_THEME_VERSION, 'all' );

	if ( function_exists( 'icl_object_id' ) && (bool) consulting_theme_option( 'header_wpml_switcher', false ) ) {
		if ( consulting_theme_option( 'header_wpml_switcher_style', false ) === 'wpml_default' ) {
			echo '<div class="lang_sel header_lang_sel">';
			do_action( 'wpml_add_language_selector' );
			echo '</div>';
		} else {
			consulting_topbar_lang();
		}
	}
endif;
