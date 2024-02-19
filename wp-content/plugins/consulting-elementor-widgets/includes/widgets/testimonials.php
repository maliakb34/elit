<?php

use Elementor\Controls_Manager;

class Elementor_STM_Testimonials extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_testimonials';
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-testimonial';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'owl.carousel' );
	}

	public function get_style_depends() {
		return array( 'owl.carousel' );
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

		$testimonial_categories_array = get_terms( 'stm_testimonials_category' );
		$testimonial_categories       = array(
			esc_html__( 'All', 'consulting-elementor-widgets' ) => 'all',
		);
		if ( $testimonial_categories_array && ! is_wp_error( $testimonial_categories_array ) ) {
			foreach ( $testimonial_categories_array as $cat ) {
				$testimonial_categories[ $cat->name ] = $cat->slug;
			}
		}

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		Consulting_Elementor_Widgets::add_text_field(
			$this,
			'count',
			esc_html__( 'Count', 'consulting-elementor-widgets' ),
			1
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' ) => 'style_2',
						esc_html__( 'Style 3', 'consulting-elementor-widgets' ) => 'style_3',
						esc_html__( 'Style 4', 'consulting-elementor-widgets' ) => 'style_4',
						esc_html__( 'Style 5', 'consulting-elementor-widgets' ) => 'style_5',
						esc_html__( 'Style 6', 'consulting-elementor-widgets' ) => 'style_6',
						esc_html__( 'Style 7', 'consulting-elementor-widgets' ) => 'style_7',
					)
				),
			)
		);

		$this->add_control(
			'per_row',
			array(
				'label'     => __( 'Testimonials Per Row', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT2,
				'options'   => array(
					1 => 1,
					2 => 2,
					3 => 3,
				),
				'condition' => array(
					'style' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$this->add_control(
			'category',
			array(
				'label'   => __( 'Category', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'options' => array_flip( $testimonial_categories ),
			)
		);

		$this->add_control(
			'navigation_type',
			array(
				'label'     => __( 'Navigation', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT2,
				'default'   => 'arrows',
				'options'   => array_flip(
					array(
						esc_html__( 'Arrows', 'consulting-elementor-widgets' ) => 'arrows',
						esc_html__( 'Bullets', 'consulting-elementor-widgets' ) => 'bullets',
					)
				),
				'condition' => array(
					'style' => array( 'style_3', 'style_4', 'style_5' ),
				),
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'        => __( 'Slider Autoplay', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'  => esc_html__( 'Enable autoplay mode.', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'timeout',
			array(
				'label'       => __( 'Autoplay Timeout', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 5000,
				'description' => esc_html__( 'Autoplay interval timeout (in ms).', 'consulting-elementor-widgets' ),
				'condition'   => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'        => __( 'Slider Loop', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'  => esc_html__( 'Enable slider loop mode.', 'consulting-elementor-widgets' ),
				'condition'    => array(
					'style' => array( 'style_3', 'style_4', 'style_5' ),
				),
			)
		);

		$this->add_control(
			'navigation',
			array(
				'label'        => __( 'Slider Navigation', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'hide',
				'description'  => esc_html__( 'Disable navigation.', 'consulting-elementor-widgets' ),
				'condition'    => array(
					'style' => array( 'style_3', 'style_4', 'style_5' ),
				),
			)
		);

		$this->add_control(
			'disable_container',
			array(
				'label'        => __( 'Remove default block size', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description'  => esc_html__( 'If you enable this option, the block size will be gone. And you can place widget in one small column.', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'smart_speed',
			array(
				'label'     => __( 'Smart Speed', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 250,
				'condition' => array(
					'style' => array( 'style_3', 'style_4', 'style_5' ),
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_testimonials' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_testimonials';

			consulting_show_template( 'testimonials', $settings );
		}
	}
}
