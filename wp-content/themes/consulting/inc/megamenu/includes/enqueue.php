<?php
function stm_megamenu_front_scripts_method() {
	$base_url  = get_template_directory_uri() . '/inc/';
	$front_css = $base_url . 'megamenu/assets/css/';
	$front_js  = $base_url . 'megamenu/assets/js/';
	wp_enqueue_style( 'stm_megamenu', $front_css . 'megamenu.css', array(), CONSULTING_THEME_VERSION );
	wp_enqueue_script(
		'stm_megamenu',
		$front_js . 'megamenu.js',
		array( 'jquery' ),
		CONSULTING_THEME_VERSION,
		array(
			'strategy'  => 'defer',
			'in_footer' => true,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'stm_megamenu_front_scripts_method' );
