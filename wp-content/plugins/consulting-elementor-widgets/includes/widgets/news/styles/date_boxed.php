<?php
$image_size = $settings['image_size'];

if ( ! $image_size ) {
	$image_size = 'consulting-image-350x250-croped';
}

if ( stm_check_layout( 'layout_13' ) ) {
	$image_size = 'consulting-image-320x320-croped';
}

$i = 0;

if ( empty( $image_size ) ) {
	$image_size = '720x500';
}

$post_terms = get_post_terms( get_the_ID(), get_post_type(), ', ' );

?>
<li class="post_item <?php echo 'date_box_' . esc_attr( $settings['date_box_alignment'] ); ?>">
	<div class="post_inner">
		<?php
		if ( has_post_thumbnail() ) {
			?>
			<div class="image">
				<a href="<?php the_permalink(); ?>">
					<?php echo wp_kses_post( consulting_get_image( get_post_thumbnail_id(), $image_size ) ); ?>
				</a>
				<div class="date-wrap">
					<?php echo get_the_date(); ?>
				</div>
			</div>
			<?php
		}
		?>
		<div class="news_item_info">
			<h5 class="news_item_title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h5>
			<?php
			if ( 'show' === $settings['show_category'] ) {
				?>
				<div class="category">
					<?php echo wp_kses_post( $post_terms ); ?>
				</div>
				<?php
			}
			if ( 'show' === $settings['disable_excerpt'] ) {
				?>
				<div class="news_info">
					<?php
					the_excerpt();
					?>
				</div>
				<?php
			}
			if ( 'show' === $settings['disable_button'] ) {
				?>
				<div class="news_info_bottom">
					<a href="<?php the_permalink(); ?>" class="news_item_button">
						<?php
						if ( 'before' === $settings['button_icon_position'] ) {
							\Elementor\Icons_Manager::render_icon(
								$settings['button_icon'],
								array(
									'aria-hidden' => 'true',
									'class'       => 'button_icon before_icon',
								)
							);
						}
						echo esc_html( $settings['button_text'] );
						if ( 'after' === $settings['button_icon_position'] ) {
							\Elementor\Icons_Manager::render_icon(
								$settings['button_icon'],
								array(
									'aria-hidden' => 'true',
									'class'       => 'button_icon after_icon',
								)
							);
						}
						?>
					</a>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</li>
