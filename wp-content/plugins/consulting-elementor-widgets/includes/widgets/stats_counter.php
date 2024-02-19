<?php

use Elementor\Controls_Manager;

class Elementor_STM_Stats_Counter extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_stats_counter';
	}

	public function get_title() {
		return esc_html__( 'Stats counter', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-graphs';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'countUp' );
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
		$consulting_layout = get_option( 'consulting_layout', 'layout_1' );

		$staff_categories_array = get_terms( 'stm_staff_category' );
		$staff_categories       = array(
			esc_html__( 'All', 'consulting-elementor-widgets' ) => 'all',
		);
		if ( $staff_categories_array && ! is_wp_error( $staff_categories_array ) ) {
			foreach ( $staff_categories_array as $cat ) {
				$staff_categories[ $cat->name ] = $cat->slug;
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
			'stat_counter_style',
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
						esc_html__( 'Style 5', 'consulting-elementor-widgets' ) => 'style_5',
					)
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => __( 'Icon', 'text-domain' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'condition' => array(
					'stat_counter_style' => 'style_5',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'     => __( 'Title', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'stat_counter_style' => array( 'style_1', 'style_3', 'style_4', 'style_5' ),
				),
			)
		);

		$this->add_control(
			'counter_value',
			array(
				'label'   => __( 'Counter value', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '1000',
			)
		);

		$this->add_control(
			'counter_value_pre',
			array(
				'label' => __( 'Counter value prefix', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'counter_value_suf',
			array(
				'label' => __( 'Counter value suffix', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'     => __( 'Description', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG,
				'rows'      => 5,
				'condition' => array( 'stat_counter_style' => array( 'style_2', 'style_3' ) ),
			)
		);

		$this->add_control(
			'duration',
			array(
				'label'   => __( 'Duration', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '2.5',
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'   => __( 'Alignment', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
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
			'title_color',
			array(
				'label'     => __( 'Title Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_elementor_stats_counter .counter-wrap *' => 'color: {{VALUE}}',
				),
				'condition' => array( 'stat_counter_style' => array( 'style_5' ) ),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Title Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_elementor_stats_counter .icon-wrap i' => 'color: {{VALUE}}',
				),
				'condition' => array( 'stat_counter_style' => array( 'style_5' ) ),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_elementor_stats_counter *' => 'color: {{VALUE}}',
				),
			)
		);

		if ( 'layout_16' === $consulting_layout ) {
			$this->add_control(
				'stats_style',
				array(
					'label'   => __( 'Style', 'consulting-elementor-widgets' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'options' => array_flip(
						array(
							esc_html__( 'Style 1', 'consulting-elementor-widgets' ) => 'style_1',
							esc_html__( 'Style 2', 'consulting-elementor-widgets' ) => 'style_2',
						)
					),
				)
			);

			$this->add_control(
				'color',
				array(
					'label'     => __( 'Color', 'consulting-elementor-widgets' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'condition' => array( 'stats_style' => array( 'style_2' ) ),
				)
			);
		}

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_stats_counter' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_stats_counter';

			if ( isset( $settings['icon'] ) ) {
				$settings['icon'] = $settings['icon']['value'];
			}

			if ( ! empty( $settings['description'] ) ) {
				$settings['description'] = wpautop( $settings['description'] );
			}

			consulting_show_template( 'stats_counter', $settings );

		}
	}
}
