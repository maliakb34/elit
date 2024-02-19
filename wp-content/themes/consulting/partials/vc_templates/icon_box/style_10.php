<?php

if ( $v_align_middle ) {
	$css_class .= ' middle';
}

if ( $enable_hexagon ) {
	$css_class .= ' hexagon';
	if ( $enable_hexagon_animation ) {
		$css_class .= ' hexanog_animation';
	}
}

if ( ! empty( $box_style ) ) {
	$css_class .= ' ' . $box_style;
}

$title_classes = array();
$title_class   = '';

if ( ! empty( $title_color ) && 'custom' != $title_color ) {
	$title_classes[] = 'font-color_' . esc_attr( $title_color );
}

if ( $hide_title_line || 'hide_title_line' === $hide_title_line ) {
	$title_classes[] = 'no_stripe';
}

if ( ! empty( $title_classes ) ) {
	$title_class = ' class="' . join( ' ', $title_classes ) . '"';
}

$title_style  = '';
$title_styles = array();
if ( ! empty( $title_font_size ) ) {
	$title_styles[] = 'font-size:' . esc_attr( $title_font_size ) . 'px';
}

if ( ! empty( $title_line_height ) ) {
	$title_styles[] = 'line-height:' . esc_attr( $title_line_height ) . 'px';
}

if ( 'custom' == $title_color && ! empty( $title_color_custom ) ) {
	$title_styles[] = 'color:' . esc_attr( $title_color_custom );
}

if ( ! empty( $title_styles ) ) {
	$title_style = ' style="' . implode( ';', $title_styles ) . '"';
}

$icon_class = '';

if ( ! empty( $icon_color ) && 'custom' != $icon_class ) {
	$icon_class .= ' font-color_' . esc_attr( $icon_color );
}

if ( ! empty( $icon_bg_color ) && 'custom' != $icon_class ) {
	$icon_class .= ' font-color_' . esc_attr( $icon_bg_color );
}

$icon_styles = array();
$icon_style  = '';

if ( 'custom' == $icon_bg_color && ! empty( $icon_bg_color_custom ) ) {
	$icon_styles[] = 'color:' . esc_attr( $icon_bg_color_custom );
}

if ( ! empty( $icon_styles ) ) {
	$icon_style = ' style="' . join( ';', $icon_styles ) . '"';
}

if ( ! isset( $link['target'] ) || ! $link['target'] ) {
	$link['target'] = '_self';
}
?>

<a href="<?php echo isset( $link['url'] ) ? esc_url( $link['url'] ) : '#'; ?>" target="<?php echo esc_attr( $link['target'] ); ?>"
   class="icon_box <?php echo esc_attr( $css_class ); ?> clearfix">
	<div class="icon_box_inner">
		<?php if ( $icon ) { ?>
			<div class="icon <?php echo esc_attr( $icon_class ); ?>" <?php echo esc_html( $icon_style ); ?>>
				<i style="
				<?php
				echo 'font-size: ' . esc_attr( $icon_size ) . 'px';
				if ( isset( $icon_color_custom ) && 'custom' == $icon_color ) {
					echo 'color:' . esc_attr( $icon_color_custom ) . ';';
				}
				if ( $icon_line_height ) {
					echo 'line-height: ' . esc_attr( $icon_line_height ) . 'px;';
				}
				if ( $icon_border_color_custom ) {
					echo 'border-color: ' . esc_attr( $icon_border_color_custom );
				}
				?>
						"
				   class="<?php echo esc_attr( $icon ); ?>"></i></div>
			<div class="icon_bg"><i class="<?php echo esc_attr( $icon ); ?>"></i></div>
			<?php
		}
		if ( $title ) {
			?>
			<h4
				<?php
				echo esc_html( $title_style );
				echo esc_html( $title_class );
				?>
			>
				<?php echo wp_kses( $title, array( 'br' => array() ) ); ?>
			</h4>
			<?php
		}
		if ( $content ) {
			?>
			<div class="icon_text">
				<?php echo wp_kses_post( consulting_filtered_output( $content ) ); ?>
			</div>
		<?php } ?>
	</div>
</a>
