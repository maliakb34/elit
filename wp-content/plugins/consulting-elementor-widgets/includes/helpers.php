<?php
function consulting_locate_styles( $templates_name, $plugin_path = CONSULTING_ELEMENTOR_PATH ) {
	$located = false;

	foreach ( (array) $templates_name as $template ) {
		if ( substr( $template, - 4 ) !== '.php' ) {
			$template .= '.php';
		}

		$located = locate_template( 'includes/widgets/' . $template );

		if ( ! $located ) {
			$located = $plugin_path . '/includes/widgets' . $template;
		}

		if ( file_exists( $located ) ) {
			break;
		}
	}

	return apply_filters( 'consulting_locate_styles', $located, $templates_name );
}

function stm_load_variations_template( $settings, $variations, $plugin_path = CONSULTING_ELEMENTOR_PATH ) {
	include consulting_locate_styles( $variations, $plugin_path );
}

function stm_ajax_load_portfolio_elementor() {
	check_ajax_referer( 'stm_ajax_load_portfolio', 'security' );
	$data           = array();
	$load_more      = true;
	$posts_per_page = ( ! empty( $_POST['load_by'] ) ) ? intval( $_POST['load_by'] ) : 1;
	$page           = ( ! empty( $_POST['page'] ) ) ? intval( $_POST['page'] ) : 1;
	$category       = ( ! empty( $_POST['category'] ) ) ? sanitize_text_field( $_POST['category'] ) : null;
	$layout         = ( ! empty( $_POST['style'] ) && preg_match( '/^[a-zA-Z0-9_]+$/', $_POST['style'] ) ) ? sanitize_text_field( $_POST['style'] ) : '1';
	$count          = ( ! empty( $_POST['data-count'] ) ) ? sanitize_text_field( $_POST['data-count'] ) : null;
	$post_cat       = wp_get_post_terms( get_the_ID(), 'stm_portfolio_category' );
	$offset         = $page * $posts_per_page;

	$args = array(
		'post_type'      => 'stm_portfolio',
		'posts_per_page' => $posts_per_page,
		'offset'         => $offset,
	);
	if ( 'all' !== $category ) {
		$args['stm_portfolio_category'] = $category;
	}
	$query = new WP_Query( $args );
	$i     = $offset;
	$html  = '';
	if ( $query->have_posts() ) {
		ob_start();
		while ( $query->have_posts() ) {
			$query->the_post();
			set_query_var( 'i', $i );
			$settings['count'] = $i;
			stm_load_variations_template( $settings, '/portfolio/styles/style_' . $layout );
			$i ++;
		}
		$html = ob_get_clean();
	}
	$data['new_page'] = $page + 1;
	$data['html']     = $html;

	if ( $query->max_num_pages <= $data['new_page'] ) {
		$load_more = false;
	}

	$data['load_more'] = $load_more;

	echo wp_json_encode( $data );

	exit;
}

add_action( 'wp_ajax_stm_ajax_load_portfolio_elementor', 'stm_ajax_load_portfolio_elementor' );
add_action( 'wp_ajax_nopriv_stm_ajax_load_portfolio_elementor', 'stm_ajax_load_portfolio_elementor' );

function portfolio_category_filter() {
	$posts_per_page = ( ! empty( $_POST['portfolio_load_by'] ) ) ? intval( $_POST['portfolio_load_by'] ) : 1;
	$category       = ( ! empty( $_POST['portfolio_category'] ) ) ? sanitize_text_field( $_POST['portfolio_category'] ) : null;
	$layout         = ( ! empty( $_POST['portfolio_style'] ) ) ? sanitize_text_field( $_POST['portfolio_style'] ) : 'style_1';

	$args = array(
		'post_type'      => 'stm_portfolio',
		'posts_per_page' => $posts_per_page,
	);
	if ( 'all' !== $category ) {
		$args['stm_portfolio_category'] = $category;
	}
	$query = new WP_Query( $args );
	$html  = '';

	if ( $query->have_posts() ) {
		ob_start();
		while ( $query->have_posts() ) {
			$query->the_post();
			set_query_var( 'i', $i );
			$settings['count'] = $i;
			stm_load_variations_template( $settings, '/portfolio/styles/' . $layout );
			$i ++;
			$post_cat = wp_get_post_terms( get_the_ID(), 'stm_portfolio_category' );
		}
		$html = ob_get_clean();
	}
	$data['posts_count'] = $post_cat[0]->count;
	$data['html']        = $html;

	echo wp_json_encode( $data );

	exit;
}

add_action( 'wp_ajax_portfolio_category_filter', 'portfolio_category_filter' );
add_action( 'wp_ajax_nopriv_portfolio_category_filter', 'portfolio_category_filter' );

function get_post_terms( $id, $post_type, $separator = '' ) {
	$post_taxonomies = array(
		'post'             => 'category',
		'stm_event'        => 'stm_event_category',
		'stm_service'      => 'stm_service_category',
		'stm_staff'        => 'stm_staff_category',
		'stm_works'        => 'stm_works_category',
		'stm_testimonials' => 'stm_testimonials_category',
		'stm_portfolio'    => 'stm_portfolio_category',
	);

	$post_terms = wp_get_object_terms( $id, $post_taxonomies[ $post_type ] );
	$list       = '';
	$i          = 0;
	foreach ( $post_terms as $post_term ) {
		if ( 0 < $i && 3 > $i ) {
			$list .= $separator;
		}
		$list .= '<a href="' . esc_url( get_category_link( $post_term->term_id ) ) . '" class="category category-' . $i . '">' . esc_html( $post_term->name ) . '</a>';
		++$i;
	}

	return $list;
}
