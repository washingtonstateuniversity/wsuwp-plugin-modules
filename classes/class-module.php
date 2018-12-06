<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class used to get and generate the taxonomy search module. This
 * class is used by the shortcode and other elements to render the search html.
 *
 * @since 0.0.1
 */
class Module {

	/**
	 * Version of taxonomy search module used the module.
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
	protected $slug = false;

	/**
	 * Module settings merged from child class and defaults. This is set by the
	 * __construct method.
	 *
	 * @since 0.0.1
	 * @var array $module_args.
	 */
	private $module_args = array();

	/**
	 * Registration args for the module
	 *
	 * @since 0.0.1
	 * @var array $register_args Array of registration args.
	 */
	protected $register_args = array();

	private $default_register_args = array(
		'owner'        => 'WSU',
		'icon'         => '/images/wsu-cougarhead-grey.png',
		'title'        => 'Please set a title',
		'description'  => '',
		'priority'     => 10,
		'capability'   => 'Super Admin',
		'default_on'   => false,
	);

	public function __construct() {

		$this->module_args = $this->get_module_reg_args();

	} // End __construct


	public function init() {

		if ( wsuwp_toolbox_is_active_module( $this->slug ) && method_exists( $this, 'init_module' ) ) {

			$this->init_module();

		} // End if

	} // End init_module


	public function check_module_save_option( $value, $old_value, $option ) {

		$key = get_wsuwp_toolbox_module_key( $this->slug );

		if ( $key !== $option ) {

			return $old_value;

		} // End if

		$caps = $this->get_capabilities();

		if ( ! current_user_can( $caps ) ) {

			return $old_value;

		} // End if

		if ( empty( $value ) ) {

			return $old_value;

		} // End if */

		return $value;

	} // End check_module_can_save


	public function get_owner() {

		$owner = ( ! empty( $this->module_args['owner'] ) ) ? $this->module_args['owner'] : '';

		return $owner;

	}


	public function get_icon() {

		$icon = ( ! empty( $this->module_args['icon'] ) ) ? $this->module_args['icon'] : '';

		return $icon;

	}


	public function get_title() {

		$title = ( ! empty( $this->module_args['title'] ) ) ? $this->module_args['title'] : '';

		return $title;

	}

	public function get_description() {

		$desc = ( ! empty( $this->module_args['description'] ) ) ? $this->module_args['description'] : '';

		return $desc;
	}

	public function get_version() {

		return $this->version;

	}

	public function get_capabilities() {

		$caps = ( ! empty( $this->module_args['capability'] ) ) ? $this->module_args['capability'] : 'Super Admin';

		return $caps;

	}

	public function get_priority() {

		$priority = ( ! empty( $this->module_args['priority'] ) ) ? $this->module_args['priority'] : 10;

		return $priority;

	}

	public function is_default_on() {

		$default_on = ( ! empty( $this->module_args['default_on'] ) ) ? $this->module_args['default_on'] : false;

		return $default_on;

	}


	protected function get_module_reg_args() {

		$reg_args = ( isset( $this->register_args ) ) ? $this->register_args : array();

		$default_args = $this->default_register_args;

		$args = array(
			'owner'        => ( ! empty( $reg_args['owner'] ) ) ? $reg_args['owner'] : $default_args['owner'],
			'icon'         => ( ! empty( $reg_args['icon'] ) ) ? $reg_args['icon'] : wsuwp_toolbox_get_plugin_url() . $default_args['icon'],
			'title'        => ( ! empty( $reg_args['title'] ) ) ? $reg_args['title'] : $default_args['title'],
			'description'  => ( ! empty( $reg_args['description'] ) ) ? $reg_args['description'] : $default_args['description'],
			'priority'     => ( ! empty( $reg_args['priority'] ) ) ? $reg_args['priority'] : $default_args['priority'],
			'default_on'   => ( ! empty( $reg_args['default_on'] ) ) ? $reg_args['default_on'] : $default_args['default_on'],
		);

		$args = apply_filters( 'wsuwp_toolbox_reg_args', $args, $this->slug, $reg_args, $default_args );

		// Added after filter - no filtering on the capability/perm level for securtiy reasons.
		$args['capability'] = ( ! empty( $reg_args['capability'] ) ) ? $reg_args['capability'] : $default_args['capability'];

		return $args;

	} // End get_module_reg_args
}
