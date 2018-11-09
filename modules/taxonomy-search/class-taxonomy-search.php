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
class Taxonomy_Search {

	/**
	 * Args passed to the module.
	 * @since 0.0.1
	 * @var array $args
	 */
	public $args;


	/**
	 * Current context of the module (shortcode,widget, etc..).
	 *
	 * @since 0.0.1
	 * @var string $context
	 */
	public $context;

	/**
	 * Terms used for the search.
	 *
	 * @since 0.0.1
	 * @var array $terms Array of WP_Term objects.
	 */
	public $terms = array();


	/**
	 * Default args use for module.
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
		'search_after'  => 3, // Start search after
		'results_limit' => 10, // Limit number of search results
	);


	public function __construct( $args = array(), $context = '' ) {

		$this->args = $this->parse_args( $args );

		$this->context = $context;

	} // End __construct


	/**
	 * Render the module and return or echo the html
	 *
	 * @since 0.0.1
	 *
	 * @param array $args Args to use in module. Defaults to $args class property if empty.
	 * @param string $context Context of module. Defaults to $context class property if empty.
	 * @param bool $echo Echo instead of return if true.
	 *
	 * @return string|null Return html if $echo is set to false.
	 */
	public function the_search( $args = array(), $context = '', $echo = false ) {

		$args    = ( ! empty( $args ) ) ? $this->parse_args( $args ) : $this->args;
		$context = ( ! empty( $context ) ) ? $context : $this->context;

		$terms = $this->get_terms( $args, $context );

		$display = ( ! empty( $args['display'] ) ) ? $args['display'] : 'az-index';

		$classes = array(
			'wsuwp-taxonomy-search',
			'wsuwp-taxonomy-search-' . $display,
			'wsuwp-taxonomy-search-' . $context,
		);

		//var_dump( $args );

		if ( ! empty( $args['class'] ) ) {

			$classes[] = $args['class'];

		} // End if

		if ( ! empty( $args['taxonomy'] ) ) {

			$classes[] = 'wsuwp-taxonomy-search-' . $args['taxonomy'];

		} // End if

		ob_start();

		echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '" data-searchafter="' . esc_attr( $args['search_after'] ) . '" data-resultslimit="' . esc_attr( $args['results_limit'] ) . '">';

		switch ( $display ) {

			case 'az-index':
			default:
				$this->the_alpha_display( $terms, $args, $context );
				break;

		} // End switch

		echo '</div>';

		$html = ob_get_clean();

		if ( $echo ) {

			echo $html;

		} else {

			return $html;

		} // end if

	} // End the_module

	/**
	 * The alpha gallery display for taxonomy search
	 *
	 * @since 0.0.1
	 *
	 * @param array $terms Array of WP_Term objects.
	 * @param array $args Args to use in module. Defaults to $args class property if empty.
	 * @param string $context Context of module. Defaults to $context class property if empty.
	 */
	private function the_alpha_display( $terms, $args, $context ) {

		$alpha_terms = $this->get_alpha_terms_array( $terms, $args );

		$terms_js_array = $this->get_terms_json_array( $terms, $args );

		include __DIR__ . '/displays/az-index.php';

	} // end the_alpha_display


	/**
	 * Convert to array of alpha characters
	 *
	 * @since 0.0.1
	 *
	 * @param array $terms Array of WP_Term objects.
	 * @param array $args Args to use in module. Defaults to $args class property if empty.
	 *
	 * @return array Assoc. array of terms keyed by first letter.
	 */
	private function get_alpha_terms_array( $terms, $args ) {

		// Create an array of letter a-z
		$alpha_list = range( 'a', 'z' );

		// Final array of letter well populate with terms
		$alpha_array = array();

		// Build an assoc. array of all letters
		foreach ( $alpha_list as $alpha ) {

			$alpha_array[ $alpha ] = array();

		} // End foreach

		foreach ( $terms as $ts_term ) {

			$name = $ts_term->name;

			$term_alpha = strtolower( substr( $name, 0, 1 ) );

			$alpha_array[ $term_alpha ][] = $ts_term;

		} // End foreach

		return $alpha_array;

	} // End get_alpha_terms_array


	/**
	 * Get terms for given taxonomy in $args
	 *
	 * @since 0.0.1
	 *
	 * @param array $args Args passed to the taxonomy class.
	 *
	 * @return array Array of WP_Term objects.
	 */
	private function get_terms( $args ) {

		// get terms using WP get_terms.
		$terms = get_terms( $args );

		// if not an array (error) set to empty array.
		if ( ! is_array( $terms ) ) {

			$terms = array();

		} // End if

		return $terms;

	} // End get_terms


	/**
	 * Parse arges an set default values.
	 *
	 * @since 0.0.1
	 *
	 * @param array $args Array of args
	 *
	 * @return array Args with defaults set.
	 */
	private function parse_args( $args ) {

		$args = wp_parse_args( $args, $this->default_args );

		return $args;

	} // End parse_args


	/**
	 * Convert terms to json friendly structure
	 *
	 * @since 0.0.1
	 *
	 * @param array $terms Array of WP_Term objects.
	 * @param array $args Args to use in module. Defaults to $args class property if empty.
	 *
	 * @return array Assoc. array of terms.
	 */
	private function get_terms_json_array( $terms, $args ) {

		foreach ( $terms as $ts_term ) {

			$term_array[] = array(
				'name'  => $ts_term->name,
				'id'    => $ts_term->term_id,
				'slug'  => $ts_term->slug,
				'link'  => get_term_link( $ts_term->term_id ),
			);

		} // End Foreach

		return $term_array;

	} // End get_terms_json_array

} // End Taxonomy_Search
