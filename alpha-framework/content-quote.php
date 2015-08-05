<?php 
/**
 * content-quote.php
 *
 * The default template for displaying posts with the Quote post format.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- Article content -->
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading &rarr;', 'alpha' ) );

			wp_link_pages();
		?>
	</div> <!-- end entry-content -->

	<!-- Article footer -->
	<footer class="entry-footer">
		<p class="entry-meta">
			<?php 
				// Display the meta information
				alpha_post_meta();
			?>
		</p>
	</footer> <!-- end entry-footer -->
</article>