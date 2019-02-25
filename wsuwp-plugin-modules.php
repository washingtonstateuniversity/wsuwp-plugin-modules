<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class WSUWP_Plugin_Modules {

	public static $version = '1.2.2';

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

		add_action( 'init', array( $this, 'do_modules' ), 9 );

	} // End init_plugin


	private function setup_plugin() {

		include_once __DIR__ . '/functions-public.php';

		include_once __DIR__ . '/includes/module-scripts.php';

		if ( is_admin() ) {

			include_once __DIR__ . '/settings/module-settings.php';

		} // End if

		include_once __DIR__ . '/fonts/toolbox-fonts.php';

	} // End setup_plugin


	private function add_modules() {

		include_once __DIR__ . '/classes/class-module.php';

		include_once __DIR__ . '/modules/taxonomy-search/taxonomy-search-module.php';

		include_once __DIR__ . '/modules/video/video-module.php';

		include_once __DIR__ . '/modules/post-formats/post-formats-module.php';

		include_once __DIR__ . '/modules/retargetting/wsuwp-retargetting-module.php';

		include_once __DIR__ . '/modules/gravity-forms-columns/gravity-forms-columns-module.php';

		wsuwp_toolbox_register_module( 'wsuwp_taxonomy_search', __NAMESPACE__ . '\Taxonomy_Search_Module' );

		wsuwp_toolbox_register_module( 'wsuwp_video', __NAMESPACE__ . '\Video_Module' );

		wsuwp_toolbox_register_module( 'wsuwp_post_formats', __NAMESPACE__ . '\Post_Formats_Module' );

		wsuwp_toolbox_register_module( 'wsuwp_retargetting', __NAMESPACE__ . '\WSUWP_Retargetting_Module' );

		wsuwp_toolbox_register_module( 'wsuwp_gravity_forms_columns', __NAMESPACE__ . '\Gravity_Forms_Columns_Module' );

	} // End add_modules


	public function do_modules() {

		$registered_modules = get_wsuwp_toolbox_registered_modules();

		foreach ( $registered_modules as $id => $module_class ) {

			$module = get_wsuwp_toolbox_module( $id );

			if ( $module ) {

				if ( wsuwp_toolbox_is_active_module( $id, $module->is_default_on() ) ) {

					$module->init();

				} // End if
			} // End if
		} // End foreach

	} // End do_modules

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
