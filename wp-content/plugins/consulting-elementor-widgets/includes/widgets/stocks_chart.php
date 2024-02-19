<?php

use Elementor\Controls_Manager;

class Elementor_STM_Stocks_Chart extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_stocks_chart';
	}

	public function get_title() {
		return esc_html__( 'Stocks Chart', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-graphs-candle';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'stocks-charts', 'charts-js' );
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
		$stock_index_data = consulting_get_stocks_indexes_symbols();

		$stock_indexes = array();

		foreach ( $stock_index_data as $stock ) {
			$stock_indexes[ $stock['value'] ] = $stock['label'];
		}

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'stm_stocks_chart',
			array(
				'label'   => __( 'Stocks chart', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $stock_indexes,
			)
		);

		$this->add_control(
			'chart_fill_color',
			array(
				'label' => __( 'Fill Color', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			)
		);

		$this->add_control(
			'chart_point_color',
			array(
				'label' => __( 'Point Color', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			)
		);

		$this->add_control(
			'second_symbol',
			array(
				'label'        => __( 'Add second symbol?', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'stm_stocks_chart2',
			array(
				'label'     => __( 'Stocks chart 2', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $stock_indexes,
				'condition' => array(
					'second_symbol' => 'yes',
				),
			)
		);

		$this->add_control(
			'chart_fill_color2',
			array(
				'label'     => __( 'Fill Color 2', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'second_symbol' => 'yes',
				),
			)
		);

		$this->add_control(
			'chart_point_color2',
			array(
				'label'     => __( 'Point Color 2', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'second_symbol' => 'yes',
				),
			)
		);

		$this->add_control(
			'chart_range',
			array(
				'label'   => __( 'Set range', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '1d',
				'options' => array_flip(
					array(
						esc_html__( '1 day', 'consulting-elementor-widgets' )   => '1d',
						esc_html__( '5 days', 'consulting-elementor-widgets' )  => '5d',
						esc_html__( '7 days', 'consulting-elementor-widgets' )  => '7d',
						esc_html__( '30 days', 'consulting-elementor-widgets' ) => '30d',
						esc_html__( '60 days', 'consulting-elementor-widgets' ) => '60d',
					)
				),
			)
		);

		$this->add_control(
			'chart_interval',
			array(
				'label'   => __( 'Set interval', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '1d',
				'options' => array_flip(
					array(
						esc_html__( '1 min', 'consulting-elementor-widgets' )    => '1m',
						esc_html__( '2 min', 'consulting-elementor-widgets' )    => '2m',
						esc_html__( '5 min', 'consulting-elementor-widgets' )    => '5m',
						esc_html__( '15 min', 'consulting-elementor-widgets' )   => '15m',
						esc_html__( '30 min', 'consulting-elementor-widgets' )   => '30m',
						esc_html__( '60 min', 'consulting-elementor-widgets' )   => '60m',
						esc_html__( '90 min', 'consulting-elementor-widgets' )   => '90m',
						esc_html__( '1 day', 'consulting-elementor-widgets' )    => '1d',
						esc_html__( '5 days', 'consulting-elementor-widgets' )   => '5d',
						esc_html__( '1 week', 'consulting-elementor-widgets' )   => '1wk',
						esc_html__( '1 month', 'consulting-elementor-widgets' )  => '1mo',
						esc_html__( '30 month', 'consulting-elementor-widgets' ) => '30mo',
					)
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_stocks_chart' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			consulting_show_template( 'stocks_chart', $settings );
		}
	}
}
