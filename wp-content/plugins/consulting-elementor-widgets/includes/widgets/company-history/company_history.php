<?php

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;

class Elementor_STM_Company_History extends \Elementor\Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_style( 'consulting-company-history-vertical-standard', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/company-history/vertical-standard.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-company-history-vertical-side', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/company-history/vertical-side.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-company-history-vertical-alternating', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/company-history/vertical-alternating.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-company-history-horizontal-standard', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/company-history/horizontal-standard.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-company-history-horizontal-alternating', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/company-history/horizontal-alternating.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-company-history-horizontal-bottom', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/company-history/horizontal-bottom.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_script( 'consulting-company-history-js', CONSULTING_ELEMENTOR_URL . 'assets/js/widgets/company-history.js', array( 'elementor-frontend', 'slick' ), CONSULTING_ELEMENTOR_VERSION, true );
	}

	public function get_style_depends() {
		return array(
			'consulting-company-history-vertical-standard',
			'consulting-company-history-vertical-side',
			'consulting-company-history-vertical-alternating',
			'consulting-company-history-horizontal-standard',
			'consulting-company-history-horizontal-alternating',
			'consulting-company-history-horizontal-bottom',
			'slick',
		);
	}

	public function get_script_depends() {
		return array( 'slick', 'consulting-company-history-js' );
	}

	public function get_name() {
		return 'stm_company_history';
	}

	public function get_title() {
		return esc_html__( 'Timeline', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-history';
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
				'label' => __( 'General', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'box_style',
			array(
				'label'   => __( 'Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array(
					'vertical_standard'      => esc_html__( 'Vertical Standard', 'consulting-elementor-widgets' ),
					'vertical_side'          => esc_html__( 'Vertical Side', 'consulting-elementor-widgets' ),
					'vertical_alternating'   => esc_html__( 'Vertical Alternating', 'consulting-elementor-widgets' ),
					'horizontal_standard'    => esc_html__( 'Horizontal Standard', 'consulting-elementor-widgets' ),
					'horizontal_alternating' => esc_html__( 'Horizontal Alternating', 'consulting-elementor-widgets' ),
					'horizontal_bottom'      => esc_html__( 'Horizontal Bottom', 'consulting-elementor-widgets' ),
					'style_1'                => esc_html__( 'Old Style 1', 'consulting-elementor-widgets' ),
					'style_2'                => esc_html__( 'Old Style 2', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'dark_bg_mode',
			array(
				'label'        => __( 'Dark background?', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => array(
					'box_style' => array( 'style_2' ),
				),
			)
		);

		$this->add_control(
			'show_icon',
			array(
				'label'        => __( 'Show Icon', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'consulting-elementor-widgets' ),
				'label_off'    => __( 'Hide', 'consulting-elementor-widgets' ),
				'default'      => 'show',
				'return_value' => 'show',
				'condition'    => array(
					'box_style!' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$this->add_control(
			'show_image',
			array(
				'label'        => __( 'Show Image', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'consulting-elementor-widgets' ),
				'label_off'    => __( 'Hide', 'consulting-elementor-widgets' ),
				'default'      => 'show',
				'return_value' => 'show',
				'condition'    => array(
					'box_style!' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label' => __( 'Point Icon', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
				'skin'  => 'inline',
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => __( 'Image', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array( 'url' => \Elementor\Utils::get_placeholder_image_src() ),
			)
		);

		$repeater->add_control(
			'year',
			array(
				'label'       => __( 'Date', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => date( 'Y' ),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Company Title', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'      => __( 'Content', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'default'    => __( 'Company Description', 'consulting-elementor-widgets' ),
				'show_label' => false,
			)
		);

		$this->add_control(
			'list',
			array(
				'label'       => __( 'Items', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'title'       => __( 'Company Title #1', 'consulting-elementor-widgets' ),
						'description' => __( 'Item content. Click the edit button to change this text.', 'consulting-elementor-widgets' ),
					),
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->add_control(
			'column_count',
			array(
				'label'     => __( 'Number of Columns', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					3 => 3,
					4 => 4,
					5 => 5,
					6 => 6,
				),
				'default'   => 4,
				'condition' => array(
					'box_style' => array( 'horizontal_standard', 'horizontal_alternating', 'horizontal_bottom' ),
				),
			)
		);

		$this->add_control(
			'items_spacing',
			array(
				'label'      => __( 'Space Between Items', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'em'  => array(
						'min' => 0,
						'max' => 100,
					),
					'rem' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper .history-item'                                                                                                                              => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item'                                                                                                                                  => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper .history-item'                                                                                                                           => 'margin: calc({{SIZE}}{{UNIT}} / 2) 0',
					'{{WRAPPER}} .company_history.horizontal_standard:not(.rtl) .history_wrapper .history-item .item-info'                                                                                                       => 'padding-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .company_history.horizontal_standard.rtl .history_wrapper .history-item .item-info'                                                                                                             => 'padding-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper .history-item'                                                                                                                         => 'padding-right: calc({{SIZE}}{{UNIT}} / 2); padding-left: calc({{SIZE}}{{UNIT}} / 2)',
					'{{WRAPPER}} .company_history.horizontal_bottom:not(.rtl) .history_wrapper .history-item .item-info, {{WRAPPER}} .company_history.horizontal_bottom:not(.rtl) .history_wrapper .history-item .image-wrapper' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .company_history.horizontal_bottom.rtl .history_wrapper .history-item .item-info, {{WRAPPER}} .company_history.horizontal_bottom.rtl .history_wrapper .history-item .image-wrapper'             => 'padding-left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'box_style!' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$this->end_controls_section();

		$this->add_dimensions( '.company_history' );

		$this->start_controls_section(
			'text_section',
			array(
				'label' => __( 'Text', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .item-title-wrapper .item-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.style_1 .company_history_text .company_history_top_title'       => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .company_history .history_wrapper .history-item .item-title-wrapper .item-title, {{WRAPPER}} .company_history.style_1 .company_history_text .company_history_top_title, {{WRAPPER}} .company_history.style_2 .company_history_text h4',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_control(
			'title_margin_bottom',
			array(
				'label'      => __( 'Title Margin Bottom', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'em'  => array(
						'min' => 0,
						'max' => 100,
					),
					'rem' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .item-title-wrapper'       => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .company_history.style_1 .company_history_text .company_history_top_title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .company_history.style_2 .company_history_text h4'                         => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
				'separator'  => 'after',
			)
		);

		$this->add_control(
			'date_color',
			array(
				'label'     => __( 'Date Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .year-wrapper .year' => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.style_1 ul li .year'                                => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.style_2 .history-item .year'                        => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'date_typography',
				'label'    => __( 'Date Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .company_history .history_wrapper .history-item .year-wrapper .year, {{WRAPPER}} .company_history.style_1 ul li .year, {{WRAPPER}} .company_history.style_2 .history-item .year',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_control(
			'date_margin_bottom',
			array(
				'label'      => __( 'Date Margin Bottom', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'range'      => array(
					'px'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'em'  => array(
						'min' => 0,
						'max' => 100,
					),
					'rem' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .year-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'box_style' => array( 'vertical_side', 'vertical_alternating', 'horizontal_bottom' ),
				),
			)
		);

		$this->add_control(
			'descr_color',
			array(
				'label'     => __( 'Description Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .item-description-wrapper .item-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.style_1 .company_history_text p'                                            => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.style_2 .history-item .company_history_text p'                              => 'color: {{VALUE}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'descr_typography',
				'label'    => __( 'Description Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .company_history .history_wrapper .history-item .item-description-wrapper .item-description, {{WRAPPER}} .company_history.style_1 .company_history_text p, {{WRAPPER}} .company_history.style_1 .company_history_text p',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'line_section',
			array(
				'label'     => __( 'Line', 'consulting-elementor-widgets' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array(
					'box_style!' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$this->add_control(
			'line_color',
			array(
				'label'     => __( 'Line Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .point:after, {{WRAPPER}} .company_history .history_wrapper .history-item .point-no-icon:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history .history_wrapper:before'                                                                                                       => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper'                                                                                                => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'line_thickness',
			array(
				'label'     => __( 'Line Thickness (px)', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 20,
				'step'      => 1,
				'selectors' => array(
					'{{WRAPPER}} .company_history.horizontal_bottom .history_wrapper .history-item .point:after, {{WRAPPER}} .company_history.horizontal_bottom .history_wrapper .history-item .point-no-icon:after'     => 'height: {{VALUE}}px;',
					'{{WRAPPER}} .company_history.horizontal_standard .history_wrapper .history-item .point:after, {{WRAPPER}} .company_history.horizontal_standard .history_wrapper .history-item .point-no-icon:after' => 'height: {{VALUE}}px;',
					'{{WRAPPER}} .company_history.horizontal_bottom .history_wrapper .history-item .point'                                                                                                               => 'padding-top: calc(18.5px - {{VALUE}}px / 2 ); padding-bottom: calc(18.5px - {{VALUE}}px / 2 )',
					'{{WRAPPER}} .company_history.horizontal_standard .history_wrapper .history-item .point'                                                                                                             => 'padding-top: calc(18.5px - {{VALUE}}px / 2 ); padding-bottom: calc(18.5px - {{VALUE}}px / 2 )',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper:before'                                                                                                                          => 'left: calc( 50% - {{VALUE}}px / 2 ); width: {{VALUE}}px',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper:before'                                                                                                                                 => 'width: {{VALUE}}px; left: calc( 0px - {{VALUE}}px / 2 );',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point'                                                                                                                   => 'left: calc(-15px - {{VALUE}}px / 2 );',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point-no-icon'                                                                                                           => 'left: calc(3px - {{VALUE}}px / 2 );',
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper:before'                                                                                                                             => 'left: calc(10.1% - {{VALUE}}px / 2 );width: {{VALUE}}px',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper:before'                                                                                                                        => 'height: {{VALUE}}px; top: calc(50.8% - {{VALUE}}px / 2 )',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			array(
				'label'     => __( 'Image', 'consulting-elementor-widgets' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array(
					'box_style!' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .image-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'point_section',
			array(
				'label'     => __( 'Point', 'consulting-elementor-widgets' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array(
					'box_style!' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$this->add_control(
			'point_border_radius',
			array(
				'label'      => __( 'Point Border Radius', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .point-no-icon:before'               => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history .history_wrapper .history-item .point:before'                       => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history .history_wrapper .history-item .point .point_icon'                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history .history_wrapper .history-item .point-icon'                         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper .history-item .point'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper .history-item .point'            => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point'                => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper .history-item .point-no-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper .history-item .point-no-icon'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point-no-icon'        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'point_size',
			array(
				'label'     => __( 'Point Size (px)', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 50,
				'step'      => 1,
				'selectors' => array(
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper .history-item .point-no-icon'          => 'width: {{VALUE}}px;height: {{VALUE}}px;left: calc( 10.1% - {{VALUE}}px / 2)',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point-no-icon'              => 'width: {{VALUE}}px;height: {{VALUE}}px;left: calc( 0px - {{VALUE}}px / 2)',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper .history-item .point-no-icon'       => 'width: {{VALUE}}px;height: {{VALUE}}px;left: calc( 50.3% - {{VALUE}}px / 2)',
					'{{WRAPPER}} .company_history.horizontal_standard .history_wrapper .history-item .point-no-icon:before' => 'width: {{VALUE}}px;height: {{VALUE}}px;',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper .history-item .point:before'      => 'width: {{VALUE}}px;height: {{VALUE}}px;',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper .history-item .point'             => 'top: calc(50.8% - {{VALUE}}px / 2);',
					'{{WRAPPER}} .company_history.horizontal_bottom .history_wrapper .history-item .point-no-icon:before'   => 'width: {{VALUE}}px;height: {{VALUE}}px;',
				),
			)
		);

		$this->add_control(
			'point_color',
			array(
				'label'     => __( 'Point Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history.horizontal_standard .history_wrapper .history-item .point:before'       => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper .history-item .point:before'    => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.horizontal_bottom .history_wrapper .history-item .point-no-icon:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper .history-item .point-no-icon'        => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point-no-icon'            => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper .history-item .point-no-icon'     => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size (px)', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'selectors' => array(
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper .history-item .point'               => 'width: {{VALUE}}px;height: {{VALUE}}px;font-size: calc({{VALUE}}px / 2 ); left: calc(10.1% - {{VALUE}}px / 2 )',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point'                   => 'width: {{VALUE}}px;height: {{VALUE}}px;font-size: calc({{VALUE}}px / 2 ); left: calc(0px - {{VALUE}}px / 2 )',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper .history-item .point'            => 'width: {{VALUE}}px;height: {{VALUE}}px;font-size: calc({{VALUE}}px / 2 ); left: calc(49.8% - {{VALUE}}px / 2 )',
					'{{WRAPPER}} .company_history.horizontal_standard .history_wrapper .history-item .point .point_icon' => 'width: {{VALUE}}px;height: {{VALUE}}px;font-size: calc({{VALUE}}px / 2 );',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper .history-item .point-icon'     => 'width: {{VALUE}}px;height: {{VALUE}}px;font-size: calc({{VALUE}}px / 2 );top: calc( 50.8% - {{VALUE}}px / 2);',
					'{{WRAPPER}} .company_history.horizontal_bottom .history_wrapper .history-item .point .point_icon'   => 'width: {{VALUE}}px;height: {{VALUE}}px;font-size: calc({{VALUE}}px / 2 );',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history.horizontal_standard .history_wrapper .history-item .point_icon'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper .history-item .point_icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.horizontal_bottom .history_wrapper .history-item .point_icon'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper .history-item .point_icon'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point_icon'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper .history-item .point_icon'   => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_bg_color',
			array(
				'label'     => __( 'Icon Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history.horizontal_standard .history_wrapper .history-item .point_icon'    => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper .history-item .point-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.horizontal_bottom .history_wrapper .history-item .point_icon'      => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_standard .history_wrapper .history-item .point'           => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_side .history_wrapper .history-item .point'               => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .company_history.vertical_alternating .history_wrapper .history-item .point'        => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box_section',
			array(
				'label'     => __( 'Box', 'consulting-elementor-widgets' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array(
					'box_style' => array( 'vertical_alternating', 'horizontal_alternating' ),
				),
			)
		);

		$this->add_control(
			'box_bg_color',
			array(
				'label'     => __( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .item-info' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'box_border',
				'selector' => '{{WRAPPER}} .company_history .history_wrapper .history-item .item-info',
			)
		);

		$this->add_control(
			'box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .company_history .history_wrapper .history-item .item-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .company_history .history_wrapper .history-item .item-info',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'nav_section',
			array(
				'label'     => __( 'Navigation', 'consulting-elementor-widgets' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array(
					'box_style' => array( 'horizontal_standard', 'horizontal_alternating', 'horizontal_bottom' ),
				),
			)
		);

		$this->add_control(
			'nav_size',
			array(
				'label'     => __( 'Size (px)', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .item_next, {{WRAPPER}} .company_history .history_wrapper .item_prev' => 'width: {{VALUE}}px;height: {{VALUE}}px;font-size: calc({{VALUE}}px / 2 );',
					'{{WRAPPER}} .company_history.horizontal_alternating .history_wrapper .item_next'                                    => 'margin-left: calc( {{VALUE}}px + 10px );',
					'{{WRAPPER}} .company_history.horizontal_alternating.rtl .history_wrapper .item_prev'                                => 'margin-right: calc( {{VALUE}}px + 10px );',
				),
			)
		);

		$this->add_control(
			'navigation_previous_icon',
			array(
				'label'            => esc_html__( 'Previous Icon', 'consulting-elementor-widgets' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'default'          => array(
					'value' => 'fa fa-angle-left',
				),
				'recommended'      => array(
					'fa-regular' => array(
						'arrow-alt-circle-left',
						'caret-square-left',
					),
					'fa-solid'   => array(
						'angle-double-left',
						'angle-left',
						'arrow-alt-circle-left',
						'arrow-circle-left',
						'arrow-left',
						'caret-left',
						'caret-square-left',
						'chevron-circle-left',
						'chevron-left',
						'long-arrow-alt-left',
					),
				),
			)
		);

		$this->add_control(
			'navigation_next_icon',
			array(
				'label'            => esc_html__( 'Next Icon', 'consulting-elementor-widgets' ),
				'type'             => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'skin'             => 'inline',
				'label_block'      => false,
				'default'          => array(
					'value' => 'fa fa-angle-right',
				),
				'recommended'      => array(
					'fa-regular' => array(
						'arrow-alt-circle-right',
						'caret-square-right',
					),
					'fa-solid'   => array(
						'angle-double-right',
						'angle-right',
						'arrow-alt-circle-right',
						'arrow-circle-right',
						'arrow-right',
						'caret-right',
						'caret-square-right',
						'chevron-circle-right',
						'chevron-right',
						'long-arrow-alt-right',
					),
				),
			)
		);

		$this->start_controls_tabs(
			'arrow_colors'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => __( 'Arrows Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .item_prev i, {{WRAPPER}} .company_history .history_wrapper .item_next i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'arrow_bg_color',
			array(
				'label'     => __( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .item_prev, {{WRAPPER}} .company_history .history_wrapper .item_next' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'arrow_border_color',
			array(
				'label'     => __( 'Border Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .item_prev, {{WRAPPER}} .company_history .history_wrapper .item_next' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'arrow_hover_color',
			array(
				'label'     => __( 'Arrows Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .item_prev:hover i, {{WRAPPER}} .company_history .history_wrapper .item_next:hover i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'arrow_bg_hover_color',
			array(
				'label'     => __( 'Background Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .item_prev:hover, {{WRAPPER}} .company_history .history_wrapper .item_next:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'arrow_border_hover_color',
			array(
				'label'     => __( 'Border Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .company_history .history_wrapper .item_prev:hover, {{WRAPPER}} .company_history .history_wrapper .item_next:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$i        = 0;
		$settings = $this->get_settings_for_display();
		if ( false !== strpos( $settings['box_style'], 'style' ) ) {
			if ( function_exists( 'consulting_show_template' ) ) {
				consulting_load_vc_element( 'company_history', $settings, $settings['box_style'] );
			}
		} else {
			set_query_var( 'i', $i );
			$settings['count'] = $i;
			stm_load_variations_template( $settings, '/company-history/styles/' . $settings['box_style'] );
			$i ++;
		}
	}
}
