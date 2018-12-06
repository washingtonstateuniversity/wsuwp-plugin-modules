<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Post_Formats_Module extends Module {

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
	public $slug = 'wsuwp_post_formats';

	/**
	 * Registration args for the module
	 *
	 * @since 0.0.1
	 * @var array $register_args Array of registration args
	 */
	public $register_args = array(
		'title'        => 'Post Formats',
		'description'  => 'Enable Post Format Options',
		'priority'     => 10,
		'capability'   => 'administrator',
		'default_on'   => false,
	); // End $register_args


	/**
	 * Do the module. This should already have checked for active.
	 *
	 * @since 0.0.4
	 *
	 */
	protected function init_module() {

		add_theme_support( 'post-formats', array( 'video', 'link', 'quote' ) );

	} // End do_module

} // End Video_Module

$wsuwp_post_formats_module = new Post_Formats_Module();
