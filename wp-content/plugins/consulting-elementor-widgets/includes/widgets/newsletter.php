<?php

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;

class Elementor_STM_Newsletter extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_newsletter';
	}

	public function get_title() {
		return esc_html__( 'Newsletter', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-mail';
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
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
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
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
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
			'content_section',
			array(
				'label' => __( 'Content', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$mailchimp = '';

		if ( defined( 'MC4WP_VERSION' ) ) {
			$mailchimp = mc4wp_get_forms();
		}

		$mailchimp_forms = array();

		if ( $mailchimp ) {
			foreach ( $mailchimp as $mailchimp_form ) {
				$mailchimp_forms[ $mailchimp_form->ID ] = $mailchimp_form->name;
			}
		} else {
			$mailchimp_forms[0] = esc_html__( 'No contact forms found', 'consulting-elementor-widgets' );
		}

		$this->add_control(
			'form_id',
			array(
				'label'   => __( 'Select form', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $mailchimp_forms,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			array(
				'label' => esc_html__( 'Button', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'button_position',
			array(
				'label'     => __( 'View', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'row'    => array(
						'title' => esc_html__( 'Inline', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-align-stretch-h',
					),
					'column' => array(
						'title' => esc_html__( 'Full', 'consulting-elementor-widgets' ),
						'icon'  => 'eicon-justify-space-around-h',
					),
				),
				'default'   => 'row',
				'selectors' => array(
					'{{WRAPPER}} .stm_newsletter_form' => 'flex-direction: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .consulting_newsletter_widget button, {{WRAPPER}} .consulting_newsletter_widget input[type=submit]',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting_newsletter_widget button,' => 'fill: {{VALUE}}; color: {{VALUE}};',
					'{{WRAPPER}} .consulting_newsletter_widget input[type=submit]' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting_newsletter_widget button i' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'           => 'button_background',
				'label'          => esc_html__( 'Background', 'consulting-elementor-widgets' ),
				'types'          => array( 'classic', 'gradient' ),
				'exclude'        => array( 'image' ),
				'selector'       => '{{WRAPPER}} .consulting_newsletter_widget button, {{WRAPPER}} .consulting_newsletter_widget input[type=submit]',
				'fields_options' => array(
					'background' => array(
						'default' => 'classic',
					),
					'color'      => array(
						'global' => array(
							'default' => Global_Colors::COLOR_ACCENT,
						),
					),
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'consulting-elementor-widgets' ),
			)
		);

		$this->add_control(
			'hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .consulting_newsletter_widget button:hover, {{WRAPPER}} .consulting_newsletter_widget button:focus'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .consulting_newsletter_widget button:hover svg, {{WRAPPER}} .consulting_newsletter_widget button:focus svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .consulting_newsletter_widget input[type=submit]' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_icon_hover_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting_newsletter_widget button:hover i' => 'fill: {{VALUE}}; color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'           => 'button_background_hover',
				'label'          => esc_html__( 'Background', 'consulting-elementor-widgets' ),
				'types'          => array( 'classic', 'gradient' ),
				'exclude'        => array( 'image' ),
				'selector'       => '{{WRAPPER}} .consulting_newsletter_widget button:hover, {{WRAPPER}} .consulting_newsletter_widget button:focus, {{WRAPPER}} .consulting_newsletter_widget input[type=submit]:hover',
				'fields_options' => array(
					'background' => array(
						'default' => 'classic',
					),
				),
			)
		);

		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'border_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}}  .consulting_newsletter_widget button:hover, {{WRAPPER}} .consulting_newsletter_widget button:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hover_animation',
			array(
				'label' => esc_html__( 'Hover Animation', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => esc_html__( 'Margin', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting_newsletter_widget button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .consulting_newsletter_widget input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_responsive_control(
			'text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'consulting-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .consulting_newsletter_widget button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .consulting_newsletter_widget input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'form_messages_style',
			array(
				'label' => esc_html__( 'Form Messages', 'consulting-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'form_messages_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} .consulting_newsletter_widget .mc4wp-alert p, {{WRAPPER}} .consulting_newsletter_widget .mc4wp-error p',
			)
		);

		$this->add_control(
			'form_messages_color',
			array(
				'label'     => esc_html__( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .consulting_newsletter_widget .mc4wp-alert p, {{WRAPPER}} .consulting_newsletter_widget .mc4wp-error p' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings              = $this->get_settings_for_display();
		$settings['css_class'] = ' elementor-consulting-newsletter';
		?>
		<div class="consulting_newsletter_widget">
			<?php
			if ( defined( 'MC4WP_VERSION' ) ) {
				if ( ! empty( $settings['form_id'] ) ) {
					echo do_shortcode( "[mc4wp_form id='{$settings['form_id']}']" );
				} else {
					echo sprintf(
						'<div class="consulting_newsletter_widget_notice">%1$s</div>',
						esc_html__( 'No contact forms found.', 'consulting-elementor-widgets' )
					);
				}
			} else {
				if ( current_user_can( 'install_plugins' ) ) {
					echo sprintf(
						'<div class="consulting_newsletter_widget_notice">%2$s <a href="%1$s">%3$s</a> %4$s</div>',
						esc_url( 'wp-admin/admin.php?page=stm-admin-plugins' ),
						esc_html__( 'Please install', 'consulting-elementor-widgets' ),
						esc_html__( 'MC4WP: MailChimp', 'consulting-elementor-widgets' ),
						esc_html__( 'plugin and configure it for operating the widget.', 'consulting-elementor-widgets' )
					);
				}
			}
			?>
		</div>
		<?php
	}
}
