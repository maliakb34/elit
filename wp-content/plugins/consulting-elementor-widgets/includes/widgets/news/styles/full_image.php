<?php
$image_size = $settings['image_size'];

$image_type = ' default';
if ( ! $image_size ) {
	$image_size = 'consulting-image-350x250-croped';
}

if ( 'masonry' === $settings['style_appearance'] ) {
	$i = $settings['count'];

	$image_size = '350x250';
	if ( $i % 2 ) {
		$image_size = '350x390';
		$image_type = ' tall';
	}
}

$post_terms = get_post_terms( get_the_ID(), get_post_type(), '' );

?>
<li class="post_item">
	<div class="post_inner">
		<div class="image<?php echo esc_attr( $image_type ); ?>">
			<div class="date-wrap">
				<?php echo get_the_date(); ?>
			</div>
			<?php
			if ( has_post_thumbnail() ) {
				echo consulting_filtered_output( consulting_get_image( get_post_thumbnail_id(), $image_size ) ); // phpcs:ignore
			} else {
				?>
				<img src="<?php echo esc_url( CONSULTING_ELEMENTOR_URL . 'assets/images/placeholder.gif' ); ?>" width="350" height="250">
				<?php
			}
			if ( 'show' === $settings['show_category'] ) {
				?>
				<div class="category">
					<div class="post-categories">
						<?php echo wp_kses_post( $post_terms ); ?>
					</div>
				</div>
				<?php
			}

			?>
			<h5 class="news_item_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<?php
			if ( 'show' === $settings['disable_button'] ) {
				?>
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
				<?php
			}
			?>
		</div>
	</div>
</li>
