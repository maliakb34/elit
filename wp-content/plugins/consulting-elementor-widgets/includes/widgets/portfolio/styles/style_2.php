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
<div class="portfolio_item all<?php echo esc_attr( $category_name ); ?>">

	<div class="portfolio_item_thumbnail">
		<?php
		if ( has_post_thumbnail() ) {
			echo wp_kses_post( $thumbnail );
		} else {
			?>
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/tmp/placeholder.gif' ); ?>"
					alt="<?php esc_attr_e( 'Placeholder', 'consulting' ); ?>"/>
		<?php } ?>
		<a href="<?php the_permalink(); ?>" class="portfolio_link">
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
</div>
