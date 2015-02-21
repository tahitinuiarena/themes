<?php

add_action( 'widgets_init', 'crumblemagazine_twitter_load_widgets' );

// Register widget
function crumblemagazine_twitter_load_widgets() {
	register_widget( 'CrumbleMagazine_Twitter_Widget' );
}

// Widget class
class CrumbleMagazine_Twitter_Widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function CrumbleMagazine_Twitter_Widget() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'crumble_twitter_widget' , 'description' => __( 'Twitter Widget' , 'crumble' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_twitter_widget' );
		
		/* Create the widget. */
		$this->WP_Widget('crumble_twitter_widget', __( 'TNA : Twitter Widget' , 'crumble' ) , $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$user_name = $instance['user_name'];
	$count_message = $instance['count_message'];	

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>

<script type="text/javascript">
/***************************************************
					Flickr
***************************************************/
jQuery.noConflict()(function($){
$(document).ready(function() {


	  $(".tweet").tweet({
        	count: <?php echo $instance['count_message']; ?>,
        	username: "<?php echo $instance['user_name']; ?>",
        	loading_text: "loading twitter..."      
		});

	
});
});
</script>		

			<div class="tweet"></div>
	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['user_name'] = stripslashes( $new_instance['user_name']);
	$instance['count_message'] = stripslashes( $new_instance['count_message']);	

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 'title' => __( 'From Twitter' , 'crumble' ), 'user_name' => 'envato', 'count_message' => '3', );
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'crumble' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	
	<!-- User Name For Twitter Service Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'user_name' ); ?>"><?php _e( 'User Name:' , 'crumble'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_name' ); ?>" name="<?php echo $this->get_field_name( 'user_name' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['user_name'] ), ENT_QUOTES)); ?>" />
	</p>

	<!-- Count Messages: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'count_message' ); ?>"><?php _e( 'The Number of Displayed Messages:' , 'crumble' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'count_message' ); ?>" name="<?php echo $this->get_field_name( 'count_message' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['count_message'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>