<?php
$posts_id       = get_the_ID();
$is_shop        = false;
$is_product     = false;
$page_for_posts = get_option( 'page_for_posts' );
if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) {
	$posts_id = $page_for_posts;
}
if ( ( function_exists( 'is_shop' ) && is_shop() )
	 || ( function_exists( 'is_product_category' ) && is_product_category() )
	 || ( function_exists( 'is_product_tag' ) && is_product_tag() )
) {
	$is_shop = true;
}
if ( function_exists( 'is_product' ) && is_product() ) {
	$is_product = true;
}
if ( $is_shop ) {
	$posts_id = get_option( 'woocommerce_shop_page_id' );
}

$class = 'page_title';
if ( 'on' === get_post_meta( $posts_id, 'enable_transparent', true ) && metadata_exists( 'post', $posts_id, 'enable_transparent' ) ) {
	$class .= ' transparent';
} elseif ( 'default' === get_post_meta( $posts_id, 'enable_transparent', true ) && true === consulting_theme_option( 'metabox_enable_transparent' ) ) {
	$class .= ' transparent';
}
if ( 'on' === get_post_meta( $posts_id, 'disable_title', true ) && metadata_exists( 'post', $posts_id, 'disable_title' ) ) {
	$class .= ' disable_title';
} elseif ( 'default' === get_post_meta( $posts_id, 'metabox_disable_title', true ) && true === consulting_theme_option( 'metabox_disable_title' ) ) {
	$class .= ' disable_title';
}

if ( metadata_exists( 'post', $posts_id, 'disable_title_box' ) ) {
	$disable_title_box = ( 'default' === get_post_meta( $posts_id, 'disable_title_box', true ) ) ? consulting_theme_option( 'metabox_disable_title_box' ) : get_post_meta( $posts_id, 'disable_title_box', true );
} else {
	$disable_title_box = 'on';
}

$disable_title       = ( 'default' === get_post_meta( $posts_id, 'disable_title', true ) ) ? consulting_theme_option( 'metabox_disable_title' ) : get_post_meta( $posts_id, 'disable_title', true );
$disable_breadcrumbs = ( 'default' === get_post_meta( $posts_id, 'disable_breadcrumbs', true ) ) ? consulting_theme_option( 'metabox_disable_breadcrumbs' ) : get_post_meta( $posts_id, 'disable_breadcrumbs', true );

if ( '' === $disable_title_box ) {
	?>
	<div class="<?php echo esc_attr( $class ); ?>">
		<div class="container">
			<?php
			if ( '' === $disable_breadcrumbs ) {
				consulting_breadcrumbs();
			}
			?>
			<?php
			if ( '' === $disable_title ) {
				if ( consulting_page_title( false, esc_html__( 'News', 'consulting' ), esc_html__( 'Careers', 'consulting' ) ) ) {
					?>
					<h1 class="h2">
						<?php
						echo consulting_page_title( // phpcs:ignore
							false,
							esc_html__( 'News', 'consulting' ),
							esc_html__( 'Careers', 'consulting' )
						);
						?>
					</h1>
					<?php
				}
			}
			?>
		</div>
	</div>
	<?php
}
