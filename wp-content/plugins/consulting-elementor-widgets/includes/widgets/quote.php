<?php

use Elementor\Controls_Manager;

class Elementor_STM_Quote extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_quote';
	}

	public function get_title() {
		return esc_html__( 'Quote', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-quote';
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
			'content_section',
			array(
				'label' => __( 'Content', 'plugin-name' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'quote',
			array(
				'label' => __( 'Quote', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
				'rows'  => 5,
			)
		);

		$this->add_control(
			'image',
			array(
				'label' => __( 'Author Image', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'author_name',
			array(
				'label' => __( 'Author name', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'author_status',
			array(
				'label' => __( 'Author status', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'box_color',
			array(
				'label'   => __( 'Box Color', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'base',
				'options' => array_flip(
					array(
						esc_html__( 'Base', 'consulting-elementor-widgets' ) => 'base',
						esc_html__( 'Secondary', 'consulting-elementor-widgets' ) => 'secondary',
						esc_html__( 'Third', 'consulting-elementor-widgets' ) => 'third',
						esc_html__( 'Custom', 'consulting-elementor-widgets' ) => 'custom',
					)
				),
			)
		);

		$this->add_control(
			'box_color_custom',
			array(
				'label'     => __( 'Title - Color Custom', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'box_color' => 'custom',
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_quote' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_quote';

			$settings['image'] = $settings['image']['id'];

			consulting_show_template( 'quote', $settings );

		}
	}
}
