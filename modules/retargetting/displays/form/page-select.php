<select name="wsu_toolbox_retargetting_pages[]" multiple style="width:600px;max-width:100%;height:300px;">
<?php foreach ( $pages_select as $page_url ) : ?>
<option style="font-size:18px;padding:6px 12px;" value="<?php echo esc_attr( $page_url ); ?>" <?php if ( in_array( $page_url, $current_pages, true ) ) : ?>selected="selected"<?php endif; ?>>
	<?php echo esc_html( $page_url ); ?>
</option>
<?php endforeach; ?>
</select>
