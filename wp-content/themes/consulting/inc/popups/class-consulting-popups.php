<?php

class Consulting_Popups {
	public function __construct() {
		add_action( 'wp_ajax_nopriv_consulting_popup_content_action', array( $this, 'load_template' ) );
		add_action( 'wp_ajax_consulting_popup_content_action', array( $this, 'load_template' ) );
		add_filter( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wpcf7_init', array( $this, 'ajaxs_render_event' ) );
	}

	public function load_template() {
		get_template_part( 'inc/popups/template/popup' );
		wp_die();
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'consulting-popups', get_stylesheet_directory_uri() . '/assets/css/layouts/global_styles/popups.css', false, CONSULTING_THEME_VERSION );
		wp_enqueue_script( 'countdown' );

		if ( defined( 'ELEMENTOR_VERSION' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() && class_exists( '\\Elementor\\Plugin' ) || get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ) ) {
			function consulting_elementor_popups() {
				$popups_width  = ( get_post_meta( get_the_ID(), 'popups_width', true ) ) ? get_post_meta( get_the_ID(), 'popups_width', true ) . 'px;' : 'auto';
				$popups_height = ( get_post_meta( get_the_ID(), 'popups_height', true ) ) ? get_post_meta( get_the_ID(), 'popups_height', true ) . 'px;' : 'auto';
				ob_start();
				$custom_css = "
				.single-stm_popups .content_wrapper {
					background-color: #cacaca;
					padding-top: 100px;
				}
				.single-stm_popups #main {
					max-width: $popups_width;
					min-height: $popups_height;
					margin: 0 auto;
				}
				.single-stm_popups #main .stm_popups .elementor > .elementor-section-wrap > .elementor-element {
					min-height: $popups_height;
				}";
				ob_end_clean();
				return $custom_css;
			}
			wp_add_inline_style( 'consulting-popups', consulting_elementor_popups() );
			wp_enqueue_script( 'consulting-popups-frame', get_stylesheet_directory_uri() . '/assets/js/popups/popup_elementor_frame.js', false, CONSULTING_THEME_VERSION, true );
		}

		if ( ! is_admin() && defined( 'ELEMENTOR_VERSION' ) && ! \Elementor\Plugin::$instance->preview->is_preview_mode() || ! is_admin() || get_post_meta( get_the_ID(), '_wpb_vc_js_status', true ) ) {
			$popup_global_animation = consulting_theme_option( 'popup_animation', '' );
			$popup_single_animation = get_post_meta( get_the_ID(), 'popup_single_animation', true );
			$popup_animation        = ! empty( $popup_single_animation ) ? $popup_single_animation : $popup_global_animation;
			if ( ! empty( $popup_animation ) ) {
				wp_enqueue_style( 'consulting-animate.min.css', get_stylesheet_directory_uri() . '/assets/css/animate.min.css', false, CONSULTING_THEME_VERSION );
			}

			$popups_global_event = consulting_theme_option( 'popups_event', 'popup_event_on_load' );
			$popups_single_event = get_post_meta( get_the_ID(), 'popups_single_event', true );
			$popups_event        = ! empty( $popups_single_event ) ? $popups_single_event : $popups_global_event;
			if ( 'popup_event_on_load' === $popups_event || 'popup_event_inactivity' === $popups_event || 'popup_event_on_exit' === $popups_event ) {
				wp_enqueue_script( 'consulting-popups', get_stylesheet_directory_uri() . '/assets/js/popups/popup_event_on_load.js', false, CONSULTING_THEME_VERSION, true );
			}
			if ( 'popup_event_on_date' === $popups_event ) {
				$popup_single_show            = get_post_meta( get_the_ID(), 'show_popup_single', true );
				$popup_global_event_date_from = consulting_theme_option( 'popup_event_date_from', '' );
				$popup_single_event_date_from = get_post_meta( get_the_ID(), 'popup_single_event_date_from', true );
				$popup_event_date_from_found  = $popup_single_show ? $popup_single_event_date_from : $popup_global_event_date_from;
				$popup_event_date_from        = ! empty( $popup_event_date_from_found ) ? $popup_event_date_from_found / 1000 : '';
				$popup_global_event_date_to   = consulting_theme_option( 'popup_event_date_to', '' );
				$popup_single_event_date_to   = get_post_meta( get_the_ID(), 'popup_single_event_date_to', true );
				$popup_event_date_to_found    = $popup_single_show ? $popup_single_event_date_to : $popup_global_event_date_to;
				$popup_event_date_to          = ! empty( $popup_event_date_to_found ) ? $popup_event_date_to_found / 1000 + 19 * 60 * 60 : '';
				$current_date                 = strtotime( 'now' );

				if ( ! empty( $popup_event_date_from ) && empty( $popup_event_date_to ) && $current_date >= $popup_event_date_from ) {
					wp_enqueue_script( 'consulting-popups', get_stylesheet_directory_uri() . '/assets/js/popups/popup_event_on_load.js', false, CONSULTING_THEME_VERSION, true );
				}
				if ( empty( $popup_event_date_from ) && ! empty( $popup_event_date_to ) && $current_date <= $popup_event_date_to ) {
					wp_enqueue_script( 'consulting-popups', get_stylesheet_directory_uri() . '/assets/js/popups/popup_event_on_load.js', false, CONSULTING_THEME_VERSION, true );
				}
				if ( ! empty( $popup_event_date_from ) && ! empty( $popup_event_date_to ) && $current_date >= $popup_event_date_from && $current_date <= $popup_event_date_to ) {
					wp_enqueue_script( 'consulting-popups', get_stylesheet_directory_uri() . '/assets/js/popups/popup_event_on_load.js', false, CONSULTING_THEME_VERSION, true );
				}
			}
			if ( 'popup_event_on_time' === $popups_event ) {
				$popup_single_show            = get_post_meta( get_the_ID(), 'show_popup_single', true );
				$popup_global_event_time_from = consulting_theme_option( 'popup_event_time_from', '' );
				$popup_single_event_time_from = get_post_meta( get_the_ID(), 'popup_single_event_time_from', true );
				$popup_event_time_from        = $popup_single_show ? strtotime( $popup_single_event_time_from ) : strtotime( $popup_global_event_time_from );
				$popup_global_event_time_to   = consulting_theme_option( 'popup_event_time_to', '' );
				$popup_single_event_time_to   = get_post_meta( get_the_ID(), 'popup_single_event_time_to', true );
				$popup_event_time_to          = $popup_single_show ? strtotime( $popup_single_event_time_to ) : strtotime( $popup_global_event_time_to );
				$current_time                 = strtotime( current_time( 'H:i' ) );

				if ( ! empty( $popup_event_time_from ) && empty( $popup_event_time_to ) && $current_time >= $popup_event_time_from ) {
					wp_enqueue_script( 'consulting-popups', get_stylesheet_directory_uri() . '/assets/js/popups/popup_event_on_load.js', false, CONSULTING_THEME_VERSION, true );
				}
				if ( empty( $popup_event_time_from ) && ! empty( $popup_event_time_to ) && $current_time <= $popup_event_time_to ) {
					wp_enqueue_script( 'consulting-popups', get_stylesheet_directory_uri() . '/assets/js/popups/popup_event_on_load.js', false, CONSULTING_THEME_VERSION, true );
				}
				if ( ! empty( $popup_event_time_from ) && ! empty( $popup_event_time_to ) && $current_time >= $popup_event_time_from && $current_time <= $popup_event_time_to ) {
					wp_enqueue_script( 'consulting-popups', get_stylesheet_directory_uri() . '/assets/js/popups/popup_event_on_load.js', false, CONSULTING_THEME_VERSION, true );
				}
			}

			wp_localize_script(
				'consulting-popups',
				'consulting_popup_content',
				array(
					'url'       => admin_url( 'admin-ajax.php' ),
					'nonce'     => wp_create_nonce( 'consulting_popup_nonce' ),
					'id'        => get_the_ID(),
					'animation' => $popup_animation,
				)
			);

			wp_enqueue_style( 'elementor-frontend' );
			wp_enqueue_script( 'wpb_composer_front_js' );
			wp_enqueue_style( 'js_composer_front' );
			wp_enqueue_script( 'consulting-popups-on-click', get_stylesheet_directory_uri() . '/assets/js/popups/popup_event_on_click.js', false, CONSULTING_THEME_VERSION, true );
		}
	}

	public function ajaxs_render_event() {
		add_filter(
			'wpcf7_form_action_url',
			function ( $url ) {
				$url = str_replace( wpcf7_get_request_uri(), '/' . get_post( get_the_ID() )->post_name . '/', $url );
				return $url;
			}
		);
	}
}
new Consulting_Popups();
