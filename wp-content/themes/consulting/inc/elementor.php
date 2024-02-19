<?php

function consulting_locate_template( $template_name ) {
	$template_name = '/partials/vc_templates/' . $template_name . '.php';

	return locate_template( $template_name );
}

function consulting_load_template( $template_name, $vars = array() ) {
	ob_start();
	extract( $vars );// phpcs:ignore
	include( consulting_locate_template( $template_name ) );// phpcs:ignore
	return apply_filters( "consulting_template_{$template_name}", ob_get_clean(), $vars );
}

function consulting_show_template( $template_name, $vars = array() ) {
	echo consulting_load_template( $template_name, $vars );// phpcs:ignore
}

add_action(
	'admin_init',
	function () {
		delete_transient( 'elementor_activation_redirect' );
	}
);

/**
 * Locate template in vc styles
 *
 * @param string|array $templates Single or array of template files
 *
 * @return string
 */
function consulting_locate_vc_element( $templates, $custom_path, $template_name = '' ) {
	$located = false;

	foreach ( (array) $templates as $template ) {

		$folder = $template;

		if ( ! empty( $template_name ) ) {
			$template = $template_name;
		}

		if ( substr( $template, -4 ) !== '.php' ) {
			$template .= '.php';
		}

		if ( empty( $custom_path ) ) {
			if ( ! ( $located = locate_template( 'partials/vc_templates/' . $folder . '/' . $template ) ) ) {// phpcs:ignore
				$located = get_template_directory() . '/partials/vc_templates/' . $folder . '/' . $template;
			}
		} else {
			if ( ! ( $located = locate_template( $custom_path ) ) ) {// phpcs:ignore
				$located = get_template_directory() . '/' . $custom_path . '.php';
			}
		}

		if ( file_exists( $template_name ) ) {
			break;
		}
	}

	return apply_filters( 'consulting_locate_vc_element', $located, $templates );
}

/**
 * Load template
 *
 * @param       $__template
 * @param array $__vars
 */
function consulting_load_vc_element( $__template, $__vars = array(), $__template_name = '', $custom_path = '' ) {
	extract( $__vars );// phpcs:ignore
	$element = consulting_locate_vc_element( $__template, $custom_path, $__template_name );
	if ( ! file_exists( $element ) && strpos( $__template_name, 'style_' ) !== false ) {
		$element = str_replace( $__template_name, 'style_1', $element );
	}
	if ( file_exists( $element ) ) {
		include $element;// phpcs:ignore
	} else {
		echo esc_html__( 'Element not found in ' . $element, 'consulting' );// phpcs:ignore
	}
}
