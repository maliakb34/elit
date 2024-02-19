<?php
add_filter(
	'consulting_theme_options',
	function ( $setups ) {

		$fields = array(
			'metabox_content_bg_transparent' => array(
				'type'        => 'checkbox',
				'description' => esc_html__( 'The option works only if the “Boxed Mode” is enabled. It removes the background and shadows from the container', 'stm_post_type' ),
				'label'       => esc_html__( 'Content Background - Transparent', 'stm_post_type' ),
			),
		);

		$custom_fields = array(
			'name'   => esc_html__( 'Content Options', 'stm_post_type' ),
			'icon'   => 'fas fa-ellipsis-v',
			'fields' => $fields,
		);

		$setups[ 'content_options' ] = $custom_fields;// phpcs:ignore

		return $setups;

	},
	10,
	1
);
