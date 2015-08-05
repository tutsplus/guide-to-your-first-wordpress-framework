<?php
/**
 * widget-business-hours.php
 * 
 * Plugin Name: Alpha_Widget_Business_Hours
 * Plugin URI: http://www.adipurdila.com
 * Description: A widget that displays business hours.
 * Version: 1.0
 * Author: Adi Purdila
 * Author URI: http://www.adipurdila.com
*/

class Alpha_Widget_Business_Hours extends WP_Widget {

	/**
	 * Specifies the widget name, description, class name and instatiates it
	 */
	public function __construct() {
		parent::__construct( 
			'widget-business-hours',
			__( 'Alpha: Business Hours', 'alpha' ),
			array(
				'classname'   => 'widget-business-hours',
				'description' => __( 'A custom widget that displays business hours.', 'alpha' )
			) 
		);
	}


	/**
	 * Generates the back-end layout for the widget
	 */
	public function form( $instance ) {
		// Default widget settings
		$defaults = array(
			'title'               => 'Business Hours',
			'hours_description'   => '',
			'hours_monday_friday' => '8am to 5pm',
			'hours_saturday'      => 'Closed',
			'hours_sunday'        => 'Closed'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		// The widget content ?>
		<!-- Title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'alpha' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<!-- Description -->
		<p>
			<label for="<?php echo $this->get_field_id( 'hours_description' ); ?>"><?php _e( 'Description:', 'alpha' ); ?></label>
			<textarea cols="30" rows="3" class="widefat" id="<?php echo $this->get_field_id( 'hours_description' ); ?>" name="<?php echo $this->get_field_name( 'hours_description' ); ?>"><?php echo esc_textarea( $instance['hours_description'] ); ?></textarea>
		</p> 

		<!-- Monday-Friday -->
		<p>
			<label for="<?php echo $this->get_field_id( 'hours_monday_friday' ); ?>"><?php _e( 'Monday-Friday:', 'alpha' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'hours_monday_friday' ); ?>" name="<?php echo $this->get_field_name( 'hours_monday_friday' ); ?>" value="<?php echo esc_attr( $instance['hours_monday_friday'] ); ?>">
		</p>

		<!-- Saturday -->
		<p>
			<label for="<?php echo $this->get_field_id( 'hours_saturday' ); ?>"><?php _e( 'Saturday:', 'alpha' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'hours_saturday' ); ?>" name="<?php echo $this->get_field_name( 'hours_saturday' ); ?>" value="<?php echo esc_attr( $instance['hours_saturday'] ); ?>">
		</p>

		<!-- Sunday -->
		<p>
			<label for="<?php echo $this->get_field_id( 'hours_sunday' ); ?>"><?php _e( 'Sunday:', 'alpha' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'hours_sunday' ); ?>" name="<?php echo $this->get_field_name( 'hours_sunday' ); ?>" value="<?php echo esc_attr( $instance['hours_sunday'] ); ?>">
		</p> <?php
	}


	/**
	 * Processes the widget's values
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Update values
		$instance['title']               = strip_tags( stripslashes( $new_instance['title'] ) );
		$instance['hours_description']   = strip_tags( stripslashes( $new_instance['hours_description'] ) );
		$instance['hours_monday_friday'] = strip_tags( stripslashes( $new_instance['hours_monday_friday'] ) );
		$instance['hours_saturday']      = strip_tags( stripslashes( $new_instance['hours_saturday'] ) );
		$instance['hours_sunday']        = strip_tags( stripslashes( $new_instance['hours_sunday'] ) );

		return $instance;
	}


	/**
	 * Output the contents of the widget
	 */
	public function widget( $args, $instance ) {
		// Extract the arguments
		extract( $args );

		$title               = apply_filters( 'widget_title', $instance['title'] );
		$hours_description   = $instance['hours_description'];
		$hours_monday_friday = $instance['hours_monday_friday'];
		$hours_saturday      = $instance['hours_saturday'];
		$hours_sunday        = $instance['hours_sunday'];

		// Display the markup before the widget (as defined in functions.php)
		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if ( $hours_description ) {
			echo '<p>' . $hours_description . '</p>';
		}

		echo '<ul>';

		if ( $hours_monday_friday ) : ?>
			<li>
				<span><?php _e( 'Monday-Friday: ', 'alpha' ); ?></span>
				<?php echo $hours_monday_friday; ?>
			</li>
		<?php endif;

		if ( $hours_saturday ) : ?>
			<li>
				<span><?php _e( 'Saturday: ', 'alpha' ); ?></span>
				<?php echo $hours_saturday; ?>
			</li>
		<?php endif;

		if ( $hours_sunday ) : ?>
			<li>
				<span><?php _e( 'Sunday: ', 'alpha' ); ?></span>
				<?php echo $hours_sunday; ?>
			</li>
		<?php endif;

		echo '</ul>';

		// Display the markup after the widget (as defined in functions.php)
		echo $after_widget;
	}
}

// Register the widget using an annonymous function
add_action( 'widgets_init', create_function( '', 'register_widget( "Alpha_Widget_Business_Hours" );' ) );
?>