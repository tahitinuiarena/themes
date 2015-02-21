<?php


add_action('widgets_init','CrumbleMagazine_sharethis_load_widgets');


function CrumbleMagazine_sharethis_load_widgets(){
		register_widget("CrumbleMagazine_ShareThis_Widget");
}

/*
==========================================================================
  Widget class.
  This class handles everything that needs to be handled with the widget:
  the settings, form, display, and update. 
==========================================================================
*/
class CrumbleMagazine_ShareThis_Widget extends WP_widget{

	/* Widget setup. */
	function CrumbleMagazine_ShareThis_Widget(){
		
		/* Widget settings. */		
		$widget_ops = array( 'classname' => 'crumble_sharethis_widget', 'description' => __( 'Share This Widget For Single Post' , 'crumble' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_sharethis_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crumble_sharethis_widget' , __( 'TNA: Share This' , 'crumble' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$code = $instance['code'];
		
		echo $before_widget;
		?>
			<?php
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			?>

			<div class="share">
				<?php echo $code; ?>
			</div> <!-- /share -->
		<?php
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['code'] = $new_instance['code'];

		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		?>
		<?php
			$defaults = array( 'title'=> __( 'Share This Article' , 'crumble' ), 'code' => '<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-500144fc331f9af5"></script>
<!-- AddThis Button END -->' 
			);
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 210px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('code'); ?>"><?php _e( 'Paste Your Code From https://www.addthis.com:' , 'crumble' ); ?></label>
			<textarea class="widefat" style="width: 220px; height: 350px" id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>"><?php echo $instance['code']; ?></textarea>
		</p>
		
		<?php

	}
}
?>