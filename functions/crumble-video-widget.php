<?php


add_action('widgets_init','crumblemagazine_video_load_widgets');


function crumblemagazine_video_load_widgets(){
		register_widget("CrumbleMagazine_Video_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrumbleMagazine_Video_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */
	function CrumbleMagazine_Video_Widget(){
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'crumble_video_widget' , 'description' => __( 'Video Widget For Sidebar' , 'crumble' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_video_widget' );
		
		/* Create the widget. */
		$this->WP_Widget('crumble_video_widget', __( 'TNA : Video Widget' , 'crumble' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);

		$title = apply_filters('widget_title', $instance['title'] );
		$type = $instance['type'];
		$id = $instance['id'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
		<div class="video-frame">
		<?php 
			/**
			* if YouTube Video
			*
			*/	
			if($type == 'Youtube') { ?>
				<iframe height="220" src="http://www.youtube.com/embed/<?php echo $id; ?>"></iframe>
			<?php } 
			/**
			* else if Vimeo Video
			*
			*/				
			elseif( $type == 'Vimeo') { ?>			
				<iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" height="220"></iframe>
			<?php } 
			/**
			* else if Dialymotion Video
			*
			*/			
			elseif($type == 'Dailymotion') { ?>
				<iframe height="220" src="http://www.dailymotion.com/embed/video/<?php echo $id ?>?logo=0"></iframe>
			<?php } ?>
		</div>

		<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = $new_instance['type'];
		$instance['id'] = $new_instance['id'];
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		$defaults = array( 'title' => __( 'Video' , 'crumble' ), 'type' => 'Vimeo', 'id' => '34162267' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Type:' , 'crumble' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
				<option <?php if ( 'Youtube' == $instance['type'] ) echo 'selected="selected"'; ?>>Youtube</option>
				<option <?php if ( 'Vimeo' == $instance['type'] ) echo 'selected="selected"'; ?>>Vimeo</option>
				<option <?php if ( 'Dailymotion' == $instance['type'] ) echo 'selected="selected"'; ?>>Dailymotion</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'Video ID:' , 'crumble' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" class="widefat" />
		</p>
		<?php

	}
}
?>