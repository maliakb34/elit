<?php

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Elementor_STM_Portfolio extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_style( 'consulting-portfolio-general', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/portfolio/general.css', array(), time(), false );
		wp_register_style( 'consulting-portfolio-masonry', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/portfolio/style_1.css', array(), time(), false );
		wp_register_style( 'consulting-portfolio-grid', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/portfolio/style_2.css', array(), time(), false );
		wp_register_style( 'consulting-portfolio-grid-with-text', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/portfolio/style_3.css', array(), time(), false );
		wp_register_style( 'consulting-portfolio-grid-with-text2', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/portfolio/style_4.css', array(), time(), false );
		wp_register_style( 'consulting-portfolio-list', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/portfolio/style_5.css', array(), time(), false );
		wp_register_script( 'consulting-portfolio', CONSULTING_ELEMENTOR_URL . 'assets/js/widgets/portfolio.js', array( 'elementor-frontend' ), time(), true );
	}

	public function get_name() {
		return 'stm_portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-briefcase';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_style_depends() {
		return array(
			'consulting-portfolio-general',
			'consulting-portfolio-masonry',
			'consulting-portfolio-grid',
			'consulting-portfolio-grid-with-text',
			'consulting-portfolio-grid-with-text2',
			'consulting-portfolio-list',
		);
	}

	public function get_script_depends() {
		return array( 'consulting-portfolio' );
	}

	protected function register_controls() {
		$portfolio_categories_array = get_terms( 'stm_portfolio_category' );
		$portfolio_categories       = array(
			esc_html__( 'All', 'consulting-elementor-widgets' ) => 'all',
		);
		if ( $portfolio_categories_array && ! is_wp_error( $portfolio_categories_array ) ) {
			foreach ( $portfolio_categories_array as $cat ) {
				$portfolio_categories[ $cat->name ] = $cat->slug;
			}
		}

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'General', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'portfolio_category',
			array(
				'label'   => esc_html__( 'Сategory', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array_flip( $portfolio_categories ),
				'default' => 'all',
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => esc_html__( 'Layout', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Masonry Grid', 'consulting-elementor-widgets' )     => 'style_1',
						esc_html__( 'Images Grid', 'consulting-elementor-widgets' )      => 'style_2',
						esc_html__( 'Grid With Text', 'consulting-elementor-widgets' )   => 'style_3',
						esc_html__( 'Grid With Text 2', 'consulting-elementor-widgets' ) => 'style_4',
						esc_html__( 'List', 'consulting-elementor-widgets' )             => 'style_5',
					)
				),
			)
		);

		$this->add_control(
			'hover_type_1',
			array(
				'label'     => esc_html__( 'Hover Type', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'slide_on_top_and_bottom',
				'options'   => array_flip(
					array(
						esc_html__( 'Slide On Top and Bottom', 'consulting-elementor-widgets' ) => 'slide_on_top_and_bottom',
						esc_html__( 'Slide In Up', 'consulting-elementor-widgets' )             => 'slide_in_up',
						esc_html__( 'Slide In Right', 'consulting-elementor-widgets' )          => 'slide_in_right',
						esc_html__( 'Overlay Bordered', 'consulting-elementor-widgets' )        => 'overlay_bordered',
					)
				),
				'condition' => array(
					'style' => array( 'style_1', 'style_2' ),
				),
			)
		);

		$this->add_control(
			'hover_type_2',
			array(
				'label'     => esc_html__( 'Hover Type', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'zoom',
				'options'   => array_flip(
					array(
						esc_html__( 'Zoom', 'consulting-elementor-widgets' )           => 'zoom',
						esc_html__( 'Zoom and Plus', 'consulting-elementor-widgets' )  => 'zoom_and_plus',
						esc_html__( 'Read More Icon', 'consulting-elementor-widgets' ) => 'more_icon',
					)
				),
				'condition' => array(
					'style' => array( 'style_3', 'style_5' ),
				),
			)
		);

		$this->add_control(
			'hover_type_3',
			array(
				'label'     => esc_html__( 'Hover Type', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'zoom',
				'options'   => array_flip(
					array(
						esc_html__( 'Zoom', 'consulting-elementor-widgets' )          => 'zoom',
						esc_html__( 'Zoom and Plus', 'consulting-elementor-widgets' ) => 'zoom_and_plus',
					)
				),
				'condition' => array(
					'style' => array( 'style_4' ),
				),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'   => esc_html__( 'Posts Per page', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
			)
		);

		$this->add_control(
			'image_overlay_color',
			array(
				'label'     => esc_html__( 'Image Overlay Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_thumbnail:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio.style_1 .portfolio_item .portfolio_link:before'   => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'box_bg_color',
			array(
				'label'     => esc_html__( 'Box Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .hover_slide_in_up .portfolio_item .portfolio_item_thumbnail .portfolio_link .portfolio_info' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'hover_type_1' => 'slide_in_up',
				),
			)
		);

		$this->add_responsive_control(
			'column_count',
			array(
				'label'     => esc_html__( 'Columns Count', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					'1' => esc_html__( '1', 'consulting-elementor-widgets' ),
					'2' => esc_html__( '2', 'consulting-elementor-widgets' ),
					'3' => esc_html__( '3', 'consulting-elementor-widgets' ),
					'4' => esc_html__( '4', 'consulting-elementor-widgets' ),
				),
				'devices' => array( 'desktop' ),
				'default'   => '3',
				'condition' => array(
					'style' => array( 'style_2', 'style_3', 'style_4' ),
				),
			)
		);

		$this->add_responsive_control(
			'space_between_items',
			array(
				'label'      => esc_html__( 'Space Between Items', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting_elementor_portfolio:not(.style_1) .portfolio_item' => 'padding: calc({{TOP}}{{UNIT}}/2) calc({{RIGHT}}{{UNIT}}/2) calc({{BOTTOM}}{{UNIT}}/2) calc({{LEFT}}{{UNIT}}/2);',
					'{{WRAPPER}} .consulting_portfolio_grid:not(.style_1)'                      => 'margin-left:calc(-{{LEFT}}{{UNIT}} + 5px);margin-right:calc(-{{RIGHT}}{{UNIT}} + 5px);padding-left: calc({{LEFT}}{{UNIT}}/2 - 5px);padding-right: calc({{RIGHT}}{{UNIT}}/2 - 5px);',
					'{{WRAPPER}} .consulting_portfolio_grid.style_1'                            => 'gap: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'layout!' => 'style_5',
				),
			)
		);

		$this->add_control(
			'category_filter_enable',
			array(
				'label'        => esc_html__( 'Show Category Filter', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'portfolio_category' => array( 'all' ),
				),
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'filter_alignment',
			array(
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'label'     => esc_html__( 'Category Filter Alignment', 'consulting-elementor-widgets' ),
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .category_filter' => 'justify-content: {{VALUE}}',
				),
				'condition' => array(
					'category_filter_enable' => 'yes',
				),
			)
		);

		$this->add_control(
			'filter_color',
			array(
				'label'     => esc_html__( 'Category Filter Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .category_filter .filter_item_wrapper .filter_item' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'category_filter_enable' => 'yes',
				),
			)
		);

		$this->add_control(
			'filter_active_color',
			array(
				'label'     => esc_html__( 'Category Filter Active Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .category_filter .filter_item_wrapper .filter_item.active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting_portfolio_box .category_filter .filter_item_wrapper .filter_item:hover'  => 'color: {{VALUE}}',
				),
				'condition' => array(
					'category_filter_enable' => 'yes',
				),
			)
		);

		$this->add_control(
			'pagination_type',
			array(
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => esc_html__( 'Pagination Type', 'consulting-elementor-widgets' ),
				'options'   => array(
					'none'         => esc_html__( 'None', 'consulting-elementor-widgets' ),
					'load_more'    => esc_html__( 'Load More Button', 'consulting-elementor-widgets' ),
					'page_numbers' => esc_html__( 'Page Numbers', 'consulting-elementor-widgets' ),
				),
				'default'   => 'none',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'load_more_alignment',
			array(
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'label'     => esc_html__( 'Button Alignment', 'consulting-elementor-widgets' ),
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box' => 'text-align: {{VALUE}}',
				),
				'condition' => array(
					'pagination_type' => 'load_more',
				),
			)
		);

		$this->add_control(
			'load_more_icon',
			array(
				'label'       => esc_html__( 'Icon', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'skin'        => 'inline',
				'default'     => array(
					'value'   => 'stm-lnr-refresh',
					'library' => 'stm-icons',
				),
				'condition'   => array(
					'pagination_type' => 'load_more',
				),
				'label_block' => false,
			)
		);

		$this->add_responsive_control(
			'load_more_icon_size',
			array(
				'label'     => esc_html__( 'Icon Size', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'selectors' => array(
					'{{WRAPPER}} .load_more_button_box .portfolio_load_more_button .load_more_icon i' => 'font-size: {{VALUE}}px;',
					'{{WRAPPER}} .load_more_button_box .portfolio_load_more_button .load_more_icon'   => 'font-size: {{VALUE}}px;',
				),
				'condition' => array(
					'load_more_icon[value]!' => '',
					'pagination_type'        => 'load_more',
				),
			)
		);

		$this->add_control(
			'load_more_icon_position',
			array(
				'label'     => esc_html__( 'Icon Position', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => array(
					'before' => esc_html__( 'Before', 'consulting-elementor-widgets' ),
					'after'  => esc_html__( 'After', 'consulting-elementor-widgets' ),
				),
				'condition' => array(
					'load_more_icon[value]!' => '',
					'pagination_type'        => 'load_more',
				),
				'default'   => 'before',
			)
		);

		$this->add_responsive_control(
			'load_more_icon_space',
			array(
				'label'      => esc_html__( 'Icon Spacing', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .portfolio_load_more_button .load_more_icon.icon_before' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .portfolio_load_more_button .load_more_icon.icon_after'  => 'padding-left: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'load_more_icon[value]!' => '',
					'pagination_type'        => 'load_more',
				),
			)
		);

		$this->add_control(
			'page_numbers_alignment',
			array(
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'label'     => esc_html__( 'Page Numbers Alignment', 'consulting-elementor-widgets' ),
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} ul.page-numbers' => 'justify-content: {{VALUE}}',
				),
				'condition' => array(
					'pagination_type' => 'page_numbers',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'text_section',
			array(
				'label' => esc_html__( 'Text', 'consulting-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_thumbnail .portfolio_link .portfolio_info' => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_link .portfolio_info'                           => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_wrapper .portfolio_info'                   => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_title'                                          => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Title Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item:hover .portfolio_info'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item:hover .portfolio_title' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => array( 'style_3', 'style_5', 'style_4' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Title Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_thumbnail .portfolio_link .portfolio_info, {{WRAPPER}} .consulting_elementor_portfolio .portfolio_item .portfolio_info_wrapper .portfolio_title, {{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_link .portfolio_info, {{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_wrapper .portfolio_info',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'     => esc_html__( 'Category Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_category_wrapper'                                                          => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_thumbnail .portfolio_link .portfolio_info .portfolio_category'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_link .portfolio_info .portfolio_category'                                  => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_wrapper .portfolio_link .portfolio_category'                          => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_thumbnail .portfolio_link .portfolio_info .portfolio_category:before' => 'background-color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'category_hover_color',
			array(
				'label'     => esc_html__( 'Category Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item:hover .portfolio_category_wrapper'                                                           => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_wrapper .portfolio_link:hover .portfolio_category' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => array( 'style_3', 'style_5', 'style_4' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_typography',
				'label'    => esc_html__( 'Category Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_info_wrapper .portfolio_category_wrapper, {{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_thumbnail .portfolio_link .portfolio_info .portfolio_category, {{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_link .portfolio_info .portfolio_category, {{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_item .portfolio_item_wrapper .portfolio_link .portfolio_category',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_responsive_control(
			'title_margin_bottom',
			array(
				'label'     => esc_html__( 'Title And Category Spacing', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'max'       => 100,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio.hover_slide_on_top_and_bottom .portfolio_item .portfolio_item_thumbnail .portfolio_link .portfolio_info .portfolio_category' => 'padding-top: {{VALUE}}px;',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio.hover_slide_in_right .portfolio_item .portfolio_item_thumbnail .portfolio_link .portfolio_info .portfolio_category'          => 'padding-top: {{VALUE}}px;',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio.hover_slide_in_up .portfolio_item .portfolio_link .portfolio_info .portfolio_category'                                       => 'padding-bottom: {{VALUE}}px;',
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio.hover_overlay_bordered .portfolio_item .portfolio_link .portfolio_info .portfolio_category'                                  => 'padding-bottom: {{VALUE}}px;',
				),
			)
		);

		$this->add_control(
			'category_box_bg_color',
			array(
				'label'     => esc_html__( 'Category Box Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item .portfolio_info_wrapper .portfolio_category_wrapper'                   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item .portfolio_item_wrapper .portfolio_item_thumbnail .portfolio_category' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'style' => array( 'style_5', 'style_4' ),
				),
			)
		);

		$this->add_control(
			'category_box_border_radius',
			array(
				'label'     => esc_html__( 'Category Box Border Radius', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item .portfolio_info_wrapper .portfolio_category_wrapper'                   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item .portfolio_item_wrapper .portfolio_item_thumbnail .portfolio_category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'style' => array( 'style_5', 'style_4' ),
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Description Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item .portfolio_info_wrapper .portfolio_description' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => array( 'style_5' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'consulting-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item .portfolio_info_wrapper .portfolio_description',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'condition' => array(
					'style' => array( 'style_5' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_style',
			array(
				'label' => esc_html__( 'Image', 'consulting-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'     => esc_html__( 'Image Border Radius', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .portfolio_item_thumbnail img'                                             => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .portfolio_item_thumbnail'                                                 => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .consulting_portfolio_grid.style_1 .portfolio_item .portfolio_link img'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .consulting_portfolio_grid.style_1 .portfolio_item .portfolio_link:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			array(
				'label'     => esc_html__( 'Load More Button', 'consulting-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pagination_type' => 'load_more',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'load_more_button_typography',
				'label'    => esc_html__( 'Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'      => 'load_more_button_border',
				'selector'  => '{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'load_more_border_radius',
			array(
				'label'     => esc_html__( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'load_more_box_shadow',
				'selector' => '{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button',
			)
		);

		$this->start_controls_tabs(
			'load_more_style',
			array(
				'separator' => 'before',
			)
		);

		$this->start_controls_tab(
			'style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'load_more_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'load_more_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio_load_more_button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'load_more_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .portfolio_load_more_button' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'load_more_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .load_more_button_box .portfolio_load_more_button .load_more_icon' => 'color: {{VALUE}};',
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
			'load_more_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'load_more_bg_hover_color',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'load_more_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'load_more_icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .load_more_button_box .portfolio_load_more_button:hover .load_more_icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'load_more_button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting_portfolio_box .portfolio_load_more_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'page_numbers_style',
			array(
				'label'     => esc_html__( 'Page Numbers', 'consulting-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pagination_type' => 'page_numbers',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'page_numbers_typography',
				'label'    => esc_html__( 'Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .consulting_portfolio_box ul.page-numbers .page-numbers',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_control(
			'page_numbers_border_radius',
			array(
				'label'     => esc_html__( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box ul.page-numbers .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'page_numbers_tabs',
			array(
				'separator' => 'before',
			)
		);

		$this->start_controls_tab(
			'page_numbers_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'page_numbers_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box ul.page-numbers .page-numbers' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'page_numbers_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box ul.page-numbers .page-numbers' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'page_numbers_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box ul.page-numbers .page-numbers' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'page_numbers_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'page_numbers_hover_text_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box ul.page-numbers .page-numbers:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'page_numbers_bg_hover_color',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box ul.page-numbers .page-numbers:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'page_numbers_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box ul.page-numbers .page-numbers:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'read_more_button_style',
			array(
				'label'     => esc_html__( 'Read More Button', 'consulting-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => array( 'style_5', 'style_4' ),
				),
			)
		);

		$this->add_control(
			'read_more_icon',
			array(
				'label'       => esc_html__( 'Icon', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'skin'        => 'inline',
				'default'     => array(
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				),
				'label_block' => false,
			)
		);

		$this->add_control(
			'read_more_icon_size',
			array(
				'label'      => __( 'Icon Size', 'consulting-elementor-widgets' ),
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
					'{{WRAPPER}} .portfolio_item .portfolio_read_more_button svg.read_more_icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .portfolio_item .portfolio_read_more_button i.read_more_icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default' => array(
					'unit' => 'px',
					'size' => 25,
				),
			)
		);

		$this->add_responsive_control(
			'read_more_icon_spacing',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box:not(.rtl) .consulting_elementor_portfolio .portfolio_item .portfolio_read_more_button .read_more_icon' => 'padding-left: {{VALUE}}px;',
					'{{WRAPPER}} .consulting_portfolio_box.rtl .consulting_elementor_portfolio .portfolio_item .portfolio_read_more_button .read_more_icon' => 'padding-right: {{VALUE}}px;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'read_more_button_typography',
				'label'    => esc_html__( 'Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .consulting_elementor_portfolio .portfolio_item .portfolio_info_wrapper .portfolio_read_more_button',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'      => 'read_more_button_border',
				'selector'  => '{{WRAPPER}} .portfolio_read_more_button',
				'separator' => 'before',
				'exclude'   => array( 'color' ),
			)
		);

		$this->add_control(
			'read_more_border_radius',
			array(
				'label'     => esc_html__( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .portfolio_read_more_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'read_more_box_shadow',
				'selector' => '{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button',
			)
		);

		$this->start_controls_tabs(
			'read_more_style',
			array(
				'separator' => 'before',
			)
		);

		$this->start_controls_tab(
			'read_style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'read_more_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'read_more_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'read_more_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'read_more_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button .read_more_icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'read_style_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'read_more_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'read_more_bg_hover_color',
			array(
				'label'     => esc_html__( 'Background Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'read_more_border_hover_color',
			array(
				'label'     => esc_html__( 'Border Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'read_more_icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button:hover .read_more_icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'read_more_button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting_portfolio_box .consulting_elementor_portfolio .portfolio_read_more_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();
	}

	protected function render() {

		$post_paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$settings              = $this->get_settings_for_display();
		$settings['css_class'] = ' consulting_elementor_portfolio';

		$args = array(
			'post_type'      => 'stm_portfolio',
			'posts_per_page' => $settings['posts_per_page'],
			'paged'          => $post_paged,
		);

		if ( 'all' !== $settings['portfolio_category'] ) {
			$args['stm_portfolio_category'] = $settings['portfolio_category'];
		}

		$portfolio = new WP_Query( $args );

		$count_posts     = wp_count_posts( 'stm_portfolio' );
		$published_posts = $count_posts->publish;

		$settings['css_class'] .= ' ' . $settings['style'];

		if ( $settings['hover_type_1'] ) {
			$settings['css_class'] .= ' hover_' . $settings['hover_type_1'];
		} elseif ( $settings['hover_type_2'] ) {
			$settings['css_class'] .= ' hover_' . $settings['hover_type_2'];
		} elseif ( $settings['hover_type_3'] ) {
			$settings['css_class'] .= ' hover_' . $settings['hover_type_3'];
		}
		if ( $settings['column_count'] ) {
			$settings['css_class'] .= ' column-' . $settings['column_count'];
		}
		$i = 0;

		$portfolio_categories_array = get_terms( 'stm_portfolio_category' );
		$portfolio_categories       = array();
		if ( $portfolio_categories_array && ! is_wp_error( $portfolio_categories_array ) ) {
			foreach ( $portfolio_categories_array as $cat ) {
				$portfolio_categories[ $cat->name ] = $cat->slug;
			}
		}

		if ( $portfolio->have_posts() ) {
			?>
			<div class="consulting_portfolio_box <?php echo is_rtl() ? 'rtl' : ''; ?>">
				<?php if ( $settings['category_filter_enable'] ) { ?>
					<ul class="category_filter" data-load="<?php echo esc_attr( $settings['posts_per_page'] ); ?>"
							data-style="<?php echo esc_attr( $settings['style'] ); ?>">
						<li class="filter_item_wrapper">
							<a href="#"
									class="filter_item active"
									data-slug=""><?php echo esc_html__( 'All', 'consulting-elementor-widgets' ); ?></a>
						</li>
						<?php
						foreach ( $portfolio_categories as $name => $slug ) {
							?>
							<li class="filter_item_wrapper">
								<a href="#"
										class="filter_item"
										data-slug="<?php echo esc_attr( $slug ); ?>"><?php echo wp_kses_post( $name ); ?></a>
							</li>
							<?php
						}
						?>
					</ul>
				<?php } ?>
				<div class="consulting_portfolio_grid<?php echo esc_attr( $settings['css_class'] ); ?>">
					<?php
					while ( $portfolio->have_posts() ) {
						$portfolio->the_post();
						set_query_var( 'i', $i );
						$settings['count'] = $i;
						stm_load_variations_template( $settings, '/portfolio/styles/' . $settings['style'] );
						$i ++;
						$post_cat = wp_get_post_terms( get_the_ID(), 'stm_portfolio_category' );
					}
					wp_reset_postdata();
					?>
				</div>
				<?php
				if ( 'page_numbers' === $settings['pagination_type'] ) {
					consulting_paging_nav( 'paging_view_posts-list', $portfolio );
				}
				if ( 'all' !== $settings['portfolio_category'] ) {
					if ( 'load_more' === $settings['pagination_type'] && $settings['posts_per_page'] < $post_cat[0]->count ) {
						?>
						<div class="load_more_button_box">
							<a href="#" data-page="1" data-load="<?php echo esc_attr( $settings['posts_per_page'] ); ?>"
									data-category="<?php echo esc_attr( $settings['portfolio_category'] ); ?>"
									data-style="<?php echo esc_attr( $settings['style'] ); ?>"
									data-count="<?php echo esc_attr( $settings['count'] ); ?>"
									class="portfolio_load_more_button">
							<span class="load_more_icon_wrapper">
							<?php
							if ( $settings['load_more_icon'] && 'after' === $settings['load_more_icon_position'] ) {
								?>
								<span class="load_more_icon_text">
										<?php esc_html_e( 'Load more', 'consulting-elementor-widgets' ); ?>
								</span>
								<span class="load_more_icon icon_after">
										<?php
										\Elementor\Icons_Manager::render_icon(
											$settings['load_more_icon'],
											array(
												'aria-hidden' => 'true',
											)
										);
										?>
								</span>
								<?php
							} else {
								?>
								<span class="load_more_icon icon_before">
										<?php
										\Elementor\Icons_Manager::render_icon(
											$settings['load_more_icon'],
											array(
												'aria-hidden' => 'true',
											)
										);
										?>
									</span>
								<span class="load_more_icon_text">
										<?php esc_html_e( 'Load more', 'consulting-elementor-widgets' ); ?>
								</span>
								<?php
							}
							?>
							</span>
							</a>
						</div>
						<?php
					}
				} else {
					if ( 'load_more' === $settings['pagination_type'] && $settings['posts_per_page'] < $published_posts ) {
						?>
						<div class="load_more_button_box">
							<a href="#" data-page="1" data-load="<?php echo esc_attr( $settings['posts_per_page'] ); ?>"
									data-category="<?php echo esc_attr( $settings['portfolio_category'] ); ?>"
									data-style="<?php echo esc_attr( $settings['style'] ); ?>"
									data-count="<?php echo esc_attr( $i ); ?>"
									class="portfolio_load_more_button">
							<span class="load_more_icon_wrapper">
							<?php
							if ( $settings['load_more_icon'] && 'after' === $settings['load_more_icon_position'] ) {
								?>
								<span class="load_more_icon_text">
										<?php esc_html_e( 'Load more', 'consulting-elementor-widgets' ); ?>
								</span>
								<span class="load_more_icon icon_after">
										<?php
										\Elementor\Icons_Manager::render_icon(
											$settings['load_more_icon'],
											array(
												'aria-hidden' => 'true',
											)
										);
										?>
								</span>
								<?php
							} else {
								?>
								<span class="load_more_icon icon_before">
										<?php
										\Elementor\Icons_Manager::render_icon(
											$settings['load_more_icon'],
											array(
												'aria-hidden' => 'true',
											)
										);
										?>
									</span>
								<span class="load_more_icon_text">
										<?php esc_html_e( 'Load more', 'consulting-elementor-widgets' ); ?>
								</span>
								<?php
							}
							?>
							</span>
							</a>
						</div>
						<?php
					}
				}
				?>
			</div>
			<?php
		}
	}
}
