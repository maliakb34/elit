<?php
function stm_get_page_id_by_title( $title ) {
	$query = new WP_Query(
		array(
			'post_type'              => 'page',
			'title'                  => $title,
			'post_status'            => 'all',
			'fields'                 => 'ids',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'orderby'                => 'post_date ID',
			'order'                  => 'ASC',
		)
	);
	wp_reset_postdata();
	return ! empty( $query->posts[0] ) ? $query->posts[0] : null;
}
function stm_set_content_options( $layout, $builder ) {
	/*Set menus*/
	$locations = get_theme_mod( 'nav_menu_locations' );
	$menus     = wp_get_nav_menus();

	if ( ! empty( $menus ) ) {
		foreach ( $menus as $menu ) {
			if ( is_object( $menu ) ) {
				$menu_names = array(
					'Main',
					'Menu 1',
					'Header menu',
					'Main menu',
					'Main Menu',
					'Top menu',
				);
				$menu_name  = $menu->name;
				if ( in_array( $menu_name, $menu_names ) ) {
					$locations['consulting-primary_menu'] = $menu->term_id;
					stm_import_megamenu_fields( $layout, $menu_name );
				}
			}
		}
	}

	set_theme_mod( 'nav_menu_locations', $locations );

	//Set pages
	update_option( 'show_on_front', 'page' );

	$possible_home_pages = array(
		'Front page',
		'Home',
	);

	foreach ( $possible_home_pages as $home_page ) {
		$front_page = stm_get_page_id_by_title( $home_page );
		if ( ! empty( $front_page ) ) {
			update_option( 'page_on_front', $front_page );
		}
	}

	$possible_blog_pages = array(
		'Events',
		'Success Stories',
		'Blog',
		'News',
	);

	foreach ( $possible_blog_pages as $blog_page ) {
		$blog_page = stm_get_page_id_by_title( $blog_page );
		if ( ! empty( $blog_page ) ) {
			update_option( 'page_for_posts', $blog_page );
		}
	}

	stm_demo_booked_dates();

	$shop_page = stm_get_page_id_by_title( 'Shop' );
	if ( ! empty( $shop_page ) ) {
		update_option( 'woocommerce_shop_page_id', $shop_page );
		update_option( 'shop_catalog_image_size[width]', 175 );
		update_option( 'shop_catalog_image_size[height]', 258 );
		update_option( 'shop_single_image_size[width]', 175 );
		update_option( 'shop_single_image_size[height]', 258 );
		update_option( 'shop_thumbnail_image_size[width]', 54 );
		update_option( 'shop_thumbnail_image_size[height]', 79 );
	}

	$checkout_page = stm_get_page_id_by_title( 'checkout' );
	if ( ! empty( $checkout_page ) ) {
		update_option( 'woocommerce_checkout_page_id', $checkout_page );
	}

	$cart_page = stm_get_page_id_by_title( 'cart' );

	if ( ! empty( $cart_page ) ) {
		update_option( 'woocommerce_cart_page_id', $cart_page );
	}

	$account_page = stm_get_page_id_by_title( 'my account' );
	if ( ! empty( $account_page ) ) {
		update_option( 'woocommerce_myaccount_page_id', $account_page );
	}
	$fxml = get_temp_dir() . $layout . '.xml';
	$fzip = get_temp_dir() . $layout . '.zip';
	if ( file_exists( $fxml ) ) {
		@unlink( $fxml );
	}
	if ( file_exists( $fzip ) ) {
		@unlink( $fzip );
	}

	if ( 'elementor' === $builder ) {
		Elementor\Plugin::$instance->files_manager->clear_cache();
	}

	// Update custom post meta
	consulting_refresh_events_dates();
}

function stm_change_builder_menu( $menu_id, $menu_name, $layout ) {

	$menu_config   = false;
	$layout_config = consulting_config();
	$layout_config = $layout_config[ $layout ];
	$theme_options = get_option( 'stm_theme_options' );

	if ( isset( $layout_config['menu'] ) ) {
		$menu_config = $layout_config['menu'][ $menu_name ];
		$to_row      = $menu_config['row'];
		$to_col      = $menu_config['col'];
		$menu_pos    = $theme_options['header_builder'][ $to_row ][ $to_col ];
	}

	if ( ! empty( $menu_config ) ) {
		foreach ( $menu_pos as $element_key => $element ) {
			if ( ! empty( $element['type'] ) && 'menu' === $element['type'] ) {
				$theme_options['header_builder'][ $to_row ][ $to_col ][ $element_key ]['data']['id'] = $menu_id;
			}
		}
	} else {
		foreach ( $theme_options['header_builder'] as $row_key => $row ) {

			foreach ( $row as $column_key => $column ) {
				foreach ( $column as $element_key => $element ) {
					if ( ! empty( $element['type'] ) && 'menu' === $element['type'] && $row === $menu_config['row'] && $column === $menu_config['col'] ) {
						$theme_options['header_builder'][ $row_key ][ $column_key ][ $element_key ]['data']['id'] = $menu_id;
					}
				}
			}
		}
	}

	update_option( 'stm_theme_options', $theme_options );
}

function stm_demo_booked_dates() {
	$dates = array(
		'Mon'         => array( '0900-1000' => 5 ),
		'Mon-details' => array( '0900-1000' => array( 'title' => 'Develop the next-generation technology' ) ),
		'Tue'         => array( '0900-1000' => 5 ),
		'Tue-details' => array( '0900-1000' => array( 'title' => 'Develop the next-generation technology' ) ),
		'Wed'         => array( '0900-1000' => 5 ),
		'Wed-details' => array( '0900-1000' => array( 'title' => 'Develop the next-generation technology' ) ),
		'Thu'         => array( '0900-1000' => 5 ),
		'Thu-details' => array( '0900-1000' => array( 'title' => 'Develop the next-generation technology' ) ),
		'Fri'         => array( '0900-1000' => 5 ),
		'Fri-details' => array( '0900-1000' => array( 'title' => 'Develop the next-generation technology' ) ),
		'Sat'         => array( '0900-1000' => 5 ),
		'Sat-details' => array( '0900-1000' => array( 'title' => 'Develop the next-generation technology' ) ),
	);

	update_option( 'booked_defaults', $dates );

	/*Colors*/
	$colors = array(
		'booked_light_color'  => '#002e5b',
		'booked_button_color' => '#6c98e1',
		'booked_dark_color'   => '#6c98e1',
	);

	foreach ( $colors as $color_name => $color ) {
		update_option( $color_name, $color );
	}

}

function stm_set_icon_sets( $layout ) {
	$fonts = get_option( 'stm_fonts_layout' );
	if ( ! empty( $fonts ) ) {
		if ( ! empty( $fonts[ 'stmicons_' . $layout ] ) ) {
			$fonts[ 'stmicons_' . $layout ]['enabled'] = true;
		}
	}

	update_option( 'stm_fonts_layout', $fonts );
}

function stm_import_megamenu_fields( $layout, $menu_name ) {
	$menu   = wp_get_nav_menu_items( $menu_name );
	$config = stm_get_megamenu_config( $layout );

	if ( ! empty( $config ) ) {
		foreach ( $menu as $menu_item ) {
			if ( ! empty( $config[ $menu_item->title ] ) ) {
				$id       = $menu_item->ID;
				$configer = $config[ $menu_item->title ];
				foreach ( $configer as $meta_key => $meta_value ) {
					update_post_meta( $id, '_menu_item_' . $meta_key, $meta_value );
				}
			}
		}
	}

	// Change images in mega menu
	$menus      = wp_get_nav_menu_object( $menu_name );
	$image_name = 'service1.jpg';
	$image      = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'post_title'     => $image_name,
			'posts_per_page' => 1,
		)
	);
	if ( $menus && $image ) {
		$menu_items = wp_get_nav_menu_items( $menus->term_id );
		foreach ( $menu_items as $menu_item ) {
			$menu_image = get_post_meta( $menu_item->ID, '_menu_item_stm_menu_image', true );
			if ( ! empty( $menu_image ) ) {
				update_post_meta( $menu_item->ID, '_menu_item_stm_menu_image', $image[0]->ID );
			}
		}
	}

	// Menu iin footer
	$menu_object     = get_term_by( 'name', 'Extra Links', 'nav_menu' );
	$widget_settings = get_option( 'widget_nav_menu' );

	if ( $menu_object && isset( $widget_settings['2'] ) && 'extra links' === $widget_settings['2']['title'] ) {
		$widget_settings['2']['nav_menu'] = $menu_object->term_id;
		update_option( 'widget_nav_menu', $widget_settings );
	}
}

function consulting_refresh_events_dates() {
	$args      = array(
		'post_type'      => 'stm_event',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
	$all_posts = get_posts( $args );
	foreach ( $all_posts as $single_post ) {
		$stm_event_date_start = get_post_meta( $single_post->ID, 'stm_event_date_start', true );
		$stm_event_date_end   = get_post_meta( $single_post->ID, 'stm_event_date_end', true );
		$event_speakers       = get_post_meta( $single_post->ID, 'stm_event_speakers', true );
		if ( ! empty( $stm_event_date_start ) ) {
			$stm_event_date_start = intval( $stm_event_date_start ) + ( 3000 * MONTH_IN_SECONDS );
			update_post_meta( $single_post->ID, 'stm_event_date_start', strval( $stm_event_date_start ) );
		}
		if ( ! empty( $stm_event_date_end ) ) {
			$stm_event_date_end = intval( $stm_event_date_end ) + ( 3000 * MONTH_IN_SECONDS );
			update_post_meta( $single_post->ID, 'stm_event_date_end', strval( $stm_event_date_end ) );
		}

		if ( ! empty( $event_speakers ) ) {
			$event_speakers = array(
				array(
					'label' => 'Brandon Copperfield',
					'value' => 461,
				),
			);

			$event_speakers_json = wp_json_encode( $event_speakers );

			update_post_meta( $single_post->ID, 'stm_event_speakers', $event_speakers_json );
		}
	}
}
