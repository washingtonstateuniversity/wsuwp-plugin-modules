<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Video_Module {

	public $version = '0.0.1';

	public $slug = 'video_module';

	public function __construct() {

		add_action( 'init', array( $this, 'wp_init' ), 11 );

	} // End __construct


	public function wp_init() {

		$this->do_register_module();

	} // End wp_init


	protected function do_register_module() {

		$register_args = array(
			'version'      => $this->version,
			'title'        => __( 'Video Module', 'wsuwp-plugin-modules' ),
			'description'  => __( 'Video shortcode and related tools', 'wsuwp-plugin-modules' ),
			'priority'     => 10,
			'capability'   => 'Administrator',
		); // End $register_args

		wsuwp_mods_register_module( $this->slug, $register_args );

	} // End do_register_module

} // End Video_Module

$wsuwp_video_module = new Video_module();
