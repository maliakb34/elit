<?php
add_filter(
	'consulting_theme_options',
	function ( $setups ) {
		$consulting_config = '';

		if ( function_exists( 'consulting_config' ) ) {
			$consulting_config = consulting_config();
		}

		$fields = array(
			'header_builder'                           => array(
				'type'            => 'select',
				'label'           => esc_html__( 'Choose Header Option', 'stm_post_type' ),
				'options'         => array(
					'theme_builder'     => esc_html__( 'Default Theme Headers', 'stm_post_type' ),
					'pear_builder'      => esc_html__( 'Pearl Header Builder', 'stm_post_type' ),
					'elementor_builder' => esc_html__( 'Elementor Header Builder', 'stm_post_type' ),
				),
				'disabled_option' => array(
					'theme_builder'     => false,
					'pear_builder'      => true,
					'elementor_builder' => false,
				),
				'value'           => 'theme_builder',
				'submenu'         => esc_html__( 'Choose Header Option', 'stm_post_type' ),
			),
			'consulting_headers_information_notice'    => array(
				'type'        => 'notification_message',
				'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/consulting.png',
				'description' => sprintf(
					'
                <h1>Default Theme Headers</h1>
                <p>The <strong>Default Theme Headers</strong> can be customized through items in the <strong>Header</strong> menu of the <strong>Theme Options</strong>.</p>
                '
				),
				'buttons'     => array(
					array(
						'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header',
						'text' => 'How it works',
					),
				),
				'submenu'     => esc_html__( 'Choose Header Option', 'stm_post_type' ),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
			),
			'pearl_plugin_information_notice'          => array(
				'type'        => 'notification_message',
				'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/pearl_hb.png',
				'description' => sprintf(
					'
                <h1>WordPress Header Builder Plugin – Pearl</h1>
                <p>We are deprecating support for Pearl Header Builder plugin.  When different Header Builder selected, you will not be able to use it again and it will be disabled.</p>
                '
				),
				'buttons'     => array(
					array(
						'url'   => admin_url( 'plugin-install.php' ),
						'text'  => 'Install & Activate',
						'class' => 'button_black',
					),
					array(
						'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header-builder/pearl-header-builder',
						'text' => 'How it works',
					),
				),
				'submenu'     => esc_html__( 'Choose Header Option', 'stm_post_type' ),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'pear_builder',
				),
			),
			'ehf_plugin_active_information_notice'     => array(
				'type'        => 'notification_message',
				'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/ehf.svg',
				'description' => sprintf(
					'
                <h1>Elementor Header & Footer Builder</h1>
                <p>The installation and activation of the <strong>Elementor Header & Footer Builder</strong> and <strong>Elementor</strong> plugins required. You can manage and customize headers in the Appearance > Elementor Header & Footer Builder section.</p>
                '
				),
				'buttons'     => array(
					array(
						'url'   => admin_url( 'plugin-install.php' ),
						'text'  => 'Install & Activate',
						'class' => 'button_black',
					),
					array(
						'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header-builder/elementor-header-builder',
						'text' => 'How it works',
					),
				),
				'submenu'     => esc_html__( 'Choose Header Option', 'stm_post_type' ),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'elementor_builder',
				),
			),
			'top_bar_information_notice'               => array(
				'type'         => 'notice',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
				'description'  => sprintf( 'These settings are available only for <strong>Default Theme Headers</strong>.<br />You can change the builder in Header Builder Section.', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'pear_builder',
					),
					array(
						'key'   => 'header_builder',
						'value' => 'elementor_builder',
					),
				),
				'dependencies' => '||',
			),
			'top_bar'                                  => array(
				'type'       => 'checkbox',
				'label'      => esc_html__( 'Enable Top Bar', 'stm_post_type' ),
				'group'      => 'started',
				'value'      => false,
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_custom_style'                     => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for top bar. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_wide'                             => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Full Width', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_custom_style',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_1||header_style_2||header_style_3||header_style_4||header_style_5||header_style_6||header_style_10||header_style_11||header_style_12',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_bg'                               => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Background Color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_shadow_params'                    => array(
				'type'         => 'spacing',
				'label'        => esc_html__( 'Box Shadow Position', 'stm_post_type' ),
				'units'        => array( 'px' ),
				'value'        => array(
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0',
					'unit'   => 'px',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_shadow_color'                     => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Shadow Color', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_topbar_cart_hide'                      => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Enable WooCommerce Cart', 'stm_post_type' ),
				'description'  => esc_html__( 'You need to install and set up the Woocommerce plugin.', 'stm_post_type' ),
				'group'        => 'started',
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_mobile'                   => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show Cart on Mobile', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_custom_style'             => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for WooCommerce Cart. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_icon_typography'          => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of Cart Icon', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the cart icon', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'color',
					'font-family',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_top_bar_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_color'                    => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Icon Color', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_top_bar_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_icon_color_hover'         => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_top_bar_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_counter_typography'       => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of Cart Counter', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the cart counter', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'color',
					'font-family',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_top_bar_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_counter_color'            => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Counter Color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_top_bar_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_counter_color_hover'      => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Counter Color on Hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_top_bar_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_counter_bg'               => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Counter Background Color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_top_bar_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wc_top_bar_cart_counter_bg_hover'         => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Counter Background Color on Hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_topbar_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_top_bar_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wpml_switcher'                            => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Enable Language Switcher', 'stm_post_type' ),
				'description'  => esc_html__( 'You need the WPML plugin to be installed', 'stm_post_type' ),
				'group'        => 'started',
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wpml_switcher_style'                      => array(
				'type'         => 'radio',
				'label'        => esc_html__( 'Switcher Style', 'stm_post_type' ),
				'description'  => esc_html__( 'Select the style option for the switcher', 'stm_post_type' ),
				'options'      => array(
					'wpml_theme'   => esc_html__( 'Theme', 'stm_post_type' ),
					'wpml_default' => esc_html__( 'WPML', 'stm_post_type' ),
				),
				'value'        => 'wpml_theme',
				'dependency'   => array(
					array(
						'key'   => 'wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wpml_switcher_mobile'                     => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show Language Switcher on Mobile', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wpml_switcher_custom_style'               => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for header. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wpml_switcher_style',
						'value' => 'wpml_theme',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_wpml_switcher_typography'         => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the text', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'color',
					'font-family',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wpml_switcher_style',
						'value' => 'wpml_theme',
					),
					array(
						'key'   => 'wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'wpml_switcher_color'                      => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Text Color', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wpml_switcher_style',
						'value' => 'wpml_theme',
					),
					array(
						'key'   => 'wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_wpml_switcher_bg'                 => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Dropdown Background Color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wpml_switcher_style',
						'value' => 'wpml_theme',
					),
					array(
						'key'   => 'wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_wpml_switcher_bg_hover'           => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Dropdown Background Color on Hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wpml_switcher_style',
						'value' => 'wpml_theme',
					),
					array(
						'key'   => 'wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_wpml_switcher_color_hover'        => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Dropdown Text Color on Hover', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wpml_switcher_style',
						'value' => 'wpml_theme',
					),
					array(
						'key'   => 'wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_search'                           => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Enable Search', 'stm_post_type' ),
				'value'        => false,
				'group'        => 'started',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_search_mobile'                    => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show Search on Mobile', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_search',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_search_custom_style'              => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for Search. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_search',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_search_icon_typography'           => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of Search Icon', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the Search icon', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'font-family',
					'color',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_search',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_search_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_search_color'                     => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Icon Color', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_search',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_search_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_search_icon_color_hover'          => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_search',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_search_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_socials'                          => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Enable Socials', 'stm_post_type' ),
				'value'        => false,
				'group'        => 'started',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_socials_mobile'                   => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show Socials on Mobile', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_socials',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_socials_custom_style'             => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for Social Icons. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_socials',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_socials_typography'               => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Social Icon', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the icons', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'color',
					'font-family',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_socials',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_socials_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_socials_color'                    => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Icon Color', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_socials',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_socials_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_socials_color_on_hover'           => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Icon Color on Hover', 'stm_post_type' ),
				'group'        => 'ended',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar_socials',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar_socials_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'offices_contact_display'                  => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Enable Addresses', 'stm_post_type' ),
				'value'        => false,
				'group'        => 'started',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'offices_contact_mobile'                   => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Enable on mobile', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'offices_contact_custom_style'             => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for header. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'offices_contact_align'                    => array(
				'type'         => 'select',
				'label'        => esc_html__( 'Position', 'stm_post_type' ),
				'description'  => esc_html__( 'Set up the display of the office address, working hours, and phone number', 'stm_post_type' ),
				'options'      => array(
					'flex-end'   => esc_html__( 'Right', 'stm_post_type' ),
					'center'     => esc_html__( 'Center', 'stm_post_type' ),
					'flex-start' => esc_html__( 'Left', 'stm_post_type' ),
				),
				'value'        => 'right',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'offices_contact_typography'               => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of Text', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the text', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'text-transform' => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'color',
					'font-family',
					'text-align',
					'word-spacing',
					'text-transform',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_color'               => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Text Color', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_link_color'          => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Links Color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_link_color_hover'    => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Links Color on Hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_select_bg'           => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Background Color of Selected Office', 'stm_post_type' ),
				'description'  => esc_html__( 'When several offices were added, this option will be applied selected office from the drop-down.', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_select_color'        => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the Text in the Drop-down List', 'stm_post_type' ),
				'description'  => esc_html__( 'When several offices were added, they appear in the drop-down list. The option changes the color of the text and arrow in the list.', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_select_drop_bg'      => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Background Color of Offices Drop-down', 'stm_post_type' ),
				'description'  => esc_html__( 'When several offices were added, they appear in the drop-down list. The option changes the color of the arrow in the list.', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_select_items_bg'     => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Background Color of the Office Item on Hover', 'stm_post_type' ),
				'description'  => esc_html__( 'When several offices were added, they appear in the drop-down list. The option changes the color of the arrow in the list.', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_select_items_color'  => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the Office Item', 'stm_post_type' ),
				'description'  => esc_html__( 'When several offices were added, they appear in the drop-down list. The option changes the color of the arrow in the list.', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'top_bar_contact_info_select_items_hover'  => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the Office Item on Hover', 'stm_post_type' ),
				'description'  => esc_html__( 'When several offices were added, they appear in the drop-down list. The option changes the color of the arrow in the list.', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'offices_contact_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'offices_contact'                          => array(
				'type'         => 'repeater',
				'label'        => esc_html__( 'Office', 'stm_post_type' ),
				'fields'       => array(
					'top_bar_contact_office'       => array(
						'type'  => 'text',
						'label' => esc_html__( 'Name', 'stm_post_type' ),
						'value' => '',
					),
					'top_bar_contact_address'      => array(
						'type'  => 'text',
						'label' => esc_html__( 'Address', 'stm_post_type' ),
						'value' => '',
					),
					'top_bar_contact_address_icon' => array(
						'type'  => 'icon_picker',
						'label' => esc_html__( 'Address Icon', 'stm_post_type' ),
						'value' => 'fa-map-marker',
					),
					'top_bar_contact_email'        => array(
						'type'  => 'text',
						'label' => esc_html__( 'Email', 'stm_post_type' ),
						'value' => '',
					),
					'top_bar_contact_email_icon'   => array(
						'type'  => 'icon_picker',
						'label' => esc_html__( 'Email Icon', 'stm_post_type' ),
						'value' => 'fa-envelope',
					),
					'top_bar_contact_hours'        => array(
						'type'  => 'text',
						'label' => esc_html__( 'Working Hours', 'stm_post_type' ),
						'value' => '',
					),
					'top_bar_contact_hours_icon'   => array(
						'type'  => 'icon_picker',
						'label' => esc_html__( 'Hours Icon', 'stm_post_type' ),
						'value' => 'fa-map-marker',
					),
					'top_bar_contact_phone'        => array(
						'type'  => 'text',
						'label' => esc_html__( 'Phone Number', 'stm_post_type' ),
						'value' => '',
					),
					'top_bar_contact_phone_icon'   => array(
						'type'  => 'icon_picker',
						'label' => esc_html__( 'Phone Icon', 'stm_post_type' ),
						'value' => 'fa-map-marker',
					),
				),
				'group'        => 'ended',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'offices_contact_display',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'top_bar',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Top Bar', 'stm_post_type' ),
			),
			'header_style'                             => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'Header styles', 'stm_post_type' ),
				'type'        => 'image_select',
				'label'       => esc_html__( 'Choose preferred Header style', 'stm_post_type' ),
				'width'       => 270,
				'height'      => 500,
				'options'     => array(
					'header_style_1'  => array(
						'alt' => 'Header Style 1',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_01.svg',
					),
					'header_style_2'  => array(
						'alt' => 'Header Style 2',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_02.svg',
					),
					'header_style_3'  => array(
						'alt' => 'Header Style 3',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_03.svg',
					),
					'header_style_4'  => array(
						'alt' => 'Header Style 4',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_04.svg',
					),
					'header_style_5'  => array(
						'alt' => 'Header Style 5',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_05.svg',
					),
					'header_style_6'  => array(
						'alt' => 'Header Style 6',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_06.svg',
					),
					'header_style_10' => array(
						'alt' => 'Header Style 7',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_07.svg',
					),
					'header_style_11' => array(
						'alt' => 'Header Style 8',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_08.svg',
					),
					'header_style_12' => array(
						'alt' => 'Header Style 9',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_09.svg',
					),
					'header_style_7'  => array(
						'alt' => 'Header Style 10',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_10.svg',
					),
					'header_style_8'  => array(
						'alt' => 'Header Style 11',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_11.svg',
					),
					'header_style_9'  => array(
						'alt' => 'Header Style 12',
						'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/headers/style_12.svg',
					),
				),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_custom_style'                      => array(
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Header Customization', 'stm_post_type' ),
				'description' => esc_html__( 'This option shows additional settings for header. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'       => false,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_bg'                                => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Header Background', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_shadow'                            => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Header Shadow', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'sticky_menu'                              => array(
				'group'        => 'started',
				'group_title'  => esc_html__( 'HEADER POSITIONING', 'stm_post_type' ),
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Sticky Header', 'stm_post_type' ),
				'description'  => esc_html__( 'When this option is enabled, the header will be positioned above the blocks and always stay on top of the screen when scrolling', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_1||header_style_2||header_style_3||header_style_4||header_style_5||header_style_6||header_style_10||header_style_11||header_style_12',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'sticky_menu_height'                       => array(
				'type'         => 'text',
				'label'        => esc_html__( 'Minimum sticky header height (in pixels)', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'sticky_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wide'                              => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Full width', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_1||header_style_2||header_style_3||header_style_4||header_style_5||header_style_6||header_style_10||header_style_11||header_style_12',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_height'                            => array(
				'type'         => 'text',
				'label'        => esc_html__( 'Minimum header height (in pixels)', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_1||header_style_2||header_style_3||header_style_4||header_style_5||header_style_6||header_style_10||header_style_11||header_style_12',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_inverse'                           => array(
				'label'       => esc_html__( 'Style - Inverse', 'stm_post_type' ),
				'type'        => 'checkbox',
				'description' => esc_html__( 'This option swappers logo and dark logo.', 'stm_post_type' ),
				'value'       => function_exists( 'consulting_theme_option' ) ? (bool) consulting_theme_option( 'metabox_header_inverse', false ) : false,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'metabox_enable_header_transparent'        => array(
				'group'        => 'ended',
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Transparent Header', 'stm_post_type' ),
				'description'  => esc_html__( 'When this option is enabled, the header will be positioned absolutely above the blocks', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_1||header_style_2||header_style_3||header_style_4||header_style_5||header_style_6||header_style_10||header_style_11||header_style_12',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_hide'                             => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'WOOCOMMERCE CART', 'stm_post_type' ),
				'type'        => 'checkbox',
				'label'       => esc_html__( 'WooCommerce Cart', 'stm_post_type' ),
				'description' => esc_html__( 'You need to install and set up the Woocommerce plugin.', 'stm_post_type' ),
				'value'       => false,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_mobile_hide'                      => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
				'description'  => esc_html__( 'Enable the display of cart on mobile', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_cart_hide',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_custom_style'                     => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for WooCommerce Cart. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_cart_hide',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_icon_typography'                  => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Cart Icon', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the cart icon', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'font-family',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_icon_color_hover'                 => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Icon color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_counter_typography'               => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of cart counter', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the cart counter', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'font-family',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_counter_color_hover'              => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Counter color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_counter_bg'                       => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Counter background color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'wc_cart_counter_bg_hover'                 => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Counter background color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'wc_cart_hide',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'wc_cart_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wpml_switcher'                     => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'WPML MULTI-LANGUAGE', 'stm_post_type' ),
				'type'        => 'checkbox',
				'label'       => esc_html__( 'WPML switcher', 'stm_post_type' ),
				'description' => esc_html__( 'You need to install and set up the WPML plugin.', 'stm_post_type' ),
				'value'       => false,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wpml_switcher_style'               => array(
				'type'         => 'radio',
				'label'        => esc_html__( 'Switcher Style', 'stm_post_type' ),
				'description'  => esc_html__( 'Select the style option for the switcher', 'stm_post_type' ),
				'options'      => array(
					'wpml_theme'   => esc_html__( 'Theme', 'stm_post_type' ),
					'wpml_default' => esc_html__( 'WPML', 'stm_post_type' ),
				),
				'value'        => 'wpml_theme',
				'dependency'   => array(
					array(
						'key'   => 'header_wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wpml_switcher_mobile'              => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
				'description'  => esc_html__( 'Enable the display of WPML on mobile', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_wpml_switcher',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wpml_switcher_custom_style'        => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for WPML Language switcher. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher_style',
						'value' => 'wpml_theme',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wpml_switcher_typography'          => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the text', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'font-family',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher_style',
						'value' => 'wpml_theme',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wpml_switcher_bg'                  => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Dropdown background color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher_style',
						'value' => 'wpml_theme',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wpml_switcher_bg_hover'            => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Dropdown background color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher_style',
						'value' => 'wpml_theme',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_wpml_switcher_color_hover'         => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Dropdown text color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_wpml_switcher_custom_style',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_wpml_switcher_style',
						'value' => 'wpml_theme',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_socials_box'                       => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'STYLES OF SOCIAL ICONS', 'stm_post_type' ),
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Enable Socials', 'stm_post_type' ),
				'value'       => false,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'mobile_socials_show_hide'                 => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
				'description'  => esc_html__( 'Enable the display of socials on mobile', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_socials_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_socials_custom_style'              => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for Social Icons. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_socials_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_socials_typography'                => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Social Icon', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the icons', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'font-family',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_socials_box',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_socials_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_socials_color_hover'               => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Icon color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_socials_box',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_socials_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_search_box'                        => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'SEARCH SETTINGS', 'stm_post_type' ),
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Enable Search', 'stm_post_type' ),
				'value'       => false,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'mobile_header_search_box'                 => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
				'description'  => esc_html__( 'Enable the display of search on mobile', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_search_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_search_custom_style'               => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for Search. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_search_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_search_icon_typography'            => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of Search icon', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the Search icon', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'font-family',
					'color',
					'text-transform',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_search_box',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_search_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_search_icon_color'                 => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Search Icon', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_search_box',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_search_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_search_icon_color_hover'           => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Icon color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_search_box',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_search_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'mobile_grid'                              => array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Mobile Header Breakpoint', 'stm_post_type' ),
				'description' => esc_html__( 'Select the mobile header breakpoint (Landscape - 1024px resolution, Portrait 991px resolution).', 'stm_post_type' ),
				'options'     => array(
					'landscape' => esc_html__( 'Tablet Landscape', 'stm_post_type' ),
					'portrait'  => esc_html__( 'Tablet Portrait', 'stm_post_type' ),
				),
				'value'       => 'landscape',
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_builders_information_notice'       => array(
				'description'  => sprintf( 'These settings are available only for <strong>Default Theme Headers</strong>.<br />You can change the builder in Header Builder Section.', 'stm_post_type' ),
				'type'         => 'notice',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'pear_builder',
					),
					array(
						'key'   => 'header_builder',
						'value' => 'elementor_builder',
					),
				),
				'dependencies' => '||',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_information_box'                   => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'Styles of Contact information', 'stm_post_type' ),
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Enable Contact information', 'stm_post_type' ),
				'value'       => true,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'mobile_header_information_box'            => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
				'description'  => esc_html__( 'Enable the display of information on mobile', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_address'                           => array(
				'type'         => 'textarea',
				'label'        => esc_html__( 'Address', 'stm_post_type' ),
				'description'  => esc_html__( 'The editor supports HTML tags which are useful for structuring and creating content.', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_address_icon'                      => array(
				'type'         => 'icon_picker',
				'label'        => esc_html__( 'Address Icon', 'stm_post_type' ),
				'value'        => 'stm-pin_13',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_working_hours'                     => array(
				'type'         => 'textarea',
				'label'        => esc_html__( 'Working Hours', 'stm_post_type' ),
				'description'  => esc_html__( 'The editor supports HTML tags which are useful for structuring and creating content.', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_working_hours_icon'                => array(
				'type'         => 'icon_picker',
				'label'        => esc_html__( 'Working Hours Icon', 'stm_post_type' ),
				'value'        => 'stm-mail_13',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_phone'                             => array(
				'type'         => 'textarea',
				'label'        => esc_html__( 'Phone number', 'stm_post_type' ),
				'description'  => esc_html__( 'The editor supports HTML tags which are useful for structuring and creating content.', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_phone_icon'                        => array(
				'type'         => 'icon_picker',
				'label'        => esc_html__( 'Phone number Icon', 'stm_post_type' ),
				'value'        => 'stm-phone_13',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_contact_info_typography'           => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of text', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the text', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'text-transform' => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'font-family',
					'text-align',
					'word-spacing',
					'text-transform',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_contact_info_link_color'           => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Links color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_contact_info_link_color_hover'     => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Links color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_information_box',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button'                            => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'BUTTON (CALL TO ACTION)', 'stm_post_type' ),
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Button', 'stm_post_type' ),
				'description' => esc_html__( 'This option shows or hides the call to action button on the header', 'stm_post_type' ),
				'value'       => false,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_link_text'                  => array(
				'type'         => 'text',
				'label'        => esc_html__( 'Button text', 'stm_post_type' ),
				'value'        => esc_html__( 'Enter button text', 'stm_post_type' ),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_link_url'                   => array(
				'type'         => 'text',
				'label'        => esc_html__( 'Button Link', 'stm_post_type' ),
				'value'        => '#',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_link_target'                => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Open in new window', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_link_follow'                => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Link Follow', 'stm_post_type' ),
				'description'  => esc_html__( 'The option prohibits indexing links by search engine bots', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_icon'                       => array(
				'type'         => 'icon_picker',
				'label'        => esc_html__( 'Address Icon', 'stm_post_type' ),
				'value'        => 'fa-map-marker',
				'excluded'     => array(
					'color',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_custom_style'               => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Additional Customization', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows additional settings for Call to Action button. When the option is disabled after making changes, settings will still be applied.', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_border_radius'              => array(
				'type'         => 'spacing',
				'label'        => esc_html__( 'Border Radius', 'stm_post_type' ),
				'units'        => array( 'px' ),
				'value'        => array(
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => 'px',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_button_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_typography'                 => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the Call to Action button', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '14',
					'text-transform' => 'uppercase',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'font-family',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_button_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_color_hover'                => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Hover color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_button_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_bg'                         => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Background color', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_button_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_bg_hover'                   => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Background color on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_button_custom_style',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_mobile'                     => array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Show on mobile', 'stm_post_type' ),
				'description'  => esc_html__( 'This option shows or hides the call to action button on mobile', 'stm_post_type' ),
				'value'        => false,
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_button_mobile_typography'          => array(
				'group'        => 'ended',
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography for mobile view', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of text on mobile view', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'text-transform' => 'uppercase',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'     => array(
					'color',
					'font-family',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_button',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_button_mobile',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_copyright'                         => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Copyright', 'stm_post_type' ),
				'value'       => '',
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'description' => sprintf( 'This option can be enabled for the specific header style. <a href="https://docs.stylemixthemes.com/consulting-theme-documentation/theme-options/header#copyright" target="_blank" rel="nofollow">' . esc_html__( 'See more details ', 'stm_post_type' ) . '</a>' ),
				'submenu'     => esc_html__( 'Main', 'stm_post_type' ),
			),
			'header_nav_menu_typography'               => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'STYLES OF MAIN MENU ', 'stm_post_type' ),
				'type'        => 'typography',
				'label'       => esc_html__( 'Typography of Menu', 'stm_post_type' ),
				'description' => esc_html__( 'These options are for customizing the appearance of the links', 'stm_post_type' ),
				'output'      => '',
				'value'       => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
					'backup-font'    => '',
				),
				'excluded'    => array(
					'font-family',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_link_color_hover'         => array(
				'type'       => 'color',
				'label'      => esc_html__( 'Color of the links on hover', 'stm_post_type' ),
				'value'      => '',
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_link_color_active'        => array(
				'type'       => 'color',
				'label'      => esc_html__( 'Color of active link', 'stm_post_type' ),
				'value'      => '',
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_link_arrow_color'         => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the arrow', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_4||header_style_5||header_style_6||header_style_7||header_style_8||header_style_9||header_style_10||header_style_11',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_link_arrow_color_hover'   => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the arrow on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_4||header_style_5||header_style_6||header_style_7||header_style_8||header_style_9||header_style_10||header_style_11',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_1_bg'               => array(
				'group'        => 'started',
				'group_title'  => esc_html__( 'STYLES OF FIRST-LEVEL SUB-MENU', 'stm_post_type' ),
				'type'         => 'color',
				'label'        => esc_html__( 'Background', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_1||header_style_2||header_style_3||header_style_4||header_style_5||header_style_6||header_style_10||header_style_11||header_style_12',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_1_typography'       => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Typography of Menu', 'stm_post_type' ),
				'description' => esc_html__( 'These options are for customizing the appearance of the links', 'stm_post_type' ),
				'output'      => '',
				'value'       => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'backup-font'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
				),
				'excluded'    => array(
					'font-family',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_1_link_color_hover' => array(
				'type'       => 'color',
				'label'      => esc_html__( 'Color of the links on hover', 'stm_post_type' ),
				'value'      => '',
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_1_link_bg_hover'    => array(
				'type'       => 'color',
				'label'      => esc_html__( 'Background Color of the links on hover', 'stm_post_type' ),
				'value'      => '',
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_1_link_arrow_color' => array(
				'type'       => 'color',
				'label'      => esc_html__( 'Color of the arrow', 'stm_post_type' ),
				'value'      => '',
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_1_link_arrow_color_hover' => array(
				'group'      => 'ended',
				'type'       => 'color',
				'label'      => esc_html__( 'Color of the arrow on hover', 'stm_post_type' ),
				'value'      => '',
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_2_bg'               => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'STYLES OF SECOND-LEVEL SUB-MENU', 'stm_post_type' ),
				'type'        => 'color',
				'label'       => esc_html__( 'Background', 'stm_post_type' ),
				'value'       => '',
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_2_typography'       => array(
				'type'        => 'typography',
				'label'       => esc_html__( 'Typography of Menu', 'stm_post_type' ),
				'description' => esc_html__( 'These options are for customizing the appearance of the links', 'stm_post_type' ),
				'output'      => '',
				'value'       => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'backup-font'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
				),
				'excluded'    => array(
					'font-family',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_2_link_color_hover' => array(
				'type'       => 'color',
				'label'      => esc_html__( 'Color of the links on hover', 'stm_post_type' ),
				'value'      => '',
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_nav_menu_level_2_link_bg_hover'    => array(
				'group'      => 'ended',
				'type'       => 'color',
				'label'      => esc_html__( 'Background Color of the links on hover', 'stm_post_type' ),
				'value'      => '',
				'dependency' => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'    => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'mega_menu'                                => array(
				'group'       => 'started',
				'group_title' => esc_html__( 'STYLES OF MEGA MENU ', 'stm_post_type' ),
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Mega Menu', 'stm_post_type' ),
				'description' => esc_html__( 'Enable the display of mega menu', 'stm_post_type' ),
				'value'       => false,
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_bg'                      => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Background', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
					array(
						'key'   => 'header_style',
						'value' => 'header_style_1||header_style_2||header_style_3||header_style_4||header_style_5||header_style_6||header_style_10||header_style_11||header_style_12',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_title_typography'        => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of Headings', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the Headings', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'backup-font'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
				),
				'excluded'     => array(
					'font-family',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_title_color_hover'       => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of Headings on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_description_color'       => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the descriptions', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_description_link_color'  => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the links in descriptions', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_description_link_color_hover' => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the links in descriptions on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_link_typography'         => array(
				'type'         => 'typography',
				'label'        => esc_html__( 'Typography of Menu', 'stm_post_type' ),
				'description'  => esc_html__( 'These options are for customizing the appearance of the links', 'stm_post_type' ),
				'output'       => '',
				'value'        => array(
					'color'          => '',
					'font-size'      => '',
					'font-weight'    => '',
					'line-height'    => '',
					'font-family'    => '',
					'backup-font'    => '',
					'text-align'     => '',
					'word-spacing'   => '',
					'letter-spacing' => '',
					'subset'         => '',
					'font-data'      => '',
				),
				'excluded'     => array(
					'font-family',
					'text-align',
					'word-spacing',
					'letter-spacing',
					'subset',
					'font-data',
					'backup-font',
				),
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_color_hover'             => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the links on hover', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_border_color'            => array(
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the dividers', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_mega_menu_icons_color'             => array(
				'group'        => 'ended',
				'type'         => 'color',
				'label'        => esc_html__( 'Color of the icons', 'stm_post_type' ),
				'value'        => '',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'theme_builder',
					),
					array(
						'key'   => 'mega_menu',
						'value' => 'not_empty',
					),
				),
				'dependencies' => '&&',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'header_menu_information_notice'           => array(
				'description'  => sprintf( 'These settings are available only for <strong>Default Theme Headers</strong>.<br />You can change the builder in Header Builder Section.', 'stm_post_type' ),
				'type'         => 'notice',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'pear_builder',
					),
					array(
						'key'   => 'header_builder',
						'value' => 'elementor_builder',
					),
				),
				'dependencies' => '||',
				'submenu'      => esc_html__( 'Menu', 'stm_post_type' ),
			),
			'socials_information_notice'               => array(
				'description'  => sprintf( 'These settings are available only for <strong>Default Theme Headers</strong>.<br />You can change the builder in Header Builder Section.', 'stm_post_type' ),
				'type'         => 'notice',
				'dependency'   => array(
					array(
						'key'   => 'header_builder',
						'value' => 'pear_builder',
					),
					array(
						'key'   => 'header_builder',
						'value' => 'elementor_builder',
					),
				),
				'dependencies' => '||',
				'submenu'      => esc_html__( 'Socials', 'stm_post_type' ),
			),
			'header_socials_information_notice'        => array(
				'description' => esc_html__( 'The social networks buttons will be displayed only if the links to these social networks are provided in the Socials tab', 'stm_post_type' ),
				'type'        => 'notice',
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Socials', 'stm_post_type' ),
			),
			'header_socials'                           => array(
				'type'        => 'multi_checkbox',
				'label'       => esc_html__( 'Socials Links', 'stm_post_type' ),
				'description' => esc_html__( 'Select what social networks to display', 'stm_post_type' ),
				'options'     => consulting_socials(),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'theme_builder',
				),
				'submenu'     => esc_html__( 'Socials', 'stm_post_type' ),
			),
		);

		if ( defined( 'STM_HB_VER' ) ) {
			$fields[ 'pearl_plugin_information_notice' ] = array(// phpcs:ignore
				'type'        => 'notification_message',
				'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/pearl_hb.png',
				'description' => sprintf(
					'
					<h1>WordPress Header Builder Plugin – Pearl</h1>
					<p>We are deprecating support for Pearl Header Builder plugin.  When different Header Builder selected, you will not be able to use it again and it will be disabled.</p>
					'
				),
				'buttons'     => array(
					array(
						'url'  => admin_url( 'admin.php?page=stm_header_builder&hb=stm_hb_settings' ),
						'text' => 'Open header Builder',
					),
					array(
						'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header-builder/pearl-header-builder',
						'text' => 'How it works',
					),
				),
				'submenu'     => esc_html__( 'Choose Header Option', 'stm_post_type' ),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'pear_builder',
				),
			);
		}

		if ( defined( 'HFE_VER' ) ) {
			$fields[ 'ehf_plugin_active_information_notice' ] = array(// phpcs:ignore
				'type'        => 'notification_message',
				'image'       => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/notice/ehf.svg',
				'description' => sprintf(
					'
					<h1>Elementor Header & Footer Builder</h1>
					<p>The installation and activation of the <strong>Elementor Header & Footer Builder</strong> and <strong>Elementor</strong> plugins required. You can manage and customize headers in the Appearance > Elementor Header & Footer Builder section.</p>
					'
				),
				'buttons'     => array(
					array(
						'url'  => admin_url( 'edit.php?post_type=elementor-hf' ),
						'text' => 'Open header Builder',
					),
					array(
						'url'  => 'https://docs.stylemixthemes.com/consulting-theme-documentation/blocks-and-sidebars/header-builder/elementor-header-builder',
						'text' => 'How it works',
					),
				),
				'submenu'     => esc_html__( 'Choose Header Option', 'stm_post_type' ),
				'dependency'  => array(
					'key'   => 'header_builder',
					'value' => 'elementor_builder',
				),
			);
		}

		$custom_fields = array(
			'name'   => esc_html__( 'Header', 'stm_post_type' ),
			'icon'   => 'fas fa-ellipsis-v',
			'fields' => $fields,
		);

		$setups[ 'header' ] = $custom_fields;// phpcs:ignore

		return $setups;

	},
	10,
	1
);
