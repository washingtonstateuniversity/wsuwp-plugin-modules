<div class="wsuwp-video-wrapper <?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo esc_attr( $wrapper_style ); ?>">
	<div class="wsuwp-video-wrapper <?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="position:relative;background-color:#000;<?php echo esc_attr( $video_style ); ?>">
	<?php if ( empty( $video_id ) ) : ?>
	<p class="wsuwp-video-message" style="color:#fff;font-size:20px;padding:40px">Sorry, no video ID supplied.</p>
	<?php elseif ( empty( $title ) ) : ?>
	<p class="wsuwp-video-message" style="color:#fff;font-size:20px;padding:40px">Sorry, you need to add a title for your video.</p>
	<?php else : ?>
	<iframe 
		style="position:absolute;top:0;left:0;right:0;bottom:0;display:block;width:100%;height:100%" 
		src="https://www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?rel=0" 
		frameborder="0" 
		allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
		title="<?php echo esc_attr( $title ); ?>"
		allowfullscreen
		>
	</iframe>
	<?php endif; ?>
	</div>
</div>
