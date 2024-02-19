<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Elementor_STM_Portfolio_Carousel extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_portfolio_carousel';
	}

	public function get_title() {
		return esc_html__( 'Portfolio Carousel', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-portfolio-carousel';
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
			'title',
			array(
				'label' => __( 'Title', 'consulting-elementor-widgets' ),
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
					)
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => __( 'Number Posts', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 12,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'        => __( 'Loop', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'no',
			)
		);

		$this->add_control(
			'nav',
			array(
				'label'        => __( 'Navigation', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Enable carousel navigation buttons', 'consulting-elementor-widgets' ),
				'return_value' => 'no',
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'        => __( 'Pagination/Dots', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Enable carousel pagination dots', 'consulting-elementor-widgets' ),
				'return_value' => 'no',
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => __( 'Items', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'The number of items you want to see on the screen.', 'consulting-elementor-widgets' ),
				'default'     => 3,
			)
		);

		$this->add_control(
			'items_small_desktop',
			array(
				'label'       => __( 'Items (Small Desktop)', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of items the carousel will display. Default: at <980px - 4 items.', 'consulting-elementor-widgets' ),
				'default'     => 3,
			)
		);

		$this->add_control(
			'items_tablet',
			array(
				'label'       => __( 'Items (Tablet)', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of items the carousel will display. Default: at <768px - 3 items.', 'consulting-elementor-widgets' ),
				'default'     => 2,
			)
		);

		$this->add_control(
			'items_mobile',
			array(
				'label'       => __( 'Items (Mobile)', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Number of items the carousel will display. Default: at <479px - 1 item.', 'consulting-elementor-widgets' ),
				'default'     => 1,
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_portfolio_carousel' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_portfolio_carousel';

			consulting_show_template( 'portfolio_carousel', $settings );

		}
	}
}
