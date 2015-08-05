<?php 
/**
 * 404.php
 *
 * The template for displaying 404 pages (Not Found).
 */
?>

<?php get_header(); ?>

	<div class="container-404">
		<h1><?php _e( 'Error 404 - Nothing Found', 'alpha' ); ?></h1>

		<p><?php _e( 'It looks like nothing was found here. Maybe try a search?', 'alpha' ); ?></p>

		<?php get_search_form(); ?>
	</div> <!-- end container-404 -->

<?php get_footer(); ?>