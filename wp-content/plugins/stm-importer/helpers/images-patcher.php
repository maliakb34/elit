<?php

function stm_theme_import_image_patch( $layout, $builder, $import_media ) {
	// Replacing images in posts
	consulting_replace_images_in_thumbnail();
	// Replacing images in content builders
	consulting_replace_images_in_builders_content( $layout, $builder, $import_media );
}
function consulting_replace_images_in_thumbnail() {
	$post_types_images = array(
		'stm_event'        => array(
			'https://consulting.stylemixthemes.com/demo/events/events-1.jpg',
			'https://consulting.stylemixthemes.com/demo/events/events-2.jpg',
			'https://consulting.stylemixthemes.com/demo/events/events-3.jpg',
			'https://consulting.stylemixthemes.com/demo/events/events-4.jpg',
			'https://consulting.stylemixthemes.com/demo/events/events-5.jpg',
			'https://consulting.stylemixthemes.com/demo/events/events-6.jpg',
		),
		'post'             => array(
			'https://consulting.stylemixthemes.com/demo/posts/portfolio-1.jpg',
			'https://consulting.stylemixthemes.com/demo/posts/portfolio-2.jpg',
			'https://consulting.stylemixthemes.com/demo/posts/portfolio-3.jpg',
			'https://consulting.stylemixthemes.com/demo/posts/portfolio-4.jpg',
			'https://consulting.stylemixthemes.com/demo/posts/portfolio-5.jpg',
			'https://consulting.stylemixthemes.com/demo/posts/portfolio-6.jpg',
			'https://consulting.stylemixthemes.com/demo/posts/posts-1.jpg',
			'https://consulting.stylemixthemes.com/demo/posts/posts-2.jpg',
		),
		'stm-zoom'         => array(
			'https://consulting.stylemixthemes.com/demo/meetings/meetings-1.jpg',
			'https://consulting.stylemixthemes.com/demo/meetings/meetings-2.jpg',
			'https://consulting.stylemixthemes.com/demo/meetings/meetings-3.jpg',
			'https://consulting.stylemixthemes.com/demo/meetings/meetings-4.jpg',
		),
		'stm_testimonials' => array(
			'https://consulting.stylemixthemes.com/demo/testimonials/testimonials-1.jpg',
			'https://consulting.stylemixthemes.com/demo/testimonials/testimonials-2.jpg',
			'https://consulting.stylemixthemes.com/demo/testimonials/testimonials-3.jpg',
			'https://consulting.stylemixthemes.com/demo/testimonials/testimonials-4.jpg',
		),
	);

	$attachment_ids = array();
	foreach ( $post_types_images as $post_type => $image_urls ) {
		foreach ( $image_urls as $file_url ) {
			$attachment_id = consulting_upload_image_to_wp_media_library( $file_url );
			if ( $attachment_id ) {
				$attachment_ids[ $post_type ][] = $attachment_id;
			}
		}
	}

	$allowed_post_types = array(
		array( 'post', 'stm_portfolio', 'stm_service', 'stm_works', 'product' ),
		'stm_event',
		'stm-zoom',
		array( 'stm_testimonials', 'stm_staff' ),
	);

	foreach ( $allowed_post_types as $post_type ) {
		$related_post_types = is_array( $post_type ) ? $post_type : array( $post_type );

		$attachment_id = null;
		foreach ( $related_post_types as $related_post_type ) {
			if ( ! empty( $attachment_ids[ $related_post_type ] ) ) {
				$attachment_id = $attachment_ids[ $related_post_type ][0];
				break;
			}
		}

		if ( $attachment_id ) {
			$posts_with_featured_image = get_posts(
				array(
					'post_type'      => $post_type,
					'posts_per_page' => -1,
				)
			);

			$num_attachments = count( $attachment_ids[ $related_post_type ] );
			$num_posts       = count( $posts_with_featured_image );

			for ( $i = 0; $i < $num_posts; $i ++ ) {
				$new_image_id = $attachment_ids[ $related_post_type ][ $i % $num_attachments ];
				$post         = $posts_with_featured_image[ $i ];
				update_post_meta( $post->ID, '_thumbnail_id', $new_image_id );
			}
		}
	}
}

function consulting_replace_images_in_builders_content( $layout, $builder, $import_media ) {
	$builder_images = array(
		'https://consulting.stylemixthemes.com/demo/content/content-1.jpg',
		'https://consulting.stylemixthemes.com/demo/content/content-2.jpg',
		'https://consulting.stylemixthemes.com/demo/content/content-3.jpg',
		'https://consulting.stylemixthemes.com/demo/content/content-4.jpg',
		'https://consulting.stylemixthemes.com/demo/content/content-5.jpg',
		'https://consulting.stylemixthemes.com/demo/content/content-6.jpg',
	);

	$attachment_ids = array();
	foreach ( $builder_images as $file_url ) {
		$attachment_id = consulting_upload_image_to_wp_media_library( $file_url );
		if ( $attachment_id ) {
			$attachment_ids[] = $attachment_id;
		}
	}

	if ( ! empty( $attachment_ids ) ) {
		$allowed_post_types = array(
			'page',
			'stm_event',
			'stm_service',
			'stm_portfolio',
			'stm_works',
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

			if ( 'js_composer' === $builder ) {
				// Go through all matches and replace them with ID
				$post_content = preg_replace_callback(
					'/(image|images|logo)="(\d+)"/i',
					function ( $match ) use ( $attachment_ids ) {
						$attribute = $match[1];
						$new_id    = $attachment_ids[ array_rand( $attachment_ids ) ];
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
							$new_id        = $attachment_ids[ array_rand( $attachment_ids ) ];
							$new_id_list[] = $new_id;
						}
						$new_ids = implode( ',', $new_id_list );
						return "images=\"$new_ids\"";
					},
					$post_content
				);
			}

			if ( 'elementor' === $builder ) {
				// Get the meta field with elementary data
				$elementor_data = get_post_meta( $page->ID, '_elementor_data', true );

				if ( $elementor_data ) {
					$data = json_decode( $elementor_data, true );
					$data = consulting_replace_elementor_images( $data, $attachment_ids );

					// Encode data back to JSON and save to database
					$new_elementor_data = wp_slash( json_encode( $data ) );
					update_post_meta( $page->ID, '_elementor_data', $new_elementor_data );
				}
			}

			$urls = array(
				'https://consulting.stylemixthemes.com/demo/testimonials/testimonials-1.jpg',
				'https://consulting.stylemixthemes.com/demo/testimonials/testimonials-2.jpg',
			);

			$current_url_index = 0;

			$post_content = preg_replace_callback(
				'/src=["\'](.*?)["\']/i',
				function ( $match ) use ( &$current_url_index, $urls ) {
					$old_src = $match[1];
					$new_src = $old_src;
					if ( strpos( $old_src, 'placeholder' ) !== false || strpos( $old_src, 'staff' ) !== false ) {
						$new_src           = $urls[ $current_url_index ];
						$current_url_index = ( $current_url_index + 1 ) % count( $urls );// phpcs:ignore
					}
					return 'src="' . $new_src . '"';
				},
				$post_content
			);

			// Replace background image addresses
			$post_content = preg_replace_callback(
				'/background(-image)?:\s*(?:#([0-9a-fA-F]{3,8})\s*)?url\((["\']?)(.+?)\3\)/i',
				function ( $match ) use ( $attachment_ids ) {
					$old_url = $match[4];
					$new_id  = $attachment_ids[ array_rand( $attachment_ids ) ];
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
				$new_id = $attachment_ids[ array_rand( $attachment_ids ) ];
				update_post_meta( $page->ID, 'title_box_bg_image', $new_id );

				$existing_color = get_post_meta( $page->ID, 'title_box_title_color', true );
				if ( ! empty( $existing_color ) ) {
					delete_post_meta( $page->ID, 'title_box_title_color' );
					update_post_meta( $page->ID, 'title_box_title_color', '#ffffff' );
				}
			}

			$testimonial_bg_value = get_post_meta( $page->ID, 'testimonial_bg_img', true );
			if ( ! empty( $testimonial_bg_value ) && is_numeric( $testimonial_bg_value ) ) {
				$new_id = $attachment_ids[ array_rand( $attachment_ids ) ];
				update_post_meta( $page->ID, 'testimonial_bg_img', $new_id );
			}

			// Update page content
			$page->post_content = $post_content;
			wp_update_post( $page );
		}
	}
}

function consulting_replace_elementor_images( $data, $attachment_ids ) {
	foreach ( $data as &$element ) {
		if ( isset( $element['settings'] ) ) {
			foreach ( $element['settings'] as &$inner_element ) {
				// Replace image URLs and IDs in the element settings
				$new_id  = $attachment_ids[ array_rand( $attachment_ids ) ];
				$new_url = wp_get_attachment_image_url( $new_id, 'full' );

				if ( isset( $inner_element['url'] ) && preg_match( '/\.(jpg|jpeg|png|gif)$/i', $inner_element['url'] ) ) {
					if ( isset( $inner_element['id'] ) ) {
						$inner_element['id'] = $new_id;
					}
					$inner_element['url'] = $new_url;
				}
			}

			if ( isset( $element['settings']['css'] ) ) {
				// Replace image URLs and IDs in the CSS
				$new_id                     = $attachment_ids[ array_rand( $attachment_ids ) ];
				$new_url                    = wp_get_attachment_image_url( $new_id, 'full' );
				$pattern                    = '/background-image:\s*url\((.*?)\)/i';
				$new_style                  = preg_replace( $pattern, "background-image: url({$new_url}?id={$new_id})", $element['settings']['css'] );
				$element['settings']['css'] = $new_style;
			}
		}

		if ( isset( $element['elements'] ) && is_array( $element['elements'] ) ) {
			$element['elements'] = consulting_replace_elementor_images( $element['elements'], $attachment_ids );
		}

		// Check for the presence of [images] key and update it if exists
		if ( isset( $element['settings']['images'] ) && is_array( $element['settings']['images'] ) ) {
			foreach ( $element['settings']['images'] as &$image_data ) {
				$image_data['id']  = $new_id;
				$image_data['url'] = $new_url;
			}
		}

		// Check for the presence of [gallery] key and update it if exists
		if ( isset( $element['settings']['gallery'] ) && is_array( $element['settings']['gallery'] ) ) {
			foreach ( $element['settings']['gallery'] as &$gallery_data ) {
				$gallery_data['id']  = $new_id;
				$gallery_data['url'] = $new_url;
			}
		}
	}

	return $data;
}

function consulting_upload_image_to_wp_media_library( $file_url ) {
	require_once ABSPATH . 'wp-admin/includes/media.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-includes/pluggable.php';

	$attachment_id = media_sideload_image( $file_url, 0, '', 'id' );

	if ( is_wp_error( $attachment_id ) ) {
		error_log( 'Attachment loading error: ' . $attachment_id->get_error_message() );// phpcs:ignore
		return false;
	}

	return $attachment_id;
}
