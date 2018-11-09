<?php namespace WSUWP\Plugin_Modules;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Add the taxonomy search module and display to wsu plugin options library.
 *
 * @since 0.0.1
 */
class Taxonomy_Search_Module {

	/**
	 * Version of taxonomy search module used the module.
	 *
	 * @since 0.0.1
	 * @var string $version Version of module.
	 */
	public $version = '0.0.1';

	/**
	 * Slug/ID for the module.
	 *
	 * @since 0.0.1
	 * @var string $slug
	 */
	public $slug = 'wsuwp_taxonomy_search';

	/**
	 * Default args use for shortcode and other presentation layers.
	 *
	 * @since 0.0.1
	 * @var array $default_args
	 */
	public $default_args = array(
		'taxonomy'      => 'post_tag', // Taxonomy to include in search.
		'display'       => 'az-index', // Display to use when rendering.
		'exclude'       => '', // Comma list of term IDs to exclude from search.
		'show_search'   => 1, // Show the search bar.
		'class'         => '', // Additional classes to add to the wapper.
		'orderby'       => 'name', // Order terms by.
		'order'         => 'ASC', // Acending or Decending order.
		'hide_empty'    => 1, // Hide terms that do not have posts.
		'show_results'  => 1, // Show term results
	);

	public function __construct() {

		// Call wp_init after the WordPress init action.
		add_action( 'init', array( $this, 'wp_init' ), 10 );

	} // End __construct


	/**
	 * Execute code at the init action of WordPress.
	 *
	 * @since 0.0.1
	 */
	public function wp_init() {

		// Register the module.
		$this->do_register_module();

		// Check if is active. If is active do module.
		if ( wsuwp_mods_is_active_module( $this->slug ) ) {

			$this->do_module();

		} // End if

	} // End wp_init


	/**
	 * Register the module so it displays on the settings page.
	 *
	 * @since 0.0.1
	 *
	 * @see functions-public.php wsuwp_mods_register_module
	 */
	protected function do_register_module() {

		/**
		 * Module registration args
		 *
		 * @see functions-public.php wsuwp_mods_register_module for a complete list of args.
		 */
		$register_args = array(
			'version'      => $this->version,
			'title'        => __( 'Taxonomy Search Module', 'wsuwp-plugin-modules' ),
			'description'  => __( 'Taxonomy Search Tools', 'wsuwp-plugin-modules' ),
			'priority'     => 10,
			'capability'   => 'Super Admin',
		); // End $register_args

		// Register the module
		wsuwp_mods_register_module( $this->slug, $register_args );

	} // End do_register_module


	/**
	 * Do the module. This should be called after a check if is active.
	 *
	 * @since 0.0.1
	 *
	 * @see functions-public.php wsuwp_mods_is_active_module
	 */
	protected function do_module() {

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

		require_once __DIR__ . '/class-taxonomy-search.php';

		$taxonomy_search = new Taxonomy_Search( $args, 'shortcode' );

		$html = $taxonomy_search->the_search();

		return $html;

	} // End do_shortcode


} // End Video_Module

// New instance of the module
$wsuwp_taxonomy_search_module = new Taxonomy_Search_Module();
