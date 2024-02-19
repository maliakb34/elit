<?php
function stm_popup_import_content( $popup_template, $popup_builder ) {
	set_time_limit( 0 );

	if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
		define( 'WP_LOAD_IMPORTERS', true );
	}

	require_once STM_CONFIGURATIONS_PATH . '/wordpress-importer/class-stm-wp-import.php';

	$wp_import        = new STM_WP_Import();
	$wp_import->theme = 'consulting';
	$wp_import->popup = $popup_template;

	$ready = STM_CONFIGURATIONS_PATH . '/demos/popups/' . $popup_builder . '/' . $popup_template . '.xml';

	if ( is_wp_error( $ready ) ) {
		return $ready;
	}

	if ( $ready ) {
		ob_start();
		$wp_import->import( $ready );
		ob_end_clean();
	}

	return true;
}
