<?php
/**
 * @var $css_class
 * @var $style
 * @var $per_row
 * @var $image_style
 * @var $count
 * @var $category
 * @var $link
 */

$css_class .= ' ' . $style . ' cols_' . $per_row . ' ' . $image_style;

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

$len = 165;

?>

<?php if ( $staff->have_posts() ) : ?>
	<div class="staff_list<?php echo esc_attr( $css_class ); ?>">
		<ul class="staff_with_icons">
			<?php
			while ( $staff->have_posts() ) :
				$staff->the_post();
				?>
				<li>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="staff_image">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'consulting-image-550x550-croped' ); ?>
							</a>
							<ul class="staff_socials hidden">
								<?php
								$staff_socials = array(
									'facebook'    => 'fa fa-facebook',
									'twitter'     => 'fa fa-twitter',
									'google_plus' => 'fa fa-google-plus',
									'linkedin'    => 'fa fa-linkedin',
								);

								foreach ( $staff_socials as $staff_social => $staff_social_icon ) {
									$staff_social_link = get_post_meta( get_the_ID(), $staff_social, true );
									if ( $staff_social_link ) :
										?>
										<li class="staff_<?php echo esc_attr( $staff_social ); ?>">
											<a href="<?php echo esc_url( $staff_social_link ); ?>">
												<i class="<?php echo esc_attr( $staff_social_icon ); ?>"></i>
											</a>
										</li>
										<?php
									endif;
								}
								?>
							</ul>
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
