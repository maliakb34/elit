<?php
add_filter(
	'consulting_post_options',
	function ( $setups ) {

	if ( isset( $_GET['source'] ) || get_the_ID() ) {// phpcs:ignore
		$post_id = ( isset( $_GET['source'] ) ) ? sanitize_text_field( $_GET['source'] ) : get_the_ID();// phpcs:ignore

			$custom_post_type = get_post_type( $post_id );

			if ( 'stm_portfolio' === $custom_post_type ) {
				$fields = array(
					'stm_portfolio_column' => array(
						'label'   => esc_html__( 'Size', 'stm_post_type' ),
						'type'    => 'select',
						'options' => array(
							'default' => esc_html__( 'Default', 'stm_post_type' ),
							'wide'    => esc_html__( 'Wide', 'stm_post_type' ),
							'long'    => esc_html__( 'High', 'stm_post_type' ),
						),
					),
				);

				$custom_fields = array(
					'name'   => esc_html__( 'Portfolio Information', 'stm_post_type' ),
					'fields' => $fields,
				);

				$setups['page_setup']['section_data_portfolio'] = $custom_fields;
			}
		}
		return $setups;
	}
);
