<?php

use Elementor\Controls_Manager;

class Elementor_STM_Spacing extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_spacing';
	}

	public function get_title() {
		return esc_html__( 'Spacing', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-spacing';
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
		$stm_sidebars_array = get_posts(
			array(
				'post_type'      => 'stm_vc_sidebar',
				'posts_per_page' => -1,
			)
		);
		$stm_sidebars       = array( esc_html__( 'Select', 'consulting-elementor-widgets' ) => 0 );
		if ( $stm_sidebars_array && ! is_wp_error( $stm_sidebars_array ) ) {
			foreach ( $stm_sidebars_array as $val ) {
				$stm_sidebars[ get_the_title( $val ) ] = $val->ID;
			}
		}

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'plugin-name' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'lg_spacing',
			array(
				'label' => __( 'Large Screen (px)', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'md_spacing',
			array(
				'label' => __( 'Medium Screen (px)', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'sm_spacing',
			array(
				'label' => __( 'Tablet Screen (px)', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'xs_spacing',
			array(
				'label' => __( 'Mobile Screen (px)', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_spacing' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_spacing';

			consulting_show_template( 'spacing', $settings );

		}
	}
}
