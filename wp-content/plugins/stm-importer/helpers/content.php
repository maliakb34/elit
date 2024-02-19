<?php
function stm_theme_import_content( $layout, $builder, $import_media ) {
	set_time_limit( 0 );

	if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
		define( 'WP_LOAD_IMPORTERS', true );
	}

	require_once STM_CONFIGURATIONS_PATH . '/wordpress-importer/class-stm-wp-import.php';

	$wp_import                    = new STM_WP_Import();
	$wp_import->theme             = 'consulting';
	$wp_import->layout            = $layout;
	$wp_import->builder           = $builder;
	$wp_import->fetch_attachments = true;

	if ( 'elementor' === $builder ) {
		if ( defined( 'STM_DEV_MODE' ) ) {
			consulting_upload_placeholder();
			$ready = STM_CONFIGURATIONS_PATH . '/demos/elementor/elementor-' . $layout . '.xml';
		} else {
			consulting_upload_placeholder();
			$ready = stm_importer_download_demo( $builder . '-' . $layout );
		}
	} else {
		if ( defined( 'STM_DEV_MODE' ) ) {
			$ready = STM_CONFIGURATIONS_PATH . '/demos/' . $layout . '/xml/demo.xml';
		} else {
			$ready = stm_importer_download_demo( $layout );
		}
	}

	if ( is_wp_error( $ready ) ) {
		return $ready;
	}

	if ( $ready ) {
		// Delete Menu
		stm_delete_all_menu();

		// Delete Widgets
		delete_option( 'sidebars_widgets' );

		ob_start();
		$wp_import->import( $ready );
		ob_end_clean();
	}

	return true;
}

function stm_importer_download_demo( $layout ) {
	if ( ! class_exists( 'Plugin_Upgrader', false ) ) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	}

	$upgrader = new WP_Upgrader( new Automatic_Upgrader_Skin() );
	$result   = $upgrader->run(
		array(
			'package'                     => "downloads://consulting/demos/{$layout}.zip",
			'destination'                 => apply_filters( 'consulting_get_temp_path', '' ),
			'clear_destination'           => false,
			'abort_if_destination_exists' => false,
			'clear_working'               => true,
		)
	);

	if ( false === $result ) {
		$result = new WP_Error( '', 'WP_Upgrader returned "false" when downloading demo ZIP.' );
	}

	if ( is_wp_error( $result ) ) {
		return $result;
	}

	return $result['destination'] . "{$layout}.xml";
}

function stm_delete_all_menu() {
	$taxonomy_name = 'nav_menu';
	$terms         = get_terms(
		array(
			'taxonomy'   => $taxonomy_name,
			'hide_empty' => false,
		)
	);
	foreach ( $terms as $term ) {
		wp_delete_term( $term->term_id, $taxonomy_name );
	}
}

function consulting_upload_placeholder() {

	$placeholder = consulting_importer_get_placeholder();
	if ( empty( $placeholder ) ) {

		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$image_url = 'http://consulting.stylemixthemes.com/demo/wp-content/uploads/2016/06/placeholder.gif';

		$upload_dir = wp_upload_dir();

		$placeholder_path = STM_CONFIGURATIONS_PATH . '/assets/images/placeholder.gif';
		$image_data       = $wp_filesystem->get_contents( $placeholder_path );

		$filename = basename( $image_url );

		if ( wp_mkdir_p( $upload_dir['path'] ) ) {
			$file = $upload_dir['path'] . '/' . $filename;
		} else {
			$file = $upload_dir['basedir'] . '/' . $filename;
		}
		$wp_filesystem->put_contents( $file, $image_data, FS_CHMOD_FILE );

		$wp_filetype = wp_check_filetype( $filename, null );

		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title'     => sanitize_file_name( $filename ),
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		$attach_id = wp_insert_attachment( $attachment, $file );
		update_post_meta( $attach_id, '_wp_attachment_image_alt', 'consulting_placeholder' );
		require_once ABSPATH . 'wp-admin/includes/image.php';
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );
	}
}

function consulting_importer_get_placeholder() {
	$placeholder_id    = 0;
	$placeholder_array = get_posts(
		array(
			'post_type'      => 'attachment',
			'posts_per_page' => 1,
			'meta_key'       => '_wp_attachment_image_alt',
			'meta_value'     => 'consulting_placeholder',
		)
	);
	if ( $placeholder_array ) {
		foreach ( $placeholder_array as $val ) {
			$placeholder_id = $val->ID;
		}
	}
	return $placeholder_id;
}

function consulting_import_rebuilder_elementor_data( &$data ) {

	$placeholder_id  = consulting_importer_get_placeholder();
	$placeholder_url = wp_get_attachment_image_src( $placeholder_id, 'full' );
	$placeholder_url = $placeholder_url[0];
	$placeholder     = array(
		'id'  => $placeholder_id,
		'url' => $placeholder_url,
	);

	if ( ! empty( $data ) ) {
		$data = maybe_unserialize( $data );
		if ( ! is_array( $data ) ) {
			if ( consulting_import_is_elementor_data_unslash_required() ) {
				$data = wp_unslash( $data );
			}
			$data = json_decode( $data, true );
		}
		consulting_import_rebuilder_elementor_data_walk( $data, $placeholder_id, $placeholder_url, $placeholder );
		$data = wp_slash( wp_json_encode( $data ) );
	}

}

function consulting_import_is_elementor_data_unslash_required() {
	// No elementor plugin is active - so no unslash is required
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return false;
	}

	// before version 2.9.10 it was required
	if ( version_compare( ELEMENTOR_VERSION, '2.9.10', '<' ) ) {
		return true;
	}

	// otherwise not required
	return false;
}

function consulting_import_rebuilder_elementor_data_walk( &$data_arg, $placeholder_id, $placeholder_url, $placeholder ) {

	if ( is_array( $data_arg ) ) {

		$svg_files = array(
			'circuit.svg',
			'triangle_transparent.svg',
			'industrial.svg',
			'reimbursement.svg',
			'financial.svg',
			'government.svg',
			'triangle_service.svg',
			'triangle.svg',
			'air_travel.svg',
			'schedule.svg',
			'products.svg',
			'truck.svg',
			'earth.svg',
			'money_schedule.svg',
			'triangle_staff.svg',
			'circuit_transparent.svg',
			'circuit_transparent_2.svg',
			'triangle_contact.svg',
			'triangle_for_slide_4.svg',
			'triangle_for_slide_5.svg',
			'manchester_inner_circle.svg',
			'manchester_inner_circle_transparent.svg',
			'manchester_inner_triangle-1.svg',
			'manchester_inner_triangle-2.svg',
			'manchester-heading-triangle-1.svg',
			'popup_contact_form_1_bg.png',
			'popup_call_to_action_bg.png',
			'popup_contact_form_2_bg.png',
			'popup_countdown_1_bg.png',
			'popup_countdown_2_bg.png',
			'popup_discount_1_bg.png',
			'popup_discount_2_bg.png',
			'popup_download_bg.png',
			'popup_download_img.png',
			'popup_image.jpg',
			'popup_pricing_bg.png',
			'popup_subscribe_1_bg.png',
			'popup_subscribe_2_bg.png',
			'popup_video_bg.png',
		);

		foreach ( $data_arg as &$args ) {

			if ( ! empty( $args['url'] ) ) {
				if ( ! in_array( basename( $args['url'] ), $svg_files, true ) ) {
					if ( ! empty( $args['id'] ) ) {
						$args = $placeholder;
					} else {
						$localhost   = 'http://consulting.loc';
						$host        = get_bloginfo( 'url' );
						$args['url'] = str_replace( $localhost, $host, $args['url'] );
					}
				}
			}

			consulting_import_rebuilder_elementor_data_walk( $args, $placeholder_id, $placeholder_url, $placeholder );
		}
	}
}

function consulting_update_placeholder() {
	$imported_placeholder = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'meta_query'     => array(
				array(
					'key'     => '_wp_attachment_image_alt',
					'value'   => 'placeholder',
					'compare' => '=',
				),
			),
			'posts_per_page' => 1,
		)
	);

	$attachment_ids     = $imported_placeholder[0]->ID;
	$allowed_post_types = array(
		'post',
		'page',
		'stm_event',
		'stm_service',
		'stm_staff',
		'stm_portfolio',
		'stm_works',
		'stm_testimonials',
		'stm_cases',
		'stm_vc_sidebar',
	);

	$pages = get_posts(
		array(
			'post_type'      => $allowed_post_types,
			'posts_per_page' => -1,
		)
	);

	foreach ( $pages as $page ) {
		$post_content = $page->post_content;

		// Find all occurrences of the keywords image and images
		preg_match_all( '/(image|images)=["\'](.*?)["\']/', $post_content, $matches, PREG_SET_ORDER );

		// Go through all matches and replace them with ID
		$post_content = preg_replace_callback(
			'/(image|images|logo)="(\d+)"/i',
			function ( $match ) use ( $attachment_ids ) {
				$attribute = $match[1];
				$new_id    = $attachment_ids;
				return "$attribute=\"$new_id\"";
			},
			$post_content
		);

		// Change the specified size of images in the content
		$post_content = preg_replace_callback(
			'/img_size=["\'](.*?)["\']/i',
			function ( $match ) {
				$img_size = $match[1];
				return $match[0];
			},
			$post_content
		);

		$post_content = preg_replace_callback(
			'/images="([^"]+)"/i',
			function ( $match ) use ( $attachment_ids ) {
				$id_list     = explode( ',', $match[1] );
				$new_id_list = array();
				foreach ( $id_list as $old_id ) {
					$new_id        = $attachment_ids;
					$new_id_list[] = $new_id;
				}
				$new_ids = implode( ',', $new_id_list );
				return "images=\"$new_ids\"";
			},
			$post_content
		);

		// Replace background image addresses
		$post_content = preg_replace_callback(
			'/background(-image)?:\s*(?:#([0-9a-fA-F]{3,8})\s*)?url\((["\']?)(.+?)\3\)/i',
			function ( $match ) use ( $attachment_ids ) {
				$old_url = $match[4];
				$new_id  = $attachment_ids;
				$new_url = wp_get_attachment_image_url( $new_id, 'full' );

				$replacement  = isset( $match[1] ) ? $match[1] . ': ' : '';
				$replacement .= isset( $match[2] ) ? '#' . $match[2] . ' ' : '';
				$replacement .= 'url(' . $new_url . ')';

				return str_replace( $old_url, $new_url, $match[0] );
			},
			$post_content
		);

		$title_box_value = get_post_meta( $page->ID, 'title_box_bg_image', true );
		if ( ! empty( $title_box_value ) ) {
			update_post_meta( $page->ID, 'title_box_bg_image', $attachment_ids );

			$existing_color = get_post_meta( $page->ID, 'title_box_title_color', true );
			if ( ! empty( $existing_color ) ) {
				delete_post_meta( $page->ID, 'title_box_title_color' );
				update_post_meta( $page->ID, 'title_box_title_color', '#ffffff' );
			}
		}

		$testimonial_bg_value = get_post_meta( $page->ID, 'testimonial_bg_img', true );
		if ( ! empty( $testimonial_bg_value ) && is_numeric( $testimonial_bg_value ) ) {
			update_post_meta( $page->ID, 'testimonial_bg_img', $attachment_ids );
		}

		$page->post_content = $post_content;
		wp_update_post( $page );
	}
}

if ( ! function_exists( 'consulting_get_temp_path' ) ) {
	function consulting_get_temp_path() {
		$upload_dir = wp_upload_dir();
		$dir        = $upload_dir['basedir'] . '/tmp-layouts/';
		if ( ! is_dir( $dir ) ) {
			mkdir( $dir, 0777, true );
		}
		return $dir;
	}
	add_filter( 'consulting_get_temp_path', 'consulting_get_temp_path' );
}
