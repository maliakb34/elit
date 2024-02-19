<?php
add_filter(
	'consulting_theme_options',
	function ( $setups ) {
		$custom_fields = array(
			'name'   => esc_html__( 'Title Box', 'stm_post_type' ),
			'icon'   => 'fas fa-pager',
			'fields' => array(
				'page_settings_information_notice'    => array(
					'description' => esc_html__( 'These options will be enabled for the new pages and posts only. They can not be applied to the publish posts and pages.', 'stm_post_type' ),
					'type'        => 'notice',
				),
				'hfe_enabled_notice'                  => array(
					'description' => esc_html__( 'Title Box options are currently unavailable due to the activation of the Elementor Header & Footer Builder plugin. To utilize these settings, please disable the plugin.', 'stm_post_type' ),
					'type'        => 'notice',
					'dependency'  => array(
						'key'   => 'metabox_hfe_disabled',
						'value' => 'on',
					),
				),
				'metabox_disable_title_box'           => array(
					'type'            => 'checkbox',
					'label'           => esc_html__( 'Disable Title Box', 'stm_post_type' ),
					'group'           => 'started',
					'dependency'      => array(
						'key'   => 'metabox_hfe_disabled',
						'value' => 'on',
					),
					'dependency_mode' => 'disabled',
				),
				'metabox_hfe_disabled'                => array(
					'type'  => 'hidden-field',
					'value' => '',
				),
				'metabox_enable_transparent'          => array(
					'type'            => 'checkbox',
					'label'           => esc_html__( 'Transparent Title Box', 'stm_post_type' ),
					'description'     => esc_html__( 'Make the Title Box section background transparent', 'stm_post_type' ),
					'value'           => false,
					'dependency'      => array(
						'key'   => 'metabox_hfe_disabled',
						'value' => 'on',
					),
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_title_bg_color'    => array(
					'type'            => 'color',
					'label'           => esc_html__( 'Background Color', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_enable_transparent',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_bg_image'          => array(
					'type'            => 'image',
					'label'           => esc_html__( 'Background Image', 'stm_post_type' ),
					'description'     => esc_html__( 'Upload the background image or enter the image URL and set up its appearance', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_bg_position'       => array(
					'type'            => 'select',
					'label'           => esc_html__( 'Background Position', 'stm_post_type' ),
					'options'         => array(
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
					'value'           => 'center center',
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_bg_position_x'     => array(
					'type'         => 'range_slider',
					'label'        => esc_html__( 'Horizontal Alignment (X)', 'stm_post_type' ),
					'description'  => esc_html__( 'Horizontal alignment of the Background image from % width ratio.', 'stm_post_type' ),
					'min'          => 0,
					'max'          => 100,
					'value'        => 100,
					'dependency'   => array(
						array(
							'key'   => 'metabox_title_box_bg_position',
							'value' => 'custom',
						),
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
					),
					'dependencies' => '&&',
				),
				'metabox_title_box_bg_position_y'     => array(
					'type'         => 'range_slider',
					'label'        => esc_html__( 'Vertical Alignment (Y)', 'stm_post_type' ),
					'description'  => esc_html__( 'Vertical alignment of the Background image from % height ratio.', 'stm_post_type' ),
					'min'          => 0,
					'max'          => 100,
					'value'        => 100,
					'dependency'   => array(
						array(
							'key'   => 'metabox_title_box_bg_position',
							'value' => 'custom',
						),
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
					),
					'dependencies' => '&&',
				),
				'metabox_title_box_bg_attachment'     => array(
					'type'            => 'select',
					'label'           => esc_html__( 'Background Attachment', 'stm_post_type' ),
					'options'         => array(
						'scroll' => esc_html__( 'Scroll', 'stm_post_type' ),
						'fixed'  => esc_html__( 'Fixed', 'stm_post_type' ),
					),
					'value'           => 'scroll',
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_bg_size'           => array(
					'type'            => 'select',
					'label'           => esc_html__( 'Background Size', 'stm_post_type' ),
					'options'         => array(
						'auto'    => esc_html__( 'Auto', 'stm_post_type' ),
						'cover'   => esc_html__( 'Cover', 'stm_post_type' ),
						'contain' => esc_html__( 'Contain', 'stm_post_type' ),
						'custom'  => esc_html__( 'Custom', 'stm_post_type' ),
					),
					'value'           => 'cover',
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_bg_size_slider'    => array(
					'type'        => 'range_slider',
					'label'       => esc_html__( 'Width', 'stm_post_type' ),
					'description' => esc_html__( 'Background image width from % width ratio.', 'stm_post_type' ),
					'min'         => 0,
					'max'         => 100,
					'value'       => 100,
					'dependency'  => array(
						'key'   => 'metabox_title_box_bg_size',
						'value' => 'custom',
					),
				),
				'metabox_title_box_bg_repeat'         => array(
					'group'           => 'ended',
					'type'            => 'select',
					'label'           => esc_html__( 'Background Repeat', 'stm_post_type' ),
					'options'         => array(
						'no-repeat' => esc_html__( 'No Repeat', 'stm_post_type' ),
						'repeat'    => esc_html__( 'Repeat', 'stm_post_type' ),
						'repeat-x'  => esc_html__( 'Repeat-X', 'stm_post_type' ),
						'repeat-y'  => esc_html__( 'Repeat-Y', 'stm_post_type' ),
					),
					'value'           => 'no-repeat',
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_disable_title'               => array(
					'group'           => 'started',
					'type'            => 'checkbox',
					'label'           => esc_html__( 'Disable Title', 'stm_post_type' ),
					'description'     => esc_html__( 'Don’t show title on the page', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_title_color'       => array(
					'type'            => 'color',
					'label'           => esc_html__( 'Text Color', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_title_line_color'  => array(
					'group'           => 'ended',
					'type'            => 'color',
					'label'           => esc_html__( 'Title Line Color', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_disable_breadcrumbs'         => array(
					'group'           => 'started',
					'type'            => 'checkbox',
					'label'           => esc_html__( 'Disable Breadcrumbs', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_breadcrumbs_color' => array(
					'type'            => 'color',
					'label'           => esc_html__( 'Text Color', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_breadcrumbs',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_links_color'       => array(
					'type'            => 'color',
					'label'           => esc_html__( 'Links Color', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_breadcrumbs',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
				'metabox_title_box_links_color_hover' => array(
					'group'           => 'ended',
					'type'            => 'color',
					'label'           => esc_html__( 'Links Color on Hover', 'stm_post_type' ),
					'dependency'      => array(
						array(
							'key'   => 'metabox_disable_breadcrumbs',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_disable_title_box',
							'value' => 'empty',
						),
						array(
							'key'   => 'metabox_hfe_disabled',
							'value' => 'on',
						),
					),
					'dependencies'    => '&&',
					'dependency_mode' => 'disabled',
				),
			),
		);

		if ( is_plugin_active( 'header-footer-elementor/header-footer-elementor.php' ) ) {
			$custom_fields['fields']['metabox_hfe_disabled']['value'] = 'on';
		}
		$setups['page_settings'] = $custom_fields;

		return $setups;

	},
	10,
	1
);
