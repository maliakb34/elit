<?php
$list      = $settings['list'];
$css_class  = $settings['box_style'];

if ( is_rtl() ) {
	$css_class .= ' rtl';
}
$id         = uniqid( 'timeline_' );
$image_size = ! empty( $settings['image_size'] ) ? $settings['image_size'] : 'full';
if ( ! empty( $list ) ) {
	?>
	<div class="company_history <?php echo esc_attr( $css_class ); ?>">
		<div class="history_wrapper <?php echo 'column_count_' . esc_attr( $settings['column_count'] ); ?>" data-id="<?php echo esc_attr( $id ); ?>" data-column="<?php echo esc_attr( $settings['column_count'] ); ?>" data-nav-left="<?php echo ! empty( $settings['navigation_previous_icon']['value'] ) ? esc_js( $settings['navigation_previous_icon']['value'] ) : 'fa fa-angle-left'; ?>" data-nav-right="<?php echo ! empty( $settings['navigation_next_icon']['value'] ) ? esc_js( $settings['navigation_next_icon']['value'] ) : 'fa fa-angle-right'; ?>">
			<?php
			$i = 1;
			foreach ( $list as $item ) {
				?>
				<div class="history-item <?php echo 0 === $i % 2 ? esc_attr( 'reversed' ) : 'default'; ?>">
					<?php
					if ( ! empty( $item['icon']['value'] ) && 'show' === $settings['show_icon'] ) {
						?>
						<div class="point-icon">
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
						<div class="point"></div>
						<?php
					}
					?>
					<div class="item-info">
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
					<div class="year-wrapper">
						<span class="year"><?php echo esc_html( $item['year'] ); ?></span>
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
									echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, '220x150', 'image' ) );
									?>
								</div>
								<?php
							}
						}
						?>
					</div>

				</div>
				<?php
				$i ++;
			}
			?>
		</div>
	</div>
	<?php
}
