<?php
/**
 * @var $css_class
 * @var $style
 * @var $posts_per_page
 * @var $category
 * @var $service_title
 * @var $service_excerpt
 * @var $service_more
 */

if ( empty( $posts_per_row ) ) {
	$posts_per_row = 4;
}
$css_class .= ' ' . $style;
$css_class .= ' cols_' . $posts_per_row;

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args  = array(
	'post_type'      => 'stm_service',
	'posts_per_page' => $posts_per_page,
	'paged'          => $paged,
);

$categories = get_terms( 'stm_service_category' );

if ( empty( $img_size ) ) {
	$img_size = 'consulting-image-255x182-croped';
}

if ( 'all' !== $category ) {
	$args['stm_service_category'] = $category;
}

if ( ! empty( $title_color ) ) {
	$title_color = 'style=color:' . $title_color;
} else {
	$title_color = '';
}

if ( ! empty( $excerpt_color ) ) {
	$excerpt_color = 'style=color:' . $excerpt_color;
} else {
	$excerpt_color = '';
}

if ( ! empty( $link_color ) ) {
	$link_color = 'style=color:' . $link_color;
} else {
	$link_color = '';
}

$services = new WP_Query( $args );

$count_posts     = wp_count_posts( 'stm_service' );
$published_posts = $count_posts->publish;

?>

<?php if ( $services->have_posts() ) : ?>
	<div class="stm_services<?php echo esc_attr( $css_class ); ?>">
		<?php
		while ( $services->have_posts() ) :
			$services->the_post();
			?>
			<div class="stm_service">
				<div class="stm_service__icon">
					<i class="<?php echo esc_attr( get_post_meta( get_the_ID(), 'service_icon', true ) ); ?>"></i>
				</div>
				<?php if ( ! $service_title ) : ?>
					<h3 class="stm_service__title">
						<a href="<?php the_permalink(); ?>" <?php echo esc_attr( $title_color ); ?>>
							<?php the_title(); ?>
						</a>
					</h3>
				<?php endif; ?>

				<?php if ( ! $service_excerpt && get_the_excerpt() ) : ?>
					<div class="stm_service__excerpt" <?php echo esc_attr( $excerpt_color ); ?>>
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! $service_more ) : ?>
					<a href="<?php the_permalink(); ?>" class="stm_service__link" <?php echo esc_attr( $link_color ); ?>><span><?php echo esc_html__( 'Learn more', 'consulting' ); ?></span> <i class="stm-right-arrow"></i></a>
				<?php endif; ?>
			</div>
		<?php endwhile; ?>
	</div>
<?php endif;
wp_reset_postdata(); ?>
