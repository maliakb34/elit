<?php
function consulting_header_css() {
	$page_id = consulting_page_id();

	ob_start();
	?>
	:root {
	<?php
	//Top Bar Styles
	if ( metadata_exists( 'post', $page_id, 'top_bar_bg' ) ) {
		$top_bar_bg = implode( get_post_meta( $page_id, 'top_bar_bg' ) ) ? implode( get_post_meta( $page_id, 'top_bar_bg' ) ) : consulting_theme_option( 'top_bar_bg' );
		if ( ! empty( $top_bar_bg ) ) {
			echo '--con_top_bar_bg: ' . esc_attr( $top_bar_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_bg' ) ) ) {
		echo '--con_top_bar_bg: ' . esc_attr( consulting_theme_option( 'top_bar_bg' ) ) . ';';
	}
	if ( ! empty( consulting_theme_option_indents( 'top_bar_shadow_params' ) ) ) {
		echo '--con_top_bar_shadow_params: ' . esc_attr( consulting_theme_option_indents( 'top_bar_shadow_params' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_shadow_color' ) ) {
		$top_bar_shadow_color = implode( get_post_meta( $page_id, 'top_bar_shadow_color' ) ) ? implode( get_post_meta( $page_id, 'top_bar_shadow_color' ) ) : consulting_theme_option( 'top_bar_shadow_color' );
		if ( ! empty( $top_bar_shadow_color ) ) {
			echo '--con_top_bar_shadow_color: ' . esc_attr( $top_bar_shadow_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_shadow_color' ) ) ) {
		echo '--con_top_bar_shadow_color: ' . esc_attr( consulting_theme_option( 'top_bar_shadow_color' ) ) . ';';
	}
	//Top Bar Cart Styles
	$top_bar_cart_icon_typography = ( consulting_theme_option( 'wc_top_bar_cart_icon_typography' ) );
	if ( ! empty( $top_bar_cart_icon_typography['line-height'] ) ) {
		echo '--con_top_bar_cart_icon_line_height: ' . esc_attr( $top_bar_cart_icon_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $top_bar_cart_icon_typography['font-size'] ) ) {
		echo '--con_top_bar_cart_icon_font_size: ' . esc_attr( $top_bar_cart_icon_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_top_bar_cart_color' ) ) {
		$top_bar_cart_icon_color = implode( get_post_meta( $page_id, 'wc_top_bar_cart_color' ) ) ? implode( get_post_meta( $page_id, 'wc_top_bar_cart_color' ) ) : consulting_theme_option( 'wc_top_bar_cart_color' );
		if ( ! empty( $top_bar_cart_icon_color ) ) {
			echo '--con_top_bar_cart_icon_color: ' . esc_attr( $top_bar_cart_icon_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_top_bar_cart_color' ) ) ) {
		echo '--con_top_bar_cart_icon_color: ' . esc_attr( consulting_theme_option( 'wc_top_bar_cart_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_top_bar_cart_icon_color_hover' ) ) {
		$top_bar_cart_icon_color_hover = implode( get_post_meta( $page_id, 'wc_top_bar_cart_icon_color_hover' ) ) ? implode( get_post_meta( $page_id, 'wc_top_bar_cart_icon_color_hover' ) ) : consulting_theme_option( 'wc_top_bar_cart_icon_color_hover' );
		if ( ! empty( $top_bar_cart_icon_color_hover ) ) {
			echo '--con_top_bar_cart_icon_color_hover: ' . esc_attr( $top_bar_cart_icon_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_top_bar_cart_icon_color_hover' ) ) ) {
		echo '--con_top_bar_cart_icon_color_hover: ' . esc_attr( consulting_theme_option( 'wc_top_bar_cart_icon_color_hover' ) ) . ';';
	}
	$top_bar_cart_counter_typography = ( consulting_theme_option( 'wc_top_bar_cart_counter_typography' ) );
	if ( ! empty( $top_bar_cart_counter_typography['line-height'] ) ) {
		echo '--con_top_bar_cart_counter_line_height: ' . esc_attr( $top_bar_cart_counter_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $top_bar_cart_counter_typography['font-size'] ) ) {
		echo '--con_top_bar_cart_counter_font_size: ' . esc_attr( $top_bar_cart_counter_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_top_bar_cart_counter_color' ) ) {
		$top_bar_cart_counter_color_hover = implode( get_post_meta( $page_id, 'wc_top_bar_cart_counter_color' ) ) ? implode( get_post_meta( $page_id, 'wc_top_bar_cart_counter_color' ) ) : consulting_theme_option( 'wc_top_bar_cart_counter_color' );
		if ( ! empty( $top_bar_cart_counter_color_hover ) ) {
			echo '--con_top_bar_cart_counter_color: ' . esc_attr( $top_bar_cart_counter_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_top_bar_cart_counter_color' ) ) ) {
		echo '--con_top_bar_cart_counter_color: ' . esc_attr( consulting_theme_option( 'wc_top_bar_cart_counter_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_top_bar_cart_counter_color_hover' ) ) {
		$top_bar_cart_counter_color_hover = implode( get_post_meta( $page_id, 'wc_top_bar_cart_counter_color_hover' ) ) ? implode( get_post_meta( $page_id, 'wc_top_bar_cart_counter_color_hover' ) ) : consulting_theme_option( 'wc_top_bar_cart_counter_color_hover' );
		if ( ! empty( $top_bar_cart_counter_color_hover ) ) {
			echo '--con_top_bar_cart_counter_color_hover: ' . esc_attr( $top_bar_cart_counter_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_top_bar_cart_counter_color_hover' ) ) ) {
		echo '--con_top_bar_cart_counter_color_hover: ' . esc_attr( consulting_theme_option( 'wc_top_bar_cart_counter_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_top_bar_cart_counter_bg' ) ) {
		$wc_top_bar_counter_bg = implode( get_post_meta( $page_id, 'wc_top_bar_cart_counter_bg' ) ) ? implode( get_post_meta( $page_id, 'wc_top_bar_cart_counter_bg' ) ) : consulting_theme_option( 'wc_top_bar_cart_counter_bg' );
		if ( ! empty( $wc_top_bar_counter_bg ) ) {
			echo '--con_top_bar_cart_counter_bg: ' . esc_attr( $wc_top_bar_counter_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_top_bar_cart_counter_bg' ) ) ) {
		echo '--con_top_bar_cart_counter_bg: ' . esc_attr( consulting_theme_option( 'wc_top_bar_cart_counter_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_top_bar_cart_counter_bg_hover' ) ) {
		$wc_top_bar_counter_bg_hover = implode( get_post_meta( $page_id, 'wc_top_bar_cart_counter_bg_hover' ) ) ? implode( get_post_meta( $page_id, 'wc_top_bar_cart_counter_bg_hover' ) ) : consulting_theme_option( 'wc_top_bar_cart_counter_bg_hover' );
		if ( ! empty( $wc_top_bar_counter_bg_hover ) ) {
			echo '--con_top_bar_cart_counter_bg_hover: ' . esc_attr( $wc_top_bar_counter_bg_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_top_bar_cart_counter_bg_hover' ) ) ) {
		echo '--con_top_bar_cart_counter_bg_hover: ' . esc_attr( consulting_theme_option( 'wc_top_bar_cart_counter_bg_hover' ) ) . ';';
	}
	//Top Bar WPML Styles
	$top_bar_wpml_switcher_typography = ( consulting_theme_option( 'top_bar_wpml_switcher_typography' ) );
	if ( ! empty( $top_bar_wpml_switcher_typography['line-height'] ) ) {
		echo '--con_top_bar_wpml_switcher_line_height: ' . esc_attr( $top_bar_wpml_switcher_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $top_bar_wpml_switcher_typography['font-size'] ) ) {
		echo '--con_top_bar_wpml_switcher_font_size: ' . esc_attr( $top_bar_wpml_switcher_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'wpml_switcher_color' ) ) {
		$top_bar_wpml_switcher_color = implode( get_post_meta( $page_id, 'wpml_switcher_color' ) ) ? implode( get_post_meta( $page_id, 'wpml_switcher_color' ) ) : consulting_theme_option( 'wpml_switcher_color' );
		if ( ! empty( $top_bar_wpml_switcher_color ) ) {
			echo '--con_top_bar_wpml_switcher_color: ' . esc_attr( $top_bar_wpml_switcher_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wpml_switcher_color' ) ) ) {
		echo '--con_top_bar_wpml_switcher_color: ' . esc_attr( consulting_theme_option( 'wpml_switcher_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_wpml_switcher_color_hover' ) ) {
		$top_bar_wpml_switcher_color_hover = implode( get_post_meta( $page_id, 'top_bar_wpml_switcher_color_hover' ) ) ? implode( get_post_meta( $page_id, 'top_bar_wpml_switcher_color_hover' ) ) : consulting_theme_option( 'top_bar_wpml_switcher_color_hover' );
		if ( ! empty( $top_bar_wpml_switcher_color_hover ) ) {
			echo '--con_top_bar_wpml_switcher_color_hover: ' . esc_attr( $top_bar_wpml_switcher_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_wpml_switcher_color_hover' ) ) ) {
		echo '--con_top_bar_wpml_switcher_color_hover: ' . esc_attr( consulting_theme_option( 'top_bar_wpml_switcher_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_wpml_switcher_bg' ) ) {
		$top_bar_wpml_switcher_bg = implode( get_post_meta( $page_id, 'top_bar_wpml_switcher_bg' ) ) ? implode( get_post_meta( $page_id, 'top_bar_wpml_switcher_bg' ) ) : consulting_theme_option( 'top_bar_wpml_switcher_bg' );
		if ( ! empty( $top_bar_wpml_switcher_bg ) ) {
			echo '--con_top_bar_wpml_switcher_bg: ' . esc_attr( $top_bar_wpml_switcher_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_wpml_switcher_bg' ) ) ) {
		echo '--con_top_bar_wpml_switcher_bg: ' . esc_attr( consulting_theme_option( 'top_bar_wpml_switcher_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_wpml_switcher_bg_hover' ) ) {
		$top_bar_wpml_switcher_bg_hover = implode( get_post_meta( $page_id, 'top_bar_wpml_switcher_bg_hover' ) ) ? implode( get_post_meta( $page_id, 'top_bar_wpml_switcher_bg_hover' ) ) : consulting_theme_option( 'top_bar_wpml_switcher_bg_hover' );
		if ( ! empty( $top_bar_wpml_switcher_bg_hover ) ) {
			echo '--con_top_bar_wpml_switcher_bg_hover: ' . esc_attr( $top_bar_wpml_switcher_bg_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_wpml_switcher_bg_hover' ) ) ) {
		echo '--con_top_bar_wpml_switcher_bg_hover: ' . esc_attr( consulting_theme_option( 'top_bar_wpml_switcher_bg_hover' ) ) . ';';
	}
	//Top Bar Search Styles
	$top_bar_search_icon_typography = ( consulting_theme_option( 'top_bar_search_icon_typography' ) );
	if ( ! empty( $top_bar_search_icon_typography['line-height'] ) ) {
		echo '--con_top_bar_search_icon_line_height: ' . esc_attr( $top_bar_search_icon_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $top_bar_search_icon_typography['font-size'] ) ) {
		echo '--con_top_bar_search_icon_font_size: ' . esc_attr( $top_bar_search_icon_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_search_color' ) ) {
		$top_bar_search_icon_color = implode( get_post_meta( $page_id, 'top_bar_search_color' ) ) ? implode( get_post_meta( $page_id, 'top_bar_search_color' ) ) : consulting_theme_option( 'top_bar_search_color' );
		if ( ! empty( $top_bar_search_icon_color ) ) {
			echo '--con_top_bar_search_icon_color: ' . esc_attr( $top_bar_search_icon_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_search_color' ) ) ) {
		echo '--con_top_bar_search_icon_color: ' . esc_attr( consulting_theme_option( 'top_bar_search_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_search_icon_color_hover' ) ) {
		$top_bar_search_icon_color_hover = implode( get_post_meta( $page_id, 'top_bar_search_icon_color_hover' ) ) ? implode( get_post_meta( $page_id, 'top_bar_search_icon_color_hover' ) ) : consulting_theme_option( 'top_bar_search_icon_color_hover' );
		if ( ! empty( $top_bar_search_icon_color_hover ) ) {
			echo '--con_top_bar_search_icon_color_hover: ' . esc_attr( $top_bar_search_icon_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_search_icon_color_hover' ) ) ) {
		echo '--con_top_bar_search_icon_color_hover: ' . esc_attr( consulting_theme_option( 'top_bar_search_icon_color_hover' ) ) . ';';
	}
	//Top Bar Social Icons Styles
	$top_bar_socials_icon_typography = ( consulting_theme_option( 'top_bar_socials_typography' ) );
	if ( ! empty( $top_bar_socials_icon_typography['line-height'] ) ) {
		echo '--con_top_bar_socials_icon_line_height: ' . esc_attr( $top_bar_socials_icon_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $top_bar_socials_icon_typography['font-size'] ) ) {
		echo '--con_top_bar_socials_icon_font_size: ' . esc_attr( $top_bar_socials_icon_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_socials_color' ) ) {
		$top_bar_socials_icon_color = implode( get_post_meta( $page_id, 'top_bar_socials_color', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_socials_color', false ) ) : consulting_theme_option( 'top_bar_socials_color' );
		if ( ! empty( $top_bar_socials_icon_color ) ) {
			echo '--con_top_bar_socials_icon_color: ' . esc_attr( $top_bar_socials_icon_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_socials_color' ) ) ) {
		echo '--con_top_bar_socials_icon_color: ' . esc_attr( consulting_theme_option( 'top_bar_socials_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_socials_color_on_hover' ) ) {
		$top_bar_socials_icon_color_hover = implode( get_post_meta( $page_id, 'top_bar_socials_color_on_hover', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_socials_color_on_hover', false ) ) : consulting_theme_option( 'top_bar_socials_color_on_hover' );
		if ( ! empty( $top_bar_socials_icon_color_hover ) ) {
			echo '--con_top_bar_socials_icon_color_hover: ' . esc_attr( $top_bar_socials_icon_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_socials_color_on_hover' ) ) ) {
		echo '--con_top_bar_socials_icon_color_hover: ' . esc_attr( consulting_theme_option( 'top_bar_socials_color_on_hover' ) ) . ';';
	}
	//Top Bar Contact Information
	$top_bar_contact_info_typography = ( consulting_theme_option( 'offices_contact_typography' ) );
	if ( ! empty( $top_bar_contact_info_typography['line-height'] ) ) {
		echo '--con_top_bar_contact_info_line_height: ' . esc_attr( $top_bar_contact_info_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $top_bar_contact_info_typography['font-weight'] ) ) {
		echo '--con_top_bar_contact_info_font_weight: ' . esc_attr( $top_bar_contact_info_typography['font-weight'] ) . ';';
	}
	if ( ! empty( $top_bar_contact_info_typography['font-size'] ) ) {
		echo '--con_top_bar_contact_info_font_size: ' . esc_attr( $top_bar_contact_info_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_color' ) ) {
		$top_bar_contact_info_color = implode( get_post_meta( $page_id, 'top_bar_contact_info_color', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_color', false ) ) : consulting_theme_option( 'top_bar_contact_info_color' );
		if ( ! empty( $top_bar_contact_info_color ) ) {
			echo '--top_bar_contact_info_color: ' . esc_attr( $top_bar_contact_info_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_color' ) ) ) {
		echo '--top_bar_contact_info_color: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_link_color' ) ) {
		$top_bar_contact_info_link_color = implode( get_post_meta( $page_id, 'top_bar_contact_info_link_color', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_link_color', false ) ) : consulting_theme_option( 'top_bar_contact_info_link_color' );
		if ( ! empty( $top_bar_contact_info_link_color ) ) {
			echo '--con_top_bar_contact_info_link_color: ' . esc_attr( $top_bar_contact_info_link_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_link_color' ) ) ) {
		echo '--con_top_bar_contact_info_link_color: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_link_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_link_color_hover' ) ) {
		$top_bar_contact_info_link_color_hover = implode( get_post_meta( $page_id, 'top_bar_contact_info_link_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_link_color_hover', false ) ) : consulting_theme_option( 'top_bar_contact_info_link_color_hover' );
		if ( ! empty( $top_bar_contact_info_link_color_hover ) ) {
			echo '--con_top_bar_contact_info_link_color_hover: ' . esc_attr( $top_bar_contact_info_link_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_link_color_hover' ) ) ) {
		echo '--con_top_bar_contact_info_link_color_hover: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_link_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_select_bg' ) ) {
		$top_bar_contact_info_select_bg = implode( get_post_meta( $page_id, 'top_bar_contact_info_select_bg', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_select_bg', false ) ) : consulting_theme_option( 'top_bar_contact_info_select_bg' );
		if ( ! empty( $top_bar_contact_info_select_bg ) ) {
			echo '--con_top_bar_contact_info_select_bg: ' . esc_attr( $top_bar_contact_info_select_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_select_bg' ) ) ) {
		echo '--con_top_bar_contact_info_select_bg: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_select_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_select_color' ) ) {
		$top_bar_contact_info_select_color = implode( get_post_meta( $page_id, 'top_bar_contact_info_select_color', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_select_color', false ) ) : consulting_theme_option( 'top_bar_contact_info_select_color' );
		if ( ! empty( $top_bar_contact_info_select_color ) ) {
			echo '--con_top_bar_contact_info_select_color: ' . esc_attr( $top_bar_contact_info_select_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_select_color' ) ) ) {
		echo '--con_top_bar_contact_info_select_color: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_select_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_select_drop_bg' ) ) {
		$top_bar_contact_info_select_drop_bg = implode( get_post_meta( $page_id, 'top_bar_contact_info_select_drop_bg', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_select_drop_bg', false ) ) : consulting_theme_option( 'top_bar_contact_info_select_drop_bg' );
		if ( ! empty( $top_bar_contact_info_select_drop_bg ) ) {
			echo '--con_top_bar_contact_info_select_drop_bg: ' . esc_attr( $top_bar_contact_info_select_drop_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_select_drop_bg' ) ) ) {
		echo '--con_top_bar_contact_info_select_drop_bg: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_select_drop_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_select_items_bg' ) ) {
		$top_bar_contact_info_select_items_bg = implode( get_post_meta( $page_id, 'top_bar_contact_info_select_items_bg', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_select_items_bg', false ) ) : consulting_theme_option( 'top_bar_contact_info_select_items_bg' );
		if ( ! empty( $top_bar_contact_info_select_items_bg ) ) {
			echo '--con_top_bar_contact_info_select_items_bg: ' . esc_attr( $top_bar_contact_info_select_items_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_select_items_bg' ) ) ) {
		echo '--con_top_bar_contact_info_select_items_bg: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_select_items_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_select_items_color' ) ) {
		$top_bar_contact_info_select_items_color = implode( get_post_meta( $page_id, 'top_bar_contact_info_select_items_color', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_select_items_color', false ) ) : consulting_theme_option( 'top_bar_contact_info_select_items_color' );
		if ( ! empty( $top_bar_contact_info_select_items_color ) ) {
			echo '--con_top_bar_contact_info_select_items_color: ' . esc_attr( $top_bar_contact_info_select_items_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_select_items_color' ) ) ) {
		echo '--con_top_bar_contact_info_select_items_color: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_select_items_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'top_bar_contact_info_select_items_hover' ) ) {
		$top_bar_contact_info_select_items_hover = implode( get_post_meta( $page_id, 'top_bar_contact_info_select_items_hover', false ) ) ? implode( get_post_meta( $page_id, 'top_bar_contact_info_select_items_hover', false ) ) : consulting_theme_option( 'top_bar_contact_info_select_items_hover' );
		if ( ! empty( $top_bar_contact_info_select_items_hover ) ) {
			echo '--con_top_bar_contact_info_select_items_hover: ' . esc_attr( $top_bar_contact_info_select_items_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'top_bar_contact_info_select_items_hover' ) ) ) {
		echo '--con_top_bar_contact_info_select_items_hover: ' . esc_attr( consulting_theme_option( 'top_bar_contact_info_select_items_hover' ) ) . ';';
	}

	//Nav Bar Styles
	if ( metadata_exists( 'post', $page_id, 'header_bg' ) ) {
		$header_bg = implode( get_post_meta( $page_id, 'header_bg' ) ) ? implode( get_post_meta( $page_id, 'header_bg' ) ) : consulting_theme_option( 'header_bg' );
		if ( ! empty( $header_bg ) ) {
			echo '--con_header_nav_background_color: ' . esc_attr( $header_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_bg' ) ) ) {
		echo '--con_header_nav_background_color: ' . esc_attr( consulting_theme_option( 'header_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_shadow' ) ) {
		$header_nav_shadow = implode( get_post_meta( $page_id, 'header_shadow', false ) ) ? implode( get_post_meta( $page_id, 'header_shadow', false ) ) : consulting_theme_option( 'header_shadow' );
		if ( ! empty( $header_nav_shadow ) ) {
			echo '--con_header_nav_shadow: ' . esc_attr( $header_nav_shadow ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_shadow' ) ) ) {
		echo '--con_header_nav_shadow: ' . esc_attr( consulting_theme_option( 'header_shadow' ) ) . ';';
	}
	if ( (bool) consulting_theme_option( 'header_wide', false ) ) {
		echo '--con_header_wide: 100%;';
	}
	if ( ! empty( consulting_theme_option( 'sticky_menu_height' ) ) ) {
		echo '--con_sticky_menu_height: ' . esc_attr( consulting_theme_option( 'sticky_menu_height' ) ) . 'px;';
	}
	if ( ! empty( consulting_theme_option( 'header_height' ) ) ) {
		echo '--con_header_height: ' . esc_attr( consulting_theme_option( 'header_height' ) ) . 'px;';
	}
	//Cart Styles
	$header_cart_icon_typography = ( consulting_theme_option( 'wc_cart_icon_typography' ) );
	if ( ! empty( $header_cart_icon_typography['line-height'] ) ) {
		echo '--con_header_cart_icon_line_height: ' . esc_attr( $header_cart_icon_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_cart_icon_typography['font-size'] ) ) {
		echo '--con_header_cart_icon_font_size: ' . esc_attr( $header_cart_icon_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_cart_icon_color' ) && ! empty( $header_cart_icon_typography ) ) {
		$header_cart_icon_color = implode( get_post_meta( $page_id, 'wc_cart_icon_color' ) ) ? implode( get_post_meta( $page_id, 'wc_cart_icon_color' ) ) : $header_cart_icon_typography['color'];
		if ( ! empty( $header_cart_icon_color ) ) {
			echo '--con_header_cart_icon_color: ' . esc_attr( $header_cart_icon_color ) . ';';
		}
	} elseif ( ! empty( $header_cart_icon_typography['color'] ) ) {
		echo '--con_header_cart_icon_color: ' . esc_attr( $header_cart_icon_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_cart_icon_color_hover' ) && ! empty( $header_cart_icon_typography ) ) {
		$header_cart_icon_color_hover = implode( get_post_meta( $page_id, 'wc_cart_icon_color_hover' ) ) ? implode( get_post_meta( $page_id, 'wc_cart_icon_color_hover' ) ) : consulting_theme_option( 'wc_cart_icon_color_hover' );
		if ( ! empty( $header_cart_icon_color_hover ) ) {
			echo '--con_header_cart_icon_color_hover: ' . esc_attr( $header_cart_icon_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_cart_icon_color_hover' ) ) ) {
		echo '--con_header_cart_icon_color_hover: ' . esc_attr( consulting_theme_option( 'wc_cart_icon_color_hover' ) ) . ';';
	}
	$header_cart_counter_typography = ( consulting_theme_option( 'wc_cart_counter_typography' ) );
	if ( ! empty( $header_cart_counter_typography['line-height'] ) ) {
		echo '--con_header_cart_counter_line_height: ' . esc_attr( $header_cart_counter_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_cart_counter_typography['font-size'] ) ) {
		echo '--con_header_cart_counter_font_size: ' . esc_attr( $header_cart_counter_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_cart_counter_color' ) && ! empty( $header_cart_counter_typography ) ) {
		$header_cart_counter_color = implode( get_post_meta( $page_id, 'wc_cart_counter_color' ) ) ? implode( get_post_meta( $page_id, 'wc_cart_counter_color' ) ) : $header_cart_counter_typography['color'];
		if ( ! empty( $header_cart_counter_color ) ) {
			echo '--con_header_cart_counter_color: ' . esc_attr( $header_cart_counter_color ) . ';';
		}
	} elseif ( ! empty( $header_cart_counter_typography['color'] ) ) {
		echo '--con_header_cart_counter_color: ' . esc_attr( $header_cart_counter_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_cart_counter_color_hover' ) ) {
		$header_cart_counter_color_hover = implode( get_post_meta( $page_id, 'wc_cart_counter_color_hover' ) ) ? implode( get_post_meta( $page_id, 'wc_cart_counter_color_hover' ) ) : consulting_theme_option( 'wc_cart_counter_color_hover' );
		if ( ! empty( $header_cart_counter_color_hover ) ) {
			echo '--con_header_cart_counter_color_hover: ' . esc_attr( $header_cart_counter_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_cart_counter_color_hover' ) ) ) {
		echo '--con_header_cart_counter_color_hover: ' . esc_attr( consulting_theme_option( 'wc_cart_counter_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_cart_counter_bg' ) ) {
		$wc_cart_counter_bg = implode( get_post_meta( $page_id, 'wc_cart_counter_bg' ) ) ? implode( get_post_meta( $page_id, 'wc_cart_counter_bg' ) ) : consulting_theme_option( 'wc_cart_counter_bg' );
		if ( ! empty( $wc_cart_counter_bg ) ) {
			echo '--con_wc_cart_counter_bg: ' . esc_attr( $wc_cart_counter_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_cart_counter_bg' ) ) ) {
		echo '--con_wc_cart_counter_bg: ' . esc_attr( consulting_theme_option( 'wc_cart_counter_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'wc_cart_counter_bg_hover' ) ) {
		$wc_cart_counter_bg_hover = implode( get_post_meta( $page_id, 'wc_cart_counter_bg_hover' ) ) ? implode( get_post_meta( $page_id, 'wc_cart_counter_bg_hover' ) ) : consulting_theme_option( 'wc_cart_counter_bg_hover' );
		if ( ! empty( $wc_cart_counter_bg_hover ) ) {
			echo '--con_wc_cart_counter_bg_hover: ' . esc_attr( $wc_cart_counter_bg_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'wc_cart_counter_bg' ) ) ) {
		echo '--con_wc_cart_counter_bg_hover: ' . esc_attr( consulting_theme_option( 'wc_cart_counter_bg_hover' ) ) . ';';
	}
	//WPML Styles
	$header_wpml_switcher_typography = ( consulting_theme_option( 'header_wpml_switcher_typography' ) );
	if ( ! empty( $header_wpml_switcher_typography['line-height'] ) ) {
		echo '--con_header_wpml_switcher_line_height: ' . esc_attr( $header_wpml_switcher_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_wpml_switcher_typography['font-size'] ) ) {
		echo '--con_header_wpml_switcher_font_size: ' . esc_attr( $header_wpml_switcher_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_wpml_switcher_color' ) && ! empty( $header_wpml_switcher_typography ) ) {
		$header_wpml_switcher_color = implode( get_post_meta( $page_id, 'header_wpml_switcher_color' ) ) ? implode( get_post_meta( $page_id, 'header_wpml_switcher_color' ) ) : $header_wpml_switcher_typography['color'];
		if ( ! empty( $header_wpml_switcher_color ) ) {
			echo '--con_header_wpml_switcher_color: ' . esc_attr( $header_wpml_switcher_color ) . ';';
		}
	} elseif ( ! empty( $header_wpml_switcher_typography['color'] ) ) {
		echo '--con_header_wpml_switcher_color: ' . esc_attr( $header_wpml_switcher_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_wpml_switcher_color_hover' ) ) {
		$header_wpml_switcher_color_hover = implode( get_post_meta( $page_id, 'header_wpml_switcher_color_hover' ) ) ? implode( get_post_meta( $page_id, 'header_wpml_switcher_color_hover' ) ) : consulting_theme_option( 'header_wpml_switcher_color_hover' );
		if ( ! empty( $header_wpml_switcher_color_hover ) ) {
			echo '--con_header_wpml_switcher_color_hover: ' . esc_attr( $header_wpml_switcher_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_wpml_switcher_color_hover' ) ) ) {
		echo '--con_header_wpml_switcher_color_hover: ' . esc_attr( consulting_theme_option( 'header_wpml_switcher_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_wpml_switcher_bg' ) ) {
		$header_wpml_switcher_bg = implode( get_post_meta( $page_id, 'header_wpml_switcher_bg' ) ) ? implode( get_post_meta( $page_id, 'header_wpml_switcher_bg' ) ) : consulting_theme_option( 'header_wpml_switcher_bg' );
		if ( ! empty( $header_wpml_switcher_bg ) ) {
			echo '--con_header_wpml_switcher_bg: ' . esc_attr( $header_wpml_switcher_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_wpml_switcher_bg' ) ) ) {
		echo '--con_header_wpml_switcher_bg: ' . esc_attr( consulting_theme_option( 'header_wpml_switcher_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_wpml_switcher_bg_hover' ) ) {
		$header_wpml_switcher_bg_hover = implode( get_post_meta( $page_id, 'header_wpml_switcher_bg_hover' ) ) ? implode( get_post_meta( $page_id, 'header_wpml_switcher_bg_hover' ) ) : consulting_theme_option( 'header_wpml_switcher_bg_hover' );
		if ( ! empty( $header_wpml_switcher_bg_hover ) ) {
			echo '--con_header_wpml_switcher_bg_hover: ' . esc_attr( $header_wpml_switcher_bg_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_wpml_switcher_bg_hover' ) ) ) {
		echo '--con_header_wpml_switcher_bg_hover: ' . esc_attr( consulting_theme_option( 'header_wpml_switcher_bg_hover' ) ) . ';';
	}
	//Search Styles
	$header_search_icon_typography = ( consulting_theme_option( 'header_search_icon_typography' ) );
	if ( ! empty( $header_search_icon_typography['line-height'] ) ) {
		echo '--con_header_search_icon_line_height: ' . esc_attr( $header_search_icon_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_search_icon_typography['font-size'] ) ) {
		echo '--con_header_search_icon_font_size: ' . esc_attr( $header_search_icon_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_search_icon_color' ) ) {
		$header_search_icon_color = implode( get_post_meta( $page_id, 'header_search_icon_color' ) ) ? implode( get_post_meta( $page_id, 'header_search_icon_color' ) ) : consulting_theme_option( 'header_search_icon_color' );
		if ( ! empty( $header_search_icon_color ) ) {
			echo '--con_header_search_icon_color: ' . esc_attr( $header_search_icon_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_search_icon_color' ) ) ) {
		echo '--con_header_search_icon_color: ' . esc_attr( consulting_theme_option( 'header_search_icon_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_search_icon_color_hover' ) ) {
		$header_search_icon_color_hover = implode( get_post_meta( $page_id, 'header_search_icon_color_hover' ) ) ? implode( get_post_meta( $page_id, 'header_search_icon_color_hover' ) ) : consulting_theme_option( 'header_search_icon_color_hover' );
		if ( ! empty( $header_search_icon_color_hover ) ) {
			echo '--con_header_search_icon_color_hover: ' . esc_attr( $header_search_icon_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_search_icon_color_hover' ) ) ) {
		echo '--con_header_search_icon_color_hover: ' . esc_attr( consulting_theme_option( 'header_search_icon_color_hover' ) ) . ';';
	}
	//Social Icons Styles
	$header_socials_icon_typography = ( consulting_theme_option( 'header_socials_typography' ) );
	if ( ! empty( $header_socials_icon_typography['line-height'] ) ) {
		echo '--con_header_socials_icon_line_height: ' . esc_attr( $header_socials_icon_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_socials_icon_typography['font-size'] ) ) {
		echo '--con_header_socials_icon_font_size: ' . esc_attr( $header_socials_icon_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_socials_color' ) && ! empty( $header_socials_icon_typography ) ) {
		$header_socials_icon_color = implode( get_post_meta( $page_id, 'header_socials_color' ) ) ? implode( get_post_meta( $page_id, 'header_socials_color' ) ) : $header_socials_icon_typography['color'];
		if ( ! empty( $header_socials_icon_color ) ) {
			echo '--con_header_socials_icon_color: ' . esc_attr( $header_socials_icon_color ) . ';';
		}
	} elseif ( ! empty( $header_socials_icon_typography['color'] ) ) {
		echo '--con_header_socials_icon_color: ' . esc_attr( $header_socials_icon_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_socials_color_hover' ) ) {
		$header_socials_icon_color_hover = implode( get_post_meta( $page_id, 'header_socials_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_socials_color_hover', false ) ) : consulting_theme_option( 'header_socials_color_hover' );
		if ( ! empty( $header_socials_icon_color_hover ) ) {
			echo '--con_header_socials_icon_color_hover: ' . esc_attr( $header_socials_icon_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_socials_color_hover' ) ) ) {
		echo '--con_header_socials_icon_color_hover: ' . esc_attr( consulting_theme_option( 'header_socials_color_hover' ) ) . ';';
	}
	//Button Icons Styles
	if ( ! empty( consulting_theme_option_indents( 'header_button_border_radius' ) ) ) {
		echo '--con_header_button_border_radius: ' . esc_attr( consulting_theme_option_indents( 'header_button_border_radius' ) ) . ';';
	}
	$header_button_typography = ( consulting_theme_option( 'header_button_typography' ) );
	if ( ! empty( $header_button_typography['text-transform'] ) ) {
		echo '--con_header_button_text_transform: ' . esc_attr( $header_button_typography['text-transform'] ) . ';';
	}
	if ( ! empty( $header_button_typography['line-height'] ) ) {
		echo '--con_header_button_line_height: ' . esc_attr( $header_button_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_button_typography['font-size'] ) ) {
		echo '--con_header_button_font_size: ' . esc_attr( $header_button_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_button_color' ) && ! empty( $header_button_typography ) ) {
		$header_button_color = implode( get_post_meta( $page_id, 'header_button_color', false ) ) ? implode( get_post_meta( $page_id, 'header_button_color', false ) ) : $header_button_typography['color'];
		if ( ! empty( $header_button_color ) ) {
			echo '--con_header_button_color: ' . esc_attr( $header_button_color ) . ';';
		}
	} elseif ( ! empty( $header_button_typography['color'] ) ) {
		echo '--con_header_button_color: ' . esc_attr( $header_button_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_button_color_hover' ) ) {
		$header_button_color_hover = implode( get_post_meta( $page_id, 'header_button_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_button_color_hover', false ) ) : consulting_theme_option( 'header_button_color_hover' );
		if ( ! empty( $header_button_color_hover ) ) {
			echo '--con_header_button_color_hover: ' . esc_attr( $header_button_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_button_color_hover' ) ) ) {
		echo '--con_header_button_color_hover: ' . esc_attr( consulting_theme_option( 'header_button_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_button_bg' ) ) {
		$header_button_color_bg = implode( get_post_meta( $page_id, 'header_button_bg', false ) ) ? implode( get_post_meta( $page_id, 'header_button_bg', false ) ) : consulting_theme_option( 'header_button_bg' );
		if ( ! empty( $header_button_color_bg ) ) {
			echo '--con_header_button_bg: ' . esc_attr( $header_button_color_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_button_bg' ) ) ) {
		echo '--con_header_button_bg: ' . esc_attr( consulting_theme_option( 'header_button_bg' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_button_bg_hover' ) ) {
		$header_button_color_bg_hover = implode( get_post_meta( $page_id, 'header_button_bg_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_button_bg_hover', false ) ) : consulting_theme_option( 'header_button_bg_hover' );
		if ( ! empty( $header_button_color_bg_hover ) ) {
			echo '--con_header_button_bg_hover: ' . esc_attr( $header_button_color_bg_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_button_bg_hover' ) ) ) {
		echo '--con_header_button_bg_hover: ' . esc_attr( consulting_theme_option( 'header_button_bg_hover' ) ) . ';';
	}
	$header_button_mobile_typography = ( consulting_theme_option( 'header_button_mobile_typography' ) );
	if ( ! empty( $header_button_mobile_typography['text-transform'] ) ) {
		echo '--con_header_button_mobile_text_transform: ' . esc_attr( $header_button_mobile_typography['text-transform'] ) . ';';
	}
	if ( ! empty( $header_button_mobile_typography['line-height'] ) ) {
		echo '--con_header_button_mobile_line_height: ' . esc_attr( $header_button_mobile_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_button_mobile_typography['font-size'] ) ) {
		echo '--con_header_button_mobile_font_size: ' . esc_attr( $header_button_mobile_typography['font-size'] ) . 'px;';
	}
	//Contact Information
	$header_contact_info_typography = ( consulting_theme_option( 'header_contact_info_typography' ) );
	if ( ! empty( $header_contact_info_typography['text-transform'] ) ) {
		echo '--con_header_contact_info_text_transform: ' . esc_attr( $header_contact_info_typography['text-transform'] ) . ';';
	}
	if ( ! empty( $header_contact_info_typography['line-height'] ) ) {
		echo '--con_header_contact_info_line_height: ' . esc_attr( $header_contact_info_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_contact_info_typography['font-weight'] ) ) {
		echo '--con_header_contact_info_font_weight: ' . esc_attr( $header_contact_info_typography['font-weight'] ) . ';';
	}
	if ( ! empty( $header_contact_info_typography['font-size'] ) ) {
		echo '--con_header_contact_info_font_size: ' . esc_attr( $header_contact_info_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_contact_info_color' ) && ! empty( $header_contact_info_typography ) ) {
		$header_contact_info_color = implode( get_post_meta( $page_id, 'header_contact_info_color', false ) ) ? implode( get_post_meta( $page_id, 'header_contact_info_color', false ) ) : $header_contact_info_typography['color'];
		if ( ! empty( $header_contact_info_color ) ) {
			echo '--con_header_contact_info_color: ' . esc_attr( $header_contact_info_color ) . ';';
		}
	} elseif ( ! empty( $header_contact_info_typography['color'] ) ) {
		echo '--con_header_contact_info_color: ' . esc_attr( $header_contact_info_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_contact_info_link_color' ) ) {
		$header_contact_info_link_color = implode( get_post_meta( $page_id, 'header_contact_info_link_color', false ) ) ? implode( get_post_meta( $page_id, 'header_contact_info_link_color', false ) ) : consulting_theme_option( 'header_contact_info_link_color' );
		if ( ! empty( $header_contact_info_link_color ) ) {
			echo '--con_header_contact_info_link_color: ' . esc_attr( $header_contact_info_link_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_contact_info_link_color' ) ) ) {
		echo '--con_header_contact_info_link_color: ' . esc_attr( consulting_theme_option( 'header_contact_info_link_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_contact_info_link_color_hover' ) ) {
		$header_contact_info_link_color_hover = implode( get_post_meta( $page_id, 'header_contact_info_link_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_contact_info_link_color_hover', false ) ) : consulting_theme_option( 'header_contact_info_link_color_hover' );
		if ( ! empty( $header_contact_info_link_color_hover ) ) {
			echo '--con_header_contact_info_link_color_hover: ' . esc_attr( $header_contact_info_link_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_contact_info_link_color_hover' ) ) ) {
		echo '--con_header_contact_info_link_color_hover: ' . esc_attr( consulting_theme_option( 'header_contact_info_link_color_hover' ) ) . ';';
	}
	//Menu Styles
	$header_nav_menu_typography = ( consulting_theme_option( 'header_nav_menu_typography' ) );
	if ( ! empty( $header_nav_menu_typography['text-transform'] ) ) {
		echo '--con_header_nav_menu_link_text_transform: ' . esc_attr( $header_nav_menu_typography['text-transform'] ) . ';';
	}
	if ( ! empty( $header_nav_menu_typography['line-height'] ) ) {
		echo '--con_header_nav_menu_link_line_height: ' . esc_attr( $header_nav_menu_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_nav_menu_typography['font-weight'] ) ) {
		echo '--con_header_nav_menu_link_font_weight: ' . esc_attr( $header_nav_menu_typography['font-weight'] ) . ';';
	}
	if ( ! empty( $header_nav_menu_typography['font-size'] ) ) {
		echo '--con_header_nav_menu_link_font_size: ' . esc_attr( $header_nav_menu_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_link_color' ) && ! empty( $header_nav_menu_typography ) ) {
		$header_nav_menu_link_color = implode( get_post_meta( $page_id, 'header_nav_menu_link_color', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_link_color', false ) ) : $header_nav_menu_typography['color'];
		if ( ! empty( $header_nav_menu_link_color ) ) {
			echo '--con_header_nav_menu_link_color: ' . esc_attr( $header_nav_menu_link_color ) . ';';
		}
	} elseif ( ! empty( $header_nav_menu_typography['color'] ) ) {
		echo '--con_header_nav_menu_link_color: ' . esc_attr( $header_nav_menu_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_link_color_active' ) ) {
		$header_nav_menu_link_color_active = implode( get_post_meta( $page_id, 'header_nav_menu_link_color_active', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_link_color_active', false ) ) : consulting_theme_option( 'header_nav_menu_link_color_active' );
		if ( ! empty( $header_nav_menu_link_color_active ) ) {
			echo '--con_header_nav_menu_link_color_active: ' . esc_attr( $header_nav_menu_link_color_active ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_link_color_active' ) ) ) {
		echo '--con_header_nav_menu_link_color_active: ' . esc_attr( consulting_theme_option( 'header_nav_menu_link_color_active' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_link_color_hover' ) ) {
		$header_nav_menu_link_color_hover = implode( get_post_meta( $page_id, 'header_nav_menu_link_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_link_color_hover', false ) ) : consulting_theme_option( 'header_nav_menu_link_color_hover' );
		if ( ! empty( $header_nav_menu_link_color_hover ) ) {
			echo '--con_header_nav_menu_link_color_hover: ' . esc_attr( $header_nav_menu_link_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_link_color_hover' ) ) ) {
		echo '--con_header_nav_menu_link_color_hover: ' . esc_attr( consulting_theme_option( 'header_nav_menu_link_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_link_arrow_color' ) ) {
		$header_nav_menu_link_arrow_color = implode( get_post_meta( $page_id, 'header_nav_menu_link_arrow_color', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_link_arrow_color', false ) ) : consulting_theme_option( 'header_nav_menu_link_arrow_color' );
		if ( ! empty( $header_nav_menu_link_arrow_color ) ) {
			echo '--con_header_nav_menu_link_arrow_color: ' . esc_attr( $header_nav_menu_link_arrow_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_link_arrow_color' ) ) ) {
		echo '--con_header_nav_menu_link_arrow_color: ' . esc_attr( consulting_theme_option( 'header_nav_menu_link_arrow_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_link_arrow_color_hover' ) ) {
		$header_nav_menu_link_arrow_color_hover = implode( get_post_meta( $page_id, 'header_nav_menu_link_arrow_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_link_arrow_color_hover', false ) ) : consulting_theme_option( 'header_nav_menu_link_arrow_color_hover' );
		if ( ! empty( $header_nav_menu_link_arrow_color_hover ) ) {
			echo '--con_header_nav_menu_link_arrow_color_hover: ' . esc_attr( $header_nav_menu_link_arrow_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_link_arrow_color' ) ) ) {
		echo '--con_header_nav_menu_link_arrow_color_hover: ' . esc_attr( consulting_theme_option( 'header_nav_menu_link_arrow_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_1_bg' ) ) {
		$header_nav_menu_level_1_bg = implode( get_post_meta( $page_id, 'header_nav_menu_level_1_bg', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_1_bg', false ) ) : consulting_theme_option( 'header_nav_menu_level_1_bg' );
		if ( ! empty( $header_nav_menu_level_1_bg ) ) {
			echo '--con_header_nav_menu_level_1_bg: ' . esc_attr( $header_nav_menu_level_1_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_level_1_bg' ) ) ) {
		echo '--con_header_nav_menu_level_1_bg: ' . esc_attr( consulting_theme_option( 'header_nav_menu_level_1_bg' ) ) . ';';
	}
	$header_nav_menu_level_1_typography = ( consulting_theme_option( 'header_nav_menu_level_1_typography' ) );
	if ( ! empty( $header_nav_menu_level_1_typography['text-transform'] ) ) {
		echo '--con_header_nav_menu_level_1_link_text_transform: ' . esc_attr( $header_nav_menu_level_1_typography['text-transform'] ) . ';';
	}
	if ( ! empty( $header_nav_menu_level_1_typography['line-height'] ) ) {
		echo '--con_header_nav_menu_level_1_link_line_height: ' . esc_attr( $header_nav_menu_level_1_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_nav_menu_level_1_typography['font-weight'] ) ) {
		echo '--con_header_nav_menu_level_1_link_font_weight: ' . esc_attr( $header_nav_menu_level_1_typography['font-weight'] ) . ';';
	}
	if ( ! empty( $header_nav_menu_level_1_typography['font-size'] ) ) {
		echo '--con_header_nav_menu_level_1_link_font_size: ' . esc_attr( $header_nav_menu_level_1_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_1_link_color' ) && ! empty( $header_nav_menu_level_1_typography ) ) {
		$header_nav_menu_level_1_link_color = implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_color', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_color', false ) ) : $header_nav_menu_level_1_typography['color'];
		if ( ! empty( $header_nav_menu_level_1_link_color ) ) {
			echo '--con_header_nav_menu_level_1_link_color: ' . esc_attr( $header_nav_menu_level_1_link_color ) . ';';
		}
	} elseif ( ! empty( $header_nav_menu_level_1_typography['color'] ) ) {
		echo '--con_header_nav_menu_level_1_link_color: ' . esc_attr( $header_nav_menu_level_1_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_1_link_color_hover' ) ) {
		$header_nav_menu_level_1_link_color_hover = implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_color_hover', false ) ) : consulting_theme_option( 'header_nav_menu_level_1_link_color_hover' );
		if ( ! empty( $header_nav_menu_level_1_link_color_hover ) ) {
			echo '--con_header_nav_menu_level_1_link_color_hover: ' . esc_attr( $header_nav_menu_level_1_link_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_level_1_link_color_hover' ) ) ) {
		echo '--con_header_nav_menu_level_1_link_color_hover: ' . esc_attr( consulting_theme_option( 'header_nav_menu_level_1_link_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_1_link_bg_hover' ) ) {
		$header_nav_menu_level_1_link_bg_hover = implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_bg_hover' ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_bg_hover' ) ) : consulting_theme_option( 'header_nav_menu_level_1_link_bg_hover' );
		if ( ! empty( $header_nav_menu_level_1_link_bg_hover ) ) {
			echo '--con_header_nav_menu_level_1_link_bg_hover: ' . esc_attr( $header_nav_menu_level_1_link_bg_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_level_1_link_bg_hover' ) ) ) {
		echo '--con_header_nav_menu_level_1_link_bg_hover: ' . esc_attr( consulting_theme_option( 'header_nav_menu_level_1_link_bg_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_1_link_arrow_color' ) ) {
		$header_nav_menu_level_1_link_arrow_color = implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_arrow_color', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_arrow_color', false ) ) : consulting_theme_option( 'header_nav_menu_level_1_link_arrow_color' );
		if ( ! empty( $header_nav_menu_level_1_link_arrow_color ) ) {
			echo '--con_header_nav_menu_level_1_link_arrow_color: ' . esc_attr( $header_nav_menu_level_1_link_arrow_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_level_1_link_arrow_color' ) ) ) {
		echo '--con_header_nav_menu_level_1_link_arrow_color: ' . esc_attr( consulting_theme_option( 'header_nav_menu_level_1_link_arrow_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_1_link_arrow_color_hover' ) ) {
		$header_nav_menu_level_1_link_arrow_color_hover = implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_arrow_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_1_link_arrow_color_hover', false ) ) : consulting_theme_option( 'header_nav_menu_level_1_link_arrow_color_hover' );
		if ( ! empty( $header_nav_menu_level_1_link_arrow_color_hover ) ) {
			echo '--con_header_nav_menu_level_1_link_arrow_color_hover: ' . esc_attr( $header_nav_menu_level_1_link_arrow_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_level_1_link_arrow_color_hover' ) ) ) {
		echo '--con_header_nav_menu_level_1_link_arrow_color_hover: ' . esc_attr( consulting_theme_option( 'header_nav_menu_level_1_link_arrow_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_2_bg' ) ) {
		$header_nav_menu_level_2_bg = implode( get_post_meta( $page_id, 'header_nav_menu_level_2_bg', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_2_bg', false ) ) : consulting_theme_option( 'header_nav_menu_level_2_bg' );
		if ( ! empty( $header_nav_menu_level_2_bg ) ) {
			echo '--con_header_nav_menu_level_2_bg: ' . esc_attr( $header_nav_menu_level_2_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_level_2_bg' ) ) ) {
		echo '--con_header_nav_menu_level_2_bg: ' . esc_attr( consulting_theme_option( 'header_nav_menu_level_2_bg' ) ) . ';';
	}
	$header_nav_menu_level_2_typography = ( consulting_theme_option( 'header_nav_menu_level_2_typography' ) );
	if ( ! empty( $header_nav_menu_level_2_typography['text-transform'] ) ) {
		echo '--con_header_nav_menu_level_2_link_text_transform: ' . esc_attr( $header_nav_menu_level_2_typography['text-transform'] ) . ';';
	}
	if ( ! empty( $header_nav_menu_level_2_typography['line-height'] ) ) {
		echo '--con_header_nav_menu_level_2_link_line_height: ' . esc_attr( $header_nav_menu_level_2_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_nav_menu_level_2_typography['font-weight'] ) ) {
		echo '--con_header_nav_menu_level_2_link_font_weight: ' . esc_attr( $header_nav_menu_level_2_typography['font-weight'] ) . ';';
	}
	if ( ! empty( $header_nav_menu_level_2_typography['font-size'] ) ) {
		echo '--con_header_nav_menu_level_2_link_font_size: ' . esc_attr( $header_nav_menu_level_2_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_2_link_color' ) && ! empty( $header_nav_menu_level_2_typography ) ) {
		$header_nav_menu_level_2_link_color = implode( get_post_meta( $page_id, 'header_nav_menu_level_2_link_color', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_2_link_color', false ) ) : $header_nav_menu_level_2_typography['color'];
		if ( ! empty( $header_nav_menu_level_2_link_color ) ) {
			echo '--con_header_nav_menu_level_2_link_color: ' . esc_attr( $header_nav_menu_level_2_link_color ) . ';';
		}
	} elseif ( ! empty( $header_nav_menu_level_2_typography['color'] ) ) {
		echo '--con_header_nav_menu_level_2_link_color: ' . esc_attr( $header_nav_menu_level_2_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_2_link_color_hover' ) ) {
		$header_nav_menu_level_2_link_color_hover = implode( get_post_meta( $page_id, 'header_nav_menu_level_2_link_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_2_link_color_hover', false ) ) : consulting_theme_option( 'header_nav_menu_level_2_link_color_hover' );
		if ( ! empty( $header_nav_menu_level_2_link_color_hover ) ) {
			echo '--con_header_nav_menu_level_2_link_color_hover: ' . esc_attr( $header_nav_menu_level_2_link_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_level_2_link_color_hover' ) ) ) {
		echo '--con_header_nav_menu_level_2_link_color_hover: ' . esc_attr( consulting_theme_option( 'header_nav_menu_level_2_link_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_nav_menu_level_2_link_bg_hover' ) ) {
		$header_nav_menu_level_2_link_bg_hover = implode( get_post_meta( $page_id, 'header_nav_menu_level_2_link_bg_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_nav_menu_level_2_link_bg_hover', false ) ) : consulting_theme_option( 'header_nav_menu_level_2_link_bg_hover' );
		if ( ! empty( $header_nav_menu_level_2_link_bg_hover ) ) {
			echo '--con_header_nav_menu_level_2_link_bg_hover: ' . esc_attr( $header_nav_menu_level_2_link_bg_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_nav_menu_level_2_link_bg_hover' ) ) ) {
		echo '--con_header_nav_menu_level_2_link_bg_hover: ' . esc_attr( consulting_theme_option( 'header_nav_menu_level_2_link_bg_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_bg' ) ) {
		$header_mega_menu_bg = implode( get_post_meta( $page_id, 'header_mega_menu_bg', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_bg', false ) ) : consulting_theme_option( 'header_mega_menu_bg' );
		if ( ! empty( $header_mega_menu_bg ) ) {
			echo '--con_header_mega_menu_bg: ' . esc_attr( $header_mega_menu_bg ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_mega_menu_bg' ) ) ) {
		echo '--con_header_mega_menu_bg: ' . esc_attr( consulting_theme_option( 'header_mega_menu_bg' ) ) . ';';
	}
	$header_mega_menu_title_typography = ( consulting_theme_option( 'header_mega_menu_title_typography' ) );
	if ( ! empty( $header_mega_menu_title_typography['text-transform'] ) ) {
		echo '--con_header_mega_menu_title_transform: ' . esc_attr( $header_mega_menu_title_typography['text-transform'] ) . ';';
	}
	if ( ! empty( $header_mega_menu_title_typography['line-height'] ) ) {
		echo '--con_header_mega_menu_title_line_height: ' . esc_attr( $header_mega_menu_title_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_mega_menu_title_typography['font-weight'] ) ) {
		echo '--con_header_mega_menu_title_font_weight: ' . esc_attr( $header_mega_menu_title_typography['font-weight'] ) . ';';
	}
	if ( ! empty( $header_mega_menu_title_typography['font-size'] ) ) {
		echo '--con_header_mega_menu_title_font_size: ' . esc_attr( $header_mega_menu_title_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_title_color' ) && ! empty( $header_mega_menu_title_typography ) ) {
		$header_mega_menu_title_link_color = implode( get_post_meta( $page_id, 'header_mega_menu_title_color', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_title_color', false ) ) : $header_mega_menu_title_typography['color'];
		if ( ! empty( $header_mega_menu_title_link_color ) ) {
			echo '--con_header_mega_menu_title_link_color: ' . esc_attr( $header_mega_menu_title_link_color ) . ';';
		}
	} elseif ( ! empty( $header_mega_menu_title_typography['color'] ) ) {
		echo '--con_header_mega_menu_title_link_color: ' . esc_attr( $header_mega_menu_title_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_title_color_hover' ) ) {
		$header_mega_menu_title_link_color_hover = implode( get_post_meta( $page_id, 'header_mega_menu_title_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_title_color_hover', false ) ) : consulting_theme_option( 'header_mega_menu_title_color_hover' );
		if ( ! empty( $header_mega_menu_title_link_color_hover ) ) {
			echo '--con_header_mega_menu_title_link_color_hover: ' . esc_attr( $header_mega_menu_title_link_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_mega_menu_title_color_hover' ) ) ) {
		echo '--con_header_mega_menu_title_link_color_hover: ' . esc_attr( consulting_theme_option( 'header_mega_menu_title_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_description_color' ) ) {
		$header_mega_menu_description_color = implode( get_post_meta( $page_id, 'header_mega_menu_description_color', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_description_color', false ) ) : consulting_theme_option( 'header_mega_menu_description_color' );
		if ( ! empty( $header_mega_menu_description_color ) ) {
			echo '--con_header_mega_menu_description_color: ' . esc_attr( $header_mega_menu_description_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_mega_menu_description_color' ) ) ) {
		echo '--con_header_mega_menu_description_color: ' . esc_attr( consulting_theme_option( 'header_mega_menu_description_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_description_link_color' ) ) {
		$header_mega_menu_description_link_color = implode( get_post_meta( $page_id, 'header_mega_menu_description_link_color', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_description_link_color', false ) ) : consulting_theme_option( 'header_mega_menu_description_link_color' );
		if ( ! empty( $header_mega_menu_description_link_color ) ) {
			echo '--con_header_mega_menu_description_link_color: ' . esc_attr( $header_mega_menu_description_link_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_mega_menu_description_link_color' ) ) ) {
		echo '--con_header_mega_menu_description_link_color: ' . esc_attr( consulting_theme_option( 'header_mega_menu_description_link_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_description_link_color_hover' ) ) {
		$header_mega_menu_description_link_color_hover = implode( get_post_meta( $page_id, 'header_mega_menu_description_link_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_description_link_color_hover', false ) ) : consulting_theme_option( 'header_mega_menu_description_link_color_hover' );
		if ( ! empty( $header_mega_menu_description_link_color_hover ) ) {
			echo '--con_header_mega_menu_description_link_color_hover: ' . esc_attr( $header_mega_menu_description_link_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_mega_menu_description_link_color_hover' ) ) ) {
		echo '--con_header_mega_menu_description_link_color_hover: ' . esc_attr( consulting_theme_option( 'header_mega_menu_description_link_color_hover' ) ) . ';';
	}
	$header_mega_menu_link_typography = ( consulting_theme_option( 'header_mega_menu_link_typography' ) );
	if ( ! empty( $header_mega_menu_link_typography['text-transform'] ) ) {
		echo '--con_header_mega_menu_link_text_transform: ' . esc_attr( $header_mega_menu_link_typography['text-transform'] ) . ';';
	}
	if ( ! empty( $header_mega_menu_link_typography['line-height'] ) ) {
		echo '--con_header_mega_menu_link_text_height: ' . esc_attr( $header_mega_menu_link_typography['line-height'] ) . 'px;';
	}
	if ( ! empty( $header_mega_menu_link_typography['font-weight'] ) ) {
		echo '--con_header_mega_menu_link_text_weight: ' . esc_attr( $header_mega_menu_link_typography['font-weight'] ) . ';';
	}
	if ( ! empty( $header_mega_menu_link_typography['font-size'] ) ) {
		echo '--con_header_mega_menu_link_text_size: ' . esc_attr( $header_mega_menu_link_typography['font-size'] ) . 'px;';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_color' ) && ! empty( $header_mega_menu_link_typography ) ) {
		$header_mega_menu_title_link_color = implode( get_post_meta( $page_id, 'header_mega_menu_color', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_color', false ) ) : $header_mega_menu_link_typography['color'];
		if ( ! empty( $header_mega_menu_title_link_color ) ) {
			echo '--con_header_mega_menu_link_text_color: ' . esc_attr( $header_mega_menu_title_link_color ) . ';';
		}
	} elseif ( ! empty( $header_mega_menu_link_typography['color'] ) ) {
		echo '--con_header_mega_menu_link_text_color: ' . esc_attr( $header_mega_menu_link_typography['color'] ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_color_hover' ) ) {
		$header_mega_menu_title_link_color_hover = implode( get_post_meta( $page_id, 'header_mega_menu_color_hover', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_color_hover', false ) ) : consulting_theme_option( 'header_mega_menu_color_hover' );
		if ( ! empty( $header_mega_menu_title_link_color_hover ) ) {
			echo '--con_header_mega_menu_link_text_hover: ' . esc_attr( $header_mega_menu_title_link_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_mega_menu_color_hover' ) ) ) {
		echo '--con_header_mega_menu_link_text_hover: ' . esc_attr( consulting_theme_option( 'header_mega_menu_color_hover' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_border_color' ) ) {
		$header_mega_menu_border_color = implode( get_post_meta( $page_id, 'header_mega_menu_border_color', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_border_color', false ) ) : consulting_theme_option( 'header_mega_menu_border_color' );
		if ( ! empty( $header_mega_menu_border_color ) ) {
			echo '--con_header_mega_menu_border_color: ' . esc_attr( $header_mega_menu_border_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_mega_menu_border_color' ) ) ) {
		echo '--con_header_mega_menu_border_color: ' . esc_attr( consulting_theme_option( 'header_mega_menu_border_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'header_mega_menu_icons_color' ) ) {
		$header_mega_menu_icons_color = implode( get_post_meta( $page_id, 'header_mega_menu_icons_color', false ) ) ? implode( get_post_meta( $page_id, 'header_mega_menu_icons_color', false ) ) : consulting_theme_option( 'header_mega_menu_icons_color' );
		if ( ! empty( $header_mega_menu_icons_color ) ) {
			echo '--con_header_mega_menu_icons_color: ' . esc_attr( $header_mega_menu_icons_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'header_mega_menu_icons_color' ) ) ) {
		echo '--con_header_mega_menu_icons_color: ' . esc_attr( consulting_theme_option( 'header_mega_menu_icons_color' ) ) . ';';
	}
	?>
	}
	<?php
	$css = ob_get_contents();
	ob_end_clean();
	return $css;
}
