<?php
add_filter(
	'consulting_theme_options',
	function ( $setups ) {

		$custom_fields = array(
			'name'   => esc_html__( 'Popups', 'stm_post_type' ),
			'icon'   => 'fas fa-window-restore',
			'fields' => array(
				'popup_settings_information_notice' => array(
					'description' => esc_html__( 'These settings are general and desired popups for any page can be selected in the settings of the page itself.', 'stm_post_type' ),
					'type'        => 'notice',
				),
				'show_popup'                        => array(
					'type'  => 'checkbox',
					'label' => esc_html__( 'Popup', 'stm_post_type' ),
					'value' => false,
				),
				'popups'                            => array(
					'type'        => 'select',
					'label'       => esc_html__( 'Select Popup', 'stm_post_type' ),
					'description' => esc_html__( 'Select the desired Popup to display on Website', 'stm_post_type' ),
					'options'     => consulting_popups(),
					'dependency'  => array(
						'key'   => 'show_popup',
						'value' => 'not_empty',
					),
				),
				'popups_event'                      => array(
					'label'       => esc_html__( 'Triggers', 'stm_post_type' ),
					'description' => esc_html__( 'What action the does a user need to do to make the popup open', 'stm_post_type' ),
					'group'       => 'started',
					'type'        => 'select',
					'options'     => array(
						'popup_event_on_load'    => esc_html__( 'On Page Load(s)', 'stm_post_type' ),
						'popup_event_inactivity' => esc_html__( 'After Inactivity Time', 'stm_post_type' ),
						'popup_event_on_exit'    => esc_html__( 'On Exit Intent', 'stm_post_type' ),
						'popup_event_on_date'    => esc_html__( 'In Date Period', 'stm_post_type' ),
						'popup_event_on_time'    => esc_html__( 'In Time Period', 'stm_post_type' ),
					),
					'value'       => 'popup_event_on_load',
					'dependency'  => array(
						'key'   => 'show_popup',
						'value' => 'not_empty',
					),
				),
				'popup_event_open_delay'            => array(
					'label'       => esc_html__( 'Delay', 'stm_post_type' ),
					'description' => esc_html__( 'Show after X amount of time (in seconds)', 'stm_post_type' ),
					'type'        => 'number',
					'dependency'  => array(
						'key'   => 'show_popup',
						'value' => 'not_empty',
					),
				),
				'popup_event_showing_in'            => array(
					'label'       => esc_html__( 'Rerun', 'stm_post_type' ),
					'description' => esc_html__( 'Show again after X period of time', 'stm_post_type' ),
					'type'        => 'select',
					'options'     => array(
						'60'      => esc_html__( 'Minute', 'stm_post_type' ),
						'600'     => esc_html__( '10 Minutes', 'stm_post_type' ),
						'1800'    => esc_html__( '30 Minutes', 'stm_post_type' ),
						'3600'    => esc_html__( 'Hour', 'stm_post_type' ),
						'10800'   => esc_html__( '3 Hours', 'stm_post_type' ),
						'21600'   => esc_html__( '6 Hours', 'stm_post_type' ),
						'43200'   => esc_html__( '12 Hours', 'stm_post_type' ),
						'86400'   => esc_html__( 'Day', 'stm_post_type' ),
						'259200'  => esc_html__( '3 Days', 'stm_post_type' ),
						'604800'  => esc_html__( 'Week', 'stm_post_type' ),
						'1209600' => esc_html__( '2 Weeks', 'stm_post_type' ),
						'1814400' => esc_html__( '3 Weeks', 'stm_post_type' ),
						'2419200' => esc_html__( '4 Weeks', 'stm_post_type' ),
						'never'   => esc_html__( 'Never', 'stm_post_type' ),
					),
					'value'       => '60',
					'dependency'  => array(
						'key'   => 'show_popup',
						'value' => 'not_empty',
					),
				),
				'popup_event_date_from'             => array(
					'label'        => esc_html__( 'Show from the Selected Date', 'stm_post_type' ),
					'description'  => esc_html__( 'The time zone is taken from the WordPress General settings', 'stm_post_type' ),
					'type'         => 'date',
					'dependency'   => array(
						array(
							'key'   => 'show_popup',
							'value' => 'not_empty',
						),
						array(
							'key'   => 'popups_event',
							'value' => 'popup_event_on_date',
						),
					),
					'dependencies' => '&&',
				),
				'popup_event_date_to'               => array(
					'label'        => esc_html__( 'Show until the Selected Date', 'stm_post_type' ),
					'description'  => esc_html__( 'The time zone is taken from the WordPress General settings', 'stm_post_type' ),
					'type'         => 'date',
					'dependency'   => array(
						array(
							'key'   => 'show_popup',
							'value' => 'not_empty',
						),
						array(
							'key'   => 'popups_event',
							'value' => 'popup_event_on_date',
						),
					),
					'dependencies' => '&&',
				),
				'popup_event_time_from'             => array(
					'label'        => esc_html__( 'Show from the Selected Time', 'stm_post_type' ),
					'description'  => esc_html__( 'Popup appears daily from the selected time', 'stm_post_type' ),
					'type'         => 'time',
					'dependency'   => array(
						array(
							'key'   => 'show_popup',
							'value' => 'not_empty',
						),
						array(
							'key'   => 'popups_event',
							'value' => 'popup_event_on_time',
						),
					),
					'dependencies' => '&&',
				),
				'popup_event_time_to'               => array(
					'label'        => esc_html__( 'Show until the Selected Time', 'stm_post_type' ),
					'description'  => esc_html__( 'Popup appears daily until the selected time', 'stm_post_type' ),
					'group'        => 'ended',
					'type'         => 'time',
					'dependency'   => array(
						array(
							'key'   => 'show_popup',
							'value' => 'not_empty',
						),
						array(
							'key'   => 'popups_event',
							'value' => 'popup_event_on_time',
						),
					),
					'dependencies' => '&&',
				),
				'popup_animation'                   => array(
					'label'       => esc_html__( 'Animation', 'stm_post_type' ),
					'description' => esc_html__( 'Select Animation', 'stm_post_type' ),
					'type'        => 'select',
					'options'     => array(
						''                                => esc_html__( 'None', 'stm_post_type' ),
						'animate__animated animate__fadeIn' => esc_html__( 'FadeIn', 'stm_post_type' ),
						'animate__animated animate__fadeInDown' => esc_html__( 'FadeDown', 'stm_post_type' ),
						'animate__animated animate__bounce' => esc_html__( 'Bounce', 'stm_post_type' ),
						'animate__animated animate__zoomIn' => esc_html__( 'ZoomIn', 'stm_post_type' ),
						'animate__animated animate__zoomInDown' => esc_html__( 'ZoomInDown', 'stm_post_type' ),
						'animate__animated animate__rotateInDownRight' => esc_html__( 'ZoomInRight', 'stm_post_type' ),
						'animate__animated animate__rotateInDownLeft' => esc_html__( 'ZoomInLeft', 'stm_post_type' ),
						'animate__animated animate__rotateIn' => esc_html__( 'RotateIn', 'stm_post_type' ),
						'animate__animated animate__flip' => esc_html__( 'Flip', 'stm_post_type' ),
						'animate__animated animate__slideInUp' => esc_html__( 'SlideInUp', 'stm_post_type' ),
						'animate__animated animate__slideInDown' => esc_html__( 'SlideInDown', 'stm_post_type' ),
						'animate__animated animate__lightSpeedInRight' => esc_html__( 'LightSpeedInRight', 'stm_post_type' ),
						'animate__animated animate__lightSpeedInLeft' => esc_html__( 'LightSpeedInLeft', 'stm_post_type' ),
					),
					'value'       => '',
					'dependency'  => array(
						'key'   => 'show_popup',
						'value' => 'not_empty',
					),
				),
				'popup_responsive'                  => array(
					'label'       => esc_html__( 'Responsive Rules', 'stm_post_type' ),
					'description' => esc_html__( 'Do not show the popup if the width of the browser window in the device is equal or less than', 'stm_post_type' ),
					'type'        => 'select',
					'options'     => array(
						''     => esc_html__( 'None', 'stm_post_type' ),
						'1199' => esc_html__( 'Ipad Size Landscape (1199px)', 'stm_post_type' ),
						'1023' => esc_html__( 'Ipad Size Portrait (1023px)', 'stm_post_type' ),
						'767'  => esc_html__( 'Mobile Size Landscape (767px)', 'stm_post_type' ),
						'580'  => esc_html__( 'Mobile Size Portrait (580px)', 'stm_post_type' ),
					),
					'value'       => '',
					'dependency'  => array(
						'key'   => 'show_popup',
						'value' => 'not_empty',
					),
				),
			),
		);

		$setups['popups'] = $custom_fields;

		return $setups;
	},
	10,
	1
);
