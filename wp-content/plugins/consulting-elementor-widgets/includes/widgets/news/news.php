<?php

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;

class Elementor_STM_News extends \Elementor\Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_style( 'consulting-news-general', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/news/general.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-news-grid', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/news/grid.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-news-date-boxed', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/news/date_boxed.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-news-date-boxed-two', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/news/date_boxed_two.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-news-side-image', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/news/side_image.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-news-list', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/news/list.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-news-full-image', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/news/full_image.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_style( 'consulting-news-overlay-image', CONSULTING_ELEMENTOR_URL . 'assets/css/widgets/news/overlay_image.css', array(), CONSULTING_ELEMENTOR_VERSION, false );
		wp_register_script( 'consulting-news-js', CONSULTING_ELEMENTOR_URL . 'assets/js/widgets/news.js', array( 'elementor-frontend', 'isotope' ), CONSULTING_ELEMENTOR_VERSION, true );
	}

	public function get_name() {
		return 'stm_news';
	}

	public function get_title() {
		return esc_html__( 'Posts', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-posts';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	public function get_script_depends() {
		return array( 'isotope', 'packery', 'imagesloaded', 'consulting-news-js' );
	}

	public function get_style_depends() {
		return array(
			'consulting-news-general',
			'consulting-news-grid',
			'consulting-news-date-boxed',
			'consulting-news-date-boxed-two',
			'consulting-news-side-image',
			'consulting-news-list',
			'consulting-news-full-image',
			'consulting-news-overlay-image',
		);
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
				'label' => __( 'General', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'view_style',
			array(
				'label'   => __( 'Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array_flip(
					array(
						__( 'Grid', 'consulting-elementor-widgets' )          => 'grid',
						__( 'Date Boxed', 'consulting-elementor-widgets' )    => 'date_boxed',
						__( 'Date Boxed 2', 'consulting-elementor-widgets' )  => 'date_boxed_two',
						__( 'Side Image', 'consulting-elementor-widgets' )    => 'side_image',
						__( 'List', 'consulting-elementor-widgets' )          => 'list',
						__( 'Full Image', 'consulting-elementor-widgets' )    => 'full_image',
						__( 'Overlay Image', 'consulting-elementor-widgets' ) => 'overlay_image',
						__( 'Old Style 1', 'consulting-elementor-widgets' )   => 'style_1',
						__( 'Old Style 2', 'consulting-elementor-widgets' )   => 'style_2',
						__( 'Old Style 3', 'consulting-elementor-widgets' )   => 'style_3',
						__( 'Old Style 4', 'consulting-elementor-widgets' )   => 'style_4',
						__( 'Old Style 5', 'consulting-elementor-widgets' )   => 'style_5',
						__( 'Old Style 6', 'consulting-elementor-widgets' )   => 'style_6',
						__( 'Old Style 7', 'consulting-elementor-widgets' )   => 'style_7',
						__( 'Old Style 8', 'consulting-elementor-widgets' )   => 'style_8',
					)
				),
			)
		);

		$this->add_control(
			'style_appearance',
			array(
				'label'     => __( 'Appearance', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'grid',
				'options'   => array_flip(
					array(
						__( 'Grid', 'consulting-elementor-widgets' )    => 'grid',
						__( 'Masonry', 'consulting-elementor-widgets' ) => 'masonry',
					)
				),
				'condition' => array(
					'view_style' => 'full_image',
				),
			)
		);

		$this->add_control(
			'posts_per_row',
			array(
				'label'     => __( 'Number of Columns', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 3,
				'options'   => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'description' => __( 'Note: Some styles are adapted to the full-width section for 4 columns', 'consulting-elementor-widgets' ),
				'condition' => array(
					'view_style' => array(
						'style_1',
						'style_2',
						'style_7',
						'grid',
						'date_boxed',
						'date_boxed_two',
						'full_image',
						'overlay_image',
					),
				),
			)
		);

		$this->add_control(
			'content_alignment',
			array(
				'label'     => __( 'Content Alignment', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => false,
				'condition' => array(
					'view_style' => 'grid',
				),
			)
		);

		$this->add_control(
			'show_image',
			array(
				'label'        => __( 'Image', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'consulting-elementor-widgets' ),
				'label_off'    => __( 'Hide', 'consulting-elementor-widgets' ),
				'default'      => 'show',
				'return_value' => 'show',
				'condition'    => array(
					'view_style' => array( 'grid', 'side_image', 'list' ),
				),
			)
		);

		$this->add_control(
			'show_category',
			array(
				'label'        => __( 'Category', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'consulting-elementor-widgets' ),
				'label_off'    => __( 'Hide', 'consulting-elementor-widgets' ),
				'default'      => 'show',
				'return_value' => 'show',
				'condition'    => array(
					'view_style' => array(
						'grid',
						'date_boxed',
						'date_boxed_two',
						'side_image',
						'list',
						'full_image',
						'overlay_image',
					),
				),
			)
		);

		$this->add_control(
			'disable_preview_image',
			array(
				'label'        => __( 'Disable Image', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'disable',
				'condition'    => array(
					'view_style' => array(
						'style_1',
						'style_2',
						'style_3',
						'style_4',
						'style_5',
						'style_6',
						'style_7',
					),
				),
			)
		);

		$this->add_control(
			'img_size',
			array(
				'label'       => __( 'Image Size', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting-elementor-widgets' ),
				'condition'   => array(
					'view_style' => array(
						'style_1',
						'style_2',
						'style_3',
						'style_4',
						'style_5',
						'style_6',
						'style_7',
					),
				),
			)
		);

		$this->add_control(
			'disable_excerpt',
			array(
				'label'        => __( 'Short Description', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'consulting-elementor-widgets' ),
				'label_off'    => __( 'Hide', 'consulting-elementor-widgets' ),
				'default'      => 'show',
				'return_value' => 'show',
				'condition'    => array(
					'view_style' => array( 'grid', 'date_boxed', 'list' ),
				),
			)
		);

		$this->add_control(
			'show_date',
			array(
				'label'        => __( 'Date', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'consulting-elementor-widgets' ),
				'label_off'    => __( 'Hide', 'consulting-elementor-widgets' ),
				'default'      => 'show',
				'return_value' => 'show',
				'condition'    => array(
					'view_style' => array( 'grid', 'side_image', 'list' ),
				),
			)
		);

		$this->add_control(
			'show_title_line',
			array(
				'label'     => __( 'Title Line', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'under_title',
				'options'   => array(
					'none'        => __( 'No', 'consulting-elementor-widgets' ),
					'above_title' => __( 'Above Title', 'consulting-elementor-widgets' ),
					'under_title' => __( 'Under Title', 'consulting-elementor-widgets' ),
				),
				'condition' => array(
					'view_style' => array( 'grid', 'list', 'side_image' ),
				),
			)
		);

		$this->add_control(
			'disable_button',
			array(
				'label'        => __( 'Link Button', 'consulting-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'consulting-elementor-widgets' ),
				'label_off'    => __( 'Hide', 'consulting-elementor-widgets' ),
				'default'      => 'show',
				'return_value' => 'show',
				'condition'    => array(
					'view_style' => array(
						'grid',
						'date_boxed',
						'date_boxed_two',
						'side_image',
						'list',
						'full_image',
						'overlay_image',
					),
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Put Button Text', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => 'Read More',
				'condition' => array(
					'disable_button' => 'show',
					'view_style'     => array(
						'grid',
						'date_boxed',
						'date_boxed_two',
						'side_image',
						'list',
						'full_image',
						'overlay_image',
					),
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .consulting_posts .post_item .post_inner',
			)
		);

		if ( 'layout_16' === $consulting_layout || 'layout_17' === $consulting_layout ) {
			$this->add_control(
				'style',
				array(
					'label'   => __( 'Style', 'consulting-elementor-widgets' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 4,
					'options' => array(
						1 => 1,
						2 => 2,
					),
				)
			);
		}

		$this->end_controls_section();

		Consulting_Elementor_Widgets::add_query_builder( $this, 'qb' );

		$this->start_controls_section(
			'text_section',
			array(
				'label' => __( 'Text', 'consulting-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .post_inner .news_item_title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stm_news_unit-block h5 a'                 => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Title Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .post_inner .news_item_title a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stm_news_unit-block h5 a:hover'                 => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'consulting-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .consulting_posts .post_item .post_inner .news_item_title, {{WRAPPER}} .stm_news_unit-block h5',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Title Margin', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .post_inner .news_item_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .stm_news_unit-block h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'     => __( 'Category Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_posts .post_item .post_inner .category a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting_posts .post_item .post_inner .category'   => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_category' => 'show',
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'category_typography',
				'label'     => __( 'Category Typography', 'consulting-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .post_item .post_inner .category a',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'condition' => array(
					'show_category' => 'show',
				),
			)
		);

		$this->add_responsive_control(
			'category_margin',
			array(
				'label'      => __( 'Category Margin', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .post_inner .category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'show_category' => 'show',
				),
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label'     => __( 'Short Description Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_info p' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'disable_excerpt' => 'show',
					'view_style'      => array( 'grid', 'date_boxed', 'list' ),
				),
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'excerpt_typography',
				'label'     => __( 'Short Description Typography', 'consulting-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .post_item .news_info p',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'condition' => array(
					'disable_excerpt' => 'show',
					'view_style'      => array( 'grid', 'date_boxed', 'list' ),
				),
			)
		);

		$this->add_responsive_control(
			'excerpt_margin',
			array(
				'label'      => __( 'Short Description Margin', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .news_info p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'disable_excerpt' => 'show',
					'view_style'      => array( 'grid', 'date_boxed', 'list' ),
				),
			)
		);

		$this->add_control(
			'date_color',
			array(
				'label'     => __( 'Date Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_date'               => 'color: {{VALUE}}',
					'{{WRAPPER}} .post_item .post_inner .image .date-wrap' => 'color: {{VALUE}}',
					'{{WRAPPER}} .post_item .post_inner .date-wrap' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_date'  => 'show',
					'view_style' => array(
						'grid',
						'date_boxed',
						'date_boxed_two',
						'side_image',
						'list',
						'full_image',
						'overlay_image',
					),
				),
				'separator' => 'before',
			)
		);

		$this->add_control(
			'date_icon_color',
			array(
				'label'     => __( 'Date Icon Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_posts .post_item .post_inner .date:before' => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting_posts .post_item .post_inner .date:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .post_item .post_inner .image .date-wrap:before' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_date'  => 'show',
					'view_style' => array(
						'grid',
						'side_image',
						'list',
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'date_typography',
				'label'     => __( 'Date Typography', 'consulting-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .post_item .post_inner .news_item_date, {{WRAPPER}} .post_item .post_inner .image .date-wrap, {{WRAPPER}} .post_item .post_inner .date-wrap',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'condition' => array(
					'show_date'  => 'show',
					'view_style' => array(
						'grid',
						'date_boxed',
						'date_boxed_two',
						'side_image',
						'list',
						'full_image',
						'overlay_image',
					),
				),
			)
		);

		$this->add_control(
			'date_icon_position',
			array(
				'label'     => __( 'Date Icon Position', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'before',
				'options'   => array(
					'none'   => __( 'No', 'consulting-elementor-widgets' ),
					'before' => __( 'Before', 'consulting-elementor-widgets' ),
					'after'  => __( 'After', 'consulting-elementor-widgets' ),
				),
				'condition' => array(
					'view_style' => array( 'grid', 'list', 'side_image' ),
					'show_date' => 'show',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'image_section',
			array(
				'label'     => __( 'Image', 'consulting-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_image' => 'show',
					'view_style' => array(
						'grid',
						'date_boxed',
						'date_boxed_two',
						'side_image',
						'list',
						'full_image',
						'overlay_image',
					),
				),
			)
		);

		$this->add_control(
			'image_size',
			array(
				'label'       => __( 'Image Size', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter image size. Example: "thumbnail", "medium", "large", "full" or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use default size.', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			array(
				'name'           => 'overlay_color',
				'types'          => array( 'classic', 'gradient', 'video' ),
				'exclude'        => array( 'image' ),
				'selector'       => '{{WRAPPER}} .post_item .post_inner .image:before, {{WRAPPER}} .post_item .post_inner .image a:before',
				'condition'      => array(
					'view_style!' => 'date_boxed_two',
				),
				'fields_options' => array(
					'color'      => array(
						'label' => __( 'Hover Overlay Color', 'consulting-elementor-widgets' ),
					),
					'background' => array(
						'label' => __( 'Hover Overlay Type', 'consulting-elementor-widgets' ),
					),
				),
			)
		);

		$this->add_control(
			'image_overlay_hover_color',
			array(
				'label'     => __( 'Overlay Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_posts .post_item .img-wrap .news_item_button' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'view_style'     => 'date_boxed_two',
					'disable_button' => 'show',
				),
			)
		);

		$this->add_responsive_control(
			'img_border_radius',
			array(
				'label'      => __( 'Image Border Radius', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .post_inner .image img'      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .grid .post_item .post_inner,{{WRAPPER}} .date_boxed .post_item .post_inner,{{WRAPPER}} .date_boxed_two .post_item .post_inner'      => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{TOP}}{{UNIT}}',
					'{{WRAPPER}} .post_item .post_inner .image a:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .date_boxed_two .post_item .post_inner img, {{WRAPPER}} .date_boxed_two .post_item .post_inner .news_item_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .post_item .post_inner .img-wrap'       => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .full_image .post_item .post_inner'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'date_box_section',
			array(
				'label'     => __( 'Date Box', 'consulting-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'view_style' => array( 'date_boxed', 'date_boxed_two', 'full_image', 'overlay_image' ),
				),
			)
		);

		$this->add_control(
			'date_box_bg_color',
			array(
				'label'     => __( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_posts .post_item .post_inner .date-wrap' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'date_box_bg_hover_color',
			array(
				'label'     => __( 'Background Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_posts .post_item:hover .post_inner .date-wrap' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'date_box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .post_inner .date-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'date_box_alignment',
			array(
				'label'     => __( 'Date Box Alignment', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => false,
				'condition' => array(
					'view_style' => 'date_boxed',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_line_section',
			array(
				'label'     => __( 'Title Line', 'consulting-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_title_line!' => 'none',
					'view_style'       => array( 'grid', 'side_image', 'list' ),
				),
			)
		);

		$this->add_control(
			'title_line_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:after'  => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'show_title_line!' => 'none',
				),
			)
		);

		$this->add_control(
			'title_line_width',
			array(
				'label'     => __( 'Width (%)', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:before' => 'width: {{VALUE}}%',
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:after'  => 'width: {{VALUE}}%',
				),
			)
		);

		$this->add_control(
			'title_line_height',
			array(
				'label'     => __( 'Height (px)', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:before' => 'height: {{VALUE}}px',
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:after'  => 'height: {{VALUE}}px',
				),
			)
		);

		$this->add_control(
			'title_line_border_radius',
			array(
				'label'      => __( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .post_inner .news_item_title:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .post_item .post_inner .news_item_title:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->add_control(
			'title_line_margin_top',
			array(
				'label'     => __( 'Margin Top (px)', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:before' => 'margin-top: {{VALUE}}px',
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:after'  => 'margin-top: {{VALUE}}px',
				),
			)
		);

		$this->add_control(
			'title_line_margin_bottom',
			array(
				'label'     => __( 'Margin Bottom (px)', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:before' => 'margin-bottom: {{VALUE}}px',
					'{{WRAPPER}} .post_item .news_item_info .news_item_title:after'  => 'margin-bottom: {{VALUE}}px',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box_section',
			array(
				'label'     => __( 'Box', 'consulting-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'view_style' => array( 'grid', 'date_boxed', 'date_boxed_two', 'side_image', 'list' ),
				),
			)
		);

		$this->add_control(
			'box_bg_color',
			array(
				'label'     => __( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .post_inner' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'box_border',
				'selector' => '{{WRAPPER}} .post_inner',
			)
		);

		$this->add_control(
			'box_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting_posts_box .consulting_posts .post_item .post_inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Content Padding', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting_posts_box .consulting_posts .post_item .news_item_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_section',
			array(
				'label'     => __( 'Button', 'consulting-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'view_style' => array(
						'grid',
						'date_boxed',
						'date_boxed_two',
						'side_image',
						'list',
						'full_image',
						'overlay_image',
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'label'     => __( 'Typography', 'consulting-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .post_item .news_item_info .news_item_button, {{WRAPPER}} .post_item .post_inner .news_item_button',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'separator' => 'after',
			)
		);

		$this->add_control(
			'button_icon',
			array(
				'label'       => esc_html__( 'Icon', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'skin'        => 'inline',
				'default'     => array(
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				),
				'label_block' => false,
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'button_icon_size',
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
					'{{WRAPPER}} .post_item .news_item_button svg.button_icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .post_item .news_item_button i.button_icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'default' => array(
					'unit' => 'px',
					'size' => 20,
				),
			)
		);

		$this->add_control(
			'button_icon_position',
			array(
				'label'   => __( 'Icon Position', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'before' => __( 'Before', 'consulting-elementor-widgets' ),
					'after'  => __( 'After', 'consulting-elementor-widgets' ),
				),
				'default' => 'after',
			)
		);

		$this->add_control(
			'button_icon_spacing',
			array(
				'label'      => __( 'Icon Spacing', 'consulting-elementor-widgets' ),
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
					'{{WRAPPER}} .post_item .news_item_button .before_icon' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .post_item .news_item_button .after_icon'  => 'margin-left: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'button_icon_padding',
			array(
				'label'      => __( 'Icon Padding', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .post_inner .news_item_button .button_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_icon_radius',
			array(
				'label'      => __( 'Icon Border Radius', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .post_inner .news_item_button .button_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .post_item .news_item_button',
				'exclude'  => array( 'color' ),
			)
		);

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .news_item_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .post_item .news_item_button',
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem', 'custom' ),
				'selectors'  => array(
					'{{WRAPPER}} .post_item .news_item_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->start_controls_tabs(
			'button_colors'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_posts .post_item .post_inner .news_item_button' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_bg_color',
			array(
				'label'     => __( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .post_inner .news_item_button' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'view_style!' => 'date_boxed_two',
				),
			)
		);

		$this->add_control(
			'button_icon_color',
			array(
				'label'     => __( 'Icon Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_posts .post_item .post_inner .news_item_button .button_icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_icon_bg_color',
			array(
				'label'     => __( 'Icon Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_button .button_icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'     => __( 'Border Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_button' => 'border-color: {{VALUE}}',
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
			'button_text_hover_color',
			array(
				'label'     => __( 'Text Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_button:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_bg_hover_color',
			array(
				'label'     => __( 'Background Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_button:hover' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'view_style!' => 'date_boxed_two',
				),
			)
		);

		$this->add_control(
			'button_icon_hover_color',
			array(
				'label'     => __( 'Icon Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_button:hover .button_icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_icon_hover_bg_color',
			array(
				'label'     => __( 'Icon Hover Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_button:hover .button_icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => __( 'Border Hover Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .post_item .news_item_button:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {

		$settings          = $this->get_settings_for_display();
		$settings['query'] = Consulting_Elementor_Widgets::get_query_builder( $settings, 'qb' );
		$i                 = 0;

		if ( false !== strpos( $settings['view_style'], 'style' ) ) {
			if ( function_exists( 'consulting_show_template' ) ) {
				$settings = $this->get_settings_for_display();

				$settings['css_class'] = ' consulting_elementor_posts';

				$settings['query'] = Consulting_Elementor_Widgets::get_query_builder( $settings, 'qb' );

				consulting_load_vc_element( 'news', $settings, $settings['view_style'] );
			}
		} else {
			if ( $settings['query']->have_posts() ) {
				?>
				<div class="consulting_posts_box consulting_elementor_posts
				<?php
				echo esc_attr( $settings['view_style'] );
				if ( isset( $settings['style_appearance'] ) ) {
					echo ' appearance_' . esc_attr( $settings['style_appearance'] );
				}
				?>
				">
					<ul class="consulting_posts posts_per_row_<?php echo esc_attr( $settings['posts_per_row'] ); ?>">
						<?php
						while ( $settings['query']->have_posts() ) {
							set_query_var( 'i', $i );
							$settings['count'] = $i;
							$settings['query']->the_post();
							stm_load_variations_template( $settings, '/news/styles/' . $settings['view_style'] );
							$i ++;
						}
						wp_reset_postdata();
						?>
					</ul>
				</div>
				<?php
			}
		}
	}
}
