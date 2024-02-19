<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class Elementor_Header_Contact_Info extends \Elementor\Widget_Base {

	public function get_name() {
		return 'stm_header_contact_info';
	}

	public function get_title() {
		return esc_html__( 'Consulting Contact Info', 'consulting-elementor-widgets' );
	}

	public function get_icon() {
		return 'consulting-eicon-info consulting_icon_hb';
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

		/*Items*/
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label' => __( 'Name', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'address',
			array(
				'label'   => __( 'Address', 'consulting-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'rows'    => 5,
				'default' => '',
			)
		);

		$repeater->add_control(
			'address_icon',
			array(
				'label' => __( 'Address Icon', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
			)
		);

		$repeater->add_control(
			'email',
			array(
				'label' => __( 'Email', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'email_icon',
			array(
				'label' => __( 'Email Icon', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
			)
		);

		$repeater->add_control(
			'phone',
			array(
				'label' => __( 'Phone', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'phone_icon',
			array(
				'label' => __( 'Phone Icon', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
			)
		);

		$repeater->add_control(
			'working_hours',
			array(
				'label' => __( 'Working Hours', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'working_hours_icon',
			array(
				'label' => __( 'Working Hours Icon', 'consulting-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::ICONS,
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
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content Styles', 'consulting-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .top_bar_info_wr .top_bar_info li span',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info li span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icons Color', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info li i' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info li i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter_style',
			array(
				'label' => __( 'Filter Styles', 'consulting-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'filter_typography',
				'selector' => '{{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
			)
		);

		$this->add_control(
			'filter_color',
			array(
				'label'     => __( 'Text Color', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher .active'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher .active:after' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_bg_color',
			array(
				'label'     => __( 'Background Color', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher .active' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_drop_color',
			array(
				'label'     => __( 'Dropdown Color', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher ul li a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_drop_color_action',
			array(
				'label'     => __( 'Dropdown Color On Actions', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher ul li a:hover, {{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher ul li a:active, {{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher ul li a:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_drop_bg_color',
			array(
				'label'     => __( 'Dropdown Background Color', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher ul' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_drop_item_bg_color_action',
			array(
				'label'     => __( 'Background Color On Action', 'consulting-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher ul a:hover, {{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher ul a:active, {{WRAPPER}} .top_bar_info_wr .top_bar_info_switcher ul a:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$items    = $settings['items'];
		$id       = uniqid( 'top_bar_info_' );
		?>
		<div class="top_bar_info_wr">
			<?php if ( count( $items ) > 1 ) : ?>
				<div class="top_bar_info_switcher">
					<div class="active">
						<span><?php echo esc_html( $items[0]['title'] ); ?></span>
					</div>
					<ul>
						<?php foreach ( $items as $key => $val ) : ?>
							<li>
								<a href="<?php echo esc_attr( $key . '_' . $id ); ?>">
									<?php echo esc_html( $val['title'] ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php
			endif;

			if ( $items ) :
				foreach ( $items as $key => $val ) :
					?>
					<ul class="top_bar_info" id="<?php echo esc_attr( $key . '_' . $id ); ?>"
						<?php
						if ( 0 === $key ) {
							echo ' style="display: block;"';
						}
						?>
					>
						<?php if ( ! empty( $val['address'] ) ) : ?>
							<li>
								<?php if ( ! empty( $val['address_icon'] ) ) : ?>
									<i class="<?php echo esc_attr( $val['address_icon']['value'] ); ?>"></i>
								<?php endif; ?>
								<span><?php echo esc_html( $val['address'] ); ?></span>
							</li>
						<?php endif; ?>
						<?php if ( ! empty( $val['email'] ) ) : ?>
							<li>
								<?php if ( ! empty( $val['email_icon'] ) ) : ?>
									<i class="<?php echo esc_attr( $val['email_icon']['value'] ); ?>"></i>
								<?php endif; ?>
								<span><?php echo esc_html( $val['email'] ); ?></span>
							</li>
						<?php endif; ?>
						<?php if ( ! empty( $val['working_hours'] ) ) : ?>
							<li>
								<?php if ( ! empty( $val['working_hours_icon'] ) ) : ?>
									<i class="<?php echo esc_attr( $val['working_hours_icon']['value'] ); ?>"></i>
								<?php endif; ?>
								<span><?php echo esc_html( $val['working_hours'] ); ?></span>
							</li>
						<?php endif; ?>
						<?php if ( ! empty( $val['phone'] ) ) : ?>
							<li>
								<?php if ( ! empty( $val['phone_icon'] ) ) : ?>
									<i class="<?php echo esc_attr( $val['phone_icon']['value'] ); ?>"></i>
								<?php endif; ?>
								<span><?php echo esc_html( $val['phone'] ); ?></span>
							</li>
						<?php endif; ?>
					</ul>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<?php
	}
}
