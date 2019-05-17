<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Adds the feature to allow columns using the section break in gravity forms.
 *
 * @since 1.1.0
 */
class Gravity_Forms_Columns_Module extends Module {

	/**
	 * Version of taxonomy search module used the module.
	 *
	 * @since 1.1.0
	 * @var string $version Version of module.
	 */
	protected $version = '0.0.2';

	/**
	 * Slug/ID for the module.
	 *
	 * @since 1.1.0
	 * @var string|bool $slug
	 */
	public $slug = 'wsuwp_gravity_forms_columns';

	/**
	 * Registration args for the module
	 *
	 * @since 1.1.0
	 * @var array $register_args Array of registration args
	 */
	public $register_args = array(
		'title'        => 'Gravity Forms Columns',
		'description'  => 'Add Column Support for Gravity Forms',
		'priority'     => 10,
		'capability'   => 'administrator',
		'default_on'   => false,
	); // End $register_args

	/**
	 * Do the module. This should already have checked for active.
	 *
	 * @since 1.1.0
	 *
	 */
	protected function init_module() {

		add_action( 'wp_enqueue_scripts', array( $this, 'add_public_scripts' ) );

		add_action( 'gform_enqueue_scripts', array( $this, 'add_gf_scripts' ), 10, 2 );

		add_filter( 'gform_preview_styles', array( $this, 'add_preview_style' ), 10, 2 );

	} // End do_module

	/**
	 * Add public CSS file for Gravity Forms column support
	 *
	 * @since 1.1.0
	 */
	public function add_public_scripts() {

		wp_enqueue_style( 'wsuwp-plugin-toolbox-gravity-forms-columns-public-css', wsuwp_toolbox_get_plugin_url() . '/modules/gravity-forms-columns/gravity-forms-columns.css', array(), wsuwp_toolbox_get_plugin_version() );

	} // End add_pubic_scripts

	/**
	 * Add public CSS file for Gravity Forms preview
	 *
	 * @since 1.1.0
	 */
	public function add_preview_style( $styles, $form ) {

		wp_register_style( 'wsuwp-plugin-toolbox-gravity-forms-columns-public-css', wsuwp_toolbox_get_plugin_url() . '/modules/gravity-forms-columns/gravity-forms-columns.css', array(), wsuwp_toolbox_get_plugin_version() );

		$styles = array( 'wsuwp-plugin-toolbox-gravity-forms-columns-public-css' );

		return $styles;

	} // End add_pubic_scripts

	/**
	 * Add public JS file for Gravity Forms column support
	 *
	 * @since 1.1.0
	 */
	public function add_gf_scripts() {

		wp_enqueue_script( 'wsuwp-plugin-toolbox-gravity-forms-columns-public-js', wsuwp_toolbox_get_plugin_url() . '/modules/gravity-forms-columns/gravity-forms-columns.js', array( 'jquery' ), wsuwp_toolbox_get_plugin_version(), true );

	} // End add_pubic_scripts

} // End Gravity_Forms_Columns_Module

$wsuwp_gravity_forms_columns = new Gravity_Forms_Columns_Module();
