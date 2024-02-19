<?php
$image_size = $settings['image_size'];

if ( ! $image_size ) {
	$image_size = '260x170';
}

$i = 0;

$post_terms = get_post_terms( get_the_ID(), get_post_type(), ', ' );
?>
<li class="post_item">
	<div class="post_inner">
		<?php
		if ( 'show' === $settings['show_image'] ) {
			?>
			<div class="image">
				<a href="<?php the_permalink(); ?>">
					<?php
					$attachment_id = get_post_thumbnail_id( get_the_ID() );
					$thumbnail     = consulting_get_image( $attachment_id, $image_size );
					echo wp_kses_post( consulting_filtered_output( $thumbnail ) );
					?>
				</a>
			</div>
			<?php
		}
		?>
		<div class="news_item_info">
			<?php
			if ( 'show' === $settings['show_category'] ) {
				?>
				<div class="category">
					<?php echo wp_kses_post( $post_terms ); ?>
				</div>
				<?php
			}
			?>
			<h5 class="news_item_title <?php echo 'line_' . esc_attr( $settings['show_title_line'] ); ?>">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h5>
			<?php
			if ( 'show' === $settings['disable_excerpt'] ) {
				?>
				<div class="news_info">
					<?php
					the_excerpt();
					?>
				</div>
				<?php
			}
			?>
			<div class="news_info_bottom">
				<?php
				if ( 'show' === $settings['show_date'] ) {
					?>
					<div class="date <?php echo 'icon_' . esc_attr( $settings['date_icon_position'] ); ?>">
						<span class="news_item_date"><?php echo get_the_date(); ?></span>
					</div>
					<?php
				}
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
	</div>
</li>
