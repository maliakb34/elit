<?php
/**
 * @var $field
 * @var $field_id
 * @var $field_value
 * @var $field_label
 * @var $field_name
 * @var $section_name
 */

wp_enqueue_script( 'stm-hidden-field', STM_POST_TYPE_PATH . '/theme-options/assets/js/hidden-field.js', null, STM_POST_TYPE_PLUGIN_VERSION, true );

?>
<hidden-field :fields="<?php echo esc_attr( $field ); ?>"
	:field_label="<?php echo esc_attr( $field_label ); ?>"
	:field_name="'<?php echo esc_attr( $field_name ); ?>'"
	:field_id="'<?php echo esc_attr( $field_id ); ?>'"
	:field_value="<?php echo esc_attr( $field_value ); ?>"
	@wpcfto-get-value="<?php echo esc_attr( $field_value ); ?> = $event">
</hidden-field>

