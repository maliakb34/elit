<?php
$list      = $settings['list'];
$box_style = $settings['box_style'];

$image_size = ! empty( $settings['image_size'] ) ? $settings['image_size'] : 'full';

if ( ! empty( $list ) ) {
	?>
	<div class="company_history <?php echo esc_attr( $box_style ); ?>">
		<div class="history_wrapper">
			<?php
			foreach ( $list as $item ) {
				?>
				<div class="history-item">
					<?php
					if ( ! empty( $item['icon']['value'] ) && 'show' === $settings['show_icon'] ) {
						?>
						<div class="point">
							<?php
							\Elementor\Icons_Manager::render_icon(
								$item['icon'],
								array(
									'aria-hidden' => 'true',
									'class'       => 'point_icon',
								)
							);
							?>
						</div>
						<?php
					} else {
						?>
						<div class="point-no-icon"></div>
						<?php
					}
					?>
					<div class="item-info">
						<div class="year-wrapper">
							<span class="year"><?php echo esc_html( $item['year'] ); ?></span>
						</div>
						<div class="item-title-wrapper">
							<h3 class="item-title">
								<?php echo esc_html( $item['title'] ); ?>
							</h3>
						</div>
						<div class="item-description-wrapper">
							<p class="item-description">
								<?php echo wp_kses_post( strip_tags( $item['description'], '<br><strong><span>' ) ); ?>
							</p>
						</div>
					</div>
					<?php
					if ( 'show' === $settings['show_image'] ) {
						if ( ! empty( $item['image']['url'] ) && ! empty( $item['image']['id'] ) ) {
							?>
							<div class="image-wrapper">
								<?php echo wp_get_attachment_image( $item['image']['id'], $image_size ); ?>
							</div>
							<?php
						} else {
							?>
							<div class="image-wrapper">
								<?php
								echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'full', 'image' ) );
								?>
							</div>
							<?php
						}
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
