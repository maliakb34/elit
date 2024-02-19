<?php

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

class Elementor_STM_Iconboxes_With_Tabs extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_iconboxes_with_tabs';
	}

	public function get_title() {
		return esc_html__( 'Iconboxes with tabs', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-iconbox-tabs';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_0',
			array(
				'label' => __( 'Appearance', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'box_style',
			array(
				'label'   => __( 'Widget style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => array_flip(
					array(
						esc_html__( 'Style 1', 'consulting-elementor-widgets' ) => 'style_1',
						esc_html__( 'Style 2', 'consulting-elementor-widgets' ) => 'style_2',
					)
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_1',
			array(
				'label' => __( 'Tab 1', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'tab_id',
			array(
				'label'       => __( 'Unique ID', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Unique ID', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'tab_name',
			array(
				'label'       => __( 'Tab name', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter tab name', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'content_title',
			array(
				'label'     => __( 'Content info', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG,
				'default'   => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'consulting-elementor-widgets' ) . '</p>',
				'condition' => array(
					'box_style' => array( 'style_1' ),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icons',
			array(
				'label'   => __( 'Icons', 'text-domain' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'icon_info',
			array(
				'label'       => __( 'Enter your text', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter your text', 'consulting-elementor-widgets' ),
				'label_block' => true,
				'rows'        => 5,
			)
		);

		$this->add_control(
			'icon_sections',
			array(
				'label'       => __( 'Icon', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'title' => __( 'Icon 1', 'consulting-elementor-widgets' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_2',
			array(
				'label' => __( 'Tab 2', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'tab_id_2',
			array(
				'label'       => __( 'Unique ID', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Unique ID', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'tab_name_2',
			array(
				'label'       => __( 'Tab name', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter tab name', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'content_title_2',
			array(
				'label'     => __( 'Content info', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG,
				'default'   => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'consulting-elementor-widgets' ) . '</p>',
				'condition' => array(
					'box_style' => array( 'style_1' ),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icons',
			array(
				'label'   => __( 'Icons', 'text-domain' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'icon_info',
			array(
				'label'       => __( 'Enter your text', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter your text', 'consulting-elementor-widgets' ),
				'label_block' => true,
				'rows'        => 5,
			)
		);

		$this->add_control(
			'icon_sections_2',
			array(
				'label'       => __( 'Icon', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'title' => __( 'Icon 1', 'consulting-elementor-widgets' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_3',
			array(
				'label' => __( 'Tab 3', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'tab_id_3',
			array(
				'label'       => __( 'Unique ID', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Unique ID', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'tab_name_3',
			array(
				'label'       => __( 'Tab name', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter tab name', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'content_title_3',
			array(
				'label'     => __( 'Content info', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG,
				'default'   => '<p>' . esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'consulting-elementor-widgets' ) . '</p>',
				'condition' => array(
					'box_style' => array( 'style_1' ),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icons',
			array(
				'label'   => __( 'Icons', 'text-domain' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
			)
		);

		$repeater->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'consulting-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'icon_info',
			array(
				'label'       => __( 'Enter your text', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter your text', 'consulting-elementor-widgets' ),
				'label_block' => true,
				'rows'        => 5,
			)
		);

		$this->add_control(
			'icon_sections_3',
			array(
				'label'       => __( 'Icon', 'consulting-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'title' => __( 'Icon 1', 'consulting-elementor-widgets' ),
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		consulting_load_vc_element( 'iconboxes_with_tabs', $settings, $settings['box_style'] );
	}
}
