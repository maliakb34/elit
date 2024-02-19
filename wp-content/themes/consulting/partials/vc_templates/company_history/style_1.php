<?php
/**
 * @var $list
 */

if ( ! empty( $list ) ) : ?>

	<div class="company_history <?php echo esc_attr( $box_style ); ?>">
		<ul>
	<?php foreach ( $list as $company_item ) : ?>
			<li>
		<?php if ( ! empty( $company_item['year'] ) ) : ?>
				<div class="year"><?php echo esc_html( $company_item['year'] ); ?></div>
		<?php endif; ?>
				<div class="sep"></div>
				<div class="company_history_text">
		<?php if ( ! empty( $company_item['title'] ) ) : ?>
					<h4 class="no_stripe company_history_top_title"><?php echo esc_html( $company_item['title'] ); ?></h4>
			<?php
		endif;
		if ( ! empty( $company_item['description'] ) ) :
			echo wp_kses_post( wpautop( $company_item['description'] ) );
			endif;
		?>
				</div>
			</li>
	<?php endforeach; ?>
		</ul>
	</div>
	<?php
endif;
