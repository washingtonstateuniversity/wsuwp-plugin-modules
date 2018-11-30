<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Display Videos
 *
 * @since 0.0.1
 */
class WSUWP_Video {

	/**
	 * Args passed to the module.
	 * @since 0.0.4
	 * @var array $args
	 */
	public $args;

	/**
	 * Current context of the module (shortcode,widget, etc..).
	 *
	 * @since 0.0.4
	 * @var string $context
	 */
	public $context;

	/**
	 * Default args use for shortcode and other presentation layers.
	 *
	 * @since 0.0.4
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


	public function __construct( $args = array(), $context = '' ) {

		$this->args = $this->parse_args( $args );

		$this->context = $context;

	} // End __construct


	/**
	 * Render the module and return or echo the html
	 *
	 * @since 0.0.4
	 *
	 * @param array $args Args to use in module. Defaults to $args class property if empty.
	 * @param string $context Context of module. Defaults to $context class property if empty.
	 *
	 */
	public function the_video( $args = array(), $context = '' ) {

		$args    = ( ! empty( $args ) ) ? $this->parse_args( $args ) : $this->args;
		$context = ( ! empty( $context ) ) ? $context : $this->context;

		$display = ( ! empty( $args['display'] ) ) ? $args['display'] : 'az-index';

		$classes = array(
			'wsuwp-video',
			'wsuwp-video-' . $display,
			'wsuwp-video-' . $context,
		);

		if ( ! empty( $args['class'] ) ) {

			$classes[] = $args['class'];

		} // End if

		$video_type = ( ! empty( $args['type'] ) ) ? $args['type'] : 'youtube';

		switch ( $video_type ) {

			case 'youtube':
				$this->the_youtube_video( $args, $display, $classes );
				break;

		} // End switch

	} // End the_module


	/**
	 * Render YouTube video Embed
	 * 
	 * @since 0.0.4
	 * 
	 * @param array $args Settings for the video.
	 * @param string $display Type of display.
	 * @param array $classes Classes to add to wrapper.
	 */
	private function the_youtube_video( $args, $display, $classes ) {

		$video_id = ( ! empty( $args['youtube_id'] ) ) ? $args['youtube_id'] : false;

		$title = ( ! empty( $args['title'] ) ) ? $args['title'] : false;

		$width = ( ! empty( $args['width'] ) ) ? $args['width'] : '100%';

		$wrapper_style = $this->get_compressed_style( $this->get_video_wrapper_style( $args ) );

		$video_style = $this->get_compressed_style( $this->get_video_style( $args ) );

		include __DIR__ . '/displays/youtube.php';

	} // End the_youtube_video

	
	/**
	 * Get video style for wrapper.
	 * 
	 * @since 0.0.4
	 * 
	 * @param array $args Module settings.
	 *
	 * @return string Style to be included.
	 */
	private function get_video_wrapper_style( $args ) {

		$style = array();

		$width       = ( ! empty( $args['width'] ) ) ? $args['width'] : '100%';
		$float_left  = ( ! empty( $args['wrap-text-left'] ) ) ? $args['wrap-text-left'] : false;
		$float_right = ( ! empty( $args['wrap-text-right'] ) ) ? $args['wrap-text-right'] : false;

		$style['max-width'] = $width;
		$style['margin-bottom'] = '22px';

		if ( ! empty( $float_right ) ) {

			$style['float']        = 'left';
			$style['margin-right'] = '22px';
			$style['width']        = '100%';

		} elseif ( ! empty( $float_left ) ) {

			$style['float']       = 'right';
			$style['margin-left'] = '22px';
			$style['width']       = '100%';

		}  // End if

		return $style;

	} // End get_video_size_style


	/**
	 * Get video wrapper style.
	 * 
	 * @since 0.0.4
	 * 
	 * @param array $args Module settings.
	 *
	 * @return string Style to be included.
	 */
	private function get_video_style( $args ) {

		$style = array();

		$height = ( ! empty( $args['height'] ) ) ? $args['height'] : 'auto';
		$ratio = ( ! empty( $args['ratio'] ) ) ? $args['ratio'] : false;

		if ( 'auto' !== $height ) {
			$style['height'] = $height;

		} else {

			$style['padding-bottom'] = $ratio;

		} // End if

		return $style;

	} // End get_video_size_style

	/**
	 * Convert style from array to string
	 * 
	 * @since 0.0.4
	 * 
	 * @param array $style
	 * 
	 * @return string Style
	 */
	private function get_compressed_style( $style ) {

		$style_array = array();

		if ( is_array( $style ) ) {

			foreach ( $style as $key => $value ) {

				$style_array[] = $key . ':' . $value;

			} // End foreach
		} // End if

		return implode( ';', $style_array );

	} // End get_compressed_style


	/**
	 * Parse arges an set default values.
	 *
	 * @since 0.0.4
	 *
	 * @param array $args Array of args
	 *
	 * @return array Args with defaults set.
	 */
	private function parse_args( $args ) {

		$args = wp_parse_args( $args, $this->default_args );

		return $args;

	} // End parse_args

} // End WSUWP_Video
