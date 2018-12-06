<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class WSUWP_Retargetting_Module extends Module {

	/**
	 * Version of module.
	 *
	 * @since 0.0.1
	 * @var string $version Version of module.
	 */
	protected $version = '0.0.1';

	/**
	 * Slug/ID for the module.
	 *
	 * @since 0.0.1
	 * @var string|bool $slug
	 */
	public $slug = 'wsuwp_retargetting';

	/**
	 * Registration args for the module
	 *
	 * @since 0.0.1
	 * @var array $register_args Array of registration args
	 */
	public $register_args = array(
		'title'        => 'Add Retarget Code',
		'description'  => 'Allow placement of retargetting code.',
		'priority'     => 10,
		'capability'   => 'super admin',
		'default_on'   => false,
	); // End $register_args


	/**
	 * Do the module. This should already have checked for active.
	 *
	 * @since 0.0.1
	 *
	 */
	protected function init_module() {

		if ( is_admin() ) {

			add_action( 'admin_menu', array( $this, 'add_wsuwp_retargetting_menu_item' ) );

			add_action( 'admin_init', array( $this, 'add_toolbox_retargetting_settings' ) );

		} // End if

		$this->add_retargetting_code();

	} // End do_module


	protected function add_retargetting_code() {

		$current_location = get_option( 'wsuwp_toolbox_retargetting_location', '' );

		if ( ! empty( $current_location ) ) {

			switch ( $current_location ) {

				case 'footer':
					add_action( 'wp_footer', array( $this, 'the_retargetting_code' ), 99 );
					break;
				case 'head':
					add_action( 'wp_head', array( $this, 'the_retargetting_code' ), 99 );
					break;

			} // End switch
		} // End if

	} // End add_retargetting_code


	public function the_retargetting_code() {

		$code = get_option( 'wsu_toolbox_retargetting_code', '' );

		echo $code;

	} // End the_retargetting_code


	public function add_wsuwp_retargetting_menu_item() {

		add_submenu_page(
			'wsuwp_toolbox',
			'Add Retargetting Code',
			'Retargetting Code',
			'Super Admin',
			'wsuwp_retargetting',
			array( $this, 'add_retargetting_page' )
		);

	} // End add_toolbox_menu


	public function add_toolbox_retargetting_settings() {

		register_setting(
			'wsuwp_toolbox_retargetting',
			'wsuwp_toolbox_retargetting_location',
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		register_setting(
			'wsuwp_toolbox_retargetting',
			'wsu_toolbox_retargetting_code',
			array(
				'sanitize_callback' => array( $this, 'sanitize_code' ),
			)
		);

		add_settings_section(
			'wsuwp_toolbox_retargetting_section',         // ID used to identify this section and with which to register options
			'Add Retargetting Code',                  // Title to be displayed on the administration page
			array( $this, 'wsuwp_toolbox_retargetting_section' ), // Callback used to render the description of the section
			'wsuwp_toolbox_retargetting'                           // Page on which to add this section of options
		);

		add_settings_field(
			'wsuwp_toolbox_retargetting_location_field',                      // ID used to identify the field throughout the theme
			'Code Location',                           // The label to the left of the option interface element
			array( $this, 'add_wsu_toolbox_retargetting_location_field' ),   // The name of the function responsible for rendering the option interface
			'wsuwp_toolbox_retargetting',                          // The page on which this option will be displayed
			'wsuwp_toolbox_retargetting_section',         // The name of the section to which this field belongs
			array(                              // The array of arguments to pass to the callback. In this case, just a description.
				'Activate this setting to display the header.',
			)
		);

		add_settings_field(
			'wsu_toolbox_retargetting_code_field',                      // ID used to identify the field throughout the theme
			'Code',                           // The label to the left of the option interface element
			array( $this, 'add_wsu_toolbox_retargetting_code_field' ),   // The name of the function responsible for rendering the option interface
			'wsuwp_toolbox_retargetting',                          // The page on which this option will be displayed
			'wsuwp_toolbox_retargetting_section',         // The name of the section to which this field belongs
			array(                              // The array of arguments to pass to the callback. In this case, just a description.
				'Activate this setting to display the header.',
			)
		);

	} // End add_toolbox_settings


	public function wsuwp_toolbox_retargetting_section() {

	} // End wsuwp_toolbox_retargetting_section


	public function add_wsu_toolbox_retargetting_location_field() {

		$location_options = array(
			'none'   => 'Select',
			'head' => 'Head (In <head></head>)',
			'footer' => 'Footer (Before </body>)',
		);

		$current_location = get_option( 'wsuwp_toolbox_retargetting_location', '' );

		include __DIR__ . '/displays/form/location.php';

	} // End add_wsu_toolbox_retargetting_location_field


	public function add_wsu_toolbox_retargetting_code_field() {

		$code = get_option( 'wsu_toolbox_retargetting_code', '' );

		include __DIR__ . '/displays/form/code.php';

	} // End add_wsu_toolbox_retargetting_location_field


	public function add_retargetting_page() {

		include __DIR__ . '/displays/settings.php';

	} // End add_retargetting_page


	public function sanitize_code( $value ) {

		return $value;

	} // End sanitize_code

} // End WSUWP_Retargetting_Module


$wsuwp_retargetting_module = new WSUWP_Retargetting_Module();
