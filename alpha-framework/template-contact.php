<?php 
/**
 * template-contact.php
 *
 * Template Name: Contact Page
 */
?>

<?php
	$errors = array();
	$isError = false;

	$errorName = __( 'Please enter your name.', 'alpha' );
	$errorEmail = __( 'Please enter a valid email address.', 'alpha' );
	$errorMessage = __( 'Please enter the message.', 'alpha' );

	// Get the posted variables and validate them.
	if ( isset( $_POST['is-submitted'] ) ) {
		$name    = $_POST['cName'];
		$email   = $_POST['cEmail'];
		$message = $_POST['cMessage'];

		// Check the name
		if ( ! alpha_validate_length( $name, 2 ) ) {
			$isError             = true;
			$errors['errorName'] = $errorName;
		}

		// Check the email
		if ( ! is_email( $email ) ) {
			$isError              = true;
			$errors['errorEmail'] = $errorEmail;
		}

		// Check the message
		if ( ! alpha_validate_length( $message, 2 ) ) {
			$isError                = true;
			$errors['errorMessage'] = $errorMessage;
		}

		// If there's no error, send email
		if ( ! $isError ) {
			// Get admin email
			$emailReceiver = get_option( 'admin_email' );

			$emailSubject = sprintf( __( 'You have been contacted by %s', 'alpha' ), $name );
			$emailBody    = sprintf( __( 'You have been contacted by %1$s. Their message is:', 'alpha' ), $name ) . PHP_EOL . PHP_EOL;
			$emailBody    .= $message . PHP_EOL . PHP_EOL;
			$emailBody    .= sprintf( __( 'You can contact %1$s via email at %2$s', 'alpha' ), $name, $email );
			$emailBody    .= PHP_EOL . PHP_EOL;
			
			$emailHeaders[] = "Reply-To: $email" . PHP_EOL;
			
			$emailIsSent = wp_mail( $emailReceiver, $emailSubject, $emailBody, $emailHeaders );
		}
	}
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
					<?php if ( isset( $emailIsSent ) && $emailIsSent ) : ?>
						<div class="alert alert-success">
							<?php _e( 'Your message has been sucessfully sent, thank you!', 'alpha' ); ?>
						</div> <!-- end alert -->
					<?php else : ?>

					<?php the_content(); ?>

					<?php if ( isset( $isError ) && $isError ) : ?>
						<div class="alert-alert-danger">
							<?php _e( 'Sorry, it seems there was an error.', 'alpha' ); ?>
						</div> <!-- end alert -->
					<?php endif; ?>
					<?php endif; ?>

					<form action="<?php the_permalink(); ?>" id="contact-form" method="POST" role="form">
						<div class="form-group <?php if ( isset( $errors['errorName'] ) ) echo "has-error"; ?>">
							<label for="contact-name" class="control-label"><span class="required">* </span><?php _e( 'Name:', 'alpha' ); ?></label>
							<input type="text" class="form-control" name="cName" id="contact-name" value="<?php if ( isset( $_POST['cName'] ) ) { echo $_POST['cName']; } ?>">
							<?php if ( isset( $errors['errorName'] ) ) : ?>
								<p class="help-block"><?php echo $errors['errorName']; ?></p>
							<?php endif; ?>
						</div> <!-- end form group -->

						<div class="form-group <?php if ( isset( $errors['errorEmail'] ) ) echo "has-error"; ?>">
							<label for="contact-email" class="control-label"><span class="required">* </span><?php _e( 'Email Address:', 'alpha' ); ?></label>
							<input type="text" class="form-control" name="cEmail" id="contact-email" value="<?php if ( isset( $_POST['cEmail'] ) ) { echo $_POST['cEmail']; } ?>">
							<?php if ( isset( $errors['errorEmail'] ) ) : ?>
								<p class="help-block"><?php echo $errors['errorEmail']; ?></p>
							<?php endif; ?>
						</div> <!-- end form-group -->

						<div class="form-group <?php if ( isset( $errors['errorMessage'] ) ) echo "has-error"; ?>">
							<label for="contact-message" class="control-label"><span class="required">* </span><?php _e( 'Message:', 'alpha' ); ?></label>
							<textarea name="cMessage" class="form-control" id="contact-message" cols="30" rows="10"><?php if ( isset( $_POST['cMessage'] ) ) { echo $_POST['cMessage']; } ?></textarea>
							<?php if ( isset( $errors['errorMessage'] ) ) : ?>
								<p class="help-block"><?php echo $errors['errorMessage']; ?></p>
							<?php endif; ?>
						</div> <!-- end form-group -->

						<input type="hidden" name="is-submitted" id="is-submitted" value="true">
						<button type="submit" class="btn btn-default"><?php _e( 'Send Message', 'alpha' ); ?></button>
					</form>
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
		<?php endwhile; ?>
	</div> <!-- end main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>