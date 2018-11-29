<style>
</style>
<div class="wsuwp-toolbox-fonts-wrap">
	<h1>WSU Toolbox Fonts</h1>
	<form class="wsuwp-toolbox-tools-form" action="options.php" method="post">
	<?php settings_fields( 'wsuwp_toolbox_fonts' ); ?>
		<?php do_settings_sections( 'wsuwp_toolbox_fonts' ); ?>
		<?php submit_button(); ?>
		</form>
</div>
