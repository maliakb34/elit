<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Elementor_Footer_Menu extends \Elementor\Widget_Base {

	protected $nav_menu_index = 1;

	public function get_name(): string {
		return 'consulting-footer-menu';
	}

	public function get_title(): string {
		return esc_html__( 'Footer Menu', 'consulting-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'consulting-eicon-menu-bar consulting_icon_hb';
	}

	public function get_categories(): array {
		return array( 'consulting-widgets' );
	}

	protected function get_nav_menu_index(): int {
		return $this->nav_menu_index ++;
	}

	private function get_available_menus(): array {
		$menus = wp_get_nav_menus();

		$options = array();

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_menu',
			array(
				'label' => __( 'Menu', 'consulting-elementor-widgets' ),
			)
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				array(
					'label'        => __( 'Menu', 'consulting-elementor-widgets' ),
					'type'         => \Elementor\Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					'separator'    => 'after',
					/* translators: %s: link */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'consulting-elementor-widgets' ), admin_url( 'nav-menus.php' ) ),
				)
			);
		} else {
			$this->add_control(
				'menu',
				array(
					'type'            => \Elementor\Controls_Manager::RAW_HTML,
					// translators: %s: link
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'consulting-elementor-widgets' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator'       => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				)
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',
			array(
				'label' => __( 'Layout', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => __( 'Layout', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => array(
					'horizontal' => __( 'Horizontal', 'consulting-elementor-widgets' ),
					'vertical'   => __( 'Vertical', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'columns',
			array(
				'label'     => __( 'Columns', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '1',
				'options'   => array(
					'1' => __( 'One', 'consulting-elementor-widgets' ),
					'2' => __( 'Two', 'consulting-elementor-widgets' ),
				),
				'condition' => array(
					'layout' => 'vertical',
				),
			)
		);

		$this->add_control(
			'align',
			array(
				'label'   => __( 'Alignment', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'left'    => array(
						'title' => __( 'Left', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
					'justify' => array(
						'title' => __( 'Justify', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-h-align-stretch',
					),
				),
				'default' => 'left',
			)
		);

		$this->add_responsive_control(
			'menu_background_color',
			array(
				'label'     => __( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-footer-menu' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_menu',
			array(
				'label' => __( 'Menu', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'menu_padding',
			array(
				'label'      => __( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-footer-menu ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'menu_margin',
			array(
				'label'      => __( 'Margin', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting-footer-menu ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'menu_list_style',
			array(
				'label'   => __( 'List Style', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none' => __( 'None', 'consulting-elementor-widgets' ),
					'disc' => __( 'Disc', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'menu_list_style_color',
			array(
				'label'     => __( 'List Style Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-footer-menu ul > li:before' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'menu_list_style' => 'disc',
				),
			)
		);

		$this->add_control(
			'menu_link_hover_effect',
			array(
				'label'   => __( 'Link Hover Effect', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'      => __( 'None', 'consulting-elementor-widgets' ),
					'underline' => __( 'Underline', 'consulting-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'style_divider',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'menu_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .consulting-footer-menu ul > li > a',
			)
		);

		$this->add_responsive_control(
			'color_menu_item',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-footer-menu ul > li > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'color_menu_item_action',
			array(
				'label'     => __( 'Color on action', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-footer-menu ul > li > a:hover'             => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-footer-menu ul > li > a:active'            => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-footer-menu ul > li > a:focus'             => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-footer-menu ul > li.current-menu-item > a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-footer-menu ul > li.active > a'            => 'color: {{VALUE}}',
					'{{WRAPPER}} .consulting-footer-menu ul > li > .arrow.active'       => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'bg_color_menu_item',
			array(
				'label'     => __( 'Background', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-footer-menu ul > li > a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'bg_color_menu_item_action',
			array(
				'label'     => __( 'Background on action', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting-footer-menu ul > li > a:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .consulting-footer-menu ul > li > a:active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .consulting-footer-menu ul > li > a:focus'  => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	private function get_menu_html( $settings ) {
		$args = array(
			'echo'        => false,
			'menu'        => $settings['menu'],
			'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
		);

		return wp_nav_menu( $args );
	}

	private function get_menu_attributes( $settings ): string {
		$this->add_render_attribute(
			'consulting-footer-menu',
			'class',
			array(
				'consulting-footer-menu',
				'layout-' . $settings['layout'],
				'align-' . $settings['align'],
				'list-style-' . $settings['menu_list_style'],
			)
		);

		if ( $settings['columns'] ) {
			$this->add_render_attribute( 'consulting-footer-menu', 'class', 'cols-' . $settings['columns'] );
		}

		if ( $settings['menu_link_hover_effect'] ) {
			$this->add_render_attribute( 'consulting-footer-menu', 'class', 'hover-' . $settings['menu_link_hover_effect'] );
		}

		return $this->get_render_attribute_string( 'consulting-footer-menu' );
	}

	protected function render() {
		$settings        = $this->get_settings_for_display();
		$menu_html       = $this->get_menu_html( $settings );
		$menu_attributes = $this->get_menu_attributes( $settings );
		?>
		<nav <?php echo wp_kses_post( $menu_attributes ); ?>>
			<?php echo wp_kses_post( $menu_html ); ?>
		</nav>
		<?php
	}
}
