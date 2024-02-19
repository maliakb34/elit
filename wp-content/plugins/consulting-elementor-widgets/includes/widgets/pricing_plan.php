<?php

use Elementor\Controls_Manager;

class Elementor_STM_Pricing_Plan extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_pricing_plan';
	}

	public function get_title() {
		return esc_html__( 'Pricing Plan', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-cash';
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
			'style',
			array(
				'label'   => __( 'Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' ) => 'style_2',
						esc_html__( 'Style 3', 'consulting-elementor-widgets' ) => 'style_3',
						esc_html__( 'Style 4', 'consulting-elementor-widgets' ) => 'style_4',
					)
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label' => __( 'Plan pattern image', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'title',
			array(
				'label' => __( 'Plan Title', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Sample Title', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'price',
			array(
				'label' => __( 'Plan price', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => '99',
			)
		);

		$this->add_control(
			'price_affix',
			array(
				'label' => __( 'Plan price affix', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => '$',
			)
		);

		$this->add_control(
			'price_suffix',
			array(
				'label'     => __( 'Plan price suffix', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'style' => array(
						'style_2',
					),
				),
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label' => __( 'Plan subtitle', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'per month', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'label',
			array(
				'label' => __( 'Plan label', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Badge', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label' => __( 'Plan description', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::WYSIWYG,
			)
		);

		$this->add_control(
			'link_title',
			array(
				'label'   => __( 'Link Title', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Get now', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'         => __( 'Link URL', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_pricing_plan' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_pricing_plan';

			$settings['image']         = $settings['image']['id'];
			$settings['link']['title'] = $settings['link_title'];

			consulting_load_vc_element( 'pricing_plan', $settings, $settings['style'] );

		}
	}
}
