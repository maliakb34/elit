<?php

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Elementor_STM_Cost_Calculator extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_cost_calculator';
	}

	public function get_title() {
		return esc_html__( 'Cost Calculator', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-calculator';
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
			'calculator',
			array(
				'label'   => __( 'Select calculator', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => Consulting_Elementor_Widgets::get_post_type(
					array(
						'post_type'     => 'cost-calc',
						'post_per_page' => -1,
					)
				),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Widget Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => esc_html__( 'Default style', 'consulting-elementor-widgets' ),
					'style_2' => esc_html__( 'Theme style', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.stm_cost_calculator' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_cost_calculator';

			if ( ! empty( $_GET['action'] ) && 'elementor' === $_GET['action'] ) {
				echo wp_kses_post( '<div></div>' );
			} else {
				consulting_show_template( 'cost_calculator', $settings );
			}
		}
	}

	protected function content_template() {
		echo wp_kses_post( '<div></div>' );
	}
}
