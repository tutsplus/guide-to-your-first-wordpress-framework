<?php 
/**
 * page.php
 *
 * The template for displaying all pages.
 */
?>

<?php get_header(); ?>

	<div class="main-content col-md-8" role="main">
		<?php while( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!-- Article header -->
				<header class="entry-header"> <?php
					// If the post has a thumbnail and it's not password protected
					// then display the thumbnail
					if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<figure class="entry-thumbnail"><?php the_post_thumbnail(); ?></figure>
					<?php endif; ?>

					<h1><?php the_title(); ?></h1>
				</header> <!-- end entry-header -->

				<!-- Article content -->
				<div class="entry-content">
					<?php the_content(); ?>

					<?php wp_link_pages(); ?>
				</div> <!-- end entry-content -->

				<!-- Article footer -->
				<footer class="entry-footer">
					<?php 
						if ( is_user_logged_in() ) {
							echo '<p>';
							edit_post_link( __( 'Edit', 'alpha' ), '<span class="meta-edit">', '</span>' );
							echo '</p>';
						}
					?>
				</footer> <!-- end entry-footer -->
			</article>

			<?php comments_template(); ?>
		<?php endwhile; ?>
	</div> <!-- end main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>