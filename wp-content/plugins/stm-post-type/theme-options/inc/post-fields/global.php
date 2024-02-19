<?php
add_filter(
	'stm_wpcfto_boxes',
	function ( $boxes ) {
		$boxes['page_setup'] = array(
			'post_type' => array(
				'page',
				'post',
				'stm_event',
				'stm_service',
				'stm_careers',
				'stm_staff',
				'stm_works',
				'stm_portfolio',
				'product',
				'elementor-hf',
			),
			'label'     => esc_html__( 'Settings', 'stm_post_type' ),
		);

		return $boxes;
	}
);

add_filter(
	'consulting_post_options',
	function ( $fields ) {
		// Default Values
		$metabox_content_bg_transparent    = (bool) consulting_theme_option( 'metabox_content_bg_transparent', false );
		$metabox_footer_copyright_border_t = consulting_theme_option( 'metabox_footer_copyright_border_t', false );

		if ( isset( $_GET['source'] ) || get_the_ID() ) {
			$post_id          = ( isset( $_GET['source'] ) ) ? $_GET['source'] : get_the_ID();
			$custom_post_type = get_post_type( $post_id );
			if ( 'elementor-hf' !== $custom_post_type ) {
				$fields['page_setup'] = array(
					'section_page_settings' => array(
						'name'   => esc_html__( 'Page Settings', 'stm_post_type' ),
						'fields' => array(
							'top_bar_custom_style'                           => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'Top Bar Styles', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Top Bar Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for Top Bar. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_bg'                                     => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Top Bar Background', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'wc_top_bar_cart_custom_style'                   => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF WOOCOMMERCE CART', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for WooCommerce Cart. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'wc_top_bar_cart_color'                          => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_top_bar_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'wc_top_bar_cart_icon_color_hover'               => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_top_bar_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'wc_top_bar_cart_counter_color'                  => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Counter color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_top_bar_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'wc_top_bar_cart_counter_color_hover'            => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Counter color on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_top_bar_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'wc_top_bar_cart_counter_bg'                     => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Counter Background Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_top_bar_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'wc_top_bar_cart_counter_bg_hover'               => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Counter Background Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_top_bar_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_wpml_switcher_custom_style'             => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF WPML MULTI-LANGUAGE', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for WPML Language switcher. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'wpml_switcher_color'                            => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Font Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_wpml_switcher_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_wpml_switcher_bg'                       => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Dropdown Background Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_wpml_switcher_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_wpml_switcher_bg_hover'                 => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Dropdown Background Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_wpml_switcher_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_wpml_switcher_color_hover'              => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Dropdown Text Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_wpml_switcher_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_socials_custom_style'                   => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF SOCIAL ICONS', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for Social Icons. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_socials_color'                          => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_socials_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_socials_color_hover'                    => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_socials_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_search_custom_style'                    => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF SEARCH', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for Search. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_search_color'                           => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_search_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_search_icon_color_hover'                => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_search_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_style'                     => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'Styles of Contact information', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for Contact information. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_color'                     => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Font Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_link_color'                => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Links Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_link_color_hover'          => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Links Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_select_bg'                 => array(
								'type'        => 'color',
								'label'       => esc_html__( 'Background Color of Selected Office', 'stm_post_type' ),
								'description' => esc_html__( 'When several offices were added, this option will be applied selected office from the drop-down.', 'stm_post_type' ),
								'dependency'  => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_select_color'              => array(
								'type'        => 'color',
								'label'       => esc_html__( 'Color of Drop-down List Arrow', 'stm_post_type' ),
								'description' => esc_html__( 'When several offices were added, this option will be applied selected office from the drop-down.', 'stm_post_type' ),
								'dependency'  => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_select_drop_bg'            => array(
								'type'        => 'color',
								'label'       => esc_html__( 'Background Color of Offices Drop-down', 'stm_post_type' ),
								'description' => esc_html__( 'When several offices were added, this option will be applied selected office from the drop-down.', 'stm_post_type' ),
								'dependency'  => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_select_items_bg'           => array(
								'type'        => 'color',
								'label'       => esc_html__( 'Background Color of the Office Item on Hover', 'stm_post_type' ),
								'description' => esc_html__( 'When several offices were added, this option will be applied selected office from the drop-down.', 'stm_post_type' ),
								'dependency'  => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_select_items_color'        => array(
								'type'        => 'color',
								'label'       => esc_html__( 'Color of the Office Item', 'stm_post_type' ),
								'description' => esc_html__( 'When several offices were added, this option will be applied selected office from the drop-down.', 'stm_post_type' ),
								'dependency'  => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'top_bar_contact_info_select_items_hover'        => array(
								'group'       => 'ended',
								'type'        => 'color',
								'label'       => esc_html__( 'Color of the Office Item on Hover', 'stm_post_type' ),
								'description' => esc_html__( 'When several offices were added, this option will be applied selected office from the drop-down.', 'stm_post_type' ),
								'dependency'  => array(
									'key'   => 'top_bar_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Top Bar', 'stm_post_type' ),
							),
							'header_inverse'                                 => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'HEADER POSITIONING', 'stm_post_type' ),
								'label'       => esc_html__( 'Style - Inverse', 'stm_post_type' ),
								'type'        => 'select',
								'description' => esc_html__( 'This option swappers logo and dark logo.', 'stm_post_type' ),
								'options'     => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'on'      => esc_html__( 'Enable', 'stm_post_type' ),
									''        => esc_html__( 'Disable', 'stm_post_type' ),
								),
								'value'       => ( get_post_meta( $post_id, 'header_inverse', true ) ) ? 'on' : '',
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'enable_header_transparent'                      => array(
								'group'       => 'ended',
								'label'       => esc_html__( 'Transparent Header', 'stm_post_type' ),
								'description' => esc_html__( 'When this option is enabled, the header will be positioned absolutely above the blocks', 'stm_post_type' ),
								'type'        => 'select',
								'options'     => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'on'      => esc_html__( 'Enable', 'stm_post_type' ),
									''        => esc_html__( 'Disable', 'stm_post_type' ),
								),
								'value'       => ( get_post_meta( $post_id, 'enable_header_transparent', true ) ) ? 'on' : '',
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_custom_style'                        => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'Header Styles', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Header Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for header. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_bg'                                      => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Header Background', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_shadow'                                  => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Header Shadow', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'wc_cart_custom_style'                           => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF WOOCOMMERCE CART', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for WooCommerce Cart. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'wc_cart_icon_color'                             => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'wc_cart_icon_color_hover'                       => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'wc_cart_counter_color'                          => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Counter Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'wc_cart_counter_color_hover'                    => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Counter Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'wc_cart_counter_bg'                             => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Counter background color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'wc_cart_counter_bg_hover'                       => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Counter background color on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'wc_cart_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_wpml_switcher_custom_style'              => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF WPML MULTI-LANGUAGE', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for WPML Language switcher. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_wpml_switcher_color'                     => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Font Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_wpml_switcher_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_wpml_switcher_color_hover'               => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Font color on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_wpml_switcher_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_wpml_switcher_bg'                        => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Dropdown Background Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_wpml_switcher_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_wpml_switcher_bg_hover'                  => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Dropdown Background Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_wpml_switcher_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_socials_custom_style'                    => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF SOCIAL ICONS', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for Social Icons. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_socials_color'                           => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_socials_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_socials_color_hover'                     => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_socials_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_search_custom_style'                     => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF SEARCH', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for Search. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_search_icon_color'                       => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_search_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_search_icon_color_hover'                 => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_search_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_contact_info_style'                      => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'Styles of Contact information', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for Contact information. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_contact_info_color'                      => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Font Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_contact_info_link_color'                 => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Links Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_contact_info_link_color_hover'           => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Links Color on Hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_contact_info_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_button_custom_style'                     => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF BUTTON (CALL TO ACTION)', 'stm_post_type' ),
								'type'        => 'checkbox',
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for Call to Action button. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'value'       => false,
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_button_color'                            => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_button_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_button_color_hover'                      => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Hover color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_button_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_button_bg'                               => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Background color', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_button_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_button_bg_hover'                         => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Background color on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_button_custom_style',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_customize'                      => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF MENU', 'stm_post_type' ),
								'label'       => esc_html__( 'Additional Customization', 'stm_post_type' ),
								'description' => esc_html__( 'This option shows additional settings for navigation menu. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
								'type'        => 'checkbox',
								'value'       => false,
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_link_color'                     => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF MAIN MENU', 'stm_post_type' ),
								'type'        => 'color',
								'label'       => esc_html__( 'Color of the links', 'stm_post_type' ),
								'value'       => '',
								'dependency'  => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_link_color_hover'               => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_link_color_active'              => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of active link', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_link_arrow_color'               => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the arrow', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_link_arrow_color_hover'         => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the arrow on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_1_bg'                     => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF FIRST-LEVEL SUB-MENU', 'stm_post_type' ),
								'type'        => 'color',
								'label'       => esc_html__( 'Background', 'stm_post_type' ),
								'value'       => '',
								'dependency'  => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_1_link_color'             => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_1_link_color_hover'       => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_1_link_bg_hover'          => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Background Color of the links on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_1_link_arrow_color'       => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the arrow', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_1_link_arrow_color_hover' => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the arrow on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_2_bg'                     => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF SECOND-LEVEL SUB-MENU', 'stm_post_type' ),
								'type'        => 'color',
								'label'       => esc_html__( 'Background', 'stm_post_type' ),
								'value'       => '',
								'dependency'  => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_2_link_color'             => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_2_link_color_hover'       => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_level_2_link_bg_hover'          => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Background Color of the links on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_bg'                            => array(
								'group'       => 'started',
								'group_title' => esc_html__( 'STYLES OF MEGA MENU', 'stm_post_type' ),
								'type'        => 'color',
								'label'       => esc_html__( 'Background', 'stm_post_type' ),
								'value'       => '',
								'dependency'  => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_title_color'                   => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of Headings', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_title_color_hover'             => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of Headings on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_description_color'             => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the descriptions', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_description_link_color'        => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links in descriptions', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_description_link_color_hover'  => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links in descriptions on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_color'                         => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_color_hover'                   => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the links on hover', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_border_color'                  => array(
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the dividers', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_mega_menu_icons_color'                   => array(
								'group'      => 'ended',
								'type'       => 'color',
								'label'      => esc_html__( 'Color of the icons', 'stm_post_type' ),
								'value'      => '',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'header_nav_menu_customize_end'                  => array(
								'group'      => 'ended',
								'type'       => 'notification_message',
								'dependency' => array(
									'key'   => 'header_nav_menu_customize',
									'value' => 'not_empty',
								),
								'submenu'    => esc_html__( 'Header Navigation', 'stm_post_type' ),
							),
							'hfe_enabled_notice'                             => array(
								'description' => esc_html__( 'Title Box options are currently unavailable due to the activation of the Elementor Header & Footer Builder plugin. To utilize these settings, please disable the plugin.', 'stm_post_type' ),
								'type'        => 'notice',
								'dependency'  => array(
									'key'   => 'hfe_disabled',
									'value' => 'on',
								),
								'submenu'     => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'disable_title_box'                              => array(
								'group'           => 'started',
								'label'           => esc_html__( 'Title Box', 'stm_post_type' ),
								'type'            => 'select',
								'options'         => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'on'      => esc_html__( 'Disable', 'stm_post_type' ),
									''        => esc_html__( 'Enable', 'stm_post_type' ),
								),
								'value'           => ( get_post_meta( $post_id, 'disable_title_box', true ) ) ? '' : 'default',
								'submenu'         => esc_html__( 'Title Box Options', 'stm_post_type' ),
								'dependency'      => array(
									'key'   => 'hfe_disabled',
									'value' => 'on',
								),
								'dependency_mode' => 'disabled',
							),
							'hfe_disabled'                                   => array(
								'type'    => 'hidden-field',
								'value'   => '',
								'submenu' => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'enable_transparent'                             => array(
								'label'           => esc_html__( 'Enable Transparent', 'stm_post_type' ),
								'description'     => esc_html__( 'Make the Title Box section background transparent', 'stm_post_type' ),
								'type'            => 'select',
								'options'         => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'on'      => esc_html__( 'Enable', 'stm_post_type' ),
									''        => esc_html__( 'Disable', 'stm_post_type' ),
								),
								'value'           => ( get_post_meta( $post_id, 'enable_transparent', false ) ) ? 'on' : 'default',
								'submenu'         => esc_html__( 'Title Box Options', 'stm_post_type' ),
								'dependency'      => array(
									'key'   => 'hfe_disabled',
									'value' => 'on',
								),
								'dependency_mode' => 'disabled',
							),
							'title_box_title_bg_color'                       => array(
								'label'        => esc_html__( 'Background Color', 'stm_post_type' ),
								'type'         => 'color',
								'value'        => ( get_post_meta( $post_id, 'title_box_title_bg_color' ) ) ? get_post_meta( $post_id, 'title_box_title_bg_color' ) : '',
								'dependency'   => array(
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
									array(
										'key'   => 'enable_transparent',
										'value' => 'empty',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'title_box_bg_custom_image'                      => array(
								'type'       => 'select',
								'label'      => esc_html__( 'Background Image', 'stm_post_type' ),
								'options'    => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'custom'  => esc_html__( 'Custom', 'stm_post_type' ),
								),
								'value'      => get_post_meta( $post_id, 'title_box_bg_image' ) ? 'custom' : 'default',
								'dependency' => array(
									'key'   => 'disable_title_box',
									'value' => 'default|| ',
								),
								'submenu'    => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'title_box_bg_image'                             => array(
								'label'        => esc_html__( 'Background Image', 'stm_post_type' ),
								'type'         => 'image',
								'value'        => '',
								'dependency'   => array(
									array(
										'key'   => 'title_box_bg_custom_image',
										'value' => 'custom',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'title_box_bg_position'                          => array(
								'label'      => esc_html__( 'Background Position', 'stm_post_type' ),
								'type'       => 'select',
								'options'    => array(
									'default'       => esc_html__( 'Default', 'stm_post_type' ),
									'center center' => esc_html__( 'Center Center', 'stm_post_type' ),
									'center left'   => esc_html__( 'Center Left', 'stm_post_type' ),
									'center right'  => esc_html__( 'Center Right', 'stm_post_type' ),
									'top center'    => esc_html__( 'Top Center', 'stm_post_type' ),
									'top left'      => esc_html__( 'Top Left', 'stm_post_type' ),
									'top right'     => esc_html__( 'Top Right', 'stm_post_type' ),
									'bottom center' => esc_html__( 'Bottom Center', 'stm_post_type' ),
									'bottom left'   => esc_html__( 'Bottom Left', 'stm_post_type' ),
									'bottom right'  => esc_html__( 'Bottom Right', 'stm_post_type' ),
									'custom'        => esc_html__( 'Custom', 'stm_post_type' ),
								),
								'value'      => 'default',
								'dependency' => array(
									'key'   => 'disable_title_box',
									'value' => 'default|| ',
								),
								'submenu'    => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'metabox_title_box_bg_position_x'                => array(
								'type'         => 'range_slider',
								'label'        => esc_html__( 'Horizontal Alignment (X)', 'stm_post_type' ),
								'description'  => esc_html__( 'Horizontal alignment of the Background image from % width ratio.', 'stm_post_type' ),
								'min'          => 0,
								'max'          => 100,
								'value'        => 100,
								'dependency'   => array(
									array(
										'key'   => 'title_box_bg_position',
										'value' => 'custom',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'metabox_title_box_bg_position_y'                => array(
								'type'         => 'range_slider',
								'label'        => esc_html__( 'Vertical Alignment (Y)', 'stm_post_type' ),
								'description'  => esc_html__( 'Vertical alignment of the Background image from % height ratio.', 'stm_post_type' ),
								'min'          => 0,
								'max'          => 100,
								'value'        => 100,
								'dependency'   => array(
									array(
										'key'   => 'title_box_bg_position',
										'value' => 'custom',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'metabox_title_box_bg_attachment'                => array(
								'type'       => 'select',
								'label'      => esc_html__( 'Background Attachment', 'stm_post_type' ),
								'options'    => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'scroll'  => esc_html__( 'Scroll', 'stm_post_type' ),
									'fixed'   => esc_html__( 'Fixed', 'stm_post_type' ),
								),
								'value'      => 'default',
								'dependency' => array(
									'key'   => 'disable_title_box',
									'value' => 'default|| ',
								),
								'submenu'    => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'title_box_bg_size'                              => array(
								'label'      => esc_html__( 'Background Size', 'stm_post_type' ),
								'type'       => 'select',
								'options'    => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'auto'    => esc_html__( 'Auto', 'stm_post_type' ),
									'cover'   => esc_html__( 'Cover', 'stm_post_type' ),
									'contain' => esc_html__( 'Contain', 'stm_post_type' ),
									'custom'  => esc_html__( 'Custom', 'stm_post_type' ),
								),
								'value'      => 'default',
								'dependency' => array(
									'key'   => 'disable_title_box',
									'value' => 'default|| ',
								),
								'submenu'    => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'metabox_title_box_bg_size_slider'               => array(
								'type'         => 'range_slider',
								'label'        => esc_html__( 'Width', 'stm_post_type' ),
								'description'  => esc_html__( 'Background image width from % width ratio.', 'stm_post_type' ),
								'min'          => 0,
								'max'          => 100,
								'value'        => 100,
								'dependency'   => array(
									array(
										'key'   => 'title_box_bg_size',
										'value' => 'custom',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'title_box_bg_repeat'                            => array(
								'group'      => 'ended',
								'label'      => esc_html__( 'Background Repeat', 'stm_post_type' ),
								'type'       => 'select',
								'options'    => array(
									'default'   => esc_html__( 'Default', 'stm_post_type' ),
									'repeat'    => esc_html__( 'Repeat', 'stm_post_type' ),
									'no-repeat' => esc_html__( 'No Repeat', 'stm_post_type' ),
									'repeat-x'  => esc_html__( 'Repeat-X', 'stm_post_type' ),
									'repeat-y'  => esc_html__( 'Repeat-Y', 'stm_post_type' ),
								),
								'value'      => 'default',
								'dependency' => array(
									'key'   => 'disable_title_box',
									'value' => 'default|| ',
								),
								'submenu'    => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'disable_title'                                  => array(
								'group'      => 'started',
								'label'      => esc_html__( 'Title', 'stm_post_type' ),
								'type'       => 'select',
								'options'    => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'on'      => esc_html__( 'Disable', 'stm_post_type' ),
									''        => esc_html__( 'Enable', 'stm_post_type' ),
								),
								'value'      => ( get_post_meta( $post_id, 'disable_title', false ) ) ? '' : 'default',
								'dependency' => array(
									'key'   => 'disable_title_box',
									'value' => 'default|| ',
								),
								'submenu'    => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'title_box_title_color'                          => array(
								'label'        => esc_html__( 'Title Color', 'stm_post_type' ),
								'type'         => 'color',
								'value'        => ( get_post_meta( $post_id, 'title_box_title_color' ) ) ? get_post_meta( $post_id, 'title_box_title_color' ) : '',
								'dependency'   => array(
									array(
										'key'   => 'disable_title',
										'value' => 'default|| ',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'title_box_title_line_color'                     => array(
								'group'        => 'ended',
								'label'        => esc_html__( 'Title Line Color', 'stm_post_type' ),
								'type'         => 'color',
								'value'        => ( get_post_meta( $post_id, 'title_box_title_line_color' ) ) ? get_post_meta( $post_id, 'title_box_title_line_color' ) : '',
								'dependency'   => array(
									array(
										'key'   => 'disable_title',
										'value' => 'default|| ',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'disable_breadcrumbs'                            => array(
								'group'      => 'started',
								'label'      => esc_html__( 'Breadcrumbs', 'stm_post_type' ),
								'type'       => 'select',
								'options'    => array(
									'default' => esc_html__( 'Default', 'stm_post_type' ),
									'disable' => esc_html__( 'Disable', 'stm_post_type' ),
									''        => esc_html__( 'Enable', 'stm_post_type' ),
								),
								'value'      => ( get_post_meta( $post_id, 'disable_breadcrumbs', false ) ) ? '' : 'default',
								'dependency' => array(
									'key'   => 'disable_title_box',
									'value' => 'default|| ',
								),
								'submenu'    => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'metabox_title_box_breadcrumbs_color'            => array(
								'type'         => 'color',
								'label'        => esc_html__( 'Text Color', 'stm_post_type' ),
								'dependency'   => array(
									array(
										'key'   => 'disable_breadcrumbs',
										'value' => 'default|| ',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'value'        => ( get_post_meta( $post_id, 'title_box_title_color' ) ) ? get_post_meta( $post_id, 'title_box_title_color' ) : '',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'metabox_title_box_links_color'                  => array(
								'type'         => 'color',
								'label'        => esc_html__( 'Links Color', 'stm_post_type' ),
								'dependency'   => array(
									array(
										'key'   => 'disable_breadcrumbs',
										'value' => 'default|| ',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'value'        => ( get_post_meta( $post_id, 'title_box_title_color' ) ) ? get_post_meta( $post_id, 'title_box_title_color' ) : '',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'metabox_title_box_links_color_hover'            => array(
								'group'        => 'ended',
								'type'         => 'color',
								'label'        => esc_html__( 'Links Color on Hover', 'stm_post_type' ),
								'dependency'   => array(
									array(
										'key'   => 'disable_breadcrumbs',
										'value' => 'default|| ',
									),
									array(
										'key'   => 'disable_title_box',
										'value' => 'default|| ',
									),
								),
								'dependencies' => '&&',
								'value'        => ( get_post_meta( $post_id, 'title_box_title_color' ) ) ? get_post_meta( $post_id, 'title_box_title_color' ) : '',
								'submenu'      => esc_html__( 'Title Box Options', 'stm_post_type' ),
							),
							'content_bg_transparent'                         => array(
								'label'   => esc_html__( 'Background - Transparent (Work only with "Boxed Mode")', 'stm_post_type' ),
								'type'    => 'checkbox',
								'value'   => $metabox_content_bg_transparent,
								'submenu' => esc_html__( 'Content Options', 'stm_post_type' ),
							),
							'show_popup_single'                              => array(
								'type'    => 'checkbox',
								'label'   => esc_html__( 'Popup', 'stm_post_type' ),
								'value'   => false,
								'submenu' => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popups_single'                                  => array(
								'type'        => 'select',
								'label'       => esc_html__( 'Select Popup', 'stm_post_type' ),
								'description' => esc_html__( 'Select the desired Popup to display on Website', 'stm_post_type' ),
								'options'     => consulting_popups(),
								'dependency'  => array(
									'key'   => 'show_popup_single',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popups_single_event'                            => array(
								'label'       => esc_html__( 'Triggers', 'stm_post_type' ),
								'description' => esc_html__( 'What action the does a user need to do to make the popup open', 'stm_post_type' ),
								'group'       => 'started',
								'type'        => 'select',
								'options'     => array(
									'popup_event_on_load'    => esc_html__( 'On Page Load(s)', 'stm_post_type' ),
									'popup_event_inactivity' => esc_html__( 'After Inactivity Time', 'stm_post_type' ),
									'popup_event_on_exit'    => esc_html__( 'On Exit Intent', 'stm_post_type' ),
									'popup_event_on_date'    => esc_html__( 'In Date Period', 'stm_post_type' ),
									'popup_event_on_time'    => esc_html__( 'In Time Period', 'stm_post_type' ),
								),
								'value'       => 'popup_event_on_load',
								'dependency'  => array(
									'key'   => 'show_popup_single',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popup_single_event_open_delay'                  => array(
								'label'       => esc_html__( 'Delay', 'stm_post_type' ),
								'description' => esc_html__( 'Show after X amount of time (in seconds)', 'stm_post_type' ),
								'type'        => 'number',
								'dependency'  => array(
									'key'   => 'show_popup_single',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popup_single_event_showing_in'                  => array(
								'label'       => esc_html__( 'Rerun', 'stm_post_type' ),
								'description' => esc_html__( 'Show again after X period of time', 'stm_post_type' ),
								'type'        => 'select',
								'options'     => array(
									'60'      => esc_html__( 'Minute', 'stm_post_type' ),
									'600'     => esc_html__( '10 Minutes', 'stm_post_type' ),
									'1800'    => esc_html__( '30 Minutes', 'stm_post_type' ),
									'3600'    => esc_html__( 'Hour', 'stm_post_type' ),
									'10800'   => esc_html__( '3 Hours', 'stm_post_type' ),
									'21600'   => esc_html__( '6 Hours', 'stm_post_type' ),
									'43200'   => esc_html__( '12 Hours', 'stm_post_type' ),
									'86400'   => esc_html__( 'Day', 'stm_post_type' ),
									'259200'  => esc_html__( '3 Days', 'stm_post_type' ),
									'604800'  => esc_html__( 'Week', 'stm_post_type' ),
									'1209600' => esc_html__( '2 Weeks', 'stm_post_type' ),
									'1814400' => esc_html__( '3 Weeks', 'stm_post_type' ),
									'2419200' => esc_html__( '4 Weeks', 'stm_post_type' ),
									'never'   => esc_html__( 'Never', 'stm_post_type' ),
								),
								'value'       => '60',
								'dependency'  => array(
									'key'   => 'show_popup_single',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popup_single_event_date_from'                   => array(
								'label'        => esc_html__( 'Show from the Selected Date', 'stm_post_type' ),
								'description'  => esc_html__( 'The time zone is taken from the WordPress General settings', 'stm_post_type' ),
								'type'         => 'date',
								'dependency'   => array(
									array(
										'key'   => 'show_popup_single',
										'value' => 'not_empty',
									),
									array(
										'key'   => 'popups_single_event',
										'value' => 'popup_event_on_date',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popup_single_event_date_to'                     => array(
								'label'        => esc_html__( 'Show until the Selected Date', 'stm_post_type' ),
								'description'  => esc_html__( 'The time zone is taken from the WordPress General settings', 'stm_post_type' ),
								'type'         => 'date',
								'dependency'   => array(
									array(
										'key'   => 'show_popup_single',
										'value' => 'not_empty',
									),
									array(
										'key'   => 'popups_single_event',
										'value' => 'popup_event_on_date',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popup_single_event_time_from'                   => array(
								'label'        => esc_html__( 'Show from the Selected Time', 'stm_post_type' ),
								'description'  => esc_html__( 'Popup appears daily from the selected time', 'stm_post_type' ),
								'type'         => 'time',
								'dependency'   => array(
									array(
										'key'   => 'show_popup_single',
										'value' => 'not_empty',
									),
									array(
										'key'   => 'popups_single_event',
										'value' => 'popup_event_on_time',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popup_single_event_time_to'                     => array(
								'label'        => esc_html__( 'Show until the Selected Time', 'stm_post_type' ),
								'description'  => esc_html__( 'Popup appears daily until the selected time', 'stm_post_type' ),
								'group'        => 'ended',
								'type'         => 'time',
								'dependency'   => array(
									array(
										'key'   => 'show_popup_single',
										'value' => 'not_empty',
									),
									array(
										'key'   => 'popups_single_event',
										'value' => 'popup_event_on_time',
									),
								),
								'dependencies' => '&&',
								'submenu'      => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popup_single_animation'                         => array(
								'label'       => esc_html__( 'Animation', 'stm_post_type' ),
								'description' => esc_html__( 'Select Animation', 'stm_post_type' ),
								'type'        => 'select',
								'options'     => array(
									''                                             => esc_html__( 'None', 'stm_post_type' ),
									'animate__animated animate__fadeIn'            => esc_html__( 'FadeIn', 'stm_post_type' ),
									'animate__animated animate__fadeInDown'        => esc_html__( 'FadeDown', 'stm_post_type' ),
									'animate__animated animate__bounce'            => esc_html__( 'Bounce', 'stm_post_type' ),
									'animate__animated animate__zoomIn'            => esc_html__( 'ZoomIn', 'stm_post_type' ),
									'animate__animated animate__zoomInDown'        => esc_html__( 'ZoomInDown', 'stm_post_type' ),
									'animate__animated animate__rotateInDownRight' => esc_html__( 'ZoomInRight', 'stm_post_type' ),
									'animate__animated animate__rotateInDownLeft'  => esc_html__( 'ZoomInLeft', 'stm_post_type' ),
									'animate__animated animate__rotateIn'          => esc_html__( 'RotateIn', 'stm_post_type' ),
									'animate__animated animate__flip'              => esc_html__( 'Flip', 'stm_post_type' ),
									'animate__animated animate__slideInUp'         => esc_html__( 'SlideInUp', 'stm_post_type' ),
									'animate__animated animate__slideInDown'       => esc_html__( 'SlideInDown', 'stm_post_type' ),
									'animate__animated animate__lightSpeedInRight' => esc_html__( 'LightSpeedInRight', 'stm_post_type' ),
									'animate__animated animate__lightSpeedInLeft'  => esc_html__( 'LightSpeedInLeft', 'stm_post_type' ),
								),
								'value'       => '',
								'dependency'  => array(
									'key'   => 'show_popup_single',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'popup_single_responsive'                        => array(
								'label'       => esc_html__( 'Responsive Rules', 'stm_post_type' ),
								'description' => esc_html__( 'Do not show the popup if the width of the browser window in the device is equal or less than', 'stm_post_type' ),
								'type'        => 'select',
								'options'     => array(
									''     => esc_html__( 'None', 'stm_post_type' ),
									'1199' => esc_html__( 'Ipad Size Landscape (1199px)', 'stm_post_type' ),
									'1023' => esc_html__( 'Ipad Size Portrait (1024px)', 'stm_post_type' ),
									'767'  => esc_html__( 'Mobile Size Landscape (767px)', 'stm_post_type' ),
									'580'  => esc_html__( 'Mobile Size Portrait (580px)', 'stm_post_type' ),
								),
								'value'       => '',
								'dependency'  => array(
									'key'   => 'show_popup_single',
									'value' => 'not_empty',
								),
								'submenu'     => esc_html__( 'Popup', 'stm_post_type' ),
							),
							'separator_footer_copyright_border_t'            => array(
								'label'   => esc_html__( 'Hide Border Top', 'stm_post_type' ),
								'type'    => 'checkbox',
								'value'   => $metabox_footer_copyright_border_t,
								'submenu' => esc_html__( 'Footer Options', 'stm_post_type' ),
							),
						),
					),
				);
			}
		}
		if ( is_plugin_active( 'header-footer-elementor/header-footer-elementor.php' ) ) {
			$fields['page_setup']['section_page_settings']['fields']['hfe_disabled']['value'] = 'on';
		}

		return $fields;
	}
);
