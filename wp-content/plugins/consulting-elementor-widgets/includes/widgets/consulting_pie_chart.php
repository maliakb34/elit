<?php

use Elementor\Controls_Manager;

class Elementor_STM_Pie_Chart extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_pie_chart';
	}

	public function get_title() {
		return esc_html__( 'Consulting Pie chart', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-pie-chart';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'plugin-name' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'box_style',
			array(
				'label'   => __( 'Pie chart style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' ) => 'style_2',
					)
				),
			)
		);

		$this->add_control(
			'widget_width',
			array(
				'label' => __( 'Width', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'value',
			array(
				'label' => __( 'Value', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'label_value',
			array(
				'label' => __( 'Value Label', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'title',
			array(
				'label' => __( 'Title', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'units',
			array(
				'label' => __( 'Units', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'custom_color',
			array(
				'label'     => __( 'Custom Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .radial-progress .circle .mask .fill' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'content_alignment',
			array(
				'label'     => __( 'Content Alignment', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
				),

			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			consulting_load_vc_element( 'stm_pie_chart', $settings, $settings['box_style'] );

		}
	}
}
