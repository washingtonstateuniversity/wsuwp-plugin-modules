<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Add custom font options to WSU sites.
 *
 * @since 0.0.1
 */
class Toolbox_Fonts {


	private $google_fonts = array(
		'montserrat' => array(
			'label' => 'Montserrat',
			'href' => 'family=Montserrat',
			'weights' => array( '300', '400', '500', '700' ),
		),
	);

	public function __construct() {

		if ( is_admin() ) {

			add_action( 'admin_menu', array( $this, 'add_toolbox_fonts_settings_page' ) );

			add_action( 'admin_init', array( $this, 'add_toolbox_font_settings' ) );

		} // End if

		add_action( 'init', array( $this, 'add_fonts' ) );

	} // End __construct


	public function add_toolbox_fonts_settings_page() {

		add_submenu_page(
			'wsuwp_toolbox',
			'WSU Custom Fonts',
			'Custom Fonts',
			'Super Admin',
			'wsuwp_toolbox_fonts',
			array( $this, 'add_toolbox_fonts_page' )
		);

	} // End add_toolbox_menu


	public function add_toolbox_font_settings() {

		register_setting(
			'wsuwp_toolbox_fonts',
			'wsu_toolbox_google_fonts',
			array(
				'sanitize_callback' => array( $this, 'sanitize_font_setting' ),
			)
		);

		add_settings_section(
			'wsuwp_toolbox_fonts_google_section',         // ID used to identify this section and with which to register options
			'Google Fonts',                  // Title to be displayed on the administration page
			array( $this, 'add_wsu_toolbox_fonts_google_desc' ), // Callback used to render the description of the section
			'wsuwp_toolbox_fonts'                           // Page on which to add this section of options
		);

		add_settings_field(
			'wsu_toolbox_google_fonts_field',                      // ID used to identify the field throughout the theme
			'Google Fonts',                           // The label to the left of the option interface element
			array( $this, 'add_wsu_toolbox_google_fonts_fields' ),   // The name of the function responsible for rendering the option interface
			'wsuwp_toolbox_fonts',                          // The page on which this option will be displayed
			'wsuwp_toolbox_fonts_google_section',         // The name of the section to which this field belongs
			array(                              // The array of arguments to pass to the callback. In this case, just a description.
				'Activate this setting to display the header.',
			)
		);

	} // End add_toolbox_settings


	public function add_toolbox_fonts_page() {

		include __DIR__ . '/settings-page/settings.php';

	} // End add_toolbox_page

	public function add_wsu_toolbox_fonts_google_desc() {

		echo 'Add Google Fonts';

	} // End add_wsu_toolbox_tools_desc


	public function add_wsu_toolbox_google_fonts_fields() {

		$fonts = get_option( 'wsu_toolbox_google_fonts', array() );

		foreach ( $this->google_fonts as $key => $label ) {

			$checked = ( in_array( $key, $fonts, true ) ) ? ' checked="checked"' : '';

			echo '<label><input type="checkbox" name="wsu_toolbox_google_fonts[]" value="' . esc_attr( $key ) . '" ' . esc_attr( $checked ) . '/> ' . esc_html( $font['label'] ) . '</label>';

		} // End foreach

	} // End add_wsu_toolbox_tools_fields


	public function sanitize_font_setting( $value ) {

		return $value;

	}


	public function add_fonts() {

		add_action( 'wp_enqueue_scripts', array( $this, 'add_google_fonts' ) );

	} // End add_fonts


	public function add_google_fonts() {

		$active_fonts = get_option( 'wsu_toolbox_google_fonts', array() );

		if ( is_array( $active_fonts ) ) {

			$google_fonts = $this->google_fonts;

			foreach ( $active_fonts as $active_font ) {

				if ( array_key_exists( $active_font, $google_fonts ) ) {

					$font = $google_fonts[ $active_font ];

					$weights = ( ! empty( $font['weights'] ) ) ? ':' . implode( ',', $font['weights'] ) : '';

					$href = 'https://fonts.googleapis.com/css?' . $font['href'] . $weights;

					wp_enqueue_style( $active_font . '-google-font', $href, array(), '0.0.1' );

				} // End if
			} // End foreach
		} // End if

	} // End add_google_fonts


} // End Toolbox_Fonts

$wsuwp_toolbox_fonts = new Toolbox_Fonts();
