<?php

add_action('widgets_init','CrumbleMagazine_sdcoment_load_widgets');


function CrumbleMagazine_sdcoment_load_widgets(){
		register_widget("CrumbleMagazine_standardcomments_Widget");
}

/*
==========================================================================
  Widget class.
  This class handles everything that needs to be handled with the widget:
  the settings, form, display, and update. 
==========================================================================
*/
class CrumbleMagazine_standardcomments_Widget extends WP_widget{

	/* Widget setup. */
	function CrumbleMagazine_standardcomments_Widget(){
		
		/* Widget settings. */		
		$widget_ops = array( 'classname' => 'crumble_standardcomments_widget', 'description' => __( 'WP Standard Comments Widget For Single Post' , 'crumble' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_standardcomments_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'crumble_standardcomments_widget' , __( 'TNA: WP Comments' , 'crumble' ) , $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
	
		echo $before_widget;
		?>

				<?php comments_template(); ?>

			<?php
			echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		

		
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

	}
}
?>