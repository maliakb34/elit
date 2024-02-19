<?php
$attachment_id = get_post_thumbnail_id( get_the_ID() );
if ( ! empty( $attachment_id ) ) {
	$thumbnail = consulting_get_image( $attachment_id, 'large' );
}
$category_name = '';
$term_list     = wp_get_post_terms( get_the_ID(), 'stm_portfolio_category' );
if ( $term_list ) {
	foreach ( $term_list as $term ) {
		$category_name .= ' ' . $term->slug;
	}
}

?>
<div class="portfolio_item list<?php echo esc_attr( $category_name ); ?>">
	<a href="<?php the_permalink(); ?>" class="portfolio_link">
			<span class="portfolio_item_thumbnail">
				<?php
				if ( has_post_thumbnail() ) {
					echo wp_kses_post( $thumbnail );
				} else {
					?>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>"
							alt="<?php esc_attr_e( 'Placeholder', 'consulting' ); ?>"/>
					<?php
				}
				?>
			</span>
	</a>
	<div class="portfolio_info_wrapper">
		<?php if ( $term_list ) { ?>
			<div class="portfolio_category_wrapper">
				<?php echo esc_html( $term_list[0]->name ); ?>
			</div>
		<?php } ?>
		<div class="portfolio_title">
			<?php the_title(); ?>
		</div>
		<div class="portfolio_description">
			<?php the_excerpt(); ?>
		</div>
		<a href="<?php the_permalink(); ?>"
				class="portfolio_read_more_button">
			<?php
			echo esc_html__( 'Read More', 'consulting-elementor-widgets' );
			\Elementor\Icons_Manager::render_icon(
				$settings['read_more_icon'],
				array(
					'aria-hidden' => 'true',
					'class'       => 'read_more_icon',
				)
			);
			?>
		</a>
	</div>
</div>
