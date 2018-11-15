<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Module_Settings {


	public function __construct() {

		if ( is_admin() ) {

			add_action( 'admin_menu', array( $this, 'add_toolbox_menu' ) );

			add_action( 'admin_init', array( $this, 'add_toolbox_settings' ) );

		} // End if

		add_action( 'init', array( $this, 'add_options_check' ) );

	} // End __construct


	public function add_options_check() {

		$registered_modules = get_wsuwp_toolbox_registered_modules();

		foreach ( $registered_modules as $id => $m_class ) {

			$key = get_wsuwp_toolbox_module_key( $id );

			$module = get_wsuwp_toolbox_module( $id );

			if ( $module ) {

				add_filter( 'pre_update_option_' . $key, array( $module, 'check_module_save_option' ), 10, 3 );

			} // End if
		} // End foreach

	} // End add_options_check


	public function add_toolbox_settings() {

		$registered_modules = get_wsuwp_toolbox_registered_modules();

		foreach ( $registered_modules as $id => $m_class ) {

			register_setting(
				'wsuwp_toolbox',
				get_wsuwp_toolbox_module_key( $id ),
				array(
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

		} // End foreach

		add_settings_section(
			'wsuwp_toolbox_tools_section',         // ID used to identify this section and with which to register options
			'Tools & Options',                  // Title to be displayed on the administration page
			array( $this, 'add_wsu_toolbox_tools_desc' ), // Callback used to render the description of the section
			'wsuwp_toolbox'                           // Page on which to add this section of options
		);

		add_settings_field(
			'wsu_toolbox_tools',                      // ID used to identify the field throughout the theme
			'Tools',                           // The label to the left of the option interface element
			array( $this, 'add_wsu_toolbox_tools_fields' ),   // The name of the function responsible for rendering the option interface
			'wsuwp_toolbox',                          // The page on which this option will be displayed
			'wsuwp_toolbox_tools_section',         // The name of the section to which this field belongs
			array(                              // The array of arguments to pass to the callback. In this case, just a description.
				'Activate this setting to display the header.',
			)
		);

	} // End add_toolbox_settings


	public function add_wsu_toolbox_tools_fields() {

		$modules = array();

		$registered_modules = get_wsuwp_toolbox_registered_modules();

		echo '<div class="wsuwp-toolbox-modules-wrapper">';

		foreach ( $registered_modules as $id => $module_class ) {

			$module = get_wsuwp_toolbox_module( $id );

			if ( $module ) {

				$owner        = $module->get_owner();
				$title        = $module->get_title();
				$desc         = $module->get_description();
				$icon         = $module->get_icon();
				$version      = $module->get_version();
				$capabilities = $module->get_capabilities();
				$default_on   = $module->is_default_on();
				$is_active    = wsuwp_toolbox_is_active_module( $id, $default_on );

				include __DIR__ . '/displays/module-card.php';

			} // End if
		} // End foreach

		echo '</div>';

	} // End add_wsu_toolbox_tools_fields


	public function add_wsu_toolbox_tools_desc() {

	} // End add_wsu_toolbox_tools_desc


	public function add_toolbox_menu() {

		add_menu_page(
			'Tools and Features for WSU sites',
			'WSU Toolbox',
			'administrator',
			'wsuwp_toolbox',
			array( $this, 'add_toolbox_page' ),
			'' // Icon
		);

	} // End add_toolbox_menu


	public function add_toolbox_page() {

		include __DIR__ . '/displays/select-tools.php';

	} // End add_toolbox_page

} // End Module_Script

$module_settings = new Module_Settings();
