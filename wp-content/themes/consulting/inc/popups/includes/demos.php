<?php
add_action( 'admin_menu', 'consulting_register_popop_sub_menu' );

function consulting_register_popop_sub_menu() {
	add_submenu_page(
		'edit.php?post_type=stm_popups',
		'Popups Library',
		'Popups Library',
		'manage_options',
		'templates-page',
		'consulting_popup_templates_page_callback',
		'0'
	);
}

function consulting_popup_templates_page_callback() {
	require_once CONSULTING_INC_PATH . '/popups/library/popup_demo.php';
}

function consulting_popup_templates_library() {
	if ( is_admin() ) {
		wp_enqueue_style( 'consulting-popups-library', get_stylesheet_directory_uri() . '/assets/css/layouts/global_styles/popups_library.css', false, CONSULTING_THEME_VERSION );
		wp_enqueue_script( 'consulting-popups-custom', get_stylesheet_directory_uri() . '/assets/js/popups/popup_custom_scripts.js', false, CONSULTING_THEME_VERSION, true );
		wp_enqueue_script( 'consulting-popups-demo-import', get_stylesheet_directory_uri() . '/assets/js/popups/popup_demo_import.js', false, CONSULTING_THEME_VERSION, true );
	}
}

add_action( 'admin_enqueue_scripts', 'consulting_popup_templates_library' );
