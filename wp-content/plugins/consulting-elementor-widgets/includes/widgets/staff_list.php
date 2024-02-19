<?php

use Elementor\Controls_Manager;

class Elementor_STM_Staff_List extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_staff_list';
	}

	public function get_title() {
		return esc_html__( 'Staff List', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-user-list';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'slick' );
	}

	public function get_style_depends() {
		return array( 'slick' );
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
			'category',
			array(
				'label'   => __( 'Category', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip( $staff_categories ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'list',
				'options' => array_flip(
					array(
						esc_html__( 'List', 'consulting-elementor-widgets' ) => 'list',
						esc_html__( 'Grid', 'consulting-elementor-widgets' ) => 'grid',
						esc_html__( 'Carousel', 'consulting-elementor-widgets' ) => 'carousel',
						esc_html__( 'List two columns', 'consulting-elementor-widgets' ) => 'list_2',
					)
				),
			)
		);

		$this->add_control(
			'carousel_style',
			array(
				'label'     => __( 'Carousel Style', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'style_1',
				'options'   => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' ) => 'style_2',
					)
				),
				'condition' => array(
					'style' => 'carousel',
				),
			)
		);

		$this->add_control(
			'grid_view',
			array(
				'label'     => __( 'Grid View', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array_flip(
					array(
						esc_html__( 'Default', 'consulting-elementor-widgets' ) => 'default',
						esc_html__( 'Short', 'consulting-elementor-widgets' )   => 'short',
						esc_html__( 'With social icons', 'consulting-elementor-widgets' ) => 'social_icons',
						esc_html__( 'Social Media Card', 'consulting-elementor-widgets' ) => 'social_media_card',
						esc_html__( 'Minimal', 'consulting-elementor-widgets' ) => 'minimal',
					)
				),
				'default'   => 'default',
				'condition' => array(
					'style' => 'grid',
				),
			)
		);

		$this->add_control(
			'items_title',
			array(
				'label'     => __( 'Items Title', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'style' => 'carousel',
				),
			)
		);

		$this->add_control(
			'image_style',
			array(
				'label'     => __( 'Image Style', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array_flip(
					array(
						esc_html__( 'Default', 'consulting-elementor-widgets' )  => 'img_default',
						esc_html__( 'Square', 'consulting-elementor-widgets' )   => 'img_square',
						esc_html__( 'Rounded', 'consulting-elementor-widgets' )  => 'img_rounded',
						esc_html__( 'Circular', 'consulting-elementor-widgets' ) => 'img_circular',
						esc_html__( 'Leaf Shaped', 'consulting-elementor-widgets' ) => 'img_leaf',
					)
				),
				'condition' => array(
					'style' => array( 'list', 'grid', 'list_2' ),
				),
			)
		);

		$this->add_control(
			'image_leaf_rounded_corners',
			array(
				'label'     => __( 'Rounded corners', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'left_top_right_bottom',
				'options'   => array_flip(
					array(
						esc_html__( 'Left-top, right-bottom', 'consulting-elementor-widgets' ) => 'left_top_right_bottom',
						esc_html__( 'Left-bottom, right-top', 'consulting-elementor-widgets' ) => 'left_bottom_right_top',
					)
				),
				'condition' => array(
					'image_style' => 'img_leaf',
					'style'       => array( 'list', 'grid', 'list_2' ),
				),
			)
		);

		$this->add_control(
			'image_size',
			array(
				'label'     => __( 'Image Size', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'consulting-image-350x250-croped',
				'options'   => array_flip(
					array(
						esc_html__( 'Default (cropped)', 'consulting-elementor-widgets' ) => 'consulting-image-350x250-croped',
						esc_html__( 'Medium (proportional)', 'consulting-elementor-widgets' ) => 'medium',
					)
				),
				'condition' => array(
					'style' => 'grid',
				),
			)
		);

		$this->add_control(
			'per_row',
			array(
				'label'     => __( 'Staff Per Row', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'condition' => array(
					'style' => 'grid',
				),
			)
		);

		$this->add_control(
			'count',
			array(
				'label' => __( 'Count', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'slides_to_show',
			array(
				'label'     => __( 'Staff Per Row', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5,
				),
				'condition' => array(
					'style' => 'carousel',
				),
			)
		);

		$this->add_control(
			'carousel_arrows',
			array(
				'label'        => __( 'Carousel - Show Arrows', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'style' => 'carousel',
				),
			)
		);

		$this->add_control(
			'show_custom_link',
			array(
				'label'        => __( 'Custom link in list', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'grid_view' => 'short',
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'         => __( 'Link', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'condition'     => array(
					'show_custom_link' => 'yes',
				),
			)
		);

		$this->add_control(
			'link_text',
			array(
				'label'     => __( 'Subtitle', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => array(
					'show_custom_link' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.consulting_elementor_staff_list' );
	}

	protected function render() {
		if ( function_exists( 'consulting_show_template' ) ) {

			$settings = $this->get_settings_for_display();

			$settings['css_class'] = ' consulting_elementor_staff_list ';

			if ( ! empty( $settings['link']['url'] ) ) {
				$settings['link'] = Consulting_Elementor_Widgets::build_link( $settings );
			}

			if ( 'carousel' === $settings['style'] ) {
				consulting_load_vc_element( 'staff_carousel', $settings, $settings['carousel_style'] );
			} elseif ( 'grid' === $settings['style'] ) {
				consulting_load_vc_element( 'staff_grid', $settings, $settings['grid_view'] );
			} else {
				consulting_load_vc_element( 'staff_list', $settings, $settings['style'] );
			}
		}
	}
}
