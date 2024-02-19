<?php
add_filter(
	'stm_wpcfto_boxes',
	function ( $boxes ) {
		$boxes['stm_popups_options'] = array(
			'post_type' => array( 'post_type', 'stm_popups' ),
			'label'     => esc_html__( 'Popup Settings', 'stm_post_type' ),
		);
		return $boxes;
	}
);

add_filter(
	'stm_wpcfto_fields',
	function ( $fields ) {
		$fields['stm_popups_options'] = array(
			'section_popup_general' => array(
				'name'   => esc_html__( 'General Settings', 'stm_post_type' ),
				'fields' => array(
					'popups_width'         => array(
						'type'  => 'number',
						'group' => 'started',
						'label' => esc_html__( 'Width (px)', 'stm_post_type' ),
						'value' => '',
					),
					'popups_height'        => array(
						'type'  => 'number',
						'label' => esc_html__( 'Height (px)', 'stm_post_type' ),
						'value' => '',
					),
					'popups_image_bg'      => array(
						'type'  => 'image',
						'label' => esc_html__( 'Popup Background Image', 'stm_post_type' ),
					),
					'popups_color_bg'      => array(
						'type'  => 'color',
						'label' => esc_html__( 'Select Background Color', 'stm_post_type' ),
						'value' => '',
					),
					'popups_border_radius' => array(
						'type'  => 'number',
						'group' => 'ended',
						'label' => esc_html__( 'Popup Border Radius (px)', 'stm_post_type' ),
						'value' => '',
					),
					'popups_template'      => array(
						'type'    => 'image_select',
						'label'   => esc_html__( 'Popup Position', 'stm_post_type' ),
						'width'   => 400,
						'height'  => 280,
						'options' => array(
							'classic'                => array(
								'alt' => 'Classic',
								'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/popups/classic.png',
							),
							'bordering-bottom-left'  => array(
								'alt' => 'Bordering Left',
								'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/popups/bordering-bottom-left.png',
							),
							'bordering-bottom-right' => array(
								'alt' => 'Bordering Right',
								'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/popups/bordering-bottom-right.png',
							),
							'top-bar'                => array(
								'alt' => 'Top Bar',
								'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/popups/top-bar.png',
							),
							'bottom-bar'             => array(
								'alt' => 'Bottom Bar',
								'img' => STM_POST_TYPE_URL . 'theme-options/inc/assets/img/popups/bottom-bar.png',
							),
						),
						'value'   => 'classic',
					),
				),
			),
		);
		return $fields;
	}
);
