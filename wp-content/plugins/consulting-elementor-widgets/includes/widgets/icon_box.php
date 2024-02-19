<?php

use Elementor\Controls_Manager;

class Elementor_STM_Icon_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_icon_box';
	}

	public function get_title() {
		return esc_html__( 'Icon Box', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-iconbox';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function add_dimensions( $selector = '' ) {
		$this->start_controls_section(
			'section_dimensions',
			array(
				'label' => __( 'Dimensions', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'margin',
			array(
				'label'      => __( 'Margin', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"{{WRAPPER}} {$selector}" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					"{{WRAPPER}} {$selector}" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'box_style',
			array(
				'label'   => __( 'Icon box style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' )  => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' )  => 'style_2',
						esc_html__( 'Style 3', 'consulting-elementor-widgets' )  => 'style_3',
						esc_html__( 'Style 4', 'consulting-elementor-widgets' )  => 'style_4',
						esc_html__( 'Style 5', 'consulting-elementor-widgets' )  => 'style_5',
						esc_html__( 'Style 6', 'consulting-elementor-widgets' )  => 'style_6',
						esc_html__( 'Style 7', 'consulting-elementor-widgets' )  => 'style_7',
						esc_html__( 'Style 8', 'consulting-elementor-widgets' )  => 'style_8',
						esc_html__( 'Style 9', 'consulting-elementor-widgets' )  => 'style_9',
						esc_html__( 'Style 10', 'consulting-elementor-widgets' ) => 'style_10',
					)
				),
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'     => __( 'Alignment', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array_flip(
					array(
						esc_html__( 'Left', 'consulting-elementor-widgets' )   => 'left',
						esc_html__( 'Right', 'consulting-elementor-widgets' )  => 'right',
						esc_html__( 'Center', 'consulting-elementor-widgets' ) => 'center',
					)
				),
				'condition' => array(
					'box_style' => array( 'style_2', 'style_4', 'style_5', 'style_6', 'style_10' ),
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'     => __( 'Title', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'condition' => array(
					'box_style' => array(
						'style_1',
						'style_2',
						'style_4',
						'style_5',
						'style_6',
						'style_7',
						'style_8',
						'style_9',
						'style_10',
					),
				),
			)
		);

		$this->add_control(
			'title_font_size',
			array(
				'label'     => __( 'Title font-size', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'box_style' => array( 'style_1', 'style_2', 'style_5', 'style_6', 'style_10' ),
				),
			)
		);

		$this->add_control(
			'title_line_height',
			array(
				'label'     => __( 'Title line-height', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'box_style' => array( 'style_1', 'style_2', 'style_5', 'style_6', 'style_10' ),
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'   => __( 'Title color', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'base',
				'options' => array_flip(
					array(
						esc_html__( 'Base', 'consulting-elementor-widgets' )      => 'base',
						esc_html__( 'Secondary', 'consulting-elementor-widgets' ) => 'secondary',
						esc_html__( 'Third', 'consulting-elementor-widgets' )     => 'third',
						esc_html__( 'Custom', 'consulting-elementor-widgets' )    => 'custom',
					)
				),
			)
		);

		$this->add_control(
			'title_color_custom',
			array(
				'label'     => __( 'Title Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'title_color' => array( 'custom' ),
				),
			)
		);

		$this->add_control(
			'hide_title_line',
			array(
				'label'        => __( 'Hide Title Line', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'hide_title_line',
				'condition'    => array(
					'box_style' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$this->add_control(
			'enable_hexagon',
			array(
				'label'        => __( 'Enable hexagon', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'enable',
				'condition'    => array(
					'box_style' => array( 'style_1' ),
				),
			)
		);

		$this->add_control(
			'enable_hexagon_animation',
			array(
				'label'        => __( 'Enable Hexagon Hover Animation', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'enable',
				'condition'    => array(
					'box_style' => array( 'style_1' ),
				),
			)
		);

		$this->add_control(
			'v_align_middle',
			array(
				'label'        => __( 'Vertical Middle Align', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'enable',
				'condition'    => array(
					'box_style' => array( 'style_1' ),
				),
			)
		);

		$this->add_control(
			'add_link',
			array(
				'label'        => __( 'Add link', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'enable',
			)
		);

		$this->add_control(
			'link',
			array(
				'label'         => __( 'Link', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'condition'     => array(
					'add_link' => 'enable',
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'                  => __( 'Icon', 'text-domain' ),
				'type'                   => \Elementor\Controls_Manager::ICONS,
				'default'                => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
				'skin'                   => 'inline',
				'exclude_inline_options' => array( 'svg' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'     => __( 'Icon - Position', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'base',
				'options'   => array_flip(
					array(
						esc_html__( 'Icon Top', 'consulting-elementor-widgets' )              => 'icon_top',
						esc_html__( 'Icon Top Transparent', 'consulting-elementor-widgets' )  => 'icon_top_transparent',
						esc_html__( 'Icon Left', 'consulting-elementor-widgets' )             => 'icon_left',
						esc_html__( 'Icon Left Transparent', 'consulting-elementor-widgets' ) => 'icon_left_transparent',
					)
				),
				'condition' => array(
					'box_style' => array( 'style_1' ),
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'   => __( 'Icon Size', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 25,
			)
		);

		$this->add_control(
			'icon_line_height',
			array(
				'label'     => __( 'Icon Line height', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 65,
				'condition' => array(
					'box_style' => array( 'style_3', 'style_4' ),
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'   => __( 'Icon - Color', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array_flip(
					array(
						esc_html__( 'Default', 'consulting-elementor-widgets' )   => 'default',
						esc_html__( 'Base', 'consulting-elementor-widgets' )      => 'base',
						esc_html__( 'Secondary', 'consulting-elementor-widgets' ) => 'secondary',
						esc_html__( 'Third', 'consulting-elementor-widgets' )     => 'third',
						esc_html__( 'Custom', 'consulting-elementor-widgets' )    => 'custom',
					)
				),
			)
		);

		$this->add_control(
			'icon_color_custom',
			array(
				'label'     => __( 'Icon - Color Custom', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'icon_color' => array( 'custom' ),
				),
			)
		);

		$this->add_control(
			'icon_bg_color',
			array(
				'label'     => __( 'Icon - Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'base_bg',
				'options'   => array_flip(
					array(
						esc_html__( 'Base', 'consulting-elementor-widgets' )      => 'base_bg',
						esc_html__( 'Secondary', 'consulting-elementor-widgets' ) => 'secondary_bg',
						esc_html__( 'Third', 'consulting-elementor-widgets' )     => 'third_bg',
						esc_html__( 'Custom', 'consulting-elementor-widgets' )    => 'custom',
					)
				),
				'condition' => array(
					'box_style' => array( 'style_1' ),
				),
			)
		);

		$this->add_control(
			'icon_bg_color_custom',
			array(
				'label'     => __( 'Icon - Background Color Custom', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'icon_bg_color' => array( 'custom' ),
				),
			)
		);

		$this->add_control(
			'icon_border_color',
			array(
				'label'     => __( 'Icon - Border Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'base_bg',
				'options'   => array_flip(
					array(
						esc_html__( 'Base', 'consulting-elementor-widgets' )      => 'base_bg',
						esc_html__( 'Secondary', 'consulting-elementor-widgets' ) => 'secondary_bg',
						esc_html__( 'Third', 'consulting-elementor-widgets' )     => 'third_bg',
						esc_html__( 'Custom', 'consulting-elementor-widgets' )    => 'custom',
					)
				),
				'condition' => array(
					'box_style' => array( 'style_3' ),
				),
			)
		);

		$this->add_control(
			'icon_border_color_custom',
			array(
				'label'     => __( 'Icon - Border Custom', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'title_color' => array( 'custom' ),
				),
			)
		);

		$this->add_control(
			'icon_height',
			array(
				'label'     => __( 'Icon height', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 65,
				'condition' => array(
					'style' => array( 'icon_top', 'icon_top_transparent' ),
				),
			)
		);

		$this->add_control(
			'icon_width',
			array(
				'label'     => __( 'Icon width', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 50,
				'condition' => array(
					'style' => array( 'icon_left', 'icon_left_transparent' ),
				),
			)
		);

		$this->add_control(
			'icon_width_wr',
			array(
				'label'     => __( 'Icon Wrapper Width', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 65,
				'condition' => array(
					'box_style' => array( 'style_2' ),
				),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'     => __( 'Content', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG,
				'condition' => array(
					'box_style' => array(
						'style_1',
						'style_3',
						'style_4',
						'style_5',
						'style_6',
						'style_7',
						'style_8',
						'style_9',
						'style_10',
					),
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.event-members-box-table' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' elementor-consulting-icon-box';
			$settings['icon']      = $settings['icon']['value'];

			if ( isset( $settings['link']['target'] ) ) {
				$settings['link']['target'] = 'on' === $settings['link']['is_external'] ? '_blank' : '_self';
			}

			if ( ! empty( $settings['content'] ) ) {
				$settings['content'] = wpautop( $settings['content'] );
			}
			if ( ! empty( $settings['title'] ) ) {
				$settings['title'] = wpautop( $settings['title'] );
			}

			consulting_load_vc_element( 'icon_box', $settings, $settings['box_style'] );

		}
	}
}
