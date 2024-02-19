<?php
/**
 * @var $css_class
 * @var $style
 * @var $per_row
 * @var $image_style
 * @var $image_size
 * @var $count
 * @var $category
 * @var $link
 */

$css_class .= ' ' . $style . ' cols_' . $per_row . ' short-view ' . $image_style;

if ( isset( $image_leaf_rounded_corners ) ) {
	$css_class .= ' ' . $image_leaf_rounded_corners;
}

$args = array(
	'post_type'      => 'stm_staff',
	'posts_per_page' => $count,
);

if ( 'all' !== $category ) {
	$args['stm_staff_category'] = $category;
}

$staff = new WP_Query( $args );

$len = 95;

?>

<?php if ( $staff->have_posts() ) : ?>
	<div class="staff_list<?php echo esc_attr( $css_class ); ?>">
		<ul>
			<?php
			while ( $staff->have_posts() ) :
				$staff->the_post();
				?>
				<li>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="staff_image">
							<a href="<?php the_permalink(); ?>">
								<?php
								if ( stm_check_layout( 'layout_osaka' ) || stm_check_layout( 'layout_ankara' ) ) {
									the_post_thumbnail( 'thumbnail' );
								} else {
									the_post_thumbnail( $image_size );
								}
								?>
							</a>
						</div>
					<?php endif; ?>
					<div class="staff_info">
						<h4 class="no_stripe">
							<a href="<?php the_permalink(); ?>" class="secondary_font_color_hv text_decoration_none"><?php the_title(); ?></a>
						</h4>
						<?php $department = get_post_meta( get_the_ID(), 'department', true ); ?>
						<?php if ( $department ) : ?>
							<div class="staff_department">
								<?php echo esc_html( $department ); ?>
							</div>
						<?php endif; ?>
						<?php $excerpt = consulting_substr_text( get_the_excerpt(), $len ); ?>
						<?php if ( $excerpt ) : ?>
							<p><?php echo esc_html( $excerpt ); ?></p>
						<?php endif; ?>
						<a class="read_more" href="<?php the_permalink(); ?>">
							<span><?php esc_html_e( 'view profile', 'consulting' ); ?></span>
							<i class=" fa fa-chevron-right stm_icon"></i>
						</a>
					</div>
				</li>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
			<?php if ( isset( $link ) && $link['url'] ) : ?>
				<li class="staff_custom_link">
					<a href="<?php echo esc_url( $link['url'] ); ?>">
						<?php if ( ! empty( $link['title'] ) || ! empty( $link_text ) ) : ?>
							<span>
							<?php if ( ! empty( $link['title'] ) ) : ?>
								<span class="staff_custom_link_title"><?php echo esc_html( $link['title'] ); ?></span>
							<?php endif; ?>
							<?php echo esc_html( $link_text ); ?>
							</span>
						<?php endif; ?>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>
