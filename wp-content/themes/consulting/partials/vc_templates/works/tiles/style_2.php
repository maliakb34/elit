<?php
$css_class .= ' ' . $style;

if ( empty( $works_count ) ) {
	$works_count = 11;
}

$all_works = new WP_Query(
	array(
		'post_type'      => 'stm_works',
		'posts_per_page' => $works_count,
	)
);

$works_id = uniqid( 'stm_works_' );
if ( $all_works->have_posts() ) :
	?>

	<div class="stm_works<?php echo esc_attr( $css_class ); ?> style_2">
		<?php
		$works_per_row          = 4;
		$current_row_capability = 0;
		$current_row_odd        = true;
		$col_counter            = 0;
		while ( $all_works->have_posts() ) :
			$all_works->the_post();
			$index_in_row = $all_works->current_post % 4;
			$rest         = $all_works->post_count - $all_works->current_post;
			if ( 0 === $index_in_row ) {
				$current_row_capability = ( $rest >= 4 ) ? 4 : $all_works->post_count % 4;
			}
			if ( 0 === $index_in_row ) :
				?>
				<div class="group items-
					<?php
					echo esc_attr( $current_row_capability );
					echo ( false === $current_row_odd ) ? ' even' : '';
					?>
				">
					<?php
					$col_counter = 0;
				endif;
			if ( ( 4 > $current_row_capability ) || ( 4 === $current_row_capability && 2 !== $index_in_row ) ) :
				?>
			<div class="col col-<?php echo esc_attr( $col_counter + 1 ); ?>">
		<?php endif; ?>

			<div class="item item-<?php echo esc_attr( $all_works->current_post + 1 ); ?> item-in-row-<?php echo esc_attr( $index_in_row + 1 ); ?>">
				<a href="<?php the_permalink(); ?>" class="item-inner">
					<?php
					$image_size = '480x425';
					if ( 4 === $current_row_capability ) {
						if ( $current_row_odd ) {
							switch ( $index_in_row ) {
								case 0:
									$image_size = '475x880';
									break;
								case 3:
									$image_size = '780x880';
									break;
								default:
									$image_size = '480x425';
									break;
							}
						} else {
							switch ( $index_in_row ) {
								case 0:
									$image_size = '780x880';
									break;
								case 3:
									$image_size = '475x880';
									break;
								default:
									$image_size = '480x425';
									break;
							}
						}
					} elseif ( 3 === $current_row_capability ) {
						switch ( $index_in_row ) {
							case 1:
								$image_size = '780x425';
								break;
							default:
								$image_size = '480x425';
								break;
						}
					}
					$term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' );
					if ( has_post_thumbnail() ) :
						?>
						<div class="work-image">
							<?php
							$post_thumbnail = consulting_get_image( get_post_thumbnail_id(), $image_size );
							echo wp_kses_post( $post_thumbnail );
							?>
						</div>
					<?php endif; ?>
					<div class="work-info">
						<h4><?php the_title(); ?></h4>
						<?php if ( ! empty( $term_list ) ) : ?>
							<div class="work-category">
								<?php echo esc_html( $term_list[0]->name ); ?>
							</div>
						<?php endif; ?>
						<div class="more">See More <i class="stm-right-arrow"></i></div>
					</div>
				</a>
			</div> <!-- End of .item -->

			<?php if ( ( $current_row_capability < 4 ) || ( 4 === $current_row_capability && 1 !== $index_in_row ) ) : ?>
			</div> <!-- End of .col -->
				<?php
				$col_counter ++;
			endif;
			if ( ( ( $current_row_capability - 1 ) === $index_in_row ) || ( $all_works->current_post === $all_works->post_count ) ) :
				?>
				</div> <!-- End of .group -->
				<?php
				$current_row_odd = ! $current_row_odd;
				endif;
			endwhile;
		?>
	</div>
	<?php
endif;
wp_reset_postdata();
?>
