<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Module_Script {


	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'add_public_scripts' ) );

	} // End __construct


	public function add_public_scripts() {

		wp_enqueue_style( 'wsuwp-plugin-modules-public-css', wsuwp_toolbox_get_plugin_url() . '/css/public.css', array(), wsuwp_toolbox_get_plugin_version() );

		wp_enqueue_script( 'wsuwp-plugin-modules-public-js', wsuwp_toolbox_get_plugin_url() . '/js/public.js', array( 'jquery' ), wsuwp_toolbox_get_plugin_version(), true );

	} // End add_pubic_scripts


} // End Module_Script

$module_script = new Module_Script();
