<?php
/*
Plugin Name: STM Importer
Plugin URI: https://stylemixthemes.com/
Description: STM Importer plugin for Demo Content Import.
Author: StylemixThemes
Author URI: https://stylemixthemes.com/
Text Domain: stm_importer
Version: 6.1.2
*/

define( 'STM_CONFIGURATIONS_PATH', dirname( __FILE__ ) );
define( 'STM_CONFIGURATIONS_URL', plugin_dir_url( __FILE__ ) );

if ( is_admin() ) {
	add_action( 'wp_ajax_stm_demo_import_content', 'stm_demo_import_content' );
	add_action( 'wp_ajax_stm_demo_import_popup', 'stm_demo_import_popup' );
}

/**
 * Removed bookit redirect
 */
add_action(
	'admin_init',
	function () {
		delete_transient( 'fs_plugin_bookit_activated' );
	}
);

require_once STM_CONFIGURATIONS_PATH . '/helpers/before_content.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/content.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/images-patcher.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/theme_options.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/plugins_options.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/popup.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/slider.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/widgets.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/set_content.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/set_hb_options.php';
require_once STM_CONFIGURATIONS_PATH . '/helpers/megamenu/config.php';

/**
 * Demo Import Ajax Action
 */
function stm_demo_import_content() {
	if ( ! current_user_can( 'administrator' ) ) {
		die;
	}
	check_ajax_referer( 'stm_demo_import_content', 'nonce' );
	$layout       = ! empty( $_GET['demo_template'] ) ? sanitize_title( $_GET['demo_template'] ) : 'default';
	$builder      = ! empty( $_GET['builder'] ) ? sanitize_title( $_GET['builder'] ) : 'js_composer';
	$import_data  = ! empty( $_GET['import_data'] ) ? sanitize_title( $_GET['import_data'] ) : '';
	$import_media = ! empty( $_GET['import_media'] ) ? ( 'true' === $_GET['import_media'] ) : false;

	// Run demo import parts
	$res = stm_demo_import_content_cli( $layout, $builder, $import_data, $import_media );
	if ( is_wp_error( $res ) ) {
		wp_send_json_error( $res, 400 );
	}

	if ( ! empty( $import_data ) ) {
		wp_send_json(
			array(
				'imported' => $import_data,
			)
		);
	} else {
		wp_send_json(
			array(
				'url'                 => get_bloginfo( 'url' ),
				'title'               => esc_html__( 'View site', 'consulting' ),
				'theme_options_title' => esc_html__( 'Theme options', 'consulting' ),
				'theme_options'       => esc_url_raw( admin_url( 'customize.php' ) ),
			)
		);
	}

	die();
}

/**
 * Run Demo Import
 *
 * @param $layout
 * @param $builder
 * @param $import_data
 * @param $import_media
 *
 * @return array|bool|string|\WP_Error
 */
function stm_demo_import_content_cli( $layout, $builder, $import_data, $import_media ) {
	switch ( $import_data ) {
		case 'content':
			stm_theme_before_import_content( $layout, $builder );
			/** Import content */
			$import_result = stm_theme_import_content( $layout, $builder, $import_media );
			if ( $import_result && 'js_composer' === $builder ) {
				consulting_update_placeholder();
			}
			return $import_result;
		case 'media':
			/** Import media for content */
			stm_theme_import_image_patch( $layout, $builder, $import_media );
			break;
		case 'theme_options':
			/** Import theme options */
			stm_set_layout_options( $layout );
			/** Import plugins options */
			stm_set_plugins_layout_options( $layout );
			/** Import header builder */
			stm_set_hb_options( $layout );
			break;
		case 'sliders':
			/** Import sliders */
			stm_theme_import_sliders( $layout );
			/**  Replacing images in posts */
			consulting_replace_images_in_thumbnail();
			break;
		case 'widgets':
			/** Import Widgets */
			stm_theme_import_widgets( $layout );
			/** Set menu and pages */
			stm_set_content_options( $layout, $builder );
			break;
		default:
			update_option( 'consulting_layout', $layout );
			do_action( 'consulting_importer_done', $layout );
	}
}

/**
 * Demo Import Popup Ajax Action
 */
function stm_demo_import_popup() {
	if ( ! current_user_can( 'administrator' ) ) {
		die;
	}
	check_ajax_referer( 'stm_demo_import_popup', 'nonce' );
	$popup_template  = ! empty( $_GET['popup_template'] ) ? sanitize_title( $_GET['popup_template'] ) : 'contact_form_1';
	$installed_popup = ! empty( $_GET['installed_popup'] ) ? sanitize_title( $_GET['installed_popup'] ) : '';
	$popup_builder   = ! empty( $_GET['popup_builder'] ) ? sanitize_title( $_GET['popup_builder'] ) : 'elementor';

	$popup_import = stm_popup_demo_import( $popup_template, $installed_popup, $popup_builder );
	if ( is_wp_error( $popup_import ) ) {
		wp_send_json_error( $popup_import, 400 );
	}

	die();
}

/**
 * Run Popup Demo Import
 *
 * @param $popup_template
 *
 * @return array|bool|string|\WP_Error
 */
function stm_popup_demo_import( $popup_template, $installed_popup, $popup_builder ) {
	$new        = explode( '-', $popup_template );
	$old_popups = explode( '-', $installed_popup );
	$installed  = array_merge( $new, $old_popups );

	$elementor_cpt_support = array(
		'page',
		'post',
		'stm_popups',
	);
	update_option( 'elementor_cpt_support', $elementor_cpt_support );

	function stm_popup_bakery_activate() {
		$bakery_option = get_option( 'wp_user_roles' );
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types']                  = 'custom';
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/post']             = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_event']        = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_staff']        = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_portfolio']    = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm-zoom-webinar'] = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/page']             = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/event_member']     = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_works']        = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_service']      = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_testimonials'] = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/product']          = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_careers']      = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_vc_sidebar']   = 1;
		$bakery_option['administrator']['capabilities']['vc_access_rules_post_types/stm_popups']       = 1;

		return $bakery_option;
	}
	update_option( 'wp_user_roles', stm_popup_bakery_activate() );
	update_option( 'consulting_popups', $installed );
	return stm_popup_import_content( $popup_template, $popup_builder );
}
