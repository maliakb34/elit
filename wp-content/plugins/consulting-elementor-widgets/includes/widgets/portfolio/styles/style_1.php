<div class="portfolio_item all<?php

$category_name = '';
$term_list     = wp_get_post_terms( get_the_ID(), 'stm_portfolio_category' );
if ( $term_list ) {
	foreach ( $term_list as $term ) {
		$category_name .= ' ' . $term->slug;
	}
}

if ( 2 === $settings['count'] ) {
	$settings['image_type'] = ' tall';
	$image_size             = '370x470';
} elseif ( 3 === $settings['count'] || 8 === $settings['count'] ) {
	$settings['image_type'] = ' wide';
	$image_size             = '740x240';
} else {
	$settings['image_type'] = ' default';
	$image_size             = '370x240';
}
echo esc_attr( $settings['image_type'] );

echo esc_attr( $category_name );
?>">

	<a href="<?php the_permalink(); ?>" class="portfolio_link">
		<?php
		if ( has_post_thumbnail() ) {
			echo consulting_filtered_output( consulting_get_image( get_post_thumbnail_id(), $image_size ) ); // phpcs:ignore
		} else {
			?>
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>"
					alt="<?php esc_attr_e( 'Placeholder', 'consulting' ); ?>"/>
			<?php
		}
		?>
		<span class="portfolio_info">
			<?php
			the_title();
			if ( $term_list ) {
				?>
				<span class="portfolio_category"><?php echo esc_html( $term_list[0]->name ); ?></span>
			<?php } ?>
		</span>
	</a>
</div>
