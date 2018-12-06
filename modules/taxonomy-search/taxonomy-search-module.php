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
class Taxonomy_Search_Module extends Module {

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
	 * @var string $slug
	 */
	protected $slug = 'wsuwp_taxonomy_search';

	/**
	 * Registration args for the module
	 *
	 * @since 0.0.1
	 * @var array $register_args Array of registration args
	 */
	protected $register_args = array(
		'title'        => 'Taxonomy Search',
		'description'  => 'Taxonomy Search Tools',
		'priority'     => 10,
		'capability'   => 'super admin',
	); // End $register_args

	/**
	 * Default args use for shortcode and other presentation layers.
	 *
	 * @since 0.0.1
	 * @var array $default_args
	 */
	protected $default_args = array(
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


	/**
	 * Do the module. This should already have checked for active.
	 *
	 * @since 0.0.1
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

		require_once __DIR__ . '/class-taxonomy-search.php';

		$taxonomy_search = new Taxonomy_Search( $args, 'shortcode' );

		$html = $taxonomy_search->the_search();

		return $html;

	} // End do_shortcode


} // End Video_Module
