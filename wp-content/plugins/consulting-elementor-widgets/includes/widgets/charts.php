<?php

use Elementor\Controls_Manager;

class Elementor_STM_Charts extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_charts';
	}

	public function get_title() {
		return esc_html__( 'Charts', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-charts';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'design',
			array(
				'label'   => __( 'Design', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'line',
				'options' => array_flip(
					array(
						esc_html__( 'Line', 'consulting-elementor-widgets' ) => 'line',
						esc_html__( 'Bar', 'consulting-elementor-widgets' )  => 'bar',
						esc_html__( 'Doughnut', 'consulting-elementor-widgets' ) => 'doughnut',
						esc_html__( 'Pie', 'consulting-elementor-widgets' )  => 'pie',
						esc_html__( 'Radar', 'consulting-elementor-widgets' ) => 'radar',
						esc_html__( 'Polar area', 'consulting-elementor-widgets' ) => 'polarArea',
					)
				),
			)
		);

		$this->add_control(
			'legend',
			array(
				'label'        => __( 'Show legend?', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'legend_position',
			array(
				'label'   => __( 'Legend Position', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => array_flip(
					array(
						esc_html__( 'Top', 'consulting-elementor-widgets' )  => 'top',
						esc_html__( 'Right', 'consulting-elementor-widgets' ) => 'right',
						esc_html__( 'Bottom', 'consulting-elementor-widgets' ) => 'bottom',
						esc_html__( 'Left', 'consulting-elementor-widgets' ) => 'left',
					)
				),
			)
		);

		$this->add_control(
			'width',
			array(
				'label' => __( 'Width (px)', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'height',
			array(
				'label' => __( 'Height (px)', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'x_values',
			array(
				'label'     => __( 'X-axis values', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'rows'      => 5,
				'default'   => 'JAN; FEB; MAR; APR; MAY; JUN; JUL; AUG',
				'condition' => array(
					'design' => array( 'line', 'bar', 'radar' ),
				),
			)
		);

		/*Repeater VALUES*/
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'y_values',
			array(
				'label'       => __( 'Y-axis values', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'color',
			array(
				'label' => __( 'Color', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			)
		);

		$this->add_control(
			'values',
			array(
				'label'       => __( 'Values', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'title'    => esc_html__( 'One', 'consulting-elementor-widgets' ),
						'y_values' => '10; 15; 20; 25; 27; 25; 23; 25',
						'color'    => '#fe6c61',
					),
					array(
						'title'    => esc_html__( 'Two', 'consulting-elementor-widgets' ),
						'y_values' => '25; 18; 16; 17; 20; 25; 30; 35',
						'color'    => '#5472d2',
					),
				),
				'title_field' => '{{{ title }}}',
				'condition'   => array(
					'design' => array( 'line', 'bar', 'radar' ),
				),
			)
		);

		/*Repeater CIRCLE VALUES*/
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'value',
			array(
				'label'       => __( 'Value', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'color',
			array(
				'label' => __( 'Color', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			)
		);

		$this->add_control(
			'values_circle',
			array(
				'label'       => __( 'Values', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'title' => esc_html__( 'One', 'consulting-elementor-widgets' ),
						'value' => '40',
						'color' => '#fe6c61',
					),
					array(
						'title' => esc_html__( 'Two', 'consulting-elementor-widgets' ),
						'value' => '30',
						'color' => '#5472d2',
					),
					array(
						'title' => esc_html__( 'Three', 'consulting-elementor-widgets' ),
						'value' => '40',
						'color' => '#8d6dc4',
					),
				),
				'title_field' => '{{{ title }}}',
				'condition'   => array(
					'design' => array( 'doughnut', 'pie', 'polarArea' ),
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' stm_charts';

			if ( ! empty( $_GET['action'] ) && ( 'elementor' === $_GET['action'] || 'elementor_ajax' === $_GET['action'] ) ) {
				echo "<div class='consulting-elementor-notice'>" . esc_html__( 'Check module in preview mode.', 'consulting-elementor-widgets' ) . '</div>';
			} else {
				consulting_show_template( 'charts', $settings );
			}
		}
	}
}
