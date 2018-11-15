<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Video_Module extends Module {

	public $version = '0.0.1';

	public $slug = 'video_module';

	/**
	 * Registration args for the module
	 *
	 * @since 0.0.1
	 * @var array $register_args Array of registration args
	 */
	public $register_args = array(
		'title'        => 'Video',
		'description'  => 'Video shortcode and related tools',
		'priority'     => 10,
		'capability'   => 'Administrator',
	); // End $register_args

} // End Video_Module

$wsuwp_video_module = new Video_module();
