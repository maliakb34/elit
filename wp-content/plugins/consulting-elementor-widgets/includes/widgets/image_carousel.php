<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;

class Elementor_STM_Image_Carousel extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_image_carousel';
	}

	public function get_title() {
		return esc_html__( 'Image Carousel', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-image-carousel';
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
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'gallery',
			array(
				'label'   => __( 'Add Images', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::GALLERY,
				'default' => array(),
			)
		);

		$this->add_control(
			'custom_dimension',
			array(
				'label'       => __( 'Image Dimension', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'default'     => array(
					'width'  => '',
					'height' => '',
				),
			)
		);

		$this->add_control(
			'grayscale',
			array(
				'label'        => __( 'Enable grayscale', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'h_centered',
			array(
				'label'        => __( 'Centered Items', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$this->add_control(
			'links',
			array(
				'label'       => __( 'Links', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ link }}}',
			)
		);

		$this->add_control(
			'el_class',
			array(
				'label' => __( 'Additional class', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel',
			array(
				'label' => __( 'Carousel', 'consulting-elementor-widgets' ),
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
			'autoplay',
			array(
				'label'        => __( 'Slider autoplay', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'timeout',
			array(
				'label'     => __( 'Autoplay Timeout', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 5000,
				'condition' => array(
					'autoplay' => array( 'yes' ),
				),
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'        => __( 'Slider loop', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'nav',
			array(
				'label'        => __( 'Slider navigation', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'style' => array( 'style_2' ),
				),
			)
		);

		$this->add_control(
			'smart_speed',
			array(
				'label'   => __( 'Smart Speed', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 250,
			)
		);

		Consulting_Elementor_Widgets::add_text_field(
			$this,
			'items',
			esc_html__( 'Items', 'consulting-elementor-widgets' ),
			6
		);

		Consulting_Elementor_Widgets::add_text_field(
			$this,
			'items_small_desktop',
			esc_html__( 'Items (Small Desktop)', 'consulting-elementor-widgets' ),
			5
		);

		Consulting_Elementor_Widgets::add_text_field(
			$this,
			'items_tablet',
			esc_html__( 'Items (Tablet)', 'consulting-elementor-widgets' ),
			4
		);

		Consulting_Elementor_Widgets::add_text_field(
			$this,
			'items_mobile',
			esc_html__( 'Items (Mobile)', 'consulting-elementor-widgets' ),
			1
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_image_carousel' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {
			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_image_carousel';

			if ( ! empty( $settings['gallery'] ) ) {

				$settings['images'] = implode( ',', wp_list_pluck( $settings['gallery'], 'id' ) );

				if ( ! empty( $settings['custom_dimension'] ) && ! empty( $settings['custom_dimension']['width'] ) && ! empty( $settings['custom_dimension']['height'] ) ) {
					$settings['img_size'] = "{$settings['custom_dimension']['width']}x{$settings['custom_dimension']['height']}";
				}

				if ( empty( $settings['img_size'] ) ) {
					$settings['img_size'] = 'thumbnail';
				}

				$settings['custom_links'] = wp_list_pluck( $settings['links'], 'link' );

				consulting_show_template( 'image_carousel', $settings );
			}
		}
	}
}
