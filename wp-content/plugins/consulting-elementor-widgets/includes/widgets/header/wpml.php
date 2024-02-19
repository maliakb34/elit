<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Elementor_Header_Wpml extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_header_wpml';
	}

	public function get_title() {
		return esc_html__( 'Consulting WPML', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-translator consulting_icon_hb';
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
			'custom_links',
			array(
				'label'   => __( 'Switcher', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => __( 'WPML', 'consulting-elementor-widgets' ),
					'custom'  => __( 'Custom Links', 'consulting-elementor-widgets' ),
				),
			)
		);

		/*Items*/
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label' => __( 'Text', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'url',
			array(
				'label'         => __( 'URL (Link)', 'consulting-elementor-widgets' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => __( 'Items', 'consulting-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'title' => __( 'Item #1', 'consulting-elementor-widgets' ),
					),
				),
				'condition'   => array(
					'custom_links' => 'custom',
				),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_switcher',
			array(
				'label' => __( 'Switcher Level 1', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'switcher_level_1_padding',
			array(
				'label'      => __( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lang_sel > ul > li .lang_sel_sel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'switcher_level_1_background',
			array(
				'label'     => __( 'Background', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lang_sel > ul > li .lang_sel_sel' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'switcher_level_1_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lang_sel > ul > li .lang_sel_sel'       => 'color: {{VALUE}}',
					'{{WRAPPER}} .lang_sel > ul > li .lang_sel_sel:after' => 'border-top-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_switcher_2',
			array(
				'label' => __( 'Switcher Level 2', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'switcher_level_2_padding',
			array(
				'label'      => __( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .lang_sel > ul > li > ul a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'switcher_level_2_background',
			array(
				'label'     => __( 'Background', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lang_sel > ul > li > ul a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'switcher_level_2_background_action',
			array(
				'label'     => __( 'Background on action', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lang_sel > ul > li > ul a:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .lang_sel > ul > li > ul a:active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .lang_sel > ul > li > ul a:focus'  => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'switcher_level_2_color',
			array(
				'label'     => __( 'Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lang_sel > ul > li > ul a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'style_divider',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_responsive_control(
			'switcher_level_2_dropdown_background',
			array(
				'label'     => __( 'Background', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lang_sel > ul > li > ul' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];

		if ( 'default' === $settings['custom_links'] ) {
			if ( function_exists( 'icl_object_id' ) ) {
				if ( 'wpml_default' === consulting_theme_option( 'wpml_switcher_style', true ) ) {
					do_action( 'wpml_add_language_selector' );
				} else {
					consulting_topbar_lang();
				}
			}
		} else { ?>
			<div class="lang_sel">
				<ul>
					<li>
						<a href="<?php echo esc_url( $items['0']['url']['url'] ); ?>"
								class="lang_sel_sel"><?php echo esc_attr( $items['0']['title'] ); ?></a>
						<ul>
							<?php
							foreach ( $items as $key => $val ) :
								if ( 0 !== $key ) {
									?>
									<li>
										<a href="<?php echo esc_url( $val['url']['url'] ); ?>"><?php echo esc_attr( $val['title'] ); ?></a>
									</li>
								<?php } endforeach; ?>
						</ul>
					</li>
				</ul>
			</div>
			<?php
		}
	}
}
