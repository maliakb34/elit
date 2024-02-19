<?php

use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Elementor_Header_Icon_Box extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_header_icon_box';
	}

	public function get_title() {
		return esc_html__( 'Consulting Icon Box', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-iconbox consulting_icon_hb';
	}

	public function get_categories() {
		return array( 'consulting-widgets' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
			)
		);

		$this->add_control(
			'icon_url',
			array(
				'label'         => __( 'URL (Link)', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'dynamic'       => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'icon_divider',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'title',
			array(
				'label' => __( 'Title', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			)
		);

		$this->add_control(
			'title_url',
			array(
				'label'         => __( 'URL (Link)', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			)
		);

		$this->add_control(
			'title_divider',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'description',
			array(
				'label' => __( 'Description', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXTAREA,
			)
		);

		$this->add_control(
			'description_url',
			array(
				'label'         => __( 'URL (Link)', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			)
		);

		$this->add_control(
			'description_divider',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_responsive_control(
			'icon_align',
			array(
				'label'     => __( 'Alignment', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'consulting-elementor-widgets' ),
						'icon'  => 'fa fa-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'consulting-elementor-widgets' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'consulting-elementor-widgets' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-header-icon-box' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Icon Styles', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-header-icon-box .icon-box' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'icon_font_size',
			array(
				'label'      => __( 'Icon Size', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 16,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-header-icon-box .icon-box' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_color_action',
			array(
				'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-header-icon-box .icon-box:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-header-icon-box .icon-box:active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-header-icon-box .icon-box:focus'  => 'color: {{VALUE}}',
				),
				'condition' => array(
					'icon_url[url]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'icon_intents',
			array(
				'label'      => __( 'Indents', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-header-icon-box .icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			array(
				'label' => __( 'Title Styles', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'title_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .consulting-header-icon-box .text-box .title',
			)
		);

		$this->add_responsive_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-header-icon-box .text-box .title'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-header-icon-box .text-box .title a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_intents',
			array(
				'label'      => __( 'Indents', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-header-icon-box .text-box .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			array(
				'label' => __( 'Description Styles', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .consulting-header-icon-box .text-box .description',
			)
		);

		$this->add_responsive_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-header-icon-box .text-box .description'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-header-icon-box .text-box .description a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'description_intents',
			array(
				'label'      => __( 'Indents', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-header-icon-box .text-box .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$title           = $settings['title'];
		$url_title       = $settings['title_url'];
		$description     = $settings['description'];
		$url_description = $settings['description_url'];

		/* Get Icon */
		$icon_tag = 'div';

		if ( ! empty( $settings['icon_url']['url'] ) ) {
			$this->add_link_attributes( 'icon-wrapper', $settings['icon_url'] );
			$icon_tag = 'a';
		}
		if ( empty( $settings['icon'] ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
			$settings['icon'] = 'fa fa-star';
		}
		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
		}

		/* Get Title */
		if ( ! empty( $url_title['url'] ) ) {
			$this->add_link_attributes( 'url', $url_title );
			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', 'div class="title"', $this->get_render_attribute_string( 'title' ), $title );

		/* Get Description */
		if ( ! empty( $url_description['url'] ) ) {
			$this->add_link_attributes( 'url', $url_description );
			$description = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $description );
		}
		$description_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', 'div class="description"', $this->get_render_attribute_string( 'description' ), $description );

		?>
		<div class="consulting-header-icon-box">
		<<?php echo esc_attr( $icon_tag ) . '  class="icon-box" ' . esc_attr( $this->get_render_attribute_string( 'icon-wrapper' ) ); ?>
		>
		<i <?php echo esc_attr( $this->get_render_attribute_string( 'icon' ) ); ?>></i>
		</<?php echo esc_attr( $icon_tag ); ?>>
		<div class="text-box">
			<?php echo wp_kses_post( $title_html ); ?>
			<?php echo wp_kses_post( $description_html ); ?>
		</div>
		</div>
		<?php
	}
}
