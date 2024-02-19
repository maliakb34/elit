<?php

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Elementor_STM_Event_Lessons extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_event_lessons';
	}

	public function get_title() {
		return esc_html__( 'Event Lessons', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-board';
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
			'stm_date_format',
			array(
				'label'   => __( 'Date Format', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'D, F j, Y',
				'options' => array(
					'D, F j, Y' => gmdate( 'D, F j, Y' ),
					'F j, Y'    => gmdate( 'F j, Y' ),
					'Y-m-d'     => gmdate( 'Y-m-d' ),
					'm/d/Y'     => gmdate( 'm/d/Y' ),
					'd/m/Y'     => gmdate( 'd/m/Y' ),
				),
			)
		);

		$this->add_control(
			'stm_time_format',
			array(
				'label'   => __( 'Time Format', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'g:i A',
				'options' => array(
					'g:i A' => gmdate( 'g:i A' ),
					'g:i a' => gmdate( 'g:i a' ),
					'H:i'   => gmdate( 'H:i' ),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'tab_title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Tab Title', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'datepicker',
			array(
				'label'          => __( 'Date', 'consulting-elementor-widgets' ),
				'placeholder'    => __( 'Tab Date', 'consulting-elementor-widgets' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => array(
					'enableTime' => false,
				),
			)
		);

		$i = 0;
		while ( $i <= 20 ) {
			$i++;
			$repeater->add_control(
				"timepicker_start_{$i}",
				array(
					'label'          => __( 'Time Start', 'consulting-elementor-widgets' ) . ' ' . $i,
					'type'           => \Elementor\Controls_Manager::DATE_TIME,
					'picker_options' => array(
						'enableTime' => true,
						'noCalendar' => true,
						'dateFormat' => 'H:i',
					),
				)
			);

			$repeater->add_control(
				"timepicker_end_{$i}",
				array(
					'label'          => __( 'Time End', 'consulting-elementor-widgets' ) . ' ' . $i,
					'type'           => \Elementor\Controls_Manager::DATE_TIME,
					'picker_options' => array(
						'enableTime' => true,
						'noCalendar' => true,
						'dateFormat' => 'H:i',
					),
				)
			);

			$repeater->add_control(
				"location_{$i}",
				array(
					'label' => __( 'Location', 'consulting-elementor-widgets' ) . ' ' . $i,
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$repeater->add_control(
				"title_{$i}",
				array(
					'label' => __( 'Title', 'consulting-elementor-widgets' ) . ' ' . $i,
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$repeater->add_control(
				"description_{$i}",
				array(
					'label' => __( 'Description', 'consulting-elementor-widgets' ) . ' ' . $i,
					'type'  => \Elementor\Controls_Manager::TEXTAREA,
				)
			);

			$speakers = get_posts(
				array(
					'posts_per_page' => -1,
					'post_type'      => 'stm_staff',
				)
			);

			$speakers_data = array();

			if ( ! empty( $speakers ) ) {
				foreach ( $speakers as $speaker ) {
					$speakers_data[ $speaker->ID ] = $speaker->post_title;
				}
			}
			$repeater->add_control(
				"lesson_speakers_{$i}",
				array(
					'label'    => __( 'Speakers', 'consulting-elementor-widgets' ),
					'type'     => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options'  => $speakers_data,
				)
			);
		}

		$this->add_control(
			'stm_event_lesson',
			array(
				'label'       => __( 'Event Agenda', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'tab_title' => __( 'Day 1', 'consulting-elementor-widgets' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ tab_title }}}',
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.events_lessons_box' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_event_lessons';

			consulting_show_template( 'event_lesson', $settings );
		}
	}
}
