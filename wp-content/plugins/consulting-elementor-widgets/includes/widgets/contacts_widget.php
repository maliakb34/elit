<?php

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Elementor_STM_Contacts_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_contacts_widget';
	}

	public function get_title() {
		return esc_html__( 'Contacts', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-phone';
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
			'style',
			array(
				'label'   => __( 'Widget Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'style_1' => __( 'Style 1', 'consulting-elementor-widgets' ),
					'style_2' => __( 'Style 2', 'consulting-elementor-widgets' ),
					'style_3' => __( 'Style 3', 'consulting-elementor-widgets' ),
					'style_4' => __( 'Style 4', 'consulting-elementor-widgets' ),
					'style_5' => __( 'Style 5', 'consulting-elementor-widgets' ),
				),
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
			'sub_title',
			array(
				'label'     => __( 'Sub Title', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'style' => array( 'style_5' ),
				),
			)
		);

		$this->add_control(
			'address',
			array(
				'label'     => __( 'Address', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG,
				'condition' => array(
					'style' => array( 'style_1', 'style_3', 'style_4', 'style_5' ),
				),
			)
		);

		$this->add_control(
			'phone',
			array(
				'label'     => __( 'Phone', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'style' => array( 'style_1', 'style_2', 'style_4' ),
				),
			)
		);

		$this->add_control(
			'phone_two',
			array(
				'label'     => __( 'Phone 2', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'style' => array( 'style_4' ),
				),
			)
		);

		$this->add_control(
			'fax',
			array(
				'label'     => __( 'Fax', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'style' => array( 'style_4' ),
				),
			)
		);

		$this->add_control(
			'phones',
			array(
				'label'     => __( 'Phones', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'rows'      => 5,
				'condition' => array(
					'style' => array( 'style_3', 'style_5' ),
				),
			)
		);

		$this->add_control(
			'email',
			array(
				'label' => __( 'E-mail', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'schedule',
			array(
				'label'     => __( 'Schedule', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA,
				'rows'      => 5,
				'condition' => array(
					'style' => array( 'style_3', 'style_4', 'style_5' ),
				),
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
			'linkedin',
			array(
				'label' => __( 'Linkedin', 'consulting-elementor-widgets' ),
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
			'skype',
			array(
				'label' => __( 'Skype', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'class',
			array(
				'label' => __( 'Extra class name', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .stm_contacts_widget ul li, {{WRAPPER}} .stm_contacts_widget h4' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.stm_contacts_widget' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_contacts_widget ' . $settings['style'] . ' ' . $settings['class'];

			consulting_show_template( 'contacts_widget', $settings );
		}
	}
}
