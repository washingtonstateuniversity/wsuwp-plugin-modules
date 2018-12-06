<select name="wsuwp_toolbox_retargetting_location">
	<?php foreach ( $location_options as $value => $label ) : ?>
	<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $current_location ); ?>>
		<?php echo esc_html( $label ); ?>
	</option>
	<?php endforeach; ?>
</select>
