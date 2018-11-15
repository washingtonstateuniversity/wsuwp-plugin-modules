
<div class="wsuwp-toolbox-module-card<?php if ( $is_active ) : ?> is-active-module<?php endif; ?>">
	<span class="wsuwp-toolbox-module-card-owner"><?php echo esc_html( $owner ); ?></span>
	<span class="wsuwp-toolbox-module-card-icon" style="background-image:url(<?php echo esc_attr( $icon ); ?>);"></span>
	<span class="wsuwp-toolbox-module-card-title"><?php echo esc_html( $title ); ?></span>
	<span class="wsuwp-toolbox-module-card-desc"><?php echo esc_html( $desc ); ?></span>
	<span class="wsuwp-toolbox-module-card-activate">
		<?php if ( $is_active ) : ?>
			<button type="submit" name="<?php echo esc_attr( get_wsuwp_toolbox_module_key( $id ) ); ?>" value="inactive">Deactivate</button>
		<?php else : ?>
			<button type="submit" name="<?php echo esc_attr( get_wsuwp_toolbox_module_key( $id ) ); ?>" value="active">Activate</button>
		<?php endif; ?>
	</span>
</div>
