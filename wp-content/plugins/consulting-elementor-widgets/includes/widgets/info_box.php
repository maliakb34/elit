<?php

use Elementor\Controls_Manager;

class Elementor_STM_Info_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_info_box';
	}

	public function get_title() {
		return esc_html__( 'Info Box', 'consulting-elementor-widgets' );
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
		$consulting_layout = get_option( 'consulting_layout', 'layout_1' );

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'plugin-name' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		Consulting_Elementor_Widgets::add_text_field( $this, 'title', esc_html__( 'Title', 'consulting-elementor-widgets' ) );

		$this->add_control(
			'infobox_label',
			array(
				'label'     => __( 'Infobox label', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'style' => array( 'style_9' ),
				),
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
						esc_html__( 'Style 1', 'consulting-elementor-widgets' )  => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' )  => 'style_2',
						esc_html__( 'Style 3', 'consulting-elementor-widgets' )  => 'style_3',
						esc_html__( 'Style 4', 'consulting-elementor-widgets' )  => 'style_4',
						esc_html__( 'Style 5', 'consulting-elementor-widgets' )  => 'style_5',
						esc_html__( 'Style 6', 'consulting-elementor-widgets' )  => 'style_6',
						esc_html__( 'Style 7', 'consulting-elementor-widgets' )  => 'style_7',
						esc_html__( 'Style 8', 'consulting-elementor-widgets' )  => 'style_8',
						esc_html__( 'Style 9', 'consulting-elementor-widgets' )  => 'style_9',
						esc_html__( 'Style 10', 'consulting-elementor-widgets' ) => 'style_10',
					)
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => __( 'Image', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'style' => array( 'style_1', 'style_2', 'style_3', 'style_4' ),
				),
			)
		);

		$this->add_control(
			'vc_image_size',
			array(
				'label'       => __( 'Image Size', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'plugin-name' ),
				'condition'   => array(
					'style' => array( 'style_1', 'style_2', 'style_3', 'style_4' ),
				),
			)
		);

		$this->add_control(
			'align_center',
			array(
				'label'        => __( 'Align Center', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'title_icon',
			array(
				'label'     => __( 'Title Icon', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'condition' => array(
					'style' => array( 'style_3', 'style_6', 'style_8', 'style_10' ),
				),
			)
		);

		Consulting_Elementor_Widgets::add_text_field(
			$this,
			'title_icon_size',
			esc_html__( 'Icon - Size', 'consulting-elementor-widgets' ),
			'',
			array(
				'condition' => array(
					'style' => array( 'style_6' ),
				),
			)
		);

		$this->add_control(
			'content',
			array(
				'label' => __( 'Text', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::WYSIWYG,
			)
		);

		$this->add_control(
			'link',
			array(
				'label'         => __( 'Link', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'condition'     => array(
					'style' => array( 'style_1', 'style_2', 'style_3', 'style_4', 'style_5', 'style_6', 'style_7', 'style_10' ),
				),
			)
		);

		$this->add_control(
			'link_title',
			array(
				'label' => __( 'Link Title', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'     => __( 'URL Icon', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'condition' => array(
					'style' => array( 'style_1', 'style_2', 'style_3', 'style_5', 'style_6', 'style_10' ),
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.elementor-consulting-info-box' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' elementor-consulting-info-box';

			if ( ! empty( $settings['link']['url'] ) ) {
				$settings['link'] = Consulting_Elementor_Widgets::build_link( $settings );
			}

			if ( ! empty( $settings['title_icon']['value'] ) ) {
				$settings['title_icon'] = $settings['title_icon']['value'];
			}

			if ( ! empty( $settings['image']['id'] ) ) {
				$settings['image'] = $settings['image']['id'];
			}

			$settings['content'] = wpautop( $settings['content'] );

			consulting_load_vc_element( 'info_box', $settings, $settings['style'] );

		}
	}
}
