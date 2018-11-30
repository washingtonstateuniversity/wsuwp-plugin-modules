<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Video_Module extends Module {

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
	public $slug = 'wsuwp_video';

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
		'default_on'   => false,
	); // End $register_args

	/**
	 * Default args use for shortcode and other presentation layers.
	 *
	 * @since 0.0.1
	 * @var array $default_args
	 */
	protected $default_args = array(
		'type'            => 'youtube',
		'display'         => 'player',
		'title'           => '',
		'youtube_id'      => '',
		'vimeo_id'        => '',
		'classes'         => '',
		'autoplay'        => '',
		'width'           => '100%',
		'height'          => 'auto',
		'ratio'           => '56.25%',
		'wrap-text-left'  => 0,
		'wrap-text-right' => 0,
	);

	/**
	 * Do the module. This should already have checked for active.
	 *
	 * @since 0.0.4
	 *
	 */
	protected function init_module() {

		add_shortcode( $this->slug, array( $this, 'do_shortcode' ) );

	} // End do_module


	/**
	 * Render the shortcode and return html
	 *
	 * @since 0.0.1
	 *
	 * @param array $atts Array of shortcode attributes.
	 * @param string|null $content Content inside shortcode.
	 * @param string $tag Shortcode tag.
	 *
	 * @return string Html of the rendered shortcode.
	 */
	public function do_shortcode( $atts, $content, $tag ) {

		$args = ( ! empty( $atts ) ) ? $atts : array();

		$args = shortcode_atts( $this->default_args, $args, $tag );

		require_once __DIR__ . '/class-wsuwp-video.php';

		$video = new WSUWP_Video( $args, 'shortcode' );

		ob_start();

		$video->the_video();

		$html = ob_get_clean();

		return $html;

	} // End do_shortcode

} // End Video_Module

$wsuwp_video_module = new Video_module();
