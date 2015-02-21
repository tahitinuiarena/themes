<?php

add_action( 'widgets_init', 'crumblemagazine_comments_load_widgets' );

function crumblemagazine_comments_load_widgets()
{
	register_widget('CrumbleMagazine_Recent_Comments_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CrumbleMagazine_Recent_Comments_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function CrumbleMagazine_Recent_Comments_Widget()
	{
		/* Widget settings. */
		$widget_ops = array('classname' => 'crumblemagazine_recent_comments_widget', 'description' => __( 'Display Recent Comments' , 'crumble' ) );
		
		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumblemagazine_recent_comments_widget');
		
		/* Create the widget. */
		$this->WP_Widget('crumblemagazine_recent_comments_widget', __( 'TNA : Recent Comments' , 'crumble' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$num_comments = $instance['num_comments'];
		$comment_len = $instance['comment_len'];		
		$show_avatar = isset($instance['show_avatar']) ? 'true' : 'false';
				
		echo $before_widget;
		?>
		<!-- BEGIN WIDGET -->
		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}





$recent_comments = get_comments( array(
    'number'    => $num_comments,
    'status'    => 'approve'
) );

	
	echo '<ul class="recent-comments-widget">';
	
	foreach( $recent_comments as $comment ) {
		echo '<li>';
?>

<?php
		if( $show_avatar == 'true' ) {
			echo get_avatar( $comment, $size='50', $default='<path_to_url>' ); 
		}		
		?>
		

	
		<?php		 	
				echo '<strong>' . dp_get_author($comment) .' said: </strong>'; ?>
		 		
		 		<a href="<?php echo get_permalink( $comment->comment_post_ID ); ?>">
		
		<?php		 
			echo strip_tags(substr(apply_filters('get_comment_text', $comment->comment_content), 0, $comment_len ) ) . ' ...'; 
			echo '</a>';?>
	<div class="small-meta rct-comments">
		<?php echo '['.human_time_diff(get_comment_date('U',$comment->comment_ID), current_time('timestamp')), __(' ago', 'your-theme'); ?>]&nbsp;   
	</div>
<?php			
			echo '<div class="clear"></div></li>'; 
	}
	
	echo '</ul>';
	
?>
		<!-- END WIDGET -->
		<?php
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num_comments'] = $new_instance['num_comments'];
		$instance['comment_len'] = $new_instance['comment_len'];		
		$instance['show_avatar'] = $new_instance['show_avatar'];				
		
		return $instance;
	}


	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array('title' => __( 'Recent Comments' , 'crumble' ) , 'num_comments' => 4, 'comment_len' => 50, 'show_avatar' => 'on' );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id('num_comments'); ?>"><?php _e( 'Number of comments:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('num_comments'); ?>" name="<?php echo $this->get_field_name('num_comments'); ?>" value="<?php echo $instance['num_comments']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('comment_len'); ?>"><?php _e( 'Length of comments: ( by default: 50 symbols )' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('comment_len'); ?>" name="<?php echo $this->get_field_name('comment_len'); ?>" value="<?php echo $instance['comment_len']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_avatar'], 'on'); ?> id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_avatar'); ?>"><?php _e( 'Show user avatar' , 'crumble' ); ?></label>
		</p>
		
	<?php 
	}
}
?>