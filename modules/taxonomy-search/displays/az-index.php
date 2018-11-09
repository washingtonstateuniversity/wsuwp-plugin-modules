<?php namespace WSUWP\Plugin_Modules;

/**
 * Alpha Gallery display for taxonomy search
 *
 * @var array $terms Array of WP_Term objects
 */
?>
<div class="wsuwp-taxonomy-search-term-icons">
	<?php foreach ( $alpha_terms as $key => $alpha_terms ) : ?>
	<span class="wsuwp-term-set wsuwp-term-set-<?php echo esc_attr( $key ); ?> <?php if ( empty( $alpha_terms ) ) : ?> wsuwp-empty-term<?php endif; ?>" data-alpha="<?php echo esc_attr( $key ); ?>">
		<?php echo esc_html( $key ); ?>
	</span>
	<?php endforeach; ?>
	<script>
		var wsuwp_term_set = <?php echo wp_json_encode( $terms_js_array ); ?>
	</script>
</div>
<?php if ( ! empty( $args['show_search'] ) ) : ?>
	<?php include __DIR__ . '/search.php'; ?>
<?php endif; ?>
<?php if ( ! empty( $args['show_results'] ) ) : ?>
	<?php include __DIR__ . '/results.php'; ?>
<?php endif; ?>
