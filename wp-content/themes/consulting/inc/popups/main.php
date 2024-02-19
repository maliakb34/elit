<?php
$global_popup_id = consulting_theme_option( 'show_popup', '' );
$post_popup      = get_post_meta( get_the_ID(), 'show_popup_single', true );

if ( ! empty( $global_popup_id ) || 'on' === $post_popup ) {
	require_once CONSULTING_INC_PATH . '/popups/includes/extras.php';
	require_once CONSULTING_INC_PATH . '/popups/class-consulting-popups.php';
}

require_once CONSULTING_INC_PATH . '/popups/includes/demos.php';
