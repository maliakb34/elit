<?php
function consulting_title_box_css() {
	$page_id = consulting_page_id();

	ob_start();
	?>
	:root {
	<?php
	//Top Bar Styles
	if ( metadata_exists( 'post', $page_id, 'title_box_title_bg_color' ) ) {
		$title_box_title_bg_color = implode( get_post_meta( $page_id, 'title_box_title_bg_color' ) ) ? implode( get_post_meta( $page_id, 'title_box_title_bg_color' ) ) : consulting_theme_option( 'metabox_title_box_title_bg_color' );
		if ( ! empty( $title_box_title_bg_color ) ) {
			echo '--con_title_box_title_bg_color: ' . esc_attr( $title_box_title_bg_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_title_bg_color' ) ) ) {
		echo '--con_title_box_title_bg_color: ' . esc_attr( consulting_theme_option( 'metabox_title_box_title_bg_color' ) ) . ';';
	}
	if ( 'default' !== get_post_meta( $page_id, 'title_box_bg_custom_image', true ) && metadata_exists( 'post', $page_id, 'title_box_bg_image' ) ) {
		$title_box_image = wp_get_attachment_image_src( get_post_meta( $page_id, 'title_box_bg_image', true ), 'full' );
		if ( ! empty( $title_box_image ) ) {
			echo '--con_title_box_bg_image: url(' . esc_url( $title_box_image[0] ) . ');';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_bg_image' ) ) ) {
		$title_box_image = wp_get_attachment_image_src( consulting_theme_option( 'metabox_title_box_bg_image' ), 'full' );
		echo '--con_title_box_bg_image: url(' . esc_url( $title_box_image[0] ) . ');';
	}
	if ( metadata_exists( 'post', $page_id, 'title_box_bg_position' ) ) {
		$title_box_bg_position = implode( get_post_meta( $page_id, 'title_box_bg_position' ) );
		if ( 'custom' !== $title_box_bg_position && 'default' !== $title_box_bg_position ) {
			echo '--con_title_box_bg_position: ' . esc_attr( $title_box_bg_position ) . ';';
		}
		if ( 'custom' === $title_box_bg_position ) {
			echo '--con_title_box_bg_position: ' . esc_attr( implode( get_post_meta( $page_id, 'metabox_title_box_bg_position_x' ) ) ) . '% ' . esc_attr( implode( get_post_meta( $page_id, 'metabox_title_box_bg_position_y' ) ) ) . '%;';
		}
		if ( 'default' === $title_box_bg_position ) {
			echo '--con_title_box_bg_position: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_position' ) ) . ';';
		}
		if ( 'default' === $title_box_bg_position && 'custom' === esc_attr( consulting_theme_option( 'metabox_title_box_bg_position' ) ) ) {
			echo '--con_title_box_bg_position: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_position_x' ) ) . '% ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_position_y' ) ) . '%;';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_bg_position' ) ) ) {
		if ( 'custom' === consulting_theme_option( 'metabox_title_box_bg_position' ) ) {
			echo '--con_title_box_bg_position: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_position_x' ) ) . '% ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_position_y' ) ) . '%;';
		} else {
			echo '--con_title_box_bg_position: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_position' ) ) . ';';
		}
	}
	if ( metadata_exists( 'post', $page_id, 'metabox_title_box_bg_attachment' ) ) {
		$title_box_bg_attachment = implode( get_post_meta( $page_id, 'metabox_title_box_bg_attachment' ) );
		if ( 'default' === $title_box_bg_attachment ) {
			echo '--con_title_box_bg_attachment: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_attachment' ) ) . ';';
		} else {
			echo '--con_title_box_bg_attachment: ' . esc_attr( $title_box_bg_attachment ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_bg_attachment' ) ) ) {
		echo '--con_title_box_bg_attachment: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_attachment' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'title_box_bg_size' ) ) {
		$title_box_bg_size = implode( get_post_meta( $page_id, 'title_box_bg_size' ) );
		if ( 'default' === $title_box_bg_size ) {
			if ( 'custom' === consulting_theme_option( 'metabox_title_box_bg_size' ) ) {
				echo '--con_title_box_bg_size: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_size_slider' ) ) . '%;';
			} else {
				echo '--con_title_box_bg_size: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_size' ) ) . ';';
			}
		} elseif ( 'custom' === $title_box_bg_size ) {
			echo '--con_title_box_bg_size: ' . esc_attr( implode( get_post_meta( $page_id, 'metabox_title_box_bg_size_slider' ) ) ) . '%;';
		} else {
			echo '--con_title_box_bg_size: ' . esc_attr( $title_box_bg_size ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_bg_size' ) ) ) {
		if ( 'custom' === consulting_theme_option( 'metabox_title_box_bg_size' ) ) {
			echo '--con_title_box_bg_size: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_size_slider' ) ) . '%;';
		} else {
			echo '--con_title_box_bg_size: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_size' ) ) . ';';
		}
	}
	if ( metadata_exists( 'post', $page_id, 'title_box_bg_repeat' ) ) {
		$title_box_bg_repeat = implode( get_post_meta( $page_id, 'title_box_bg_repeat' ) );
		if ( 'default' === $title_box_bg_repeat ) {
			echo '--con_title_box_bg_repeat: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_repeat' ) ) . ';';
		} else {
			echo '--con_title_box_bg_repeat: ' . esc_attr( $title_box_bg_repeat ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_bg_repeat' ) ) ) {
		echo '--con_title_box_bg_repeat: ' . esc_attr( consulting_theme_option( 'metabox_title_box_bg_repeat' ) ) . ';';
	}
	//Title Styles
	if ( metadata_exists( 'post', $page_id, 'title_box_title_color' ) ) {
		$title_box_text_color = implode( get_post_meta( $page_id, 'title_box_title_color' ) ) ? implode( get_post_meta( $page_id, 'title_box_title_color' ) ) : consulting_theme_option( 'metabox_title_box_title_color' );
		if ( ! empty( $title_box_text_color ) ) {
			echo '--con_title_box_title_color: ' . esc_attr( $title_box_text_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_title_color' ) ) ) {
		echo '--con_title_box_title_color: ' . esc_attr( consulting_theme_option( 'metabox_title_box_title_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'title_box_title_line_color' ) ) {
		$title_box_title_line_color = implode( get_post_meta( $page_id, 'title_box_title_line_color' ) ) ? implode( get_post_meta( $page_id, 'title_box_title_line_color' ) ) : consulting_theme_option( 'metabox_title_box_title_line_color' );
		if ( ! empty( $title_box_title_line_color ) ) {
			echo '--con_title_box_title_line_color: ' . esc_attr( $title_box_title_line_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_title_line_color' ) ) ) {
		echo '--con_title_box_title_line_color: ' . esc_attr( consulting_theme_option( 'metabox_title_box_title_line_color' ) ) . ';';
	}
	//Breadcrumbs Styles
	if ( metadata_exists( 'post', $page_id, 'metabox_title_box_breadcrumbs_color' ) ) {
		$title_box_breadcrumbs_color = implode( get_post_meta( $page_id, 'metabox_title_box_breadcrumbs_color' ) ) ? implode( get_post_meta( $page_id, 'metabox_title_box_breadcrumbs_color' ) ) : consulting_theme_option( 'metabox_title_box_breadcrumbs_color' );
		if ( ! empty( $title_box_breadcrumbs_color ) ) {
			echo '--con_title_box_breadcrumbs_color: ' . esc_attr( $title_box_breadcrumbs_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_breadcrumbs_color' ) ) ) {
		echo '--con_title_box_breadcrumbs_color: ' . esc_attr( consulting_theme_option( 'metabox_title_box_breadcrumbs_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'metabox_title_box_links_color' ) ) {
		$title_box_links_color = implode( get_post_meta( $page_id, 'metabox_title_box_links_color' ) ) ? implode( get_post_meta( $page_id, 'metabox_title_box_links_color' ) ) : consulting_theme_option( 'metabox_title_box_breadcrumbs_color' );
		if ( ! empty( $title_box_links_color ) ) {
			echo '--con_title_box_links_color: ' . esc_attr( $title_box_links_color ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_links_color' ) ) ) {
		echo '--con_title_box_links_color: ' . esc_attr( consulting_theme_option( 'metabox_title_box_links_color' ) ) . ';';
	}
	if ( metadata_exists( 'post', $page_id, 'metabox_title_box_links_color_hover' ) ) {
		$title_box_links_color_hover = implode( get_post_meta( $page_id, 'metabox_title_box_links_color_hover' ) ) ? implode( get_post_meta( $page_id, 'metabox_title_box_links_color_hover' ) ) : consulting_theme_option( 'metabox_title_box_links_color_hover' );
		if ( ! empty( $title_box_links_color_hover ) ) {
			echo '--con_title_box_links_color_hover: ' . esc_attr( $title_box_links_color_hover ) . ';';
		}
	} elseif ( ! empty( consulting_theme_option( 'metabox_title_box_links_color_hover' ) ) ) {
		echo '--con_title_box_links_color_hover: ' . esc_attr( consulting_theme_option( 'metabox_title_box_links_color_hover' ) ) . ';';
	}
	?>
	}
	<?php
	$css = ob_get_contents();
	ob_end_clean();
	return $css;
}
