<?php

add_action('widgets_init','CrumbleMagazine_ads300x250_load_widgets');


function CrumbleMagazine_ads300x250_load_widgets(){
		register_widget("CrumbleMagazine_Ads300x250_Widget");
}


class CrumbleMagazine_Ads300x250_Widget extends WP_widget{


	function CrumbleMagazine_Ads300x250_Widget(){
		
		
		$widget_ops = array( 'classname' => 'crumble_ads300x250_widget', 'description' => __( 'TNA: Ads 300x250 for sidebar widget' , 'crumble' ) );

		
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'crumble_ads300x250_widget' );
		
		
		$this->WP_Widget( 'crumble_ads300x250_widget', __( 'TNA: Ads 300x250' , 'crumble' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		$title = $instance['title'];
		$link = $instance['link'];
		$image = $instance['image'];
		?>

		<div class="widget">
		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>
		
		<?php
			if($image) {	
			?>				
			<div class="ads300-thumb">
				<a href="<?php echo $link; ?>">
					<img src="<?php echo $image; ?>" alt="" />
				</a>
			</div> 	
		</div> 
		<?php
		}

	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];		
		$instance['link'] = $new_instance['link'];
		$instance['image'] = $new_instance['image'];
		
		return $instance;
	}

	function form($instance){
		?>
		<?php
			$defaults = array( 'title' => __( 'ADS300', 'crumble' ), 'link' => '' , 'image' => '' );
			$instance = wp_parse_args((array) $instance, $defaults); 
		?>
		

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Link Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $instance['link']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e( 'Image Url:' , 'crumble' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $instance['image']; ?>" />
		</p>
		<?php

	}
}
?>