<?php 
/**
 * sidebar-footer.php
 *
 * The footer sidebar.
 */
?>

<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<aside class="footer-sidebar" role="complementary">
		<div class="row">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div> <!-- end row -->
	</aside> <!-- end sidebar -->
<?php endif; ?>