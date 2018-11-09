<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class WSUWP_Plugin_Modules {

	public static $version = '0.0.1';

	protected static $instance = null;

	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {

			self::$instance = new WSUWP_Plugin_Modules();

			self::$instance->init_plugin();

		} // End if

		return self::$instance;

	} // End get_instance


	private function init_plugin() {

		$this->setup_plugin();

		$this->add_modules();

	} // End init_plugin


	private function setup_plugin() {

		include_once __DIR__ . '/functions-public.php';

		include_once __DIR__ . '/includes/module-scripts.php';

		if ( is_admin() ) {

			include_once __DIR__ . '/includes/module-gallery.php';

		} // End if

	} // End setup_plugin


	private function add_modules() {

		include_once __DIR__ . '/modules/taxonomy-search/taxonomy-search-module.php';

	} // End add_modules

	/**
	 * Make constructor private, so nobody can call "new Class".
	 */
	private function __construct() {}

	/**
	 * Make clone magic method private, so nobody can clone instance.
	 */
	private function __clone() {}

	/**
	 * Make sleep magic method private, so nobody can serialize instance.
	 */
	private function __sleep() {}

	/**
	 * Make wakeup magic method private, so nobody can unserialize instance.
	 */
	private function __wakeup() {}

}
