<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Elementor_STM_Portfolio_Information extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_portfolio_information';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Information', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-info';
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
			'portfolio_client',
			array(
				'label' => __( 'Client', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'portfolio_date',
			array(
				'label' => __( 'Date', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'portfolio_services',
			array(
				'label' => __( 'Services', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'link',
			array(
				'label' => __( 'Link', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::URL,
			)
		);

		$this->add_control(
			'portfolio_role',
			array(
				'label' => __( 'Role', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'facebook',
			array(
				'label' => __( 'Facebook', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'twitter',
			array(
				'label' => __( 'Twitter', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'instagram',
			array(
				'label' => __( 'Instagram', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'google_plus',
			array(
				'label' => __( 'Google+', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'youtube',
			array(
				'label' => __( 'Youtube', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
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
					)
				),
			)
		);

		$this->add_control(
			'posts_per_row',
			array(
				'label'   => __( 'Posts Per Row', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					4 => 4,
					3 => 3,
					2 => 2,
					1 => 1,
				),
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'   => __( 'Alignment', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Left', 'consulting-elementor-widgets' ) => 'left',
						esc_html__( 'Right', 'consulting-elementor-widgets' ) => 'right',
						esc_html__( 'Center', 'consulting-elementor-widgets' ) => 'center',
					)
				),
			)
		);

		$this->add_control(
			'show_title_icons',
			array(
				'label'        => __( 'Show Title Icons', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',

			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_portfolio_information' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_portfolio_information';

			if ( ! empty( $settings['link']['url'] ) ) {
				$settings['link']['title'] = $settings['link']['url'];
			}

			$settings['link']['target'] = 'on' === $settings['link']['is_external'] ? '_blank' : '_self';

			consulting_show_template( 'portfolio_information', $settings );

		}
	}
}
